
<!-- CDN & Style sama seperti sebelumnya -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="<?= base_url('assets/img/PBM.png'); ?>" type="image/png">


<style>
  /* Overlay semi-transparent gelap untuk modal */
  .modal-backdrop.show {
    background-color: rgba(0, 0, 0, 0.7) !important;
    backdrop-filter: blur(4px);
  }

  /* Modal dialog di tengah atas */
  .modal-dialog {
    max-width: 450px;
    margin: 1rem auto 0 auto;
    top: 10%;
    position: relative;
    transform: none !important; /* override transform tengah vertikal */
  }

  /* Animasi modal fade in turun */
  .modal.fade .modal-dialog {
    opacity: 0;
    transform: translateY(-30px);
    transition: all 0.3s ease-out;
  }
  .modal.fade.show .modal-dialog {
    opacity: 1;
    transform: translateY(0);
  }

  /* Konsisten warna background modal */
  .modal-content {
    background: #ffffff; /* putih bersih untuk kedua modal */
    border-radius: 10px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }

  /* Modal header warna dan icon */
  .modal-header.bg-success,
  .modal-header.bg-warning {
    color: white;
    border-bottom: none;
    font-weight: 600;
    display: flex;
    align-items: center;
  }

  /* Header hijau */
  .modal-header.bg-success {
    background: linear-gradient(135deg, #28a745, #20c997);
  }
  /* Header oranye */
  .modal-header.bg-warning {
    background: linear-gradient(135deg, #ff8c00, #ffa500);
  }

  /* Tombol close putih */
  .modal-header .close {
    color: white;
    opacity: 1;
    font-size: 1.4rem;
    line-height: 1;
  }
  .modal-header .close:hover {
    color: #fff8f0;
  }

  /* Tombol
  .btn-success {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
    box-shadow: 0 4px 12px rgba(32, 201, 151, 0.6);
    transition: all 0.3s ease;
  }
  .btn-success:hover {
    background: linear-gradient(135deg, #20c997, #28a745);
    box-shadow: 0 6px 18px rgba(32, 201, 151, 0.8);
  }
  .btn-warning {
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    border: none;
    box-shadow: 0 4px 12px rgba(255, 165, 0, 0.6);
    transition: all 0.3s ease;
  }
  .btn-warning:hover {
    background: linear-gradient(135deg, #ffa500, #ff8c00);
    box-shadow: 0 6px 18px rgba(255, 165, 0, 0.8);
  }
  .btn-danger {
    background: linear-gradient(135deg, #dc3545, #e55353);
    border: none;
    box-shadow: 0 4px 12px rgba(229, 83, 83, 0.6);
    transition: all 0.3s ease;
  }
  .btn-danger:hover {
    background: linear-gradient(135deg, #e55353, #dc3545);
    box-shadow: 0 6px 18px rgba(229, 83, 83, 0.8);
  } */

  /* Heading utama */
  h1.h3.mb-4 {
    display: flex;
    align-items: center;
    font-weight: 700;
    color: #0d6efd;
  }
  h1.h3.mb-4 i {
    margin-right: 10px;
    font-size: 1.5rem;
    color: #0d6efd;
  }

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

  /* Tabel */
  .thead-light th {
    background-color: #0d6efd;
    color: white;
    font-weight: 700;
    font-size: 0.95rem;
  }
  .thead-light th i {
    margin-right: 6px;
    color: #ffc107;
  }

  /* Baris tabel hover */
  tbody tr:hover {
    background-color: #e7f1ff;
  }

  /* Input dengan icon */
  .input-group-text {
    background-color: #0d6efd;
    color: white;
    border: none;
    border-radius: 0.25rem 0 0 0.25rem;
    min-width: 42px;
    justify-content: center;
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.5);
    border-color: #0d6efd;
  }

  /* Form group jarak */
  .form-group {
    margin-bottom: 1.25rem;
  }

  /* Placeholder */
  input::placeholder {
    color: #a9a9a9;
  }
</style>

<div class="container-fluid">
  <!-- Heading -->
  <h1 class="h3 mb-4"><i class="fas fa-users"></i> Data User</h1>

  <!-- Card -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div><i class="fas fa-database"></i> Data User</div>
      <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalTambahUser">
        <i class="fas fa-user-plus"></i> Tambah User
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th><i class="fas fa-id-card"></i> Nama Lengkap</th>
              <th><i class="fas fa-user-circle"></i> Username</th>
              <th><i class="fas fa-key"></i> Password</th>
              <th><i class="fas fa-user-shield"></i> Level</th>
              <th class="text-center"><i class="fas fa-cogs"></i> Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($user as $dat) : ?>
              <tr>
                <td><?= htmlspecialchars($dat['nama_lengkap']); ?></td>
                <td><?= htmlspecialchars($dat['username']); ?></td>
                <td><?= htmlspecialchars($dat['password']); ?></td>
                <td><?= htmlspecialchars(ucfirst($dat['level'])); ?></td>
                <td class="text-center">
                  <button class="btn btn-sm btn-warning editUserBtn" 
                    data-id="<?= $dat['id_user']; ?>"
                    data-nama="<?= htmlspecialchars($dat['nama_lengkap']); ?>"
                    data-username="<?= htmlspecialchars($dat['username']); ?>"
                    data-password="<?= htmlspecialchars($dat['password']); ?>"
                    data-level="<?= $dat['level']; ?>"
                    title="Edit User">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <button class="btn btn-sm btn-danger deleteUserBtn" 
                    data-url="<?= base_url('User/hapususer/' . $dat['id_user']); ?>"
                    title="Hapus User">
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

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('User/tambahuser') ?>" method="POST" id="formTambahUser">
        <div class="modal-header bg-success">
          <i class="fas fa-user-plus fa-lg mr-2"></i>
          <h5 class="modal-title" id="modalTambahUserLabel">Tambah User</h5>
          <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tambah-nama">Nama Lengkap</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
              </div>
              <input type="text" id="tambah-nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tambah-username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
              </div>
              <input type="text" id="tambah-username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tambah-password">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" id="tambah-password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
          </div>
          <div class="form-group">
            <label for="tambah-level">Level</label>
            <select id="tambah-level" name="level" class="form-control" required>
              <option value="" disabled selected>-- Pilih Level --</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('User/edituser') ?>" method="POST" id="formEditUser">
        <div class="modal-header bg-warning">
          <i class="fas fa-user-edit fa-lg mr-2"></i>
          <h5 class="modal-title" id="modalEditUserLabel">Edit User</h5>
          <button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-id_user" name="id_user" required>
          <div class="form-group">
            <label for="edit-nama">Nama Lengkap</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
              </div>
              <input type="text" id="edit-nama" name="nama" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit-username">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
              </div>
              <input type="text" id="edit-username" name="username" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit-password">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" id="edit-password" name="password" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit-level">Level</label>
            <select id="edit-level" name="level" class="form-control" required>
              <option value="" disabled>-- Pilih Level --</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    // Tombol Edit User - isi modal
    $(document).on('click', '.editUserBtn', function () {
      $('#edit-id_user').val($(this).data('id'));
      $('#edit-nama').val($(this).data('nama'));
      $('#edit-username').val($(this).data('username'));
      $('#edit-password').val($(this).data('password'));
      $('#edit-level').val($(this).data('level'));
      $('#modalEditUser').modal('show');
    });

    // Hapus user dengan konfirmasi SweetAlert2
    $(document).on('click', '.deleteUserBtn', function (e) {
      e.preventDefault();
      const url = $(this).data('url');
      Swal.fire({
        title: 'Yakin ingin menghapus user ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, hapus!',
        cancelButtonText: '<i class="fas fa-times"></i> Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    });

    // Reset form modal saat ditutup
    $('#modalTambahUser, #modalEditUser').on('hidden.bs.modal', function () {
      $(this).find('form')[0].reset();
    });
  });
</script>

<?php if ($this->session->flashdata('success')) : ?>
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '<?= $this->session->flashdata('success'); ?>',
    showConfirmButton: false,
    timer: 2000
  });
</script>
<?php elseif ($this->session->flashdata('error')) : ?>
<script>
  Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?= $this->session->flashdata('error'); ?>',
    showConfirmButton: false,
    timer: 2000
  });
</script>
<?php endif; ?>
