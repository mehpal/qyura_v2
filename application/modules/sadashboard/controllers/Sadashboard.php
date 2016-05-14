<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SaDashboard extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array("common_model", "dashboard_model"));
    }

    public function index() {
        $this->common_model->mypermission("7");
        //echo strtotime(date('2016-05-15'));
        //$data['MI'] = $this->dashboard_model->getMiCount();
        $data['Doctor'] = $this->dashboard_model->getDoctorCount();
        $data['User'] = $this->dashboard_model->getUserCount();
        $data['MiList'] = $this->dashboard_model->getMiList();
        $data['doctorList'] = $this->dashboard_model->getDoctorList();
        $data['quotationList'] = $this->dashboard_model->getPendingQuotationList();
        $data['notification'] = $this->dashboard_model->getNotification();
        $data['cityList'] = $this->dashboard_model->getCityList();
        $data['topHospital'] = $this->dashboard_model->getTopHospital();
        $data['doctorOfMonth'] = $this->dashboard_model->getDoctorOfMonth();
        $data['consultAppoinement'] = $this->dashboard_model->getConsultAppointment();
        $data['diagnosticAppointmnt'] = $this->dashboard_model->getDoagnosticAppointment();
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
    
    function doctorOftheMonth(){
         $city = $this->input->post('city');
         $data['doctorOfMonth'] = $this->dashboard_model->getDoctorOfMonth($city);
         $this->load->view('doctorOfTheMonth',$data);
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
    
    function getChartDraw(){
         $year = date('Y');
         $getYear = $this->input->post('year');
         if(!empty($getYear)){
             $year = $getYear;
         }
         $chart = array();
         $ambulance = $this->dashboard_model->getChartAmbulance($year);
         $pharmacy = $this->dashboard_model->getChartPharmacy($year);
         $bloodbank = $this->dashboard_model->getChartBloodbank($year);
         $hospital = $this->dashboard_model->getChartHospital($year);
         $diagnostic = $this->dashboard_model->getChartDiagnostic($year);
         
         $chart = array(
             'Ambulance' => $ambulance,
             'Pharmacies' => $pharmacy,
             'BloodBank' => $bloodbank,
             'Hospitals' => $hospital,
             'Diagnostics' => $diagnostic
         );
         
         echo json_encode($chart);
    }

}
