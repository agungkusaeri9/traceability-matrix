<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiturController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Fitur Index')->only('index');
        $this->middleware('can:Fitur Create')->only(['create', 'store']);
        $this->middleware('can:Fitur Edit')->only(['edit', 'update']);
        $this->middleware('can:Fitur Delete')->only('destroy');
    }

    public function index()
    {
        $project = Project::where('uuid', request('project_uuid'))->first();
        if ($project) {
            $items = Fitur::where('project_id', $project->id)->orderBy('nama', 'ASC')->get();
        } else {
            $items = [];
        }
        $data_project = Project::orderBy('nama', 'ASC')->get();
        return view('pages.fitur.index', [
            'title' => 'Fitur',
            'items' => $items,
            'project' => $project,
            'data_project' => $data_project
        ]);
    }

    public function create()
    {
        $project = Project::where('uuid', request('project_uuid'))->firstOrFail();
        $data_project = Project::orderBy('nama', 'ASC')->get();
        return view('pages.fitur.create', [
            'title' => 'Tambah Fitur',
            'data_project' => $data_project,
            'project' => $project
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
        ]);
        $project = Project::where('uuid', request('project_uuid'))->first();
        DB::beginTransaction();
        try {
            $data = request()->only(['nama']);
            $data['project_id'] = $project->id;
            Fitur::create($data);
            DB::commit();
            return redirect()->route('fitur.index', [
                'project_uuid' => $project->uuid
            ])->with('success', 'Fitur berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = Fitur::where('uuid', $uuid)->firstOrFail();
        return view('pages.fitur.edit', [
            'title' => 'Edit Fitur',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'nama' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $item = Fitur::where('uuid', $uuid)->firstOrFail();
            $data = request()->only(['nama']);
            $item->update($data);

            DB::commit();
            return redirect()->route('fitur.index', [
                'project_uuid' => $item->project->uuid
            ])->with('success', 'Fitur berhasil diupdate.');
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
            $item = Fitur::where('uuid', $uuid)->firstOrFail();
            $project_uuid = $item->project->uuid;
            $item->delete();
            DB::commit();
            return redirect()->route('fitur.index', [
                'project_uuid' => $project_uuid
            ])->with('success', 'Fitur berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function getByProjectId()
    {
        if (request()->ajax()) {
            $data = Fitur::where('project_id', request('project_id'))->orderBy('nama', 'ASC')->get();
            return response()->json($data);
        }
    }
}
