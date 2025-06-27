<div class="p-6 flex items-center sidebar-header">
    <img src="{{ asset('img/TesterApp-logo.png') }}" alt="Tester App Logo" class="w-10 h-10 mr-3">
    <h1 class="text-2xl font-bold mb-6 mt-6 transition-all duration-300 sidebar-app-title">Tester App</h1>
</div>
<div class="menu-container overflow-y-auto">
    <ul class="text-gray-600 ml-4 sidebar-menu list-none">
        {{-- Dashboard: Semua role --}}
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Dashboard">
            <a href="{{ route('dashboard') }}" class="flex items-center w-full main-menu" data-target="submenu-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Dashboard</span>
            </a>
        </li>

        {{-- Master: Developer & Admin --}}
        @if(auth()->user() && (auth()->user()->role === 'Developer' || strtolower(auth()->user()->role) === 'admin'))
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Master">
            <a href="#" class="flex items-center w-full main-menu" data-target="submenu-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Master</span>
            </a>
            <ul id="submenu-2" class="ml-8 mt-2 text-gray-500 hidden submenu list-none transition-all duration-300">
                <li class="mb-2 hover:bg-gray-300 p-2 rounded"><a href="{{ route('applications.index') }}" class="block">Daftar Aplikasi</a></li>
                <li class="mb-2 hover:bg-gray-300 p-2 rounded"><a href="{{ route('modules.index') }}" class="block">Daftar Modul</a></li>
                <li class="mb-2 hover:bg-gray-300 p-2 rounded"><a href="{{ route('menus.index') }}" class="block">Daftar Menu</a></li>
                <li class="mb-2 hover:bg-gray-300 p-2 rounded"><a href="{{ route('developers.index') }}" class="block">Daftar Developer</a></li>
            </ul>
        </li>
        @endif

        {{-- Manajemen Testing: Quality Assurance & Admin --}}
        {{-- @if(auth()->user() && (auth()->user()->role === 'Quality Assurance' || strtolower(auth()->user()->role) === 'admin'))
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Manajemen Testing">
            <a href="{{ route('test-cases.index') }}" class="flex items-center w-full main-menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Manajemen Testing</span>
            </a>
        </li>
        @endif --}}

        {{-- Manajemen Testing Baru: Quality Assurance & Admin --}}
        @if(auth()->user() && (auth()->user()->role === 'Quality Assurance' || strtolower(auth()->user()->role) === 'admin'))
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Manajemen Testing">
            <a href="{{ route('test-cases-new.index') }}" class="flex items-center w-full main-menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Manajemen Testing</span>
            </a>
        </li>
        @endif

        {{-- Upload Screen Format: Semua role --}}
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Screen Format">
            <a href="{{ route('dashboard') }}" class="flex items-center w-full main-menu" data-target="submenu-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Screen Format</span>
            </a>
        </li>

        {{-- Laporan & Statistik: Project Manager & Admin --}}
        @if(auth()->user() && (auth()->user()->role === 'Project Manager' || strtolower(auth()->user()->role) === 'admin'))
        <li class="mb-4 flex flex-col hover:bg-gray-200 p-3 rounded sidebar-item transition-all duration-300" data-tooltip="Laporan & Statistik">
            <a href="{{ route('laporan-statistik.index') }}" class="flex items-center w-full main-menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                <span class="sidebar-content ml-2 transition-all duration-300">Laporan & Statistik</span>
            </a>
        </li>
        @endif
    </ul>
</div>
<div class="p-4 sidebar-toggle">
    <button id="toggleSidebar" class="ml-3 px-4 py-2 bg-white-500 text-black rounded flex items-center transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <span class="ml-3 sidebar-content text-gray-600 transition-all duration-300">Minimize</span>
    </button>
</div>

