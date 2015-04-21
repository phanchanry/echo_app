<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Application extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('application_model');
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->pageType['pageType'] = 'comments';
        $this->load->helper('get_reply');
    }
   public function index () {
       redirect(base_url());
   }
   /* view comment page loading */
   public function view_comments($temp = null) {
       $id = base64_decode($temp);
       $applicationName = $this->application_model->GetApplicationNameById($id);
       //$id = base64_decode($tempArray[1]);
       $this->data['applicationName'] = $applicationName;
       if ($id != "" && $id != null) {
           $result = $this->application_model->getComments($id);
       } else $result = -1;
       $feedbackIdArray = array();
       foreach ($result as $k => $v)
           $feedbackIdArray[$k] = $v->id;
       $this->data['repliesData'] = $this->application_model->GetReplies($feedbackIdArray);
       $this->data['comments'] = $result;
       $this->data['commentUrl'] = $temp;
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
	public function uploadScreenShot () {
	    if (!$this->session->userdata('IS_FRONT_LOGIN')) {
	        redirect(base_url().'user/login');
	    }
    	$path = $_SERVER['DOCUMENT_ROOT']."/assets/upload/screen_shot/";
    	$frontPath = base_url()."assets/upload/screen_shot/";
    	$result = $this->Upload_Image($path, $frontPath, 'screenShotUpload');
    	
    	header('Content-Type: application/json');
    	echo json_encode($result);
    // 	/* add comment page loading */
    // 	public function add_comment () {
    // 	    $this->front_render('pages/add_comments_view');
    // 	}
	}
	/* commnet submit function */
	public function saveComment () {
	    if (!$this->session->userdata('IS_FRONT_LOGIN')) {
	        $result = array('result' => 'login_failed');
	    } else
	        $result = $this->application_model->saveComments();

	    header('Content-Type: application/json');
	    echo json_encode($result);
	}
	/* add application page loading */
	public function add () {
	    if (!$this->session->userdata('IS_FRONT_LOGIN')) {
	        redirect(base_url().'user/login');
	    }
	    
	    $this->pageType['pageType'] = 'add_application';
	    $this->front_render('pages/add_application_view');
	}
	/* save application ajax form submit */
	public function saveApplication () {
	    if (!$this->session->userdata('IS_FRONT_LOGIN')) {
	        $data['result'] = 'login_failed';
			$result = $data;
	    } else 
	    	$result = $this->application_model->saveApplication();
	     
	    header('Content-Type: application/json');
	    echo json_encode($result);
	}
	/* save reply data: form submit */
	public function replySubmit () {
		if (!$this->session->userdata('IS_FRONT_LOGIN')) {
			$data['result'] = 'login_failed';
			$result = $data;
		} else 
			$result = $this->application_model->saveFeedbackReply();
		
		header('Content-Type: application/json');
		echo json_encode($result);
	}
	/* download user feedback */
	public function download_user_feedback ($comment_url) {
	   $this->load->helper('download');

        $applicationName = $this->application_model->GetApplicationNameById($id);

       $id = base64_decode($comment_url);
       $this->data['applicationName'] = $applicationName;
       if ($id != "" && $id != null) {
       	$comments = $this->application_model->getComments($id);
       } else $comments = 'No Data';
       $writeData = '';
      foreach ($comments as $key => $value) {
      	if ($value->user_id == 0) 
        	$userName = "Unknown User";
        else $userName = $value->ea_first_name." ".$value->ea_last_name;
        	$tempArray = explode('/', $value->screenshot);
        $writeData .= 'User Name: '.$userName."\n Feedback: ".$value->feedback_text."\n \n";
      }
       $name = 'feedback.txt';
       force_download($name, $writeData);
	}
    /* save user like*/
    public function save_comment_like () {
        if (!$this->session->userdata('IS_FRONT_LOGIN')) {
            $data['result'] = 'login_failed';
            $result = $data;
        } else
            $result = $this->application_model->SaveCommentLike('1');

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* save user unlike*/
    public function save_comment_unlike () {
        if (!$this->session->userdata('IS_FRONT_LOGIN')) {
            $data['result'] = 'login_failed';
            $result = $data;
        } else
            $result = $this->application_model->SaveCommentLike('-1');

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* save revised feedback form submit */
    public function revised_submit () {
        if (!$this->session->userdata('IS_FRONT_LOGIN')) {
            $data['result'] = 'login_failed';
            $result = $data;
        } else
            $result = $this->application_model->AddRevisedFormSubmit();

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* save multi reply submit data: ajax form submit*/
    public function multi_reply_submit () {
        if (!$this->session->userdata('IS_FRONT_LOGIN')) {
            $data['result'] = 'login_failed';
            $result = $data;
        } else
            $result = $this->application_model->SaveMultiReply();

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* save user Rate ajax data: star1, star2*/
    public function add_user_rate () {
        if (!$this->session->userdata('IS_FRONT_LOGIN')) {
            $data['result'] = 'login_failed';
            $result = $data;
        } else
             $result = $this->application_model->SaveUserRate();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */