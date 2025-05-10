<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends MX_Controller {
    
    var $data;
    protected $user_service;

    public function __construct()
    {
        parent::__construct();
        
        // Load helpers and libraries
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('form');
        
        $this->data['form_result'] = (object) array('form_name' => FALSE, 'form_success' => FALSE);
        
        // Load service
        require_once APPPATH . 'modules/users/services/UserService.php';
        $this->user_service = new UserService();
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access this page');
            redirect('log-in');
        }
        
        $this->data['meta_title'] = 'Members';
        $this->data['users'] = $this->user_service->get_all_users();
        $this->data['page_content'] = $this->load->view('index', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function register()
    {
        // If user is already logged in, redirect to members page
        if ($this->session->userdata('is_logged_in')) {
            redirect('members');
        }
        
        if ($this->input->post('ref')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array(
                'required' => 'Error: The Name field is required'
            ));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                'required' => 'Error: The Email field is required',
                'valid_email' => 'Error: Please enter a valid email address'
            ));
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            
            if ($this->form_validation->run()) {
                $result = $this->user_service->register_initial(
                    $this->input->post('name'),
                    $this->input->post('email'),
                    $this->input->post('phone')
                );
                
                if ($result['success']) {
                    $this->form_validation->clear_field_data();
                    redirect('create-password/' . $result['token']);
                } else {
                    $this->session->set_flashdata('error', $result['message']);
                }
            }
        }
        
        $this->data['meta_title'] = 'Register';
        $this->data['page_content'] = $this->load->view('register', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function create_password($token = NULL)
    {
        if (empty($token)) {
            $this->session->set_flashdata('error', 'Invalid registration token');
            redirect('register');
        }
        
        // Get user by token
        $temp_user = $this->user_service->get_user_by_token($token);
        
        if (!$temp_user) {
            $this->session->set_flashdata('error', 'Invalid or expired registration token');
            redirect('register');
        }
        
        $this->data['user_token'] = $token;
        
        if ($this->input->post('ref')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', array(
                'required' => 'Error: The Password field is required',
                'min_length' => 'Error: Password must be at least 6 characters long'
            ));
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]', array(
                'required' => 'Error: The Confirm Password field is required',
                'matches' => 'Error: Passwords do not match'
            ));
            
            if ($this->form_validation->run()) {
                $result = $this->user_service->complete_registration(
                    $token,
                    $this->input->post('password')
                );
                
                if ($result['success']) {
                    $this->session->set_flashdata('success', 'Your registration has been successful. Please log in with your email and password.');
                    redirect('log-in');
                } else {
                    $this->session->set_flashdata('error', $result['message']);
                }
            }
        }
        
        $this->data['meta_title'] = 'Create Password';
        $this->data['page_content'] = $this->load->view('create_password', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function login()
    {
        // If user is already logged in, redirect to members page
        if ($this->session->userdata('is_logged_in')) {
            redirect('members');
        }
        
        if ($this->input->post('ref')) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                'required' => 'Error: The Email field is required',
                'valid_email' => 'Error: Please enter a valid email address'
            ));
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array(
                'required' => 'Error: The Password field is required'
            ));
            
            if ($this->form_validation->run()) {
                if ($this->user_service->authenticate(
                    $this->input->post('email'),
                    $this->input->post('password')
                )) {
                    redirect('members');
                } else {
                    $this->session->set_flashdata('error', 'Invalid login credentials');
                }
            }
        }
        
        $this->data['meta_title'] = 'Login';
        $this->data['page_content'] = $this->load->view('login', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function edit($id = NULL)
    {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access this page');
            redirect('log-in');
        }
        
        // If no ID provided, use logged in user's ID
        if ($id === NULL) {
            $id = $this->session->userdata('user_id');
        }
        
        $this->data['user'] = $this->user_service->get_user($id);
        
        if (!$this->data['user']) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('members');
        }
        
        if ($this->input->post('ref')) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required', array(
                'required' => 'Error: The Name field is required'
            ));
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                'required' => 'Error: The Email field is required',
                'valid_email' => 'Error: Please enter a valid email address'
            ));
            $this->form_validation->set_rules('phone', 'Phone', 'trim');
            
            if ($this->form_validation->run()) {
                $user_data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                $result = $this->user_service->update_user($id, $user_data);
                
                if ($result['success']) {
                    $this->session->set_flashdata('success', 'Member successfully updated');
                    redirect('members');
                } else {
                    $this->session->set_flashdata('error', $result['message']);
                }
            }
        }
        
        $this->data['meta_title'] = 'Edit User';
        $this->data['page_content'] = $this->load->view('edit', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function reset_password($id)
    {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access this page');
            redirect('log-in');
        }
        
        $user = $this->user_service->get_user($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User not found');
            redirect('members');
        }
        
        if ($this->input->post('ref')) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]', array(
                'required' => 'Error: The Password field is required',
                'min_length' => 'Error: Password must be at least 6 characters long'
            ));
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]', array(
                'required' => 'Error: The Confirm Password field is required',
                'matches' => 'Error: Passwords do not match'
            ));
            
            if ($this->form_validation->run()) {
                $result = $this->user_service->reset_password(
                    $id,
                    $this->input->post('password')
                );
                
                if ($result['success']) {
                    $this->session->set_flashdata('success', 'Password successfully reset');
                    redirect('members');
                } else {
                    $this->session->set_flashdata('error', $result['message']);
                }
            }
        }
        
        $this->data['user'] = $user;
        $this->data['meta_title'] = 'Reset Password';
        $this->data['page_content'] = $this->load->view('reset_password', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function delete($id)
    {
        // Check if user is logged in
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access this page');
            redirect('log-in');
        }
        
        // Don't allow users to delete themselves
        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'You cannot delete your own account');
            redirect('members');
        }
        
        $result = $this->user_service->delete_user($id);
        
        if ($result['success']) {
            $this->session->set_flashdata('success', 'Member successfully deleted');
        } else {
            $this->session->set_flashdata('error', $result['message']);
        }
        
        redirect('members');
    }
    
    public function profile()
    {
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Please log in to access this page');
            redirect('log-in');
        }
        
        $user_id = $this->session->userdata('user_id');
        $this->data['user'] = $this->user_service->get_user($user_id);
        
        $this->data['meta_title'] = 'Profile';
        $this->data['page_content'] = $this->load->view('profile', $this->data, TRUE);
        $this->load->view('template/common', $this->data);
    }
    
    public function logout()
    {
        $this->user_service->logout();
        $this->session->set_flashdata('success', 'You have successfully logged out');
        redirect('log-in');
    }
}