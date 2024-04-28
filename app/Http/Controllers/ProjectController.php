<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Project Index')->only('index');
        $this->middleware('can:Project Create')->only(['create', 'store']);
        $this->middleware('can:Project Edit')->only(['edit', 'update']);
        $this->middleware('can:Project Delete')->only('destroy');
    }

    public function index()
    {
        $projects = Project::orderBy('nama', 'ASC');
        if (auth()->user()->getPermissions('Project By User')) {
            $projects->whereHas('teams', function ($team) {
                $team->where('user_id', auth()->user()->id);
            });
        }
        $items = $projects->get();
        return view('pages.project.index', [
            'title' => 'Project',
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.project.create', [
            'title' => 'Tambah item'
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
            'assign_date' => ['required'],
            'deskripsi' => ['required'],
            'status' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['user_id'] = auth()->id();
            Project::create($data);

            DB::commit();
            return redirect()->route('project.index')->with('success', 'Project berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = Project::where('uuid', $uuid)->firstOrFail();
        return view('pages.project.edit', [
            'title' => 'Edit Project',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'nama' => ['required'],
            'assign_date' => ['required'],
            'deskripsi' => ['required'],
            'status' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $item = Project::where('uuid', $uuid)->firstOrFail();
            $data = request()->all();
            $item->update($data);

            DB::commit();
            return redirect()->route('project.index')->with('success', 'Project berhasil diupdate.');
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
            $item = Project::where('uuid', $uuid)->firstOrFail();
            $item->delete();
            DB::commit();
            return redirect()->route('project.index')->with('success', 'Project berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
