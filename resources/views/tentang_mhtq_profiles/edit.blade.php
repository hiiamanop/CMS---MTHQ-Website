@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tentang MHTQ</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Fasilitas</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
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
                            <h6 class="text-white text-capitalize ps-3">Edit Data Fasilitas</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk mengedit fasilitas -->
                        <form role="form" method="POST" action="{{ route('mhtq_fasilitass.update', $fasilitas->id) }}" class="text-start">
                            @csrf
                            @method('PUT')

                            <!-- Pesan Error -->
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control" id="nama_attribute" value="{{ old('nama_attribute', $fasilitas->nama_attribute) }}" required>
                                @error('nama_attribute')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Keterangan -->
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required>{{ old('keterangan', $fasilitas->keterangan) }}</textarea>
                                @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Update dan Kembali -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('mhtq_fasilitass.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Notification -->
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