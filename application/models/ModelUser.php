<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }

    public function cekData($where)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }
    public function Get()
    {
        return $this->db->get('user');
    }
    public function getPenyewa($keyword = null)
    {
        // Select all columns from the user table
        $this->db->select('*')
            ->from('user')
            ->where('role', 'penyewa'); // Gunakan tanda kutip untuk nilai

        // If a keyword is provided, apply search filters
        if ($keyword) {
            $this->db->group_start()
                ->like('user.nama', $keyword) // Gunakan like untuk mencari
                ->group_end();
        }

        // Execute the query and return the result
        return $this->db->get()->result();
    }
    public function get_total_penyewa()
    {

        $this->db->select('COUNT(*) AS penyewa');
        $this->db->from('user'); // Ganti dengan nama tabel yang sesuai
        $this->db->where('role', 'penyewa'); // Gunakan t
        $query = $this->db->get();

        return $query->row()->penyewa; // Mengembalikan jumlah booking pending
    }
}
