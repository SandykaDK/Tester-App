@if (session('failure'))
    <div id="alert-failure" class="fixed top-0 left-0 right-0 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md mx-auto mt-4 max-w-lg z-50 transition-opacity duration-500 ease-in-out opacity-0" role="alert">
        <div class="flex items-center">
            <svg class="fill-current h-6 w-6 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18.364 17.364a9 9 0 1 1 0-12.728 9 9 0 0 1 0 12.728zM10 8.586l2.828-2.829 1.415 1.415L11.414 10l2.829 2.828-1.415 1.415L10 11.414l-2.828 2.829-1.415-1.415L8.586 10 5.757 7.172l1.415-1.415L10 8.586z"/></svg>
            <div>
                <strong class="font-bold block mb-1">Failure!</strong>
                <span class="block sm:inline">{{ session('failure') }}</span>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('alert-failure');
            alert.classList.remove('opacity-0');
            alert.classList.add('opacity-100');
            setTimeout(function() {
                alert.classList.remove('opacity-100');
                alert.classList.add('opacity-0');
            }, 2000);
        });
    </script>
@endif
