<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'application/security/encryption/AES128Encryption.php';
include 'application/security/hashing/SHA3KECCAK.php';
include 'application/security/integrity/IntegrityChecking.php';

class Kurir extends CI_Controller
{
    private $aes;
    private $sha;
    private $integrityCheck;

    public function __construct()
    {
        parent::__construct();

        $this->aes = new AES128Encryption("AdrianBadjideh11");
        $this->sha = new SHA3KECCAK();
        $this->integrityCheck = new IntegrityChecking();
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
            //integrity check
            $hashtable = $this->db->where('idpengiriman', $data['idpengiriman'])->get('hashcoordinate')->row_array();
    
            if(isset($data['lat']) && isset($data['lang'])) {
                if($this->integrityCheck->hashChecking($data['lat'], $hashtable['hash_lat']) && $this->integrityCheck->hashChecking($data['lang'], $hashtable['hash_lang'])) {
                    $latplaintext = $this->aes->decrypt($data['lat']);
                    $langplaintext = $this->aes->decrypt($data['lang']);
                } else {
                    $latplaintext = '0';
                    $langplaintext = '0';
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
            //integrity check
            $hashtable = $this->db->where('idpengiriman', $data['idpengiriman'])->get('hashcoordinate')->row_array();

            if(isset($data['lat']) && isset($data['lang'])) {
                if($this->integrityCheck->hashChecking($data['lat'], $hashtable['hash_lat']) && $this->integrityCheck->hashChecking($data['lang'], $hashtable['hash_lang'])) {
                    $latplaintext = $this->aes->decrypt($data['lat']);
                    $langplaintext = $this->aes->decrypt($data['lang']);
                } else {
                    $latplaintext = '0';
                    $langplaintext = '0';
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
                'lat'           => $this->aes->decrypt($data['lat']),
                'lang'          => $this->aes->decrypt($data['lang']),
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
        $cipherlat = $this->aes->encrypt($lat);
        $cipherlang = $this->aes->encrypt($lang);
    
        // Prepare data for updating pengiriman table
        $data = array(
            'lat' => $cipherlat,
            'lang' => $cipherlang,
            'keterangan' => 'Lokasi kurir diperbarui pada ' . date('Y-m-d H:i:s'),
        );
    
        // Prepare data for inserting/updating hashcoordinate table
        $hashCoordinate = array(
            'idpengiriman' => $id,
            'hash_lat' => $this->sha::hash($cipherlat, 256, false),
            'hash_lang' => $this->sha::hash($cipherlang, 256, false),
        );
    
        // Update coordinates in pengiriman table and insert/update hashcoordinate table
        $this->m_pengiriman->updateKoordinatLokasi($id, $data, $hashCoordinate);
    
        // Set flash message and redirect
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

        $hashtable = $this->db->where('idpengiriman', $pengiriman['idpengiriman'])->get('hashcoordinate')->row_array();

        if($this->integrityCheck->hashChecking($pengiriman['lat'], $hashtable['hash_lat']) && $this->integrityCheck->hashChecking($pengiriman['lang'], $hashtable['hash_lang']) && $this->integrityCheck->hashChecking($pengiriman['lat_pengirim'], $hashtable['hash_lat_pengirim']) && $this->integrityCheck->hashChecking($pengiriman['lang_pengirim'], $hashtable['hash_lang_pengirim']) && $this->integrityCheck->hashChecking($pengiriman['lat_penerima'], $hashtable['hash_lat_penerima']) && $this->integrityCheck->hashChecking($pengiriman['lang_penerima'], $hashtable['hash_lang_penerima'])) {
            $lat = $this->aes->decrypt($pengiriman['lat']);
            $lang = $this->aes->decrypt($pengiriman['lang']);
            $lat_pengirim = $this->aes->decrypt($pengiriman['lat_pengirim']);
            $lang_pengirim = $this->aes->decrypt($pengiriman['lang_pengirim']);
            $lat_penerima = $this->aes->decrypt($pengiriman['lat_penerima']);
            $lang_penerima = $this->aes->decrypt($pengiriman['lang_penerima']);
        } else {
            $lat = '0';
            $lang = '0';
            $lat_pengirim = '0';
            $lang_pengirim = '0';
            $lat_penerima = '0';
            $lang_penerima = '0';
        }

        // echo "lat: "; print_r($lat); echo "<br>"; // Debug line
        // echo "lang: "; print_r($lang); echo "<br>"; // Debug line
        // echo "lat pengirim: "; print_r($lat_pengirim); echo "<br>"; // Debug line
        // echo "lang_pengirim: "; print_r($lang_pengirim); echo "<br>"; // Debug line
        // echo "lat penerima: "; print_r($lat_penerima); echo "<br>"; // Debug line
        // echo "lang_penerima: "; print_r($lang_penerima); echo "<br>"; // Debug line

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
