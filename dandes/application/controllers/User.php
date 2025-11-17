<?php

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Data User';
        $data['user'] = $this->Model_user->getalluser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/user', $data);
        $this->load->view('templates/footer');
    }

    public function tambahuser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Data tidak lengkap saat menambah user!');
            redirect('User');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama_lengkap' => $this->input->post('nama'),
                'level' => $this->input->post('level')
            ];

            $this->Model_user->insert($data, 'tb_user');
            $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
            redirect('User');
        }
    }

    public function edituser()
    {
        $this->form_validation->set_rules('id_user', 'ID User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Data tidak lengkap saat mengedit user!');
            redirect('User');
        } else {
            $data = [
                'id_user' => $this->input->post('id_user'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nama_lengkap' => $this->input->post('nama'),
                'level' => $this->input->post('level')
            ];

            $this->Model_user->updateuser($data);
            $this->session->set_flashdata('success', 'User berhasil diperbarui!');
            redirect('User');
        }
    }

    public function hapususer($id)
    {
        $this->Model_user->delete($id);
        $this->session->set_flashdata('success', 'User berhasil dihapus!');
        redirect('User');
    }
}
?>
