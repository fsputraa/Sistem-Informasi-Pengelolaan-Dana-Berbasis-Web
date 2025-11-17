<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Style -->
<style>
  .card-header.bg-primary {
    background-color: #0d6efd !important;
    color: white;
    font-weight: bold;
  }

  .btn-sm {
    font-size: 0.85rem;
    padding: 6px 12px;
    font-weight: 500;
  }

  .btn-success, .btn-primary, .btn-danger {
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    color: white !important;
  }

  .modal-header {
    background-color: #0d6efd;
    color: white;
  }

  .modal-title {
    font-weight: bold;
  }

  .table th {
    background-color: #f8f9fc;
    color: #343a40;
  }
</style>

<!-- Flashdata Alert dengan SweetAlert2 -->
<script>
  <?php if ($this->session->flashdata('success')) : ?>
    Swal.fire({
      icon: 'success',
      title: 'Sukses!',
      text: '<?= $this->session->flashdata('success'); ?>',
      showConfirmButton: false,
      timer: 2500
    });
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Gagal!',
      text: '<?= $this->session->flashdata('error'); ?>',
      showConfirmButton: false,
      timer: 2500
    });
  <?php endif; ?>
</script>

<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-wallet"></i> Dana Masuk</h1>

  <div class="card shadow mb-4">
    <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0"><i class="fas fa-plus-circle"></i> Data Dana Masuk</h6>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>No Surat</th>
              <th>Tanggal Masuk</th>
              <th>Sumber Dana</th>
              <th>Kelurahan</th>
              <th>Jumlah Dana</th>
              <th>Keperluan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($danamasuk as $dat) : ?>
              <tr>
                <td><?= $dat['no_surat']; ?></td>
                <td><?= $dat['tgl_masuk']; ?></td>
                <td><?= $dat['nama_instansi']; ?></td>
                <td><?= $dat['nama_kelurahan']; ?></td>
                <td>Rp <?= number_format($dat['saldo_awal'], 0, ',', '.'); ?></td>
                <td><?= $dat['keperluan']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
