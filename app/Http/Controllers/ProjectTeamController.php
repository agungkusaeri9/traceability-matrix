<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTeam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Project Team Index')->only('index');
        $this->middleware('can:Project Team Create')->only(['create', 'store']);
        $this->middleware('can:Project Team Edit')->only(['edit', 'update']);
        $this->middleware('can:Project Team Delete')->only('destroy');
    }

    public function index($project_uuid)
    {
        $project = Project::where('uuid', $project_uuid)->firstOrFail();
        $items = ProjectTeam::where('project_id', $project->id)->get();
        return view('pages.project-team.index', [
            'title' => 'Project',
            'items' => $items,
            'project' => $project
        ]);
    }

    public function create($project_uuid)
    {
        $project = Project::where('uuid', $project_uuid)->firstOrFail();
        $user_project = $project->teams->pluck('user.id')->toArray();
        $data_user = User::whereNot('id', auth()->id())->whereNotIn('id', $user_project)->orderBy('name', 'ASC')->get();
        return view('pages.project-team.create', [
            'title' => 'Tambah Tim',
            'data_user' => $data_user,
            'project' => $project
        ]);
    }

    public function store($project_uuid)
    {
        request()->validate([
            'user_id' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $project = Project::where('uuid', $project_uuid)->firstOrFail();
            $data = request()->all();
            $data['project_id'] = $project->id;
            ProjectTeam::create($data);

            DB::commit();
            return redirect()->route('project-team.index', $project->uuid)->with('success', 'Tim Project berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy($uuid)
    {

        DB::beginTransaction();
        try {
            $item = ProjectTeam::where('uuid', $uuid)->firstOrFail();
            $item->delete();
            DB::commit();
            return redirect()->route('project-team.index', $item->project->uuid)->with('success', 'Tim Project berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
