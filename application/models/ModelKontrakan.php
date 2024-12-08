<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKontrakan extends CI_Model
{
    public function simpanData($data)
    {
        return $this->db->insert('kamar', $data);
    }
    public function getData()
    {
        return $this->db->get('kamar');
    }
    public function getAllKamarWithStatus()
    {
        // Subquery to check if a room is currently rented or booked
        $this->db->select('1')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')
            ->where('booking.id_kamar = kamar.id_kamar', NULL, FALSE)
            ->where_not_in('sewa_kamar.status', ['completed', 'canceled']); // Exclude completed or canceled rentals

        $subquery = $this->db->get_compiled_select();

        // Main query to fetch all rooms with availability status
        $this->db->select('kamar.*, lokasi.*, (CASE WHEN EXISTS (' . $subquery . ') THEN 0 ELSE 1 END) AS tersedia')
            ->from('kamar')
            ->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi');

        return $this->db->get()->result();
    }

    public function getWhere($id_kamar)
    {
        // Subquery untuk memeriksa apakah kamar sedang disewa atau dipesan
        $this->db->select('1')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')
            ->where('booking.id_kamar = k.id_kamar', NULL, FALSE)
            ->where_not_in('sewa_kamar.status', ['completed', 'canceled']);

        $subquery = $this->db->get_compiled_select();

        // Query utama untuk mengambil detail kamar
        $this->db->select('k.*, l.*, (CASE WHEN EXISTS (' . $subquery . ') THEN 0 ELSE 1 END) AS tersedia')
            ->from('kamar k')
            ->join('lokasi l', 'l.id_lokasi = k.id_lokasi')
            ->where('k.id_kamar', $id_kamar);

        return $this->db->get();
    }


    public function updateKamar($id_kamar, $data)
    {
        $this->db->where('id_kamar', $id_kamar);
        return $this->db->update('kamar', $data);
    }
    public function getWhereLokasi($lokasi)
    {
        $this->db->select('l.* , k.*');
        $this->db->from('kamar k');
        $this->db->join('lokasi l', 'l.id_lokasi = k.id_lokasi');
        $this->db->where('l.id_lokasi', $lokasi);
        return $this->db->get()->result();
    }

    public function getWhereLokasiAdmin($lokasi)
    {
        // Subquery untuk memeriksa apakah kamar sedang disewa atau dipesan
        $this->db->select('1')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')
            ->where('booking.id_kamar = k.id_kamar', NULL, FALSE)
            ->where_not_in('sewa_kamar.status', ['completed', 'canceled']);

        $subquery = $this->db->get_compiled_select();

        // Query utama untuk mengambil kamar berdasarkan lokasi dengan status ketersediaan
        $this->db->select('k.*, l.*, (CASE WHEN EXISTS (' . $subquery . ') THEN 0 ELSE 1 END) AS tersedia')
            ->from('kamar k')
            ->join('lokasi l', 'l.id_lokasi = k.id_lokasi')
            ->where('l.id_lokasi', $lokasi);

        return $this->db->get()->result();
    }

    public function getLokasi()
    {

        return $this->db->get('lokasi');
    }
    public function getIdKamar($id_kamar)
    {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->where('id_kamar', $id_kamar); // Menambahkan kondisi WHERE berdasarkan id_kamar
        $query = $this->db->get();
        return $query->row(); // Mengembalikan hasil query sebagai satu objek (row)
    }
    public function tambah_sewa($data_sewa)
    {
        $this->db->insert('sewa_kamar', $data_sewa);
        return $this->db->insert_id();
    }

    public function getKamarReady()
    {
        // Subquery to select kamar that are currently rented or booked
        $this->db->select('booking.id_kamar')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')

            ->where_not_in('sewa_kamar.status', ['completed', 'canceled']); // Exclude completed or canceled rentals

        $subquery = $this->db->get_compiled_select();

        // Main query to select rooms that are not rented or booked
        $this->db->select('kamar.*, lokasi.*')
            ->from('kamar')
            ->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi')
            ->where("id_kamar NOT IN ($subquery)", NULL, FALSE); // Ensure the subquery is used in the main query

        return $this->db->get()->result(); // Return the result set
    }

    public function getTotalKamarReady()
    {
        // Subquery to select kamar that are currently rented or booked
        $this->db->select('booking.id_kamar')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')
            ->where_not_in('sewa_kamar.status', ['completed', 'canceled']); // Exclude completed or canceled rentals

        $subquery = $this->db->get_compiled_select();

        // Main query to count rooms that are not rented or booked
        $this->db->select('COUNT(*) as total_kamar')
            ->from('kamar')
            ->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi')
            ->where("id_kamar NOT IN ($subquery)", NULL, FALSE); // Ensure the subquery is used in the main query

        $result = $this->db->get()->row(); // Fetch the single row result
        return $result->total_kamar; // Return the total count
    }

    public function getKamarReadyLokasi($lokasi)
    {
        // Subquery to select kamar that are currently rented or booked
        $this->db->select('booking.id_kamar')
            ->from('sewa_kamar')
            ->join('booking', 'booking.id_booking = sewa_kamar.id_booking')
            ->where_not_in('status', ['completed', 'canceled']); // Exclude completed or canceled rentals

        $subquery = $this->db->get_compiled_select();

        // Main query to select rooms that are not rented or booked
        $this->db->select('kamar.*, lokasi.*')
            ->from('kamar')
            ->join('lokasi', 'lokasi.id_lokasi = kamar.id_lokasi')
            ->where("id_kamar NOT IN ($subquery)", NULL, FALSE)
            ->where('lokasi', $lokasi); // Ensure the subquery is used in the main query

        return $this->db->get()->result(); // Return the result set
    }
}
