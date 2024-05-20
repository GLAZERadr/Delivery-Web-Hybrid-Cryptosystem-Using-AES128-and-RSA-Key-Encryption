<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'application/security/HybridCryptosystem.php';

class Kurir extends CI_Controller
{
    private $hybridCrypto;

    public function __construct()
    {
        parent::__construct();

        $this->hybridCrypto = new HybridCryptosystem('application/security/encryption/public_key.pem', 'application/security/encryption/private_key.pem');
    }

    public function index()
    {
        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/index');
        $this->load->view('kurir/layout/footer');
    }

    public function pengirimandaftar()
    {
        $this->load->model('m_kurir');
    
        $idkurir = $this->session->userdata("kurir")["idkurir"];
        $rawpengiriman =  $this->m_kurir->daftarPengiriman($idkurir);   
    
        $pengiriman = [];
    
        foreach($rawpengiriman as $data) {

            if(!empty($data['lat']) && !empty($data['lang'])) {
                try {
                    $latplaintext = $this->hybridCrypto->decryptData($data['lat']);
                    $langplaintext = $this->hybridCrypto->decryptData($data['lang']);
                } catch (Exception $e) {
                    $latplaintext = 'Decryption Error';
                    $langplaintext = 'Decryption Error';
                }
            } else {
                $latplaintext = '0';
                $langplaintext = '0';
            }

            $decryptedrow = [
                'idpengiriman'  => $data['idpengiriman'],
                'kodepengiriman'=> $data['kodepengiriman'],
                'namapengirim'  => $data['namapengirim'],
                'nohppengirim'  => $data['nohppengirim'],
                'namapenerima'  => $data['namapenerima'],
                'alamatpenerima'=> $data['alamatpenerima'],
                'nohppenerima'  => $data['nohppenerima'],
                'jenisbarang'   => $data['jenisbarang'],
                'lat'           => $latplaintext,
                'lang'          => $langplaintext,
                'keterangan'    => $data['keterangan'],
            ];
        
            $pengiriman[] = $decryptedrow;
        }
    
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
        $rawpengiriman =  $this->m_kurir->historyPengiriman($idkurir);   

        $pengiriman = [];

        foreach($rawpengiriman as $data) {

            if(!empty($data['lat']) && !empty($data['lang'])) {
                try {
                    $latplaintext = $this->hybridCrypto->decryptData($data['lat']);
                    $langplaintext = $this->hybridCrypto->decryptData($data['lang']);
                } catch (Exception $e) {
                    $latplaintext = 'Decryption Error';
                    $langplaintext = 'Decryption Error';
                }
            } else {
                $latplaintext = '0';
                $langplaintext = '0';
            }

            $decryptedrow = [
                'idpengiriman'  => $data['idpengiriman'],
                'kodepengiriman'=> $data['kodepengiriman'],
                'namapengirim'  => $data['namapengirim'],
                'nohppengirim'  => $data['nohppengirim'],
                'namapenerima'  => $data['namapenerima'],
                'alamatpenerima'=> $data['alamatpenerima'],
                'nohppenerima'  => $data['nohppenerima'],
                'jenisbarang'   => $data['jenisbarang'],
                'lat'           => $latplaintext,
                'lang'          => $langplaintext,
                'status'        => $data['status'],
            ];

            $pengiriman[] = $decryptedrow;
        }

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
    
        // Retrieve latitude and longitude from POST data
        $lat = $this->input->post('lat');
        $lang = $this->input->post('lng');
    
        // Encrypt latitude and longitude
        $cipherlat = $this->hybridCrypto->encryptData($lat);
        $cipherlang = $this->hybridCrypto->encryptData($lang);
    
        // Prepare data for updating pengiriman table
        $data = array(
            'lat' => $cipherlat,
            'lang' => $cipherlang,
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
        $kurir =  $this->m_kurir->tampilKurir($idkurir);

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
            'password' => password_hash($password, PASSWORD_BCRYPT),
        );

        $this->m_kurir->updateKurir($id, $data);

        $this->session->set_flashdata('flash', 'Data berhasil diupdate');
        redirect('kurir/profil');
    }

    public function rutepengiriman($kodepengiriman)
    {
        $this->load->model('m_pengiriman');
        
        $pengiriman =  $this->m_pengiriman->rutePengiriman($kodepengiriman);

        if(!empty($pengiriman['lat']) && !empty($pengiriman['lang']) && !empty($pengiriman['lat_pengirim']) && !empty($pengiriman['lat_pengirim']) && !empty($pengiriman['lang_pengirim']) && !empty($pengiriman['lat_penerima']) && !empty($pengiriman['lang_penerima'])) {
            try {
                $lat = $this->hybridCrypto->decryptData($pengiriman['lat']);
                $lang = $this->hybridCrypto->decryptData($pengiriman['lang']);
                $lat_pengirim = $this->hybridCrypto->decryptData($pengiriman['lat_pengirim']);
                $lang_pengirim = $this->hybridCrypto->decryptData($pengiriman['lang_pengirim']);
                $lat_penerima = $this->hybridCrypto->decryptData($pengiriman['lat_penerima']);
                $lang_penerima = $this->hybridCrypto->decryptData($pengiriman['lang_penerima']);   
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

        $pengiriman['lat'] = $lat;
        $pengiriman['lang'] = $lang;
        $pengiriman['lat_pengirim'] = $lat_pengirim;
        $pengiriman['lang_pengirim'] = $lang_pengirim;
        $pengiriman['lat_penerima'] = $lat_penerima;
        $pengiriman['lang_penerima'] = $lang_penerima;

        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('kurir/layout/header');
        $this->load->view('kurir/rutepengiriman', $data);
        $this->load->view('kurir/layout/footer');
    }
}
