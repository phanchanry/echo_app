<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('string');
        $this->load->helper('cookie');
        $this->pageType['pageType'] = 'user';
    }
    /* login page */
    public function login () {
    	if ($this->session->userdata('IS_FRONT_LOGIN')) {
    		redirect(base_url());
    	}
        $this->front_render('pages/login_view');
    }
    /* register page */
    public function register () {
        $this->load->view('pages/register_view');
    }
    /* add user function on register page  */
    public function registerUser () {
        $result = $this->user_model->registerUser ();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* login submit on login page */
    public function loginSubmit () {
        $result = $this->user_model->login();
        if ($result)
            redirect(base_url());
        else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">This Info is wrong. Please try again.</div>');
            redirect(base_url().'user/login');
        }
    }
    /* logout function */
    public function logout () {
        $result = $this->user_model->logout();
        redirect(base_url());
    }
    /* edit user profile function */
    public function edit_profile () {
        $id = $this->session->userdata('USER_ID');
        $this->data['userDetail'] = $this->user_model->GetUserList($id);
        $this->front_render('pages/edit_profile_view');
    }
    /* upload profile image*/
    public function upload_profile_image () {
        $path = $_SERVER['DOCUMENT_ROOT']."/assets/upload/profile_img/";
        $frontPath = base_url()."assets/upload/profile_img/";
        $result = $this->Upload_Image($path, $frontPath, 'profileImage');

        header('Content-Type: application/json');
        echo json_encode($result);
        // 	/* add comment page loading */
        // 	public function add_comment () {
        // 	    $this->front_render('pages/add_comments_view');
        // 	}
    }
    /* save user profile information*/
    public function save_user_profile () {
        $result = $this->user_model->SaveUserProfile();

        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* user login function*/
    public function facebook_login () {
        $result = $this->user_model->FbLogin();
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    /* user twitter login*/
    public function twitter_login () {
        /* Start session and load library. */
        $this->load->library('twitteroauth/twitteroauth');

        $connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);

        /* Get temporary credentials. */
        $request_token = $connection->getRequestToken(TWITTER_CALLBACK);

        $token = $request_token['oauth_token'];
        /* Save temporary credentials to session. */
        $this->session->set_userdata(
            array(
                'oauth_token' => $token,
                'oauth_token_secret' => $request_token['oauth_token_secret']
            )
        );
        //$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
        //$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        switch ($connection->http_code) {
            case 200:
                /* Build authorize URL and redirect user to Twitter. */
                $url = $connection->getAuthorizeURL($token);
                header('Location: ' . $url);
                break;
            default:
                /* Show notification if something went wrong. */
                echo 'Could not connect to Twitter. Refresh the page or try again later.';
        }
    }
    /* twitter call back */
    public function twitter_callback () {
        /* Start session and load lib */
        $this->load->library('twitteroauth/twitteroauth');

        /* If the oauth_token is old redirect to the connect page. */
        if (isset($_REQUEST['oauth_token']) && $this->session->userdata('oauth_token') !== $_REQUEST['oauth_token']) {
            //$_SESSION['oauth_status'] = 'oldtoken';
            $this->session->set_userdata(
                array(
                    'oauth_status' => 'oldtoken'
                )
            );
            redirect('user/twitter_clearsessions');
        }

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $this->session->userdata('oauth_token'), $this->session->userdata('oauth_token_secret'));

        /* Request access tokens from twitter */
        $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

        /* Save the access tokens. Normally these would be saved in a database for future use. */
        //$_SESSION['access_token'] = $access_token;

        $this->session->set_userdata(
            array(
                'access_token' => $access_token
            )
        );

        $content = $connection->get('account/verify_credentials');

        /* Remove no longer needed request tokens */
       // unset($_SESSION['oauth_token']);
       // unset($_SESSION['oauth_token_secret']);

        $this->session->unset_userdata('oauth_token');
        $this->session->unset_userdata('oauth_token_secret');
        /* If HTTP response is 200 continue otherwise send to connect page to retry */
        if (200 == $connection->http_code) {
            /* The user has been verified and the access tokens can be saved for future use */
            //$_SESSION['status'] = 'verified';

            $this->session->set_userdata(
                array(
                    'status' => 'verified'
                )
            );

            $twitterId = $content->id_str;
            $twitterName = $content->screen_name;
            $twitterEmail = '';
            $twitterUsername = $content->screen_name;
            $twitterImage = $content->profile_image_url;
            $accessToken1 = $access_token['oauth_token'];
            $accessToken2 = $access_token['oauth_token_secret'];

            $result = $this->user_model->TwLogin($twitterId, $twitterName, $twitterImage, $twitterEmail, $accessToken1, $accessToken2);

            redirect( base_url());
        }else{
            redirect( base_url());
        }
    }
    /* clear session*/
    public function twitter_clearsessions () {
        /**
         * @file
         * Clears PHP sessions and redirects to the connect page.
         */

        /* Load and clear sessions */
       // if (!isset($_SESSION)) session_start();

        /* Redirect to page with the connect to Twitter option. */
        redirect('user/twitter_login');

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