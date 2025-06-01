<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\AppModul;
use App\Models\AppMenu;
use App\Models\Developer;
use App\Models\TestCase;

class ManajemenTestingController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        $modules = AppModul::with('application')->get();
        $menus = AppMenu::with('module')->get();
        $developers = Developer::select('id', 'dev_name')->get();
        $testCases = TestCase::with(['application', 'module', 'menu', 'developer'])
            ->paginate(request('items_per_page', 10)); // Default to 10 items per page

        return view('ManajemenTesting.ManajemenTesting', compact('applications', 'modules', 'menus', 'developers', 'testCases'));
    }

    public function create()
    {
        $applications = Application::all();
        $modules = AppModul::with('application')->get();
        $menus = AppMenu::select('id', 'menu_name', 'modul_id', 'menu_key')->get();
        $developers = Developer::select('id', 'dev_name')->get();

        return view('ManajemenTesting.Create', compact('applications', 'modules', 'menus', 'developers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'app_key' => 'required',
            'modul_key' => 'required',
            'menu_key' => 'required',
            'test_scenario' => 'required',
            'test_data' => 'required',
            'test_step' => 'required',
            'expected_result' => 'required',
            'result' => 'nullable',
            'status' => 'required',
            'test_date' => 'required|date',
            'pic_dev' => 'nullable|exists:developers,id',
        ]);

        TestCase::create([
            'test_key' => \Illuminate\Support\Str::uuid(),
            'app_key' => $request->app_key,
            'modul_key' => $request->modul_key,
            'menu_key' => $request->menu_key,
            'test_scenario' => $request->test_scenario,
            'test_data' => $request->test_data,
            'test_step' => $request->test_step,
            'expected_result' => $request->expected_result,
            'result' => $request->result,
            'status' => $request->status,
            'test_date' => $request->test_date,
            'pic_dev' => $request->pic_dev,
        ]);

        return redirect()->route('test-cases.index')
                         ->with('success', 'Test case created successfully.');
    }

    public function edit($id)
    {
        $testCase = TestCase::with(['application', 'module', 'menu', 'developer'])->findOrFail($id);
        $applications = Application::all();
        $modules = AppModul::with('application')->get();
        $menus = AppMenu::select('id', 'menu_name', 'modul_id', 'menu_key')->get();
        $developers = Developer::select('id', 'dev_name')->get();

        return view('ManajemenTesting.Edit', compact('testCase', 'applications', 'modules', 'menus', 'developers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'app_key' => 'required',
            'modul_key' => 'required',
            'menu_key' => 'required',
            'test_scenario' => 'required',
            'test_data' => 'required',
            'test_step' => 'required',
            'expected_result' => 'required',
            'result' => 'nullable',
            'status' => 'required',
            'test_date' => 'required|date',
            'pic_dev' => 'nullable|exists:developers,id',
        ]);

        $testCase = TestCase::findOrFail($id);
        $testCase->update([
            'app_key' => $request->app_key,
            'modul_key' => $request->modul_key,
            'menu_key' => $request->menu_key,
            'test_scenario' => $request->test_scenario,
            'test_data' => $request->test_data,
            'test_step' => $request->test_step,
            'expected_result' => $request->expected_result,
            'result' => $request->result,
            'status' => $request->status,
            'test_date' => $request->test_date,
            'pic_dev' => $request->pic_dev,
        ]);

        return redirect()->route('test-cases.index')
                         ->with('success', 'Test case updated successfully.');
    }

    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();

        return redirect()->route('applications.index')
                         ->with('success', 'Application deleted successfully.');
    }

    public function detail($id)
    {
        return view('ManajemenTesting.DetailAplikasi');
    }
}
