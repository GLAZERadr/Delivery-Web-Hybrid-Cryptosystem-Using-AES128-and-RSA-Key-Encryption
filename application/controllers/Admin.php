<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('m_kurir');
        $this->load->model('m_pengiriman');

        $kurir =  $this->m_kurir->tampilSemuaKurir();
        $pengiriman =  $this->m_pengiriman->statusPengirimanBukanSelesai();
        
        $data = [
            'pengiriman' => $pengiriman,
            'kurir'=> $kurir,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('alert', 'Anda Telah Logout');

        redirect('home');
    }
 
    public function admindaftar()
    {
        $this->load->model('m_admin');
        $admin =  $this->m_admin->tampilSemuaAdmin();
        $data = [
            'admin' => $admin,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/admindaftar', $data);
        $this->load->view('admin/layout/footer');
    }

    public function admintambah()
    {   
        $this->load->model('m_admin');
        $admin =  $this->m_admin->tampilSemuaAdmin();
        $data = [
            'admin' => $admin,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/admintambah', $data);
        $this->load->view('admin/layout/footer');
    }

    public function admintambahsimpan()
    {
        $this->load->model('m_admin');
        $namaadmin = ucwords($this->input->post('namaadmin'));
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array(
            'namaadmin' =>    $namaadmin,
            'username'  =>    $username,
            'password'  =>    password_hash($password, PASSWORD_BCRYPT),
        );
        $this->m_admin->tambahAdmin($data);
        $this->session->set_flashdata('flash', 'Data berhasil ditambahkan');
        redirect('admin/admindaftar');
    }

    public function adminedit($id)
    {
        $this->load->model('m_admin');
        $admin =  $this->m_admin->tampilAdmin($id);
        $data = [
            'admin' => $admin,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/adminedit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function admineditsimpan($id)
    {
        $this->load->model('m_admin');
        $namaadmin = ucwords($this->input->post('namaadmin'));
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($password == '') {
            $password = $this->input->post('passwordlama');
        }

        $data = array(
            'namaadmin' => $namaadmin,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
        );

        $this->m_admin->updateAdmin($id, $data);

        $this->session->set_flashdata('flash', 'Data berhasil diupdate');
        redirect('admin/admindaftar');
    }

    public function adminhapus($id)
    {
        $this->load->model('m_admin');
        $delete = $this->m_admin->hapusAdmin($id);
        $this->session->set_flashdata('flash', 'Data berhasil dihapus');
        redirect('admin/admindaftar');
    }

    public function kurirdaftar()
    {
        $this->load->model('m_kurir');
        $kurir =  $this->m_kurir->tampilSemuaKurir();
        $data = [
            'kurir' => $kurir,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/kurirdaftar', $data);
        $this->load->view('admin/layout/footer');
    }

    public function kurirtambah()
    {
        $this->load->model('m_kurir');
        $kurir =  $this->m_kurir->tampilSemuaKurir();
        $data = [
            'kurir' => $kurir,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/kurirtambah', $data);
        $this->load->view('admin/layout/footer');
    }
    
    public function kurirtambahsimpan()
    {
        $this->load->model('m_kurir');
        $namakurir = ucwords($this->input->post('namakurir'));
        $nohp = $this->input->post('nohp');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array(
            'namakurir' =>    $namakurir,
            'nohp'      =>    $nohp,
            'username'  =>    $username,
            'password'  =>    password_hash($password, PASSWORD_BCRYPT),
        );
        $this->m_kurir->tambahkanKurir($data);
        $this->session->set_flashdata('flash', 'Data berhasil ditambahkan');
        redirect('admin/kurirdaftar');
    }

    public function kuriredit($id)
    {
        $this->load->model('m_kurir');
        $kurir =  $this->m_kurir->tampilKurir($id);
        $data = [
            'kurir' => $kurir,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/kuriredit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function kurireditsimpan($id)
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
        redirect('admin/kurirdaftar');
    }

    public function kurirhapus($id)
    {
        $this->load->model('m_kurir');
        $delete = $this->m_kurir->hapusKurir($id);
        $this->session->set_flashdata('flash', 'Data berhasil dihapus');
        redirect('admin/kurirdaftar');
    }

    public function pelanggandaftar()
    {
        $pelanggan =  $this->db->order_by('idpelanggan', 'desc')->get('pelanggan')->result_array();
        $data = [
            'pelanggan' => $pelanggan,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/pelanggandaftar', $data);
        $this->load->view('admin/layout/footer');
    }

    public function pengirimandaftar()
    {
        $pengiriman =  $this->db->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/pengirimandaftar', $data);
        $this->load->view('admin/layout/footer');
    }

    public function pengirimankurir($id)
    {
        $pengiriman =  $this->db->where('idpengiriman', $id)->get('pengiriman')->row_array();

        $kurir =  $this->db->order_by('idkurir', 'desc')->get('kurir')->result_array();
        $data = [
            'kurir' => $kurir,
            'pengiriman' => $pengiriman,

        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/pengirimankurir', $data);
        $this->load->view('admin/layout/footer');
    }

    public function pengirimankurirsimpan($id)
    {
        $idkurir = ($this->input->post('idkurir'));
        $biaya = $this->input->post('biaya');
        $status = $this->input->post('status');


        $data = array(
            'idkurir' => $idkurir,
            'biaya' => $biaya,
            'status' => $status,
        );

        $this->db->where('idpengiriman', $id)->update('pengiriman', $data);

        $this->session->set_flashdata('flash', 'Data berhasil diupdate');
        redirect('admin/pengirimandaftar');
    }

    public function laporandaftar()
    {
        $pengiriman =  $this->db->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
        $data = [
            'pengiriman' => $pengiriman,
        ];

        $this->load->view('admin/layout/header');
        $this->load->view('admin/laporandaftar', $data);
        $this->load->view('admin/layout/footer');
    }
}
