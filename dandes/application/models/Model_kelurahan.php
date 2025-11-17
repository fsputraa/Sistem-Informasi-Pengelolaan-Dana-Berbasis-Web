<?php

class Model_kelurahan extends CI_Model
{
    public function getAllkelurahan()
    {
        return $this->db->get('tb_kelurahan')->result_array();
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function delete($id)
    {
        $this->db->delete('tb_kelurahan', ['id_kelurahan' => $id]);
    }

    public function updatekelurahan($id, $data)
    {
        $this->db->where('id_kelurahan', $id);
        $this->db->update('tb_kelurahan', $data);
    }
}
?>
