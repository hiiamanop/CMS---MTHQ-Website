<aside class="sidenav navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">MHTQ Admin Panel</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="{{route('dashboard')}}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">MHTQ</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('administrators.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Administrator MHTQ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('warga.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Jumlah Warga</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('roles.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Kelompok Pengguna</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Konten Utama</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('berandas.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Beranda</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('kegiatan_santris.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Kegiatan Santri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('mhtq_duas.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">MHTQ 2</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('kontaks.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Kontak</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Program</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_bahasas.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Bahasa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_keamanan.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Keamanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_kesehatan.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Kesehatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_olahraga.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Olahraga</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_pengasuhan.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Pengasuhan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_tahfidz.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Tahfidz</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_talim.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Ta'lim</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_ubudiyah.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Ubudiyah</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('program_wirausaha.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Wirausaha</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Publikasi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('galeris.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('list-beritas.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">List Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('detail_beritas.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Detail Berita</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Tentang</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('tentang_mhtq_pendiri.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Tentang Pendiri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('tentang_mhtq_pimpinan.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Tentang Pimpinan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('tentang_mhtq_profiles.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Tentang Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('mhtq_fasilitass.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">MHTQ Fasilitas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('mhtq_keunggulans.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">MHTQ Keunggulan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('kalender_akademiks.index')}}">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Kalender Akademik</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn btn-outline-dark mt-4 w-100" href="">Dokumentasi</a>
            <!-- Form Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-dark w-100">Keluar</button>
            </form>
        </div>
    </div>
</aside>