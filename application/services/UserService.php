<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserService {
    
    protected $CI;
    protected $user_repository;
    
    public function __construct() {
        $this->CI =& get_instance();
        
        // Load dependencies
        $this->CI->load->library('session');
        $this->CI->load->helper('url');
        
        // Load repository
        require_once APPPATH . 'repositories/UserRepository.php';
        $this->user_repository = new UserRepository();
    }
    
    public function authenticate($email, $password) {
        $user = $this->user_repository->get_by_email($email);
        
        if ($user && password_verify($password, $user->password)) {
            // Set session data
            $this->CI->session->set_userdata([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'is_logged_in' => TRUE
            ]);
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function logout() {
        $this->CI->session->unset_userdata('user_id');
        $this->CI->session->unset_userdata('user_name');
        $this->CI->session->unset_userdata('is_logged_in');
        return TRUE;
    }
    
    public function register_initial($name, $email, $phone) {
        // Check if email is unique
        if (!$this->user_repository->check_unique_email($email)) {
            return [
                'success' => FALSE,
                'message' => 'Error: This email is already registered'
            ];
        }
        
        // Generate secure token
        $token = bin2hex(random_bytes(16));
        
        // Create user record
        $user_data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'temp_token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $user_id = $this->user_repository->create($user_data);
        
        if ($user_id) {
            return [
                'success' => TRUE,
                'user_id' => $user_id,
                'token' => $token
            ];
        }
        
        return [
            'success' => FALSE,
            'message' => 'Error creating user account'
        ];
    }
    
    public function complete_registration($token, $password) {
        // Get user by token
        $user = $this->user_repository->get_by_token($token);
        
        if (!$user) {
            return [
                'success' => FALSE,
                'message' => 'Invalid or expired registration token'
            ];
        }
        
        // Update user with password and clear token
        $user_data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'temp_token' => NULL,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->user_repository->update($user->id, $user_data)) {
            return [
                'success' => TRUE,
                'user_id' => $user->id
            ];
        }
        
        return [
            'success' => FALSE,
            'message' => 'Error completing registration'
        ];
    }
    
    public function get_user($id) {
        return $this->user_repository->get($id);
    }
    
    public function get_all_users() {
        return $this->user_repository->get_all();
    }
    
    public function get_user_by_token($token) {
        return $this->user_repository->get_by_token($token);
    }
    
    public function update_user($id, $data) {
        // If email is being updated, check it's unique
        if (isset($data['email'])) {
            $user = $this->user_repository->get($id);
            if ($user && $user->email != $data['email'] && !$this->user_repository->check_unique_email($data['email'], $id)) {
                return [
                    'success' => FALSE,
                    'message' => 'Error: This email is already registered'
                ];
            }
        }
        
        if ($this->user_repository->update($id, $data)) {
            return [
                'success' => TRUE
            ];
        }
        
        return [
            'success' => FALSE,
            'message' => 'Error updating user'
        ];
    }
    
    public function delete_user($id) {
        if ($this->user_repository->delete($id)) {
            return [
                'success' => TRUE
            ];
        }
        
        return [
            'success' => FALSE,
            'message' => 'Error deleting user'
        ];
    }
    
    public function reset_password($id, $password) {
        $user_data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->user_repository->update($id, $user_data)) {
            return [
                'success' => TRUE
            ];
        }
        
        return [
            'success' => FALSE,
            'message' => 'Error resetting password'
        ];
    }
}