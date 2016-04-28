<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends MY_Controller {

     public function __construct() {
       parent:: __construct();
      
//       $this->load->model('Setting_model');

      
   }
   function index(){
  
	$siteLocation = explode(".",$_SERVER['SERVER_NAME']);
	define('USER',"7");
        
	/*if(count($siteLocation) >= 3){
	    $user = strtolower($siteLocation[0]);
	    define('USERTYPE', $user);
            if($user=="superadmin")
                define('USER',"7");
            else if($user=="mi")
                define('USER',"13");
            else if($user=="doctor")
                define('USER',"4");
            else
                define('USER',"UnAuthenticated");
	}*/


	   redirect("auth/login");
	}
        
   
   
   
}
