<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DiagonsticDocCounsultaion extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('diagonSticDocCounsultaion_model'));
    }
    
    function diagonSticConsultantList_post() {
        
        $this->bf_form_validation->set_rules('diagonsticUserId','Diagonstic User Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('specialityid', 'Speciality Id', 'xss_clean|trim|numeric|required');
        $this->bf_form_validation->set_rules('notin', 'Not In', 'xss_clean|trim|required');
        $this->bf_form_validation->set_rules('search ', 'Search Keyword', 'xss_clean|trim');
	$this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
      
            $diagonsticUserId = $this->input->post('diagonsticUserId');
            $specialityId = $this->input->post('specialityid');
            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $this->input->post('notin') : '';
            $notIn = explode(',', $notIn);
            
            // search
            $search = isset($_POST['search']) && $_POST['search'] != ''  ? $this->input->post('search') : NULL;

	    //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;
            
            $consultantList = $this->diagonSticDocCounsultaion_model->getConsultantList($notIn,$diagonsticUserId,$specialityId,$search,$cityId);
           $response['colName'] = array("id", "name", "showExp", "exp", "imUrl", "rating", "consFee", "speciality", "degree", "lat", "long", "isEmergency", "mobile", "userId");
            if ($consultantList) {
                $response['consultantList'] = $consultantList;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'No Doctor is available at this Diagonstic Center';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }
    
}
