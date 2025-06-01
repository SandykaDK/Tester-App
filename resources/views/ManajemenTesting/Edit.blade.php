<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test Case</title>
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
    <!-- Decorative vector art (SVG) for background -->
    <div class="fixed top-0 left-0 w-1/2 h-1/2 pointer-events-none z-0">
        <svg viewBox="0 0 400 400" fill="none" class="w-full h-full opacity-30">
            <circle cx="200" cy="200" r="200" fill="#3B82F6"/>
            <ellipse cx="320" cy="80" rx="80" ry="40" fill="#60A5FA" />
            <ellipse cx="80" cy="320" rx="60" ry="30" fill="#2563EB" />
        </svg>
    </div>
    <div class="fixed bottom-0 right-0 w-1/3 h-1/3 pointer-events-none z-0">
        <svg viewBox="0 0 300 300" fill="none" class="w-full h-full opacity-20">
            <circle cx="150" cy="150" r="150" fill="#1E40AF"/>
            <ellipse cx="220" cy="60" rx="60" ry="25" fill="#3B82F6" />
        </svg>
    </div>
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar-maximized bg-white shadow-md transition-all duration-300 flex flex-col justify-between fixed z-10">
        <x-sidebar />
    </div>
    <div class="main-content flex-1 p-6 ml-64 relative z-10">
        <div class="flex justify-end items-center mb-4">
            <x-profile-section />
        </div>
        <x-alert-success />
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Edit Test Case</h1>
            <!-- Wizard Navigation Dots -->
            <div class="flex justify-center items-center mb-6">
                <div class="wizard-dot cursor-pointer w-8 h-8 flex items-center justify-center rounded-full border-2 z-20 bg-white transition-colors duration-300 border-gray-300 text-gray-700" onclick="goToStep(1)" id="dot-1">1</div>
                <div id="wizard-line-1" class="h-1 w-8 bg-gray-300 transition-colors duration-300 -ml-1 -mr-1 z-10"></div>
                <div class="wizard-dot cursor-pointer w-8 h-8 flex items-center justify-center rounded-full border-2 z-20 bg-white transition-colors duration-300 border-gray-300 text-gray-700" onclick="goToStep(2)" id="dot-2">2</div>
                <div id="wizard-line-2" class="h-1 w-8 bg-gray-300 transition-colors duration-300 -ml-1 -mr-1 z-10"></div>
                <div class="wizard-dot cursor-pointer w-8 h-8 flex items-center justify-center rounded-full border-2 z-20 bg-white transition-colors duration-300 border-gray-300 text-gray-700" onclick="goToStep(3)" id="dot-3">3</div>
            </div>
            <form method="POST" action="{{ route('test-cases.update', $testCase->id) }}">
                @csrf
                @method('PUT')
                <div id="wizard-step-1" class="wizard-step">
                    <div class="mb-4">
                        <label for="app_key" class="block text-sm font-medium text-gray-700 mb-2">Nama Aplikasi</label>
                        <select name="app_key" id="app_key" class="w-full border rounded p-2">
                            <option value="">Pilih Aplikasi</option>
                            @foreach ($applications as $application)
                                <option value="{{ $application->id }}" {{ $testCase->app_key == $application->id ? 'selected' : '' }}>{{ $application->app_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="modul_key" class="block text-sm font-medium text-gray-700 mb-2">Modul</label>
                        <select name="modul_key" id="modul_key" class="w-full border rounded p-2">
                            <option value="">Pilih Modul</option>
                            @foreach ($modules as $module)
                                <option value="{{ $module->id }}" data-app-id="{{ $module->application_id }}" {{ $testCase->modul_key == $module->id ? 'selected' : '' }}>{{ $module->modul_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="menu_key" class="block text-sm font-medium text-gray-700 mb-2">Menu</label>
                        <select name="menu_key" id="menu_key" class="w-full border rounded p-2">
                            <option value="">Pilih Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" data-module-id="{{ $menu->modul_id }}" {{ $testCase->menu_key == $menu->id ? 'selected' : '' }}>{{ $menu->menu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700" onclick="nextStep(2)">Next</button>
                    </div>
                </div>
                <div id="wizard-step-2" class="wizard-step hidden">
                    <div class="mb-4">
                        <label for="test_scenario" class="block text-sm font-medium text-gray-700 mb-2">Test Scenario</label>
                        <textarea name="test_scenario" id="test_scenario" class="w-full border rounded p-2">{{ $testCase->test_scenario }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="test_data" class="block text-sm font-medium text-gray-700 mb-2">Test Data</label>
                        <textarea name="test_data" id="test_data" class="w-full border rounded p-2">{{ $testCase->test_data }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="test_step" class="block text-sm font-medium text-gray-700 mb-2">Test Step</label>
                        <textarea name="test_step" id="test_step" class="w-full border rounded p-2">{{ $testCase->test_step }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="expected_result" class="block text-sm font-medium text-gray-700 mb-2">Expected Result</label>
                        <textarea name="expected_result" id="expected_result" class="w-full border rounded p-2">{{ $testCase->expected_result }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="result" class="block text-sm font-medium text-gray-700 mb-2">Actual Result</label>
                        <textarea name="result" id="result" class="w-full border rounded p-2">{{ $testCase->result }}</textarea>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700" onclick="prevStep(1)">Previous</button>
                        <button type="button" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700" onclick="nextStep(3)">Next</button>
                    </div>
                </div>
                <div id="wizard-step-3" class="wizard-step hidden">
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Testing</label>
                        <select name="status" id="status" class="w-full border rounded p-2">
                            <option value="Open" {{ $testCase->status == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="On Progress" {{ $testCase->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                            <option value="Waiting Confirmation" {{ $testCase->status == 'Waiting Confirmation' ? 'selected' : '' }}>Waiting Confirmation</option>
                            <option value="Pass" {{ $testCase->status == 'Pass' ? 'selected' : '' }}>Pass</option>
                            <option value="Failed" {{ $testCase->status == 'Failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="pic_dev" class="block text-sm font-medium text-gray-700 mb-2">PIC Developer</label>
                        <select name="pic_dev" id="pic_dev" class="w-full border rounded p-2">
                            <option value="">Pilih PIC</option>
                            @foreach ($developers as $developer)
                                <option value="{{ $developer->id }}" {{ $testCase->pic_dev == $developer->id ? 'selected' : '' }}>{{ $developer->dev_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="test_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Testing</label>
                        <input type="date" name="test_date" id="test_date" class="w-full border rounded p-2" value="{{ $testCase->test_date }}">
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700" onclick="prevStep(2)">Previous</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const appKeySelect = document.getElementById('app_key');
            const modulKeySelect = document.getElementById('modul_key');
            const menuKeySelect = document.getElementById('menu_key');

            appKeySelect.addEventListener('change', function () {
                const selectedAppId = this.value;

                // Enable and reset the Modul dropdown
                modulKeySelect.disabled = !selectedAppId;
                modulKeySelect.innerHTML = '<option value="">Pilih Modul</option>';
                menuKeySelect.disabled = true;
                menuKeySelect.innerHTML = '<option value="">Pilih Menu</option>';

                // Populate the Modul dropdown based on the selected Aplikasi
                @foreach ($modules as $module)
                    if (selectedAppId == '{{ $module->application_id }}') {
                        const option = document.createElement('option');
                        option.value = '{{ $module->id }}';
                        option.textContent = '{{ $module->modul_name }}';
                        modulKeySelect.appendChild(option);
                    }
                @endforeach
            });

            modulKeySelect.addEventListener('change', function () {
                const selectedModuleId = this.value;

                // Enable and reset the Menu dropdown
                menuKeySelect.disabled = !selectedModuleId;
                menuKeySelect.innerHTML = '<option value="">Pilih Menu</option>';

                // Populate the Menu dropdown based on the selected Modul
                @foreach ($menus as $menu)
                    if (selectedModuleId == '{{ $menu->modul_id }}') {
                        const option = document.createElement('option');
                        option.value = '{{ $menu->id }}';
                        option.textContent = '{{ $menu->menu_name }}';
                        menuKeySelect.appendChild(option);
                    }
                @endforeach
            });

            updateWizardStep(1);
        });

        function nextStep(step) {
            updateWizardStep(step);
        }

        function prevStep(step) {
            updateWizardStep(step);
        }

        function goToStep(step) {
            updateWizardStep(step);
        }

        function updateWizardStep(step) {
            document.querySelectorAll('.wizard-step').forEach(step => step.classList.add('hidden'));
            document.getElementById(`wizard-step-${step}`).classList.remove('hidden');

            // Reset all dots to default
            document.querySelectorAll('.wizard-dot').forEach(dot => {
                dot.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                dot.classList.add('border-gray-300', 'text-gray-700', 'bg-white');
            });

            // Update dots and lines based on step
            const dot1 = document.getElementById('dot-1');
            const dot2 = document.getElementById('dot-2');
            const dot3 = document.getElementById('dot-3');
            const line1 = document.getElementById('wizard-line-1');
            const line2 = document.getElementById('wizard-line-2');

            if (step === 1) {
                dot1.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot1.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                line1.classList.remove('bg-blue-500');
                line1.classList.add('bg-gray-300');
                dot2.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                dot2.classList.add('border-gray-300', 'text-gray-700', 'bg-white');
                line2.classList.remove('bg-blue-500');
                line2.classList.add('bg-gray-300');
                dot3.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                dot3.classList.add('border-gray-300', 'text-gray-700', 'bg-white');
            } else if (step === 2) {
                dot1.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot1.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                line1.classList.remove('bg-gray-300');
                line1.classList.add('bg-blue-500');
                dot2.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot2.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                line2.classList.remove('bg-blue-500');
                line2.classList.add('bg-gray-300');
                dot3.classList.remove('bg-blue-500', 'text-white', 'border-blue-500');
                dot3.classList.add('border-gray-300', 'text-gray-700', 'bg-white');
            } else if (step === 3) {
                dot1.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot1.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                line1.classList.remove('bg-gray-300');
                line1.classList.add('bg-blue-500');
                dot2.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot2.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                line2.classList.remove('bg-gray-300');
                line2.classList.add('bg-blue-500');
                dot3.classList.add('bg-blue-500', 'text-white', 'border-blue-500');
                dot3.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
            }
        }
    </script>
</body>
</html>
