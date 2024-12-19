@extends('layouts.master')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Daftar Berita</li>
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
                            <h6 class="text-white text-capitalize ps-3">Daftar List Berita</h6>
                            <a href="{{ route('list-beritas.create') }}" class="btn btn-primary btn-sm float-end me-3">Tambah Berita</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">

                            <!-- Alert Success/Error -->
                            @if(session('success'))
                            <script>
                                Swal.fire('Berhasil!', '{{ session('
                                    success ') }}', 'success');
                            </script>
                            @endif

                            @if(session('error'))
                            <script>
                                Swal.fire('Gagal!', '{{ session('
                                    error ') }}', 'error');
                            </script>
                            @endif

                            <!-- Table -->
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Section</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Judul Berita</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Kategori Berita</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Tanggal Upload</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Highlight Berita</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Tipe Konten</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Konten Teks</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Gambar</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beritas as $index => $berita)
                                    <tr>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            {{ ($beritas->currentPage() - 1) * $beritas->perPage() + $index + 1 }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            {{ $berita->section ? $berita->section->item . ' - ' . $berita->section->section : 'N/A' }}

                                        </td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $berita->judul_berita }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ ucfirst(str_replace('_', ' ', $berita->kategori_berita)) }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ \Carbon\Carbon::parse($berita->tanggal_upload)->format('d-m-Y') }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $berita->highlight_berita ?? 'N/A' }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ ucfirst($berita->tipe_konten) }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $berita->konten_teks ?? 'N/A' }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            @if($berita->konten_gambar)
                                            <img src="{{ asset('storage/' . $berita->konten_gambar) }}" alt="Gambar Berita" style="height: 50px;">
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('list-beritas.edit', $berita->id) }}" class="badge badge-sm bg-gradient-warning me-1">Edit</a>
                                            <form action="{{ route('list-beritas.destroy', $berita->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                                <div class="text-muted">
                                    Showing {{ ($beritas->currentPage() - 1) * $beritas->perPage() + 1 }}
                                    to {{ min($beritas->currentPage() * $beritas->perPage(), $beritas->total()) }}
                                    of {{ $beritas->total() }} entries
                                </div>
                                <nav aria-label="Page navigation">
                                    {{ $beritas->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection