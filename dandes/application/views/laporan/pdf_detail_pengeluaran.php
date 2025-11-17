<table border="1" cellspacing="0" cellpadding="8" width="100%">
  <thead>
    <tr>
      <th>No Surat</th>
      <th>Tanggal Keluar</th>
      <th>Kebutuhan</th>
      <th>Jumlah Biaya</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($laporan as $d): ?>
      <tr>
        <td><?= isset($d['no_surat']) ? $d['no_surat'] : '-' ?></td>
        <td><?= isset($d['tgl_keluar']) ? $d['tgl_keluar'] : '-' ?></td>
        <td><?= isset($d['kebutuhan']) ? $d['kebutuhan'] : '-' ?></td>
        <td>
          Rp <?= isset($d['jml_biaya']) ? number_format($d['jml_biaya'], 0, ',', '.') : '0' ?>
        </td>
      </tr>
    <?php endforeach; ?>

    <tr style="font-weight: bold; background-color: #f2f2f2;">
      <td colspan="3">Total Pengeluaran</td>
      <td>Rp <?= number_format($total_dana_keluar ?? 0, 0, ',', '.') ?></td>
    </tr>
  </tbody>
</table>
