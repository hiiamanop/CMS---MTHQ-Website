@extends('layouts.master')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kegiatan Santri</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
                <ul class="navbar-nav d-flex align-items-center justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="#" class="nav-link text-body font-weight-bold px-0">
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
                            <h6 class="text-white text-capitalize ps-3">Daftar Attribute Kegiatan Santri</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <a href="{{ route('kegiatan_santris.create') }}" class="btn btn-primary btn-sm float-end me-3">Tambah Attribute</a>

                            {{-- Success Message --}}
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <!-- Table -->
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Nama Attribute</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Keterangan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kegiatanSantris as $index => $kegiatan)
                                    <tr>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            {{ ($kegiatanSantris->currentPage() - 1) * $kegiatanSantris->perPage() + $index + 1 }}
                                        </td>

                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $kegiatan->nama_attribute }}</td>

                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $kegiatan->keterangan }}</td>

                                        <td class="align-middle text-center">
                                            <a href="{{ route('kegiatan_santris.edit', $kegiatan->id) }}" class="badge badge-sm bg-gradient-warning me-1">Edit</a>

                                            <form action="{{ route('kegiatan_santris.destroy', $kegiatan->id) }}" method="POST" style="display:inline-block;">
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
                                    Showing {{ ($kegiatanSantris->currentPage() - 1) * $kegiatanSantris->perPage() + 1 }}
                                    to {{ min($kegiatanSantris->currentPage() * $kegiatanSantris->perPage(), $kegiatanSantris->total()) }}
                                    of {{ $kegiatanSantris->total() }} entries
                                </div>
                                <nav aria-label="Page navigation">
                                    {{ $kegiatanSantris->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
@endsection