@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Beranda </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit </li>
                </ol>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main content -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Attribute Beranda</h6>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-2">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('berandas.update', $beranda->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Section -->
                            <label for="section_id" class="form-label">Pilih Section</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">-- Pilih Section --</option>
                                    @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" {{ $beranda->section_id == $section->id ? 'selected' : '' }}>
                                        {{ $section->item . ' - ' . $section->section }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Nama Attribute -->
                            <label for="nama_attribute" class="form-label">Nama Attribute</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="nama_attribute" id="nama_attribute" class="form-control @error('nama_attribute') is-invalid @enderror" value="{{ old('nama_attribute', $beranda->nama_attribute) }}" placeholder="Masukkan Nama Attribute">
                                @error('nama_attribute')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tipe Konten -->
                            <label for="tipe_konten" class="form-label">Tipe Konten</label>
                            <div class="input-group input-group-outline mb-3">
                                <select name="tipe_konten" id="tipe_konten" class="form-control @error('tipe_konten') is-invalid @enderror">
                                    <option value="teks" {{ $beranda->tipe_konten == 'teks' ? 'selected' : '' }}>Teks</option>
                                    <option value="gambar" {{ $beranda->tipe_konten == 'gambar' ? 'selected' : '' }}>Gambar</option>
                                </select>
                                @error('tipe_konten')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Konten Teks -->
                            <label for="konten_teks" class="form-label">Konten Teks</label>
                            <div class="input-group input-group-outline mb-3">
                                <textarea name="konten_teks" id="konten_teks" class="form-control @error('konten_teks') is-invalid @enderror" placeholder="Masukkan Konten Teks">{{ old('konten_teks', $beranda->konten_teks) }}</textarea>
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

                            @if ($beranda->konten_gambar)
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini:</label><br>
                                <img src="{{ asset('storage/' . $beranda->konten_gambar) }}" alt="Gambar Saat Ini" width="150" class="img-thumbnail">
                            </div>
                            @endif

                            <!-- Submit -->
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('berandas.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
