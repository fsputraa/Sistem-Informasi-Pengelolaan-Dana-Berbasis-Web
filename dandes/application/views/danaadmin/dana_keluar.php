<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
  .card-header.bg-danger {
    background-color: #dc3545 !important;
    color: white;
    font-weight: bold;
  }

  .btn-sm {
    font-size: 0.85rem;
    padding: 6px 12px;
  }

  .table th {
    background-color: #f8f9fc;
    color: #343a40;
  }

  .modal-header {
    background-color: #dc3545;
    color: white;
  }

  .modal-title {
    font-weight: bold;
  }

  .btn-danger, .btn-primary, .btn-success {
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    color: white !important;
  }
</style>

<!-- Notifikasi Flash -->
<script>
  <?php if ($this->session->flashdata('success')) : ?>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: '<?= $this->session->flashdata('success'); ?>',
      showConfirmButton: false,
      timer: 2500
    });
  <?php elseif ($this->session->flashdata('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '<?= $this->session->flashdata('error'); ?>',
      showConfirmButton: false,
      timer: 3000
    });
  <?php endif; ?>
</script>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-cash-register"></i> Dana Keluar</h1>

  <div class="card shadow mb-4">
    <div class="card-header bg-danger d-flex justify-content-between align-items-center">
      <h6 class="m-0"><i class="fas fa-minus-circle"></i> Data Dana Keluar</h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>No Surat</th>
              <th>Tanggal Keluar</th>
              <th>Nama Kelurahan</th>
              <th>Kebutuhan</th>
              <th>Jumlah Biaya</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($danakeluar as $dat) : ?>
              <tr>
                <td><?= $dat['no_surat']; ?></td>
                <td><?= $dat['tgl_keluar']; ?></td>
                <td><?= $dat['nama_kelurahan']; ?></td>
                <td><?= $dat['kebutuhan']; ?></td>
                <td>Rp <?= number_format($dat['jml_biaya'], 0, ',', '.'); ?></td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($danakeluar)) : ?>
              <tr>
                <td colspan="5" class="text-muted text-center">Belum ada data dana keluar.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
