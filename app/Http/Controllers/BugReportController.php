<?php

namespace App\Http\Controllers;

use App\Models\BugReport;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BugReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Bug Report Index')->only('index');
        $this->middleware('can:Bug Report Create')->only(['create', 'store']);
        $this->middleware('can:Bug Report Edit')->only(['edit', 'update']);
        $this->middleware('can:Bug Report Delete')->only('destroy');
    }

    public function index()
    {
        $items = BugReport::latest()->get();
        return view('pages.bug-report.index', [
            'title' => 'Bug Report',
            'items' => $items
        ]);
    }

    public function create()
    {
        $data_project = Project::orderBy('nama', 'ASC')->get();
        return view('pages.bug-report.create', [
            'title' => 'Tambah Bug Report',
            'data_project' => $data_project
        ]);
    }

    public function store()
    {

        request()->validate([
            'project_id' => ['required'],
            'fitur_id' => ['required'],
            'temuan' => ['required'],
            'deskripsi' => ['required'],
            'link' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data = request()->all();
            $data['status'] = 0;
            BugReport::create($data);

            DB::commit();
            return redirect()->route('bug-report.index')->with('success', 'Bug Report berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = BugReport::where('uuid', $uuid)->firstOrFail();
        return view('pages.bug-report.edit', [
            'title' => 'Edit Bug Report',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'temuan' => ['required'],
            'deskripsi' => ['required'],
            'link' => ['required'],
        ]);


        DB::beginTransaction();
        try {
            $item = BugReport::where('uuid', $uuid)->firstOrFail();
            $data = request()->all();
            $item->update($data);

            DB::commit();
            return redirect()->route('bug-report.index')->with('success', 'Bug Report berhasil diupdate.');
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
            $item = BugReport::where('uuid', $uuid)->firstOrFail();
            $item->delete();
            DB::commit();
            return redirect()->route('bug-report.index')->with('success', 'Bug Report berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function verifikasi()
    {
        request()->validate([
            'status' => ['required', 'in:0,1,2']
        ]);
        DB::beginTransaction();
        try {
            $item = BugReport::where('uuid', request('uuid'))->firstOrFail();
            $item->update([
                'status' => request('status')
            ]);
            DB::commit();
            return redirect()->route('bug-report.index')->with('success', 'Bug Report berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
