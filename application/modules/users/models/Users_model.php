<?php

class Users_model extends My_model {

    function __construct() {
        parent::__construct();
    }

    function fetchStates() {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->order_by("state_statename", "asc");
        return $this->db->get()->result();
    }
    
     function fetchCity($stateId = NULL) {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid', $stateId);
        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }
    function fetchCities() {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
       
        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }
    
  
        //Function for insert
   
    
    function fetchinsurance(){
        $this->db->select('insurance_Name,insurance_id');
        $this->db->from('qyura_insurance');
        $this->db->order_by("insurance_Name", "asc");
        return $this->db->get()->result(); 
    }
    
     function checkUserExistence($email,$id) {
     $query = 'SELECT count(users_id) as isExit FROM qyura_users  WHERE users_email = "' . $email . '" and users_id != "' . $id . '"';

        $data = $this->db->query($query)->result();
      
        if ($data[0]->isExit >= 1) {
         
            echo json_encode(FALSE);
        } else {
         
            echo json_encode(TRUE);
        }
    }
    
   function fetchfamilyMember(){
        $this->db->select('relation_type,relation_id');
        $this->db->from(' qyura_familyRelation');
        $this->db->order_by("relation_type", "asc");
        return $this->db->get()->result(); 
    }
    
   function fetchUsersDataTables( $condition = NULL){
            
         $imgUrl = base_url().'assets/usersImage/thumb/thumb_100/$1';    
         
         $this->datatables->select('patient.patientDetails_id as id,patient.patientDetails_usersId,City.city_name,patient.patientDetails_patientName,patient.patientDetails_address,patient.patientDetails_mobileNo,patient.patientDetails_patientImg,'
                 . 'patient.patientDetails_dob,patient.status as sts');
                
        $this->datatables->from('qyura_patientDetails AS patient');
        $this->datatables->join('qyura_city AS City','City.city_id = patient.patientDetails_cityId','left');
       // $this->datatables->join('qyura_users AS usr','usr.users_id = patient.ambulance_usersId','left');

 
        $search = $this->input->post('bloodBank_name');
        if($search){
            $this->db->or_like('patient.patientDetails_patientName',$search);
            $this->db->or_like('patient.patientDetails_address',$search);
           $this->db->or_like('patient.patientDetails_mobileNo',$search);
            
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('patientDetails_cityId', $city) : '';
        
        $states = $this->input->post('status');
        isset($states) && $states != '' ? $this->datatables->where('patient.status', $states) : '';
        
      
        $this->datatables->order_by('patientDetails_id');
        
 if($condition)
        $this->datatables->where(array('patient.ambulance_id'=> $condition));

        $this->datatables->where(array('patient.patientDetails_deleted'=> 0));
        
       $this->datatables->add_column('patientDetails_patientImg', '<img class="img-responsive" height="80px;" width="80px;" src='.$imgUrl.'>', 'patientDetails_patientImg');
       
      $this->datatables->add_column('status', '$1', 'statusCheck(ambulance,qyura_ambulance,ambulance_id,id,sts)');
        
//              $this->datatables->add_column('ambulance_address', '$1 </br><a  href="ambulance/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'ambulance_address,id');
       
         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="users/editUserView/$1">Edit</a>', 'patientDetails_usersId');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

    }
    
   function fetchUsersConsultantDataTables(){
              
         
         $this->datatables->select('doctorAppointment.doctorAppointment_id,doctorAppointment.doctorAppointment_pntUserId,doctorAppointment.doctorAppointment_date,doctorAppointment.doctorAppointment_finalTiming,doctorAppointment.doctorAppointment_doctorUserId,doctorAppointment.doctorAppointment_status,doctorAppointment.doctorAppointment_doctorParentId,');
                
        $this->datatables->from('qyura_doctorAppointment AS doctorAppointment');
   //  $this->datatables->join('qyura_city AS City','City.city_id = patient.patientDetails_cityId','left');
        
        $this->datatables->order_by('doctorAppointment_id');
       // $this->datatables->where(array('doctorAppointment.doctorAppointment_pntUserId'=> $condition));
        
// if($condition)
//        $this->datatables->where(array('doctorAppointment.ambulance_id'=> $condition));
//
//        $this->datatables->where(array('patient.patientDetails_deleted'=> 0));
//         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="users/editUserView/$1">View</a>', 'patientDetails_usersId');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

    }
    
   function fetchUsersDiagnosticDataTables(){
              
         
         $this->datatables->select('doctorAppointment.doctorAppointment_id,doctorAppointment.doctorAppointment_pntUserId,doctorAppointment.doctorAppointment_date,doctorAppointment.doctorAppointment_finalTiming,doctorAppointment.doctorAppointment_doctorUserId,doctorAppointment.doctorAppointment_status,doctorAppointment.doctorAppointment_doctorParentId,qyura_quotationDetailTests.quotationDetailTests_testName');
                
        $this->datatables->from('qyura_doctorAppointment AS doctorAppointment');
        $this->datatables->join('qyura_quotationDetailTests AS quotationDetailTests','quotationDetailTests.city_id = patient.patientDetails_cityId','left');
        
        $this->datatables->order_by('doctorAppointment_id');
        $this->datatables->where(array('doctorAppointment.doctorAppointment_pntUserId'=> $condition));
        
// if($condition)
//        $this->datatables->where(array('doctorAppointment.ambulance_id'=> $condition));
//
//        $this->datatables->where(array('patient.patientDetails_deleted'=> 0));
//         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="users/editUserView/$1">View</a>', 'patientDetails_usersId');

        return $this->datatables->generate(); 
        // echo $this->datatables->last_query();

    }
}


