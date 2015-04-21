<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        if ($this->session->userdata('IS_ADMIN_LOGIN')) {
            redirect(base_url().'admin/home');
        }
    }
    /* index function(when page load)  */
    public function index() {
        $this->load->view('admin/admin_login_view'); 
    }
    
    public function loginSubmit () {
       
        $result = $this->user_model->checkAdminLogin();
        
        redirect(base_url().'admin/home');
    }
    
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */