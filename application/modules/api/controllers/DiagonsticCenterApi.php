<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DiagonsticCenterApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->model('diagonsticCenter_models');
    }

    function diagonsticlist_post() {


        $this->form_validation->set_rules('lat', 'Lat', 'xss_clean|trim|required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'xss_clean|trim|required|decimal');
       // $this->form_validation->set_rules('isemergency', 'Is Emergency', 'xss_clean|trim|numeric|required');
//        $this->form_validation->set_rules('radius', 'Radius', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('isHealtPkg', 'Is Health Package', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('isConsulting', 'Is Consultaion', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('notin', 'Not in', 'xss_clean|trim|required');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('search', 'Search Keyword', 'xss_clean|trim');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');

        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
            
            
            $lat = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $long = isset($_POST['long']) ? $this->input->post('long') : '';    
            
            $userId = isset($_POST['userId']) && $_POST['userId'] != null && $_POST['userId'] !=0 ? $this->input->post('userId') : 0;
             
            $isemergency = isset($_POST['isemergency'])  ? $this->input->post('isemergency') : NULL;  
            
            $notIn = isset($_POST['notin']) && $_POST['notin'] != 0 ? $_POST['notin'] : '';
            $notIn = explode(',', $notIn);
            
            $search = isset($_POST['search']) && $_POST['search'] != ''  ? $this->input->post('search') : NULL; 
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;
             
            // filtration parameter
            $radius = isset($_POST['radius']) ? $this->input->post('radius') : 70;
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : NULL; 
            $isHealtPkg = isset($_POST['isHealtPkg'])  ? $this->input->post('isHealtPkg') : NULL; 
            $isConsulting = isset($_POST['isConsulting'])  ? $this->input->post('isConsulting') : NULL; 


            $response['data'] = $this->diagonsticCenter_models->diaginsticList($lat,$long,$notIn,$isemergency,$radius,$rating,$isHealtPkg, $isConsulting, $userId,$search,$cityId);
            
            $option = array('table'=>'diagnostic','select'=>'diagnostic_id');
            $deleted = $this->singleDelList($option);
            $response['diagon_deleted']= $deleted;
           
            $response['colName'] =  array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","diaCat","healpkgCount", "consultinCount","userId");
           
              if($response['data']){
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
              }else{
                $response['status'] = False;
                $response['msg'] = 'There is no Diagonstic Center at this range!';
                $this->response($response, 400);
           }


        }
    }

      function diagnosticTimeSlot_post() {
        $this->bf_form_validation->set_rules('diagnosticId','diagnosticId','xss_clean|numeric|required|trim');
        if ($this->bf_form_validation->run($this) == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $centerTimeSlot = $this->input->post('diagnosticId');
            $options = array(
                'table' => 'qyura_diagnosticCenterTimeSlot',
                'where' => array('qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_deleted' => 0,'qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_diagnosticId' => $centerTimeSlot),
            );
            $centerTimeSlotArray = $this->common_model->customGet($options);
            $response = array();
            if(isset($centerTimeSlotArray) && $centerTimeSlotArray != NULL){
                foreach ($centerTimeSlotArray as $diagnosticTime){
		    $timeSlot = array();
                    $timeSlot[] = $diagnosticTime->diagnosticCenterTimeSlot_id;
                    $timeSlot[] = $diagnosticTime->diagnosticCenterTimeSlot_startTime;
                    $timeSlot[] = $diagnosticTime->diagnosticCenterTimeSlot_endTime;
                    $timeSlot[] = getSession($diagnosticTime->diagnosticCenterTimeSlot_sessionType);
                    $response[] = $timeSlot;
                }
            }
	    $columns = array('d_timeSlotid','d_startTime','d_endTime','d_sessionType');
            
            if (!empty($response) && $response != NULL ) {
                $response = array('status' => TRUE, 'message' => 'success', 'data' => $response,'columns'=>$columns);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'There is no time slot yet!' );
                $this->response($response, 400);
            }
        }
    }

    function diagonsticdetail_post() {
      $this->form_validation->set_rules('diagonsticId','Diagonstic Id','xss_clean|numeric|required|trim');
      if($this->form_validation->run($this) == FALSE)
      { 
        // setup the input
         $response =  array('status'=>FALSE,'message'=>$this->validation_post_warning());
         $this->response($response, 400);
      }
      else 
      {  
        $diagonsticId = $this->input->post('diagonsticId');
        $diagonsticDetails = $this->diagonsticCenter_models->diagonstic_Details($diagonsticId);
        //print_r($diagonsticDetails);exit;
        if($diagonsticDetails)
        {
            $response['diagonsticDetails'] = $diagonsticDetails;
            
            $response['services']  =  $this->diagonsticCenter_models->diagnosticServices_Details($diagonsticId);
            
            $response['specialities'] = $specialities =  $this->diagonsticCenter_models->diagnosticSpecialities_Details($diagonsticId);
            
//            $response['reviewCount'] = $reviewCount =  $this->diagonsticCenter_models->getDiagnosticsPkg($diagonsticId);
            
            $response['reviewCount'] = $reviewCount = $this->diagonsticCenter_models->getDiagnosticsReviewCount($diagonsticDetails->diagnostic_usersId);
//            die();
            $response['rating'] = $this->diagonsticCenter_models->getDiagnosticsAvgRating($diagonsticDetails->diagnostic_usersId);
            
            $response['diagDoctors'] = $this->diagonsticCenter_models->getDiagnosticsDoctors($diagonsticId,$diagonsticDetails->diagnostic_usersId);
          
            $response['diagnosticsCat'] = $hosDiagnostics = $this->diagonsticCenter_models->getDiagnosticsCat($diagonsticId);
            
            $response['awards'] =  $this->diagonsticCenter_models->getDiagAwards($diagonsticId);
//            echo $this->db->last_query();die();
            $response['diagonHelthPkg'] = $diagonHelthPkg =  $this->diagonsticCenter_models->getDiagonHelthPkg($diagonsticDetails->diagnostic_usersId);
            
            $response['gallery'] =  $this->diagonsticCenter_models->getDiagonGallery($diagonsticId);
            
           // $response['osInsurance'] = $osInsurance = $this->hospital_model->getHosInsurance($diagonsticId);
            
            $response['status'] = TRUE;
            $response['msg'] = 'success';
            $this->response($response, 200); // 200 being the HTTP response code
        }
        else
        {
            $response['status'] = TRUE;
            $response['msg'] = 'No Diagonstic  is available at this Id';
            $this->response($response, 400); // 200 being the HTTP response code
        }
        
      }
    }  
    
}
