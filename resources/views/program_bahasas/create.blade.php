@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Program Bahasa</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tambah Program Bahasa</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <form action="{{ route('program_bahasas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">-- Pilih Section --</option>
                                    @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->item . ' - ' . $section->section }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control" id="nama_attribute" required>
                            </div>

                            <!-- Tipe Konten -->
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="tipe_konten" id="tipe_konten" class="form-control" onchange="toggleKontenFields()">
                                    <option value="">-- Pilih Tipe Konten --</option>
                                    <option value="teks">Teks</option>
                                    <option value="gambar">Gambar</option>
                                </select>
                            </div>

                            <!-- Konten Teks -->
                            <div id="konten_teks_field" style="display: none;">
                                <label for="konten_teks" class="form-label">Konten Teks</label>
                                <div class="input-group input-group-outline mb-3">
                                    <textarea name="konten_teks" id="konten_teks" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Konten Gambar -->
                            <div id="konten_gambar_field" style="display: none;">
                                <label for="konten_gambar" class="form-label">Upload Gambar</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="file" name="konten_gambar" id="konten_gambar" class="form-control">
                                </div>
                            </div>

                            <!-- Tombol Simpan dan Kembali -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('program_bahasas.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Toggle Input Berdasarkan Tipe Konten -->
    <script>
        function toggleKontenFields() {
            const tipeKonten = document.getElementById('tipe_konten').value;
            const teksField = document.getElementById('konten_teks_field');
            const gambarField = document.getElementById('konten_gambar_field');

            teksField.style.display = 'none';
            gambarField.style.display = 'none';

            if (tipeKonten === 'teks') {
                teksField.style.display = 'block';
            } else if (tipeKonten === 'gambar') {
                gambarField.style.display = 'block';
            }
        }
    </script>

    <!-- Script Notifikasi Sukses -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ("Notification" in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        new Notification("Sukses", {
                            body: "{{ session('success') }}",
                            icon: "/path/to/your/icon.png"
                        });
                    } else {
                        alert("{{ session('success') }}");
                    }
                });
            } else {
                alert("{{ session('success') }}");
            }
        });
    </script>
    @endif
</main>
@endsection