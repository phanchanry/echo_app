<?php
/*
 *************************************************************************
* @filename		: petition_data_model.php
* @description	: Model of users
*------------------------------------------------------------------------
* VER  DATE         AUTHOR      DESCRIPTION
* ---  -----------  ----------  -----------------------------------------
* 1.0  2014.0.9.21   Jimm         Initial
* ---  -----------  ----------  -----------------------------------------
* GRCenter Web Client
*************************************************************************
*/
class Application_model extends CI_Model {

	function __construct() {
		parent::__construct();

		//$this->load->model('common_model');
	}
	/* get application on index page */
	function getApplications ($id = null) {
	    $str_sql = "select t1.*, t2.id, t3.comments_cnt
	                 from (
	                        select distinct(application_name) as application_name
	                          from feedbacks
	                       ) t1 left join
	                      (
	    			select application_name, min(id) as id
	                          from feedbacks
	                         group by application_name
	                      ) t2 on t1.application_name= t2.application_name
	                      left join
	                      ( select count(*) as comments_cnt, application_name
				              from feedbacks
	                         where feedback_text != '' group by application_name
	                       ) t3 on t1.application_name= t3.application_name";
	    //if ($id != '-1')
	    //    $str_sql .= " WHERE question_id = $id";
	    return $this->db->query($str_sql)->result();
	}
	/* get comments by application id */
	function getComments ($id) {
	    $str_sql = "select application_name from feedbacks
	                 where id = $id";
	     $result = $this->db->query($str_sql)->result();
	     if ($result == null)
	         return -1;
	     $applicationName = $result[0]->application_name;
	     $str_sql = "select t1.*, t2.*, t3.*, t4.*, t5.ea_description as revised_feedback, t5.revised_name, t5.revised_img,t5.ea_created_time as revised_time, t5.id as revised_id, t5.user_r_rate1, t5.user_r_rate2, t5.dev_r_rate1, t5.dev_r_rate2, t6.*
	     		       from feedbacks t1 
	                   left join ea_user t2 
	                     on t1.user_id = t2.user_id
	                   left join (
                          SELECT AVG(ea_rate1) as user_f_rate1, AVG(ea_rate2) as user_f_rate2, feedback_id
                            FROM ea_user_feedback_rate
                           WHERE user_type = 0
                           GROUP BY feedback_id
	                   ) t3 on t1.id = t3.feedback_id
	    			   left join (
                        select sum(CASE WHEN feedback_like = 1 THEN 1 ELSE 0  END) AS like_cnt, sum(CASE WHEN feedback_like = -1 THEN 1 ELSE 0  END) AS unlike_cnt, feedback_id
                          from ea_user_feedback_like
                         group by feedback_id
	    			   ) t4 on t1.id = t4.feedback_id
	    			   left join (
                        select erf.*, concat(eu.ea_first_name,' ', eu.ea_last_name) as revised_name, eu.user_image as revised_img, euf1.*, euf2.dev_r_rate1, euf2.dev_r_rate2
                          from ea_revised_feedback erf
                          left join ea_user eu
                            on erf.user_id = eu.user_id
                          left join (
                           SELECT AVG(ea_rate1) as user_r_rate1, AVG(ea_rate2) as user_r_rate2, revised_id
                             FROM ea_user_feedback_rate
                            WHERE user_type = 0
                            GROUP BY revised_id
                          ) euf1 on erf.id = euf1.revised_id
                           left join (
                           SELECT AVG(ea_rate1) as dev_r_rate1, AVG(ea_rate2) as dev_r_rate2, revised_id
                             FROM ea_user_feedback_rate
                            WHERE user_type = 1
                            GROUP BY revised_id
                          ) euf2 on erf.id = euf2.revised_id
	    			   ) t5 on t5.feedback_id = t1.id
	    			   left join (
                          SELECT AVG(ea_rate1) as dev_f_rate1, AVG(ea_rate2) as dev_f_rate2, feedback_id
                            FROM ea_user_feedback_rate
                           WHERE user_type = 1
                           GROUP BY feedback_id
	                   ) t6 on t1.id = t6.feedback_id
	                  where t1.application_name = ?
	                    and t1.feedback_text != ''";
	     $params = array($applicationName);
	     $result = $this->db->query($str_sql, $params)->result();
	     if ($result == null)
	         return -1;
	     else return $result;    
	}
    function GetReplies ($idArray) {
        for ($i =  0; $i < count($idArray); $i ++) {
            $str_sql = "SELECT t1.*, concat(t2.ea_first_name, ' ', t2.ea_last_name) as reply_name, t2.user_image as reply_img
                          FROM ea_feedback_reply t1
                          left join ea_user t2
                            on t1.user_id = t2.user_id
                         WHERE t1.feedback_id = ?
                           and t1.parent_id = 0
                         order by t1.ea_created_time DESC";
            $queryResult = $this->db->query($str_sql, array($idArray[$i]))->result();
            if ($queryResult == null)
                $resultArray[$i] = null;
            else $resultArray[$i] = $queryResult;
        }
        return $resultArray;
    }
	/* save comments */
	function saveComments () {
	    $userId = $this->session->userdata('USER_ID');
	    $screenShot = $_POST['screenShot'];
	    $description = $_POST['description'];
	    $applicationName = $_POST['applicationName'];
	    
	    $str_sql = "select * from feedbacks where application_name  = ?";
	    $params = array($applicationName);
	    $result = $this->db->query($str_sql, $params)->result();
	    if ($result == null) {
	        $data['result'] = 'failed';
	        return $data;
	    }
	    $androidVersion = $result[0]->android_version;
	    $applicationVersion = $result[0]->application_version;
	    $str_sql = "INSERT INTO feedbacks (user_id, timestamp, android_version, application_name, application_version, feedback_text, screenshot) 
	                  VALUES (?, ?, ?, ?, ?, ?, ?)";
	    $params = array (
	                    'user_id' => $userId,
	                    'timestamp' => strtotime(date('Y-m-d')),
	                    'android_version' => $androidVersion,
	                    'name' => $applicationName,
	                    'application_version' => $applicationVersion,
	                    'feedback' => $description,
	                    'screenshot' => $screenShot,
	               );
	    $result = $this->db->query($str_sql , $params);
	    if ($result)
	        $data['result'] = "success";
	    else $data['result'] = "failed";
	    return $data;
	}
	/* save application data: application name, application version user id */
	function saveApplication () {
	    $userId = $this->session->userdata("USER_ID");
	    $applicationName = $_POST['applicationName'];
	    $applicationVersion = $_POST['applicationVersion'];
	    
	    $str_sql = "SELECT * FROM feedbacks WHERE application_name = ?";
	    $params = array($applicationName);
	    $result = $this->db->query($str_sql, $params);
	    if ($result->num_rows) {
	        $data['result'] = 'exist';
	        return $data;
	    }
	    $str_sql = "INSERT INTO feedbacks (user_id, timestamp, android_version, application_name, application_version)
	                VALUES (?,?,?,?,?)";
	    $params = array(
	                    'user_id' => $userId,
	                    'timestamp' => strtotime(date('Y-m-d')),
	                    'android_version' => '',
	                    'application_name' => $applicationName,
	                    'application_version' => $applicationVersion
	    );
	    $result = $this->db->query($str_sql, $params);
	    if ($result)
	        $data['result'] = "success";
	    else $data['result'] = "failed";
	    return $data;
	    
	}
	/* save feedback reply data: user id,feedback id,description */
	function saveFeedbackReply () {
		$userId = $this->session->userdata("USER_ID");
		$feedbackId = $_POST['feedbackId'];
		$description = $_POST['replyDescription'];
		
        $str_sql = "INSERT INTO ea_feedback_reply
                        (user_id, feedback_id, reply_text,ea_created_time, ea_updated_time)
                     VALUES (?,?,?,now(),now())";
        $params = array(
            'user_id' => $userId,
            'feedback_id' => $feedbackId,
            'text' => $description
        );
        $result = $this->db->query($str_sql, $params);
        $data['feedbackId'] = $feedbackId;
        $data['result'] = 'success';

		return $data;
	}
    /* save user comment like */
    function SaveCommentLike ($feedbackLike) {
        $feedbackId = $_POST['feedbackId'];
        $userId = $this->session->userdata('USER_ID');
        $str_sql = "SELECT * FROM ea_user_feedback_like WHERE user_id = ? AND feedback_id = ?";
        $result = $this->db->query($str_sql, array($userId, $feedbackId));
        if ($result->num_rows > 0)
            $data = array('result' => 'exit');
        else {
            $str_sql = "INSERT INTO ea_user_feedback_like (user_id, feedback_id, feedback_like, ea_created_time)
                         VALUES (?,?,?,now())";
            $result = $this->db->query($str_sql, array($userId, $feedbackId, $feedbackLike));
            if ($result)
                $data['result'] = "success";
            else $data['result'] = "failed";
        }

        return $data;
    }
	/* add revised form submit*/
    function AddRevisedFormSubmit () {
        $feedbackId = $_POST['feedbackId'];
        $userId = $this->session->userdata('USER_ID');
        $description = $_POST['revisedDescription'];

        $str_sql = "SELECT * FROM ea_revised_feedback WHERE feedback_id = ?";
        $queryResult = $this->db->query($str_sql, array($feedbackId));
        if ($queryResult->num_rows > 0)
            $data = array('result' => 'exist');
        else {
            $str_sql = "INSERT INTO ea_revised_feedback (feedback_id, user_id, ea_description, ea_created_time) VALUES(?,?,?,NOW())";
            $queryResult = $this->db->query($str_sql, array($feedbackId, $userId, $description));
            if ($queryResult) {
                $data = array('result' => 'success', 'feedbackId' => $feedbackId);
            } else $data = array('result' => 'failed');
        }
        return $data;
    }

