<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model 
{
    public function __construct() {
        parent::__construct();
    }

    public function tampilSemuaAdmin() {
        return $this->db->order_by('idadmin', 'desc')->get('admin')->result_array();
    }

    public function tambahAdmin($data) {
        $this->db->insert('admin', $data);
    }

    public function tampilAdmin($id) {
        return $this->db->where('idadmin', $id)->get('admin')->row_array();
    }

    public function updateAdmin($id, $data) {
        $this->db->where('idadmin', $id)->update('admin', $data);
    }

    public function hapusAdmin($id) {
        $this->db->where('idadmin ', $id)->delete('admin');
    }

    public function tambahPengirimanKurir($id, $data) {
        return $this->db->where('idpengiriman', $id)->update('pengiriman', $data);
    }
}