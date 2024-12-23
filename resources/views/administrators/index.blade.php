@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Administrator</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav d-flex align-items-center  justify-content-end">
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

    <!-- Main content -->
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tabel Admin</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            {{-- Add Administrator Button --}}
                            <a href="{{ route('administrators.create') }}" class="btn btn-primary btn-sm float-end" style="margin-right: 20px;">Add Administrator</a>

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


                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">No</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Role</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($administrators as $index => $admin)
                                    <tr>
                                        <td class="text-xs font-weight-bold mb-0 text-center">
                                            {{ ($administrators->currentPage() - 1) * $administrators->perPage() + $index + 1 }}
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $admin->name }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $admin->email }}</td>
                                        <td class="text-xs font-weight-bold mb-0 text-center">{{ $admin->role->role }}</td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ route('administrators.edit', $admin->id) }}" class="badge badge-sm bg-gradient-warning me-1">Edit</a>
                                            <form action="{{ route('administrators.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-sm bg-gradient-danger delete-btn">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination with info -->
                            <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                                <div class="text-muted">
                                    Showing {{ ($administrators->currentPage() - 1) * $administrators->perPage() + 1 }}
                                    to {{ min($administrators->currentPage() * $administrators->perPage(), $administrators->total()) }}
                                    of {{ $administrators->total() }} entries
                                </div>
                                <nav aria-label="Page navigation">
                                    {{ $administrators->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <!-- End content -->
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection