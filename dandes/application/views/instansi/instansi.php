 
<style>
/* Card header */
  .card-header.py-3 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0d6efd;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
  }
  .card-header.py-3 i {
    margin-right: 8px;
  }
</style>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Instansi</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- FontAwesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
</head>
<body>

<div class="container-fluid mt-4">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-building"></i> Data Instansi</h1>

  <!-- DataTable Card -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-building mr-2"></i>Data Instansi</h6>
      <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalTambahInstansi">
        <i class="fas fa-plus-circle"></i> Tambah Instansi
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th style="width: 5%;">No.</th>
              <th><i class="fas fa-building"></i> Nama Instansi</th>
              <th style="width: 20%;"><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($instansi as $dat) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($dat['nama_instansi']); ?></td>
                <td class="text-center">
                  <button 
                    class="btn btn-warning btn-sm btn-edit" 
                    data-toggle="modal" 
                    data-target="#modalEditInstansi"
                    data-id="<?= $dat['id_instansi']; ?>"
                    data-nama="<?= htmlspecialchars($dat['nama_instansi'], ENT_QUOTES); ?>"
                    title="Edit Instansi">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <button
                    class="btn btn-danger btn-sm btn-delete"
                    data-id="<?= $dat['id_instansi']; ?>"
                    title="Hapus Instansi">
                    <i class="fas fa-trash-alt"></i> Hapus
                  </button>
                </td>
              </tr>
            <?php endforeach; ?> 
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<!-- Modal Tambah Instansi -->
<div class="modal fade" id="modalTambahInstansi" tabindex="-1" role="dialog" aria-labelledby="modalTambahInstansiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="<?= base_url('Instansi/tambahinstansi') ?>" method="POST" id="formTambahInstansi">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalTambahInstansiLabel"><i class="fas fa-plus-circle"></i> Tambah Instansi</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_instansi">Nama Instansi</label>
            <input class="form-control form-control-sm" type="text" placeholder="Masukkan nama instansi" name="nama_instansi" id="nama_instansi" required>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-check-circle"></i> Tambah
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Instansi -->
<div class="modal fade" id="modalEditInstansi" tabindex="-1" role="dialog" aria-labelledby="modalEditInstansiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Form action untuk edit -->
      <form action="<?= base_url('Instansi/editinstansi') ?>" method="POST" id="formEditInstansi">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalEditInstansiLabel"><i class="fas fa-edit"></i> Edit Instansi</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_instansi" id="edit_id_instansi" value="">
          <div class="form-group">
            <label for="edit_nama_instansi">Nama Instansi</label>
            <input type="text" class="form-control form-control-sm" name="nama_instansi" id="edit_nama_instansi" value="" required>
          </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times"></i> Batal
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function() {
    // Isi modal edit dengan data saat tombol edit diklik
    $('.btn-edit').click(function() {
      const id = $(this).data('id');
      const nama = $(this).data('nama');

      $('#edit_id_instansi').val(id);
      $('#edit_nama_instansi').val(nama);
    });

    // Konfirmasi hapus dengan SweetAlert2
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      const id = $(this).data('id');

      Swal.fire({
        title: 'Yakin ingin menghapus instansi ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Redirect ke url hapus instansi
          window.location.href = "<?= base_url('Instansi/hapusinstansi/') ?>" + id;
        }
      });
    });

    // SweetAlert2 flashdata notifikasi
    <?php if ($this->session->flashdata('success')) : ?>
      Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: "<?= $this->session->flashdata('success') ?>",
        timer: 2000,
        showConfirmButton: false
      });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')) : ?>
      Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: "<?= $this->session->flashdata('error') ?>",
        timer: 2500,
        showConfirmButton: false
      });
    <?php endif; ?>
  });
</script>

</body>
</html>
