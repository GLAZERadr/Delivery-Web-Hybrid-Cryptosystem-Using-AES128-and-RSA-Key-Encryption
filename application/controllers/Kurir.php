<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/index');
        $this->load->view('kurir/layout/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('alert', 'Anda Telah Logout');

        redirect('home');
    }

    public function pengirimandaftar()
    {
        $this->load->model('m_kurir');

        $idkurir = $this->session->userdata("kurir")["idkurir"];
        $pengiriman =  $this->m_kurir->daftarPengiriman($idkurir);

        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/pengirimandaftar', $data);
        $this->load->view('kurir/layout/footer');
    }

    public function historypengiriman()
    {
        $this->load->model('m_kurir');

        $idkurir = $this->session->userdata("kurir")["idkurir"];
        $pengiriman =  $this->m_kuriir->historyPenghiriman($idkurir);

        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/historypengiriman', $data);
        $this->load->view('kurir/layout/footer');
    }

    public function pengirimanedit($id)
    {
        $this->load->model('m_pengiriman');

        $pengiriman =  $this->m_pengiriman->tampilPengiriman($id);

        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/pengirimanedit', $data);
        $this->load->view('kurir/layout/footer');
    }

    public function updatelokasi($id)
    {
        $this->load->model('m_pengiriman');

        $lat = $this->input->post('lat');
        $lang = $this->input->post('lng');

        $data = array(
            'lat' => $lat,
            'lang' => $lang,
            'keterangan' => 'Lokasi kurir diperbarui pada ' . date('Y-m-d H:i:s'),
        );

        $this->m_pengiriman->updateKoordinatLokasi($id, $data);
        $this->session->set_flashdata('flash', 'Lokasi berhasil diupdate');
        redirect('kurir/pengirimandaftar');
    }

    public function updatestatus($id)
    {
        $this->load->model('m_pengiriman');

        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'status' => $status,
            'keterangan' => $keterangan,
        );

        $this->m_pengiriman->updatestatus($id, $data);
        $this->session->set_flashdata('flash', 'Data berhasil diupdate');
        redirect('kurir/pengirimandaftar');
    }

    public function profil()
    {
        $this->load->model('m_kurir');

        $idkurir = $this->session->userdata("kurir")["idkurir"];
        $kurir =  $this->m_kurir->tampilKurir($id);

        $data = [
            'kurir' => $kurir,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/profil', $data);
        $this->load->view('kurir/layout/footer');
    }

    public function profiledit($id)
    {
        $this->load->model('m_kurir');

        $namakurir = ucwords($this->input->post('namakurir'));
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($password == '') {
            $password = $this->input->post('passwordlama');
        }

        $data = array(
            'namakurir' => $namakurir,
            'nohp' => $nohp,
            'username' => $username,
            'password' => $password,
        );

        $this->m_kurir->updateKurir($id, $data);

        $this->session->set_flashdata('flash', 'Data berhasil diupdate');
        redirect('kurir/profil');
    }

    public function rutepengiriman($kodepengiriman)
    {
        $this->load->model('m_pengiriman');
        
        $pengiriman =  $this->m_pengiriman->rutePengiriman($kodepengiriman);

        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/rutepengiriman', $data);
        $this->load->view('kurir/layout/footer');
    }
}
