<?php
class Healthcare_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function fetchStates() {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->order_by("state_statename","asc");
        return $this->db->get()->result();
    }
    
    function fetchCity ($stateId=NULL){

        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
       // $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name","asc");
        return $this->db->get()->result();
    }
    
   function fetchHospital ($cityId=NULL){

        $this->db->select('hospital_id hosId, hospital_usersId miId, hospital_name miName');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_cityId' => $cityId, 'hospital_deleted' => 0, 'status' => 1));
        $this->db->order_by("hospital_name","asc");
        return $this->db->get()->result();
    }
    
  function fetchDiagnostic ($cityId=NULL){

        $this->db->select('diagnostic_id dignoId, diagnostic_usersId miId, diagnostic_name miName');
        $this->db->from('qyura_diagnostic');
        $this->db->where(array('diagnostic_cityId' => $cityId, 'diagnostic_deleted' => 0, 'status' => 1));
        $this->db->order_by("diagnostic_name","asc");
        return $this->db->get()->result();
    }
    
    function fetchPackgid($packageId){
        $this->db->select('healthPackage_packageId');
        $this->db->from('qyura_healthPackage');
        $this->db->where(array('healthPackage_packageId' => $packageId, 'healthPackage_deleted' => 0));
       $result = $this->db->get();
       //return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0;  
    } 
        
    function insertPharmacyUser($insertData){
      $this->db->insert('qyura_users', $insertData); 
       $insert_id = $this->db->insert_id();
       // echo $this->db->last_query();exit;
        return  $insert_id;
    }
    
    function insertHealthpkg($insertData, $miType){
        //echo "here";exit;
        $this->db->insert('qyura_healthPackage', $insertData); 

        $insert_id = $this->db->insert_id();
        
        $uniqId = 'PKG'.$insert_id.time();
        
        $option = array('healthPackage_packageId' => $uniqId);
        
        $this->db->where('healthPackage_id', $insert_id);
        $this->db->update('qyura_healthPackage', $option);
        
       /* if($insert_id && $miType ==  'Hospital'){
            
            $insertData = array('hospitalPackage_hospitalId' => $insertData['healthPackage_MIuserId'], 'hospitalPackage_healthPackageId' => $insert_id, 'creationTime' => strtotime(date("Y-m-d H:i:s") ), 'hospitalPackage_deleted' => 0 );
            $this->db->insert('qyura_hospitalPackage', $insertData);
            
        }elseif($insert_id && $miType ==  'Diagnostic'){
            
            $insertData = array('diagonsticPackage_diagnosticId' => $insertData['healthPackage_MIuserId'], 'diagonsticPackage_healthPackageId' => $insert_id, 'creationTime' => strtotime(date("Y-m-d H:i:s") ), 'diagonsticPackage_deleted' => 0 );
            $this->db->insert('qyura_diagonsticPackage', $insertData);
        } */
       //echo $this->db->last_query();exit;
        return  $insert_id;
    }
    function insertUsersRoles($insertData){
        $this->db->insert('qyura_usersRoles', $insertData); 
        $insert_id = $this->db->insert_id();
        return true;
    }    
    function fetchHealthcareData($condition = NULL){
        
         $this->db->select('healthpkg.healthPackage_id id, healthpkg.healthPackage_packageId healthpkgId, healthpkg.healthPackage_packageTitle title,healthpkg.healthPackage_discountedPrice price, (CASE healthpkg.status WHEN 1 THEN "Active" WHEN 0 THEN "Deactive" END) as status, healthpkg.creationTime createdAt,healthpkg.healthPackage_bestPrice bp,healthpkg.healthPackage_description,FROM_UNIXTIME(healthpkg.healthPackage_date,"%d-%m-%Y") AS date, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName,healthpkg.healthPackage_includesTest as test, (CASE Roles.usersRoles_roleId WHEN 1 THEN "Hospital" WHEN 3 THEN "Diagnostic" END) as miType, healthpkg.healthPackage_cityId as cityId, healthpkg.healthPackage_MIuserId as miId, healthpkg.healthPackage_discountedPercent as percent');
        $this->db->from('qyura_healthPackage AS healthpkg');
        $this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = healthpkg.healthPackage_MIuserId','inner'); // changed
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = healthpkg.healthPackage_MIuserId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = healthpkg.healthPackage_MIuserId','left');
       // $this->db->join('qyura_users AS usr','usr.users_id = healthpkg.pharmacy_usersId','left');
        
        if($condition)
        $this->db->where(array('healthpkg.healthPackage_id'=> $condition));
        $this->db->where(array('healthpkg.healthPackage_deleted'=> 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
       $this->db->order_by("healthpkg.creationTime", "desc"); 
      $data= $this->db->get(); 
     //echo $this->db->last_query();exit;
     return $data->result();
    }
    function fetchHealthpkgDataTables( $condition = NULL){
            
       //  $imgUrl = base_url().'assets/pharmacyImages/$1';    
         
         $this->datatables->select('healthpkg.healthPackage_id, healthpkg.healthPackage_packageId healthpkgId, healthpkg.healthPackage_packageTitle title,healthpkg.healthPackage_discountedPrice price, healthpkg.status as status, healthpkg.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, (SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as city_name, healthpkg.status, healthpkg.healthPackage_MIuserId as miId');
        $this->datatables->from('qyura_healthPackage AS healthpkg');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = healthpkg.healthPackage_MIuserId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = healthpkg.healthPackage_MIuserId','left');
        $this->db->where('healthPackage_deleted', 0);
        $this->db->group_by('healthPackage_id');
        $this->db->order_by('healthpkg.creationTime', 'desc');
        

 
        $search = $this->input->post('name');
        if($search){
            $this->db->group_start();
            $this->db->or_like('healthpkg.healthPackage_packageTitle',$search);
            $this->db->or_like('healthpkg.healthPackage_discountedPrice',$search);
            $this->db->or_like('healthpkg.status',$search);
            $this->db->group_start();
            
        }
        
        $searchMi = $this->input->post('mi');
        if($searchMi){
            $this->db->group_start();
            $this->db->or_like(array('hospital_name' => $searchMi, 'diagnostic_name' => $searchMi));
            $this->db->group_end();
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->db->where('IFNULL(hospital_cityId,diagnostic_cityId)', $city) : '';
        
        //$this->db->get();
        //echo $this->datatables->last_query(); exit;
      
        
       // if($condition)
       // $this->datatables->where(array('pharmacy.pharmacy_id'=> $condition));
         $this->db->where(array('healthpkg.healthPackage_deleted'=> 0));
        
         $this->datatables->add_column('miName', '<h6>$1</h6><p>$2</p>', 'miName,city_name');
         
         $this->datatables->edit_column('status', '$1', 'getStatus(status)');
       
         $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light btn-health m-b-5" href="healthcare/detailHealthpkg/$1">View Deatil</a><button class="btn btn-success waves-effect waves-light btn-health m-b-5" type="button" onclick="enableFn($1,$3)">$2</button> <a href="healthcare/editHealthpkg/$1"  class="btn btn-success waves-effect waves-light btn-health">Edit Detail</a>', 'healthPackage_id,getOppStatus(status),status');

       return  $this->datatables->generate(); 
      //  echo $this->datatables->last_query(); exit;

    }
    function UpdateTableData($data=array(),$where=array(),$tableName = NULL){
        foreach($where as $key=>$val){
            $this->db->where($key, $val); 
        }
       
        $this->db->update($tableName, $data); 
       
        //echo $this->db->last_query();exit;
         return TRUE;
    }
    
      function createCSVdata($where,$or_where = null){
        $this->db->select('IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, healthpkg.healthPackage_packageId healthpkgId, healthpkg.healthPackage_packageTitle title,healthpkg.healthPackage_discountedPrice price, (CASE healthpkg.status WHEN 1 THEN "Active" WHEN 0 THEN "Deactive" END) as status');
        $this->db->from('qyura_healthPackage AS healthpkg');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = healthpkg.healthPackage_MIuserId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = healthpkg.healthPackage_MIuserId','left');
        $this->db->group_by('healthPackage_id');
        $this->db->order_by('healthpkg.creationTime', 'desc');
        foreach($where as $key=>$val){
           
            if($where[$key] === 0){
            $this->db->where($key, $val); 
            }
            if($where[$key] != ''){
            $this->db->where($key, $val); 
            }
        }
        
        $this->db->group_start();
        $this->db->or_like($or_where);
        $this->db->group_end(); 
                
       // $this->db->like($or_where);
        
        $data= $this->db->get(); 
      //  echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['miName'] = $val->miName;
            $result[$i]['healthpkgId'] = $val->healthpkgId;
            $result[$i]['title'] = $val->title;
            $result[$i]['price'] = $val->price;
            $result[$i]['status'] = $val->status;
           $i++;
        }
         return $result;
        
      }
      
      
          
       function fetchBookingHealthpkgDataTables( $condition = NULL){
           
         $this->datatables->select('bookhealthpkg.healthPkgBooking_id,bookhealthpkg.healthPkgBooking_orderNo bookingId, bookhealthpkg.healthPkgBooking_miId,bookhealthpkg.creationTime createdAt,IFNULL(hos.hospital_name,diag.diagnostic_name) as miName,healthpkg.healthPackage_id,healthpkg.healthPackage_packageTitle as packageName,bookhealthpkg.healthPkgBooking_miId,healthpkg.healthPackage_discountedPrice as price,pd.patientDetails_id,pd.patientDetails_patientName as bookedBy,FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") as userAge, pd.patientDetails_gender as gender, (SELECT city_name FROM qyura_city WHERE city_id = IFNULL(diagnostic_cityId,hospital_cityId) )  as city_name');
        $this->datatables->from('qyura_healthPkgBooking AS bookhealthpkg');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = bookhealthpkg.healthPkgBooking_miId','left');
      //  $this->db->join('qyura_city AS city','city.city_id = hos.hospital_cityId','left');
        $this->db->join('qyura_healthPackage AS healthpkg','healthpkg.healthPackage_id = bookhealthpkg.healthPkgBooking_healthPackageId','left');
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_usersId = bookhealthpkg.healthPkgBooking_userId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = bookhealthpkg.healthPkgBooking_miId','left');
        $this->db->order_by("bookhealthpkg.creationTime", "desc"); 
        $this->db->group_by('healthPkgBooking_id');
       // $this->db->get(); 
        ///echo $this->db->last_query();exit;
        /*$search = $this->input->post('name');
        if($search){
            $this->db->or_like('healthpkg.healthPackage_packageTitle',$search);
            $this->db->or_like('healthpkg.healthPackage_discountedPrice',$search);
            $this->db->or_like('healthpkg.status',$search);
            
        }
         */
        $searchMi = $this->input->post('mi');
        if($searchMi){
            $this->db->group_start();
            $this->db->or_like(array('hospital_name' => $searchMi, 'diagnostic_name' => $searchMi));
            $this->db->group_end();
        }
     
        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->db->where('IFNULL(hospital_cityId,diagnostic_cityId)', $city) : '';
       
      
       // $this->db->get();
       // echo $this->db->last_query(); exit;
      
        
       // if($condition)
       // $this->datatables->where(array('pharmacy.pharmacy_id'=> $condition));
        $this->db->where(array('bookhealthpkg.healthPkgBooking_deleted'=> 0));
        
        
        
        $this->datatables->add_column('bookedBy', '<h6>$1</h6><p>$2|$3</p>', 'bookedBy,getGender(gender),userAge');
        
        $this->datatables->add_column('miName', '<h6>$1</h6><p>$2</p>', 'miName,city_name');
       
        $this->datatables->add_column('action', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="healthcare/bookingDetailHealthpkg/$1">View Detail</a> <a href="#"  class="btn btn-success waves-effect waves-light m-b-5 applist-btn hide">Edit Detail</a>', 'healthPkgBooking_id');

     return  $this->datatables->generate(); 
   

    }
    
    
    function fetchHealthcarebookingData($condition = NULL){
      $this->db->select('bookhealthpkg.healthPkgBooking_id,bookhealthpkg.healthPkgBooking_orderNo bookingId,bookhealthpkg.creationTime createdAt,IFNULL(hos.hospital_name,diag.diagnostic_name) as miName,healthpkg.healthPackage_id id, healthpkg.healthPackage_packageId packageId, healthpkg.healthPackage_packageTitle packageName,bookhealthpkg.healthPkgBooking_miId,healthpkg.healthPackage_bestPrice as bp,healthpkg.healthPackage_discountedPrice as dp,pd.patientDetails_id,pd.patientDetails_patientName as bookedBy,trans.order_no,trans.payment_method as paymentMode,healthpkg.healthPackage_includesTest as test');
        $this->db->from('qyura_healthPkgBooking AS bookhealthpkg');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = bookhealthpkg.healthPkgBooking_miId','left');
        $this->db->join('qyura_healthPackage AS healthpkg','healthpkg.healthPackage_id = bookhealthpkg.healthPkgBooking_healthPackageId','left');
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_usersId = bookhealthpkg.healthPkgBooking_userId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = bookhealthpkg.healthPkgBooking_miId','left');
        $this->db->join('transactionInfo AS trans','trans.order_no = bookhealthpkg.healthPkgBooking_orderNo','left');
       // $this->db->join('qyura_users AS usr','usr.users_id = healthpkg.pharmacy_usersId','left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = pharmacy.pharmacy_usersid','left'); // changed
        if($condition)
       $this->db->where(array('bookhealthpkg.healthPkgBooking_id'=> $condition));
       $this->db->where(array('bookhealthpkg.healthPkgBooking_deleted'=> 0));
    //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("bookhealthpkg.creationTime", "desc"); 
        $data= $this->db->get(); 
       //echo $this->db->last_query();exit;
     return $data->result();
    }
    
        //Function for update
   public function customUpdate($options)
    {
        $table      =   false;
        $where      =   false;
        $orwhere    =   false; 
        $data       =   false;

            extract($options);

            if(!empty($where))
            {
                $this->db->where($where);
            }
            
            // using or condition in where  
            if(!empty($orwhere)){
                            $this->db->or_where($orwhere);
                            }
            $this->db->update($table, $data);

            return $this->db->affected_rows();
    }
    
    
    function createCSVForBookPkg($or_like = null,$or_where = null){
        
        $this->db->select('bookhealthpkg.healthPkgBooking_id,bookhealthpkg.healthPkgBooking_orderNo bookingId, bookhealthpkg.healthPkgBooking_miId,bookhealthpkg.creationTime createdAt,IFNULL(hos.hospital_name,diag.diagnostic_name) as miName,healthpkg.healthPackage_id,healthpkg.healthPackage_packageTitle as packageName,bookhealthpkg.healthPkgBooking_miId,healthpkg.healthPackage_discountedPrice as price,pd.patientDetails_id,pd.patientDetails_patientName as bookedBy');
        $this->db->from('qyura_healthPkgBooking AS bookhealthpkg');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = bookhealthpkg.healthPkgBooking_miId','left');
        $this->db->join('qyura_city AS city','city.city_id = hos.hospital_cityId','left');
        $this->db->join('qyura_healthPackage AS healthpkg','healthpkg.healthPackage_id = bookhealthpkg.healthPkgBooking_healthPackageId','left');
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_id = bookhealthpkg.healthPkgBooking_userId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = bookhealthpkg.healthPkgBooking_miId','left');
        $this->db->where(array('healthPackage_deleted'=> 0));
        $this->db->order_by("bookhealthpkg.creationTime", "desc"); 
        $this->db->group_by('healthPkgBooking_id');
        

        
        if(!empty($or_like)){
             $this->db->group_start();
             $this->db->or_like($or_like);
             $this->db->group_end();
        }
     
       
        if(!empty($or_where))$this->db->where($or_where);
                
       // $this->db->like($or_where);
        
        $data= $this->db->get(); 
        //echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['miName'] = $val->miName;
            $result[$i]['bookingId'] = $val->bookingId;
            $result[$i]['title'] = $val->packageName;
            $result[$i]['booked by'] = $val->bookedBy;
            $result[$i]['price'] = $val->price;
           $i++;
        }
         return $result;
        
      }
}   

