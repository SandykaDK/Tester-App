<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\AppMenu;
use App\Models\AppModul;
use App\Models\Developer;
use App\Models\Application;
use Illuminate\Http\Request;

class ManajemenTestingBaruController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        $modules = AppModul::with('application')->get();
        $menus = AppMenu::with('module')->get();
        $developers = Developer::select('id', 'dev_name')->get();

        // Ambil data dari tabel test_cases_new, bukan test_cases
        $testCases = DB::table('test_cases_new')
            ->leftJoin('applications', 'test_cases_new.app_key', '=', 'applications.id')
            ->leftJoin('app_moduls', 'test_cases_new.modul_key', '=', 'app_moduls.id')
            ->leftJoin('app_menus', 'test_cases_new.menu_key', '=', 'app_menus.id')
            ->leftJoin('developers', 'test_cases_new.pic_dev', '=', 'developers.id')
            ->select(
                'test_cases_new.*',
                'applications.app_name as application_app_name',
                'app_moduls.modul_name as module_modul_name',
                'app_menus.menu_name as menu_menu_name',
                'developers.dev_name as developer_dev_name'
            )
            ->paginate(request('items_per_page', 10));

        return view('ManajemenTestingBaru.Manajementestingbaru', compact('applications', 'modules', 'menus', 'developers', 'testCases'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $updateData = [
            'app_key' => $data['app_key'] ?? null,
            'modul_key' => $data['modul_key'] ?? null,
            'menu_key' => $data['menu_key'] ?? null,
            'pic_dev' => $data['pic_dev'] ?? null,
            'test_date' => empty($data['test_date']) ? null : $data['test_date'],
            'test_scenario' => $data['test_scenario'] ?? null,
            'test_data' => $data['test_data'] ?? null,
            'test_step' => $data['test_step'] ?? null,
            'expected_result' => $data['expected_result'] ?? null,
            'result' => $data['result'] ?? null,
            'status_from_qc' => $data['status_from_qc'] ?? null,
            'evidence' => $data['evidence'] ?? null,
            'note' => $data['note'] ?? null,
            'status_from_dev' => $data['status_from_dev'] ?? null,
        ];

        DB::table('test_cases_new')->where('id', $id)->update($updateData);

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        // Insert data kosong (default) ke test_cases_new
        $id = DB::table('test_cases_new')->insertGetId([
            'test_key' => \Illuminate\Support\Str::uuid(),
            'app_key' => null,
            'modul_key' => null,
            'menu_key' => null,
            'test_scenario' => '',
            'test_data' => '',
            'test_step' => '',
            'expected_result' => '',
            'result' => '',
            'test_date' => null,
            'pic_dev' => null,
            'status_from_qc' => '',
            'evidence' => '',
            'note' => '',
            'status_from_dev' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil data row baru (join agar bisa langsung render row baru di frontend jika mau)
        $row = DB::table('test_cases_new')
            ->leftJoin('applications', 'test_cases_new.app_key', '=', 'applications.id')
            ->leftJoin('app_moduls', 'test_cases_new.modul_key', '=', 'app_moduls.id')
            ->leftJoin('app_menus', 'test_cases_new.menu_key', '=', 'app_menus.id')
            ->leftJoin('developers', 'test_cases_new.pic_dev', '=', 'developers.id')
            ->select(
                'test_cases_new.*',
                'applications.app_name as application_app_name',
                'app_moduls.modul_name as module_modul_name',
                'app_menus.menu_name as menu_menu_name',
                'developers.dev_name as developer_dev_name'
            )
            ->where('test_cases_new.id', $id)
            ->first();

        return response()->json(['success' => true, 'row' => $row]);
    }

    // Tambahkan method destroy
    public function destroy($id)
    {
        $deleted = DB::table('test_cases_new')->where('id', $id)->delete();
        return response()->json(['success' => $deleted > 0]);
    }
}
