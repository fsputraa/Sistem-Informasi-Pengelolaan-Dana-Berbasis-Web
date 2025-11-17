<?php
class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
        $this->load->model('Model_kelurahan');
        $this->load->model('Laporan_model'); // FIX: load model yang dipakai di cetakPDF()
    }

    public function index()
{
    $data['judul'] = 'Laporan Dana Kelurahan';
    $data['laporan'] = $this->Model_laporan->getalllaporan();

    // Tambahan perhitungan akurat total dana masuk & keluar
    $data['dana_masuk'] = $this->Model_laporan->getTotalDanaMasuk();
    $data['dana_keluar'] = $this->Model_laporan->getTotalDanaKeluar();
    $data['sisa_saldo'] = $data['dana_masuk'] - $data['dana_keluar'];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('laporan/lap_danakelurahan', $data);
    $this->load->view('templates/footer');
}


    public function detaildana($id)
    {
        $data['judul'] = 'Detail Dana Keluar';
        $data['laporan'] = $this->Model_laporan->getlaporanbyid($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('laporan/detaillap', $data);
        $this->load->view('templates/footer');
    }



public function pekerjaan()
{
    $data['judul'] = 'LPJ';
    $data['lpj'] = $this->Model_laporan->lpj();
    $data['dana'] = $this->Model_laporan->getAllDanaKeluar();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('laporan/lpj', $data);
    $this->load->view('templates/footer');
}

public function tambahlpj()
{
    $id_dana_keluar = $this->input->post('id_dana_keluar');
    $file_name = $_FILES['file']['name'];
    $upload_path = './uploads/';
    $allowed_types = 'pdf';

    // ✅ Cek apakah LPJ untuk id_dana_keluar sudah ada
    $cek = $this->db->get_where('tb_lpj', ['id_dana_keluar' => $id_dana_keluar])->row();
    if ($cek) {
        $this->session->set_flashdata('error', 'LPJ untuk surat ini sudah ada!');
        redirect('Laporan/pekerjaan');
        return;
    }

    if (!empty($file_name)) {
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (strtolower($ext) !== 'pdf') {
            $this->session->set_flashdata('error', 'File LPJ harus berupa PDF.');
            redirect('Laporan/pekerjaan');
            return;
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = 2048; // Max 2MB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $uploaded = $this->upload->data();
            $file_lpj = $uploaded['file_name'];

            $data = [
                'id_dana_keluar' => $id_dana_keluar,
                'file_lpj'       => $file_lpj
            ];

            $this->db->insert('tb_lpj', $data);
            $this->session->set_flashdata('success', 'LPJ berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal upload file. Pastikan format PDF & maksimal 2MB.');
        }
    } else {
        $this->session->set_flashdata('error', 'File LPJ wajib diupload.');
    }

    redirect('Laporan/pekerjaan');
}


public function editlpj($id)
{
    $lpj = $this->Model_laporan->getLpjById($id);
    $id_dana_keluar = $this->input->post('id_dana_keluar');
    $file_lama = $lpj['file_lpj'];
    $file = $_FILES['file']['name'];

    if ($file) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (strtolower($ext) !== 'pdf') {
            $this->session->set_flashdata('error', 'File LPJ harus berupa PDF.');
            redirect('Laporan/pekerjaan');
        }

        $config['allowed_types'] = 'pdf';
        $config['upload_path'] = './uploads/';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('Laporan/pekerjaan');
        }

        $file_baru = $this->upload->data('file_name');
    } else {
        $file_baru = $file_lama;
    }

    $data = [
        'id_dana_keluar' => $id_dana_keluar,
        'file_lpj' => $file_baru
    ];

    $this->Model_laporan->updateLpj($id, $data);
    $this->session->set_flashdata('success', 'LPJ berhasil diupdate.');
    redirect('Laporan/pekerjaan');
}






    public function cetakPDF()
    {
        $this->load->library('pdf');

        $data['judul'] = 'Laporan Dana Kelurahan';
        $data['laporan'] = $this->Laporan_model->getLaporan(); // FIX: panggil dari model yang benar

        $data['total_dana_masuk'] = array_sum(array_column($data['laporan'], 'saldo_awal'));
        $data['total_dana_keluar'] = array_sum(array_column($data['laporan'], 'total_keluar'));
        $data['sisa_saldo'] = $data['total_dana_masuk'] - $data['total_dana_keluar'];

        $html = $this->load->view('laporan/laporan_pdf', $data, true);

        $this->pdf->generate($html, 'Laporan-Dana-Kelurahan', true, 'A4', 'landscape');
    }

    public function detail_pengeluaran($no_surat)
{
    $data['judul'] = 'Detail Pengeluaran';
    $data['no_surat'] = $no_surat;
    $data['pengeluaran'] = $this->Model_laporan->getPengeluaranByNoSurat($no_surat);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('laporan/detail_pengeluaran', $data);
    $this->load->view('templates/footer');
}

public function cetak_detail($no_surat)
{
    $this->load->library('pdf');

    $data['judul'] = "Detail Pengeluaran Dana";
    $data['laporan'] = $this->Model_laporan->get_detail_pengeluaran($no_surat);
    $data['no_surat'] = $no_surat;
    $data['total_dana_keluar'] = $this->Model_laporan->total_keluar_by_surat($no_surat);

    $html = $this->load->view('laporan/pdf_detail_pengeluaran', $data, true);
    $this->pdf->generate($html, 'Detail_Pengeluaran_' . $no_surat, true, 'A4', 'portrait');
}

public function hapuslpj($id)
{
    $cek = $this->db->get_where('tb_lpj', ['id_lpj' => $id])->row();
    if (!$cek) {
        show_404(); // biar gak langsung error
    }

    // Hapus file juga kalau perlu:
    if (file_exists('./uploads/' . $cek->file_lpj)) {
        unlink('./uploads/' . $cek->file_lpj);
    }

    $this->db->where('id_lpj', $id);
    $this->db->delete('tb_lpj');

    $this->session->set_flashdata('success', 'LPJ berhasil dihapus');
    redirect('Laporan/pekerjaan');
}





}
