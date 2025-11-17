<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?= $judul ?></title>
  <style>
    body {
      font-family: "Times New Roman", serif;
      font-size: 12pt;
      color: #000;
      padding: 30px;
    }

    .kop {
      width: 100%;
      display: table;
      border-bottom: 3px double #000;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }

    .kop-logo {
      display: table-cell;
      width: 80px;
      vertical-align: top;
    }

    .kop-logo img {
      width: 70px;
      height: auto;
    }

    .kop-text {
      display: table-cell;
      text-align: center;
      vertical-align: middle;
    }

    .kop-text h1 {
      margin: 0;
      font-size: 16pt;
      font-weight: bold;
      text-transform: uppercase;
    }

    .kop-text h2 {
      margin: 0;
      font-size: 13pt;
      text-transform: uppercase;
    }

    .kop-text p {
      margin: 5px 0 0 0;
      font-size: 10pt;
      font-style: italic;
    }

    .summary {
      border: 1px solid #000;
      width: fit-content;
      padding: 10px;
      margin-bottom: 15px;
    }

    .summary p {
      margin: 3px 0;
      font-size: 11pt;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px;
      text-align: center;
    }

    th {
      background-color: #f0f0f0;
    }

    .ttd {
      width: 100%;
      margin-top: 100px;
    }

    .ttd-right {
      float: right;
      text-align: center;
      margin-right: 30px;
    }

    .ttd-right p {
      margin: 4px 0;
    }

    .ttd-right .nama {
      margin-top: 100px;
      font-weight: bold;
      text-decoration: underline;
    }
  </style>
</head>
<body>

<?php
  $logo_path = FCPATH . 'assets/img/PBM.png'; // Gambar yang tajam dan sudah bener
  $type = pathinfo($logo_path, PATHINFO_EXTENSION);
  $data = file_get_contents($logo_path);
  $base64_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<div class="kop">
  <div class="kop-logo">
    <img src="<?= $base64_logo ?>">
  </div>
  <div class="kop-text">
    <h1>PEMERINTAH KOTA PRABUMULIH</h1>
    <h2>KELURAHAN GUNUNG KEMALA</h2>
    <p>Jalan Gunung Kemala, Kelurahan Gunung Kemala, Kecamatan Prabumulih Barat, Kota Prabumulih, Sumatera Selatan, 31121</p>
  </div>
</div>

<table border="1" cellspacing="0" cellpadding="8" width="100%">
  <thead>
    <tr>
      <th>Tanggal Masuk</th>
      <th>Sumber Dana</th>
      <th>Kelurahan</th>
      <th>Saldo Awal</th>
      <th>Keperluan</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($laporan as $d): ?>
      <tr>
        <td><?= $d['tgl_masuk'] ?></td>
        <td><?= $d['nama_instansi'] ?></td>
        <td><?= $d['nama_kelurahan'] ?></td>
        <td>Rp <?= number_format($d['saldo_awal'], 0, ',', '.') ?></td>
        <td><?= $d['keperluan'] ?></td>
      </tr>
    <?php endforeach ?>
    
    <!-- Baris ringkasan dengan pembatas -->
    <tr style="font-weight: bold; background-color: #f2f2f2;">
      <td colspan="2">Total Dana Masuk: Rp <?= number_format($total_dana_masuk, 0, ',', '.') ?></td>
      <td colspan="2">Total Dana Keluar: Rp <?= number_format($total_dana_keluar, 0, ',', '.') ?></td>
      <td>Sisa Saldo: Rp <?= number_format($sisa_saldo, 0, ',', '.') ?></td>
    </tr>
  </tbody>
</table>


<div class="ttd">
  <div class="ttd-right">
    <p>Prabumulih, <?= date('d-m-Y') ?></p>
    <p>Kepala Kelurahan Gunung Kemala</p>
    <p class="nama">Kelpin Padilah</p>
  </div>
</div>

</body>
</html>
