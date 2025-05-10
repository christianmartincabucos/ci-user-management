<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
    
    private $table = 'users';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table, 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table, 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_by_token($token) {
        $this->db->where('temp_token', $token);
        $query = $this->db->get($this->table, 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_all() {
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    public function check_unique_email($email, $exclude_id = NULL) {
        $this->db->where('email', $email);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get($this->table);
        return ($query->num_rows() == 0);
    }
}