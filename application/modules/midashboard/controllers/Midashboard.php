<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MiDashboard extends Sub_Controller {
    public $mi_user_id = "";
    public $mi_role_id = "";
    public function __construct() {
        parent:: __construct();
        $this->load->model(array("Common_model", "midashboard_model"));
        //$this->Common_model->mypermission("13");
        $this->mi_user_id = $this->session->userdata('ses_mi_userid');
        $this->mi_role_id = $this->session->userdata('ses_mi_roleid');
    }

    public function index() {
        $data['title'] = 'MI Dashboard';

        $data['consultAppoinement'] = $this->midashboard_model->getConsultAppointment();
        $data['diagnosticAppointmnt'] = $this->midashboard_model->getDoagnosticAppointment();
        $data['helthPackageBooking'] = $this->midashboard_model->getHelthPackageBooking();
        $data['quotationList'] = $this->midashboard_model->getQuotationList();
        $data['medicartBooking'] = $this->midashboard_model->getMedicartBooking();
        $data['medicartEnquiry'] = $this->midashboard_model->getMedicartEnquiry();
        $data['doctorOfMonth'] = $this->midashboard_model->getDoctorOfMonth();
        
        $this->load->mi_template('Mi_dashboard', $data,'dashboardScript');
    }
    
    function bookingDistributionChart(){
        
         $year = date('Y');
         $chart = array();
         
        $consultAppoinement = $this->midashboard_model->getConsultAppointmentChart($year);
        $diagnosticAppointmnt = $this->midashboard_model->getDoagnosticAppointmentChart($year); 

         $chart = array(
             'Consultation' => $consultAppoinement,
             'Dignostic' => $diagnosticAppointmnt
         );
         
         echo json_encode($chart);
    }
    
    function medicartChart(){
         $year = date('Y');
         $getYear = $this->input->post('year');
         $chart = array();
         
        $booking = count($this->midashboard_model->getMedicartEnquiry());
        $enquiry = Count($this->midashboard_model->getMedicartEnquiry($year)); 

         $chart = array(
             'booking' => $booking,
             'enquiry' => $enquiry
         );
         
         echo json_encode($chart);
    }

}
