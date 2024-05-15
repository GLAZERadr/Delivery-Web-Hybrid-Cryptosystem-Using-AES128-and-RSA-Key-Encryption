<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengiriman extends CI_Model
{
    public function tampilSemuaPengiriman() {
        return $this->db->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
    }

    public function tampilPengiriman($id) {
        return $this->db->where('idpengiriman', $id)->get('pengiriman')->row_array();
    } 

    public function updateKoordinatLokasi($id, $data, $hashCoordinate) {
        $this->db->trans_start(); // Start transaction
        
        // Update coordinates in the pengiriman table
        $this->db->where('idpengiriman', $id)->update('pengiriman', $data);
    
        // Insert or update coordinates in the hashcoordinate table
        $this->db->where('idpengiriman', $id)->from('hashcoordinate');
        $count = $this->db->count_all_results();
    
        if ($count > 0) {
            // If entry exists, update it
            $this->db->where('idpengiriman', $id)->update('hashcoordinate', $hashCoordinate);
        } else {
            // If entry does not exist, insert it
            $this->db->insert('hashcoordinate', $hashCoordinate);
        }
    
        $this->db->trans_complete(); // Complete transaction
    
        return $this->db->trans_status(); // Return transaction status
    }
    
    public function updateStatus($id, $data) {
        $this->db->where('idpengiriman', $id)->update('pengiriman', $data);
    }

    public function rutePengiriman($kodePengiriman) {
        return $this->db->where('kodepengiriman', $kodePengiriman)->get('pengiriman')->row_array();
    }

    public function statusPengirimanBukanSelesai() {
        return $this->db->where_not_in('status', 'Selesai')->order_by('idpengiriman', 'desc')->join('kurir','kurir.idkurir = pengiriman.idkurir','LEFT')->get('pengiriman')->result_array();
    }

    public function tambahPengiriman($data) {
        $this->db->insert('pengiriman', $data);
    }

    public function pengirimanPelanggan($idPelanggan) {
        return $this->db->where('idpelanggan', $idPelanggan)->order_by('idpengiriman', 'desc')->get('pengiriman')->result_array();
    }

    public function trackingPengiriman($kodePengiriman) {
        return $this->db->where('kodepengiriman', $kodePengiriman)->get('pengiriman')->row_array();
    }

    public function konfirmasiPengirimanPelangganSelesai($id, $data) {
        $this->db->where('idpengiriman', $id)->update('pengiriman', $data);
    }
}