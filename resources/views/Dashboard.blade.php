<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 relative min-h-screen overflow-x-hidden">
    <div class="absolute top-0 left-0 w-1/2 h-1/2 pointer-events-none z-0">
        <svg viewBox="0 0 400 400" fill="none" class="w-full h-full opacity-30">
            <circle cx="200" cy="200" r="200" fill="#3B82F6"/>
            <ellipse cx="320" cy="80" rx="80" ry="40" fill="#60A5FA" />
            <ellipse cx="80" cy="320" rx="60" ry="30" fill="#2563EB" />
        </svg>
    </div>
    <div class="absolute bottom-0 right-0 w-1/3 h-1/3 pointer-events-none z-0">
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

        <!-- User Info Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl shadow-lg p-8 mb-8 flex flex-col md:flex-row items-center md:items-start gap-6 text-white">
            <div class="flex-shrink-0 flex items-center justify-center w-20 h-20 rounded-full bg-blue-800 bg-opacity-30">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <div>
                <div class="text-2xl font-bold mb-1">{{ auth()->user()->name ?? '-' }}</div>
                <div class="text-lg mb-1">Username: <span class="font-semibold">{{ auth()->user()->username ?? '-' }}</span></div>
                <div class="text-base mb-1">Email: <span class="font-semibold">{{ auth()->user()->email ?? '-' }}</span></div>
                <div class="text-base">Role: <span class="font-semibold">{{ auth()->user()->role ?? '-' }}</span></div>
            </div>
        </div>

        <x-alert-success />

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

        <!-- Status Progres Testing, Pie Chart, dan Aktivitas Terakhir -->
        <div class="flex flex-col lg:flex-row gap-8 mb-8">
            <!-- Status Progress Testing -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex-[3_3_0%]">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-xl font-bold text-gray-800">Status Progress Testing</div>
                </div>
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
                                <td class="py-2 px-4 text-gray-900">{{ $stat_testcase_open ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#f59e42"></span>
                                        <span class="font-semibold text-gray-700">On Progress</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_testcase_onprogress ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#a21caf"></span>
                                        <span class="font-semibold text-gray-700">Waiting Confirmation</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_testcase_waiting ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#22c55e"></span>
                                        <span class="font-semibold text-gray-700">Pass</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_testcase_pass ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4">
                                    <div class="flex items-center rounded-lg bg-gray-100 px-3 py-1 w-max">
                                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color:#800000"></span>
                                        <span class="font-semibold text-gray-700">Failed</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-gray-900">{{ $stat_testcase_failed ?? 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pie Chart: Distribusi Status Testing -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center flex-[3_3_0%] min-w-[260px]">
                <div class="text-lg font-bold text-gray-800 mb-4">Distribusi Status Testing</div>
                <canvas id="statusPieChart" width="240" height="240"></canvas>
            </div>
            <!-- Aktivitas Terakhir -->
            <div class="bg-white rounded-xl shadow-lg p-6 flex-[7_7_0%]">
                <div class="text-xl font-bold mb-4 text-gray-800">Aktivitas Terakhir</div>
                <div class="space-y-2">
                    @forelse($recent_activities as $activity)
                        <div class="grid grid-cols-12 gap-2 items-start text-sm">
                            <div class="col-span-8 flex items-start">
                                <span class="mr-2 flex items-center h-full pt-0.1">•</span>
                                <span class="text-gray-700 break-words">{{ $activity->description }}</span>
                            </div>
                            <div class="col-span-4 text-xs text-gray-400 text-right">
                                {{ $activity->created_at ? $activity->created_at->format('d-m-Y H:i') : '' }}
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-400 text-sm">Belum ada aktivitas.</div>
                    @endforelse
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
                                {{ $stat_testcase_open ?? 0 }},
                                {{ $stat_testcase_onprogress ?? 0 }},
                                {{ $stat_testcase_waiting ?? 0 }},
                                {{ $stat_testcase_pass ?? 0 }},
                                {{ $stat_testcase_failed ?? 0 }}
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
        });
    </script>
</body>
</html>
