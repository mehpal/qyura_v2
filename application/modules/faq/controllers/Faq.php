<?php

class Faq extends MY_Controller {

    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';

    public function __construct() {
        parent:: __construct();
    }
    
    function index() {
        $option = array(
            'table' => 'qyura_faq',
            'select' => '*',
            'where' => array('qyura_faq.faq_deleted' => 0),
            'order' => array('faq_question' => 'asc'),
            'single' => FALSE
        );
        $data['faq_list'] = $this->common_model->customGet($option);
        
        $data['title'] = 'List FAQ';
        $this->load->super_admin_template('faq_view', $data, 'faqScript');
    }
    
    function addFaq() {
        
        $data['title'] = 'List Hospital';
        $this->load->super_admin_template('add_faq', $data, 'faqScript');
    }
    
    function saveFaq(){
        
        $this->bf_form_validation->set_rules('faq_question[]','Question','xss_clean');
        $this->bf_form_validation->set_rules('faq_answer[]', 'Answer','xss_clean');
        $this->bf_form_validation->set_rules('faq_answer1[]', 'Answer','xss_clean');
       
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        }else {
            
            $questions = $this->input->post('faq_question');
            $answer = $this->input->post('faq_answer');
            $answer1 = $this->input->post('faq_answer1');

            $count = 0;
            $id = FALSE;
            foreach ($questions as $question){
                $data = array('faq_creationTime'=>date('Y-m-d H:i:s'), 'faq_question'=> $question,'faq_answer'=>$answer[$count],'faq_answer1'=>$answer1[$count]);
                $options  =   array
                (
                    'data'=>$data,
                    'table' =>  'qyura_faq'    
                );
                $id = $this->common_model->customInsert($options); 
                $count++;
            }
            if ($id || $count) {
                $responce = array('status' => 1, 'msg' => "FAQ added successfully", 'url' => "faq/index/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function editFaqView($faqId) {
        
        $option = array(
            'table' => 'qyura_faq',
            'select' => '*',
            'where' => array('qyura_faq.faq_deleted' => 0,'qyura_faq.faq_id' => $faqId),
            'single' => TRUE
        );
        $data['faq_data'] = $this->common_model->customGet($option);
        
        $data['title'] = 'Edit FAQ';
        $this->load->super_admin_template('faq_edit', $data, 'faqScript');
    }
    
    function editFaq(){
        
        $this->bf_form_validation->set_rules('faq_question','Question','required');
        $this->bf_form_validation->set_rules('faq_answer', 'Answer','required');
        $this->bf_form_validation->set_rules('faq_answer1', 'Answer','required');
       
        if ($this->bf_form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        }else {
            
            $faq_id = $this->input->post('faq_id');
            $questions = $this->input->post('faq_question');
            $answer = $this->input->post('faq_answer');
            $answer1 = $this->input->post('faq_answer1');

            $data = array('faq_creationTime'=>date('Y-m-d H:i:s'), 'faq_question'=> $questions,'faq_answer'=>$answer,'faq_answer1'=>$answer1,'status' => 2);
            $options  =   array
            (
                'where' => array('faq_id' => $faq_id),
                'data'  => $data,
                'table' => 'qyura_faq'    
            );
            $id = $this->common_model->customUpdate($options); 
                
            if ($id) {
                $responce = array('status' => 1, 'msg' => "FAQ Update Successfully", 'url' => "faq/index/");
            } else {
                $error = array("TopError" => "<strong>Something went wrong while updating your data... sorry.</strong>");
                $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
            }
            echo json_encode($responce);
        }
    }
    
    function faqPublish() {
        $ena_id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($ena_id != '' && $status != '') {
            //Group
            if ($status == 2) {
                $update_data['status'] = 3;
            } else {
                $update_data['status'] = 2;
            }
            $where = array('faq_id' => $ena_id);
            $updateOptions = array
                (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'qyura_faq'
            );

            $update = $this->common_model->customUpdate($updateOptions);

            if ($update)
                echo $update;
            else
                echo '0';
        }
        else {
            echo 0;
        }
    }
}
