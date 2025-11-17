<!-- Font & Icon CDN -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" href="<?= base_url('assets/img/PBM.png'); ?>" type="image/png">


<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #f8f9fa, #e9f0ff);
  }

  .transition {
    transition: all 0.3s ease-in-out;
  }

  .transition:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 28px rgba(0, 0, 0, 0.15);
  }

  .card-custom {
    border-radius: 20px;
    padding: 25px;
    background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
    box-shadow: 0 8px 24px rgba(0,0,0,0.05);
  }

  .card-icon {
    font-size: 2.4rem;
    margin-bottom: 12px;
  }

  .clock {
    font-size: 1.2rem;
    font-weight: 600;
    color: #444;
    margin-top: 4px;
  }

  .glass {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.75);
    border-radius: 20px;
    padding: 1.25rem 1.75rem;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
  }

  .section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
  }

  .hover-glow:hover {
    box-shadow: 0 0 14px rgba(0, 174, 255, 0.35);
  }

  .small-muted {
    font-size: 0.85rem;
    color: #888;
  }

  .welcome-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #0056b3;
  }
</style>

<script>
  function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString('id-ID');
    const clockElement = document.getElementById("clock");
    if (clockElement) {
      clockElement.innerText = time;
    }
  }

  // Tunggu sampai halaman selesai loading
  window.onload = function () {
    updateClock(); // tampilkan langsung
    setInterval(updateClock, 1000); // update tiap detik
  };
</script>



<div class="container-fluid py-4">

  <!-- Welcome Section -->
  <div class="text-center mb-4">
    <h2 class="welcome-title">📊 Dashboard Sistem Informasi Monitoring Dana Kelurahan</h2>
    <p class="text-muted small">Kelola data dana masuk dan keluar dengan mudah & transparan.</p>
    <div class="clock" id="clock"></div>
  </div>

  <!-- Statistik -->
  <div class="row mb-4">
    <div class="col-md-4 mb-3">
      <div class="card card-custom text-center transition hover-glow">
        <div class="text-primary card-icon"><i class="fa-solid fa-wallet"></i></div>
        <h6 class="text-muted">Total Dana Masuk</h6>
        <h4 class="fw-bold text-dark">Rp <?= number_format($dana_masuk, 0, ',', '.'); ?></h4>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="card card-custom text-center transition hover-glow">
        <div class="text-danger card-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
        <h6 class="text-muted">Total Dana Keluar</h6>
        <h4 class="fw-bold text-dark">Rp <?= number_format($dana_keluar, 0, ',', '.'); ?></h4>
      </div>
    </div>

    <div class="col-md-4 mb-3">
      <div class="card card-custom text-center transition hover-glow">
        <div class="text-success card-icon"><i class="fa-solid fa-piggy-bank"></i></div>
        <h6 class="text-muted">Sisa Saldo</h6>
        <h4 class="fw-bold text-dark">Rp <?= number_format($sisa_saldo, 0, ',', '.'); ?></h4>
      </div>
    </div>
  </div>

  <!-- Navigasi Menu -->
  <h5 class="section-title mb-3">🚀 Menu Utama</h5>
  <div class="row">
    <div class="col-lg-4 mb-4">
      <a href="<?= base_url("Dana_masuk"); ?>" class="text-decoration-none">
        <div class="glass text-center transition hover-glow">
          <div class="text-success card-icon"><i class="fa-solid fa-arrow-down-wide-short"></i></div>
          <h5 class="text-dark fw-semibold">Dana Masuk</h5>
          <p class="small-muted">Pantau semua pemasukan dana secara real-time.</p>
        </div>
      </a>
    </div>

    <div class="col-lg-4 mb-4">
      <a href="<?= base_url("Dana_keluar"); ?>" class="text-decoration-none">
        <div class="glass text-center transition hover-glow">
          <div class="text-danger card-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
          <h5 class="text-dark fw-semibold">Dana Keluar</h5>
          <p class="small-muted">Cek & kelola pengeluaran dengan mudah dan transparan.</p>
        </div>
      </a>
    </div>

    <div class="col-lg-4 mb-4">
      <a href="<?= base_url("Laporan"); ?>" class="text-decoration-none">
        <div class="glass text-center transition hover-glow">
          <div class="text-info card-icon"><i class="fa-solid fa-file-lines"></i></div>
          <h5 class="text-dark fw-semibold">Laporan Dana</h5>
          <p class="small-muted">Lihat laporan dan histori dana kelurahan dengan lengkap.</p>
        </div>
      </a>
    </div>
  </div>
</div>
