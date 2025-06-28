<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Screen Format</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 relative min-h-screen overflow-x-hidden">
    <!-- Decorative vector art (SVG) for background -->
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
            <a href="{{ route('screen-format.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Kembali</a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Tambah Screen Format</h1>
            <form action="{{ route('screen-format.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="scr_file" class="block text-sm font-medium text-gray-700">Upload File</label>
                    <input type="file" name="scr_file" id="scr_file" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 @error('scr_file') border-red-500 @enderror" required>
                    @error('scr_file')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4 relative">
                    <label for="scr_menu" class="block text-sm font-medium text-gray-700">Menu</label>
                    <input type="text" id="scr_menu" value="{{ old('scr_menu') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 @error('menu_id') border-red-500 @enderror" autocomplete="off" required>
                    <input type="hidden" name="menu_id" id="menu_id" value="{{ old('menu_id') }}">
                    <div id="menu_suggestions" class="absolute z-10 bg-white border border-gray-300 rounded-md mt-1 w-full hidden"></div>
                    @error('menu_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="scr_version" class="block text-sm font-medium text-gray-700">Versi</label>
                    <input type="text" name="scr_version" id="scr_version" value="{{ old('scr_version') }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 @error('scr_version') border-red-500 @enderror" required>
                    @error('scr_version')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="scr_description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="scr_description" id="scr_description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 @error('scr_description') border-red-500 @enderror">{{ old('scr_description') }}</textarea>
                    @error('scr_description')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('scr_menu');
    const hidden = document.getElementById('menu_id');
    const suggestions = document.getElementById('menu_suggestions');
    let debounceTimeout = null;

    input.addEventListener('input', function () {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            if (input.value.length < 1) {
                suggestions.innerHTML = '';
                suggestions.classList.add('hidden');
                hidden.value = '';
                return;
            }
            fetch('/api/menus/search?q=' + encodeURIComponent(input.value))
                .then(res => res.json())
                .then(data => {
                    suggestions.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(menu => {
                            const div = document.createElement('div');
                            div.className = 'px-3 py-2 hover:bg-blue-100 cursor-pointer';
                            div.textContent = menu.menu_name;
                            div.dataset.id = menu.id;
                            div.addEventListener('mousedown', function () {
                                input.value = menu.menu_name;
                                hidden.value = menu.id;
                                suggestions.innerHTML = '';
                                suggestions.classList.add('hidden');
                            });
                            suggestions.appendChild(div);
                        });
                        suggestions.classList.remove('hidden');
                    } else {
                        suggestions.classList.add('hidden');
                    }
                });
        }, 200);
    });

    input.addEventListener('focus', function () {
        if (suggestions.innerHTML.trim() !== '') {
            suggestions.classList.remove('hidden');
        }
    });

    input.addEventListener('blur', function () {
        setTimeout(() => { suggestions.classList.add('hidden'); }, 200);
    });
});
    </script>
</body>
</html>
