<?php

namespace App\Http\Controllers;

use App\Models\Fitur;
use App\Models\Skenario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkenarioController extends Controller
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
        $fitur = Fitur::where('uuid', request('fitur_uuid'))->firstOrFail();
        $items = Skenario::where('fitur_id', $fitur->id)->orderBy('nama', 'ASC')->get();
        return view('pages.skenario.index', [
            'title' => 'Fitur',
            'items' => $items,
            'fitur' => $fitur
        ]);
    }

    public function create()
    {
        $fitur = Fitur::where('uuid', request('fitur_uuid'))->firstOrFail();
        return view('pages.skenario.create', [
            'title' => 'Tambah Fitur',
            'fitur' => $fitur
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $fitur = Fitur::where('uuid', request('fitur_uuid'))->firstOrFail();

            $data = request()->only(['nama']);
            $data['fitur_id'] = $fitur->id;

            Skenario::create($data);
            DB::commit();
            return redirect()->route('skenario.index', [
                'fitur_uuid' => $fitur->uuid
            ])->with('success', 'Skenario berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = Skenario::where('uuid', $uuid)->firstOrFail();
        return view('pages.skenario.edit', [
            'title' => 'Edit Fitur',
            'item' => $item,
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'nama' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $item = Skenario::where('uuid', $uuid)->firstOrFail();
            $data = request()->only(['nama']);
            $item->update($data);

            DB::commit();
            return redirect()->route('skenario.index', [
                'fitur_uuid' => $item->fitur->uuid
            ])->with('success', 'Skenario berhasil diupdate.');
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
            $item = Skenario::where('uuid', $uuid)->firstOrFail();
            $fitur_uuid = $item->fitur->uuid;
            $item->delete();
            DB::commit();
            return redirect()->route('skenario.index', [
                'fitur_uuid' => $fitur_uuid
            ])->with('success', 'Skenario berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
