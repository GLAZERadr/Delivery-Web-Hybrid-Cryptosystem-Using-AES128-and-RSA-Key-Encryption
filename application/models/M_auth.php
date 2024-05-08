<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function cekUsername($username) {
        return $this->db->get_where('pelanggan', array('username' => $username))->num_rows();
    }

    public function cekUsernameAndPasswordPelanggan($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        return $this->db->get('pelanggan');
    }

    public function cekUsernameAndPasswordAdmin($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        return $this->db->get('admin');
    }

    public function cekUsernameAndPasswordKurir($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        return $this->db->get('kurir');
    }
}