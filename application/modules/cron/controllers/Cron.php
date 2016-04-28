<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends MY_Controller {
    protected $device = array();
    protected $title = '';
    protected $msg = '';
    protected $push = '';


    public function __construct() {
        /// -- Create Database Connection instance --
        parent::__construct();
        $this->_moduleId = 3; 
        
        $this->load->model('api/HealthTip_model');
        $this->load->model('cronMessage_model');
        $this->lang->load("cronMsg","english");
         
        $this->load->helper('string');
        $this->load->helper('Autoload');
        $this->load->library('ios');
        $this->load->library('gcm');
        $this->load->helper('path');
        $this->load->helper('directory'); 
        
    }	 
    
    public function index() {
        
        $tbl = "qyura_cronMsgs";
        $orderBy = "qyura_cronMsgs.qyura_cronDate";
        $con = array('qyura_cronMsgs.qyura_cronFlag'=>0,"qyura_userSocial.userSocial_notification"=>1); 
        $joinU[] = array('table'=>"qyura_patientDetails",'relation'=>"qyura_patientDetails.patientDetails_usersId = qyura_cronMsgs.qyura_fkUserId AND patientDetails_deleted = 0 ",'type'=>'inner');
        $joinU[] = array('table'=>"qyura_modules",'relation'=>"qyura_modules.qyura_moduleId = qyura_cronMsgs.qyura_fkModuleId",'type'=>'LEFT');
        $joinU[] = array('table'=>"qyura_userSocial",'relation'=>"qyura_userSocial.userSocial_usersId = qyura_cronMsgs.qyura_fkUserId",'type'=>'LEFT');
        
        $data['crons'] = $crons = $this->cronMessage_model->getData($tbl,NULL,$con,$orderBy,null,$joinU);
//        echo $this->db->last_query();
        
        $iosArray = $androidArray = array();
        $iosFlag = $andFlag = 0;
        $userArray = array();
        if(isset($crons) && $crons != NULL) {
            foreach($crons as $n){
              $tags = json_decode($n->qyura_multiObject);
               $subtype = (isset($tags->subType) && $tags->subType != "") ? $tags->subType : "0"; 
              //die();
                if($n->patientDetails_usersId != 0){
                    switch ($n->userSocial_device){
                        case "2":
                            if($n->userSocial_pushToken != ""){
                                $iosFlag = 1;
                                $regIos  = $n->userSocial_pushToken;
                                $iosArray[] = array("title"=>$n->qyura_cronTitle,'msg'=>$n->qyura_cronMsg,"module_id"=>$n->qyura_fkModuleId,"item_id"=>$n->qyura_fkItemId,"device"=>$regIos, "cronMsgId"=>$n->qyura_cronMsgId,"subtype"=>$subtype);
                                break;
                            }
                        case "1":
                            if($n->userSocial_pushToken != ""){
                                $andFlag = 1;
                                $regAnd  = $n->userSocial_pushToken;
                                $androidArray[] = array("title"=>$n->qyura_cronTitle,'msg'=>$n->qyura_cronMsg,"module_id"=>$n->qyura_fkModuleId,"item_id"=>$n->qyura_fkItemId,"device"=>$regAnd, "cronMsgId"=>$n->qyura_cronMsgId,"subtype"=>$subtype);
//                                $androidArray[] = array("moduleId"=>$n->moduleId,"itemId"=>$n->fkItemId,"title"=>$n->cronTitle,'msg'=>$n->cronMsg,"device"=>$regAnd, "cronMsgId"=>$n->cronMsgId);
                                break;
                            }
                    }
                }
                        
            }
                        
//            if(count($iosArray)){
//                $this->ios->sendPush($iosArray);
//            }
//            print_r($androidArray);
            if(count($androidArray)){
             //   print_r($androidArray);
                $this->gcm->sendPush($androidArray);
            }
//            $updateOptions = array(
//                'where' => array('cronFlag' => 0),
//                'data' => array('cronFlag'=>1),
//                'table' => 'cronMsgs'
//            );
//            $id = $this->common_model->customUpdate($updateOptions);
        }
    }
    
    public function cronJob() {
	
        $iosArray   =   $androidArray = array();
        if (isset($crons) && $crons != NULL) {
            
            foreach ($crons as $p) {
                if ($p->fkUserId == 0) {
                    $tbl = $dbName.".location";
                    $con = array('location.deleted' => 0, 'location.locationId' => 1);
                        
                    $location = $this->common_model->getData($tbl, NULL, $con, NULL, NULL, NULL, NULL, TRUE);

                    if (isset($location) && $location != NULL) {
                        
                        foreach ($location as $l) {

                            $DB =  $this->load->database($l->locationName, TRUE);
                            $this->db = $DB;
 echo                           $tbl = "users";
                            $con = array('users.deleted' => 0, 'users.pushToken <> ' => "");
                            $select = array("users.pushToken, users.deviceId, users.userId");
                            $user = $this->common_model->getData($tbl, NULL, $con, NULL, NULL, NULL, NULL, TRUE);
                            
                            if (isset($user) && $user != NULL) {
                                foreach ($user as $u) {
                                    pre($u->email);
                                    if($u->deviceType == 1 && $u->pushToken != ""){
                                        $iosFlag = 1;
                                        $regIos  = $u->pushToken;
                                        $iosArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->fkModuleId,"device"=>$regIos, "cronMsgId"=>$p->cronMsgId);

                                    }elseif($u->deviceType == 0 && $u->pushToken != ""){
                                        $andFlag = 1;
                                        $regAnd  = $u->pushToken;
                                        $androidArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->fkModuleId, "device"=> $regAnd,"cronMsgId"=>$p->cronMsgId);
                                    }
                                }
                            }
                        }
                    }
                } else {
                    if($p->deviceType == 1 && $p->pushToken != ""){
                        $iosFlag = 1;
                        $regIos  = $p->pushToken;
                        $iosArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->fkModuleId,"device"=>$regIos, "cronMsgId"=>$p->cronMsgId);

                    }elseif($p->deviceType == 0 && $p->pushToken != ""){
                        $andFlag = 1;
                        $regAnd  = $p->pushToken;
                        $androidArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->fkModuleId, "device"=> $regAnd,"cronMsgId"=>$p->cronMsgId);
                    }
                }
                
