<!-- Tambahan Style -->
<style>
  .card-header {
    background-color: #0d6efd;
    color: white;
    font-weight: bold;
    font-size: 1rem;
  }

  .btn-dark,
  .btn-primary,
  .btn-danger {
    color: white !important;
  }

  .table th {
    background-color: #e9ecef;
    color: #343a40;
    font-weight: 600;
  }

  .modal-header {
    background-color: #0d6efd;
    color: white;
  }

  .modal-title i {
    margin-right: 6px;
  }

  .form-group label {
    font-weight: 600;
  }

  .table td a {
    color: #0d6efd;
    font-weight: 500;
    text-decoration: underline;
  }

  .btn-sm {
    padding: 4px 10px;
    font-size: 0.8rem;
  }
</style>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
  <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-alt"></i> LPJ Kelurahan</h1>

  <!-- Card -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0"><i class="fas fa-file-alt"></i> LPJ Kelurahan</h6>
      <button class="btn btn-sm btn-warning text-dark" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-plus-circle"></i> Tambah LPJ
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>No Surat</th>
              <th>Kebutuhan</th>
              <th>Jumlah Biaya</th>
              <th>File LPJ</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($lpj as $dat) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $dat['no_surat']; ?></td>
                <td><?= $dat['kebutuhan']; ?></td>
                <td>Rp <?= number_format($dat['jml_biaya'], 0, ',', '.'); ?></td>
                <td>
                  <a href="<?= base_url('uploads/') . $dat['file_lpj']; ?>" target="_blank">
                    <i class="fas fa-file-pdf"></i> Lihat LPJ
                  </a>
                </td>
                <td>
                  <a href="#" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#editModal<?= $dat['id_lpj']; ?>">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="<?= base_url('Laporan/hapuslpj/' . $dat['id_lpj']); ?>"
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah LPJ -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('Laporan/tambahlpj') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-plus-circle"></i> Tambah LPJ
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>No Surat</label>
            <select class="form-control" name="id_dana_keluar" required>
              <option value="" disabled selected>-- Pilih No Surat / Kebutuhan / Jumlah Biaya --</option>
              <?php foreach ($dana as $d) : ?>
                <option value="<?= $d['id_dana_keluar']; ?>">
                  <?= $d['no_surat']; ?> ----- <?= $d['kebutuhan']; ?> ----- <?= number_format($d['jml_biaya'], 0, ',', '.'); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Upload File LPJ <small class="text-muted">(PDF saja)</small></label>
            <input type="file" name="file" class="form-control" accept=".pdf" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i> Batal
          </button>
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<?php foreach ($lpj as $dat) : ?>
  <div class="modal fade" id="editModal<?= $dat['id_lpj']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?= base_url('Laporan/editlpj/' . $dat['id_lpj']); ?>" method="POST" enctype="multipart/form-data">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">
              <i class="fas fa-edit"></i> Edit LPJ
            </h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label>No Surat</label>
              <select name="id_dana_keluar" class="form-control" required>
                <option disabled selected>-- Pilih No Surat / Kebutuhan / Jumlah Biaya --</option>
                <?php foreach ($dana as $d) : ?>
                  <option value="<?= $d['id_dana_keluar']; ?>" <?= $d['id_dana_keluar'] == $dat['id_dana_keluar'] ? 'selected' : ''; ?>>
                    <?= $d['no_surat']; ?> ----- <?= $d['kebutuhan']; ?> ----- <?= number_format($d['jml_biaya'], 0, ',', '.'); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Upload File LPJ <small class="text-muted">(PDF saja)</small></label>
              <input type="file" name="file" class="form-control" accept=".pdf">
              <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah file.</small>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
              <i class="fas fa-times"></i> Batal
            </button>
            <button type="submit" class="btn btn-sm btn-primary">
              <i class="fas fa-save"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
