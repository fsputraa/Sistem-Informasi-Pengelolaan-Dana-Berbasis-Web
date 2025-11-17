<?php

class Model_user extends CI_Model
{
   public function getAlluser()
   {
      $query = "SELECT * from tb_user";
      return $this->db->query($query)->result_array();
   }

    public function insert($data, $table)
   {
      $this->db->insert($table, $data);
   }

    public function delete($id)
   {
      $this->db->delete('tb_user', ['id_user' => $id]);
   }

  public function getuserById($id_user)
   {
      return $this->db->get_where('tb_user', ['id_user' => $id_user])->row_array();
   }

	public function updateuser()
{
    $data = [
        'username' => $this->input->post('username', TRUE),
        'password' => $this->input->post('password', TRUE),
        'nama_lengkap' => $this->input->post('nama', TRUE),
        'level' => $this->input->post('level', TRUE)
    ];

    $this->db->where('id_user', $this->input->post('id_user'));
    $this->db->update('tb_user', $data);
}



}

?>