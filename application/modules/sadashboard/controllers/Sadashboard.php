<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaDashboard extends MY_Controller {
    
public function __construct() {
        parent:: __construct();
        $this->load->model(array("Common_model"));
        
        
    }
	
	public function index()
	{
            $this->Common_model->mypermission("7");
	    $data['title'] = 'SuperAdmin Dashboard';
            $this->load->super_admin_template('Superadmin_dashboard');
	}
       
}
