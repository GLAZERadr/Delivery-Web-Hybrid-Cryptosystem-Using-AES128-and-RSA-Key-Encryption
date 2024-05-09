<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }
        
        $this->load->view('home/layout/header');
        $this->load->view('home/index');
        $this->load->view('home/layout/footer');
    }

    public function pengiriman()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->view('home/layout/header');
        $this->load->view('home/pengiriman');
        $this->load->view('home/layout/footer');
    }

    public function rekappaket()
    {
        if (empty($this->session->userdata('rekap_paket'))) {
            redirect('home/pengiriman');
        }

        $data['rekap_paket'] = $this->session->userdata('rekap_paket');
        
        $this->load->view('home/layout/header');
        $this->load->view('home/rekappaket', $data);
        $this->load->view('home/layout/footer');
    }
    
    public function riwayat()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pengiriman');

        $idPelanggan = $this->session->userdata("pengguna")["idpelanggan"];

        $pengirimanPelanggan =  $this->m_pengiriman->pengirimanPelanggan($idPelanggan);

        $data = [
            'pengiriman' => $pengirimanPelanggan,
        ];

        $this->load->view('home/layout/header');
        $this->load->view('home/riwayat', $data);
        $this->load->view('home/layout/footer');
    }

    public function kontak()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/kontak');
        $this->load->view('home/layout/footer');
    }

    public function profil()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pelanggan');

        $idPelanggan = $this->session->userdata("pengguna")["idpelanggan"];
        $pelanggan =  $this->m_pelanggan->tampilPelanggan($idPelanggan);

        $data = [
            'row' => $pelanggan,
        ];

        $this->load->view('home/layout/header');
        $this->load->view('home/profil', $data);
        $this->load->view('home/layout/footer');
    }
}
