<?php

class kelurahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kelurahan');
        $this->load->library('session');
    }

    public function index()
    {
        $data['judul'] = 'Data kelurahan';
        $data['kelurahan'] = $this->Model_kelurahan->getAllkelurahan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kelurahan/kelurahan', $data);
        $this->load->view('templates/footer');
    }

    public function tambahkelurahan()
    {
        $data = [
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
            'alamat' => $this->input->post('alamat'),
            'kepala_kelurahan' => $this->input->post('kepala_kelurahan')
        ];

        $this->Model_kelurahan->insert($data, 'tb_kelurahan');
        $this->session->set_flashdata('success', 'Kelurahan berhasil ditambahkan!');
        redirect('kelurahan');
    }

    public function editkelurahan()
    {
        $id = $this->input->post('id_kelurahan');
        $data = [
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
            'alamat' => $this->input->post('alamat'),
            'kepala_kelurahan' => $this->input->post('kepala_kelurahan')
        ];

        $this->Model_kelurahan->updatekelurahan($id, $data);
        $this->session->set_flashdata('success', 'Kelurahan berhasil diedit!');
        redirect('kelurahan');
    }

    public function hapuskelurahan($id)
    {
        $this->Model_kelurahan->delete($id);
        $this->session->set_flashdata('success', 'Kelurahan berhasil dihapus!');
        redirect('kelurahan');
    }
}
?>
