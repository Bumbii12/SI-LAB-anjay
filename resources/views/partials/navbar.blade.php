<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <!-- Gunakan asset() untuk gambar logo -->
    <a class="navbar-brand brand-logo mr-4" href="index.html">
      <img src="{{ asset('images/logosilab.png') }}" class="mr-2" alt="logo" style="width: 150px; height: auto;"/>
    </a>
    <a class="navbar-brand brand-logo-mini" href="index.html">
      <img src="{{ asset('images/logosilab.png') }}" alt="logo"/>
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <!-- Tombol Toggle Minimize -->
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    
    <!-- Menu Items -->
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Just now
              </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                Private message
              </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted">
                2 days ago
              </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <!-- Gunakan asset() untuk gambar profile -->
          <img src="{{ asset('images/logo-unib.png') }}" alt="profile"/>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            Settings
          </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    
    <!-- Tombol Toggle Offcanvas untuk perangkat kecil -->
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>

<!-- JavaScript (Untuk Fitur Minimize Toggle) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Inisialisasi Toggle Minimize
  $(document).ready(function() {
    $('[data-toggle="minimize"]').on('click', function() {
      $('body').toggleClass('sidebar-mini');
    });
  });
</script>

<!-- CSS (Untuk Fitur Sidebar Mini) -->
<style>
  /* Menyembunyikan sidebar atau navbar-menu-wrapper ketika sidebar-mini diaktifkan */
  body.sidebar-mini .navbar-menu-wrapper {
    width: 50px;  /* Sesuaikan dengan kebutuhan, pastikan lebih kecil untuk menyembunyikan menu */
    overflow: hidden;
  }

  /* Menyembunyikan elemen-elemen menu di dalam navbar */
  body.sidebar-mini .navbar-nav {
    display: none;
  }

  /* Menambahkan transisi untuk efek smooth ketika minimize */
  body.sidebar-mini .navbar-menu-wrapper {
    transition: width 0.3s ease;
  }
  
  /* Menambahkan animasi untuk ikon menu saat toggle */
  body.sidebar-mini .navbar-toggler {
    transition: transform 0.3s ease;
  }
</style>
