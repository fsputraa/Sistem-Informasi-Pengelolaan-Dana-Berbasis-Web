<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<div class="container-fluid">
  <h1 class="h3 mb-4 font-weight-bold text-dark"><?= $judul; ?></h1>

  <?php 
  $total_dana_masuk = $dana_masuk;
  $total_dana_keluar = $dana_keluar;
  $sisa_saldo = $sisa_saldo;
?>


  <!-- Summary Cards -->
  <div class="row mb-4">
    <div class="col-md-4 mb-2">
      <div class="card shadow border-0 bg-gradient-primary text-white h-100">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-white-100-bold">Total Dana Masuk</h6>
            <h4 class="font-weight-bold">Rp <?= number_format($total_dana_masuk, 0, ',', '.'); ?></h4>
          </div>
          <i class="fa-solid fa-arrow-trend-up fa-2x"></i>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-2">
      <div class="card shadow border-0 bg-gradient-danger text-white h-100">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-white-100-bold">Total Dana Keluar</h6>
            <h4 class="font-weight-bold">Rp <?= number_format($total_dana_keluar, 0, ',', '.'); ?></h4>
          </div>
          <i class="fa-solid fa-arrow-trend-down fa-2x"></i>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-2">
      <div class="card shadow border-0 bg-gradient-success text-white h-100">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <h6 class="text-white-100-bold">Sisa Saldo</h6>
            <h4 class="font-weight-bold">Rp <?= number_format($sisa_saldo, 0, ',', '.'); ?></h4>
          </div>
          <i class="fa-solid fa-wallet fa-2x"></i>
        </div>
      </div>
    </div>
  </div>

  <a href="<?= base_url('Laporan/cetakPDF'); ?>" target="_blank" class="btn btn-danger mb-3">
  <i class="fa fa-file-pdf"></i> Cetak PDF
</a>

  <!-- Tabel Laporan -->
<div class="card shadow-lg border-0">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover table-bordered text-center align-middle">
        <thead class="thead-dark bg-primary text-white">
          <tr>
            <th><i class="fa-solid fa-calendar-day"></i> No Surat</th>
            <th><i class="fa-solid fa-calendar-day"></i> Tanggal Masuk</th>
            <th><i class="fa-solid fa-building-columns"></i> Sumber Dana</th>
            <th><i class="fa-solid fa-location-dot"></i> Kelurahan</th>
            <th><i class="fa-solid fa-money-bill-wave"></i> Saldo Awal</th>
            <th><i class="fa-solid fa-clipboard-list"></i> Keperluan</th>
            <th><i class="fa-solid fa-file-invoice-dollar"></i> Detail Pengeluaran</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($laporan as $d) : ?>
            <tr>
              <td><?= $d['no_surat']; ?></td>
              <td><?= $d['tgl_masuk']; ?></td>
              <td><?= $d['nama_instansi']; ?></td>
              <td><?= $d['nama_kelurahan']; ?></td>
              <td>Rp <?= number_format($d['saldo_awal'], 0, ',', '.'); ?></td>
              <td><?= $d['keperluan']; ?></td>
              <td>

               <a href="<?= base_url('Laporan/detail_pengeluaran/' . $d['no_surat']) ?>" class="btn btn-outline-primary btn-sm">
    <i class="fa-solid fa-file-lines me-1"></i> Detail Pengeluaran
</a>



              </td>
            </tr>
          <?php endforeach; ?>

          <?php if (empty($laporan)) : ?>
            <tr>
              <td colspan="6" class="text-center text-muted">Belum ada laporan dana masuk.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
