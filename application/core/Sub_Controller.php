<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sub_Controller extends MY_Controller {

    public $miData = false;
    public $ci_class = '';
    public $ci_method = '';
    public function __construct() {
       parent::__construct();
       $this->ci_class	= $this->router->fetch_class();
       $this->ci_method	= $this->router->fetch_method();
       if(USER==13)
       {
            
            $userid = $this->session->userdata('ses_mi_userid');
            $profileid = $this->session->userdata('ses_mi_profileid');
            $roleid = $this->session->userdata('ses_mi_roleid');

            if($roleid==1)
            {
                $result = $this->Common_model->fetchHospitalData(array("Hos.hospital_id"=>$profileid));
                if($result != null && $result != FALSE && !empty($result))
                    $this->miData = $result;
            }
            else
            {
                $result = $this->Common_model->fetchSingleData(array('diag.diagnostic_id'=>$profileid));
                if($result != null && $result != FALSE && !empty($result))
                    $this->miData = $result;

            }
            
        }
        
        
       
    }
    
    public function userHasPermission()
    {
        $ci_dir		= $this->router->fetch_directory();
        $ci_class	= $this->router->fetch_class();
        $ci_method	= $this->router->fetch_method();
    }

}
