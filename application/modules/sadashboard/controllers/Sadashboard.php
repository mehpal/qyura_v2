<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SaDashboard extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array("common_model", "dashboard_model"));
    }

    public function index() {
        $this->common_model->mypermission("7");

        //$data['MI'] = $this->dashboard_model->getMiCount();
        $data['Doctor'] = $this->dashboard_model->getDoctorCount();
        $data['User'] = $this->dashboard_model->getUserCount();
        $data['MiList'] = $this->dashboard_model->getMiList();
        $data['doctorList'] = $this->dashboard_model->getDoctorList();
        $data['quotationList'] = $this->dashboard_model->getPendingQuotationList();
        $data['notification'] = $this->dashboard_model->getNotification();
        $data['title'] = 'SuperAdmin Dashboard';
        $this->load->super_admin_template('Superadmin_dashboard', $data, 'dashboardScript');
    }
    function deleteNotification(){
        
        $id = $this->input->post('id');
        $option = array(
            'table' => 'qyura_cronMsgs',
            'where' => array('qyura_cronMsgId'=>$id)
        );
        $response = $this->common_model->customDelete($option);
        if($response){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    function getNotificatoin(){
         $notification = $this->dashboard_model->getNotification();
         $noticeHtml="";
         if(isset($notification) && !empty($notification)):
            foreach($notification as $notice):
             
             $noticeHtml .= "<tr><td width='80%'><p>'".ucfirst(substr($notice->qyura_cronMsg, 0,50))."...'</p></td><td width='20%'>
                 
                             <a onclick='deleteNotice(".$notice->qyura_cronMsgId.")'> <img src='".base_url()."assets/images/delete.png'></a>
                             </td>

                                        </tr>";
             
            endforeach;
         endif;
         
         echo $noticeHtml;
         exit;
         
    }
    
    function miSignupChart(){
        echo strtotime(date('2015-05-09'));
        $chartData = $this->dashboard_model->getSignupChart();
        
        dump($chartData);
    }

}
