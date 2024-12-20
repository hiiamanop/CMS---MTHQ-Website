@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detail Berita</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
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
                            <h6 class="text-white text-capitalize ps-3">Edit Detail Berita</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk mengedit detail berita -->
                        <form role="form" method="POST" action="{{ route('detail-beritas.update', $detailBerita->id) }}" class="text-start" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Error message handling -->
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <!-- Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" class="form-control" id="section_id">
                                    <option value="" selected>-- Pilih Section --</option>
                                    @foreach($sections as $section)
                                    <option value="{{ $section->id }}"
                                        {{ $detailBerita->section_id == $section->id ? 'selected' : '' }}>
                                        {{ $section->item }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Berita -->
                            <label for="list_berita_id" class="form-label">Pilih Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="list_berita_id" class="form-control" id="list_berita_id">
                                    <option value="" selected>-- Pilih Berita --</option>
                                    @foreach($listBeritas as $berita)
                                    <option value="{{ $berita->id }}"
                                        {{ $detailBerita->list_berita_id == $berita->id ? 'selected' : '' }}>
                                        {{ $berita->judul_berita }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control" id="nama_attribute"
                                    value="{{ old('nama_attribute', $detailBerita->nama_attribute) }}" required>
                            </div>

                            <!-- Konten Teks -->
                            <label for="konten_teks" class="form-label">Konten Teks</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="konten_teks" class="form-control" id="konten_teks" rows="4">{{ old('konten_teks', $detailBerita->konten_teks) }}</textarea>
                            </div>

                            <!-- Konten Gambar -->
                            <label for="konten_gambar" class="form-label">Konten Gambar</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" name="konten_gambar" class="form-control" id="konten_gambar" accept="image/*">
                            </div>
                            @if($detailBerita->konten_gambar)
                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$detailBerita->konten_gambar) }}" alt="Konten Gambar" width="150" class="img-fluid">
                                <p>Current Image</p>
                            </div>
                            @endif

                            <!-- Tombol Submit -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('detail-beritas.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection