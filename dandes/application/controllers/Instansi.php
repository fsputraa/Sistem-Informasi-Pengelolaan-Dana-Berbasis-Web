<?php

class Instansi extends CI_Controller {
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_instansi');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['judul'] = 'Data Instansi';
        $data['instansi'] = $this->Model_instansi->getAllinstansi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('instansi/instansi', $data);
        $this->load->view('templates/footer'); 
    }

    public function tambahinstansi()
    {
       $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');

       if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error', 'Nama instansi wajib diisi.');
           $this->index();
       } else {
           $nama_instansi = $this->input->post('nama_instansi');
           $data = ['nama_instansi' => $nama_instansi];
           $this->Model_instansi->insert($data, 'tb_instansi');
           $this->session->set_flashdata('success', 'Instansi berhasil ditambahkan.');
           redirect('Instansi');
       }
    }

    public function editinstansi()
    {
       $this->form_validation->set_rules('id_instansi', 'ID Instansi', 'required');
       $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');

       if ($this->form_validation->run() == false) {
           $this->session->set_flashdata('error', 'Nama instansi wajib diisi.');
           $this->index();
       } else {
          $this->Model_instansi->updateinstansi();
          $this->session->set_flashdata('success', 'Instansi berhasil diupdate.');
          redirect('Instansi');
       }
    }

    public function hapusinstansi($id)
    {
       $this->Model_instansi->delete($id);
       $this->session->set_flashdata('success', 'Instansi berhasil dihapus.');
       redirect('Instansi');
    }
}
?>
