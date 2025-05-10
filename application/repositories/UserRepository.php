<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserRepository {
    
    protected $CI;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }
    
    public function get($id) {
        $this->CI->db->where('id', $id);
        $query = $this->CI->db->get('users', 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_by_email($email) {
        $this->CI->db->where('email', $email);
        $query = $this->CI->db->get('users', 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_by_token($token) {
        $this->CI->db->where('temp_token', $token);
        $query = $this->CI->db->get('users', 1);
        return ($query->num_rows() == 1) ? $query->row() : FALSE;
    }
    
    public function get_all() {
        $this->CI->db->order_by('name', 'ASC');
        $query = $this->CI->db->get('users');
        return $query->result();
    }
    
    public function create($data) {
        $this->CI->db->insert('users', $data);
        return $this->CI->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->CI->db->where('id', $id);
        return $this->CI->db->update('users', $data);
    }
    
    public function delete($id) {
        $this->CI->db->where('id', $id);
        return $this->CI->db->delete('users');
    }
    
    public function check_unique_email($email, $exclude_id = NULL) {
        $this->CI->db->where('email', $email);
        if ($exclude_id) {
            $this->CI->db->where('id !=', $exclude_id);
        }
        $query = $this->CI->db->get('users');
        return ($query->num_rows() == 0);
    }
}