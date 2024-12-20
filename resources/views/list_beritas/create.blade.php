@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Berita</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
    </nav>

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
                        <form action="{{ route('list_beritas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="">-- Pilih Section --</option>
                                    @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">
                                        {{ $section->item . ' - ' . $section->section }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori Berita -->
                            <label for="kategori_berita" class="form-label">Kategori Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="kategori_berita" id="kategori_berita" class="form-control" required>
                                    <option value="">-- Pilih Kategori Berita --</option>
                                    @foreach ($kategoriOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Judul Berita -->
                            <label for="judul_berita" class="form-label">Judul Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="judul_berita" id="judul_berita" class="form-control" required>
                            </div>

                            <!-- Tanggal Upload -->
                            <label for="tanggal_upload" class="form-label">Tanggal Upload</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="date" name="tanggal_upload" id="tanggal_upload" class="form-control" required>
                            </div>

                            <!-- Highlight -->
                            <label for="highlight_berita" class="form-label">Highlight Berita</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="highlight_berita" id="highlight_berita" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Tipe Konten -->
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="tipe_konten" id="tipe_konten" class="form-control" onchange="toggleKontenFields()" required>
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
                                <input type="file" name="konten_gambar" id="konten_gambar" class="form-control">
                            </div>

                            <!-- Tombol -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('list_beritas.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleKontenFields() {
            const tipeKonten = document.getElementById('tipe_konten').value;
            document.getElementById('konten_teks_field').style.display = tipeKonten === 'teks' ? 'block' : 'none';
            document.getElementById('konten_gambar_field').style.display = tipeKonten === 'gambar' ? 'block' : 'none';
        }
    </script>

    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif
</main>
@endsection