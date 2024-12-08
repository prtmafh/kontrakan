<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
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
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/index', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function detailkamar()
    {
        $id_kamar = $this->uri->segment(3);
        $kamar = $this->ModelKontrakan->getWhere($id_kamar)->result(); // Ganti get_where menjadi getWhere
        // if (empty($kamar)) {
        //     // Jika data kamar tidak ditemukan, mungkin kembalikan ke halaman sebelumnya atau tampilkan pesan error
        //     redirect('admin/daftarkamar');
        // }
        $data = [
            'judul' => 'Detail Kontrakan',
            'kamar' => $kamar,
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()
        ];
        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/detailkamar', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function filterlokasi($lokasi)
    {
        $data = [
            'judul' => 'Daftar Kamar',
            'kamar' => $this->ModelKontrakan->getKamarReadyLokasi($lokasi),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array(),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        // $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];

        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/index', $data);
        $this->load->view('templates/penyewa/footer');
    }
    // public function kamarsaya()
    // {

    //     $id_user = $this->session->userdata('id_user');
    //     if (!$id_user) {
    //         redirect('auth/login');
    //     }

    //     $data = [
    //         'judul' => 'Kamar Saya',
    //         'kamar_saya' => $this->ModelSewa->getKamarByUserId($id_user),
    //         'lokasi' => $this->ModelKontrakan->getLokasi()->result()

    //     ];

    //     // Load view untuk halaman "Kamar Saya"
    //     $this->load->view('templates/penyewa/header', $data);
    //     $this->load->view('templates/penyewa/navbar', $data);
    //     $this->load->view('penyewa/kamarsaya', $data); // Nama view-nya "kamarsaya.php"
    //     $this->load->view('templates/penyewa/footer');
    // }

    // public function detail_kamar_saya($id_sewa)
    // {
    //     $this->ModelSewa->updateStatusSewaOtomatis();

    //     $data['judul'] = 'Detail Sewa Kamar';
    //     $data['sewa'] = $this->ModelSewa->getSewaById($id_sewa); // Ambil data sewa berdasarkan ID

    //     // Hitung sisa hari
    //     $data['sisa_hari'] = $this->calculate_remaining_days($data['sewa']->sewa_end);
    //     $data = [
    //         'judul' => 'Detail Sewa Kamar',
    //         'sewa' => $this->ModelSewa->getSewaById($id_sewa),
    //         'sisa_hari' => $this->calculate_remaining_days($data['sewa']->sewa_end),
    //         'lokasi' => $this->ModelKontrakan->getLokasi()->result()
    //     ];

    //     // Load view detail sewa kamar
    //     $this->load->view('templates/penyewa/header', $data);
    //     $this->load->view('templates/penyewa/navbar', $data);
    //     $this->load->view('penyewa/detail_kamar_saya', $data);
    //     $this->load->view('templates/penyewa/footer');
    // }

    // Fungsi untuk menghitung sisa hari sewa
    // private function calculate_remaining_days($sewa_end)
    // {
    //     $today = new DateTime();
    //     $end_date = new DateTime($sewa_end);
    //     $diff = $today->diff($end_date);

    //     // Jika sudah melewati masa sewa
    //     if ($diff->invert == 1) {
    //         return 0;
    //     }

    //     return $diff->days; // Mengembalikan sisa hari
    // }
}
