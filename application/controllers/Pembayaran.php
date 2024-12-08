<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Model untuk proses pembayaran
    }

    // Fungsi untuk menampilkan halaman pembayaran
    public function index($id_sewa)
    {
        // Ambil data sewa berdasarkan ID
        $data = [
            'judul' => 'Pembayaran',
            'sewa' => $this->ModelSewa->getIdSewa($id_sewa),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()
        ];
        $id_kamar = $this->input->post('id_kamar');
        $harga = $this->input->post('harga');
        $durasi = $this->input->post('durasi');
        $tanggal_mulai = $this->input->post('tanggal_mulai');

        // Hitung total harga
        $total_harga = $durasi * $harga;

        // Tampilkan form pembayaran
        $data = [
            'id_kamar' => $id_kamar,
            'total_harga' => $total_harga,
            'tanggal_mulai' => $tanggal_mulai,
            'durasi' => $durasi
        ];
        // $data['sewa'] = $this->ModelSewa->getIdSewa($id_sewa);
        // $data['sewa']->total_harga = $this->calculate_total($data['sewa']); // Hitung total harga

        // Load view pembayaran
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/pembayaran', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function pembayaran_kamar($id_booking)
    {


        // $booking = $this->ModelSewa->getBooking($id_booking);

        // Ambil nama kamar berdasarkan ID kamar di booking
        $this->db->select('kamar.nama_kamar, booking.jumlah, booking.id_booking');
        $this->db->from('booking');
        $this->db->join('kamar', 'booking.id_kamar = kamar.id_kamar');
        $this->db->where('booking.id_booking', $id_booking);
        $query = $this->db->get();

        $data = [
            'booking' => $query->row(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()
        ];

        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/pembayaran', $data);
        $this->load->view('templates/penyewa/footer');
    }

    // Fungsi untuk menghitung total harga
    private function calculate_total($sewa)
    {
        $durasi = (strtotime($sewa->sewa_end) - strtotime($sewa->sewa_start)) / (30 * 24 * 60 * 60); // Hitung durasi dalam bulan
        return $sewa->harga * $durasi;
    }

    // Fungsi untuk memproses pembayaran
    public function proses_pembayaran()
    {
        $id_booking = $this->input->post('id_booking');
        $jumlah = $this->input->post('jumlah');
        $payment_method = $this->input->post('payment_method');


        // Dapatkan ID user dari session
        $id_user = $this->session->userdata('id_user');

        // Simpan data pembayaran ke tabel pembayaran
        $data_pembayaran = [
            'id_booking' => $id_booking,
            'jumlah' => $jumlah,
            'payment_status' => 'pending', // Set status pembayaran ke pending
            'payment_method' => $payment_method
        ];

        $this->ModelSewa->tambah_pembayaran($data_pembayaran);

        // Redirect ke halaman konfirmasi pembayaran
        $this->session->set_flashdata('pembayaran_berhasil', 'Pembayaran berhasil dilakukan. Tunggu konfirmasi dari admin.');
        redirect('pembayaran/sukses');
    }


    public function proses_transfer()
    {
        $id_booking = $this->input->post('id_booking');
        $jumlah = $this->input->post('jumlah');
        $account_name = $this->input->post('account_name');
        $account_number = $this->input->post('account_number');

        // Proses upload bukti transfer
        $config['upload_path'] = './assets/img/pembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['file_name'] = time() . '_' . $_FILES['payment_proof']['name'];

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('payment_proof')) {
            $bukti_transfer = $this->upload->data('file_name');

            // Simpan detail transfer dan update status pembayaran
            $data = [
                'id_booking' => $id_booking,
                'jumlah' => $jumlah,
                'nama_rekening' => $account_name,
                'no_rekening' => $account_number,
                'bukti_transfer' => $bukti_transfer,
                'payment_status' => 'pending'
            ];

            $this->ModelSewa->tambah_pembayaran($data);
            $this->session->set_flashdata('pembayaran_berhasil', 'Pembayaran berhasil dilakukan. Tunggu konfirmasi dari admin.');
            redirect('pembayaran/sukses');
        } else {
            // Jika upload bukti transfer gagal
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Gagal mengunggah bukti transfer: ' . $error);
            redirect('pembayaran/gagal');
        }
    }






    // Halaman konfirmasi pembayaran sukses
    public function sukses()
    {
        $data = [
            'judul' => 'Pembayaran',
            // Cek apakah flashdata 'pembayaran_berhasil' ada
            'pembayaran_berhasil' => $this->session->flashdata('pembayaran_berhasil'),

        ];

        // Load view pembayaran
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('templates/penyewa/pembayaran_sukses', $data);
        $this->load->view('templates/penyewa/footer');
    }
}
