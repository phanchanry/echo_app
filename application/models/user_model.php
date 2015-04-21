<?php
/*
 *************************************************************************
* @filename		: user_model.php
* @description	: Model of users
*------------------------------------------------------------------------
* VER  DATE         AUTHOR      DESCRIPTION
* ---  -----------  ----------  -----------------------------------------
* 1.0  2014.0.8.23   chanry         Initial
* ---  -----------  ----------  -----------------------------------------
* GRCenter Web Client
*************************************************************************
*/
class User_model extends CI_Model {

	function __construct()
	{
		parent::__construct();

		//$this->load->model('common_model');
	}
	/* register user on register page data: registerForm submit */
	function registerUser () {
	    $firstName = $_POST['firstName'];
	    $lastName = $_POST['lastName'];
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    $userType = $_POST['userType'];
	    
	    $str_sql = "SELECT * FROM ea_user WHERE ea_email = ?";
	    $params = array('ea_email' => $email);
	    $result = $this->db->query($str_sql, $params);
	    if ($result->num_rows)
	        $data['result'] = 'exist';
	    else {
	        $salt =  random_string('alnum', 9);
	        $password = md5($password.$salt);
	        
	        $str_sql = "INSERT INTO ea_user (ea_first_name, ea_last_name, ea_email, ea_password, ea_salt, ea_user_type, ea_created_time, ea_updated_time)
	                        VALUES(?,?,?,?,?,?,now(), now())";
	        $params = array(
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'email' => $email,
                        'password' => $password,
	                    'salt' => $salt,
	                    'user_type' => $userType
	                    );
	       $this->db->query($str_sql, $params);
	       $data['result'] = 'success';
	    }
	    return $data;
	}
	/* login submit on login page data: loginForm submit  */
	function login () {
	    $email = $_POST['email'];
	    $password = md5($_POST['password'].$this->GetSalt($email));
	    $str_sql = "SELECT * FROM ea_user WHERE ea_email = ? AND ea_password =?";
	    $params = array(
	                 'ea_email' => $email,
	                 'ea_password' => $password
	              );
	    $result = $this->db->query($str_sql, $params);
	    if ($result->num_rows > 0) {
	        foreach ($result->result_array() as $key => $res) {
	            $this->session->set_userdata(
	                            array(
                                    'USER_ID' => $res['user_id'],
                                    'USER_EMAIL' => $res['ea_email'],
                                    'IS_FRONT_LOGIN' => TRUE,
	                                'USER_TYPE' => $res['ea_user_type']            
	                            )
	            );
	        }
	        return true;
	    }
	    return false;
	    
	}
	/* get salt with by email address  */
	function GetSalt ($email) {
	    $str_sql = "SELECT ea_salt FROM ea_user WHERE ea_email = ? LIMIT 1";
	    $params = array($email);
	    $result = $this->db->query($str_sql, $params)->result();
	    if ($result != null)
	        return $result[0]->ea_salt;
	    else return -1;
	    
	}
	/* logout  */
	function logout () {
	    $this->session->unset_userdata('USER_ID');
	    $this->session->unset_userdata('USER_EMAIL');
	    $this->session->unset_userdata('IS_FRONT_LOGIN');
        $this->session->unset_userdata('USER_TYPE');
	}
	/* get user list */
	function GetUserList ($id = null) {
	    $str_sql = "SELECT * FROM ea_user";
        if ($id != null)
            $str_sql .= " WHERE user_id = '$id'";
	    $result = $this->db->query($str_sql)->result();
	    if ($result != null)
	        return $result;
	    else return -1;
	}

