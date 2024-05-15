<?php 
defined('BASEPATH') or exit('No direct script access allowed');

include 'application/security/encryption/AES128Encryption.php';
include 'application/security/hashing/SHA3KECCAK.php';
include 'application/security/integrity/IntegrityChecking.php';

class Pelanggan extends CI_Controller
{
    private $aes;
    private $sha;
    private $integrityCheck;

    public function __construct() {
        parent::__construct();

        $this->aes = new AES128Encryption("AdrianBadjideh11");
        $this->sha = new SHA3KECCAK();
        $this->integrityCheck = new IntegrityChecking();
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
        $cipherlatpengirim = $this->aes->encrypt($lat_pengirim);
        $cipherlangpengirim = $this->aes->encrypt($lang_pengirim);
        $cipherlatpenerima = $this->aes->encrypt($lat_penerima);
        $cipherlangpenerima =  $this->aes->encrypt($lang_penerima);
    
        // Hash latitude and longitude values
        $hashCoordinate = [
            'hash_lat_pengirim' => $this->sha::hash($cipherlatpengirim, 256, false),
            'hash_lang_pengirim' => $this->sha::hash($cipherlangpengirim, 256, false),
            'hash_lat_penerima' => $this->sha::hash($cipherlatpenerima, 256, false),
            'hash_lang_penerima' => $this->sha::hash($cipherlangpenerima, 256, false),
        ];
    
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
    
        // Retrieve the idpengiriman of the newly inserted pengiriman
        $idpengiriman = $this->db->insert_id();
    
        // Add idpengiriman to hashCoordinate array
        $hashCoordinate['idpengiriman'] = $idpengiriman;
    
        // Insert hash values into hashcoordinate table
        $this->db->insert('hashcoordinate', $hashCoordinate);
    
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

        $hashtable = $this->db->where('idpengiriman', $trackingPengiriman['idpengiriman'])->get('hashcoordinate')->row_array();

        if($this->integrityCheck->hashChecking($trackingPengiriman['lat'], $hashtable['hash_lat']) && $this->integrityCheck->hashChecking($trackingPengiriman['lang'], $hashtable['hash_lang']) && $this->integrityCheck->hashChecking($trackingPengiriman['lat_pengirim'], $hashtable['hash_lat_pengirim']) && $this->integrityCheck->hashChecking($trackingPengiriman['lang_pengirim'], $hashtable['hash_lang_pengirim']) && $this->integrityCheck->hashChecking($trackingPengiriman['lat_penerima'], $hashtable['hash_lat_penerima']) && $this->integrityCheck->hashChecking($trackingPengiriman['lang_penerima'], $hashtable['hash_lang_penerima'])) {
            $lat = $this->aes->decrypt($trackingPengiriman['lat']);
            $lang = $this->aes->decrypt($trackingPengiriman['lang']);
            $lat_pengirim = $this->aes->decrypt($trackingPengiriman['lat_pengirim']);
            $lang_pengirim = $this->aes->decrypt($trackingPengiriman['lang_pengirim']);
            $lat_penerima = $this->aes->decrypt($trackingPengiriman['lat_penerima']);
            $lang_penerima = $this->aes->decrypt($trackingPengiriman['lang_penerima']);
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
            'password'      => $password,
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