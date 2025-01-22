<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-logo">
      <img src="{{ asset('images/logo-unib.png') }}" alt="Logo" class="logo-img">
  </div>
  <ul class="nav">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('asisten.dashboard') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('asisten.absensi.mahasiswa') }}">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Absensi Mahasiswa</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('absensi.create') }}">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Absensi Asisten</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('asisten.nilai') }}">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Nilai Mahasiswa</span>
          </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('asisten.arsip') }}">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Arsip Praktikum</span>
          </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('asisten.jadwal.index') }}">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Jadwal Praktikum</span>
        </a>
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