    /* get application Name by id*/
    function GetApplicationNameById($feedbackId) {
        $str_sql = "SELECT * FROM feedbacks WHERE id = ?";
        $queryResult = $this->db->query($str_sql, array($feedbackId))->result();
        return $queryResult[0]->application_name;
    }
    /* save multi reply function*/
    function SaveMultiReply () {
        $userId = $this->session->userdata("USER_ID");
        $parentId = $_POST['replyId'];
        $description = $_POST['replyDescription'];
        $str_sql = "SELECT * FROM ea_feedback_reply where reply_id= ?";
        $queryResult = $this->db->query($str_sql, array($parentId))->result();
        $feedbackId = $queryResult[0]->feedback_id;
        $str_sql = "INSERT INTO ea_feedback_reply
                        (user_id, feedback_id, reply_text, ea_created_time, ea_updated_time, parent_id)
                     VALUES (?,?,?,now(),now(),?)";
        $params = array(
            'user_id' => $userId,
            'feedback_id' => $feedbackId,
            'text' => $description,
            'parent_id' => $parentId
        );
        $result = $this->db->query($str_sql, $params);
        $data['feedbackId'] = $feedbackId;
        $data['result'] = 'success';

        return $data;
    }

    /* get sub reply by parent id*/
    function GetSubReplies($parentId) {
        $str_sql = "SELECT t1.*, concat(t2.ea_first_name, ' ', t2.ea_last_name) as reply_name, t2.user_image as reply_img
                          FROM ea_feedback_reply t1
                          left join ea_user t2
                            on t1.user_id = t2.user_id
                         WHERE t1.parent_id = ?
                         order by t1.ea_created_time DESC";
        $queryResult = $this->db->query($str_sql, array($parentId))->result();
        return $queryResult;
    }
    /* save user rate*/
    function SaveUserRate () {
        $userType = $this->session->userdata('USER_TYPE');
        $userId = $this->session->userdata('USER_ID');
        $star1 = $_POST['star1'];
        $star2 = $_POST['star2'];
        $referenceId = $_POST['referenceId'];
        $type = $_POST['type'];
        if ($type == 'feedback') {
            $str_sql = 'SELECT * FROM ea_user_feedback_rate WHERE user_id = ? AND feedback_id = ?';
            $queryResult = $this->db->query($str_sql, array($userId, $referenceId));
            if ($queryResult->num_rows > 0)
                $data = array('result' => 'exist');
            else {
                $str_sql = "INSERT INTO ea_user_feedback_rate (feedback_id, user_id, user_type, ea_rate1, ea_rate2, ea_created_time)
                              VALUES (?,?,?,?,?, now())";
                $queryResult = $this->db->query($str_sql, array($referenceId, $userId, $userType, $star1, $star2));
                $data = array('result' => 'success');
            }
        } else {
            $str_sql = 'SELECT * FROM ea_user_feedback_rate WHERE user_id = ? AND revised_id = ?';
            $queryResult = $this->db->query($str_sql, array($userId, $referenceId));
            if ($queryResult->num_rows > 0)
                $data = array('result' => 'exist');
            else {
                $str_sql = "INSERT INTO ea_user_feedback_rate (revised_id, user_id, user_type, ea_rate1, ea_rate2, ea_created_time)
                              VALUES (?,?,?,?,?, now())";
                $queryResult = $this->db->query($str_sql, array($referenceId, $userId, $userType, $star1, $star2));
                $data = array('result' => 'success');
            }
        }
        return $data;
    }
}

/* Location: ./application/models/admin/user_model.php */