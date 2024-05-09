<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/login');
        $this->load->view('home/layout/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('alert', 'Anda Telah Logout');

        redirect('home');
    }

    public function prosesLoginPelanggan()
    {
        $this->load->model('m_auth');

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $cekUsernameAndPassword = $this->m_auth->cekUsernameAndPasswordPelanggan($username, $password);

        if ($cekUsernameAndPassword->num_rows() == 1) {
            $akun = $cekUsernameAndPassword->row_array();
            $this->session->set_userdata("pengguna", $akun);
            $this->session->set_flashdata('alert', 'Anda sukses login');
            redirect('home');
        } else {
            $this->session->set_flashdata('alert', 'Anda gagal login, Cek akun anda');
            redirect('auth/login');
        }
    }

    public function loginadmin()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/loginadmin');
        $this->load->view('home/layout/footer');
    }

    public function prosesLoginAdmin()
    {
        $this->load->model('m_auth');

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $cekUsernameAndPassword = $this->m_auth->cekUsernameAndPasswordAdmin($username, $password);

        if ($cekUsernameAndPassword->num_rows() == 1) {
            $akun = $cekUsernameAndPassword->row_array();
            $this->session->set_userdata("admin", $akun);
            $this->session->set_flashdata('alert', 'Anda sukses login');
            redirect('admin');
        } else {
            $this->session->set_flashdata('alert', 'Anda gagal login, Cek akun anda');
            redirect('auth/login');
        }
    }

    public function loginkurir()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/loginkurir');
        $this->load->view('home/layout/footer');
    }

    public function prosesLoginKurir()
    {
        $this->load->model('m_auth');

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $cekUsernameAndPassword = $this->m_auth->cekUsernameAndPasswordKurir($username, $password);

        if ($cekUsernameAndPassword->num_rows() == 1) {
            $akun = $cekUsernameAndPassword->row_array();
            $this->session->set_userdata("kurir", $akun);
            $this->session->set_flashdata('alert', 'Anda sukses login');
            redirect('kurir');
        } else {
            $this->session->set_flashdata('alert', 'Anda gagal login, Cek akun anda');
            redirect('auth/login');
        }
    }

    public function daftar()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/daftar');
        $this->load->view('home/layout/footer');
    }

    public function prosesPendaftaranPelanggan()
    {
        $this->load->model('m_auth');
        $this->load->model('m_pelanggan');

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nohp = $this->input->post('nohp');

        $usernameSudahAda = $this->m_auth->cekUsername($username);

        if ($usernameSudahAda == 1) {
            $this->session->set_flashdata('alert', 'Pendaftaran Gagal, Username sudah ada');

            redirect('auth/daftar');
        } else {
            $data = [
                'namapelanggan' => $nama,
                'username' => $username,
                'password' => $password,
                'nohp' => $nohp,
            ];

            $this->m_pelanggan->tambahPelanggan($data);

            $this->session->set_flashdata('alert', 'Pendaftaran Berhasil');

            redirect('auth/login');
        }
    }

}