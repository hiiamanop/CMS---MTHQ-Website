@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Kelompok Pengguna</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav d-flex align-items-center  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
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
                            <h6 class="text-white text-capitalize ps-3">Tambah Role</h6>
                        </div>
                    </div>

                    <div class="card-body pb-2">
                        <!-- Form for creating role -->
                        <form role="form" method="POST" action="{{ route('roles.store') }}" class="text-start" id="roleForm">
                            @csrf

                            <!-- Error message handling -->
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <label class="form-label">Role</label>

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="role" class="form-control" value="{{ old('role') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add this script for notifications -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if browser supports notifications
            if ("Notification" in window) {
                // Request permission if not already granted
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        // Create notification
                        new Notification("Sukses", {
                            body: "{{ session('success') }}",
                            icon: "/path/to/your/icon.png" // Optional: Add an icon path
                        });
                    } else {
                        // Fallback alert if notifications are not allowed
                        alert("{{ session('success') }}");
                    }
                });
            } else {
                // Fallback for browsers that don't support notifications
                alert("{{ session('success') }}");
            }
        });
    </script>
    @endif
</main>
@endsection