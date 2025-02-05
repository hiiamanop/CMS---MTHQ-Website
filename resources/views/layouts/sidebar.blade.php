<aside class="sidenav navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" {{route('dashboard')}} " target="_blank">
            <img src="{{ asset('assets/img/logo.png') }}" class="navbar-brand-img" width="26" height="26" alt="main_logo">
            <span class="ms-1 text-sm text-dark">MTHQ Admin Panel</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">

                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">MTHQ</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('administrators.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">User</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('warga.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Jumlah Warga</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{route('roles.index')}}">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Role</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Manajemen Item</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('sections.index') ? 'active' : '' }}" href="{{ route('sections.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('sections.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Section Item</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Halaman Utama</h6>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link text-dark {{ request()->routeIs('berandas.index') ? 'active' : '' }}" href="{{ route('berandas.index') }}"> -->
                    <a class="nav-link text-dark" href="{{route('berandas.index')}}">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Beranda</span>
                    </a>
            </li>


            <!-- <li class="nav-item">
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
            </li> -->

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Publikasi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('galeris.index') ? 'active' : '' }}" href="{{ route('galeris.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('galeris.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Galeri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('list_beritas.index') ? 'active' : '' }}" href="{{ route('list_beritas.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('list_beritas.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Highlight Berita</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('detail-beritas.index') ? 'active' : '' }}" href="{{ route('detail-beritas.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('detail-beritas.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Detail Berita</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Program</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_bahasas.index') ? 'active' : '' }}" href="{{ route('program_bahasas.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_bahasas.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Bahasa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_ekstrakurikuler.index') ? 'active' : '' }}" href="{{ route('program_ekstrakurikuler.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_ekstrakurikuler.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Ekstrakurikuler</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_keamanan.index') ? 'active' : '' }}" href="{{ route('program_keamanan.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_keamanan.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Keamanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_kesehatans.index') ? 'active' : '' }}" href="{{ route('program_kesehatans.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_kesehatans.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Kesehatan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_olahraga.index') ? 'active' : '' }}" href="{{ route('program_olahraga.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_olahraga.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Olahraga</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_pengasuhan.index') ? 'active' : '' }}" href="{{ route('program_pengasuhan.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_pengasuhan.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Pengasuhan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_tahfidz.index') ? 'active' : '' }}" href="{{ route('program_tahfidz.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_tahfidz.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Tahfidz</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_talim.index') ? 'active' : '' }}" href="{{ route('program_talim.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_talim.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Ta'lim</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('program_ubudiyah.index') ? 'active' : '' }}" href="{{ route('program_ubudiyah.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('program_ubudiyah.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Program Ubudiyah</span>
                </a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link text-dark {{ request()->routeIs('program_wirausaha.index') ? 'active' : '' }}" href="{{ route('program_wirausaha.index') }}"> -->

                    <a class="nav-link text-dark" href="{{route('program_wirausaha.index')}}">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Program Wirausaha</span>
                    </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Lainnya</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('kalender_akademiks.index') ? 'active' : '' }}" href="{{ route('kalender_akademiks.index') }}">

                    <!-- <a class="nav-link text-dark" href="{{route('kalender_akademiks.index')}}"> -->
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Kalender Akademik</span>
                </a>
            </li>

            <!-- <li class="nav-item mt-3">
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
            </li> -->
        </ul>
    </div>
    <div class="sidenav-footer w-100 mt-3 ">
        <div class="mx-3">
            <!-- Form Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn bg-gradient-dark w-100">Keluar</button>
            </form>
        </div>
    </div>

    <!-- Add this script at the bottom of your sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find active menu item
            const activeItem = document.querySelector('.nav-link.active');
            if (activeItem) {
                // Scroll the active item into view with smooth behavior
                activeItem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            // Add click handlers to all nav links
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Remove active class from all links
                    navLinks.forEach(l => l.classList.remove('active', 'bg-gradient-dark', 'text-white'));

                    // Add active class to clicked link
                    this.classList.add('active', 'bg-gradient-dark', 'text-white');

                    // Store active menu item in localStorage
                    localStorage.setItem('activeMenu', this.getAttribute('href'));
                });
            });

            // Check localStorage on page load
            const storedActiveMenu = localStorage.getItem('activeMenu');
            if (storedActiveMenu) {
                const storedLink = document.querySelector(`a[href="${storedActiveMenu}"]`);
                if (storedLink) {
                    storedLink.classList.add('active', 'bg-gradient-dark', 'text-white');
                }
            }
        });
    </script>
</aside>