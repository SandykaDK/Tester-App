<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Screen Format</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .sidebar-maximized {
            width: 280px;
        }
        .sidebar-minimized {
            width: 120px;
        }
        .sidebar-minimized .sidebar-content {
            display: none;
        }
        .sidebar-minimized .sidebar-header,
        .sidebar-minimized .sidebar-toggle {
            justify-content: center;
        }
    </style>
</head>
<body class="bg-gray-100 relative min-h-screen overflow-x-hidden">
    <!-- Decorative vector art (SVG) for background, selaras dengan login/dashboard -->
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
    <div id="sidebar" class="sidebar-maximized bg-white shadow-md transition-all duration-300 flex flex-col justify-between">
        <x-sidebar />
    </div>
    <div class="main-content flex-1 p-6 relative z-10">
        <div class="flex justify-end items-center mb-4">
            <x-profile-section />
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Screen Format</h1>
            <x-alert-success />
            <x-alert-failure />
            <div class="mb-4 flex justify-between items-end">
                <form method="GET" action="{{ route('screen-format.index') }}" class="flex items-end space-x-4">
                    <div>
                        <label for="file_name" class="block text-sm font-medium text-gray-700">Nama File</label>
                        <input type="text" name="file_name" id="file_name" value="{{ request('file_name') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                <a href="{{ route('screen-format.create') }}" class="mt-6 px-3 py-1 bg-green-500 text-white rounded hover:bg-green-700 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Upload
                </a>
            </div>
            <div class="overflow-x-auto">
                <div class="overflow-y-auto" style="max-height: 400px;">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr class="bg-gray-50">
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama File</th>
                                <th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($files as $index => $file)
                                <tr class="hover:bg-gray-100">
                                    <td class="py-2 px-4 text-sm font-medium text-gray-900">{{ ($files->firstItem() ?? 0) + $index }}</td>
                                    <td class="py-2 px-4 text-sm font-medium text-gray-900">{{ $file->scr_name }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-500">
                                        <div class="flex space-x-2">
                                            {{-- Download (jika ada fitur download, sesuaikan routenya) --}}
                                            {{-- <a href="{{ route('screen-format.download', $file->id) }}" class="inline-block p-2 bg-blue-500 text-white rounded hover:bg-blue-700" title="Download"> --}}
                                            {{--     ...icon... --}}
                                            {{-- </a> --}}
                                            <a href="{{ route('screen-format.edit', $file->id) }}" class="inline-block p-2 bg-yellow-400 text-white rounded hover:bg-yellow-700" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-1.5a2.25 2.25 0 1 1 3.182 3.182L9 21H5.25v-3.75L16.732 6.732z" />
                                                </svg>
                                            </a>
                                            <button type="button" class="delete-button inline-block p-2 bg-red-500 text-white rounded hover:bg-red-700" data-action="{{ route('screen-format.destroy', $file->id) }}" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 px-4 text-center text-gray-500">Tidak ada file ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 flex justify-between items-center">
                <div>
                    <label for="items_per_page" class="block text-[10px] font-medium text-gray-700 leading-tight mb-1">Tampilkan</label>
                    <select id="items_per_page" name="items_per_page"
                        class="mt-0 block w-[60px] border border-gray-300 rounded-md shadow-sm py-0.5 px-1.5 text-[11px] focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        onchange="location = this.value;">
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 10]) }}" {{ request('items_per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 25]) }}" {{ request('items_per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 50]) }}" {{ request('items_per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="{{ request()->fullUrlWithQuery(['items_per_page' => 100]) }}" {{ request('items_per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="flex flex-col items-end text-[10px] space-y-1">
                    <div>
                        <div class="pagination text-[10px]">
                            {{ $files->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Confirm Delete Modal --}}
    <x-confirm-delete/>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const action = this.getAttribute('data-action');
                    // Panggil fungsi global dari komponen confirm-delete
                    if (typeof window.showConfirmDeleteModal === 'function') {
                        window.showConfirmDeleteModal(action);
                    }
                });
            });
        });
    </script>
</body>
</html>
