@extends('layouts.master')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Program Ekstrakurikuler</li>
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
                            <h6 class="text-white text-capitalize ps-3">List Attribute Program Ekstrakurikuler</h6>
                            <a href="{{ route('program_ekstrakurikuler.create') }}" class="btn btn-primary btn-sm float-end mx-3">Tambah Attribute</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <!-- Alert Success/Error -->
                            @if(session('success'))
                            <script>
                                Swal.fire('Berhasil!', '{{ session('success') }}', 'success');
                            </script>
                            @endif

                            @if(session('error'))
                            <script>
                                Swal.fire('Gagal!', '{{ session('error') }}', 'error');
                            </script>
                            @endif

                            <!-- Table -->
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Item - Section</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama Attribute</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Konten Teks</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Gambar</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programEkstrakurikulers as $index => $programWirausaha)
                                    <tr>
                                        <td class="text-xs font-weight-bold text-center">
                                            {{ ($programEkstrakurikulers->currentPage() - 1) * $programEkstrakurikulers->perPage() + $index + 1 }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            {{ $programWirausaha->section ? $programWirausaha->section->item . ' - ' . $programWirausaha->section->section : 'N/A' }}
                                        </td>
                                        <td class="text-xs text-center">{{ $programWirausaha->nama_attribute }}</td>
                                        <td class="text-xs text-center">
                                            {{ $programWirausaha->konten_teks ?? 'N/A' }}
                                        </td>
                                        <td class="text-xs text-center">
                                            @if($programWirausaha->konten_gambar)
                                            <img src="{{ asset('storage/' . $programWirausaha->konten_gambar) }}" alt="" style="height: 50px;">
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('program_ekstrakurikuler.edit', $programWirausaha->id) }}" class="badge badge-sm bg-gradient-warning me-1">Edit</a>
                                            <form action="{{ route('program_ekstrakurikuler.destroy', $programWirausaha->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                                <div class="text-muted">
                                    Showing {{ ($programEkstrakurikulers->currentPage() - 1) * $programEkstrakurikulers->perPage() + 1 }}
                                    to {{ min($programEkstrakurikulers->currentPage() * $programEkstrakurikulers->perPage(), $programEkstrakurikulers->total()) }}
                                    of {{ $programEkstrakurikulers->total() }} entries
                                </div>
                                <nav aria-label="Page navigation">
                                    {{ $programEkstrakurikulers->links('pagination::bootstrap-4') }}
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