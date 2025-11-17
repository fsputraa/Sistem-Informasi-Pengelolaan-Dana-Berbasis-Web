<?php
class Dana_keluar extends CI_Controller
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
        $data['no_surat_masuk'] = $this->Model_dana->getno_suratDanaMasuk();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dana/dana_keluar', $data);
        $this->load->view('templates/footer');
    }

   public function tambahdanakeluar()
{
    $id_kelurahan = $this->input->post('id_kelurahan');
    $tgl_keluar = $this->input->post('tgl_keluar');
    $no_surat = $this->input->post('no_surat');
    $kebutuhan = $this->input->post('kebutuhan');
    $jml_biaya = (int)$this->input->post('jml_biaya');

    if ($jml_biaya <= 0) {
        $this->session->set_flashdata('error', 'Jumlah biaya harus lebih dari 0.');
        redirect('Dana_keluar');
    }

    // Ambil total dana masuk dan keluar berdasarkan no_surat dan kelurahan
    $total_masuk = $this->Model_dana->get_total_dana_masuk_per_no_surat($id_kelurahan, $no_surat);
    $total_keluar = $this->Model_dana->get_total_dana_keluar_per_no_surat($id_kelurahan, $no_surat);
    $saldo_no_surat = $total_masuk - $total_keluar;

    if ($jml_biaya > $saldo_no_surat) {
        $this->session->set_flashdata('error', 'Dana tidak cukup untuk no_surat "' . $no_surat . '". Sisa saldo: Rp ' . number_format($saldo_no_surat));
        redirect('Dana_keluar');
    }

    $data = [
        'id_kelurahan' => $id_kelurahan,
        'tgl_keluar' => $tgl_keluar,
        'no_surat' => $no_surat,
        'kebutuhan' => $kebutuhan,
        'jml_biaya' => $jml_biaya
    ];

    $this->Model_dana->insertdanakeluar($data);
    $this->session->set_flashdata('success', 'Data dana keluar berhasil ditambahkan.');
    redirect('Dana_keluar');
}


    public function edit($id)
    {
        $data = [
            'tgl_keluar' => $this->input->post('tgl_keluar'),
            'id_kelurahan' => $this->input->post('id_kelurahan'),
            'no_surat' => $this->input->post('no_surat'),
            'kebutuhan' => $this->input->post('kebutuhan'),
            'jml_biaya' => (int)$this->input->post('jml_biaya'),
        ];
        $this->db->where('id_dana_keluar', $id);
        $this->db->update('tb_dana_keluar', $data);
        $this->session->set_flashdata('success', 'Data dana keluar berhasil diupdate.');
        redirect('Dana_keluar');
    }

    public function hapus($id)
    {
        $this->db->where('id_dana_keluar', $id);
        $this->db->delete('tb_dana_keluar');
        $this->session->set_flashdata('success', 'Data dana keluar berhasil dihapus.');
        redirect('Dana_keluar');
    }

    public function getSaldono_surat()
{
    $no_surat = $this->input->get('no_surat');
    $id_kelurahan = $this->input->get('id_kelurahan');
    $sisa = $this->Model_dana->get_saldo_no_surat($id_kelurahan, $no_surat);
    echo $sisa;
}

}
