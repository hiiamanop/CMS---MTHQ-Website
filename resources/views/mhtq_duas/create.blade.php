@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">MHTQ 2</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
                <ul class="navbar-nav d-flex align-items-center justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                            <i class="material-symbols-rounded">account_circle</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tambah Attribute MHTQ 2</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk menambah data beranda -->
                        <form action="{{ route('mhtq_duas.store') }}" method="POST">
                            @csrf
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

                            <label for="nama_attribute" class="form-label">Nama Attribute</label>

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control" id="nama_attribute" required>
                            </div>

                            <label for="nama_attribute" class="form-label">Keterangan</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="keterangan" id="keterangan" class="form-control" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('mhtq_duas.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk notifikasi sukses
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah browser mendukung notifikasi
            if ("Notification" in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        new Notification("Sukses", {
                            body: "{{ session('success') }}",
                            icon: "/path/to/your/icon.png" // Tambahkan ikon jika ada
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
    @endif -->
</main>
@endsection