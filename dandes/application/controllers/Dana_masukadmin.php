<?php

class Dana_masukadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dana');
        $this->load->model('Model_instansi');
        $this->load->model('Model_kelurahan');
    }

    public function index()
    {
        $data['judul'] = 'Dana Masuk';
        $data['danamasuk'] = $this->Model_dana->getalldanamasuk();
        $data['instansi'] = $this->Model_instansi->getallinstansi();
        $data['kelurahan'] = $this->Model_kelurahan->getallkelurahan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('danaadmin/dana_masuk', $data);
        $this->load->view('templates/footer');
    }
}
