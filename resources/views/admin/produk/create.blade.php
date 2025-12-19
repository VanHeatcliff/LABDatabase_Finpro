<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Upload Gambar Produk</label>
        <input type="file" name="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB</p>
    </div>

    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
        Simpan Produk
    </button>
</form>