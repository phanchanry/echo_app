<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('comments_model');
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->pageType['pageType'] = 'comments';
    }
   public function index () {
       //$result = $this->comments_model->getQuestionByOrder($qIndex);
       //$this->data['questionInfo'] = $result;
       $this->front_render('pages/comments_view'); 
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
// 	/* add comment page loading */
// 	public function add_comment () {
// 	    $this->front_render('pages/add_comments_view');
// 	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */