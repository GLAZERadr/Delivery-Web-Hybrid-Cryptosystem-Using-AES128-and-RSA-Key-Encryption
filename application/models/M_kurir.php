<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kurir extends CI_Model
{
    public function tampilSemuaKurir() {
        return $this->db->order_by('idkurir', 'desc')->get('kurir')->result_array();
    }

    public function tambahkanKurir($data) {
        $this->db->insert('kurir', $data);
    }

    public function tampilKurir($id) {
        return $this->db->where('idkurir', $id)->get('kurir')->row_array();
    }

    public function updateKurir($id, $data) {
        $this->db->where('idkurir', $id)->update('kurir', $data);
    }

    public function hapusKurir($id) {
        $this->db->where('idkurir ', $id)->delete('kurir');
    }

    public function daftarPengiriman($idkurir) {
        return $this->db->where('idkurir', $idkurir)->where_not_in('status', 'Selesai')->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
    }

    public function historyPengiriman($idkurir) {
        return $this->db->where('idkurir', $idkurir)->where('status','Selesai')->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
    }
}