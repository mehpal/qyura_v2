<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MiDashboard extends MY_Controller {
    public $mi_user_id = "";
    public $mi_role_id = "";
    public function __construct() {
        parent:: __construct();
        $this->load->model(array("Common_model", "midashboard_model"));
        $this->Common_model->mypermission("3");
        $this->mi_user_id = $this->session->userdata('ses_mi_userid');
        $this->mi_role_id = $this->session->userdata('ses_mi_roleid');
    }

    public function index() {
        $data['title'] = 'Doctor Dashboard';
        
//        echo  $this->mi_user_id;
//        echo"pre";
//        echo $this->mi_role_id;
        
//        $data['Doctor'] = $this->midashboard_model->getDoctorCount();
//        $data['User'] = $this->midashboard_model->getUserCount();
//        $data['MiList'] = $this->midashboard_model->getMiList();
//        $data['doctorList'] = $this->midashboard_model->getDoctorList();
//        $data['quotationList'] = $this->midashboard_model->getPendingQuotationList();
        //  $data['notification'] = $this->midashboard_model->getNotification();
//        $data['cityList'] = $this->midashboard_model->getCityList();
//        $data['topHospital'] = $this->midashboard_model->getTopHospital();
//        $data['doctorOfMonth'] = $this->midashboard_model->getDoctorOfMonth();
      //  $data['consultAppoinement'] = $this->midashboard_model->getConsultAppointment();
//        $data['diagnosticAppointmnt'] = $this->midashboard_model->getDoagnosticAppointment();
        
        //dump($data['consultAppoinement']);
        
        $this->load->mi_template('Mi_dashboard', $data,'dashboardScript');
    }

}
