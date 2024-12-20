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
                        <!-- Form Edit Berita -->
                        <form role="form" method="POST" action="{{ route('list_beritas.update', $listBerita->id) }}" enctype="multipart/form-data">
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
                                <input type="text" name="judul_berita" class="form-control" value="{{ old('judul_berita', $listBerita->judul_berita) }}" required>
                            </div>

                            <!-- Kategori Berita -->
                            <label for="kategori_berita" class="form-label">Kategori Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="kategori_berita" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategoriOptions as $kategori)
                                    <option value="{{ $kategori }}" {{ old('kategori_berita', $listBerita->kategori_berita) == $kategori ? 'selected' : '' }}>
                                        {{ ucfirst($kategori) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="">-- Pilih Section --</option>
                                    @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" {{ old('section_id', $listBerita->section_id) == $section->id ? 'selected' : '' }}>
                                        {{ $section->item . ' - ' . $section->section }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tanggal Upload -->
                            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="tanggal_upload" class="form-control" value="{{ old('tanggal_upload', $listBerita->tanggal_upload) }}" required>
                            </div>

                            <!-- Highlight Berita -->
                            <label for="highlight_berita" class="form-label">Highlight Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="highlight_berita" class="form-control" rows="4" required>{{ old('highlight_berita', $listBerita->highlight_berita) }}</textarea>
                            </div>

                            <!-- Tipe Konten -->
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="tipe_konten" id="tipe_konten" class="form-control">
                                    <option value="teks" @if($listBerita->tipe_konten == 'teks') selected @endif>Text</option>
                                    <option value="gambar" @if($listBerita->tipe_konten == 'gambar') selected @endif>Gambar</option>
                                </select>
                            </div>

                            <!-- Konten Teks -->
                            <label for="konten_teks" class="form-label">Konten Teks</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="konten_teks" id="konten_teks" class="form-control @error('konten_teks') is-invalid @enderror" rows="4" placeholder="Masukkan Konten Teks">{{ old('konten_teks', $listBerita->konten_teks) }}</textarea>
                                @error('konten_teks')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konten Gambar -->
                            <label for="konten_gambar" class="form-label">Konten Gambar</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" name="konten_gambar" id="konten_gambar" class="form-control @error('konten_gambar') is-invalid @enderror">
                                @error('konten_gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if($listBerita->konten_gambar)
                            <img class="mb-3" src="{{ asset('storage/' . $listBerita->konten_gambar) }}" alt="Gambar Berita" style="height: 100px;">
                            @endif

                            <!-- Tombol Submit -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('list_beritas.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection