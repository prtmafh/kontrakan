<?php
function cek_login()
{
    $ci = get_instance();
    $id_role = $ci->session->userdata('role');
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
        if ($id_role != 'admin') {
            redirect('auth');
        } else {
            redirect('admin');
        }
    }
}
if (!function_exists('cek_role')) {
    function cek_role($required_role)
    {
        $ci = get_instance();
        $role = $ci->session->userdata('role'); // Ambil role dari session

        if ($role != $required_role) {
            $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda bukan admin</div>');

            redirect('home'); // Redirect ke halaman error jika role tidak sesuai
            exit;
        }
    }
}
