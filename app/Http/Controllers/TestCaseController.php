<?php

namespace App\Http\Controllers;

use App\Models\Skenario;
use App\Models\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestCaseController extends Controller
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
        $skenario = Skenario::where('uuid', request('skenario_uuid'))->firstOrFail();
        $items = TestCase::where('skenario_id', $skenario->id)->orderBy('nama', 'ASC')->get();
        return view('pages.test-case.index', [
            'title' => 'Fitur',
            'items' => $items,
            'skenario' => $skenario
        ]);
    }

    public function create()
    {
        $skenario = Skenario::where('uuid', request('skenario_uuid'))->firstOrFail();
        return view('pages.test-case.create', [
            'title' => 'Tambah Fitur',
            'skenario' => $skenario
        ]);
    }

    public function store()
    {
        request()->validate([
            'nama' => ['required'],
        ]);


        DB::beginTransaction();
        try {
            $skenario = Skenario::where('uuid', request('skenario_uuid'))->firstOrFail();

            $data = request()->only(['nama']);
            $data['skenario_id'] = $skenario->id;

            TestCase::create($data);
            DB::commit();
            return redirect()->route('test-case.index', [
                'skenario_uuid' => $skenario->uuid
            ])->with('success', 'Skenario berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = TestCase::where('uuid', $uuid)->firstOrFail();
        return view('pages.test-case.edit', [
            'title' => 'Edit Test Case',
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
            $item = TestCase::where('uuid', $uuid)->firstOrFail();
            $data = request()->only(['nama']);
            $item->update($data);

            DB::commit();
            return redirect()->route('test-case.index', [
                'skenario_uuid' => $item->skenario->uuid
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
            $item = TestCase::where('uuid', $uuid)->firstOrFail();
            $skenario_uuid = $item->skenario->uuid;
            $item->delete();
            DB::commit();
            return redirect()->route('test-case.index', [
                'skenario_uuid' => $skenario_uuid
            ])->with('success', 'Skenario berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
