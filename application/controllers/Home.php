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
            redirect('home/login');
        }
        $this->load->view('home/layout/header');
        $this->load->view('home/index');
        $this->load->view('home/layout/footer');
    }

    public function login()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/login');
        $this->load->view('home/layout/footer');
    }

    public function logincek()
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
            redirect('home/login');
        }
    }

    public function loginadmin()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/loginadmin');
        $this->load->view('home/layout/footer');
    }

    public function logincekadmin()
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
            redirect('home/login');
        }
    }

    public function loginkurir()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/loginkurir');
        $this->load->view('home/layout/footer');
    }

    public function logincekkurir()
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
            redirect('home/login');
        }
    }

    public function daftar()
    {
        $this->load->view('home/layout/header');
        $this->load->view('home/daftar');
        $this->load->view('home/layout/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('alert', 'Anda Telah Logout');

        redirect('home');
    }

    public function daftarsimpan()
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

            redirect('home/daftar');
        } else {
            $data = [
                'namapelanggan' => $nama,
                'username' => $username,
                'password' => $password,
                'nohp' => $nohp,
            ];

            $this->m_pelanggan->tambahPelanggan($data);

            $this->session->set_flashdata('alert', 'Pendaftaran Berhasil');

            redirect('home/login');
        }
    }

    public function pengiriman()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
        }

        $this->load->view('home/layout/header');
        $this->load->view('home/pengiriman');
        $this->load->view('home/layout/footer');
    }

    public function pengirimanrekap()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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

    public function pengirimansubmit()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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

    public function riwayat()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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

    public function inputtracking()
    {
        $kodepengiriman = $this->input->post('kodepengiriman');
        redirect('home/tracking/' . $kodepengiriman);
    }

    public function tracking($kodePengiriman)
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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

    public function profil()
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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

    public function profiledit($id)
    {
        if (!$this->session->userdata('pengguna')) {
            redirect('home/login');
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
            redirect('home/login');
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
