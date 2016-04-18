<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DocDashboard extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model(array("Common_model"));
        $this->Common_model->mypermission("4");
    }

    public function index() {
	$data['title'] = 'Doctor Dashboard';
        $this->load->doc_template('Doctor_dashboard',$data);
    }

}
