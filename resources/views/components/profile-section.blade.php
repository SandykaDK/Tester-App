<div class="flex justify-end items-center mb-1 mr-4">
    <div class="relative flex items-center space-x-3">
        <div class="relative">
            <button id="profileDropdownBtn" class="focus:outline-none flex items-center space-x-2 px-2 py-1 rounded hover:bg-gray-100 transition">
                <svg class="w-8 h-8 text-gray-400 bg-gray-200 rounded-full p-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span class="ml-2 text-gray-700 font-semibold text-m leading-tight truncate max-w-[120px]">
                    {{ auth()->user()->username ?? '-' }}
                </span>
                <svg class="w-4 h-4 text-gray-600 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg z-50 border border-gray-100 transition-all duration-200 transform opacity-0 scale-95">
                <div class="px-4 py-3 border-b border-gray-100 break-words">
                    <div class="font-semibold text-gray-800 text-base">{{ auth()->user()->name ?? '-' }}</div>
                    <div class="text-xs text-gray-500">{{ auth()->user()->role ?? '-' }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('profileDropdownBtn');
        const dropdown = document.getElementById('profileDropdown');
        document.addEventListener('click', function(e) {
            if (btn.contains(e.target)) {
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                    setTimeout(() => {
                        dropdown.classList.remove('opacity-0', 'scale-95');
                        dropdown.classList.add('opacity-100', 'scale-100');
                    }, 10);
                } else {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200);
                }
            } else {
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('opacity-100', 'scale-100');
                    dropdown.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 200);
                }
            }
        });
    });
</script>
<style>
    #profileDropdown.opacity-100 {
        opacity: 1 !important;
        transform: scale(1) !important;
    }
    #profileDropdown.opacity-0 {
        opacity: 0 !important;
        transform: scale(0.95) !important;
    }
    #profileDropdown.scale-100 {
        transform: scale(1) !important;
    }
    #profileDropdown.scale-95 {
        transform: scale(0.95) !important;
    }
</style>
