@if (session('success') || request('success') == 1)
    <div id="alert-success-testcase" class="fixed top-0 left-0 right-0 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md mx-auto mt-4 max-w-lg z-50 transition-opacity duration-500 ease-in-out opacity-0" role="alert">
        <div class="flex items-center">
            <svg class="fill-current h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill="currentColor" d="M16.707 6.293a1 1 0 00-1.414 0L9 12.586l-2.293-2.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 00-1.414-1.414z"/>
            </svg>
            <div>
                <strong class="font-bold block mb-1">Success!</strong>
                <span class="block sm:inline">
                    {{ session('success') ?? 'Data berhasil disimpan!' }}
                </span>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alert-success-testcase');
            alert.classList.remove('opacity-0');
            alert.classList.add('opacity-100');
            setTimeout(function() {
                alert.classList.remove('opacity-100');
                alert.classList.add('opacity-0');
            }, 2000);
        });
    </script>
@endif
