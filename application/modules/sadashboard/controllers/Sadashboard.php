<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SaDashboard extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array("common_model","dashboard_model"));
    }

    public function index() {
        $this->common_model->mypermission("7");

        $data['MI'] = $this->dashboard_model->getMiCount();
        $data['Doctor'] = $this->dashboard_model->getDoctorCount();
        $data['User'] = $this->dashboard_model->getUserCount();
        $data['MiList'] = $this->dashboard_model->getMiList();
        
        
        dump($data['MiList']);
        exit();
        $data['title'] = 'SuperAdmin Dashboard';
        $this->load->super_admin_template('Superadmin_dashboard', $data, 'dashboardScript');
    }

}
