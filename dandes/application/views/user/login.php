<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Lurah & Bendahara</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/img/PBM.png') . '?v=' . time(); ?>" type="image/png">



  <style>
    * {
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .background-image {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -2;
    }

    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

    .card-glass {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(15px);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
      color: #fff;
      transition: transform 0.3s ease;
    }

    .card-glass:hover {
      transform: scale(1.01);
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: white;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.6);
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      box-shadow: none;
      color: white;
    }

    .input-group-text {
      background-color: transparent;
      border: none;
      color: #ffffff;
    }

    .btn-login {
      background: #28a745;
      border: none;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background: #218838;
    }

    .logo-img {
      width: 80px;
      height: auto;
    }

    .greeting {
      font-size: 16px;
      color: #d4e4f7;
      margin-bottom: 20px;
    }

    hr {
      border-top: 1px solid rgba(255, 255, 255, 0.3);
    }

    .text-muted {
      color: #e0e0e0 !important;
    }
  </style>
</head>
<body>

  <!-- Background image -->
  <img src="<?= base_url('assets/img/GUNUNGKEMALA.jpg'); ?>" class="background-image" alt="Background">

  <!-- Overlay -->
  <div class="overlay"></div>

  <!-- Login card -->
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
      <div class="card-glass text-center">
        <img src="<?= base_url('assets/img/PBM.png'); ?>" alt="Logo" class="logo-img mb-3">
        <h3 class="mb-2 fw-bold">Selamat Datang</h3>
        <p class="greeting">Sistem Informasi Khusus Lurah & Bendahara</p>
        <hr class="mb-4">

        <form action="<?= base_url('auth/login'); ?>" method="post">
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>
          <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <button type="submit" name="login" class="btn btn-login w-100">
            <i class="fas fa-sign-in-alt me-2"></i>Masuk
          </button>
        </form>

        <div class="mt-4 text-muted small">
          Akses hanya diperuntukkan bagi pejabat terdaftar.<br>
          Keamanan Anda adalah prioritas kami.
        </div>
      </div>
    </div>
  </div>

</body>
</html>
