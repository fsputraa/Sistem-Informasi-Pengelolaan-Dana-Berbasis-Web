<?php

class Home extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->load->model('Model_dana');
   }

   public function index()
   {
      if (!$this->session->userdata('username')) {
         redirect('auth/login');
      } else {
         $total_masuk  = $this->Model_dana->get_total_dana_masuk();
         $total_keluar = $this->Model_dana->get_total_dana_keluar();
         $sisa_saldo   = $total_masuk - $total_keluar;

         $data = [
            'judul'        => 'Home',
            'dana_masuk'   => $total_masuk,
            'dana_keluar'  => $total_keluar,
            'sisa_saldo'   => $sisa_saldo
         ];

         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar', $data);
         $this->load->view('Home', $data);
         $this->load->view('templates/footer');
      }
   }
}
