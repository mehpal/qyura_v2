<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CronMessages extends MY_Controller {
    protected $device = array();
    protected $title = '';
    protected $msg = '';
    protected $push = '';


    public function __construct() {
        /// -- Create Database Connection instance --
        parent::__construct();
        $this->_moduleId = 3; 
        
        $this->load->model('api/HealthTip_model');
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
        $orderBy = "qyura_cronMsgs.cronDate";
        $con = array('qyura_cronMsgs.cronFlag'=>0); 
        $joinU[0] = array('table'=>"qyura_patientDetails",'relation'=>"qyura_patientDetails.patientDetails_usersId = qyura_cronMsgs.qyura_fkUserId AND patientDetails_deleted != 0 ",'type'=>'inner');
        $joinU[1] = array('table'=>"qyura_modules",'relation'=>"qyura_modules.qyura_moduleId = qyura_cronMsgs.qyura_fkModuleId",'type'=>'LEFT');
        
        $data['crons'] = $crons = $this->common_model->getData($tbl,NULL,$con,$orderBy,null,$joinU);
        pre($data);die();
        
        $iosArray = $androidArray = array();
        $iosFlag = $andFlag = 0;
        $userArray = array();
        if(isset($crons) && $crons != NULL) {
            foreach($crons as $p){
                if($p->fkUserId == 0){
                    switch ($p->fkItemId){
                        case "13":
                            $tbl = "notice";
                            $select = "notice.noticeId, notice.userBelongsto ";
                            $con = array('notice.deleted'=>0,'notice.noticeId'=>$cronMsg->fkItemId);
                        
                            $notice = $this->common_model->getData($tbl,$select,$con,NULL,NULL,NULL,NULL,FALSE);
                            
                            if(isset($notice) && $notice != NULL) {
                                
                                $n = (array)$notice;
                                
                                $ubt = explode(",", $notice->userBelongsto);
                                
                                if (in_array(1, $ubt)) {
                                        
                                    $con = array('noticeGroups.fkNoticeId' => $notice->noticeId);
                                    $joinU[0] = array('table'=>"noticeGroups",'relation'=>"noticeGroups.userId=cronMsgs.fkUserId",'type'=>'LEFT'); 
                                    $joinU[1] = array('table'=>"users",'relation'=>"users.userId=cronMsgs.fkUserId",'type'=>'LEFT');
                                    $noticeGroup = $this->noticeboard->getNoticeGroups($con);
                                    
                                    if (isset($noticeGroup) && $noticeGroup != NULL) {
                                        foreach ($noticeGroup as $ng) {
                                            $noticeRow[] = $ng->fkGroupId;
                                        }
                                    } else {
                                        $noticeRow['noticeGroup'] = array();
                                    }
                                }
                                if (in_array(0, $ubt)) {
                                    $con = array('noticeOutside.deleted' => 0, 'noticeOutside.fkNoticeId' => $notice->noticeId);
                                    $noticeOutside = $this->noticeboard->getOutsiders($con);
                                    if (isset($noticeOutside) && $noticeOutside != NULL) {
                                        $Outside = '[';
                                        $i = 1;
                                        foreach ($noticeOutside as $no) {
                                            $semi = "";
                                            if ($i != 1) {
                                                $semi = ',';
                                            }

                                            $Outside .= $semi . '"' . $no->outsiderEmail . '"';

                                            if ($i == count($noticeOutside)) {
                                                $Outside .= ']';
                                            }
                                            $i++;
                                        }
                                        echo $noticeRow['noticeOutside'] = $Outside;
                                        //$noticeRow['noticeOutside'] = implode(",", $Outside);
                                    } else {
                                        $noticeRow['noticeOutside'] = '';
                                    }
                                }

                                if (in_array(2, $ubt)) {
                                    $con = array('noticeUsers.deleted' => 0, 'noticeUsers.fkNoticeId' => $notice->noticeId);
                                    $noticeUsers = $this->noticeboard->getNoticedUserIds($con);
                                    if (isset($noticeUsers) && $noticeUsers != NULL) {
                                        foreach ($noticeUsers as $nu) {
                                            $noticeRow['noticeUsers'][] = $nu->fkUserId;
                                        }
                                    } else {
                                        $noticeRow['noticeUsers'] = array();
                                    }
                                }
                            }else{
                                $this->response(array('status' => false,'message' => lang('noRecord')), 200);
                            }
                        break;
                    }
                }
                if($p->deviceType == 1 && $p->pushToken != ""){
                    $iosFlag = 1;
                    $regIos  = $p->pushToken;
                    $iosArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->moduleId,"device"=>$regIos, "cronMsgId"=>$p->cronMsgId);
                        
                }elseif($p->deviceType == 0 && $p->pushToken != ""){
                    $andFlag = 1;
                    $regAnd  = $p->pushToken;
                    $androidArray[] = array("title"=>$p->cronTitle,'msg'=>$p->cronMsg,"type"=>$p->moduleId, "device"=> $regAnd,"cronMsgId"=>$p->cronMsgId);
                }
            }
            
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
