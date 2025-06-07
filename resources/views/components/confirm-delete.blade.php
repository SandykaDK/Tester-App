@props([
    'action' => '#',
    'message' => 'Apakah anda yakin ingin menghapus data ini?',
    'buttonText' => 'Ya',
    'buttonClass' => 'bg-red-600 hover:bg-red-700 text-white',
    'id' => 'confirmDeleteModal'
])
<div id="{{ $id ?? 'confirmDeleteModal' }}" class="hidden fixed inset-0 flex items-start justify-center z-50 bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 mt-10">
        <div class="flex items-center mb-4">
            <span class="font-semibold text-lg text-gray-800">Konfirmasi Hapus</span>
        </div>
        <div class="mb-6 text-gray-700">
            {{ $message }}
        </div>
        <div class="flex justify-end space-x-2">
            <button type="button" onclick="document.getElementById('{{ $id ?? 'confirmDeleteModal' }}').classList.add('hidden');" class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">Tidak</button>
            <form method="POST" action="{{ $action }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded {{ $buttonClass }}">{{ $buttonText }}</button>
            </form>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk menampilkan modal, bisa dipanggil dari luar
    window.showConfirmDeleteModal = function(actionUrl) {
        var modal = document.getElementById('{{ $id ?? 'confirmDeleteModal' }}');
        var form = modal.querySelector('form');
        if (form && actionUrl) form.action = actionUrl;
        modal.classList.remove('hidden');
    };
</script>
