<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:Repository Index')->only('index');
        $this->middleware('can:Repository Create')->only(['create', 'store']);
        $this->middleware('can:Repository Edit')->only(['edit', 'update']);
        $this->middleware('can:Repository Delete')->only('destroy');
    }

    public function index()
    {
        $items = Repository::latest()->get();
        return view('pages.repository.index', [
            'title' => 'Repository',
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('pages.repository.create', [
            'title' => 'Tambah Repository'
        ]);
    }

    public function store()
    {

        request()->validate([
            'nama_dokumen' => ['required'],
            'file' => ['required', 'file']
        ]);

        DB::beginTransaction();
        try {
            $data = request()->only(['nama_dokumen', 'deskripsi']);
            $data['file'] = request()->file('file')->store('repository', 'public');
            $data['jenis'] = request()->file('file')->getClientOriginalExtension();
            $data['ukuran'] = request()->file('file')->getSize();
            Repository::create($data);

            DB::commit();
            return redirect()->route('repository.index')->with('success', 'Repository berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = Repository::where('uuid', $uuid)->firstOrFail();
        return view('pages.repository.edit', [
            'title' => 'Edit Repository',
            'item' => $item
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'nama_dokumen' => ['required'],
            'file' => ['file']
        ]);

        DB::beginTransaction();
        try {
            $item = Repository::where('uuid', $uuid)->firstOrFail();
            $data = request()->only(['nama_dokumen', 'deskripsi']);
            if (request()->file('file')) {
                // hapus
                Storage::disk('public')->delete($item->file);
                $data['file'] = request()->file('file')->store('repository', 'public');
                $data['jenis'] = request()->file('file')->getClientOriginalExtension();
                $data['ukuran'] = request()->file('file')->getSize();
            }
            $item->update($data);

            DB::commit();
            return redirect()->route('repository.index')->with('success', 'Repository berhasil diupdate.');
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
            $item = Repository::where('uuid', $uuid)->firstOrFail();
            $item->delete();
            DB::commit();
            return redirect()->route('repository.index')->with('success', 'Repository berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
