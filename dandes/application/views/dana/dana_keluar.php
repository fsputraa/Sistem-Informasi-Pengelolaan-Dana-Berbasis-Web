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
      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalDanaKeluar">
        <i class="fas fa-plus-circle"></i> Tambah Data
      </button>
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
              <th>Aksi</th>
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
                <td>
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $dat['id_dana_keluar']; ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <a href="<?= base_url('Dana_keluar/hapus/' . $dat['id_dana_keluar']); ?>" 
                    class="btn btn-sm btn-danger tombol-hapus" data-nama="<?= $dat['no_surat']; ?>">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
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

<!-- MODAL TAMBAH DANA KELUAR -->
<div class="modal fade" id="modalDanaKeluar" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <form action="<?= base_url('Dana_keluar/tambahdanakeluar') ?>" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dana Keluar</h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      
      <div class="modal-body">

       <div class="form-group">
  <label>No Surat</label>
  <select name="no_surat" class="form-control" id="selectno_surat" required>
    <option disabled selected>-- Pilih Nomor Surat dari Dana Masuk --</option>
    <?php foreach ($no_surat_masuk as $kp) : ?>
      <option value="<?= htmlspecialchars($kp['no_surat']); ?>"><?= htmlspecialchars($kp['no_surat']); ?></option>
    <?php endforeach; ?>
  </select>
</div>

<!-- Tambahkan ini -->
<div id="sisa-saldo-info" class="text-info font-weight-bold mb-3 ml-1"></div>
        <div class="form-group">
          <label>Tanggal Keluar</label>
          <input type="date" name="tgl_keluar" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Nama Kelurahan</label>
          <select name="id_kelurahan" class="form-control" required>
            <option disabled selected>-- Pilih Kelurahan --</option>
            <?php foreach ($kelurahan as $dat) : ?>
              <option value="<?= $dat['id_kelurahan']; ?>"><?= $dat['nama_kelurahan']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
       

<div class="form-group">
  <label>Kebutuhan</label>
  <input type="text" name="kebutuhan" class="form-control" placeholder="Contoh: Beli aspal, sewa alat, dll" required>
</div>

        <div class="form-group">
          <label>Jumlah Biaya</label>
          <input type="number" name="jml_biaya" class="form-control" required>
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
<?php foreach ($danakeluar as $dat) : ?>
  <div class="modal fade" id="editModal<?= $dat['id_dana_keluar']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <form action="<?= base_url('Dana_keluar/edit/' . $dat['id_dana_keluar']); ?>" method="POST" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Dana Keluar</h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>No Surat</label>
            <select name="no_surat" class="form-control" required>
              <?php foreach ($no_surat_masuk as $kp) : ?>
                <option value="<?= htmlspecialchars($kp['no_surat']); ?>" <?= $kp['no_surat'] == $dat['no_surat'] ? 'selected' : ''; ?>>
                  <?= htmlspecialchars($kp['no_surat']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal Keluar</label>
            <input type="date" name="tgl_keluar" class="form-control" value="<?= $dat['tgl_keluar']; ?>" required>
          </div>
          <div class="form-group">
            <label>Nama Kelurahan</label>
            <select name="id_kelurahan" class="form-control" required>
              <?php foreach ($kelurahan as $ds) : ?>
                <option value="<?= $ds['id_kelurahan']; ?>" <?= $ds['id_kelurahan'] == $dat['id_kelurahan'] ? 'selected' : ''; ?>>
                  <?= $ds['nama_kelurahan']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          
          <div class="form-group">
  <label>Kebutuhan</label>
  <input type="text" name="kebutuhan" class="form-control" value="<?= htmlspecialchars($dat['kebutuhan']); ?>" required>
</div>

          <div class="form-group">
            <label>Jumlah Biaya</label>
            <input type="number" name="jml_biaya" class="form-control" value="<?= $dat['jml_biaya']; ?>" required>
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

<!-- KONFIRMASI HAPUS SweetAlert2 -->
<script>
  document.querySelectorAll('.tombol-hapus').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const href = this.getAttribute('href');
      const nama = this.getAttribute('data-nama');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "no_surat '" + nama + "' akan dihapus permanen.",
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

<script>
  $(document).ready(function () {
    function updateSaldono_surat() {
      const no_surat = $('#selectno_surat').val();
      const id_kelurahan = $('select[name="id_kelurahan"]').val();
      if (!no_surat || !id_kelurahan) {
        $('#sisa-saldo-info').html('');
        return;
      }

      $.ajax({
        url: '<?= base_url('Dana_keluar/getSaldono_surat') ?>',
        method: 'GET',
        data: {
          no_surat: no_surat,
          id_kelurahan: id_kelurahan
        },
        success: function (response) {
          const saldo = parseInt(response);
          const format = saldo.toLocaleString('id-ID');
          $('#sisa-saldo-info').html(`Sisa saldo untuk no_surat ini: <strong>Rp ${format}</strong>`);
        },
        error: function () {
          $('#sisa-saldo-info').html('<span class="text-danger">Gagal ambil saldo.</span>');
        }
      });
    }

    $('#selectno_surat, select[name="id_kelurahan"]').on('change', updateSaldono_surat);
  });
</script>
