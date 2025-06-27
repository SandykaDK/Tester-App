<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\AppModul;
use App\Models\AppMenu;
use App\Models\Developer;
use App\Models\TestCaseNew;


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $stat_applications = Application::count();
        $stat_modules = AppModul::count();
        $stat_menus = AppMenu::count();
        $stat_developers = Developer::count();

        $selected_year = $request->get('year', date('Y'));
        $years = TestCaseNew::selectRaw('YEAR(test_date) as year')->whereNotNull('test_date')->distinct()->orderBy('year', 'desc')->pluck('year');

        // Statistik test case (gabungan QC & Dev)
        $query = TestCaseNew::query();
        if ($selected_year !== 'all') {
            $query = $query->whereYear('test_date', $selected_year);
        }
        $stat_testcase_open = (clone $query)->where(function($q) {
            $q->where('status_from_qc', 'open')->orWhere('status_from_dev', 'open');
        })->count();
        $stat_testcase_onprogress = (clone $query)->where(function($q) {
            $q->where('status_from_qc', 'on progress')->orWhere('status_from_dev', 'on progress');
        })->count();
        $stat_testcase_waiting = (clone $query)->where(function($q) {
            $q->where('status_from_qc', 'waiting confirmation')->orWhere('status_from_dev', 'waiting confirmation');
        })->count();
        $stat_testcase_pass = (clone $query)->where(function($q) {
            $q->where('status_from_qc', 'pass')->orWhere('status_from_dev', 'pass');
        })->count();
        $stat_testcase_failed = (clone $query)->where(function($q) {
            $q->where('status_from_qc', 'failed')->orWhere('status_from_dev', 'failed');
        })->count();

        $stat_testcase_total = (clone $query)->count();
        $stat_testcase_selesai = (clone $query)
            ->where('status_from_qc', 'pass')
            ->where('status_from_dev', 'closed')
            ->count();
        $stat_testcase_aktif = $stat_testcase_open + $stat_testcase_onprogress + $stat_testcase_waiting;

        // Statistik khusus status_from_qc untuk progress testing (gunakan query builder baru untuk setiap status)
        $stat_qc_open = TestCaseNew::when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_date', $selected_year);
            })
            ->where('status_from_qc', 'open')->count();
        $stat_qc_onprogress = TestCaseNew::when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_date', $selected_year);
            })
            ->where('status_from_qc', 'on progress')->count();
        $stat_qc_waiting = TestCaseNew::when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_date', $selected_year);
            })
            ->where('status_from_qc', 'waiting confirmation')->count();
        $stat_qc_pass = TestCaseNew::when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_date', $selected_year);
            })
            ->where('status_from_qc', 'pass')->count();
        $stat_qc_failed = TestCaseNew::when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_date', $selected_year);
            })
            ->where('status_from_qc', 'failed')->count();

        // Test case per month (selected year or all)
        $testcase_per_month_query = TestCaseNew::selectRaw('MONTH(test_date) as month, COUNT(*) as count');
        if ($selected_year !== 'all') {
            $testcase_per_month_query = $testcase_per_month_query->whereYear('test_date', $selected_year);
        }
        $testcase_per_month = $testcase_per_month_query->groupBy('month')->orderBy('month')->pluck('count', 'month');
        $testcase_per_month_array = array_fill(1, 12, 0);
        foreach ($testcase_per_month as $month => $count) {
            $testcase_per_month_array[$month] = $count;
        }

        // Statistik test case per aplikasi
        $testcase_per_app = TestCaseNew::selectRaw('applications.app_name as app_name, COUNT(*) as jumlah')
            ->join('applications', 'test_cases_new.app_key', '=', 'applications.id')
            ->when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_cases_new.test_date', $selected_year);
            })
            ->groupBy('applications.app_name')
            ->orderBy('applications.app_name')
            ->get();

        // Statistik test case per modul
        $testcase_per_modul = TestCaseNew::selectRaw('app_moduls.modul_name as modul_name, COUNT(*) as jumlah')
            ->join('app_moduls', 'test_cases_new.modul_key', '=', 'app_moduls.id')
            ->when($selected_year !== 'all', function($q) use ($selected_year) {
                $q->whereYear('test_cases_new.test_date', $selected_year);
            })
            ->groupBy('app_moduls.modul_name')
            ->orderBy('app_moduls.modul_name')
            ->get();

        // Statistik test case per developer (PIC Dev) tetap pakai relasi
        $testcase_per_dev_query = TestCaseNew::selectRaw('pic_dev, COUNT(*) as jumlah')
            ->with('developer');
        if ($selected_year !== 'all') {
            $testcase_per_dev_query->whereYear('test_date', $selected_year);
        }
        $testcase_per_dev = $testcase_per_dev_query->groupBy('pic_dev')->get();

        // Durasi rata-rata penyelesaian test case (test_date ke updated_at, status_from_dev = installed/closed)
        $avg_duration = null;
        $installedCases = TestCaseNew::whereIn('status_from_dev', ['installed', 'closed']);
        if ($selected_year !== 'all') {
            $installedCases = $installedCases->whereYear('test_date', $selected_year);
        }
        $installedCases = $installedCases->get(['test_date', 'updated_at']);
        $totalSeconds = 0;
        $count = 0;
        foreach ($installedCases as $case) {
            if ($case->test_date && $case->updated_at) {
                $start = strtotime($case->test_date);
                $end = strtotime($case->updated_at);
                if ($end > $start) {
                    $totalSeconds += ($end - $start);
                    $count++;
                }
            }
        }
        if ($count > 0) {
            $avgSeconds = $totalSeconds / $count;
            $days = floor($avgSeconds / 86400);
            $hours = floor(($avgSeconds % 86400) / 3600);
            $minutes = floor(($avgSeconds % 3600) / 60);
            $avg_duration = ($days > 0 ? $days.' hari ' : '').($hours > 0 ? $hours.' jam ' : '').($minutes > 0 ? $minutes.' menit' : '');
            if (!$avg_duration) $avg_duration = '0 menit';
        } else {
            $avg_duration = '-';
        }

        // Activity log (filter tahun jika bukan 'all')
        $recent_activities_query = \App\Models\ActivityLog::orderBy('created_at', 'desc');
        if ($selected_year !== 'all') {
            $recent_activities_query = $recent_activities_query->whereYear('created_at', $selected_year);
        }
        $recent_activities = $recent_activities_query->get();

        return view('LaporanStatistik', compact(
            'stat_applications',
            'stat_modules',
            'stat_menus',
            'stat_developers',
            'stat_testcase_open',
            'stat_testcase_onprogress',
            'stat_testcase_waiting',
            'stat_testcase_pass',
            'stat_testcase_failed',
            'stat_testcase_total',
            'stat_testcase_selesai',
            'stat_testcase_aktif',
            'testcase_per_month_array',
            'selected_year',
            'years',
            'stat_qc_open',
            'stat_qc_onprogress',
            'stat_qc_waiting',
            'stat_qc_pass',
            'stat_qc_failed',
            'testcase_per_app',
            'testcase_per_modul',
            'testcase_per_dev',
            'recent_activities',
            'avg_duration'
        ));
    }
}
