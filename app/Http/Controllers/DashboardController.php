<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppModul;
use App\Models\AppMenu;
use App\Models\Developer;
use App\Models\TestCase;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $stat_applications = Application::count();
        $stat_modules = AppModul::count();
        $stat_menus = AppMenu::count();
        $stat_developers = Developer::count();

        // Ambil jumlah test case dan status progres
        $stat_testcase_open = TestCase::where('status', 'open')->count();
        $stat_testcase_onprogress = TestCase::where('status', 'on progress')->count();
        $stat_testcase_waiting = TestCase::where('status', 'waiting confirmation')->count();
        $stat_testcase_pass = TestCase::where('status', 'pass')->count();
        $stat_testcase_failed = TestCase::where('status', 'failed')->count();

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
            'recent_activities'
        ));
    }
}
