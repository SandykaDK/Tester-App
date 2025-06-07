<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppModul;
use App\Models\AppMenu;
use App\Models\Developer;
use App\Models\TestCase;
use App\Models\TestCaseNew;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $stat_applications = Application::count();
        $stat_modules = AppModul::count();
        $stat_menus = AppMenu::count();
        $stat_developers = Developer::count();

        // Ambil jumlah test case dan status progres (masih dari tabel lama)
        $stat_testcase_open = TestCase::where('status', 'open')->count();
        $stat_testcase_onprogress = TestCase::where('status', 'on progress')->count();
        $stat_testcase_waiting = TestCase::where('status', 'waiting confirmation')->count();
        $stat_testcase_pass = TestCase::where('status', 'pass')->count();
        $stat_testcase_failed = TestCase::where('status', 'failed')->count();

        // Ambil data distribusi status testing dari status_from_qc di test_cases_new
        $stat_qc_open = TestCaseNew::where('status_from_qc', 'open')->count();
        $stat_qc_onprogress = TestCaseNew::where('status_from_qc', 'on progress')->count();
        $stat_qc_waiting = TestCaseNew::where('status_from_qc', 'waiting confirmation')->count();
        $stat_qc_pass = TestCaseNew::where('status_from_qc', 'pass')->count();
        $stat_qc_failed = TestCaseNew::where('status_from_qc', 'failed')->count();

        // Ambil 3 aktivitas terakhir
        $recent_activities = ActivityLog::orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard', compact(
            'stat_applications',
            'stat_modules',
            'stat_menus',
            'stat_developers',
            'stat_testcase_open',
            'stat_testcase_onprogress',
            'stat_testcase_waiting',
            'stat_testcase_pass',
            'stat_testcase_failed',
            'recent_activities',
            // Tambahkan variabel distribusi status dari QC
            'stat_qc_open',
            'stat_qc_onprogress',
            'stat_qc_waiting',
            'stat_qc_pass',
            'stat_qc_failed'
        ));
    }
}
