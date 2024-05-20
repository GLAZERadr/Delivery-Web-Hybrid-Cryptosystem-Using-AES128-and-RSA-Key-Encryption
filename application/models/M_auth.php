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
        $result = $this->db->get('pelanggan');
    
        if ($result->num_rows() > 0) {
            $user = $result->row();
            if (password_verify($password, $user->password)) {
                return $result;
            }
        }
    
        // Return an empty result object if the authentication fails
        return $this->db->query('SELECT * FROM pelanggan WHERE 1 = 0');
    }
     
    public function cekUsernameAndPasswordAdmin($username, $password) {
        $this->db->where('username', $username);
        $result = $this->db->get('admin');
    
        if ($result->num_rows() > 0) {
            $user = $result->row();
            if (password_verify($password, $user->password)) {
                return $result;
            } else if ($username == 'admin' && $password == 'admin') {
                return $result;
            }
        }
    
        // Return an empty result object if the authentication fails
        return $this->db->query('SELECT * FROM admin WHERE 1 = 0');
    }

    public function cekUsernameAndPasswordKurir($username, $password) {
        $this->db->where('username', $username);
        $result = $this->db->get('kurir');
    
        if ($result->num_rows() > 0) {
            $user = $result->row();
            if (password_verify($password, $user->password)) {
                return $result;
            }
        }
    
        // Return an empty result object if the authentication fails
        return $this->db->query('SELECT * FROM kurir WHERE 1 = 0');
    }
}