@if (session('success') || request('success') == 1)
    <div id="alert-success" class="fixed top-0 left-0 right-0 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md mx-auto mt-4 max-w-lg z-50 transition-opacity duration-500 ease-in-out opacity-0" role="alert">
        <div class="flex items-center">
            <svg class="fill-current h-6 w-6 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.5-5.5 1.5-1.5L10 12l7-7 1.5 1.5z"/></svg>
            <div>
                <strong class="font-bold block mb-1">Success!</strong>
                <span class="block sm:inline">
                    {{ session('success') ?? 'Semua data berhasil disimpan!' }}
                </span>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alert-success');
            alert.classList.remove('opacity-0');
            alert.classList.add('opacity-100');
            setTimeout(function() {
                alert.classList.remove('opacity-100');
                alert.classList.add('opacity-0');
            }, 2000);
        });
    </script>
@endif