//              $msgArray[] = array("title" => $p->cronTitle, 'msg' => $p->cronMsg, "type" => $p->fkModuleId, "device" => $reg, "cronMsgId" => $p->cronMsgId);
            }

            $this->load->database(SITELOCATION, TRUE);
            
            if(count($iosArray)){
                $this->ios->sendPush($iosArray);
            }
            if(count($androidArray)){
                $this->gcm->sendPush($androidArray);
            }
            
            $updateOptions = array(
                'where' => array('cronFlag' => 0),
                'data' => array('cronFlag'=>1),
                'table' => 'cronMsgs'
            );
            $id = $this->common_model->customUpdate($updateOptions);
            
//            $this->ios->sendPush($msgArray);
        }
    }

    public function healthTimeCheck() {
        
        $currentTime    =   $time();
        $cronStrtTime   =   strtotime("05:00:00");
        $cronEndTime    =   strtotime("05:30:00");
        $date = strtotime(date("Y-m-d"));
        
        if($currentTime <= $cronStrtTime && $cronEndTime <= $currentTime){
            $tip = $this->HealthTip_model->get($city, $date);
        }
        
        $tbl = "cronMsgs";
        $orderBy = "cronMsgs.cronDate";
        $con = array('cronMsgs.cronFlag' => 0);
        $joinU[1] = array('table' => "modules", 'relation' => "modules.moduleId=cronMsgs.fkModuleId", 'type' => 'LEFT');

        $data['crons'] = $crons = $this->common_model->getData($tbl, NULL, $con, $orderBy, null, $joinU);

        $msgArray = array();

        if (isset($crons) && $crons != NULL) {
            foreach ($crons as $p) {

                if ($p->fkUserId == 0) {

                    $tbl = "users";
                    $con = array('users.deleted' => 0, 'users.pushToken <> ' => "");
                    $select = array("users.pushToken, users.deviceId, users.userId");
                    $user = $this->common_model->getData($tbl, NULL, $con, NULL, NULL, NULL, NULL, TRUE);
                    if (isset($user) && $user != NULL) {
                        foreach ($user as $u) {
                            $reg = $u->pushToken;
                            array_push($this->device, $reg);
                        }
                    }
                    $msgArray[] = array("title" => $p->cronTitle, 'msg' => $p->cronMsg, "type" => $p->fkModuleId, "device" => $reg, "cronMsgId" => $p->cronMsgId);
                }
            }
            $this->ios->sendPush($msgArray);
        }
    }

    public function check() {

        $host = "mappz.co"; //servername or IP
        $ports = array(21, 22, 25, 80, 110, 443, 1433, 3306, 2195, 2196); //Ports need to be checked

        foreach ($ports as $port) {
            $connection = @fsockopen($host, $port);

            if (is_resource($connection)) {
                echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . '\n';

                fclose($connection);
            } else {
                echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . '\n';
            }
        }
    }

}
