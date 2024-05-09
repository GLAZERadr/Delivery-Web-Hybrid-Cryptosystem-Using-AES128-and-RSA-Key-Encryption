<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function pengirimanrekap()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $idpelanggan = $this->session->userdata("pengguna")["idpelanggan"];
        $namapengirim = $this->input->post('namapengirim');
        $nohppengirim = $this->input->post('nohppengirim');
        $alamatpengirim = $this->input->post('alamatpengirim');
        $namapenerima = $this->input->post('namapenerima');
        $nohppenerima = $this->input->post('nohppenerima');
        $alamatpenerima = $this->input->post('alamatpenerima');
        $jenisbarang = $this->input->post('jenisbarang');
        $berat = $this->input->post('berat');
        $jenislayanan = $this->input->post('jenislayanan');
        $biaya = $this->input->post('biaya');
        $lat_pengirim = $this->input->post('lat_pengirim');
        $lang_pengirim = $this->input->post('lang_pengirim');
        $lat_penerima = $this->input->post('lat_penerima');
        $lang_penerima = $this->input->post('lang_penerima');
        $kodepengiriman = "DLV" . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        $data = [
            'idpelanggan'       =>  $idpelanggan,
            'kodepengiriman'    =>  $kodepengiriman,
            'namapengirim'      =>  $namapengirim,
            'nohppengirim'      =>  $nohppengirim,
            'alamatpengirim'    =>  $alamatpengirim,
            'namapenerima'      =>  $namapenerima,
            'nohppenerima'      =>  $nohppenerima,
            'alamatpenerima'    =>  $alamatpenerima,
            'jenisbarang'       =>  $jenisbarang,
            'berat'             =>  $berat,
            'jenislayanan'      =>  $jenislayanan,
            'lat_pengirim'      =>  $lat_pengirim,
            'lang_pengirim'     =>  $lang_pengirim,
            'lat_penerima'      =>  $lat_penerima,
            'lang_penerima'     =>  $lang_penerima,
            'biaya'             =>  $biaya,
            'status'            =>  'Menunggu Konfirmasi Admin',
            'tanggal'           =>  date('Y-m-d'),
        ];

        $this->session->set_userdata('rekap_paket', $data);

        redirect('home/rekappaket');
    }

    public function pengirimansubmit()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pengiriman');

        $idpelanggan = $this->session->userdata("pengguna")["idpelanggan"];
        $namapengirim = $this->input->post('namapengirim');
        $nohppengirim = $this->input->post('nohppengirim');
        $alamatpengirim = $this->input->post('alamatpengirim');
        $namapenerima = $this->input->post('namapenerima');
        $nohppenerima = $this->input->post('nohppenerima');
        $alamatpenerima = $this->input->post('alamatpenerima');
        $jenisbarang = $this->input->post('jenisbarang');
        $berat = $this->input->post('berat');
        $jenislayanan = $this->input->post('jenislayanan');
        $lat_pengirim = $this->input->post('lat_pengirim');
        $lang_pengirim = $this->input->post('lang_pengirim');
        $lat_penerima = $this->input->post('lat_penerima');
        $lang_penerima = $this->input->post('lang_penerima');
        $waktupickup = $this->input->post('waktupickup');
        $biaya = $this->input->post('biaya');
        $kodepengiriman = "DLV" . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

        $data = [
            'idpelanggan' =>    $idpelanggan,
            'kodepengiriman' =>    $kodepengiriman,
            'namapengirim' =>    $namapengirim,
            'nohppengirim'      =>    $nohppengirim,
            'alamatpengirim'  =>    $alamatpengirim,
            'namapenerima' =>    $namapenerima,
            'nohppenerima'      =>    $nohppenerima,
            'alamatpenerima'  =>    $alamatpenerima,
            'jenisbarang'  =>    $jenisbarang,
            'berat'  =>    $berat,
            'jenislayanan'  =>    $jenislayanan,
            'lat_pengirim'  =>    $lat_pengirim,
            'lang_pengirim'  =>    $lang_pengirim,
            'lat_penerima'  =>    $lat_penerima,
            'lang_penerima'  =>    $lang_penerima,
            'waktupickup'  =>    $waktupickup,
            'biaya'  =>    $biaya,
            'status'  =>    'Menunggu Konfirmasi Admin',
            'tanggal' => date('Y-m-d'),
        ];

        $this->m_pengiriman->tambahPengiriman($data);

        $this->session->unset_userdata('rekap_paket');
        $this->session->set_flashdata('alert', 'Pengiriman berhasil ditambahkan');
        redirect('home/riwayat');
    }

    public function inputtracking()
    {
        $kodepengiriman = $this->input->post('kodepengiriman');
        redirect('pelanggan/tracking/' . $kodepengiriman);
    }

    public function tracking($kodePengiriman)
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pengiriman');

        $trackingPengiriman =  $this->m_pengiriman->trackingPengiriman($kodePengiriman);

        $data = [
            'pengiriman' => $trackingPengiriman,
        ];

        $this->load->view('home/layout/header');
        $this->load->view('home/tracking', $data);
        $this->load->view('home/layout/footer');
    }

    public function profiledit($id)
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pelanggan');

        $namapelanggan = ucwords($this->input->post('nama'));
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($password == '') {
            $password = $this->input->post('passwordlama');
        }

        $data = [
            'namapelanggan' => $namapelanggan,
            'nohp' => $nohp,
            'username' => $username,
            'password' => $password,
        ];

        $this->m_pelanggan->updatePelanggan($id, $data);

        $this->session->set_flashdata('alert', 'Profil berhasil diupdate');
        redirect('home/profil');
    }

    public function konfirmasiselesai($id)
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('auth/login');
        }

        $this->load->model('m_pengiriman');

        $data = [
            'status' => 'Selesai',
            'keterangan' => 'Pesanan Telah Sampai Pada Penerima.',
        ];

        $this->m_pengiriman->konfirmasiPengirimanPelangganSelesai($id, $data);

        $this->session->set_flashdata('alert', 'Pesanan Telah Selesai');
        redirect('home/riwayat');
    }
}