    /* save user profile information form ajax submit*/
    function SaveUserProfile () {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $imgPath = $_POST['profileImgPath'];
        $userId = $this->session->userdata('USER_ID');
        $salt = $this->GetSalt($this->session->userdata('USER_EMAIL'));

        $str_sql = "UPDATE ea_user
                       SET ea_first_name = ?
                         , ea_last_name = ?
                         , ea_email = ?";

        if ($password != "")
            $str_sql .= ", ea_password = '".MD5($password.$salt)."'";
        if ($imgPath != "")
            $str_sql .= ", user_image = '".$imgPath."'";
        $str_sql .= " WHERE user_id = ?";
        $result = $this->db->query($str_sql, array($firstName, $lastName, $email, $userId));

        if ($result)
            $data = array('result' => 'success');
        else $data = array('result' => 'failed');

        return $data;
    }
    /* facebook login */
    function FbLogin () {
        $this->load->helper('string');

        $response = $_POST['response'];
        $accessToken = $_POST['accessToken'];

        $facebookID = $response['id'];
        $facebookName = $response['name'];
        $facebookEmail = $response['email'];
        if (isset($response['username']))
            $facebookUsername = $response['username'];
        else $facebookUsername = '';
        $facebookFirstname = $response['first_name'];
        $facebookLastname = $response['last_name'];
        if ($facebookUsername == "") {
            $facebookUsername = str_replace( " ", "", $facebookName );
        }
        $result = "success";

        $str_sql = "select t1.* from ea_user t1, ea_user_sns t2 where t2.sns_id = ? and t1.user_id = t2.user_id and t2.ea_sns_type = 1";
        $row = $this->db->query( $str_sql, array($facebookID));
        if ($row->num_rows == null) {
            $token = time().random_string('alnum', 32);
            $str_sql = "insert into ea_user(ea_first_name, ea_last_name, ea_password, ea_email, user_image, ea_token, ea_created_time, ea_updated_time)
				         value ( ?, ?,'', ?, ?, ?, now(), now() )";
            $query_result = $this->db->query($str_sql, array($facebookFirstname, $facebookLastname, $facebookEmail, "http://graph.facebook.com/".$facebookID."/picture?type=large", $token));
            $userId = $this->db->insert_id();

            // Insert into RB_USER_SNS
            $str_sql = "insert into ea_user_sns( user_id, ea_sns_type, sns_id, ea_nickname, ea_email, ea_photo, ea_created_time, ea_updated_time )
			    	 value ( ?, 1, ?, ?, ?, ?, now(), now())";
            $params = array($userId, $facebookID, $facebookName, $facebookEmail, "http://graph.facebook.com/".$facebookID."/picture?type=large");
            $query_result = $this->db->query($str_sql, $params);
            //$userSnsId = $this->db->insert_id();

        }else{
            foreach ($row->result_array() as $key => $res) {
                $token = $res['ea_token'];
                $userId = $res['user_id'];
            }
        }
        $this->session->set_userdata(
            array(
                'USER_ID' => $userId,
                'USER_EMAIL' => $facebookEmail,
                'IS_FRONT_LOGIN' => TRUE,
                'USER_TYPE' => 0
            )
        );

        $data['result'] = $result;
        return $data;
    }
    /* twitter login*/
    public function TwLogin ($twitterId, $twitterName, $twitterImage, $twitterEmail, $accessToken1, $accessToken2) {
        $this->load->helper('string');
        $sql = "select t2.* from ea_user_sns t1, ea_user t2 where t1.sns_id = ? and t1.user_id = t2.user_id and t1.ea_sns_type = 2";
        $row = $this->db->query($sql, array($twitterId));
        if( $row->num_rows == null ){
            $token = time().random_string('alnum', 32);

            $sql = "insert into ea_user( ea_first_name, ea_password, ea_email, user_image, ea_token, ea_created_time, ea_updated_time )
				    value ( ?, '',?, ?, ?, now(), now() )";
            $this->db->query( $sql, array($twitterName, $twitterEmail, $twitterImage, $token) );
            $userId = $this->db->insert_id();

            // Insert into cs_USER_SNS
            $sql = "insert into ea_user_sns( user_id, ea_sns_type, sns_id, ea_nickname, ea_email, ea_photo, ea_token, ea_token2, ea_created_time, ea_updated_time )
				   values (?, 2, ?, ?, ?, ?, ?, ?, now(), now())";
            $this->db->query( $sql, array($userId, $twitterId, $twitterName, $twitterEmail, $twitterImage, $accessToken1, $accessToken2) );
        }else{
            foreach ($row->result_array() as $key => $res) {
                $token = $res['ea_token'];
                $userId = $res['user_id'];
            }
        }


        $this->session->set_userdata(
            array(
                'USER_ID' => $userId,
                'USER_EMAIL' => $twitterEmail,
                'IS_FRONT_LOGIN' => TRUE,
                'USER_TYPE' => 0
            )
        );
        return true;
    }

}

/* End of file user_model.php */
/* Location: ./application/models/admin/user_model.php */