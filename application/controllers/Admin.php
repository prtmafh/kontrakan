<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        cek_role('admin'); // Pastikan helper ini aktif
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'booking' => $this->ModelBooking->get_pending_count(),
            'sewa' => $this->ModelSewa->get_ongoing_count(),
            'tersedia' => $this->ModelKontrakan->getTotalKamarReady(),
            'penyewa' => $this->ModelUser->get_total_penyewa()
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin/footer');
    }

    public function daftarKamar()
    {
        $data = [
            'judul' => 'Daftar Kamar',
            'kontrakan' => $this->ModelKontrakan->getAllKamarWithStatus(), // Memanggil fungsi baru
            'lokasi' => $this->ModelKontrakan->getLokasi()->result(),
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/daftarkamar', $data);
        $this->load->view('templates/admin/footer');
    }


    public function daftarkamar_ready()
    {
        $data = [
            'judul' => 'Daftar Kamar',
            'kontrakan' => $this->ModelKontrakan->getKamarReady(),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/daftarkamar', $data);
        $this->load->view('templates/admin/footer');
    }

    public function lokasicibitung()
    {
        $data = [
            'judul' => 'Daftar Kamar - Cibitung',
            'kontrakan' => $this->ModelKontrakan->getWhereLokasiAdmin(2), // Mengambil data lokasi Cibitung
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/daftarkamar', $data);
        $this->load->view('templates/admin/footer');
    }

    public function lokasicikarang()
    {
        $data = [
            'judul' => 'Daftar Kamar - Cikarang',
            'kontrakan' => $this->ModelKontrakan->getWhereLokasiAdmin(1), // Mengambil data lokasi Cikarang
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/daftarkamar', $data);
        $this->load->view('templates/admin/footer');
    }


    public function filterlokasi($lokasi)
    {
        $data = [
            'judul' => 'Daftar Kamar',
            'kontrakan' => $this->ModelKontrakan->getWhereLokasi($lokasi),
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/daftarkamar', $data);
        $this->load->view('templates/admin/footer');
    }
    public function data_penyewa()
    {
        $keyword = $this->input->get('keyword');
        $data = [
            'judul' => 'Data Penyewa',
            'penyewa' => $this->ModelUser->getPenyewa($keyword), // Pastikan memanggil ModelUser
            'lokasi' => $this->ModelKontrakan->getLokasi()->result()
        ];

        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/data_penyewa', $data);
        $this->load->view('templates/admin/footer');
    }


    public function tambahkamar()
    {
        $data = [
            'judul' => 'Tambah Kamar',
        ];
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];

        // Validasi form input
        $this->form_validation->set_rules('nama_kamar', 'Nama Kamar', 'required|min_length[3]', [
            'required' => 'Nama kamar wajib diisi!',
            'min_length' => 'Nama kamar terlalu pendek!'
        ]);

        // Konfigurasi upload gambar
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '30000'; // Dalam KB
        $config['max_width'] = '10240'; // Dalam piksel
        $config['max_height'] = '10000'; // Dalam piksel
        $config['file_name'] = 'img' . time(); // Nama file yang diupload

        // Load library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            // Jika validasi form gagal
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/topbar');
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/tambahkamar', $data);
            $this->load->view('templates/admin/footer');
        } else {
            // Jika validasi form berhasil, cek apakah ada file yang diupload
            if ($this->upload->do_upload('image')) {
                // Jika upload berhasil
                $image_data = $this->upload->data(); // Ambil data file
                $image = $image_data['file_name']; // Ambil nama file gambar
            } else {
                // Jika upload gagal, tampilkan pesan error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('upload_error', $error); // Pesan error hanya untuk debugging
                $image = 'default.jpg'; // Default gambar jika upload gagal
            }
            // Data yang akan disimpan ke database
            $data = [
                'nama_kamar' => $this->input->post('nama_kamar', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'lokasi' => $this->input->post('lokasi', true),
                'image' => $image, // Simpan nama file gambar
                'harga' => $this->input->post('harga', true)
            ];

            // Simpan data ke dalam database
            $this->ModelKontrakan->simpanData($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Kamar Kontrakan Sudah Tersimpan</div>');
            redirect('admin/daftarkamar');
        }
    }

    public function detailkamar()
    {
        $id_kamar = $this->uri->segment(3);
        $kamar = $this->ModelKontrakan->getWhere($id_kamar)->result_array();

        if (empty($kamar)) {
            redirect('admin/daftarkamar'); // Redirect jika data kamar tidak ditemukan
        }

        $data = [
            'judul' => 'Detail Kamar',
            'kamar' => $kamar
        ];

        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/detailkamar', $data);
        $this->load->view('templates/admin/footer');
    }

    public function editkamar($id_kamar)
    {
        // Ambil data kamar berdasarkan ID
        $kamar = $this->ModelKontrakan->getWhere($id_kamar)->row();

        // Jika data kamar tidak ditemukan
        if (!$kamar) {
            redirect('admin/daftarkamar');
        }

        // Validasi form
        $this->form_validation->set_rules('nama_kamar', 'Nama Kamar', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form dengan pesan error
            $data = [
                'judul' => 'Edit Kamar',
                'kamar' => $kamar
            ];
            $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/topbar');
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('admin/editkamar', $data);
            $this->load->view('templates/admin/footer');
        } else {
            // Jika validasi sukses, update data kamar
            $data_update = [
                'nama_kamar' => $this->input->post('nama_kamar'),
                'deskripsi' => $this->input->post('deskripsi'),
                'harga' => $this->input->post('harga')
            ];

            // Cek jika ada gambar baru yang di-upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/img/upload/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = 2048; // Maksimal 2MB

                $this->upload->initialize($config);

                // Jika upload gagal
                if (!$this->upload->do_upload('image')) {
                    // Simpan pesan error upload
                    $this->session->set_flashdata('upload_error', $this->upload->display_errors());
                    redirect('admin/editkamar/' . $id_kamar);
                } else {
                    // Jika upload berhasil, ambil nama file gambar
                    $upload_data = $this->upload->data();
                    $new_image = $upload_data['file_name'];

                    // Hapus gambar lama jika ada
                    if ($kamar->image) {
                        unlink('./assets/img/upload/' . $kamar->image);
                    }

                    // Tambahkan nama file gambar baru ke data update
                    $data_update['image'] = $new_image;
                    $this->session->set_flashdata('upload_status', 'success');
                }
            }

            // Update data kamar di database
            $this->ModelKontrakan->updateKamar($id_kamar, $data_update);

            // Set pesan flashdata untuk menunjukkan hasil
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data kamar berhasil diperbarui</div>');

            // Redirect ke halaman yang sama
            redirect('admin/detailkamar/' . $id_kamar);
        }
    }


    public function booking_list()
    {
        $data['judul'] = 'Daftar Booking';

        // Mengambil data booking dengan detail pembayaran dari model
        $data['pending_bookings'] = $this->ModelBooking->get_all_pending_bookings();

        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];
        // Menampilkan view
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/booking', $data);
        $this->load->view('templates/admin/footer');
    }
    public function perpanjangan_list()
    {
        $data['judul'] = 'Daftar Booking';

        // Mengambil data booking dengan detail pembayaran dari model
        $data['pending_bookings'] = $this->ModelBooking->get_all_pending_perpanjangan();

        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        // $data['user'] = $user['nama'];
        // Menampilkan view
        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/perpanjangan', $data);
        $this->load->view('templates/admin/footer');
    }

    public function approve_booking($id_booking)
    {
        // Ambil detail booking berdasarkan id_booking
        $booking = $this->ModelBooking->get_booking_with_payment_details($id_booking);

        if ($booking) {
            log_message('info', 'Data booking ditemukan: ' . print_r($booking, true));

            // Siapkan data untuk dimasukkan ke dalam tabel sewa_kamar
            $data_sewa = [
                'id_booking' => $booking->id_booking,
                // 'id_kamar' => $booking->id_kamar,
                // 'id_user' => $booking->id_user,
                'sewa_start' => $booking->sewa_start,
                'sewa_end' => $booking->sewa_end,
                // 'jumlah' => $booking->jumlah,
                // 'id_pembayaran' => $booking->id_pembayaran,
                'status' => 'ongoing',
                'approved_by' => $this->session->userdata('id_user'),
                'created_at' => date('Y-m-d H:i:s'),
                'status_perpanjangan' => 1
            ];

            log_message('info', 'Data sewa yang akan dimasukkan: ' . print_r($data_sewa, true));

            // Masukkan data ke tabel sewa_kamar
            if ($this->ModelSewa->tambah_sewa($data_sewa)) {
                // Update status booking
                $this->ModelBooking->update_status_booking($id_booking, 'approved');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Booking telah disetujui.</div>');
            } else {
                // Jika ada kesalahan saat insert
                log_message('error', 'Gagal menambahkan data ke tabel sewa_kamar');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal menambahkan data sewa.</div>');
            }
        } else {
            // Jika booking tidak ditemukan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking tidak ditemukan.</div>');
        }

        // Redirect ke halaman booking list
        redirect('admin/booking_list');
    }

    public function reject_booking($id_booking)
    {
        $this->ModelBooking->update_status_booking($id_booking, 'rejected');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking telah ditolak.</div>');
        redirect('admin/booking_list');
    }

    public function approve_payment($id_booking)
    {
        $this->ModelBooking->update_payment_status($id_booking, 'paid');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Pembayaran telah disetujui.</div>');
        redirect('admin/booking_list');
    }

    public function reject_payment($id_booking)
    {
        $this->ModelBooking->update_payment_status($id_booking, 'rejected');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Pembayaran telah ditolak.</div>');
        redirect('admin/booking_list');
    }
    public function approve_perpanjangan($id_booking)
    {
        // Ambil detail booking berdasarkan id_booking
        $booking = $this->ModelBooking->get_booking_with_payment_details($id_booking);

        if ($booking) {
            log_message('info', 'Data booking ditemukan: ' . print_r($booking, true));

            // Siapkan data untuk dimasukkan ke dalam tabel sewa_kamar
            $data_sewa = [
                'id_booking' => $booking->id_booking,
                // 'id_kamar' => $booking->id_kamar,
                // 'id_user' => $booking->id_user,
                'sewa_start' => $booking->sewa_start,
                'sewa_end' => $booking->sewa_end,
                // 'jumlah' => $booking->jumlah,
                // 'id_pembayaran' => $booking->id_pembayaran,
                'status' => 'ongoing',
                'approved_by' => $this->session->userdata('id_user'),
                'created_at' => date('Y-m-d H:i:s'),
                'status_perpanjangan' => 1
            ];

            log_message('info', 'Data sewa yang akan dimasukkan: ' . print_r($data_sewa, true));

            // Masukkan data ke tabel sewa_kamar
            if ($this->ModelSewa->tambah_sewa($data_sewa)) {
                // Update status booking
                $this->ModelBooking->update_status_booking($id_booking, 'approved');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Perpanjangan sewa telah disetujui.</div>');
            } else {
                // Jika ada kesalahan saat insert
                log_message('error', 'Gagal menambahkan data ke tabel sewa_kamar');
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal menambahkan data sewa.</div>');
            }
        } else {
            // Jika booking tidak ditemukan
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking tidak ditemukan.</div>');
        }

        // Redirect ke halaman booking list
        redirect('admin/perpanjangan_list');
    }

    public function reject_perpanjangan($id_booking)
    {
        $this->ModelBooking->update_status_booking($id_booking, 'rejected');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking telah ditolak.</div>');
        redirect('admin/perpanjangan_list');
    }

    public function approve_perpanjangan_payment($id_booking)
    {
        $this->ModelBooking->update_payment_status($id_booking, 'paid');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Pembayaran telah disetujui.</div>');
        redirect('admin/perpanjangan_list');
    }

    public function reject_perpanjangan_payment($id_booking)
    {
        $this->ModelBooking->update_payment_status($id_booking, 'rejected');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Pembayaran telah ditolak.</div>');
        redirect('admin/perpanjangan_list');
    }

    public function profile()
    {
        $data['judul'] = 'Profile Admin';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/admin/footer');
    }
    public function edit_profile()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengedit profil. Pastikan semua data diisi.</div>');
            redirect('admin/profile');
        } else {
            $nama = $this->input->post('nama'); // Ambil data nama dari form
            $email = $this->input->post('email'); // Email readonly
            $no_hp = $this->input->post('no_hp'); // Email readonly

            // Handle foto profil jika ada yang diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $config['file_name'] = 'profile' . time();

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Ambil nama file gambar baru
                    $image_data = $this->upload->data(); // Ambil data file
                    $image = $image_data['file_name'];
                    $this->db->set('image', $image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('email', $email);
            $this->db->set('no_hp', $no_hp);
            $this->db->where('id_user', $this->session->userdata('id_user'));
            $this->db->update('user'); // Asumsi tabel user adalah 'users'

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Profil berhasil diubah!</div>');
            redirect('admin/profile');
        }
    }
}
