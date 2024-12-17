<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sewa extends CI_Controller
{

    public function index($id_kamar)
    {
        // $id_kamar = $this->uri->segment(3);
        // $kamar = $this->ModelKontrakan->getWhere(['id_kamar' => $id_kamar])->result(); // Ganti get_where menjadi getWhere
        // if (empty($kamar)) {
        //     // Jika data kamar tidak ditemukan, mungkin kembalikan ke halaman sebelumnya atau tampilkan pesan error
        //     redirect('admin/daftarkamar');
        // }
        $data = [
            'judul' => 'Sewa',
            'kamar' => $this->ModelKontrakan->getIdKamar($id_kamar)
            // 'kamar' => $kamar,
            // 'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/sewa', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function proses_sewa()
    {
        // Ambil data dari form
        $id_kamar = $this->input->post('id_kamar');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $durasi = $this->input->post('durasi');
        // $total_harga = $this->input->post('total_harga');
        $id_user = $this->session->userdata('id_user'); // Dapatkan ID user dari session

        // Hitung tanggal akhir sewa berdasarkan durasi
        $tanggal_akhir = date('Y-m-d', strtotime("+$durasi months", strtotime($tanggal_mulai)));

        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row();
        $harga_per_bulan = $kamar->harga;

        // Hitung total jumlah berdasarkan durasi dan harga
        $jumlah = $harga_per_bulan * $durasi;

        // Data untuk dimasukkan ke tabel booking
        $data_booking = array(
            'id_kamar' => $id_kamar,
            'id_user' => $id_user, // User yang sedang login
            // 'booking_date' => date('Y-m-d'), // Tanggal booking saat ini
            'sewa_start' => $tanggal_mulai,
            'sewa_end' => $tanggal_akhir,
            // 'booking_status' => 'pending', // Status awal pemesanan adalah pending
            'jumlah' => $jumlah, // Menambahkan jumlah ke data booking
            // 'perpanjangan' => 1
        );

        // Insert data ke dalam tabel booking
        $this->db->insert('booking', $data_booking);
        // Cek apakah insert berhasil
        $id_booking = $this->db->insert_id();

        // Redirect ke halaman pembayaran
        redirect('pembayaran/pembayaran_kamar/' . $id_booking); // Redirect ke halaman konfirmasi atau sukses
    }

    public function updateStatusSewaOtomatis()
    {
        // Panggil model untuk memperbarui status penyewaan
        // $this->load->model('ModelSewa');
        $this->ModelSewa->updateSewaStatuses();
    }
    public function updateStatus()
    {
        // Memanggil fungsi untuk memperbarui status sewa
        $this->ModelSewa->updateSewaStatuses(); // Pastikan metode ini ada di model Anda

        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('pesan', 'Status sewa berhasil diperbarui.');

        // Redirect ke halaman yang sama setelah pembaruan
        redirect('sewa/sewakamar'); // Ganti dengan nama metode yang sesuai jika berbeda
    }

    public function kamarsaya()
    {
        $this->updateStatusSewaOtomatis();

        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            redirect('auth/login');
        }

        $data = [
            'judul' => 'Kamar Saya',
            'kamar_saya' => $this->ModelSewa->getKamarByUserId($id_user),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()

        ];

        // Load view untuk halaman "Kamar Saya"
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/kamarsaya', $data); // Nama view-nya "kamarsaya.php"
        $this->load->view('templates/penyewa/footer');
    }
    public function historykamarsaya()
    {
        $this->updateStatusSewaOtomatis();

        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            redirect('auth/login');
        }

        $data = [
            'judul' => 'Kamar Saya',
            'kamar_saya' => $this->ModelSewa->getKamarByUserIdHistory($id_user),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()

        ];

        // Load view untuk halaman "Kamar Saya"
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/historykamarsaya', $data); // Nama view-nya "kamarsaya.php"
        $this->load->view('templates/penyewa/footer');
    }

    public function detail_kamar_saya($id_sewa)
    {
        $this->updateStatusSewaOtomatis();

        $data['judul'] = 'Detail Sewa Kamar';
        $data['sewa'] = $this->ModelSewa->getSewaById($id_sewa); // Ambil data sewa berdasarkan ID

        // Hitung sisa hari
        $data['sisa_hari'] = $this->calculate_remaining_days($data['sewa']->sewa_end);
        $data = [
            'judul' => 'Detail Sewa Kamar',
            'sewa' => $this->ModelSewa->getSewaById($id_sewa),
            'sisa_hari' => $this->calculate_remaining_days($data['sewa']->sewa_end),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
            'user' => $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array()
        ];

        // Load view detail sewa kamar
        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/detail_kamar_saya', $data);
        $this->load->view('templates/penyewa/footer');
    }
    private function calculate_remaining_days($sewa_end)
    {
        $today = new DateTime();
        $end_date = new DateTime($sewa_end);
        $diff = $today->diff($end_date);

        // Jika sudah melewati masa sewa
        if ($diff->invert == 1) {
            return 0;
        }

        return $diff->days; // Mengembalikan sisa hari
    }

    public function sewakamar()
    {
        $this->updateStatusSewaOtomatis();
        $data['judul'] = 'Sewa Kamar';

        // Mengambil data booking dengan detail pembayaran dari model
        $data['sewa'] = $this->ModelSewa->get_ongoing_rentals();

        $data['user'] = $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array();
        // $data['user'] = $user['nama'];

        // Menampilkan view
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/sewakamar', $data);
        $this->load->view('templates/admin/footer');
    }
    public function laporan_penyewaan()
    {
        $this->updateStatusSewaOtomatis();
        $data['judul'] = 'Laporan Penyewaan';
        $keyword = $this->input->get('keyword');
        // Mengambil data booking dengan detail pembayaran dari model
        $data['laporan'] = $this->ModelSewa->getSewaReports($keyword);

        $data['user'] = $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array();



        // $data['user'] = $user['nama'];

        // Menampilkan view
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/laporan/penyewaan', $data);
        $this->load->view('templates/admin/footer');
    }
    public function laporan_pembayaran()
    {
        // $this->updateStatusSewaOtomatis();
        $data['judul'] = 'Laporan Pembayaran';

        $keyword = $this->input->get('keyword');
        // Mengambil data booking dengan detail pembayaran dari model
        $data['laporan'] = $this->ModelSewa->getPaymentReport($keyword);

        $data['user'] = $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array();

        // Ambil pendapatan bulan ini
        $current_month = date('m');
        $current_year = date('Y');
        $data['pendapatan_bulan_ini'] = $this->ModelSewa->get_pendapatan_by_month($current_month, $current_year);

        // Ambil histori pendapatan bulan-bulan sebelumnya
        $data['pendapatan_histori'] = $this->ModelSewa->get_pendapatan_histori();

        // Menampilkan view
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/laporan/pembayaran', $data);
        $this->load->view('templates/admin/footer');
    }

    public function perpanjang($id_kamar)
    {
        $data = [
            'judul' => 'Sewa',
            'kamar' => $this->ModelSewa->GetPerpanjang($id_kamar)
            // 'kamar' => $kamar,
            // 'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->load->view('templates/penyewa/header', $data);
        $this->load->view('templates/penyewa/navbar', $data);
        $this->load->view('penyewa/perpanjang', $data);
        $this->load->view('templates/penyewa/footer');
    }
    public function perpanjang_sewa()
    {
        // Ambil data dari input form
        $id_kamar = $this->input->post('id_kamar');
        $durasi = $this->input->post('durasi');
        $id_booking = $this->input->post('id_booking');
        $id_sewa = $this->input->post('id_sewa');
        $id_user = $this->session->userdata('id_user');

        // Ambil data kamar berdasarkan id_kamar
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row();

        // Hitung tanggal akhir sewa berdasarkan durasi
        $tanggal_mulai = $this->input->post('tanggal_mulai'); // Sewa baru mulai setelah sewa lama berakhir
        $tanggal_akhir = date('Y-m-d', strtotime("+$durasi months", strtotime($tanggal_mulai)));

        // Hitung total harga berdasarkan harga kamar dan durasi
        $harga_per_bulan = $kamar->harga;
        $jumlah = $harga_per_bulan * $durasi;

        // Cek booking lama
        $old_booking = $this->db->get_where('booking', ['id_booking' => $id_booking])->row();
        if ($old_booking && $old_booking->perpanjangan != 0) {
            $this->db->where('id_booking', $id_booking);
            $this->db->set('perpanjangan', 0);
            $update_result = $this->db->update('booking');

            if (!$update_result) {
                show_error('Gagal memperbarui status perpanjangan booking lama: ' . $this->db->last_query(), 500);
            }
        }
        $old_sewa = $this->db->get_where('sewa_kamar', ['id_sewa' => $id_sewa])->row();
        if ($old_sewa && $old_sewa->perpanjangan != 0) {
            $this->db->where('id_sewa', $id_sewa);
            $this->db->set('perpanjangan', 0);
            $update_result = $this->db->update('sewa_kamar');

            if (!$update_result) {
                show_error('Gagal memperbarui status perpanjangan booking lama: ' . $this->db->last_query(), 500);
            }
        }

        // Siapkan data untuk booking baru
        $data_booking = array(
            'id_kamar' => $id_kamar,
            'id_user' => $id_user, // User yang sedang login
            'sewa_start' => $tanggal_mulai,
            'sewa_end' => $tanggal_akhir,
            'booking_status' => 'pending', // Status awal pemesanan adalah pending
            'jumlah' => $jumlah,
            'perpanjangan' => 1 // Ini adalah perpanjangan aktif
        );

        // Insert data booking baru
        $this->db->insert('booking', $data_booking);

        // Dapatkan id_booking yang baru dari data yang diinsert
        $id_booking_baru = $this->db->insert_id();

        // Redirect ke halaman pembayaran
        redirect('pembayaran/pembayaran_kamar/' . $id_booking_baru); // Redirect ke halaman pembayaran
    }
}
