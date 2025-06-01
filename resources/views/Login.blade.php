<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester App - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/TesterApp-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Decorative vector art (SVG) -->
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
    <div class="w-full max-w-3xl z-10 flex bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="hidden md:flex flex-col justify-center items-center bg-blue-50 px-8 py-12 w-1/2">
            <div class="flex items-center justify-start ml-11 mb-4 w-full">
                <img src="{{ asset('img/TesterApp-logo.png') }}" alt="Tester App Logo" class="w-20 h-12 object-contain">
                <span class="text-3xl font-extrabold text-blue-800 tracking-wide">Tester App</span>
            </div>
            <img src="{{ asset('img/Login.png') }}" alt="Login Vector" class="w-80 h-80 mb-6 object-contain">
            <h3 class="text-xl font-bold text-blue-700 mb-2">Selamat Datang!</h3>
            <p class="text-blue-600 text-center">Masuk ke aplikasi Tester App untuk mengelola testing dan bug report dengan mudah.</p>
        </div>
        <div class="flex-1 px-12 py-14 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Login</h2>
            <x-alert-success />
            @if(session('error'))
                <div class="mb-4 text-red-600 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required autofocus class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold transition">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
