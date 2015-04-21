<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('application_model');
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->pageType['pageType'] = 'home';
    }
    /* index function(when page load)  */
    public function index() {
        $this->data['applications'] = $this->application_model->getApplications();
        $this->front_render('pages/index_view'); 
    }
    
    public function logToFile ($filename, $msg) {
		// open file
		$fd = fopen($filename, "a");
		// append date/time to message
		$str = "[" . date("Y/m/d h:i:s", time()) . "] " . $msg;
		// write string
		fwrite($fd, $str . "\n");
		// close file
		fclose($fd);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */