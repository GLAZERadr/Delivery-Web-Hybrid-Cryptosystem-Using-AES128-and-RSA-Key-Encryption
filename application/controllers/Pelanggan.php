<?php 
defined('BASEPATH') or exit('No direct script access allowed');

include 'application/security/HybridCryptosystem.php';

class Pelanggan extends CI_Controller
{
    private $hybridCrypto;

    public function __construct() {
        parent::__construct();

        $this->hybridCrypto = new HybridCryptosystem('application/security/encryption/public_key.pem', 'application/security/encryption/private_key.pem');
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
        $lat_pengirim = $this->input->post('lat_pengirim'); //encrypt and hashing
        $lang_pengirim = $this->input->post('lang_pengirim'); //encrypt and hashing
        $lat_penerima = $this->input->post('lat_penerima'); //encrypt and hashing
        $lang_penerima = $this->input->post('lang_penerima'); //encrypt and hashing
        $waktupickup = $this->input->post('waktupickup');
        $biaya = $this->input->post('biaya');
        $kodepengiriman = "DLV" . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
    
        // Encrypt latitude and longitude values
        $cipherlatpengirim = $this->hybridCrypto->encryptData($lat_pengirim);
        $cipherlangpengirim = $this->hybridCrypto->encryptData($lang_pengirim);
        $cipherlatpenerima = $this->hybridCrypto->encryptData($lat_penerima);
        $cipherlangpenerima =  $this->hybridCrypto->encryptData($lang_penerima);
    
        // Prepare data for pengiriman table
        $data_pengiriman = [
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
            'lat_pengirim'      =>  $cipherlatpengirim,
            'lang_pengirim'     =>  $cipherlangpengirim,
            'lat_penerima'      =>  $cipherlatpenerima,
            'lang_penerima'     =>  $cipherlangpenerima,
            'waktupickup'       =>  $waktupickup,
            'biaya'             =>  $biaya,
            'status'            =>  'Menunggu Konfirmasi Admin',
            'tanggal'           =>  date('Y-m-d'),
        ];
    
        // Insert data into pengiriman table
        $this->m_pengiriman->tambahPengiriman($data_pengiriman);
    
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

        if(!empty($trackingPengiriman['lat']) && !empty($trackingPengiriman['lang']) && !empty($trackingPengiriman['lat_pengirim']) && !empty($trackingPengiriman['lat_pengirim']) && !empty($trackingPengiriman['lang_pengirim']) && !empty($trackingPengiriman['lat_penerima']) && !empty($trackingPengiriman['lang_penerima'])) {
            try {
                $lat = $this->hybridCrypto->decryptData($trackingPengiriman['lat']);
                $lang = $this->hybridCrypto->decryptData($trackingPengiriman['lang']);
                $lat_pengirim = $this->hybridCrypto->decryptData($trackingPengiriman['lat_pengirim']);
                $lang_pengirim = $this->hybridCrypto->decryptData($trackingPengiriman['lang_pengirim']);
                $lat_penerima = $this->hybridCrypto->decryptData($trackingPengiriman['lat_penerima']);
                $lang_penerima = $this->hybridCrypto->decryptData($trackingPengiriman['lang_penerima']);
            } catch (Exception $e) {
                $lat = 'Decryption Error';
                $lang = 'Decryption Error';
                $lat_pengirim = 'Decryption Error';
                $lang_pengirim = 'Decryption Error';
                $lat_penerima = 'Decryption Error';
                $lang_penerima = 'Decryption Error';
            }
        } else {
            $lat = '0';
            $lang = '0';
            $lat_pengirim = '0';
            $lang_pengirim = '0';
            $lat_penerima = '0';
            $lang_penerima = '0'; 
        }


        $trackingPengiriman['lat'] = $lat;
        $trackingPengiriman['lang'] = $lang;
        $trackingPengiriman['lat_pengirim'] = $lat_pengirim;
        $trackingPengiriman['lang_pengirim'] = $lang_pengirim;
        $trackingPengiriman['lat_penerima'] = $lat_penerima;
        $trackingPengiriman['lang_penerima'] = $lang_penerima;

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
            'nohp'          => $nohp,
            'username'      => $username,
            'password'      => password_hash($password, PASSWORD_BCRYPT),
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