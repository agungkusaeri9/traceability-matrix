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
        $project_uuid = request('project_uuid');
        if ($project_uuid) {
            $items = Fitur::whereHas('project', function ($q) use ($project_uuid) {
                $q->where('uuid', $project_uuid);
            })->orderBy('nama', 'ASC')->get();
        } else {
            $items = Fitur::orderBy('nama', 'ASC')->get();
        }
        $data_project = Project::orderBy('nama', 'ASC')->get();
        return view('pages.fitur.index', [
            'title' => 'Fitur',
            'items' => $items,
            'project_uuid' => $project_uuid,
            'data_project' => $data_project
        ]);
    }

    public function create()
    {
        $project_uuid = request('project_uuid');
        $data_project = Project::orderBy('nama', 'ASC')->get();
        return view('pages.fitur.create', [
            'title' => 'Tambah Fitur',
            'data_project' => $data_project,
            'project_uuid' => $project_uuid
        ]);
    }

    public function store()
    {
        request()->validate([
            'project_id' => ['required'],
            'nama' => ['required'],
        ]);
        $project_uuid = request('project_uuid');
        DB::beginTransaction();
        try {
            $data = request()->all();
            Fitur::create($data);
            DB::commit();
            return redirect()->route('fitur.index', [
                'project_uuid' => $project_uuid
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
            $data = request()->all();
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
}
