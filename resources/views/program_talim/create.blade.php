@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Program Talim</li>
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
                            <h6 class="text-white text-capitalize ps-3">Tambah Program Talim</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <form action="{{ route('program_talim.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror">
                                    <option value="">-- Pilih Section --</option>
                                    @foreach ($programTalimSections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->item . ' - ' . $section->nama_section }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" class="form-control @error('nama_attribute') is-invalid @enderror" id="nama_attribute" value="{{ old('nama_attribute') }}" required>
                                @error('nama_attribute')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konten Teks -->
                            <div id="konten_teks_field">
                                <label for="konten_teks" class="form-label">Konten Teks</label>
                                <div class="input-group input-group-outline mb-3">
                                    <textarea name="konten_teks" id="konten_teks" class="form-control @error('konten_teks') is-invalid @enderror" rows="3">{{ old('konten_teks') }}</textarea>
                                    @error('konten_teks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Konten Gambar -->
                            <div id="konten_gambar_field">
                                <label for="konten_gambar" class="form-label">Upload Gambar</label>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="file" name="konten_gambar" id="konten_gambar" class="form-control @error('konten_gambar') is-invalid @enderror">
                                    @error('konten_gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tombol Simpan dan Kembali -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('program_talim.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
