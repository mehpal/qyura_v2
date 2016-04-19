<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class HealthpkgBooking extends MyRest {

    function __construct() {
        // Construct our parent class
       
        parent::__construct();
        $this->load->model(array('healthpkgBooking_model'));
    }
    
    function healthPkgBook_post() {

        $this->bf_form_validation->set_rules('miUserId','Mi User Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('healthPkgId','Health Package Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('familyMemberId', 'Family Member Id', 'xss_clean|numeric|trim');
        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_date');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $miUserId = isset($_POST['miUserId']) ? $this->input->post('miUserId') : '';
            $healthPkgId = isset($_POST['healthPkgId']) ? $this->input->post('healthPkgId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '';
            
            $familyMemberId = isset($_POST['familyMemberId']) && $_POST['familyMemberId'] != null && $_POST['familyMemberId'] !=0 ? $this->input->post('familyMemberId') : 0;
            
            $data = array(
                'healthPkgBooking_miId' => $miUserId,
                'healthPkgBooking_healthPackageId' => $healthPkgId,
                'healthPkgBooking_userId' => $userId,
                'healthPkgBooking_memberId' => $familyMemberId,
                'healthPkgBooking_preferedBookingDate' => strtotime($preferedDate),
                'healthPkgBooking_finalBookingDate' => strtotime($preferedDate),
                'creationTime' => time(),
                'status' => 1
            );
          //  print_r($data); exit;
            $response = $this->healthpkgBooking_model->bookHealthPkg('qyura_healthPkgBooking',$data);
         
            if ($response) {
                
                $response = array('status' => TRUE, 'message' => 'Health package successfully booked');
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!' );
                $this->response($response, 400);

            }
        }
    }
    
    function healthPkgBookList_post(){
        $this->bf_form_validation->set_rules('userId','User Id','xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            
            $where = array(
                      'healthPkgBooking_userId' => $userId,
                      'healthPkgBooking_deleted' => 0
                     );
            
            $response = $this->healthpkgBooking_model->getMyBookedHealthPkg($where);
            
            if (!empty($response) && $response != NULL ) {
                
                $response = array('status' => TRUE, 'message' => 'Booked health package list!', 'data' => $response);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'There is no health package booked yet!' );
                $this->response($response, 400);

            }
        }
    }
    
    
    function cancelBooking_post() {
        
        $this->form_validation->set_rules('healthPkgBookingId','Health package booking id','xss_clean|numeric|required|trim');
        
        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
            
        } else {
            
            $healthPkgBookingId = $this->input->post('healthPkgBookingId');
            $where = array('healthPkgBooking_id'=> $healthPkgBookingId);
            $data = array(
                      'healthPkgBooking_bkStatus' => 2,
                      'modifyTime' => time() 
                     
                 );
            $isCanclled= $this->healthpkgBooking_model->cancelBooking('qyura_healthPkgBooking',$data,$where);
           // print_r($healpkgDetail); exit;
            if ($isCanclled) {
                $response['status'] = TRUE;
                $response['msg'] = 'Booking successfullu canceled!';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'Some thing wrong to cancellation!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }
    
    
      function healpkgDetail_post() {
        
        $this->form_validation->set_rules('healthPkgBookingId','Health package booking id','xss_clean|numeric|required|trim');
        
        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
            
        } else {
            
            $healthPkgBookingId = $this->input->post('healthPkgBookingId');
            
            $healpkgDetail = $this->healthpkgBooking_model->getHealpkgDetail($healthPkgBookingId);
            $healpkgTest = $this->healthpkgBooking_model->getHealpkgTest($healthPkgBookingId);
           // print_r($healpkgDetail); exit;
            if (!empty($healpkgDetail) && $healpkgDetail != '') {
                $response['healthPkgDetail'] = $healpkgDetail;
                $response['healthPkgTest'] = $healpkgTest;
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $response['status'] = false;
                $response['msg'] = 'Detail not found!';
                $this->response($response, 400); // 200 being the HTTP response code
            }
        }
    }
    
     function upcomingHealthPk_post(){
        $this->bf_form_validation->set_rules('userId','User Id','xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            
            $where = array(
                      'healthPkgBooking_userId' => $userId,
                      'healthPkgBooking_deleted' => 0
                     );
            
            $response = $this->healthpkgBooking_model->getUpcomingPkg($where);
            
            if (!empty($response) && $response != NULL ) {
                
                $response = array('status' => TRUE, 'message' => 'Upcoming health package list!', 'data' => $response);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'There is no upcoming and completed health package yet!' );
                $this->response($response, 400);

            }
        }
    }
    
    function previewHealthPkg_post(){
        $this->bf_form_validation->set_rules('userId','User Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('healthPkgBookingId','healthPkgBooking Id','xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $healthPkgBookingId = isset($_POST['healthPkgBookingId']) ? $this->input->post('healthPkgBookingId') : '';
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            
            $where = array(
                      'healthPkgBooking_id' => $healthPkgBookingId,
                      'healthPkgBooking_userId' => $userId,
                      'healthPkgBooking_deleted' => 0
                     );
            
            $response = $this->healthpkgBooking_model->preview($where);
            
            if (!empty($response) && $response != NULL ) {
                
                $response = array('status' => TRUE, 'message' => 'preview list', 'data' => $response);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'No preview available' );
                $this->response($response, 400);

            }
        }
    }
    
    
    function _check_date($str_in = '')
    {
        
         $currentDate = strtotime(date("y-m-d"));
         $prfDate  = strtotime($str_in);
         if($prfDate >= $currentDate){
             return true;
         }else{
             dump($prfDate >= $currentDate);
              $this->bf_form_validation->set_message('_check_date', 'date should be equal or greater then today');
             return false;
         }
        
    }

}   