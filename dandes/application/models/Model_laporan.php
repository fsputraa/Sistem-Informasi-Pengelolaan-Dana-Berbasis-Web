<?php
class Model_laporan extends CI_Model
{
   public function getalllaporan()
{
  $query = "SELECT 
              dm.*, 
              i.nama_instansi, 
              d.nama_kelurahan,
              IFNULL(SUM(dk.jml_biaya), 0) AS total_keluar
            FROM tb_dana_masuk dm
            JOIN tb_instansi i ON dm.id_instansi = i.id_instansi
            JOIN tb_kelurahan d ON dm.id_kelurahan = d.id_kelurahan
            LEFT JOIN tb_dana_keluar dk ON dm.id_kelurahan = dk.id_kelurahan
            GROUP BY dm.id_dana_masuk";
            
  return $this->db->query($query)->result_array();
}


   public function getlaporanbyid($id)
   {
      $query = "SELECT tb_dana_keluar.*, tb_kelurahan.nama_kelurahan 
                FROM tb_dana_keluar 
                JOIN tb_kelurahan ON tb_dana_keluar.id_kelurahan = tb_kelurahan.id_kelurahan
                WHERE tb_dana_keluar.id_kelurahan = '$id'";
      return $this->db->query($query)->result_array();
   }

   public function lpj()
{
    $query = "SELECT tb_lpj.*, tb_dana_keluar.no_surat, tb_dana_keluar.kebutuhan, tb_dana_keluar.jml_biaya
              FROM tb_lpj 
              JOIN tb_dana_keluar ON tb_lpj.id_dana_keluar = tb_dana_keluar.id_dana_keluar";
    return $this->db->query($query)->result_array();
}

public function getAllDanaKeluar()
{
    return $this->db->get('tb_dana_keluar')->result_array();
}

public function getLpjById($id)
{
    return $this->db->get_where('tb_lpj', ['id_lpj' => $id])->row_array();
}

public function updateLpj($id, $data)
{
    $this->db->where('id_lpj', $id);
    $this->db->update('tb_lpj', $data);
}



   // Total seluruh dana masuk
public function getTotalDanaMasuk()
{
    $this->db->select_sum('saldo_awal');
    $query = $this->db->get('tb_dana_masuk');
    return $query->row()->saldo_awal ?? 0;
}

// Total seluruh dana keluar
public function getTotalDanaKeluar()
{
    $this->db->select_sum('jml_biaya');
    $query = $this->db->get('tb_dana_keluar');
    return $query->row()->jml_biaya ?? 0;
}

public function getAllDanaMasuk()
{
    return $this->db->get('tb_dana_masuk')->result_array();
}


public function getPengeluaranByNoSurat($no_surat)
{
    $this->db->select('dk.*, k.nama_kelurahan');
    $this->db->from('tb_dana_keluar dk');
    $this->db->join('tb_kelurahan k', 'dk.id_kelurahan = k.id_kelurahan');
    $this->db->where('dk.no_surat', $no_surat);
    return $this->db->get()->result_array();
}

public function get_detail_pengeluaran($no_surat)
{
    return $this->db->get_where('tb_dana_keluar', ['no_surat' => $no_surat])->result_array();
}

public function total_keluar_by_surat($no_surat)
{
    $this->db->select_sum('jml_biaya');
    $this->db->where('no_surat', $no_surat);
    $query = $this->db->get('tb_dana_keluar')->row();
    return $query->jml_biaya ?? 0;
}


}



?>
