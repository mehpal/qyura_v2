<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Favouriteby extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       
       $this->load->library('form_validation');
       $this->load->model('Favouriteby_model');
       $this->load->library('datatables');
       $this->load->helper('common_helper');
   }
   function index(){
       
        $data = array();
     
        $data['allCities'] = $this->Favouriteby_model->fetchCity();

        $data['title'] = 'Favourite By';

        $this->load->super_admin_template('favouritebyList', $data, 'scriptFavouriteby');
   }
   
   
    function getFavbyDl(){

       
        echo $this->Favouriteby_model->fetchFavbyDataTables();
 
   }
   
   
    function createCSV(){
       
   
       $mi = $this->input->post('mi');
       $mi_cityId = $this->input->post('mi_cityId');
       
       $or_like_mi = array();
        if($mi != '' && $mi != NULL){
          $or_like_mi = array( 'hospital_name' => $mi, 'diagnostic_name' => $mi, 'doctors_fName' => $mi, 'doctors_lName' => $mi);
        }

        $or_like_city = array();
        if($mi_cityId != '' && $mi_cityId != ''){
           $or_like_city = array( 'diagnostic_cityId' => $mi_cityId, 'hospital_cityId' => $mi_cityId, 'doctors_cityId' => $mi_cityId);
        }
        
        $array[]= array('Mi Type','Mi Name','City','User/Patient Name','User Type');
        $data = $this->Favouriteby_model->createCSVdata($or_like_mi,$or_like_city);
        $arrayFinal = array_merge($array,$data);
       
        array_to_csv($arrayFinal,'FavByDetail.csv');
        return True;
        exit;
    }


}  