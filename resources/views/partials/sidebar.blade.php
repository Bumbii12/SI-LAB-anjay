<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo-unib.png') }}" alt="Logo" class="logo-img">
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data.mahasiswas.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Data Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data.asistens.index') }}">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Data Asisten</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('jadwal-praktikum.index') }}">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Jadwal Praktikum</span>
            </a>
        </li>
        <!-- Absensi Menu -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Absensi</span>
                <i class="menu-arrow"></i>
            </a>
            
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.hasil-absensi.index') }}">Absensi Mahasiswa</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.rekap') }}">Absensi Asisten</a></li>
                </ul>
            </div>
        </li>
        <!-- Arsip Menu -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basis" aria-expanded="false" aria-controls="ui-basis">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Arsip</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basis">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.arsip') }}">Arsip Praktikum</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.nilai') }}">Arsip Nilai Praktikum</a></li>
                </ul>
            </div>
        </li>
        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link logout-button" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <button type="button" class="btn btn-danger btn-block d-flex justify-content-center align-items-center">
                    <i class="icon-power-off menu-icon"></i>
                    <span class="menu-title">Logout</span>
                </button>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>


</nav>
