<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('menus.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Kembali</a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Daftar Menu</h1>
            </div>
            <form method="POST" action="{{ route('menus.update', $menus->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="menu_name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                    <input type="text" name="menu_name" id="menu_name" value="{{ $menus->menu_name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('menu_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="menu_description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="menu_description" id="menu_description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $menus->menu_description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="application_id" class="block text-sm font-medium text-gray-700">Aplikasi</label>
                    <select name="application_id" id="application_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Aplikasi</option>
                        @foreach($applications as $application)
                            <option value="{{ $application->id }}" {{ $menus->application_id == $application->id ? 'selected' : '' }}>{{ $application->app_name }}</option>
                        @endforeach
                    </select>
                    @error('application_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="modul_id" class="block text-sm font-medium text-gray-700">Modul</label>
                    <select name="modul_id" id="modul_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Modul</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}" {{ $menus->modul_id == $module->id ? 'selected' : '' }}>{{ $module->modul_name }}</option>
                        @endforeach
                    </select>
                    @error('modul_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div id="version-info" class="mb-4 text-sm text-gray-700"></div>
                <div class="mb-4">
                    <label for="menu_status" class="block text-sm font-medium text-gray-700">Status Menu</label>
                    <select name="menu_status" id="menu_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="Not Started" {{ $menus->menu_status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                        <option value="On Progress" {{ $menus->menu_status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                        <option value="Active" {{ $menus->menu_status == 'Active' ? 'selected' : '' }}>Active</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-700 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('application_id').addEventListener('change', function() {
            var applicationId = this.value;
            var moduleSelect = document.getElementById('modul_id');
            moduleSelect.innerHTML = '<option value="">Pilih Modul</option>';

            if (applicationId) {
                fetch(`/api/modules/${applicationId}`)
                    .then(response => response.json())
                    .then(modules => {
                        modules.forEach(module => {
                            var option = document.createElement('option');
                            option.value = module.id;
                            option.text = module.modul_name;
                            moduleSelect.appendChild(option);
                        });
                        moduleSelect.value = "{{ $menus->modul_id }}";
                    });
            }
        });
        document.getElementById('application_id').dispatchEvent(new Event('change'));
    </script>
</body>
</html>
