<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Developer</title>
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
            <a href="{{ route('developers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Kembali</a>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Edit Developer</h1>
            </div>
            <form method="POST" action="{{ route('developers.update', $developer->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="dev_name" class="block text-sm font-medium text-gray-700">Nama Developer</label>
                    <input type="text" name="dev_name" id="dev_name" value="{{ $developer->dev_name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="dev_email" class="block text-sm font-medium text-gray-700">Email Developer</label>
                    <textarea name="dev_email" id="dev_email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $developer->dev_email }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="dev_app" class="block text-sm font-medium text-gray-700">Aplikasi Developer</label>
                    <div class="mt-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($applications as $application)
                            <div class="flex items-center bg-white p-2 rounded shadow-sm border border-gray-200">
                                <input type="checkbox" name="dev_app[]" id="dev_app_{{ $application->id }}" value="{{ $application->id }}" {{ in_array($application->id, $developer->applications->pluck('id')->toArray()) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                <label for="dev_app_{{ $application->id }}" class="ml-2 block text-sm text-gray-900">{{ $application->app_name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
