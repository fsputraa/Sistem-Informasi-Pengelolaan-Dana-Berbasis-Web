<?php
class Model_dana extends CI_Model
{
   public function getalldanamasuk()
   {
      $query = "SELECT tb_dana_masuk.*, tb_instansi.nama_instansi, tb_kelurahan.nama_kelurahan 
                FROM tb_dana_masuk 
                JOIN tb_instansi ON tb_dana_masuk.id_instansi = tb_instansi.id_instansi 
                JOIN tb_kelurahan ON tb_dana_masuk.id_kelurahan = tb_kelurahan.id_kelurahan";
      return $this->db->query($query)->result_array();
   }

   public function getalldanakeluar()
   {
      $query = "SELECT tb_dana_keluar.*, tb_kelurahan.nama_kelurahan 
                FROM tb_dana_keluar 
                JOIN tb_kelurahan ON tb_dana_keluar.id_kelurahan = tb_kelurahan.id_kelurahan";
      return $this->db->query($query)->result_array();
   }

   public function insertdanamasuk($data)
{
    return $this->db->insert('tb_dana_masuk', $data);
}

   public function insertdanakeluar($data)
{
    $this->db->insert('tb_dana_keluar', $data);
}


   public function deletedanamasuk($id)
{
    return $this->db->delete('tb_dana_masuk', ['id_dana_masuk' => $id]);
}
   public function getkelurahanById($id_kelurahan)
   {
      return $this->db->get_where('tb_kelurahan', ['id_kelurahan' => $id_kelurahan])->row_array();
   }

   public function updatekelurahan()
   {
      $data = [
         'nama_kelurahan' => $this->input->post('nama_kelurahan'),
         'alamat' => $this->input->post('alamat'),
         'kepala_kelurahan' => $this->input->post('kepala_kelurahan')
      ];
      $this->db->update('tb_kelurahan', $data, ['id_kelurahan' => $this->input->post('id_kelurahan')]);
   }

   public function updatedanamasuk($id, $data)
{
    $this->db->where('id_dana_masuk', $id);
    return $this->db->update('tb_dana_masuk', $data);
}

   public function get_total_dana_masuk()
   {
      $this->db->select_sum('saldo_awal');
      return $this->db->get('tb_dana_masuk')->row()->saldo_awal ?? 0;
   }

   public function get_total_dana_keluar()
   {
      $this->db->select_sum('jml_biaya');
      return $this->db->get('tb_dana_keluar')->row()->jml_biaya ?? 0;
   }

   public function get_total_dana_masuk_kelurahan($id_kelurahan)
{
    $this->db->select_sum('saldo_awal');
    $this->db->where('id_kelurahan', $id_kelurahan);
    return $this->db->get('tb_dana_masuk')->row()->saldo_awal ?? 0;
}

public function get_total_dana_keluar_kelurahan($id_kelurahan)
{
    $this->db->select_sum('jml_biaya');
    $this->db->where('id_kelurahan', $id_kelurahan);
    return $this->db->get('tb_dana_keluar')->row()->jml_biaya ?? 0;
}

public function getno_suratDanaMasuk()
{
    $this->db->distinct();
    $this->db->select('no_surat');
    return $this->db->get('tb_dana_masuk')->result_array();
}

public function get_total_dana_masuk_per_no_surat($id_kelurahan, $no_surat)
{
    $this->db->select_sum('saldo_awal');
    $this->db->where('id_kelurahan', $id_kelurahan);
    $this->db->where('no_surat', $no_surat);
    return $this->db->get('tb_dana_masuk')->row()->saldo_awal ?? 0;
}

public function get_total_dana_keluar_per_no_surat($id_kelurahan, $no_surat)
{
    $this->db->select_sum('jml_biaya');
    $this->db->where('id_kelurahan', $id_kelurahan);
    $this->db->where('no_surat', $no_surat);
    return $this->db->get('tb_dana_keluar')->row()->jml_biaya ?? 0;
}

public function get_sisa_saldo_no_surat($id_kelurahan, $no_surat)
{
    $masuk = $this->get_total_dana_masuk_per_no_surat($id_kelurahan, $no_surat);
    $keluar = $this->get_total_dana_keluar_per_no_surat($id_kelurahan, $no_surat);
    return $masuk - $keluar;
}

public function get_saldo_no_surat($id_kelurahan, $no_surat)
{
    $masuk = $this->db->select_sum('jml_dana')
                      ->where('id_kelurahan', $id_kelurahan)
                      ->where('no_surat', $no_surat)
                      ->get('tb_dana_masuk')
                      ->row()->jml_dana ?? 0;

    $keluar = $this->db->select_sum('jml_biaya')
                       ->where('id_kelurahan', $id_kelurahan)
                       ->where('no_surat', $keperluan)
                       ->get('tb_dana_keluar')
                       ->row()->jml_biaya ?? 0;

    return $masuk - $keluar;
}



}
