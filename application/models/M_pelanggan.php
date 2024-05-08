<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function tampilSemuaPelanggan() {
        return $this->db->order_by('idpelanggan', 'desc')->get('pelanggan')->result_array();
    }

    public function tampilPelanggan($idPelanggan) {
        return $this->db->where('idpelanggan', $idPelanggan)->get('pelanggan')->row_array();
    }

    public function tambahPelanggan($data) {
        $this->db->insert('pelanggan', $data);
    }

    public function updatePelanggan($id, $data) {
        $this->db->where('idpelanggan', $id)->update('pelanggan', $data);
    }
}