<style>
    .sidebar-maximized {
        width: 265px;
        height: 100vh; /* Full height */
        display: flex;
        flex-direction: column;
        transition: width 0.4s, opacity 0.4s;
        position: fixed; /* Fix the sidebar position */
        top: 0;
        left: 0;
        z-index: 20; /* Samakan z-index dengan minimized */
    }
    .sidebar-minimized {
        width: 120px;
        height: 100vh; /* Full height */
        display: flex;
        flex-direction: column;
        transition: width 0.4s, opacity 0.4s;
        position: fixed; /* Fix the sidebar position */
        top: 0;
        left: 0;
        z-index: 20; /* Samakan z-index dengan maximized */
    }
    .menu-container {
        flex: 1;
        overflow-y: auto;
    }
    .sidebar-minimized .sidebar-item {
        justify-content: center;
        position: relative;
    }
    .tooltip {
        position: fixed;
        background-color: black;
        color: white;
        padding: 0.5rem;
        border-radius: 0.25rem;
        white-space: nowrap;
        z-index: 10000; /* Lebih tinggi dari .submenu-container */
        display: none;
    }
    .sidebar-minimized .sidebar-content {
        display: none;
        opacity: 0;
        transform: translateX(-20px);
        transition: opacity 0.4s, transform 0.4s;
    }
    .sidebar-maximized .sidebar-content {
        display: inline;
        opacity: 1;
        transform: translateX(0);
        transition: opacity 0.4s, transform 0.4s;
    }
    .sidebar-minimized .sidebar-app-title {
        display: none;
    }
    .sidebar-maximized .sidebar-app-title {
        display: block;
    }
    .sidebar-minimized .sidebar-header,
    .sidebar-minimized .sidebar-toggle {
        justify-content: center;
    }
    .sidebar-minimized .main-menu {
        justify-content: center;
    }
    .sidebar-minimized .sidebar-menu {
        margin-left: 0;
    }
    .submenu {
        margin-left: 2rem;
    }
    .submenu-container {
        position: fixed; /* Ubah dari absolute ke fixed */
        left: 120px; /* Tetap */
        top: 0;
        height: 100vh;
        width: 190px; /* Adjust width as needed */
        background-color: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: none;
        overflow-y: auto; /* Make the submenu scrollable */
        padding: 1rem; /* Add padding for better appearance */
        list-style-type: none; /* Remove bullet points */
    }
    .main-content {
        margin-left: 260px; /* Adjust based on the maximized sidebar width */
        transition: margin-left 0.4s;
        position: relative; /* Tambahkan jika belum ada */
    }
    .sidebar-minimized ~ .main-content {
        margin-left: 120px; /* Adjust based on the minimized sidebar width */
    }
</style>

<div id="submenu-container" class="submenu-container"></div>
<div id="tooltip" class="tooltip"></div>

<script>
    const tooltip = document.getElementById('tooltip');

    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('mouseenter', function(e) {
            if (document.getElementById('sidebar').classList.contains('sidebar-minimized')) {
                tooltip.innerText = this.getAttribute('data-tooltip');
                tooltip.style.display = 'block';
            }
        });

        item.addEventListener('mousemove', function(e) {
            if (document.getElementById('sidebar').classList.contains('sidebar-minimized')) {
                // Gunakan clientX dan clientY saja untuk posisi fixed
                tooltip.style.left = `${e.clientX + 10}px`;
                tooltip.style.top = `${e.clientY + 10}px`;
            }
        });

        item.addEventListener('mouseleave', function() {
            tooltip.style.display = 'none';
        });
    });

    document.querySelectorAll('.main-menu').forEach(item => {
        item.addEventListener('click', function(e) {
            const target = document.getElementById(this.dataset.target);
            if (target) {
                e.preventDefault();
                const submenuContainer = document.getElementById('submenu-container');
                if (document.getElementById('sidebar').classList.contains('sidebar-minimized')) {
                    if (submenuContainer.style.display === 'block' && submenuContainer.innerHTML === target.innerHTML) {
                        submenuContainer.style.display = 'none';
                    } else {
                        submenuContainer.innerHTML = target.innerHTML;
                        submenuContainer.style.display = 'block';
                    }
                } else {
                    target.classList.toggle('hidden');
                }
            }
        });
    });

    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-minimized');
        sidebar.classList.toggle('sidebar-maximized');
        document.getElementById('submenu-container').style.display = 'none';
        document.querySelectorAll('.sidebar-content').forEach(content => {
            if (sidebar.classList.contains('sidebar-minimized')) {
                content.style.opacity = '0';
                content.style.transform = 'translateX(-20px)';
                localStorage.setItem('sidebarState', 'minimized');
                // Hide all submenus when sidebar is minimized
                document.querySelectorAll('.submenu').forEach(submenu => {
                    submenu.classList.add('hidden');
                });
            } else {
                content.style.opacity = '1';
                content.style.transform = 'translateX(0)';
                localStorage.setItem('sidebarState', 'maximized');
            }
        });
    });

    // Restore sidebar state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarState = localStorage.getItem('sidebarState');
        const sidebar = document.getElementById('sidebar');
        if (sidebarState === 'minimized') {
            sidebar.classList.add('sidebar-minimized');
            sidebar.classList.remove('sidebar-maximized');
            document.querySelectorAll('.sidebar-content').forEach(content => {
                content.style.opacity = '0';
                content.style.transform = 'translateX(-20px)';
            });
        } else {
            sidebar.classList.add('sidebar-maximized');
            sidebar.classList.remove('sidebar-minimized');
            document.querySelectorAll('.sidebar-content').forEach(content => {
                content.style.opacity = '1';
                content.style.transform = 'translateX(0)';
            });
        }
    });
</script>
