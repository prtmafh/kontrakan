<?php
class Test extends CI_Controller
{

    public function index()
    {
        $this->load->database(); // Memuat database jika belum di-autoload

        if ($this->db->initialize()) {
            echo "Koneksi database berhasil!";
        } else {
            echo "Koneksi database gagal!";
        }
    }
}
