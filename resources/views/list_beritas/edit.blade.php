@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">List Berita</li>
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
                            <h6 class="text-white text-capitalize ps-3">Edit Berita</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk mengedit berita -->
                        <form role="form" method="POST" action="{{ route('list-beritas.update', $listBerita->id) }}" class="text-start">
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

                            <!-- Judul Berita -->
                            <label for="judul_berita" class="form-label">Judul Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="judul_berita" class="form-control" id="judul_berita" value="{{ old('judul_berita', $listBerita->judul_berita) }}" required>
                            </div>

                            <!-- Kategori Berita -->
                            <label for="kategori_berita" class="form-label">Kategori Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="kategori_berita" class="form-control" id="kategori_berita" required>
                                    <option value="artikel" {{ $listBerita->kategori_berita == 'artikel' ? 'selected' : '' }}>Artikel</option>
                                    <option value="berita" {{ $listBerita->kategori_berita == 'berita' ? 'selected' : '' }}>Berita</option>
                                    
                                </select>
                            </div>

                            <!-- Tanggal Upload -->
                            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="tanggal_upload" class="form-control" id="tanggal_upload" value="{{ old('tanggal_upload', $listBerita->tanggal_upload) }}" required>
                            </div>

                            <!-- Highlight Berita -->
                            <label for="highlight_berita" class="form-label">Highlight Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="highlight_berita" class="form-control" id="highlight_berita" rows="4" required>{{ old('highlight_berita', $listBerita->highlight_berita) }}</textarea>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('list-beritas.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
