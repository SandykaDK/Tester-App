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
            z-index: 2;
        }
        .sticky-col-2 {
            position: sticky;
            left: 48px; /* width of first column (checkbox) */
            background: #fff;
            z-index: 2;
        }
        /* Adjust for header z-index */
        thead .sticky-col, thead .sticky-col-2 {
            z-index: 3;
        }
        /* Optional: add right border for sticky columns */
        .sticky-col, .sticky-col-2 {
            box-shadow: 2px 0 0 gray-100;
        }
        /* Sidebar always on top */
        .sidebar-maximized,
        .sidebar-minimized {
            z-index: 10 !important;
        }
        /* Saat modal konfirmasi hapus aktif, sidebar di belakang overlay */
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
        <x-confirm-delete />

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
                    <button type="button" id="delete-selected-btn" class="mt-6 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                    <button type="button" id="save-all-btn" class="mt-6 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
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
                            <th class="px-2 py-3 border text-center sticky-col bg-gray-100" style="min-width:48px;max-width:48px;width:48px;">
                                <input type="checkbox" id="select-all-checkbox" />
                            </th>
                            <th class="px-4 py-3 border min-w-[120px] sticky-col-2 bg-gray-100" style="min-width:80px;">No</th>
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
                            <td class="px-2 py-3 border text-center sticky-col" style="min-width:48px;max-width:48px;width:48px;">
                                <input type="checkbox" class="row-checkbox" value="{{ $testCase->id }}" />
                            </td>
                            <td class="px-3 py-3 border text-center whitespace-pre-line sticky-col-2" style="min-width:120px;">{{ $testCases->firstItem() + $i }}</td>
                            <!-- Aplikasi dropdown -->
                            <td class="px-3 py-3 border min-w-[220px]" data-field="app_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[210px]" data-field="app_key">
                                    <option value="">- Pilih -</option>
                                    @foreach($applications as $app)
                                        <option value="{{ $app->id }}" {{ $testCase->app_key == $app->id ? 'selected' : '' }}>{{ $app->app_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- Modul dropdown -->
                            <td class="px-3 py-3 border min-w-[220px]" data-field="modul_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[210px]" data-field="modul_key">
                                    <option value="">- Pilih -</option>
                                    @foreach($modules as $modul)
                                        <option value="{{ $modul->id }}" {{ $testCase->modul_key == $modul->id ? 'selected' : '' }}>{{ $modul->modul_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- Menu dropdown -->
                            <td class="px-3 py-3 border min-w-[320px] min-w-\[320px\]" data-field="menu_key">
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[310px] min-w-\[310px\]" data-field="menu_key">
                                    <option value="">- Pilih -</option>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $testCase->menu_key == $menu->id ? 'selected' : '' }}>{{ $menu->menu_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- PIC Dev dropdown -->
                            <td class="px-3 py-3 border min-w-[200px]" data-field="pic_dev">
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[190px]" data-field="pic_dev">
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
                                    class="inline-edit-date w-full border rounded px-1 py-0.5 text-sm text-left"
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
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[170px]" data-field="status_from_qc">
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
                                <select class="inline-edit-select w-full border rounded px-1 py-0.5 text-sm min-w-[170px]" data-field="status_from_dev">
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
                    const action = this.getAttribute('data-action');
                    if (typeof window.showConfirmDeleteModal === 'function') {
                        window.showConfirmDeleteModal(action);
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
                        const id = row.getAttribute('data-id');
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
                            alert('Semua data berhasil disimpan!');
                            location.reload();
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

            // Checkbox select all
            const selectAll = document.getElementById('select-all-checkbox');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    document.querySelectorAll('.row-checkbox').forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                });
            }

            // Hapus data terpilih
            const deleteSelectedBtn = document.getElementById('delete-selected-btn');
            let idsToDelete = [];
            if (deleteSelectedBtn) {
                deleteSelectedBtn.addEventListener('click', function () {
                    idsToDelete = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb.value);
                    if (idsToDelete.length === 0) {
                        alert('Pilih data yang ingin dihapus!');
                        return;
                    }
                    if (!confirm('Yakin ingin menghapus data terpilih?')) return;
                    fetch("{{ route('test-cases-new.bulk-delete') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ ids: idsToDelete })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus data!');
                        }
                    })
                    .catch(() => alert('Terjadi kesalahan saat menghapus data.'));
                });
            }
        });

        // Fungsi showConfirmDeleteModal untuk bulk delete
        function showConfirmDeleteModal() {
            const modal = document.getElementById('confirmDeleteModal');
            if (!modal) {
                if (confirm('Yakin ingin menghapus data terpilih?')) doBulkDelete();
                return;
            }
            document.body.classList.add('confirm-delete-active');
            modal.classList.remove('hidden');
            // Ganti form submit dengan AJAX
            const form = modal.querySelector('form');
            const okBtn = form.querySelector('button[type="submit"]');
            const cancelBtn = modal.querySelector('.cancel-delete');
            // Simpan handler agar tidak double
            if (!form.dataset.bulkHandler) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    doBulkDelete();
                    modal.classList.add('hidden');
                    document.body.classList.remove('confirm-delete-active');
                });
                form.dataset.bulkHandler = "1";
            }
            cancelBtn.addEventListener('click', function () {
                modal.classList.add('hidden');
                document.body.classList.remove('confirm-delete-active');
            });
        }

        function doBulkDelete() {
            fetch("{{ route('test-cases-new.bulk-delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ ids: idsToDelete })
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus data!');
                }
            })
            .catch(() => alert('Terjadi kesalahan saat menghapus data.'));
        }
    </script>
</body>
</html>
