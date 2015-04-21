<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Question_Manage extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('question_model');
         if (!$this->session->userdata('IS_ADMIN_LOGIN')) {
            redirect(base_url().'admin/login');
        }
        $this->pageType['pageType'] = "question";
    }
   public function index () {
       $result = $this->question_model->getQuestions('-1');
       $this->data['questionList'] = $result;
       $this->admin_render('admin/question_management_view');
   }
    /* question management add question page loading */
   public function add_question () {
       $this->data['maxQuestionOrder'] = $this->question_model->getMaxQuestionOrder();
       $this->admin_render('admin/add_question_view');
   }
   /* add new question on add question page */
   public function addQuestion () {
       $result = $this->question_model->addNewQuestion();
        
       header('Content-Type: application/json');
       echo json_encode($result);
   }
   /* edit question page loading */
   public function edit_question ($id) {
       $result = $this->question_model->getQuestions($id);
       $this->data['questionList'] = $result[0];
       $this->admin_render('admin/edit_question_view');
   }
   /* save question info on edit question page */
   public function editQuestion () {
       $result = $this->question_model->saveQuestion();
       
       header('Content-Type: application/json');
       echo json_encode($result);
   }
   /* remove question on question page */
   public function removeQuestion () {
       $questionIds = $_POST['questionIds'];
       $result = $this->question_model->removeQuestion($questionIds);
       
       header('Content-Type: application/json');
       echo json_encode($result);
   }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */