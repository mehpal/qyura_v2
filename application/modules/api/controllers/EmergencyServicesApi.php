<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class EmergencyServicesApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('emergency_model'));
    }

    function emergencylist_post() {
        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'required|decimal');
        $this->form_validation->set_rules('emergencytype','Emergency Type','xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('cityId', 'cityId', 'xss_clean|trim|numeric|is_natural_no_zero');
         $this->bf_form_validation->set_rules('notin', 'Not in', 'xss_clean|trim');
        
        if($this->form_validation->run($this) == FALSE)
        { 
          // setup the input
           $response =  array('status'=>FALSE,'message'=>$this->validation_post_warning());
           $this->response($response, 400);
        }else{
            
            $emergencyType = $this->input->post('emergencytype');
            
            $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
            $long = isset($_POST['long']) ? $_POST['long'] : '';      
            $search = isset($_POST['search']) ? $_POST['search'] : '';
            $notIn = isset($_POST['notin']) ? $_POST['notin'] : '';
            
            //city
            $cityId = isset($_POST['cityId']) ? $this->input->post('cityId') : NULL;
            $openNow = (isset($_POST['openNow'] )&& $_POST['openNow'] != 0) ? $this->input->post('openNow') : NULL;
            $docOnBoard = (isset($_POST['docOnBoard'] )&& $_POST['docOnBoard'] != 0) ? $this->input->post('docOnBoard') : NULL;
             $radius = isset($_POST['radius']) ? $this->input->post('radius') : 70;
            if($emergencyType == 1){
    
              $response['ambulance'] =  $this->emergency_model->getAmbulanceList($lat,$long,$notIn,$cityId,$openNow,$radius,$docOnBoard);
              $response['aoClumns'] =  array("id","name","phn","docOnBoard","openingHours","closingHours","allTime","address","distance");
              
              if($response['ambulance']){
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
              }else{
                $response['status'] = False;
                $response['msg'] = 'There is no ambulance at this range!';
                $this->response($response, 400);
              }
                
            }elseif($emergencyType == 2){
                
              $response['hoispital'] = $this->emergency_model->getHospitalList($lat,$long,$notIn,$search,$cityId);
              $response['aoClumns'] =  array("id","fav","rat","adr", "name","phn","lat","lng","upTm","imUrl","specialities");
              if($response['hoispital']){
                $response['status'] = TRUE;
                $response['msg'] = 'success';
                $this->response($response, 200);
              }else{
                $response['status'] = False;
                $response['msg'] = 'There is no hospital at this range!';
                $this->response($response, 400);
              }
                
            }elseif($emergencyType == 3){
                
               $response['pharmacy'] =  $this->emergency_model->getPhamacyList($lat,$long,$notIn,$search,$cityId);
               $response['aoClumns'] = array("id", "name", "adr", "imUrl", "phn", "lat", "long");
                if($response['pharmacy']){
                 $response['status'] = TRUE;
                 $response['msg'] = 'success';
                 $this->response($response, 200);
                }else{
                 $response['status'] = False;
                 $response['msg'] = 'There is no Pharmacy at this range!';
                 $this->response($response, 400);
               }
                
            }elseif($emergencyType == 4){
                
                $response['doctor'] =  $this->emergency_model->getDoctorsList($lat,$long,$notIn,$search,$cityId);
                $response['aoClumns'] =  array("id","name","exp","imUrl","rating", "consFee", "speciality","degree", "lat", "long");
                if($response['doctor']){
                 $response['status'] = TRUE;
                 $response['msg'] = 'success';
                 $this->response($response, 200);
                }else{
                 $response['status'] = False;
                 $response['msg'] = 'There is no Doctor at this range!';
                 $this->response($response, 400);
               }
                
            }
        }
    }
    

}
