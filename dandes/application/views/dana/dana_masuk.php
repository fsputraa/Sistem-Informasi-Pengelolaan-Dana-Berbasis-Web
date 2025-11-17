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
      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDanaMasuk">
        <i class="fas fa-plus"></i> Tambah Dana
      </button>
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
              <th>Aksi</th>
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
                <td>
                  <!-- Edit -->
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditDanaMasuk<?= $dat['id_dana_masuk']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <!-- Hapus -->
                  <a href="<?= base_url('Dana_masuk/hapusdanamasuk/') . $dat['id_dana_masuk']; ?>" class="btn btn-sm btn-danger btn-hapus">
                    <i class="fas fa-trash-alt"></i>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalDanaMasuk" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <form action="<?= base_url('Dana_masuk/tambahdanamasuk') ?>" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dana Masuk</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      

      <div class="modal-body">
        <div class="form-group">
  <label>Nomor Surat</label>
  <input type="text" name="no_surat" class="form-control" required>
</div>
        <div class="form-group">
          <label>Tanggal Masuk</label>
          <input type="date" name="tgl_masuk" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Nama Instansi</label>
          <select name="id_instansi" class="form-control" required>
            <?php foreach ($instansi as $ins) : ?>
              <option value="<?= $ins['id_instansi']; ?>"><?= $ins['nama_instansi']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Nama Kelurahan</label>
          <select name="id_kelurahan" class="form-control" required>
            <?php foreach ($kelurahan as $ds) : ?>
              <option value="<?= $ds['id_kelurahan']; ?>"><?= $ds['nama_kelurahan']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>Jumlah Dana</label>
          <input type="number" name="saldo_awal" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Keperluan</label>
          <input type="text" name="keperluan" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL EDIT -->
<?php foreach ($danamasuk as $dat) : ?>
  <div class="modal fade" id="modalEditDanaMasuk<?= $dat['id_dana_masuk']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <form action="<?= base_url('Dana_masuk/editdanamasuk/') . $dat['id_dana_masuk']; ?>" method="POST" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Dana Masuk</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        

        <div class="modal-body">
          <div class="form-group">
  <label>Nomor Surat</label>
  <input type="text" name="no_surat" class="form-control" value="<?= $dat['no_surat']; ?>" required>
</div>
          <div class="form-group">
            <label>Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" class="form-control" value="<?= $dat['tgl_masuk']; ?>" required>
          </div>
          <div class="form-group">
            <label>Nama Instansi</label>
            <select name="id_instansi" class="form-control" required>
              <?php foreach ($instansi as $ins) : ?>
                <option value="<?= $ins['id_instansi']; ?>" <?= $ins['id_instansi'] == $dat['id_instansi'] ? 'selected' : ''; ?>>
                  <?= $ins['nama_instansi']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama kelurahan</label>
            <select name="id_kelurahan" class="form-control" required>
              <?php foreach ($kelurahan as $ds) : ?>
                <option value="<?= $ds['id_kelurahan']; ?>" <?= $ds['id_kelurahan'] == $dat['id_kelurahan'] ? 'selected' : ''; ?>>
                  <?= $ds['nama_kelurahan']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Dana</label>
            <input type="number" name="saldo_awal" class="form-control" value="<?= $dat['saldo_awal']; ?>" required>
          </div>
          <div class="form-group">
            <label>Keperluan</label>
            <input type="text" name="keperluan" class="form-control" value="<?= $dat['keperluan']; ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
<?php endforeach; ?>

<!-- SweetAlert2 Hapus Konfirmasi -->
<script>
  document.querySelectorAll('.btn-hapus').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const href = this.getAttribute('href');
      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = href;
        }
      });
    });
  });
</script>
