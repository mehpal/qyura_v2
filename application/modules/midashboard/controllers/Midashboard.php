<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MiDashboard extends MY_Controller {
    
public function __construct() {
        parent:: __construct();
        $this->load->model(array("Common_model"));
	$this->Common_model->mypermission("3");
        
        
    }
	public function index()
	{
	    $data['title'] = 'Doctor Dashboard';
            $this->load->mi_template('Mi_dashboard',$data);

	}
        
}
