<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $data['lokasi'] = $this->ModelKontrakan->getLokasi()->result();
        cek_login();
    }
    public function index()
    {
        $data = [
            'judul' => 'Home',
            'kamar' => $this->ModelKontrakan->getKamarReady(),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()

        ];
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/profile', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function edit_profile()
    {
        $data = [
            'judul' => 'Home',
            'kamar' => $this->ModelKontrakan->getKamarReady(),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()

        ];
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengedit profil. Pastikan semua data diisi.</div>');
            redirect('profile');
        } else {
            $nama = $this->input->post('nama'); // Ambil data nama dari form
            $email = $this->input->post('email'); // Email readonly

            // Handle foto profil jika ada yang diupload
            $upload_image = $_FILES['profile_picture']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $config['file_name'] = 'profile' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('profile_picture')) {
                    // Ambil nama file gambar baru
                    $image_data = $this->upload->data(); // Ambil data file
                    $image = $image_data['file_name'];
                    $this->db->set('image', $image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // Update nama di database
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user'); // Asumsi tabel user adalah 'users'

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Profil berhasil diubah!</div>');
            redirect('profile');
        }
    }
}
