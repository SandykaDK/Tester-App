<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Statistik</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 relative min-h-screen overflow-x-hidden">
    <div class="fixed top-0 left-0 w-1/2 h-1/2 pointer-events-none z-0">
        <svg viewBox="0 0 400 400" fill="none" class="w-full h-full opacity-30">
            <circle cx="200" cy="200" r="200" fill="#3B82F6"/>
            <ellipse cx="320" cy="80" rx="80" ry="40" fill="#60A5FA" />
            <ellipse cx="80" cy="320" rx="60" ry="30" fill="#2563EB" />
        </svg>
    </div>
    <div class="fixed bottom-0 right-0 w-1/3 h-1/3 pointer-events-none z-0">
        <svg viewBox="0 0 300 300" fill="none" class="w-full h-full opacity-20">
            <circle cx="150" cy="150" r="150" fill="#1E40AF"/>
            <ellipse cx="220" cy="60" rx="60" ry="25" fill="#3B82F6" />
        </svg>
    </div>
    <div id="sidebar" class="sidebar-maximized bg-white shadow-md transition-all duration-300 flex flex-col justify-between z-10">
        <x-sidebar />
    </div>
    <div class="main-content flex-1 p-6 relative z-10">
        <div class="flex justify-end items-center mb-4">
            <x-profile-section />
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-white bg-opacity-30 rounded-full p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 0a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <div class="text-white text-lg font-bold">{{ $stat_applications ?? 0 }}</div>
                    <div class="text-white text-sm">Aplikasi</div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-white bg-opacity-30 rounded-full p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <div>
                    <div class="text-white text-lg font-bold">{{ $stat_modules ?? 0 }}</div>
                    <div class="text-white text-sm">Modul</div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-white bg-opacity-30 rounded-full p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>
                <div>
                    <div class="text-white text-lg font-bold">{{ $stat_menus ?? 0 }}</div>
                    <div class="text-white text-sm">Menu</div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-pink-400 to-pink-600 rounded-xl shadow-lg p-6 flex items-center">
                <div class="bg-white bg-opacity-30 rounded-full p-3 mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20H4v-2a4 4 0 013-3.87" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-white text-lg font-bold">{{ $stat_developers ?? 0 }}</div>
                    <div class="text-white text-sm">Developer</div>
                </div>
            </div>
        </div>

        <!-- Overview Section: Total, Selesai, Aktif Test Case, dan Bar Chart -->
        <div class="mb-8">
            <form method="get" class="mb-4 flex items-center gap-2">
                <label for="filter-year" class="text-sm">Tahun:</label>
                <select id="filter-year" name="year" class="border rounded px-2 py-1" onchange="this.form.submit()">
                    <option value="all" @if($selected_year == 'all') selected @endif>Semua</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" @if($selected_year == $year) selected @endif>{{ $year }}</option>
                    @endforeach
                </select>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center">
                    <div class="flex items-center gap-4">
                        <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                        <span class="text-2xl font-bold text-blue-600">{{ $stat_testcase_total ?? 0 }}</span>
                    </div>
                    <div class="text-gray-700">Total Test Case</div>
                </div>
                <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center">
                    <div class="flex items-center gap-4">
                        <svg class="w-7 h-7 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-2xl font-bold text-green-600">{{ $stat_testcase_selesai ?? 0 }}</span>
                    </div>
                    <div class="text-gray-700">Test Case Selesai</div>
                </div>
                <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center">
                    <div class="flex items-center gap-4">
                        <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                        </svg>
                        <span class="text-2xl font-bold text-yellow-600">{{ $stat_testcase_aktif ?? 0 }}</span>
                    </div>
                    <div class="text-gray-700">Test Case Aktif</div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-lg font-bold text-gray-800">Jumlah Test Case per Bulan</div>
                    <div>
                        <label for="chartType" class="mr-2 text-sm text-gray-600">Tipe Diagram:</label>
                        <select id="chartType" class="border rounded px-2 py-1 text-sm">
                            <option value="bar">Bar</option>
                            <option value="line">Line</option>
                            <option value="area">Area</option>
                        </select>
                    </div>
                </div>
                <canvas id="testcaseBarChart" height="80"></canvas>
            </div>
        </div>

        <!-- Status Progres Testing, Pie Chart, dan Aktivitas Terakhir -->
        <div class="mb-8 grid grid-cols-1 lg:grid-cols-5 gap-8">
            <!-- Status Progress Testing -->
            <div class="bg-white rounded-xl shadow-lg p-6 lg:col-span-2">
                <div class="text-xl font-bold text-gray-800 mb-4">Status Progress Testing</div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-100">
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#ef4444"></span>
                                        <span class="font-semibold text-gray-700">Open</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_qc_open ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#f59e42"></span>
                                        <span class="font-semibold text-gray-700">On Progress</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_qc_onprogress ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#a21caf"></span>
                                        <span class="font-semibold text-gray-700">Waiting Confirmation</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_qc_waiting ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#22c55e"></span>
                                        <span class="font-semibold text-gray-700">Pass</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_qc_pass ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#800000"></span>
                                        <span class="font-semibold text-gray-700">Failed</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_qc_failed ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pie Chart: Distribusi Status Testing -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center lg:col-span-2 min-w-[220px]">
                <div class="text-lg font-bold text-gray-800 mb-4">Distribusi Status Testing</div>
                <canvas id="statusPieChart" width="250" height="250"></canvas>
            </div>
            <!-- Card Durasi Rata-rata Penyelesaian Test Case -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center lg:col-span-1 min-w-[220px]">
                <div class="text-lg font-bold text-gray-800 mb-10">Durasi Rata-rata Selesai</div>
                <div class="text-3xl font-bold text-blue-600 mb-20">{{ $avg_duration }}</div>
                <div class="text-gray-500 text-sm text-center">Rata-rata waktu pengerjaan test case</b></div>
            </div>
        </div>

        <!-- Statistik: Jumlah Test Case per Aplikasi, Modul, dan Developer -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Test Case per Aplikasi -->
            <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col h-full">
                <div class="text-xl font-bold text-gray-900 mb-5">Test Case per Aplikasi</div>
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left py-3 px-2 font-bold">Aplikasi</th>
                            <th class="text-right py-3 px-2 font-bold">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testcase_per_app as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-2">{{ $row->app_name ?? '-' }}</td>
                                <td class="text-right py-2 px-2 font-semibold">{{ $row->jumlah }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-gray-400 py-2 px-2">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Test Case per Modul -->
            <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col h-full">
                <div class="text-xl font-bold text-gray-900 mb-5">Test Case per Modul</div>
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left py-3 px-2 font-bold">Modul</th>
                            <th class="text-right py-3 px-2 font-bold">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testcase_per_modul as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-2">{{ $row->modul_name ?? '-' }}</td>
                                <td class="text-right py-2 px-2 font-semibold">{{ $row->jumlah }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-gray-400 py-2 px-2">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Test Case per Developer -->
            <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col h-full">
                <div class="text-xl font-bold text-gray-900 mb-5">Test Case per Developer</div>
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="text-left py-3 px-2 font-bold">Developer</th>
                            <th class="text-right py-3 px-2 font-bold">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testcase_per_dev as $row)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-2 px-2">{{ $row->developer->dev_name ?? '-' }}</td>
                                <td class="text-right py-2 px-2 font-semibold">{{ $row->jumlah }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-gray-400 py-2 px-2">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aktivitas Terakhir (Tabel) -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-xl font-bold mb-4 text-gray-800">Aktivitas Terakhir</div>
            <div class="overflow-x-auto">
                <div class="max-h-96 overflow-y-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-100 sticky top-0 z-10">
                            <tr>
                                <th class="text-left py-3 px-2 font-bold sticky top-0 bg-gray-100 z-10">Deskripsi</th>
                                <th class="text-left py-3 px-2 font-bold sticky top-0 bg-gray-100 z-10">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_activities as $activity)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-2 px-2 break-words">{{ $activity->description ?? ($activity->activity ?? '-') }}</td>
                                    <td class="py-2 px-2 text-xs text-gray-500">{{ $activity->created_at ? $activity->created_at->format('d-m-Y H:i') : '' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="2" class="text-gray-400 py-2 px-2">Belum ada aktivitas.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // PIE CHART: Distribusi Status Testing (Open, On Progress, Waiting, Pass, Failed)
            var pieCanvas = document.getElementById('statusPieChart');
            if (pieCanvas && window.Chart) {
                new Chart(pieCanvas.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: ['Open', 'On Progress', 'Waiting Confirmation', 'Pass', 'Failed'],
                        datasets: [{
                            data: [
                                {{ $stat_qc_open ?? 0 }},
                                {{ $stat_qc_onprogress ?? 0 }},
                                {{ $stat_qc_waiting ?? 0 }},
                                {{ $stat_qc_pass ?? 0 }},
                                {{ $stat_qc_failed ?? 0 }}
                            ],
                            backgroundColor: [
                                '#ef4444', // Open
                                '#f59e42', // On Progress
                                '#a21caf', // Waiting Confirmation
                                '#22c55e', // Pass
                                '#800000'  // Failed
                            ],
                        }]
                    },
                    options: {
                        responsive: false,
                        plugins: {
                            legend: { position: 'bottom' },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        var data = context.dataset.data;
                                        var total = data.reduce((a, b) => a + b, 0);
                                        var value = context.parsed;
                                        var percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                        return percent + '%';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // BAR/LINE/AREA/RADAR/DOUGHNUT CHART: Jumlah Test Case per Bulan
            var barCanvas = document.getElementById('testcaseBarChart');
            var chartTypeSelect = document.getElementById('chartType');
            var chartType = chartTypeSelect ? chartTypeSelect.value : 'bar';
            var testcaseChart;
            function renderTestcaseChart(type) {
                if (testcaseChart) testcaseChart.destroy();
                var chartTypeForChart = type === 'area' ? 'line' : type;
                var datasetOptions = {
                    label: 'Jumlah Test Case',
                    data: [
                        {{ $testcase_per_month_array[1] ?? 0 }},
                        {{ $testcase_per_month_array[2] ?? 0 }},
                        {{ $testcase_per_month_array[3] ?? 0 }},
                        {{ $testcase_per_month_array[4] ?? 0 }},
                        {{ $testcase_per_month_array[5] ?? 0 }},
                        {{ $testcase_per_month_array[6] ?? 0 }},
                        {{ $testcase_per_month_array[7] ?? 0 }},
                        {{ $testcase_per_month_array[8] ?? 0 }},
                        {{ $testcase_per_month_array[9] ?? 0 }},
                        {{ $testcase_per_month_array[10] ?? 0 }},
                        {{ $testcase_per_month_array[11] ?? 0 }},
                        {{ $testcase_per_month_array[12] ?? 0 }}
                    ],
                    backgroundColor: chartTypeForChart === 'radar' ? 'rgba(59,130,246,0.3)' : (chartTypeForChart === 'doughnut' ? [
                        '#3B82F6','#60A5FA','#2563EB','#1E40AF','#f59e42','#22c55e','#a21caf','#800000','#FFD700','#FF69B4','#00CED1','#FFA500'] : '#3B82F6'),
                    borderColor: '#3B82F6',
                    fill: type === 'area',
                    tension: 0.3
                };
                testcaseChart = new Chart(barCanvas.getContext('2d'), {
                    type: chartTypeForChart,
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [datasetOptions]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: type === 'radar' || type === 'doughnut' },
                        },
                        scales: (type === 'doughnut' || type === 'radar') ? {} : {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }
            if (barCanvas && window.Chart) {
                renderTestcaseChart(chartType);
                if (chartTypeSelect) {
                    chartTypeSelect.addEventListener('change', function() {
                        renderTestcaseChart(this.value);
                    });
                }
            }
        });
    </script>
</body>
</html>
