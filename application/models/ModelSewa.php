<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSewa extends CI_Model
{
    public function tambah_sewa($data_sewa)
    {
        if ($this->db->insert('sewa_kamar', $data_sewa)) {
            return true; // Berhasil
        } else {
            // Menangkap dan mencetak pesan error
            log_message('error', 'Gagal menambah sewa: ' . $this->db->error()['message']);
            return false; // Gagal
        }
    }

    // public function getIdSewa($id_sewa)
    // {
    //     $this->db->select('r.*, k.nama_kamar, k.harga, p.*');
    //     $this->db->from('sewa_kamar r');
    //     $this->db->join('kamar k', 'r.id_kamar = k.id_kamar'); // Join dengan tabel kamar
    //     $this->db->join('pembayaran p', 'r.id_pembayaran = p.id_pembayaran', 'left'); // LEFT JOIN agar tetap muncul walaupun belum ada pembayaran
    //     $this->db->where('r.id_sewa', $id_sewa); // Cari berdasarkan id_sewa
    //     return $this->db->get()->row(); // Gunakan row() jika hanya mengharapkan satu hasil

    //     print_r($result);
    //     die(); // Hentikan eksekusi sementara untuk melihat hasil query

    //     return $result;
    // }

    public function tambah_pembayaran($data_pembayaran)
    {
        $this->db->insert('pembayaran', $data_pembayaran);
    }

    public function updateOngoingSewa()
    {
        // Update semua penyewaan yang belum dimulai (sewa_start > tanggal sekarang) dan statusnya bukan pending
        $this->db->set('status', 'ongoing');
        $this->db->where('sewa_start <=', date('Y-m-d'));
        $this->db->where('status !=', 'ongoing');
        $this->db->update('sewa_kamar');
        return $this->db->affected_rows();
    }
    public function updatePendingSewa()
    {
        // Update semua penyewaan yang belum dimulai (sewa_start > tanggal sekarang) dan statusnya bukan pending
        $this->db->set('status', 'pending');
        $this->db->where('sewa_start >', date('Y-m-d'));
        $this->db->where('status !=', 'pending');
        $this->db->update('sewa_kamar');
        return $this->db->affected_rows();
    }
    public function updateExpiredSewa()
    {
        // Update semua penyewaan yang sudah selesai (sewa_end < tanggal sekarang) menjadi 'completed'
        $this->db->set('status', 'completed');
        $this->db->where('sewa_end <', date('Y-m-d'));
        $this->db->where('status !=', 'completed');
        $this->db->update('sewa_kamar');
        return $this->db->affected_rows();
    }

    public function updateSewaStatuses()
    {
        // Panggil kedua fungsi untuk memperbarui status yang habis dan belum dimulai
        $ongoingUpdated = $this->updateOngoingSewa();
        $expiredUpdated = $this->updateExpiredSewa();
        $pendingUpdated = $this->updatePendingSewa();
        return array($ongoingUpdated, $pendingUpdated, $expiredUpdated);
    }

    public function updateStatusSewaOtomatis()
    {
        // This method can be used to update the statuses automatically.
        $updateResult = $this->updateSewaStatuses(); // Call the method that updates expired and pending statuses.
        // You can add more logic here if needed.
        return $updateResult;
    }


    public function getKamarByUserId($id_user)
    {
        $this->db->select('booking.*, lokasi.*, kamar.nama_kamar, kamar.harga, kamar.image, pembayaran.payment_status, sewa_kamar.id_sewa, sewa_kamar.status, sewa_kamar.sewa_start');
        $this->db->from('booking');
        $this->db->join('kamar', 'booking.id_kamar = kamar.id_kamar');
        $this->db->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi');
        $this->db->join('pembayaran', 'booking.id_booking = pembayaran.id_booking', 'left'); // LEFT JOIN agar booking tanpa pembayaran juga ditampilkan
        $this->db->join('sewa_kamar', 'sewa_kamar.id_booking = booking.id_booking', 'left'); // LEFT JOIN to get id_sewa
        $this->db->where('booking.id_user', $id_user);
        $this->db->where_in('sewa_kamar.status', ['ongoing', 'pending']);
        // $this->db->limit(1);
        $this->db->order_by('sewa_kamar.sewa_start', 'ASC');
        return $this->db->get()->result();
    }
    public function getKamarByUserIdHistory($id_user)
    {
        $this->db->select('booking.*,lokasi.*, kamar.nama_kamar, kamar.harga, kamar.image, pembayaran.payment_status, sewa_kamar.id_sewa, sewa_kamar.status');
        $this->db->from('booking');
        $this->db->join('kamar', 'booking.id_kamar = kamar.id_kamar');
        $this->db->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi');
        $this->db->join('pembayaran', 'booking.id_booking = pembayaran.id_booking', 'left'); // LEFT JOIN agar booking tanpa pembayaran juga ditampilkan
        $this->db->join('sewa_kamar', 'sewa_kamar.id_booking = booking.id_booking', 'left'); // LEFT JOIN to get id_sewa
        $this->db->where('booking.id_user', $id_user);
        $this->db->order_by('booking.sewa_start', 'DESC');
        return $this->db->get()->result();
    }


    public function getBooking($id_booking)
    {
        $this->db->where('id_booking', $id_booking);
        $query = $this->db->get('booking');
        return $query->row();
    }

    public function getSewaById($id_sewa)
    {
        $this->db->select('r.*, k.nama_kamar, k.id_kamar, k.harga, p.*');
        $this->db->from('sewa_kamar r');
        $this->db->join('booking b', 'r.id_booking = b.id_booking'); // Join dengan tabel kamar
        $this->db->join('kamar k', 'b.id_kamar = k.id_kamar'); // Join dengan tabel kamar
        $this->db->join('pembayaran p', 'b.id_booking = p.id_booking', 'left'); // LEFT JOIN agar tetap muncul walaupun belum ada pembayaran
        $this->db->where('r.id_sewa', $id_sewa); // Cari berdasarkan id_sewa

        return $this->db->get()->row();
    }

    public function getSewaReports($keyword = null)
    {
        $this->db->select('sewa_kamar.id_sewa,lokasi.lokasi, kamar.nama_kamar, user.nama, sewa_kamar.sewa_start, sewa_kamar.sewa_end, sewa_kamar.status, pembayaran.jumlah, pembayaran.payment_status');
        $this->db->from('sewa_kamar');
        $this->db->join('booking', 'sewa_kamar.id_booking = booking.id_booking');
        $this->db->join('user', 'booking.id_user = user.id_user');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->join('lokasi', 'kamar.id_lokasi = lokasi.id_lokasi');
        $this->db->join('pembayaran', 'booking.id_booking = pembayaran.id_booking');
        $this->db->order_by('sewa_kamar.sewa_start', 'DESC');
        if ($keyword) {
            $this->db->group_start()
                ->like('kamar.nama_kamar', $keyword)
                ->or_like('user.nama', $keyword)
                ->group_end();
        }
        return $this->db->get()->result();
    }

    public function get_ongoing_rentals()
    {
        $this->db->select('kamar.nama_kamar, lokasi.*, user.nama, sewa_kamar.sewa_start, sewa_kamar.sewa_end, pembayaran.jumlah, sewa_kamar.status');
        $this->db->from('sewa_kamar');
        $this->db->join('booking', 'sewa_kamar.id_booking = booking.id_booking');
        $this->db->join('user', 'booking.id_user = user.id_user');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi');
        $this->db->join('pembayaran', 'booking.id_booking = pembayaran.id_booking');
        $this->db->where_in('sewa_kamar.status', ['ongoing', 'pending']);
        $this->db->order_by('sewa_kamar.sewa_start', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_ongoing_count()
    {

        $this->db->select('COUNT(*) AS ongoing');
        $this->db->from('sewa_kamar'); // Ganti dengan nama tabel yang sesuai
        $this->db->where_in('status', ['ongoing', 'pending']);
        $query = $this->db->get();

        return $query->row()->ongoing; // Mengembalikan jumlah booking pending
    }
    public function getPaymentReport($keyword = null)
    {
        $this->db->select('sewa_kamar.id_sewa,lokasi.lokasi,booking.perpanjangan, kamar.nama_kamar, user.nama, pembayaran.*');
        $this->db->from('sewa_kamar');
        $this->db->join('booking', 'sewa_kamar.id_booking = booking.id_booking');
        $this->db->join('user', 'booking.id_user = user.id_user');
        $this->db->join('kamar', 'kamar.id_kamar = booking.id_kamar');
        $this->db->join('lokasi', 'kamar.id_lokasi = lokasi.id_lokasi');
        $this->db->join('pembayaran', 'booking.id_booking = pembayaran.id_booking');
        $this->db->order_by('pembayaran.tanggal_pembayaran', 'ASC');
        if ($keyword) {
            $this->db->group_start()
                ->like('kamar.nama_kamar', $keyword)
                ->or_like('user.nama', $keyword)
                ->group_end();
        }
        return $this->db->get()->result();
    }

    // Fungsi untuk mendapatkan pendapatan bulan tertentu
    public function get_pendapatan_by_month($month, $year)
    {
        $this->db->select_sum('jumlah'); // Menjumlahkan field 'jumlah'
        $this->db->where('payment_status', 'paid'); // Syarat status pembayaran 'paid'
        $this->db->where('MONTH(tanggal_pembayaran)', $month); // Filter bulan
        $this->db->where('YEAR(tanggal_pembayaran)', $year); // Filter tahun
        $query = $this->db->get('pembayaran'); // Eksekusi query di tabel 'pembayaran'
        return $query->row()->jumlah ?? 0; // Return hasil atau 0 jika tidak ada data
    }

    public function get_pendapatan_histori()
    {
        $this->db->select("DATE_FORMAT(tanggal_pembayaran, '%M %Y') as bulan, SUM(jumlah) as total"); // Format bulan & tahun
        $this->db->where('payment_status', 'paid'); // Syarat status pembayaran 'paid'
        $this->db->group_by("YEAR(tanggal_pembayaran), MONTH(tanggal_pembayaran)"); // Kelompokkan per bulan & tahun
        $this->db->order_by("tanggal_pembayaran", "DESC"); // Urutkan dari yang terbaru
        $query = $this->db->get('pembayaran'); // Eksekusi query di tabel 'pembayaran'
        return $query->result(); // Return hasil sebagai array objek
    }



    public function GetPerpanjang($id_kamar)
    {
        $this->db->select('k.*, b.*, s.id_sewa');
        $this->db->from('kamar k');
        $this->db->join('booking b', 'b.id_kamar = k.id_kamar');
        $this->db->join('sewa_kamar s', 'b.id_booking = s.id_booking');
        $this->db->where('k.id_kamar', $id_kamar);
        $this->db->order_by('b.sewa_end', 'DESC'); // Urutkan berdasarkan tanggal akhir sewa
        $this->db->limit(1);
        // Ambil data terbaru
        $query = $this->db->get();
        return $query->row();
        // Tambahkan debug
        if (!$query) {
            // Outputkan error dari query jika gagal
            echo $this->db->last_query(); // Menampilkan query yang terakhir dijalankan
            echo $this->db->error(); // Menampilkan error query jika ada
        }
    }
}
