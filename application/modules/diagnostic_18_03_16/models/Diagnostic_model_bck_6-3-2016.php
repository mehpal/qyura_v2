<?php

class Diagnostic_model extends CI_Model {

    function __construct() {
        parent::__construct();
        
    }

    function fetchCountry() {
        $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country", "asc");
        return $this->db->get()->result();
    }

    function fetchStates($countryId = NULL) {
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        if (!empty($countryId))
            $this->db->where('state_countryid', $countryId);

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

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId', 3);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        //return $this->db->last_query();

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function insertDiagnosticUser($insertData) {
        $this->db->insert('qyura_users', $insertData);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertDiagnostic($insertData) {
        $this->db->insert('qyura_diagnostic', $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return $insert_id;
    }

    function fetchdiagnosticData($condition = NULL) {
        $this->db->select('diag.diagnostic_mbrTyp,diag.diagnostic_email,diag.diagnostic_dsgn,diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,diag.diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId,usr.users_mobile,diag.diagnostic_background_img');
        $this->db->from('qyura_diagnostic AS diag');
        $this->db->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = diag.diagnostic_usersid','left'); // changed
        if ($condition)
            $this->db->where(array('diag.diagnostic_id' => $condition));
        $this->db->where(array('diag.diagnostic_deleted' => 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("diag.creationTime", "desc");
        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
        //echo $this->db->last_query(); exit;
        //echo "<pre>";print_r($data);echo "</pre>";
        //exit;
    }

    function insertUsersRoles($insertData) {
        $this->db->insert('qyura_usersRoles', $insertData);
        $insert_id = $this->db->insert_id();
        return true;
    }

    function UpdateTableData($data = array(), $where = array(), $tableName = NULL) {
        foreach ($where as $key => $val) {
            $this->db->where($key, $val);
        }

        $this->db->update($tableName, $data);

        //echo $this->db->last_query();exit;
        return TRUE;
    }
    
    function fetchDiagnosticDoctorDataTables($diagonsticUserId){
        
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        
      $this->datatables->select('doctors_userId userId,qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, qyura_doctors.doctors_consultaionFee as consFee, qyura_specialities.specialities_name as specialityName,qyura_doctors.doctors_phn,qyura_doctors.doctors_img,qyura_doctors.doctors_id,qyura_doctors.doctors_mobile,qyura_doctors.doctors_unqId,( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp');
        
                $this->datatables->from('qyura_usersRoles');
                              
                $this->datatables->join('qyura_doctors','qyura_doctors.doctors_userId = usersRoles_userId', 'left');
  

                $this->datatables->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left');

                    
                $this->datatables->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left');
                $this->datatables->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left');
                     
        
         $this->datatables->where(array('doctors_deleted' => 0, 'usersRoles_roleId' => 4, 'usersRoles_parentId'=> $diagonsticUserId));

        $this->datatables->add_column('exp', '$1 Years', 'exp');
        $this->datatables->add_column('name', '$1</br>$2', 'name,doctors_unqId');
        $this->datatables->add_column('consFee', "<i class='fa fa-inr'></i> $1", 'consFee');
        
        $this->datatables->add_column('doctors_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'doctors_img');

        $this->datatables->add_column('view', '<a disabled class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="#">View Detail</a>', 'doctors_id');

        return $this->datatables->generate();
    }

    function fetchDiagnosticDataTables($condition = NULL) {

        $imgUrl = base_url() . 'assets/diagnosticsImage/thumb/thumb_100/$1';

        $this->datatables->select('diag.diagnostic_id,diag.diagnostic_zip,diag.diagnostic_usersId,diag.diagnostic_name,diag.diagnostic_phn,diag.diagnostic_address,City.city_name,coalesce(diag.diagnostic_img, "noImage.png") as diagnostic_img,diag.diagnostic_cntPrsn,usr.users_email,diag.diagnostic_lat,diag.diagnostic_long,usr.users_id,diag.diagnostic_countryId,diag.diagnostic_stateId,diag.diagnostic_cityId');
        
        $this->datatables->from('qyura_diagnostic AS diag');
        $this->datatables->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');


        $search = $this->input->post('bloodBank_name');
        if ($search) {
            $this->db->or_like('diag.diagnostic_name', $search);
            $this->db->or_like('diag.diagnostic_phn', $search);
            $this->db->or_like('diag.diagnostic_address', $search);
        }

        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('diagnostic_cityId', $city) : '';

        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('diagnostic_stateId', $states) : '';

        $this->datatables->order_by('diagnostic_id');

        if ($condition)
            $this->datatables->where(array('diag.diagnostic_id' => $condition));
        $this->datatables->where(array('diag.diagnostic_deleted' => 0));

        $this->datatables->add_column('diagnostic_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'diagnostic_img');

        $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="diagnostic/detailDiagnostic/$1">View Detail</a>', 'diagnostic_id');

        return $this->datatables->generate();
    }
    
        //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }
    
     //Function for delete
    public function customDelete($options) {
        $table = false;
        $where = false;

        extract($options);

        if (!empty($where))
            $this->db->where($where);

        $this->db->delete($table);

        return $this->db->affected_rows();
    }
     //Function for get
    public function customGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $where_not_in = false;
        $group_by = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }


        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {

                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                }
            }
        }
        if($group_by != false){
            $this->db->group_by($group_by);
        }


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }
    
    //Function for update
    public function customUpdate($options) {
        $table = false;
        $where = false;
        $orwhere = false;
        $data = false;

        extract($options);

        if (!empty($where)) {
            $this->db->where($where);
        }

        // using or condition in where  
        if (!empty($orwhere)) {
            $this->db->or_where($orwhere);
        }
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }
    
    function fetchdiagnosticsDiagnosticCatData($diagnosticId){
           
         $this->db->select('Spl.diagnosticsCat_catName,Dspl.diagnosticsHasCat_id,Dspl.diagnosticsHasCat_diagnosticId,Dspl.diagnosticsHasCat_diagnosticsCatId');
         
        $this->db->from('qyura_diagnosticsHasCat AS Dspl');
        $this->db->join('qyura_diagnosticsCat AS Spl','Spl.diagnosticsCat_catId = Dspl.diagnosticsHasCat_diagnosticsCatId','left');
        
        $this->db->where(array('Dspl.diagnosticsHasCat_diagnosticId' => $diagnosticId,'Spl.diagnosticsCat_deleted' => 0));
        $this->db->order_by("Dspl.creationTime", "desc"); 
        $data= $this->db->get();
        return $data->result();
      }
      
      function fetchdiagnosticsSpecialityData($diagnosticId){
           
         $this->db->select('Spl.specialities_name,Dspl.diagnosticSpecialities_id,Dspl.diagnosticSpecialities_specialitiesId,Dspl.diagnosticSpecialities_diagnosticId');
         
        $this->db->from('qyura_diagnosticSpecialities AS Dspl');
        $this->db->join('qyura_specialities AS Spl','Spl.specialities_id = Dspl.diagnosticSpecialities_specialitiesId','left');
        
        $this->db->where(array('Dspl.diagnosticSpecialities_diagnosticId' => $diagnosticId,'Dspl.diagnosticSpecialities_deleted' => 0));
        $this->db->order_by("Dspl.creationTime", "desc"); 
        $data= $this->db->get();
        return $data->result();
      }
      
    function fetchTableData($select = array(),$tableName,$condition = array(),$notIn = array(),$fieldName =''){

        $this->db->select(implode(",",$select));
        $this->db->from($tableName);
        foreach($condition as $key=>$val){
            $this->db->where($key, $val); 
        }
        if(!empty($notIn))
            $this->db->where_not_in($fieldName,$notIn);
        $data= $this->db->get(); 
      
     return $data->result();
    }
    
    function createCSVdata($where){
        $imgUrl = base_url() . 'assets/diagnosticsImage/thumb/original/';
        $this->db->select('diagnostic_img,diagnostic_name,city_name,SUBSTRING(diagnostic_phn, 1, CHAR_LENGTH(diagnostic_phn)-1)AS phone,diagnostic_address');
        $this->db->from('qyura_diagnostic');
        $this->db->join('qyura_city','city_id = diagnostic_cityId','left');
        foreach($where as $key=>$val){
           
            if($where[$key] === 0){
            $this->db->where($key, $val); 
            }
            if($where[$key] != ''){
            $this->db->where($key, $val); 
            }
        }
    
        $data= $this->db->get(); 
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['diagnostic_img'] = $imgUrl.$val->diagnostic_img;
            $result[$i]['diagnostic_name'] = $val->diagnostic_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['diagnostic_phn'] = $val->phone;
            $result[$i]['diagnostic_address'] = $val->diagnostic_address;
           $i++;
        }
         return $result;
        
      }
}
