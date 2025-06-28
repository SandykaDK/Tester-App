<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\AppModul;
use App\Models\AppMenu;
use App\Models\Developer;
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

        // Ambil data distribusi status testing dari status_from_qc di test_cases_new
        $stat_qc_notstarted = TestCaseNew::where('status_from_qc', 'not_started')->count();
        $stat_qc_open = TestCaseNew::where('status_from_qc', 'open')->count();
        $stat_qc_onprogress = TestCaseNew::where('status_from_qc', 'on_progress')->count();
        $stat_qc_reopen = TestCaseNew::where('status_from_qc', 're_open')->count();
        $stat_qc_waiting = TestCaseNew::where('status_from_qc', 'waiting_confirmation')->count();
        $stat_qc_pass = TestCaseNew::where('status_from_qc', 'pass')->count();
        $stat_qc_failed = TestCaseNew::where('status_from_qc', 'failed')->count();
        $stat_qc_readytoinstall = TestCaseNew::where('status_from_qc', 'ready_to_install')->count();
        $stat_qc_hold = TestCaseNew::where('status_from_qc', 'hold')->count();
        $stat_qc_cancelledbyuser = TestCaseNew::where('status_from_qc', 'cancelled_by_user')->count();

        // Statistik tambahan untuk Developer
        $stat_dev_notstarted = TestCaseNew::where('status_from_dev', 'not_started')->count();
        $stat_dev_open = TestCaseNew::where('status_from_dev', 'open')->count();
        $stat_dev_onprogress = TestCaseNew::where('status_from_dev', 'on_progress')->count();
        $stat_dev_hold = TestCaseNew::where('status_from_dev', 'hold')->count();
        $stat_dev_waiting = TestCaseNew::where('status_from_dev', 'waiting_confirmation')->count();
        $stat_dev_reopen = TestCaseNew::where('status_from_dev', 're_open')->count();
        $stat_dev_readytotest = TestCaseNew::where('status_from_dev', 'ready_to_test')->count();
        $stat_dev_installed = TestCaseNew::where('status_from_dev', 'installed')->count();
        $stat_dev_cancelledbyuser = TestCaseNew::where('status_from_dev', 'cancelled_by_user')->count();
        $stat_dev_closed = TestCaseNew::where('status_from_dev', 'closed')->count();

        // Ambil 3 aktivitas terakhir
        $recent_activities = ActivityLog::orderBy('created_at', 'desc')->limit(5)->get();

        return view('dashboard', compact(
            'stat_applications',
            'stat_modules',
            'stat_menus',
            'stat_developers',
            'recent_activities',

            'stat_qc_notstarted',
            'stat_qc_open',
            'stat_qc_onprogress',
            'stat_qc_reopen',
            'stat_qc_waiting',
            'stat_qc_pass',
            'stat_qc_failed',
            'stat_qc_readytoinstall',
            'stat_qc_hold',
            'stat_qc_cancelledbyuser',

            'stat_dev_notstarted',
            'stat_dev_open',
            'stat_dev_onprogress',
            'stat_dev_hold',
            'stat_dev_waiting',
            'stat_dev_reopen',
            'stat_dev_readytotest',
            'stat_dev_installed',
            'stat_dev_cancelledbyuser',
            'stat_dev_closed'
        ));
    }
}
