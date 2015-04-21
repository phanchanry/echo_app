<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
         if (!$this->session->userdata('IS_ADMIN_LOGIN')) {
            redirect(base_url().'admin/login');
        }
        $this->pageType['pageType'] = "home";
    }
    /* index function(when page load)  */
    public function index() {
        $result = $this->user_model->GetUserList();
        $this->data['userList'] = $result; 
        $this->admin_render('admin/user_management_view'); 
    }
    /* admin logout  */
    public function logout() {
        $this->user_model->adminLogout();
        redirect("/admin/home");
    }
    /*-------------------------------------------------------------------------------------------------  */
    
    
    /* add user form view  */
    public function add_user() {
        $this->admin_render('admin/add_user_view');
    }
    
    /* add user function (form submit)  */
    public function addUser () {
        $data = array();
        
        $userFirstName = $_POST['userFirstName'];
        $userLastName = $_POST['userLastName'];
        if (isset($_POST['userSuffix']) && $_POST['userSuffix'] != "") {
            $userSuffix = $_POST['userSuffix'];
        } else
            $userSuffix = "";
        $userEmail = $_POST['userEmail'];
        $userPassword = $_POST['userPassword'];
        if (isset($_POST['userType']) && $_POST['userType'] != "") {
            $userType = "Y";
        } else 
            $userType = "N";
        $result = $this->user_model->adminAddUser($userFirstName, $userLastName, $userSuffix, $userEmail, $userPassword, $userType);
        if ($result == "exist") {
            $data['result'] = $result;
        } else
            $data['result'] = "success";
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    /* admin edit user  */
    public function edit_user () {
        $id = $_GET['id'];
        $result = $this->user_model->adminGetUserWithId($id);
        $this->data['userInfo'] = $result;
        $this->admin_render('admin/edit_user_view');
    }
    
    public function editUser() {
        $userId = $_POST['userId'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $suffix = $_POST['suffix'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (isset($_POST['userType']) && $_POST['userType'] != "") {
            $userType = "Y";
        } else 
            $userType = "N";
        
        $result = $this->user_model->adminUpdateUser($userId, $firstname, $lastname, $suffix, $email, $password, $userType);
        $data['result'] = "success";
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    /* admin delete user */
    public function deleteUser() {
        $userIds = $_POST['strUserIds'];
        $result = $this->user_model->adminDeleteUser($userIds);
        
        if ($result == "success")
            $data['result'] = "success";
        else 
            $data['result'] = "failed";
        header('Content-Type: application/json');
        echo json_encode($data);
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */