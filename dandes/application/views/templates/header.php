<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Dashboard Sistem Informasi Lurah & Sekretaris">
  <meta name="author" content="">

  <title><?= $judul; ?> | Dana Kelurahan</title>

  <!-- Font Awesome -->
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;500;700&display=swap" rel="stylesheet">

  <!-- SB Admin 2 CSS -->
  <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
  <!-- DataTables CSS -->
  <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/img/PBM.png'); ?>" type="image/png">


  <style>
    body {
      font-family: 'Public Sans', sans-serif;
      background-color: #f8f9fc;
    }
    .sidebar-brand img {
      width: 60px;
      border-radius: 10px;
    }
    .sidebar-dark .nav-item .nav-link {
      font-size: 15px;
    }
    .topbar {
      background: linear-gradient(to right, #3b8d99, #6b6b83, #aa4b6b);
    }
  </style>

  <style>
  .bg-gradient-dark {
    background: linear-gradient(180deg, #2c2c2c 10%, #1e1e1e 100%) !important;
  }

  .sidebar-dark .nav-item .nav-link {
    color: #d1d1d1;
  }

  .sidebar-dark .nav-item .nav-link:hover {
    color: #fff;
    background-color: #343a40;
  }

  .sidebar-dark .nav-item .nav-link i {
    color: #bfbfbf;
  }

  .sidebar-dark .collapse-inner {
    background-color: #2b2b2b;
  }

  .sidebar-dark .collapse-item {
    color: #e0e0e0;
  }

  .sidebar-dark .collapse-item:hover {
    color: #ffffff;
    background-color: #444;
    border-radius: 5px;
  }

  .sidebar-divider {
    border-top: 1px solid #444 !important;
  }

  .navbar-nav {
    transition: background-color 0.3s ease-in-out;
  }

  .sidebar-brand img {
    filter: drop-shadow(1px 1px 2px #000000aa);
  }
</style>

<style>
  /* ========================== */
  /* === TOPBAR DARK ELEGAN === */
  /* ========================== */
  .topbar {
    background: #2b2b2b !important; /* Dark elegan */
    color: white;
    border-bottom: 1px solid #444;
  }

  .topbar .nav-link,
  .topbar .nav-link span,
  .topbar .nav-link i {
    color: white !important;
  }

  /* ============================= */
  /* === DROPDOWN LOGOUT FIXED === */
  /* ============================= */
  .dropdown-menu {
    background-color: #2b2b2b !important;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }

  .dropdown-menu .dropdown-item {
    color: #f0f0f0 !important;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
  }

  .dropdown-menu .dropdown-item i {
    color: #f0f0f0 !important;
    margin-right: 6px;
  }

  .dropdown-menu .dropdown-item:hover {
    background-color: #444 !important;
    color: #ffffff !important;
  }

  .dropdown-menu .dropdown-item:hover i {
    color: #ffffff !important;
  }

  /* Optional: biar animasi muncul dropdown smooth */
  .dropdown-menu-right {
    animation: fadeIn 0.2s ease-in-out;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>


</head>
