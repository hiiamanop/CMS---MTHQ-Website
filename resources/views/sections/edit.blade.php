@extends('layouts.master')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Section</li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit</li>
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

    <!-- Main content -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Edit Section</h6>
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

                        <form action="{{ route('sections.update', $section->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nama Section -->
                            <label for="name" class="form-label">Nama item</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" name="item" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $section->item) }}" placeholder="Masukkan item Section">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <label for="description" class="form-label">Section</label>
                            <div class="input-group input-group-outline mb-3">
                            <div class="input-group input-group-outline">
                                <input type="text" name="section" class="form-control" value="{{ old('section', $section->section) }}" required>
                            </div>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('sections.index') }}" class="btn btn-secondary ms-2">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer py-4">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            <a href="https://mhtq.com" class="font-weight-bold" target="_blank">Copyright Mahad MHTQ</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">MHTQ.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- End Main Content -->
</main>
@endsection
