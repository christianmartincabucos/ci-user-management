<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {
    
    public function render($data)
    {
        $this->load->view('common', $data);
    }
}