<?php
class Laporan_model extends CI_Model
{
    public function getLaporan()
    {
        $query = "SELECT dm.*, i.nama_instansi, d.nama_kelurahan, 
                         IFNULL((SELECT SUM(jml_biaya) 
                                 FROM tb_dana_keluar dk 
                                 WHERE dk.id_kelurahan = dm.id_kelurahan), 0) AS total_keluar
                  FROM tb_dana_masuk dm
                  JOIN tb_instansi i ON dm.id_instansi = i.id_instansi
                  JOIN tb_kelurahan d ON dm.id_kelurahan = d.id_kelurahan";
        return $this->db->query($query)->result_array();
    }
}
