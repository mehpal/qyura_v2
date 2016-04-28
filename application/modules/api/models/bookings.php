<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Bookings extends MyRest
{
    protected static $defaultFormParams = array(
        'formClass' => '',
        'formId' => 'payu-payment-form',
        'submitClass' => '',
        'submitId' => '',
        'submitContent' => '',
        'submitTarget' => '_blank'
    );
    
    public function __construct() {
        parent::__construct();
        $this->_moduleId = 2;
        $this->lang->load("vendorAPI","english");
    }
    
    public function bookingList_post() {  
        
        $this->form_validation->set_rules($this->lang->line("userId"), $this->lang->line("userIdName"),'required|xss_clean');
        
        if($this->form_validation->run() == FALSE)  {
            $responce =  array('status'=>0,'errors'=>ajax_validation_errors());
            echo json_encode($responce);
        }
        else  {
            
            $userId = $_POST[$this->lang->line("userId")];
            $type = (isset($_POST['type']) && $_POST['type'] != NULL) ? $_POST['type'] : 1 ;
            
            $notIn = isset($_POST[$this->lang->line("notIn")]) ? $_POST[$this->lang->line("notIn")] : "";
            $notIn = explode(',', $notIn);

            $aoClumns = array("bookingid","centerName","centerContact","serviceId","serviceName","userName","userEmail","userNumber","imUrl","date","status","fkCityServiceId","fkVenderId","fkCityId","time","note","price");
            $this->db->select('bookingid,centerName,centerContact,serviceId,serviceName,userBooking.name,userBooking.mobile,userBooking.email,bookingDate,documentLink,bookingStatus,userBooking.fkCityServiceId,timeSlotName,timeRange,cityService.fkCityId,cityService.fkVenderId',"note","price")

                    ->from('userBooking')
                    ->join('cityService', 'cityService.cityServiceId = userBooking.fkCityServiceId', 'inner')
                    ->join('vendorMaster',"vendorMaster.vendorId=cityService.fkVenderId",'inner')
                    ->join('services', 'services.serviceId=cityService.fkServiceId','inner')
                    ->join('venderDocuments', 'venderDocuments.fkCityServiceId=userBooking.fkCityServiceId   AND venderDocuments.docType = 1','left')
                    ->join('timeRangeMaster', 'timeRangeMaster.timeid=userBooking.fkTimeSlotId','left')
                    
                    ->where(array('userBooking.fkUserId' => $userId,'userBooking.bookingType' => $type,"userBooking.deleted"=>0))
                    ->where_not_in('userBooking.bookingid', $notIn)
                    ->order_by('bookingDate,timeRange' , 'DESC')
                    ->group_by('bookingid');

            $response = $this->db->get()->result();
            $finalResult = array();
            
            if (!empty($response)) {
                foreach ($response as $row) {
                    
                    $finalTemp = array();
                    $status = isset($row->bookingStatus)? $row->bookingStatus : "";
                    
                    if($status == 1) { 
                        $status = "Confirmed"; 
                    }elseif($status == 2){
                        $status = "Pending";
                    }elseif ($status == 3) {
                        $status = "Cancled";
                    }else{
                        $status = "Pending";
                    }
                    
                    $time = isset($row->timeRange) ? $row->timeRange : "";
                    $date = isset($row->bookingDate) ? date("l\, d F Y",strtotime($row->bookingDate)) : "";
                    
                    $isImage = isset($row->documentLink) ? $row->documentLink : "";
                    if($isImage == ""){
                        $options = array(
                            'table' => 'venderDocuments',
                            'where' => array('venderDocuments.deleted' => 0,'venderDocuments.enabled' => 1,'venderDocuments.docType' => 1,'venderDocuments.fkVendorId' => $row->fkVenderId),
                            'limit' =>1,
                            "single"=>1
                        );
                        $venderDocumentsImages = $this->cm->customGet($options);
                        if(isset($venderDocumentsImages) && $venderDocumentsImages != NULL){
                            $isImage = $venderDocumentsImages->documentLink;
                        }
                    }
                    
                    $finalTemp[] = isset($row->bookingid) ? $row->bookingid : "";
                    $finalTemp[] = isset($row->centerName) ? $row->centerName : "";
                    $finalTemp[] = isset($row->centerContact) ? $row->centerContact : "";
                    $finalTemp[] = isset($row->serviceId) ? $row->serviceId : "";
                    $finalTemp[] = isset($row->serviceName) ? $row->serviceName : "";
                    $finalTemp[] = isset($row->name) ? $row->name : "";
                    $finalTemp[] = isset($row->email) ? $row->email : "";
                    $finalTemp[] = isset($row->mobile) ? $row->mobile : "";
                    $finalTemp[] = $isImage;
                    $finalTemp[] = $date;
                    $finalTemp[] = $status;
                    $finalTemp[] = isset($row->fkCityServiceId) ? $row->fkCityServiceId : "";
                    $finalTemp[] = isset($row->fkVenderId) ? $row->fkVenderId : "";
                    $finalTemp[] = isset($row->fkCityId) ? $row->fkCityId : "";
                    $finalTemp[] = $time;
                    $finalTemp[] = isset($row->note) ? $row->note : "";
                   
                    $finalResult[] = $finalTemp;
                }
            }

            if (!empty($finalResult)) {
                $response1['msg'] = $this->lang->line("bookingSuccessMsg");
                $response1['status'] = 1;
                $response1['result'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = $this->lang->line("bookingFailMsg");
                $response1['status'] = 0;
                $this->response($response1, 404);
            }
        }
    }
    
    public function makeTrail_post() {
        
        $this->form_validation->set_rules($this->lang->line("cityServiceId"), $this->lang->line("cityServiceIdName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("timeSlot"),$this->lang->line("timeSlotName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("userId"),$this->lang->line("userIdName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("mobileNo"),$this->lang->line("mobileNoName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("email"),$this->lang->line("emailName"),'required|email|xss_clean');
        $this->form_validation->set_rules($this->lang->line("userName"),$this->lang->line("usernameName"),'required|email|xss_clean');
        $this->form_validation->set_rules($this->lang->line("bookingDate"),$this->lang->line("bookingDate"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("vendorName"),$this->lang->line("vendorName"),'required|xss_clean');
        
        if($this->form_validation->run() == FALSE) {
            
            $responce =  array('status'=>0,'message'=>ajax_validation_errors());
            echo json_encode($responce);
            
        } else{
             
            $cityServiceId  = $insertData["fkCityServiceId"]        = $_POST[$this->lang->line("cityServiceId")];
            $userId         = $insertData["fkUserId"]               = $_POST[$this->lang->line("userId")];
            $phone          = $insertData["mobile"]                 = $_POST[$this->lang->line("mobileNo")];
            $email          = $insertData["email"]                  = $_POST[$this->lang->line("email")];
            $userName       = $insertData["name"]                   = $_POST[$this->lang->line("userName")];
            $vendorName     = $_POST[$this->lang->line("vendorName")];
            
            $trail = 1;
            $trail = $this->checkTrialBookingbk($userId, $phone,$email,$cityServiceId);
            
            if($trail){
                
                $insertData["fkTimeSlotId"] = $slotId    = $_POST[$this->lang->line("timeSlot")];
                $insertData["note"]         = isset($_POST[$this->lang->line("note")]) ? $_POST[$this->lang->line("note")] : "";
                $insertData["bookingDate"]  =  $date = date("Y-m-d", strtotime($_POST[$this->lang->line("bookingDate")]));
                $insertData["createdAt"]    = date("Y-m-d");
                $insertData["bookingType"]  = 1;

                $slots = 1;
//                        $this->slotValidation($date,$slotId,$cityServiceId);
                if(!$slots){
                    $this->response(array("status"=>0,'message' => $this->lang->line('slotFalseMsg')),200);
                }else{
                    $option = array("table"=>"userBooking","data"=>$insertData);
//                    pre($option);die();
                    $bookingId = $this->cm->customInsert($option);

                    if ($bookingId) {
                        $crnMsg = $this->lang->line("bookingCreate");
                        $crnTag = $this->lang->line("bookingCreateTag");

                        $crnMsg = replaceStr($crnMsg, array("{centreName}"), array($vendorName));

                        $cronArray = array("fkModuleId"=>$this->_moduleId, "fkUserId"=>$userId, "cronMsg"=> $crnMsg, "cronTitle" => $crnTag,"fkItemId"=>$bookingId,'cronDate' => $date);

                        $options   =  array(
                            'data'  =>  $cronArray,
                            'table' =>  'cronMsgs'    
                        );
                        $cronId = $this->cm->customInsert($options);
                        $serviceOpt   =   array(
                            'select'    => 'email,name,timeSlotName,timeRange,fkCityServiceId,fkVenderId,centerEmail',    
                            'where'     => array("bookingId" => $bookingId),
                            'table'     => 'userBooking',
                            'single'    => TRUE,
                            'join' => array(
                                array('timeRangeMaster', 'timeRangeMaster.timeid=userBooking.fkTimeSlotId','left'),
                                array('cityService', 'cityService.cityServiceId=userBooking.fkCityServiceId','left'),
                                array('vendorMaster', 'vendorMaster.vendorId=cityService.fkVenderId','left'),
                            ),
                        );
                        $emailData = $this->cm->customGet($serviceOpt);
                        
                        $from = 'support@froyofit.com';
                        $to = $emailData->email;
                        $message = "Dear $emailData->name, 
                            
                                Your booking for ".$vendorName." has been successfully placed to ".$emailData->timeSlotName." ".$emailData->timeRange." ".$date.". 
                                Team Froyofit";
                        $this->cm->sendMail($from,$to,$message);
                        
//                        $from = 'support@froyofit.com';
//                        $to = $emailData->centerEmail;
//                        $message = "Dear $vendorName, 
//                            
//                                $emailData->name, has made a booking on ".$emailData->timeSlotName."-".$emailData->timeRange."-".$date.". 
//                                Team Froyofit";
//                        $this->cm->sendMail($from,$to,$message);
                        $this->response(array("status"=>1,'message' => $this->lang->line('bookingTrueMsg')),200);
                    } else {
                        $this->response(array("status"=>0,'message' => $this->lang->line('bookingFalseMsg')), 404);
                    }
                }
            }else{
                $this->response(array("status"=>0,'message' => $this->lang->line('bookingAlreadyMsg')), 404);
            }
        }
    }
    
    public function slotValidation($date,$slotId,$fkCityServiceId) {
       
        $day = date("l",strtotime($date));
        $key = array_search($day, $this->_days);
        
        $tbl = "serviceTimeSlot";
        $selcet= "id";
        $where = array("dayNumber"=>$key,"deleted"=>0,"fkCityServiceId"=>$fkCityServiceId);
        
        $slot = $this->cm->getData($tbl,$selcet,$where);
        $flag = 0;
        
        if(isset($slot) && $slot != NULL){
            foreach($slot as $s){
                if($s->id == $slotId){
                    $flag =  1;
                }else{
                    $flag = 0;
                }
            }
        }else{
            $flag = 0;
        }
        
        return $flag;
    }
    
    public function deleteTrial_post() {  

        $this->form_validation->set_rules($this->lang->line("bookingId"), $this->lang->line("bookingIdName"),'required|xss_clean');

        if($this->form_validation->run() == FALSE) { 
            $responce =  array('status'=>0,'errors'=>$this->lang->line("requiredInfo"));
            echo json_encode($responce);
        } else  {

            $bookingId = $_POST[$this->lang->line("bookingId")];

            $data['deleted'] = 1;
            $option = array(
                "table"=>"userBooking",
                "data"=>array("deleted"=>1),
                "where"=>array("userBooking.bookingId"=>$bookingId)
            );
            $update = $this->cm->customUpdate($option);
   //            echo $this->db->last_query();
            if($update){
		$serviceOpt   =   array(
                    'select'    => 'email,name,timeSlotName,timeRange,fkCityServiceId,fkVenderId,centerEmail,bookingDate,centerName',    
                    'where'     => array("bookingId" => $bookingId),
                    'table'     => 'userBooking',
                    'single'    => TRUE,
                    'join' => array(
                        array('timeRangeMaster', 'timeRangeMaster.timeid=userBooking.fkTimeSlotId','left'),
                        array('cityService', 'cityService.cityServiceId=userBooking.fkCityServiceId','left'),
                        array('vendorMaster', 'vendorMaster.vendorId=cityService.fkVenderId','left'),
                    ),
                );
                $emailData = $this->cm->customGet($serviceOpt);
                
                $from = 'support@froyofit.com';
                $to = $emailData->email;
                $message = "Dear $emailData->name, 
                        Your booking for ".$emailData->centerName." has been canceled by you. 
                            
                        Team Froyofit";
                $this->cm->sendMail($from,$to,$message);
                
//                $from = 'support@froyofit.com';
//                $to = $emailData->centerEmail;
//                $message = "Dear $emailData->centerName, 
//
//                        $emailData->name, has canceled a booking on ".$emailData->timeSlotName." ".$emailData->timeRange." ".$emailData->bookingDate.". 
//                        Team Froyofit";
//                $this->cm->sendMail($from,$to,$message);
                $response1['msg'] = $this->lang->line("bookingDeletedMsg");
                $response1['status'] = 1;
                $this->response($response1, 200); 
            }else {
                $response1['msg'] = $this->lang->line("bookingNotDeletedMsg");
                $response1['status'] = 0;
                $this->response($response1, 404);
            }
        }
    }

    public function reScheduleTrial_post() {  

        $this->form_validation->set_rules($this->lang->line("bookingId"),$this->lang->line("bookingIdName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("bookingDate"),$this->lang->line("bookingDateName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("timeSlot"),$this->lang->line("timeSlotName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("note"),$this->lang->line("noteName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("userId"),$this->lang->line("userIdName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("vendorName"),$this->lang->line("vendorName"),'required|xss_clean');
                    
        if($this->form_validation->run() == FALSE) { 
            $responce =  array('status'=>0,'errors'=>$this->lang->line("requiredInfo"));
            echo json_encode($responce);
        } else  {
            $vendorName = $_POST[$this->lang->line("vendorName")];
            $userId = $_POST[$this->lang->line("userId")];
            $bookingId = $_POST[$this->lang->line("bookingId")];
            $bookingData = array();
            
            if(isset($_POST[$this->lang->line("bookingDate")]) && $_POST[$this->lang->line("bookingDate")] != ""){
                $bookingData['bookingDate'] = $date = date("Y-m-d",strtotime($_POST[$this->lang->line("bookingDate")])) ;
            }
            if(isset($_POST[$this->lang->line("timeSlot")]) && $_POST[$this->lang->line("timeSlot")] != ""){
                $bookingData['fkTimeSlotId'] = $_POST[$this->lang->line("timeSlot")] ;
            }
            if(isset($_POST[$this->lang->line("note")]) && $_POST[$this->lang->line("note")] != ""){
                $bookingData['note'] = $_POST[$this->lang->line("note")] ;
            }

            $option = array(
                "table"=>"userBooking",
                "data"=>$bookingData,
                "where"=>array("userBooking.bookingId"=>$bookingId)
            );
            $update = $this->cm->customUpdate($option);
            if($update){
                $crnMsg = $this->lang->line("bookingReschedule");
                $crnTag = $this->lang->line("bookingRescheduleTag");

                $crnMsg = replaceStr($crnMsg, array("{centreName}","{Date}"), array($vendorName,$date));

                $cronArray = array("fkModuleId"=>$this->_moduleId, "fkUserId"=>$userId, "cronMsg"=> $crnMsg, "cronTitle" => $crnTag,"fkItemId"=>$bookingId,'cronDate' => $date);

                $options   =  array(
                    'data'  =>  $cronArray,
                    'table' =>  'cronMsgs'    
                );
                $cronId = $this->cm->customInsert($options);
                $serviceOpt   =   array(
                    'select'    => 'email,name,timeSlotName,timeRange,fkCityServiceId,fkVenderId,centerEmail',    
                    'where'     => array("bookingId" => $bookingId),
                    'table'     => 'userBooking',
                    'single'    => TRUE,
                    'join' => array(
                        array('timeRangeMaster', 'timeRangeMaster.timeid=userBooking.fkTimeSlotId','left'),
                        array('cityService', 'cityService.cityServiceId=userBooking.fkCityServiceId','left'),
                        array('vendorMaster', 'vendorMaster.vendorId=cityService.fkVenderId','left'),
                    ),
                );
                $emailData = $this->cm->customGet($serviceOpt);
                
                $from = 'support@froyofit.com';
                $to = $emailData->email;
                $message = "Dear $emailData->name, 
                        Your booking for ".$vendorName." has been successfully rescheduled to ".$emailData->timeSlotName." ".$emailData->timeRange." ".$date.". 
                        Team Froyofit";
                $this->cm->sendMail($from,$to,$message);
                
//                $from = 'support@froyofit.com';
//                $to = $emailData->centerEmail;
//                $message = "Dear $vendorName, 
//
//                        $emailData->name, has rescheduled a booking on ".$emailData->timeSlotName." ".$emailData->timeRange." ".$date.". 
//                        Team Froyofit";
//                $this->cm->sendMail($from,$to,$message);

                $response1['msg'] = $this->lang->line("bookingReMsg");
                $response1['status'] = 1;
                $this->response($response1, 200); 
            }else {
                $response1['msg'] = $this->lang->line("bookingReNotMsg");
                $response1['status'] = 0;
                $this->response($response1, 404);
            }
        }
    }
    
    public function filter_post() {  
        
        $this->form_validation->set_rules($this->lang->line("latitude"), $this->lang->line("latitudeName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("longitude"),$this->lang->line("longitudeName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("serviceId"),$this->lang->line("serviceIdName"),'required|xss_clean');
        $this->form_validation->set_rules($this->lang->line("cityId"), $this->lang->line("cityIdName"),'required|xss_clean');
        
        if($this->form_validation->run() == FALSE) { 
            $responce =  array('status'=>0,'errors'=>$this->lang->line("requiredInfo"));
            echo json_encode($responce);
        } else  {
            
            $bookingData = array();
            $lat  = isset($_POST[$this->lang->line("latitude")]) ? trim($_POST[$this->lang->line("latitude")]) : '22.768430';
            $long = isset($_POST[$this->lang->line("longitude")]) ? trim($_POST[$this->lang->line("longitude")]) : '75.895702';

//            $where = array('cityService.deleted' => 0,'vendorMaster.deleted' => 0);
            $where = " WHERE cityService.deleted = 0 AND vendorMaster.deleted = 0";
            $having = NULL;
            if(isset($_POST[$this->lang->line("cityId")]) && $_POST[$this->lang->line("cityId")] != ""){
                $bookingData['cityId']         = $_POST[$this->lang->line("cityId")];
                $where .= " AND cityService.fkCityId = ".$bookingData['cityId'];
            }
            if(isset($_POST[$this->lang->line("serviceId")]) && $_POST[$this->lang->line("serviceId")] != ""){
                $bookingData['serviceId']         = $_POST[$this->lang->line("serviceId")] ;
                $where .= " AND cityService.fkServiceId = ".$bookingData['serviceId'];
            }
            if(isset($_POST[$this->lang->line("distance")]) && $_POST[$this->lang->line("distance")] != ""){
                $bookingData['distance']         = $_POST[$this->lang->line("distance")] ;
                $having = " HAVING distance <= ".$bookingData['distance'];
            }
            if(isset($_POST[$this->lang->line("rating")]) && $_POST[$this->lang->line("rating")] != ""){
                $bookingData['rating']            = $_POST[$this->lang->line("rating")] ;
                $where .= " AND cityService.rating >= ". $bookingData['rating'];
            }
            
            $Ujoin = $Uselect =  "";
            if(isset($_POST[$this->lang->line("userId")]) && $_POST[$this->lang->line("userId")] != ""){
                if(isset($_POST[$this->lang->line("favorite")]) && $_POST[$this->lang->line("favorite")] != ""){
                    $bookingData['favorite']  = $_POST[$this->lang->line("favorite")] ;
                    $bookingData['userId']    = $_POST[$this->lang->line("userId")] ; 
                    $where .= ' AND favorite = '.$bookingData['favorite'];
                    $where .= ' AND fkUserId = '.$bookingData['userId'];
                    $Ujoin .= " JOIN review on review.fkVenderId=vendorMaster.vendorId ";
                }
            }
            
            if(isset($_POST[$this->lang->line("range")]) && $_POST[$this->lang->line("range")] != ""){
                $bookingData['range'] = $range = $_POST[$this->lang->line("range")] ;
                switch($range){
                    case 1:
                        $where .=" AND discountAmt <= 100 ";
                        break;
                    case 2:
                        $where .=" AND discountAmt <=  501 ";
                        break;
                    case 3:
                        $where .=" AND discountAmt between 500 AND 1001 ";
                        break;
                    case 4:
                        $where .=" AND discountAmt >= 1000 ";
                        break;
                }
                
                $Ujoin .= " JOIN serviceCharges on serviceCharges.fkCityServiceId = cityService.cityServiceId ";
                $Uselect .= " ,chargeLable,discount,price,discountAmt ";
            }
            
            $tbl = "cityService";  
            $join = " JOIN vendorMaster on vendorMaster.vendorId=cityService.fkVenderId "
                  . " LEFT JOIN venderDocuments on venderDocuments.fkCityServiceId=cityService.cityServiceId  AND venderDocuments.docType = 1 AND venderDocuments.deleted = 0 ".$Ujoin;
            
            $select = " cityService.rating, cityServiceId,vendorId,centerName,centerAdd,latitude,longitude,documentLink,(3959 * acos(cos(radians('". $lat ."')) * cos(radians(latitude)) * cos(radians(longitude) - radians('". $long ."')) + sin(radians('". $lat ."')) * sin(radians(latitude)))) AS distance ".$Uselect;
            
            $sql = "SELECT ".$select." FROM " .$tbl.$join.$where." GROUP BY cityService.cityServiceId ".$having;
            
            $res = $this->db->query($sql)->result();
// echo $this->db->last_query();
            $responce = $result =  NULL;
            if(isset($res) & $res != NULL){            
 
                foreach($res as $rs){
//                    pre($rs);
                    $result["rating"] = (isset($rs->rating) && $rs->rating != NULL) ? $rs->rating : "" ;
                    $result["cityServiceId"] = (isset($rs->cityServiceId) && $rs->cityServiceId != NULL) ? $rs->cityServiceId:"" ;
                    $result["vendorId"] = (isset($rs->vendorId) && $rs->vendorId != NULL) ? $rs->vendorId : "" ;
                    $result["centerName"] = (isset($rs->centerName) && $rs->centerName != NULL) ? $rs->centerName : "" ;
                    $result["centerAdd"] = (isset($rs->centerAdd) && $rs->centerAdd != NULL) ? $rs->centerAdd : "" ;
                    $result["latitude"] = (isset($rs->latitude) && $rs->latitude != NULL) ? $rs->latitude : "" ;
                    $result["longitude"] = (isset($rs->longitude) && $rs->longitude != NULL) ? $rs->longitude : "" ;
                    $result["documentLink"] = (isset($rs->documentLink) && $rs->documentLink != NULL) ? $rs->documentLink : "" ;
                    $result["chargeLable"] = (isset($rs->chargeLable) && $rs->chargeLable != NULL) ? $rs->chargeLable : "" ;
                    $result["discount"] = (isset($rs->discount) && $rs->discount != NULL) ? $rs->discount : "" ;
                    $result["price"] = (isset($rs->price) && $rs->price != NULL) ? $rs->price : "" ;
                    $result["discountAmt"] = (isset($rs->discountAmt) && $rs->discountAmt != NULL) ? $rs->discountAmt : "" ;
                    $result["distance"] = (isset($rs->distance) && $rs->distance != NULL) ? $rs->distance : "" ;
                    $responce[] = $result;
                }
            }
            
//            pre($responce);
            if (!empty($responce)) {
                $this->response(array("status"=>1,"result"=>$responce,'message' => $this->lang->line('vendorSuccessMsg')),200);
            } else {
                $this->response(array("status"=>0,'message' => 'No service found as per filter criteria!!'), 404);
            }
        }      
    }

    public function makeAppointment_post() {    
//        
//        $this->form_validation->set_rules($this->lang->line("cityServiceId"), $this->lang->line("cityServiceIdName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("timeSlot"),$this->lang->line("timeSlotName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("userId"),$this->lang->line("userIdName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("mobileNo"),$this->lang->line("mobileNoName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("email"),$this->lang->line("emailName"),'required|email|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("bookingDate"),$this->lang->line("bookingDate"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("package"),$this->lang->line("packageName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("bookingDate"),$this->lang->line("bookingDate"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("userName"),$this->lang->line("usernameName"),'required|xss_clean');
//        $this->form_validation->set_rules($this->lang->line("vendorName"),$this->lang->line("vendorName"),'required|xss_clean');
//        $this->form_validation->set_rules("packageName","packageName",'required|xss_clean');
//        $this->form_validation->set_rules("price","price",'required|xss_clean');
//        
//        if($this->form_validation->run() == FALSE) {
//            $responce =  array('status'=>0,'message'=>ajax_validation_errors());
//            echo json_encode($responce);
//        } else{
//             
//            $cityServiceId  = $insertData["fkCityServiceId"]    = $_POST[$this->lang->line("cityServiceId")];
//            $userId         = $insertData["fkUserId"]           = $_POST[$this->lang->line("userId")];
//            $phone          = $insertData["mobile"]             = $_POST[$this->lang->line("mobileNo")];
//            $email          = $insertData["email"]              = $_POST[$this->lang->line("email")];
//            $vendorName     = $_POST[$this->lang->line("vendorName")];
//            $packageName        = $insertData["packageName"]              = $_POST[$this->lang->line("packageName")];
//            $package        = $insertData["package"]              = $_POST[$this->lang->line("package")];
//            $price          = $insertData["price"]              = $_POST["price"];
//            
//            $trail = 1;
////            $trail = $this->checkTrialBookingbk($userId, $phone,$email,$cityServiceId);
//            
//            if($trail){
//                
        
        $cityServiceId  = $insertData["fkCityServiceId"]   ="198";
        $userId         = $insertData["fkUserId"]           = "4";
        $phone          = $insertData["mobile"]             = "09876543211";
        $email          = $insertData["email"]              = "sd.mobileappz@gmail.com";
        $vendorName     = "Star Gym ";
        $packageName        = $insertData["packageName"]              ="Per Month";
        $package        = $insertData["package"]              = "226";
        $price          = $insertData["price"]              = "200";

        
        $insertData["fkTimeSlotId"]   = $slotId    = 1;
        $insertData["note"]           = isset($_POST[$this->lang->line("note")]) ? $_POST[$this->lang->line("note")] : "";
        $insertData["bookingDate"]    =  $date = "2016-03-02";
        $insertData["createdAt"]      = date("Y-m-d");
        $insertData["bookingType"]    = 0;
        $insertData["deleted"]        = 1;
        $insertData["bookingStatus"]  = 2;

//                $insertData["fkTimeSlotId"]   = $slotId    = $_POST[$this->lang->line("timeSlot")];
//                $insertData["note"]           = isset($_POST[$this->lang->line("note")]) ? $_POST[$this->lang->line("note")] : "";
//                $insertData["bookingDate"]    =  $date = date("Y-m-d", strtotime($_POST[$this->lang->line("bookingDate")]));
//                $insertData["createdAt"]      = date("Y-m-d");
//                $insertData["bookingType"]    = 0;
//                $insertData["deleted"]        = 1;
//                $insertData["bookingStatus"]  = 2;

                $slots = 1;
//              $this->slotValidation($date,$slotId,$cityServiceId);
                if(!$slots){
                    $this->response(array("status"=>0,'message' => $this->lang->line('slotFalseMsg')),200);
                }else{
                    $option = array("table"=>"userBooking","data"=>$insertData);
                    $bookingId = $this->cm->customInsert($option);
                    
                    echo $prod