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
class Comments_model extends CI_Model {

	function __construct() {
		parent::__construct();

		//$this->load->model('common_model');
	}
	/* get all questions on question view page */
	function getQuestions ($id) {
	    $str_sql = "SELECT * FROM ta_questions";
	    if ($id != '-1')
	        $str_sql .= " WHERE question_id = $id";
	    $str_sql .= " ORDER BY ta_question_order ASC, ta_updated_time ASC";
	    return $this->db->query($str_sql)->result();
	}
	/* add question on question management */
	function addNewQuestion () {
	   $adminId = $this->session->userdata('ADMIN_ID');
	   $question =$_POST['question'];
	   $questionOrder = $_POST['questionOrder'];
	   $rightAnswer = $_POST['rightAnswer'];
	   $tooltip = $_POST['tooltip'];
	   $str_sql = "SELECT * FROM ta_questions WHERE ta_question_order = $questionOrder";
	   $result = $this->db->query($str_sql);
	   if ($result->num_rows) {
	       $data['result'] = 'order_exist';
	       return $data;
	   }
	   $str_sql = "INSERT INTO ta_questions (user_id, ta_question, ta_question_order, ta_tooltip, ta_right_answer, ta_created_time, ta_updated_time)
	                VALUES (?,?,?,?,?,now(), now())";
	   $params = array(
	                'user_id' => $adminId,
	                'ta_question' => $question,
	                'ta_question_order' => $questionOrder,
	                'ta_tooltip' => $tooltip,
	                'ta_right_answer' => $rightAnswer
	             );
	   $result = $this->db->query($str_sql, $params);
	   if ($result)
	       $data['result'] = "success";
	   else $data['result'] = "failed";
	   return $data;
	}
	/* save question changed information */
	function saveQuestion () {
	    $adminId = $this->session->userdata('ADMIN_ID');
	    $questionId = $_POST['questionId'];
	    $question =$_POST['question'];
	    $questionOrder = $_POST['questionOrder'];
	    $rightAnswer = $_POST['rightAnswer'];
	    $tooltip = $_POST['tooltip'];
	    
	    $str_sql = "SELECT * FROM ta_questions WHERE ta_question_order = '$questionOrder' AND question_id != '$questionId'";
	    $result = $this->db->query($str_sql);
	    if ($result->num_rows) {
	        $data['result'] = 'order_exist';
	        return $data;
	    }
	    $str_sql = "UPDATE ta_questions
	                   SET user_id = ?
	                     , ta_question = ?
	                     , ta_question_order = ?
	                     , ta_tooltip = ?
	                     , ta_right_answer = ?
	                     , ta_updated_time = now()
	                 WHERE question_id = ?";
	    $params = array(
	                'user_id' => $adminId,
	                'ta_question' => $question,
	                'ta_question_order' => $questionOrder,
	                'ta_tooltip' => $tooltip,
	                'ta_right_answer' => $rightAnswer,
	                'question_id' => $questionId
	             );
	    $result = $this->db->query($str_sql, $params);
	    if ($result)
	        $data['result'] = "success";
	    else $data['result'] = "failed";
	    return $data;
	}
	/* remove question ids with question ids on ta_question table */
	function removeQuestion ($questionIds) {
	    $str_sql = "DELETE FROM ta_questions WHERE question_id IN ($questionIds)";
	    $result = $this->db->query($str_sql);
	    if ($result)
	        $data['result'] = "success";
	    else $data['result'] = "failed";
	    return $data;
	}
	function getMaxQuestionOrder () {
	    $str_sql = "SELECT MAX(ta_question_order) as max_question_order FROM ta_questions";
	    $result = $this->db->query($str_sql)->result();
	    return $result[0]->max_question_order;
	}
	/* get question info by question order */
	function getQuestionByOrder ($orderId) {
	    $str_sql = "SELECT * FROM ta_questions WHERE ta_question_order = ?";
	    $result = $this->db->query($str_sql, array($orderId))->result();
	    if ($result != null)
	        return $result[0];
	    else return null;
	} 
}

/* End of file user_model.php */
/* Location: ./application/models/admin/user_model.php */