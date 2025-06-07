<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Testing Baru</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <style>
        .inline-edit-select {
            min-width: 100%;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Perlu !important agar Tailwind tidak override min-width custom */
        .min-w-\[320px\] { min-width: 320px !important; }
        .min-w-\[310px\] { min-width: 310px !important; }
        .min-w-\[480px\] { min-width: 480px !important; }
        .min-w-\[500px\] { min-width: 500px !important; }
        .min-w-\[210px\] { min-width: 210px !important; }
        .min-w-\[220px\] { min-width: 220px !important; }
        .min-w-\[170px\] { min-width: 170px !important; }
        .min-w-\[190px\] { min-width: 190px !important; }
        .min-w-\[200px\] { min-width: 200px !important; }
        /* Sticky columns for table */
        .sticky-col {
            position: sticky;
            left: 0;
            background: #fff;
            z-index: 10;
            border-top: 1px solid #e5e7eb !important;
            border-bottom: 1px solid #e5e7eb !important;
            border-left: 1px solid #e5e7eb !important;
            border-right: 1px solid #e5e7eb !important;
        }
        .sticky-col-2 {
            position: sticky;
            left: 44px !important;
            background: #fff;
            z-index: 9;
        }

        thead .sticky-col, thead .sticky-col-2 {
            z-index: 3;
            background: #f3f4f6 !important;/
            opacity: 1 !important;
        }
        .sticky-col, .sticky-col-2 {
            box-shadow: none !important;
        }

        .sidebar-maximized,
        .sidebar-minimized {
            z-index: 11 !important;
        }
        body.confirm-delete-active,
        body.confirm-delete-active {
            z-index: 51 !important;
        }
    </style>
</head>
<body class="bg-gray-100 relative min-h-screen overflow-x-hidden">
    <!-- Background SVGs -->
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
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar-maximized bg-white shadow-md transition-all duration-300 flex flex-col justify-between fixed">
        <x-sidebar />
    </div>

    <div class="main-content flex-1 p-6 ml-64 relative z-5">
        <div class="flex justify-end items-center mb-4">
            <x-profile-section />
        </div>

        <x-alert-success />
        <x-alert-failure />
        <x-alert-success-delete />

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Manajemen Testing Baru</h1>
            <div class="mb-4 flex justify-between items-end">
                <form method="GET" action="{{ route('applications.index') }}" class="flex items-end space-x-4">
                    <div>
                        <label for="application_name" class="block text-sm font-medium text-gray-700">Nama Aplikasi</label>
                        <input type="text" name="app_name" id="application_name" value="{{ request('app_name') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="created_at" class="block text-sm font-medium text-gray-700">Bulan & Tahun</label>
                        <input type="month" name="created_at" id="created_at" value="{{ request('created_at') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <button type="submit" class="mt-6 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
                <div class="flex items-center space-x-2">
                    <button type="button" id="save-all-btn" class="mt-6 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center">
                        <!-- SVG simpan custom -->
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff" class="w-4 h-4 mr-1">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path d="M16.765 2c1.187 0 1.363.06 1.51.168L21.662 4.7a.845.845 0 0 1 .339.677v15.78a.844.844 0 0 1-.844.844H2.844A.844.844 0 0 1 2 21.156V2.844A.844.844 0 0 1 2.844 2zM17 21v-7H7v7zM14 3v3h1V3zM7 3v6h10V3h-1v4h-3V3zM3 21h3v-8h12v8h3V5.452l-3-2.278v6.17a.769.769 0 0 1-.844.656H6.844A.769.769 0 0 1 6 9.344V3H3z"></path>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                            </g>
                        </svg>
                        Simpan
                    </button>
                    <button type="button" id="add-row-btn" class="mt-6 px-3 py-1 bg-green-500 text-white rounded hover:bg-green-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="editable-table" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-100 text-xs text-gray-700 uppercase">
                            <th class="border text-center align-middle sticky-col z-10" style="min-width:46px;max-width:46px;width:46px;left:0;">
                                Aksi
                            </th>
                            <th class="px-4 py-3 border min-w-[100px] sticky-col-2" style="min-width:80px;">No</th>
                            <th class="px-4 py-3 border min-w-[220px]">Aplikasi</th>
                            <th class="px-4 py-3 border min-w-[220px]">Modul</th>
                            <th class="px-4 py-3 border min-w-[320px] min-w-\[320px\]">Menu</th>
                            <th class="px-4 py-3 border min-w-[200px]">PIC Dev</th>
                            <th class="px-4 py-3 border min-w-[170px]">Test Date</th>
                            <th class="px-4 py-3 border min-w-[220px]">Test Scenario</th>
                            <th class="px-4 py-3 border min-w-[200px]">Test Data</th>
                            <th class="px-4 py-3 border min-w-[200px]">Test Step</th>
                            <th class="px-4 py-3 border min-w-[220px]">Expected Result</th>
                            <th class="px-4 py-3 border min-w-[220px]">Result</th>
                            <th class="px-4 py-3 border min-w-[180px]">Status From QC</th>
                            <th class="px-4 py-3 border min-w-[200px]">Evidence</th>
                            <th class="px-4 py-3 border min-w-[200px]">Catatan</th>
                            <th class="px-4 py-3 border min-w-[180px]">Status From Dev</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testCases as $i => $testCase)
                        <tr data-id="{{ $testCase->id }}">
                            <td class="border text-center align-middle sticky-col z-10 bg-white" style="min-width:44px;max-width:44px;width:44px;left:0;">
                                <div class="flex items-center justify-center h-full">
                                    <button type="button"
                                        class="delete-row-btn flex items-center justify-center bg-red-500 hover:bg-red-700 text-white rounded w-7 h-7 focus:outline-none focus:ring-2 focus:ring-red-400"
                                        data-id="{{ $testCase->id }}" title="Hapus">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" class="w-4 h-4">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M14 10V17M10 10V17" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-3 py-3 border text-center whitespace-pre-line sticky-col-2 bg-white" style="min-width:120px;">{{ $testCases->firstItem() + $i }}</td>
                            <!-- Aplikasi dropdown -->
                            <td class="px-3 py-3 border min-w-[220px]" data-field="app_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[210px] app-select" data-field="app_key">
                                    <option value="">- Pilih -</option>
                                    @foreach($applications as $app)
                                        <option value="{{ $app->id }}" {{ $testCase->app_key == $app->id ? 'selected' : '' }}>{{ $app->app_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- Modul dropdown -->
                            <td class="px-3 py-3 border min-w-[220px]" data-field="modul_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[210px] modul-select" data-field="modul_key" data-selected="{{ $testCase->modul_key }}">
                                    <option value="">- Pilih -</option>
                                    @foreach($modules as $modul)
                                        <option value="{{ $modul->id }}" data-app-id="{{ $modul->application_id }}" {{ $testCase->modul_key == $modul->id ? 'selected' : '' }}>{{ $modul->modul_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- Menu dropdown -->
                            <td class="px-3 py-3 border min-w-[320px] min-w-\[320px\]" data-field="menu_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[310px] min-w-\[310px\] menu-select" data-field="menu_key" data-selected="{{ $testCase->menu_key }}">
                                    <option value="">- Pilih -</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" data-modul-id="{{ $menu->modul_id }}" {{ $testCase->menu_key == $menu->id ? 'selected' : '' }}>{{ $menu->menu_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- PIC Dev dropdown -->
                            <td class="px-3 py-3 border min-w-[200px]" data-field="pic_dev">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[190px]" data-field="pic_dev">
                                    <option value="">- Pilih -</option>
                                    @foreach($developers as $dev)
                                        <option value="{{ $dev->id }}" {{ $testCase->pic_dev == $dev->id ? 'selected' : '' }}>{{ $dev->dev_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- Test Date: input type date -->
                            <td class="px-3 py-3 border text-center align-middle" data-field="test_date">
                                <input
                                    type="date"
                                    class="inline-edit-date w-full border rounded px-1 py-2 text-sm text-left"
                                    data-field="test_date"
                                    value="{{ $testCase->test_date }}"
                                    style="min-width: 150px;"
                                />
                            </td>

                            <td class="px-3 py-3 border whitespace-pre-line" contenteditable="true" data-field="test_scenario">{{ $testCase->test_scenario }}</td>
                            <td class="px-3 py-3 border whitespace-pre-line" contenteditable="true" data-field="test_data">{{ $testCase->test_data }}</td>
                            <td class="px-3 py-3 border whitespace-pre-line" contenteditable="true" data-field="test_step">{{ $testCase->test_step }}</td>
                            <td class="px-3 py-3 border whitespace-pre-line" contenteditable="true" data-field="expected_result">{{ $testCase->expected_result }}</td>
                            <td class="px-3 py-3 border whitespace-pre-line" contenteditable="true" data-field="result">{{ $testCase->result }}</td>
                            <!-- Status From QC dropdown -->
                            <td class="px-3 py-3 border min-w-[180px]" data-field="status_from_qc">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[170px]" data-field="status_from_qc">
                                    <option value="">- Pilih -</option>
                                    <option value="open" {{ $testCase->status_from_qc == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="ready_to_install" {{ $testCase->status_from_qc == 'ready_to_install' ? 'selected' : '' }}>Ready To Install</option>
                                    <option value="hold" {{ $testCase->status_from_qc == 'hold' ? 'selected' : '' }}>Hold</option>
                                    <option value="re_open" {{ $testCase->status_from_qc == 're_open' ? 'selected' : '' }}>Re-Open</option>
                                    <option value="on_progress" {{ $testCase->status_from_qc == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                                    <option value="cancelled_by_user" {{ $testCase->status_from_qc == 'cancelled_by_user' ? 'selected' : '' }}>Cancelled by User</option>
                                    <option value="pass" {{ $testCase->status_from_qc == 'pass' ? 'selected' : '' }}>Pass</option>
                                </select>
                            </td>
                            <!-- Evidence -->
                            <td class="px-3 py-3 border min-w-[200px] whitespace-pre-line" contenteditable="true" data-field="evidence">{{ $testCase->evidence }}</td>
                            <!-- Catatan -->
                            <td class="px-3 py-3 border min-w-[200px] whitespace-pre-line" contenteditable="true" data-field="note">{{ $testCase->note }}</td>
                            <!-- Status From Dev dropdown -->
                            <td class="px-3 py-3 border min-w-[180px]" data-field="status_from_dev">
                                <select class="inline-edit-select w-full border rounded px-1 py-2 text-sm min-w-[170px]" data-field="status_from_dev">
                                    <option value="">- Pilih -</option>
                                    <option value="open" {{ $testCase->status_from_dev == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="hold" {{ $testCase->status_from_dev == 'hold' ? 'selected' : '' }}>Hold</option>
                                    <option value="waiting_confirmation" {{ $testCase->status_from_dev == 'waiting_confirmation' ? 'selected' : '' }}>Waiting Confirmation</option>
                                    <option value="on_progress" {{ $testCase->status_from_dev == 'on_progress' ? 'selected' : '' }}>On Progress</option>
                                    <option value="re_open" {{ $testCase->status_from_dev == 're_open' ? 'selected' : '' }}>Re-Open</option>
                                    <option value="ready_to_test" {{ $testCase->status_from_dev == 'ready_to_test' ? 'selected' : '' }}>Ready To Test</option>
                                    <option value="installed" {{ $testCase->status_from_dev == 'installed' ? 'selected' : '' }}>Installed</option>
                                    <option value="cancelled_by_user" {{ $testCase->status_from_dev == 'cancelled_by_user' ? 'selected' : '' }}>Cancelled by User</option>
                                    <option value="closed" {{ $testCase->status_from_dev == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div>
                    {{-- Hapus tombol tambah data --}}
                    <label for="items_per_page" class="block text-sm font-medium text-gray-700">Tampilkan</label>
                    <select id="items_per_page" name="items_per_page" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" onchange="location = this.value;">
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 10]) }}" {{ request('items_per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 25]) }}" {{ request('items_per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 50]) }}" {{ request('items_per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 100]) }}" {{ request('items_per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div>
                    {{ $testCases->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    // Ambil ID dari data-id atau data-action
                    const rowId = this.getAttribute('data-id');
                    if (!rowId) return;
                    // Simpan ID ke array agar bisa dipakai di doBulkDelete
                    window.idsToDelete = [rowId];
                    if (typeof window.showConfirmDeleteModal === 'function') {
                        window.showConfirmDeleteModal();
                    }
                });
            });

            // Dependent dropdowns for create row
            const appSelect = document.getElementById('create-app_key');
            const modulSelect = document.getElementById('create-modul_key');
            const menuSelect = document.getElementById('create-menu_key');
            if (appSelect && modulSelect && menuSelect) {
                appSelect.addEventListener('change', function () {
                    const appId = this.value;
                    modulSelect.disabled = !appId;
                    modulSelect.innerHTML = '<option value="">Pilih Modul</option>';
                    menuSelect.disabled = true;
                    menuSelect.innerHTML = '<option value="">Pilih Menu</option>';
                    @foreach ($modules as $module)
                        if (appId == '{{ $module->application_id }}') {
                            modulSelect.innerHTML += `<option value="{{ $module->id }}">{{ $module->modul_name }}</option>`;
                        }
                    @endforeach
                });
                modulSelect.addEventListener('change', function () {
                    const modulId = this.value;
                    menuSelect.disabled = !modulId;
                    menuSelect.innerHTML = '<option value="">Pilih Menu</option>';
                    @foreach ($menus as $menu)
                        if (modulId == '{{ $menu->modul_id }}') {
                            menuSelect.innerHTML += `<option value="{{ $menu->id }}">{{ $menu->menu_name }}</option>`;
                        }
                    @endforeach
                });
            }

            // Create row save
            const createSaveBtn = document.getElementById('create-save-btn');
            if (createSaveBtn) {
                createSaveBtn.addEventListener('click', function () {
                    const data = {
                        app_key: appSelect.value,
                        modul_key: modulSelect.value,
                        menu_key: menuSelect.value,
                        status: document.getElementById('create-status').value,
                        pic_dev: document.getElementById('create-pic_dev').value,
                        test_date: document.getElementById('create-test_date').value,
                        // Tambahkan field lain jika perlu
                    };
                    fetch("{{ route('test-cases-new.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            location.reload();
                        } else {
                            alert('Gagal menambah data!');
                        }
                    })
                    .catch(() => alert('Terjadi kesalahan saat menambah data.'));
                });
            }

            // Inline edit save all
            const saveAllBtn = document.getElementById('save-all-btn');
            if (saveAllBtn) {
                saveAllBtn.addEventListener('click', function () {
                    const rows = document.querySelectorAll('#editable-table tbody tr[data-id]');
                    let promises = [];
                    rows.forEach(row => {
                        let id = row.getAttribute('data-id');
                        let data = {};
                        // Ambil semua value dari select dropdown
                        row.querySelectorAll('select.inline-edit-select').forEach(sel => {
                            data[sel.getAttribute('data-field')] = sel.value;
                        });
                        // Ambil semua value dari input date
                        row.querySelectorAll('input.inline-edit-date').forEach(input => {
                            data[input.getAttribute('data-field')] = input.value;
                        });
                        // Ambil semua value dari contenteditable
                        row.querySelectorAll('[contenteditable="true"]').forEach(cell => {
                            data[cell.getAttribute('data-field')] = cell.innerText.trim();
                        });
                        promises.push(
                            fetch(`/test-cases-new/${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify(data)
                            })
                        );
                    });
                    Promise.all(promises)
                        .then(() => {
                            window.location = window.location.pathname + '?success=1';
                        })
                        .catch(() => alert('Terjadi kesalahan saat menyimpan beberapa data.'));
                });
            }

            // Inline edit for select, contenteditable, and date input
            document.querySelectorAll('#editable-table tbody').forEach(function(tbody) {
                tbody.addEventListener('change', function(e) {
                    if (
                        e.target.classList.contains('inline-edit-select') ||
                        e.target.classList.contains('inline-edit-date')
                    ) {
                        const row = e.target.closest('tr');
                        const id = row.getAttribute('data-id');
                        let data = {};
                        row.querySelectorAll('select.inline-edit-select').forEach(sel => {
                            data[sel.getAttribute('data-field')] = sel.value;
                        });
                        row.querySelectorAll('input.inline-edit-date').forEach(input => {
                            data[input.getAttribute('data-field')] = input.value;
                        });
                        row.querySelectorAll('[contenteditable="true"]').forEach(cell => {
                            data[cell.getAttribute('data-field')] = cell.innerText.trim();
                        });
                        fetch(`/test-cases-new/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        });
                    }
                });

                tbody.addEventListener('blur', function(e) {
                    if (e.target.hasAttribute('contenteditable')) {
                        const row = e.target.closest('tr');
                        const id = row.getAttribute('data-id');
                        let data = {};
                        row.querySelectorAll('select.inline-edit-select').forEach(sel => {
                            data[sel.getAttribute('data-field')] = sel.value;
                        });
                        row.querySelectorAll('input.inline-edit-date').forEach(input => {
                            data[input.getAttribute('data-field')] = input.value;
                        });
                        row.querySelectorAll('[contenteditable="true"]').forEach(cell => {
                            data[cell.getAttribute('data-field')] = cell.innerText.trim();
                        });
                        fetch(`/test-cases-new/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        });
                    }
                }, true);
            });

            // Tombol tambah baris kosong (insert ke DB, reload)
            const addRowBtn = document.getElementById('add-row-btn');
            if (addRowBtn) {
                addRowBtn.addEventListener('click', function () {
                    fetch("{{ route('test-cases-new.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({})
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            location.reload();
                        } else {
                            alert('Gagal menambah data!');
                        }
                    })
                    .catch(() => alert('Terjadi kesalahan saat menambah data.'));
                });
            }

            // Inline table: Dependent dropdowns for modul based on aplikasi
            document.querySelectorAll('#editable-table tbody tr').forEach(function(row) {
                const appSelect = row.querySelector('.app-select');
                const modulSelect = row.querySelector('.modul-select');
                const menuSelect = row.querySelector('.menu-select');
                if (appSelect && modulSelect) {
                    // Save all modul options for this row
                    const allModulOptions = Array.from(modulSelect.querySelectorAll('option'));
                    // --- FILTER MODUL ON PAGE LOAD ---
                    const selectedAppId = appSelect.value;
                    if (selectedAppId) {
                        modulSelect.innerHTML = '';
                        modulSelect.appendChild(allModulOptions[0].cloneNode(true)); // "- Pilih -"
                        allModulOptions.slice(1).forEach(opt => {
                            if (opt.getAttribute('data-app-id') == selectedAppId) {
                                modulSelect.appendChild(opt.cloneNode(true));
                            }
                        });
                        // Restore selected value if still available
                        if ([...modulSelect.options].some(o => o.value == modulSelect.getAttribute('data-selected'))) {
                            modulSelect.value = modulSelect.getAttribute('data-selected');
                        } else {
                            modulSelect.value = '';
                        }
                    }
                    // --- END FILTER MODUL ON PAGE LOAD ---

                    appSelect.addEventListener('change', function() {
                        const appId = this.value;
                        modulSelect.innerHTML = '';
                        modulSelect.appendChild(allModulOptions[0].cloneNode(true)); // "- Pilih -"
                        allModulOptions.slice(1).forEach(opt => {
                            if (opt.getAttribute('data-app-id') == appId) {
                                modulSelect.appendChild(opt.cloneNode(true));
                            }
                        });
                        modulSelect.value = '';
                        // Reset menu as well
                        if (menuSelect) {
                            menuSelect.value = '';
                        }
                        modulSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    });
                }

                // Menu dropdown: filter by modul
                if (modulSelect && menuSelect) {
                    const allMenuOptions = Array.from(menuSelect.querySelectorAll('option'));
                    // --- FILTER MENU ON PAGE LOAD ---
                    const selectedModulId = modulSelect.value;
                    if (selectedModulId) {
                        menuSelect.innerHTML = '';
                        menuSelect.appendChild(allMenuOptions[0].cloneNode(true)); // "- Pilih -"
                        allMenuOptions.slice(1).forEach(opt => {
                            if (opt.getAttribute('data-modul-id') == selectedModulId) {
                                menuSelect.appendChild(opt.cloneNode(true));
                            }
                        });
                        // Restore selected value if still available
                        if ([...menuSelect.options].some(o => o.value == menuSelect.getAttribute('data-selected'))) {
                            menuSelect.value = menuSelect.getAttribute('data-selected');
                        } else {
                            menuSelect.value = '';
                        }
                    }
                    // --- END FILTER MENU ON PAGE LOAD ---

                    modulSelect.addEventListener('change', function() {
                        const modulId = this.value;
                        menuSelect.innerHTML = '';
                        menuSelect.appendChild(allMenuOptions[0].cloneNode(true)); // "- Pilih -"
                        allMenuOptions.slice(1).forEach(opt => {
                            if (opt.getAttribute('data-modul-id') == modulId) {
                                menuSelect.appendChild(opt.cloneNode(true));
                            }
                        });
                        menuSelect.value = '';
                        menuSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    });
                }
            });

            // Tombol delete per baris
            document.querySelectorAll('.delete-row-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    if (!id) return;
                    // Debug log
                    console.log('Set idToDelete:', id);
                    window.idToDelete = id;
                    if (typeof window.showConfirmDeleteModal === 'function') {
                        window.showConfirmDeleteModal();
                    } else {
                        alert('Konfirmasi hapus tidak tersedia.');
                    }
                });
            });

            window.confirmDeleteAction = function() {
                const id = window.idToDelete;
                if (!id) {
                    alert('ID data tidak ditemukan!');
                    return;
                }
                // Debug log
                console.log('Menghapus data dengan id:', id);
                fetch("{{ url('/test-cases-new') }}/" + id, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    window.hideConfirmDeleteModal();
                    if (res.success) {
                        // Ganti location.reload() dengan redirect ke URL dengan success=1
                        const url = new URL(window.location.href);
                        url.searchParams.set('success', '1');
                        window.location.href = url.toString();
                    } else {
                        alert('Gagal menghapus data!');
                    }
                })
                .catch(() => {
                    window.hideConfirmDeleteModal();
                    alert('Terjadi kesalahan saat menghapus data.');
                });
            };
        });
    </script>
    {{-- Modal konfirmasi hapus --}}
    <x-confirm-delete-testing />
</body>
</html>
