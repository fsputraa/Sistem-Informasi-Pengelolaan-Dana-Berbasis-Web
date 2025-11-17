<style>
#sidebarToggle {
  width: 50px;
  height: 50px;
  background-color: #111; /* Hitam elegan */
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  transition: 0.3s ease;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  cursor: pointer;
  position: relative;
}

#sidebarToggle::before {
  content: '\f0c9'; /* fa-bars */
  font-family: 'Font Awesome 6 Free';
  font-weight: 900;
  transition: transform 0.3s ease-in-out;
}

/* Hover effect */
#sidebarToggle:hover {
  background-color: #222;
  transform: scale(1.1);
}

/* Aktif = berubah jadi 'X' */
#sidebarToggle.active::before {
  content: '\f00d'; /* fa-times */
}
</style>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion shadow-sm" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gradient-dark" href="<?= base_url(); ?>" style="height: 100px;">
  <img src="<?= base_url('assets/img/PBM.png'); ?>" alt="Logo" style="max-height: 70px; height: auto; width: auto; object-fit: contain;">
</a>


    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
      <a class="nav-link" href="<?= base_url(); ?>">
        <i class="fas fa-home"></i>
        <span>Beranda</span></a>
    </li>

    <?php if($this->session->userdata('level')=='admin'){ ?>  
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages">
        <i class="fas fa-cogs"></i>
        <span>Master Data</span>
      </a>
      <div id="collapsePages" class="collapse">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url('User'); ?>"><i class="fas fa-user-cog me-2"></i> Data User</a>
          <a class="collapse-item" href="<?= base_url('Instansi'); ?>"><i class="fas fa-building me-2"></i> Data Instansi</a>
          <a class="collapse-item" href="<?= base_url('kelurahan'); ?>"><i class="fas fa-map-marked-alt me-2"></i> Data Kelurahan</a>
        </div>
      </div>
    </li>
    <?php } ?>


<?php if($this->session->userdata('level')=='admin'){ ?>  
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonitoring">
        <i class="fas fa-eye"></i>
        <span>Monitoring</span>
      </a>
      <div id="collapseMonitoring" class="collapse">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url('Dana_masukadmin'); ?>"><i class="fas fa-donate me-2"></i> Dana Masuk</a>
          <a class="collapse-item" href="<?= base_url('Dana_keluaradmin'); ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Dana Keluar</a>
        </div>
      </div>
    </li>
    <?php } ?>


<?php if($this->session->userdata('level')=='user'){ ?>  
     <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMonitoring">
        <i class="fas fa-eye"></i>
        <span>Monitoring</span>
      </a>
      <div id="collapseMonitoring" class="collapse">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url('Dana_masuk'); ?>"><i class="fas fa-donate me-2"></i> Dana Masuk</a>
          <a class="collapse-item" href="<?= base_url('Dana_keluar'); ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Dana Keluar</a>
        </div>
      </div>
    </li>
    <?php } ?>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport">
        <i class="fas fa-clipboard-list"></i>
        <span>Laporan</span>
      </a>
      <div id="collapseReport" class="collapse">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="<?= base_url('Laporan'); ?>"><i class="fas fa-chart-line me-2"></i> Laporan Dana</a>
          <a class="collapse-item" href="<?= base_url('Laporan/pekerjaan'); ?>"><i class="fas fa-tools me-2"></i> LPJ</a>
        </div>
      </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="d-flex justify-content-center my-4">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light topbar mb-4 shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars text-white"></i>
        </button>

        <ul class="navbar-nav ml-auto">

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown">
              <span class="mr-2 d-none d-lg-inline small"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
              <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profileuser.png') ?>">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>
      </nav>

      <script>
  $('#sidebarToggle').on('click', function () {
    $(this).toggleClass('active');
    // Di sini bisa tambahkan fungsi toggle sidebar beneran
  });
</script>

