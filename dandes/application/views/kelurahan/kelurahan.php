<!-- Tambahan Style -->
<style>
  .card-header.py-3 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0d6efd;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .card-header.py-3 i,
  .card-header .btn i {
    margin-right: 8px;
  }

  .btn-sm {
    color: #000 !important;
  }

  .modal-header {
    background-color: #0d6efd;
    color: white;
  }

  .modal-footer .btn,
  .btn-danger,
  .btn-primary,
  .btn-secondary {
    color: white !important;
  }
</style>

<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-map-marked-alt"></i> Data Kelurahan</h1>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-map-marked-alt"></i> Data Kelurahan</h6>
      <button class="btn btn-sm btn-warning text-dark" data-toggle="modal" data-target="#modalTambahKelurahan">
        <i class="fas fa-plus-circle"></i> Tambah Kelurahan
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="dataTable">
          <thead class="thead-light">
            <tr>
              <th><i class="fas fa-map-marker-alt"></i> Nama Kelurahan</th>
              <th><i class="fas fa-map"></i> Alamat</th>
              <th><i class="fas fa-user-tie"></i> Kepala Kelurahan</th>
              <th><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($kelurahan as $dat) : ?>
              <tr>
                <td><?= $dat['nama_kelurahan']; ?></td>
                <td><?= $dat['alamat']; ?></td>
                <td><?= $dat['kepala_kelurahan']; ?></td>
                <td>
                  <button class="btn btn-sm btn-warning text-dark btn-edit"
                          data-id="<?= $dat['id_kelurahan']; ?>"
                          data-nama="<?= $dat['nama_kelurahan']; ?>"
                          data-alamat="<?= $dat['alamat']; ?>"
                          data-kepala="<?= $dat['kepala_kelurahan']; ?>"
                          data-toggle="modal" data-target="#modalEditKelurahan">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <a href="<?= base_url('kelurahan/hapuskelurahan/') . $dat['id_kelurahan']; ?>" class="btn btn-sm btn-danger text-white btn-hapus">
                    <i class="fas fa-trash-alt"></i> Hapus
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahKelurahan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('kelurahan/tambahkelurahan') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Tambah Kelurahan</h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kelurahan</label>
            <input type="text" class="form-control form-control-sm" name="nama_kelurahan" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control form-control-sm" name="alamat" required>
          </div>
          <div class="form-group">
            <label>Kepala Kelurahan</label>
            <input type="text" class="form-control form-control-sm" name="kepala_kelurahan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-check-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditKelurahan" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('kelurahan/editkelurahan') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Kelurahan</h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_kelurahan" id="edit_id_kelurahan">
          <div class="form-group">
            <label>Nama Kelurahan</label>
            <input type="text" class="form-control form-control-sm" name="nama_kelurahan" id="edit_nama_kelurahan" required>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control form-control-sm" name="alamat" id="edit_alamat" required>
          </div>
          <div class="form-group">
            <label>Kepala Kelurahan</label>
            <input type="text" class="form-control form-control-sm" name="kepala_kelurahan" id="edit_kepala_kelurahan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert2 + jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    // Modal edit auto-isi
    $('.btn-edit').click(function () {
      $('#edit_id_kelurahan').val($(this).data('id'));
      $('#edit_nama_kelurahan').val($(this).data('nama'));
      $('#edit_alamat').val($(this).data('alamat'));
      $('#edit_kepala_kelurahan').val($(this).data('kepala'));
    });

    // Konfirmasi hapus
    $('.btn-hapus').click(function (e) {
      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data akan dihapus permanen!',
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

    // Notifikasi sukses
    <?php if ($this->session->flashdata('success')) : ?>
      Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '<?= $this->session->flashdata('success'); ?>',
        showConfirmButton: false,
        timer: 2500
      });
    <?php endif; ?>
  });
</script>
