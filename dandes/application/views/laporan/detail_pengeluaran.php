<div class="container-fluid">
    <h4 class="mb-4">Detail Pengeluaran - No Surat: <?= $no_surat ?></h4>
    

    <div class="card shadow mb-4">
        
        <div class="card-body">
            <a href="<?= base_url('laporan/cetak_detail/' . $no_surat) ?>" target="_blank" class="btn btn-danger btn-sm">
  <i class="fa fa-file-pdf"></i> Cetak PDF
</a>
            <?php if (empty($pengeluaran)): ?>
                <div class="alert alert-warning">Tidak ada data pengeluaran untuk surat ini.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Tanggal Keluar</th>
                                <th>Kelurahan</th>
                                <th>Kebutuhan</th>
                                <th>Jumlah Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengeluaran as $d): ?>
                                <tr>
                                    <td><?= date('d-m-Y', strtotime($d['tgl_keluar'])) ?></td>
                                    <td><?= $d['nama_kelurahan'] ?></td>
                                    <td><?= $d['kebutuhan'] ?></td>
                                    <td>Rp <?= number_format($d['jml_biaya'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
            <a href="<?= base_url('Laporan') ?>" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
