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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Detail Berita</li>
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
                            <h6 class="text-white text-capitalize ps-3">Tambah Detail Berita</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form untuk menambah detail berita -->
                        <form action="{{ route('detail_beritas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" class="form-control" id="section_id" required>
                                    <option value="">Pilih Section</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section->item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Berita -->
                            <label for="list_berita_id" class="form-label">Pilih Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="list_berita_id" class="form-control" id="list_berita_id" required>
                                    <option value="">Pilih Berita</option>
                                    @foreach($listBeritas as $berita)
                                        <option value="{{ $berita->id }}">{{ $berita->judul_berita }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control" id="nama_attribute" required>
                            </div>

                            <!-- Keterangan -->
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="keterangan" class="form-control" id="keterangan" rows="5"></textarea>
                            </div>

                            <!-- Pilih Tipe Konten -->
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="tipe_konten" class="form-control" id="tipe_konten" required>
                                    <option value="">Pilih Tipe Konten</option>
                                    <option value="teks">Teks</option>
                                    <option value="gambar">Gambar</option>
                                </select>
                            </div>

                            <!-- Konten Teks -->
                            <div class="mb-3" id="konten_teks_div" style="display:none;">
                                <label for="konten_teks" class="form-label">Konten Teks</label>
                                <div class="input-group input-group-outline">
                                    <textarea name="konten_teks" class="form-control" id="konten_teks" rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Konten Gambar -->
                            <div class="mb-3" id="konten_gambar_div" style="display:none;">
                                <label for="konten_gambar" class="form-label">Konten Gambar</label>
                                <div class="input-group input-group-outline">
                                    <input type="file" name="konten_gambar" class="form-control" id="konten_gambar" accept="image/*">
                                </div>
                            </div>

                            <!-- Tombol Simpan dan Kembali -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('detail_beritas.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Script to toggle visibility of content fields based on the selected content type
    document.getElementById('tipe_konten').addEventListener('change', function() {
        const kontenTeksDiv = document.getElementById('konten_teks_div');
        const kontenGambarDiv = document.getElementById('konten_gambar_div');
        if (this.value === 'teks') {
            kontenTeksDiv.style.display = 'block';
            kontenGambarDiv.style.display = 'none';
        } else if (this.value === 'gambar') {
            kontenTeksDiv.style.display = 'none';
            kontenGambarDiv.style.display = 'block';
        } else {
            kontenTeksDiv.style.display = 'none';
            kontenGambarDiv.style.display = 'none';
        }
    });
</script>

@endsection
