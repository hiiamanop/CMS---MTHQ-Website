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
                            <h6 class="text-white text-capitalize ps-3">Daftar Attribute Detail Berita</h6>
                            <a href="{{ route('detail-beritas.create') }}" class="btn btn-primary btn-sm float-end me-3">Tambah Attribute </a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Section</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">List Berita</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama Attribute</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Konten Teks</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Konten Gambar</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailBeritas as $index => $detail)
                                    <tr>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ ($detailBeritas->currentPage() - 1) * $detailBeritas->perPage() + $index + 1 }}
                                        </td>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ $detail->section->item ?? 'N/A' }}
                                        </td>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ $detail->listBerita->judul_berita ?? 'N/A' }}
                                        </td>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ $detail->nama_attribute }}
                                        </td>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ $detail->konten_teks ?? 'N/A' }}
                                        </td>
                                        <td class="text-xs font-weight-bold text-center">
                                            @if($detail->konten_gambar)
                                            <img src="{{ asset('storage/' . $detail->konten_gambar) }}" alt="Konten Gambar" style="height: 50px;">
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('detail-beritas.edit', $detail->id) }}" class="badge badge-sm bg-gradient-warning me-1">Edit</a>
                                            <form action="{{ route('detail-beritas.destroy', $detail->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                                <div class="text-muted">
                                    Showing {{ ($detailBeritas->currentPage() - 1) * $detailBeritas->perPage() + 1 }}
                                    to {{ min($detailBeritas->currentPage() * $detailBeritas->perPage(), $detailBeritas->total()) }}
                                    of {{ $detailBeritas->total() }} entries
                                </div>
                                <nav aria-label="Page navigation">
                                    {{ $detailBeritas->links('pagination::bootstrap-4') }}
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