<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = Array(); //protected variables goes here its declaration
    protected $pageType = Array();
    function __construct() {

        parent::__construct();
        $this->output->enable_profiler(FALSE); // I keep this here so I dont have to manualy edit each controller to see profiler or not        
        //load helpers and everything here like form_helper etc
        $this->load->helper('url');
    }

    private function _privateOne() {

    }

    protected function front_render($view_file) {
        $this->load->view('includes/header_view', $this->pageType);
        $this->load->view('includes/global_var_js_view');
        $this->load->view($view_file, $this->data);
        $this->load->view('includes/footer_view');
    }
    
    protected function admin_render($view_file) {
        $this->load->view('includes/admin_header_view', $this->pageType);
        $this->load->view('includes/global_var_js_view');
        $this->load->view($view_file, $this->data);
//         $this->load->view('includes/admin_footer_view');
    }
    
    /* upload image */
    protected function Upload_Image($path, $frontPath, $fileName) {
    
        $imageSize = 5000;
    
        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
    
        $name = $_FILES[$fileName]['name'];
        $size = $_FILES[$fileName]['size'];
        if(strlen($name))
        {
            list($txt, $ext) = explode(".", $name);
            if(in_array($ext,$valid_formats))
            {
                if( $size<( $imageSize * $imageSize ) ) // Image size max 1 MB
                {
                    $actual_image_name =  random_string('alnum', 7)."_".time().".".$ext;
                    $tmp = $_FILES[$fileName]['tmp_name'];
                    if(move_uploaded_file($tmp, $path.$actual_image_name)) {
                        $data['result'] = 'success';
                        $data['image'] = "<img src='".$frontPath.$actual_image_name."'>";
    
                    } else
                        $data['result'] =  "failed";
                }
                else
                    $data['result'] = "max_exceed";
            }
            else
                $data['result'] = "not_allowed";
        }
        else
            $data['result'] = "Please select image..!";
        return $data;
         
    }
}