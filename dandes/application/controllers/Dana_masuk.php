<?php

class Dana_masuk extends CI_Controller
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
        $this->load->view('dana/dana_masuk', $data);
        $this->load->view('templates/footer');
    }

    public function tambahdanamasuk()
{
    $data = [
        'id_instansi' => $this->input->post('id_instansi'),
        'id_kelurahan' => $this->input->post('id_kelurahan'),
        'tgl_masuk' => $this->input->post('tgl_masuk'),
        'saldo_awal' => $this->input->post('saldo_awal'),
        'keperluan' => $this->input->post('keperluan'),
        'no_surat' => $this->input->post('no_surat')
    ];

    if ($this->Model_dana->insertdanamasuk($data)) {
        $this->session->set_flashdata('success', 'Data dana masuk berhasil ditambahkan.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menambahkan data.');
    }

    redirect('Dana_masuk');
}

public function editdanamasuk($id)
{
    $data = [
        'id_instansi' => $this->input->post('id_instansi'),
        'id_kelurahan' => $this->input->post('id_kelurahan'),
        'tgl_masuk' => $this->input->post('tgl_masuk'),
        'saldo_awal' => $this->input->post('saldo_awal'),
        'keperluan' => $this->input->post('keperluan'),
        'no_surat' => $this->input->post('no_surat')
    ];

    if ($this->Model_dana->updatedanamasuk($id, $data)) {
        $this->session->set_flashdata('success', 'Data dana masuk berhasil diperbarui.');
    } else {
        $this->session->set_flashdata('error', 'Gagal memperbarui data.');
    }

    redirect('Dana_masuk');
}

public function hapusdanamasuk($id)
{
    if ($this->Model_dana->deletedanamasuk($id)) {
        $this->session->set_flashdata('success', 'Data dana masuk berhasil dihapus.');
    } else {
        $this->session->set_flashdata('error', 'Gagal menghapus data.');
    }

    redirect('Dana_masuk');
}

}
