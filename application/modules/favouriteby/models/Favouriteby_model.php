<?php
class Favouriteby_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    

  

     function fetchCity ($stateId=NULL){

        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
       // $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name","asc");
        return $this->db->get()->result();
    }

    
    
    
    function fetchFavbyDataTables( $condition = NULL){
        
        
        
         $this->datatables->select('fav_id as favId, patientDetails_id as patientId, patientDetails_usersId userId, concat(patientDetails_patientName," ", patientDetails_pLastName) as userName, patientDetails_patientImg as img, users_email as email, (CASE WHEN diagnostic_usersId <> 0 THEN diagnostic_name WHEN hospital_usersId <> 0 THEN hospital_name WHEN doctors_userId <> 0 THEN CONCAT(doctors_fName," ",doctors_lName) END) as miName, (CASE WHEN diagnostic_usersId <> 0 THEN "Diagnostic center" WHEN hospital_usersId <> 0 THEN "Hospital" WHEN doctors_userId <> 0 THEN "Doctor" END) as miType, (SELECT city_name FROM qyura_city WHERE city_id = (CASE WHEN diagnostic_usersId <> 0 THEN diagnostic_cityId WHEN hospital_usersId <> 0 THEN hospital_cityId WHEN doctors_userId <> 0 THEN doctors_cityId END)) as city, ( CASE WHEN (EXISTS (select healthPkgBooking_userId from qyura_healthPkgBooking where healthPkgBooking_userId = userId) OR EXISTS (select quotationBooking_userId from qyura_quotationBooking where quotationBooking_userId = userId) OR EXISTS (select doctorAppointment_pntUserId from qyura_doctorAppointment where doctorAppointment_pntUserId = userId) ) = 1 THEN "Exist User" ELSE "New User" END)as userType ');
        $this->datatables->from('qyura_fav');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_fav.fav_userId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_patientDetails.patientDetails_usersId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->where(array('fav_deleted' => 0));
        $this->db->group_by('favId');
        $this->db->order_by('qyura_fav.creationTime', 'desc');
            


 
        $search = $this->input->post('name');
        if($search){
            $this->db->or_like('healthpkg.healthPackage_packageTitle',$search);
            $this->db->or_like('healthpkg.healthPackage_discountedPrice',$search);
            $this->db->or_like('healthpkg.status',$search);
            
        }
        
        $searchMi = $this->input->post('mi');
        if(isset($searchMi) && $searchMi != '')
        {
            $this->db->group_start();
            $this->db->or_like(array( 'hospital_name' => $searchMi, 'diagnostic_name' => $searchMi, 'doctors_fName' => $searchMi, 'doctors_lName' => $searchMi));
            $this->db->group_end();
        }
     
        $city = $this->input->post('cityId');
        if(isset($city) && $city != '')
        { 
            $this->db->group_start();
            $this->db->or_like(array( 'diagnostic_cityId' => $city, 'hospital_cityId' => $city, 'doctors_cityId' => $city));
            $this->db->group_end();
        }
        
 
       return  $this->datatables->generate(); 
      //  echo $this->datatables->last_query(); exit;

    }
    
    
    function createCSVdata($or_like_mi,$or_like_city){
        
        
         $this->db->select('fav_id as favId, patientDetails_id as patientId, patientDetails_usersId userId, concat(patientDetails_patientName," ", patientDetails_pLastName) as userName, patientDetails_patientImg as img, users_email as email, (CASE WHEN diagnostic_usersId <> 0 THEN diagnostic_name WHEN hospital_usersId <> 0 THEN hospital_name WHEN doctors_userId <> 0 THEN CONCAT(doctors_fName," ",doctors_lName) END) as miName, (CASE WHEN diagnostic_usersId <> 0 THEN "Diagnostic center" WHEN hospital_usersId <> 0 THEN "Hospital" WHEN doctors_userId <> 0 THEN "Doctor" END) as miType, (SELECT city_name FROM qyura_city WHERE city_id = (CASE WHEN diagnostic_usersId <> 0 THEN diagnostic_cityId WHEN hospital_usersId <> 0 THEN hospital_cityId WHEN doctors_userId <> 0 THEN doctors_cityId END)) as city, ( CASE WHEN (EXISTS (select healthPkgBooking_userId from qyura_healthPkgBooking where healthPkgBooking_userId = userId) OR EXISTS (select quotationBooking_userId from qyura_quotationBooking where quotationBooking_userId = userId) OR EXISTS (select doctorAppointment_pntUserId from qyura_doctorAppointment where doctorAppointment_pntUserId = userId) ) = 1 THEN "Exist User" ELSE "New User" END)as userType ');
        $this->db->from('qyura_fav');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_fav.fav_userId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_patientDetails.patientDetails_usersId', 'left');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_fav.fav_relateId', 'left');
        $this->db->where(array('fav_deleted' => 0));
        $this->db->group_by('favId');
        $this->db->order_by('qyura_fav.creationTime', 'desc');
            
        

           if(!empty($or_like_mi)){
                    $this->db->group_start();
                    $this->db->or_like($or_like_mi);
                    $this->db->group_end();
            }

        if(!empty($or_like_city)){
               $this->db->group_start();
               $this->db->or_like($or_like_city);
               $this->db->group_end();
        }  

       
                
       // $this->db->like($or_where);
        
        $data= $this->db->get(); 
       // echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['miType'] = $val->miType;
            $result[$i]['miName'] = $val->miName;
            $result[$i]['city'] = $val->city;
            $result[$i]['user'] = $val->userName;
            $result[$i]['type'] = $val->userType;
           $i++;
        }
         return $result;


    }
     
}   

