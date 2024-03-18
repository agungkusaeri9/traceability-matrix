<?php

namespace App\Http\Controllers;

use App\Models\TestCase;
use App\Models\TestStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestStepController extends Controller
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
        $test_case = TestCase::where('uuid', request('test_case_uuid'))->firstOrFail();
        $items = TestStep::where('test_case_id', $test_case->id)->get();
        return view('pages.test-step.index', [
            'title' => 'Fitur',
            'items' => $items,
            'test_case' => $test_case
        ]);
    }

    public function create()
    {
        $test_case = TestCase::where('uuid', request('test_case_uuid'))->firstOrFail();
        return view('pages.test-step.create', [
            'title' => 'Tambah Fitur',
            'test_case' => $test_case
        ]);
    }

    public function store()
    {
        request()->validate([
            'test_step' => ['required'],
            'test_data' => ['required'],
            'expected_behavior' => ['required'],
            'test_result' => ['required'],
            'date' => ['required']
        ]);
        DB::beginTransaction();
        try {
            $test_case = TestCase::where('uuid', request('test_case_uuid'))->firstOrFail();

            $data = request()->all();
            $data['test_case_id'] = $test_case->id;

            TestStep::create($data);
            DB::commit();
            return redirect()->route('test-step.index', [
                'test_case_uuid' => $test_case->uuid
            ])->with('success', 'Test Step berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($uuid)
    {
        $item = TestStep::where('uuid', $uuid)->firstOrFail();
        return view('pages.test-step.edit', [
            'title' => 'Edit Test Step',
            'item' => $item,
        ]);
    }

    public function update($uuid)
    {
        request()->validate([
            'test_step' => ['required'],
            'test_data' => ['required'],
            'expected_behavior' => ['required'],
            'test_result' => ['required'],
            'date' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $item = TestStep::where('uuid', $uuid)->firstOrFail();
            $data = request()->all();
            $item->update($data);
            DB::commit();
            return redirect()->route('test-step.index', [
                'test_case_uuid' => $item->test_case->uuid
            ])->with('success', 'test_case berhasil diupdate.');
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
            $item = TestStep::where('uuid', $uuid)->firstOrFail();
            $test_case_uuid = $item->test_case->uuid;
            $item->delete();
            DB::commit();
            return redirect()->route('test-step.index', [
                'test_case_uuid' => $test_case_uuid
            ])->with('success', 'Test Step berhasil dihapus.');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
