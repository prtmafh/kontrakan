<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelBooking extends CI_Model
{
    // Fungsi untuk mengambil semua data booking yang perlu disetujui
    public function get_all_pending_bookings()
    {
        $this->db->select('b.id_booking, k.nama_kamar, u.nama, b.*, p.*');
        $this->db->from('booking b');
        $this->db->join('kamar k', 'b.id_kamar = k.id_kamar');
        $this->db->join('user u', 'b.id_user = u.id_user');
        $this->db->join('pembayaran p', 'b.id_booking = p.id_booking'); // Join ke tabel pembayaran
        $this->db->where('b.booking_status', 'pending'); // Hanya ambil yang pending
        $this->db->where('b.perpanjangan', 0); // Hanya ambil yang pending
        return $this->db->get()->result(); // Mengembalikan hasil sebagai array of objects
    }

    public function get_all_pending_perpanjangan()
    {
        $this->db->select('b.id_booking, k.nama_kamar, u.nama, b.*, p.*');
        $this->db->from('booking b');
        $this->db->join('kamar k', 'b.id_kamar = k.id_kamar');
        $this->db->join('user u', 'b.id_user = u.id_user');
        $this->db->join('pembayaran p', 'b.id_booking = p.id_booking'); // Join ke tabel pembayaran
        $this->db->where('b.booking_status', 'pending'); // Hanya ambil yang pending
        $this->db->where('b.perpanjangan', 1); // Hanya ambil yang pending
        return $this->db->get()->result(); // Mengembalikan hasil sebagai array of objects
    }

    public function get_booking_with_payment_details($id_booking)
    {
        $this->db->select('b.*, p.id_pembayaran, p.tanggal_pembayaran, p.payment_method, p.jumlah, p.payment_status as status_pembayaran'); // Pilih kolom yang diinginkan
        $this->db->from('booking b'); // Alias 'b' untuk tabel booking
        $this->db->join('pembayaran p', 'p.id_booking = b.id_booking', 'left'); // Bergabung dengan tabel pembayaran
        $this->db->where('b.id_booking', $id_booking); // Hanya ambil berdasarkan id_booking
        return $this->db->get()->row(); // Menggunakan row() untuk mendapatkan satu objek
    }



    public function update_status_booking($id_booking, $status)
    {
        $data = array(
            'booking_status' => $status
        );
        $this->db->where('id_booking', $id_booking);
        $this->db->update('booking', $data);
    }
    public function update_payment_status($id_booking, $status)
    {
        $data = array(
            'payment_status' => $status
        );
        $this->db->where('id_booking', $id_booking);
        $this->db->update('pembayaran', $data);
    }
    public function get_payment_details($id_booking)
    {
        $this->db->select('*');
        $this->db->from('payments');
        $this->db->where('id_booking', $id_booking);
        $query = $this->db->get();
        return $query->row(); // Jika hanya satu hasil
    }
    public function get_pending_count()
    {
        $this->db->select('COUNT(*) AS total_pending');
        $this->db->from('booking'); // Ganti dengan nama tabel yang sesuai
        $this->db->where('booking_status', 'pending');
        $query = $this->db->get();

        return $query->row()->total_pending; // Mengembalikan jumlah booking pending
    }
}
