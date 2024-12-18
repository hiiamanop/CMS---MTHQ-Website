@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Halaman</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Berita</li>
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
                            <h6 class="text-white text-capitalize ps-3">Tambah Berita</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk menambah berita -->
                        <form action="{{ route('list-beritas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Judul Berita -->
                            <label for="judul_berita" class="form-label">Judul Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="judul_berita" class="form-control" id="judul_berita" required>
                            </div>

                            <!-- Kategori Berita -->
                            <label for="kategori_berita" class="form-label">Kategori Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="kategori_berita" class="form-control" id="kategori_berita" required>
                                    <option value="artikel">Artikel</option>
                                    <option value="berita">Berita</option>
                                </select>
                            </div>

                            <!-- Tanggal Upload -->
                            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="tanggal_upload" class="form-control" id="tanggal_upload" required>
                            </div>

                            <!-- Highlight Berita -->
                            <label for="highlight_berita" class="form-label">Highlight Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="highlight_berita" class="form-control" id="highlight_berita" rows="5" required></textarea>
                            </div>

                            <!-- Tombol Simpan dan Kembali -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('list-beritas.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection