<?php
require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorBooking extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('doctorBooking_model'));
    }
    
    function doctorAppointment_post() {

        $this->bf_form_validation->set_rules('specialitiesId','Specialities Id','xss_clean|numeric|required|trim'); 
        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_date');
        $this->bf_form_validation->set_rules('preferedTimeId', 'Prefered time', 'xss_clean|required|trim|numeric');//docTimeDayId
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim'); // Loged In user Id
        $this->bf_form_validation->set_rules('memberId','Member Id','xss_clean|numeric|required|trim'); // 0 =Self as patient
        $this->bf_form_validation->set_rules('doctorType','Doctor Type','xss_clean|numeric|required|trim');//1 Hos /2 Dig /3 ind
        $this->bf_form_validation->set_rules('doctorId','Doctor Id','xss_clean|numeric|required|trim'); // Doctor Profile Id
        $this->bf_form_validation->set_rules('parentId','Mi Id','xss_clean|numeric|required|trim'); // 0=indi Doctor
        $this->bf_form_validation->set_rules('consulationFee','consulationFee','xss_clean|required|trim|numeric');
        $this->bf_form_validation->set_rules('tax','tax','xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('remark','Remark','xss_clean|required|trim|max_length[100]'); // Remark
       
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $specialitiesId = isset($_POST['specialitiesId'])   ? $this->input->post('specialitiesId')  : '';
            $preferedDate   = isset($_POST['preferedDate'])     ? $this->input->post('preferedDate')    : '';
            $preferedTimeId = isset($_POST['preferedTimeId'])   ? $this->input->post('preferedTimeId')  : '';//SessionId of slots
            $userId         = isset($_POST['userId'])           ? $this->input->post('userId')          : '';
            $memberId       = isset($_POST['memberId'])         ? $this->input->post('memberId')        : 0 ;
            $doctorType     = isset($_POST['doctorType'])       ? $this->input->post('doctorType')      : '';
            $doctorUserId   = isset($_POST['doctorId'])         ? $this->input->post('doctorId')        : '';
            $parentId       = isset($_POST['parentId'])         ? $this->input->post('parentId')        : 0 ; 
            $consulationFee = isset($_POST['consulationFee'])   ? $this->input->post('consulationFee')  : 0 ; 
            $tax            = isset($_POST['tax'])              ? $this->input->post('tax')             : 0 ;
            $remark         = isset($_POST['remark'])           ? $this->input->post('remark')          : '';
            
            $tax_amount = ($consulationFee /100) * $tax;
            $total_amount = ($consulationFee + $tax_amount);
            
            $correctSlot = 1;
            $day = getDay(date("l",strtotime($preferedDate))); 
            
            if($correctSlot){
                $unique_id = 'doc'. $userId . rand(0, 999);
                $data = array(
                    'doctorAppointment_unqId' => $unique_id,
                    'doctorAppointment_specialitiesId' => $specialitiesId,
                    'doctorAppointment_date' => strtotime($preferedDate), 
                    'doctorAppointment_pntUserId' => $userId,
                    'doctorAppointment_memberId' => $memberId,
                    'doctorAppointment_doctorUserId' => $doctorUserId,
                    "doctorAppointment_docType"=>$doctorType,
                    'doctorAppointment_doctorParentId' => $parentId,
                    'doctorAppointment_ptRmk' => $remark,
                    'doctorAppointment_slotId' => $preferedTimeId,
                    'doctorAppointment_totPayAmount' => $total_amount,
                    'doctorAppointment_payMode' => 17,
                    'doctorAppointment_payStatus' => 15,
                    'creationTime' => time(),
                    'status' => 11
                );
                
                $response = $this->doctorBooking_model->bookAppointment('qyura_doctorAppointment',$data);
                $currentDate = strtotime(date("Y-m-d"));
                
                if ($response)  {
                    
                    $crnMsg     =  $this->lang->line("docappointmentReceived");
                    
                    $cronArray = array("qyura_fkModuleId" => 3, "qyura_fkUserId" => $userId, "qyura_cronMsg" => $crnMsg, "qyura_cronTitle" => $this->lang->line("docappointmentTag"), "qyura_fkItemId" => $unique_id,"qyura_cronDate"=>$currentDate,"qyura_cronMsgsCreation"=>$currentDate);

                    $options = array(
                        'data' => $cronArray,
                        'table' => 'qyura_cronMsgs'
                    );

                    $cronId = $this->common_model->customInsert($options);
                    
                    $response = array('status' => TRUE, 'message' => 'Your Doctor Appointment request has been received. You will receive a confirmation email or SMS shortly. You can also call the Medical Institution directly to know its status.');
                    $this->response($response, 200);
                } else {
                    $response = array('status' => FALSE,'message'=>'Something went wrong, please re-try for your appointment!');
                    $this->response($response, 400);
                }
            } else {
                $response = array('status' => FALSE,'message'=>'Please provide the correct time slot!');
                $this->response($response, 400);
            }
        }
    }
    
    function doctorAppointmentList_post() {

        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {
            $userId = isset($_POST['userId']) ? $this->input->post('userId')          : '';
            $correctSlot = 0;
           
            if($correctSlot){
                $unique_id = 'doc'. $userId . time();
                $data = array(
                    'doctorAppointment_unqId' => $unique_id,
                    'doctorAppointment_specialitiesId' => $specialitiesId,
                    'doctorAppointment_date' => $preferedDate,
                    'doctorAppointment_session' => $session,
                    'doctorAppointment_pntUserId' => $userId,
                    'doctorAppointment_memberId' => $memberId,
                    'doctorAppointment_doctorUserId' => $doctorUserId,
                    'doctorAppointment_doctorParentId' => $parentId,
                    'doctorAppointment_ptRmk' => $remark,
                    'doctorAppointment_finalTiming' => $preferedTimeId,
                    'creationTime' => time(),
                    'status' => 1
                );
                $response = $this->doctorBooking_model->bookAppointment('qyura_doctorAppointment',$data);
                
                if ($response) {
                    $response = array('status' => TRUE, 'message' => 'Your Doctor Appointment request has been received. You will receive a confirmation email or SMS shortly. You can also call the Medical Institution directly to know its status.');
                    $this->response($response, 200);
                } else {
                    $response = array('status' => FALSE,'message'=>'Something went wrong, please re-try for your appointment!');
                    $this->response($response, 400);
                }
                
            } else {
                $response = array('status' => FALSE,'message'=>'Please provide the correct time slot!');
                $this->response($response, 400);
            }
        }
    }
    
    function doctorAppointmentDetails_post() {
        

        $this->bf_form_validation->set_rules('orderId', 'Appointment Id', 'xss_clean|numeric|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {
            $orderId = isset($_POST['orderId']) ? $this->input->post('orderId')   : '';
            $response = $this->doctorBooking_model->getBookedAppointment($orderId);
                
            if (isset($response) && $response !=NULL) {
                $response = array('status' => TRUE, 'message' => 'Here is the appointment Detail.',"result"=>$response);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE,'message'=>'Something went wrong, please re-try for your appointment details!');
                $this->response($response, 400);
            }
        }
    }
     
    
    function cancleAppointment_post(){
        
        $moduleId = 3;
        
        $this->bf_form_validation->set_rules('appointmentId','Appointment Id','xss_clean|required|trim'); 
        $this->bf_form_validation->set_rules('userId','User Id','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('bookingDate','Appointment date','xss_clean|required|valid_date[y-m-d,-]|trim');
        $this->bf_form_validation->set_rules('time','Appointment time','xss_clean|required|trim');
        
        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $appointmentId  = isset($_POST['appointmentId'])    ? $this->input->post('appointmentId')                   : '';
            $bookingDate    = isset($_POST['bookingDate'])      ? strtotime($this->input->post('bookingDate'))          : '';
            $bookTime       = isset($_POST['time'])             ? date("H:i:s",strtotime($this->input->post('time')))   : '';
            $userId         = isset($_POST['userId'])           ? $this->input->post('userId')                          : '';
            
            $date = strtotime(date("Y-m-d"));
            $time = date("H:i:s", strtotime('+2 hours'));
            
            if($date > $bookingDate){
                $response = array('status' => FALSE, 'message' => 'You cannot cancle pre-date appointment!' );
                $this->response($response, 400);
                return;
            } elseif($time < $bookTime){
                
                $response = array('status' => FALSE, 'message' => 'You exceed the time for cancelling the appointment!!');
                $this->response($response, 400);
                return;
            }else{
                $where = array('doctorAppointment_unqId' => $appointmentId);
                $data = array('doctorAppointment_deleted' => 1);
                $currentDate = strtotime(date("Y-m-d"));
                
                $response = $this->doctorBooking_model->editAppointment("qyura_doctorAppointment",$data,$where);

                if ($response ) {
                    
                    $crnMsg    =  $this->lang->line("appointmentCancelledTag");
                    $cronArray = array("qyura_fkModuleId" => $moduleId, "qyura_fkUserId" => $userId, "qyura_cronMsg" => $crnMsg, "qyura_cronTitle" => $this->lang->line("appointmentCancelledTag"), "qyura_fkItemId" => $appointmentId,"qyura_cronDate"=>$currentDate,"qyura_cronMsgsCreation"=>$currentDate);

                    $options = array(
                        'data' => $cronArray,
                        'table' => 'qyura_cronMsgs'
                    );

                    $cronId = $this->common_model->customInsert($options);
                    
                    $response = array('status' => TRUE, 'message' => 'Appointment cancelled successfully!');
                    $this->response($response, 200);
                } else {
                    $response = array('status' => FALSE, 'message' => 'Appointment already cancelled !' );
                    $this->response($response, 400);
                }
            }
            
        }
    }
    
    function _check_date($str_in = '')
    {
        $currentDate = strtotime(date("y-m-d"));
        $prfDate = strtotime($str_in);
        if ($prfDate >= $currentDate) {
            return true;
        } else {
            $this->bf_form_validation->set_message('_check_date', 'Please select post date for booking!!');
            return false;
        }
    }
    
    

    
}   
