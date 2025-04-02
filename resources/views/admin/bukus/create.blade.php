@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Tambah Buku</h2>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Whoops!</strong>
        <span class="block sm:inline">There were some problems with your input.</span>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('bukus.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">Judul Buku</label>
            <input type="text" name="judul" id="judul" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="kategori_id">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="penulis">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="penerbit">Penerbit</label>
            <input type="text" name="penerbit" id="penerbit" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="tahun">Tahun Terbit</label>
            <input type="text" name="tahun" id="tahun" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Drag & Drop Upload -->
        <div class="mb-4">
            <label class="block text-gray-700">Foto Buku</label>
            <div id="dropzone" class="border-dashed border-2 p-6 text-center bg-gray-100 cursor-pointer">
                <p class="text-gray-500">Seret & lepaskan gambar di sini atau klik untuk mengunggah.</p>
                <input type="file" name="foto" id="foto-input" class="hidden" accept="image/*">
                <img id="preview-image" class="mt-4 hidden mx-auto w-32 h-32 object-cover">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="jumlah">Jumlah Buku</label>
            <input type="number" name="jumlah" id="jumlah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <a href="{{ route('bukus.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline -none focus:shadow-outline">Kembali</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Simpan</button>
        </div>
    </form>
</div>

<script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropzone = document.getElementById("dropzone");
            const fileInput = document.getElementById("foto-input");
            const previewImage = document.getElementById("preview-image");

            dropzone.addEventListener("click", () => fileInput.click());

            fileInput.addEventListener("change", (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });

            dropzone.addEventListener("dragover", (event) => {
                event.preventDefault();
                dropzone.classList.add("bg-gray-200");
            });

            dropzone.addEventListener("dragleave", () => {
                dropzone.classList.remove("bg-gray-200");
            });

            dropzone.addEventListener("drop", (event) => {
                event.preventDefault();
                dropzone.classList.remove("bg-gray-200");
                if (event.dataTransfer.files.length > 0) {
                    fileInput.files = event.dataTransfer.files;
                    const file = event.dataTransfer.files[0];
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove("hidden");
                    };
                    reader.readAsDataURL(file);
                }
            });

            dropzone.addEventListener("paste", (event) => {
                const items = (event.clipboardData || event.originalEvent.clipboardData).items;
                for (const item of items) {
                    if (item.type.indexOf("image") !== -1) {
                        const blob = item.getAsFile();
                        fileInput.files = new DataTransfer().files;
                        fileInput.files = new DataTransfer().files;
                        fileInput.files.item(0, blob);

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove("hidden");
                        };
                        reader.readAsDataURL(blob);
                    }
                }
            });
        });
    </script>
@endsection