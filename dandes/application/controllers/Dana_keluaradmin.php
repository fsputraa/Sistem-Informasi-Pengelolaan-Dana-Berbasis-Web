<?php
class Dana_keluaradmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dana');
        $this->load->model('Model_kelurahan');
    }

    public function index()
    {
        $data['judul'] = 'Dana Keluar';
        $data['danakeluar'] = $this->Model_dana->getalldanakeluar();
        $data['kelurahan'] = $this->Model_kelurahan->getallkelurahan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('danaadmin/dana_keluar', $data);
        $this->load->view('templates/footer');
    }
}
