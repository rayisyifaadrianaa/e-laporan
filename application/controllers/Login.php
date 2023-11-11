<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('v_login');
    }

    public function register()
    {
        $this->load->view('v_register');
    }

    public function do_login()
    {
        $params = $this->input->post();
        $this->db->where('username', $params['username']);
        $this->db->where('password', md5($params['password']));
        $login = $this->db->get('users')->row_array();
        if ($login) {
            $_SESSION['id'] = $login['id'];
            $_SESSION['username'] = $params['username'];
            $_SESSION['password'] = $params['password'];
            $_SESSION['email'] = $login['email'];
            $_SESSION['foto'] = $login['foto'];
            $_SESSION['role'] = $login['role'];
            $_SESSION['id_pegawai'] = $login['id_pegawai'];

            $this->db->where('id', $login['id_pegawai']);
            $_SESSION['pegawai'] = $this->db->get('pegawai')->row_array();

            redirect('/dashboard', 'refresh');
            
        } else {
            echo "<script>alert('Username/Password salah, silahkan coba kembali'); location.href = '".base_url()."login';</script>";
        }
    }

    public function do_register()
    {
        $params = $this->input->post();
        $this->db->where('username', $params['username']);
        $login = $this->db->get('users')->row_array();
        if ($login) {
            echo "<script>alert('Pendaftaran gagal dilakukan karena username sudah terdaftar'); location.href = '".base_url()."login/register';</script>";

        } else {
            $this->db->insert('users', [
                'username' => $params['username'],
                'password' => $params['password'],
                'foto' => base_url().'assets/upload/avatar/default.jpg',
                'role' => 'pasien',
            ]);

            echo "<script>alert('Akun berhasil terdaftar, silahkan masuk'); location.href = '".base_url()."login';</script>";
        }
    }
}
