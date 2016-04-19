<?php

class Sponser_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function fetchCategory() {
        $this->db->select('category_id,category_name');
        $this->db->from('qyura_healthCategory');
        $this->db->order_by("category_name", "asc");
        return $this->db->get()->result();
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
    function fetchAllMIDoc()
    {
        $query = "SELECT doctors_id as sponId, doctors_userId as user_id, concat( doctors_fName, ' ', doctors_lName ) AS sponName, '4' AS roleid
FROM qyura_doctors
WHERE doctors_deleted =0
UNION
SELECT diagnostic_id, diagnostic_usersId, diagnostic_name, '3' AS roleid
FROM qyura_diagnostic
WHERE diagnostic_deleted =0
UNION
SELECT hospital_id, hospital_usersId, hospital_name, '1' AS roleid
FROM qyura_hospital
WHERE hospital_deleted =0";
        $data = $this->db->query($query);
        return $data->result();
    }

    //Prachi
    function fetchSponserData($where, $start, $per_page) {

        $this->db->select('HTip.healthTips_id,HTip.healthTips_image,HTip.healthTips_categoryId,SUBSTRING(HTip.healthTips_detail, 1, 150) healthTips_detail,HTip.healthTips_amount,Cat.category_name');
        $this->db->from('qyura_healthTips AS HTip');
        $this->db->join('qyura_healthCategory Cat', 'HTip.healthTips_categoryId = Cat.category_id');
        $this->db->join('qyura_healthTipSponsor Sp', 'Sp.sponsor_tipId = HTip.healthTips_id', "left");

        $this->db->where($where);

        $this->db->where(array('HTip.healthTips_deleted' => 0));
        $this->db->group_by('HTip.healthTips_id');
        $this->db->order_by("HTip.creationTime", "desc");

        $this->db->limit($per_page, $start);
        $data = $this->db->get();

        return $data->result();
    }

    function fetchSponserDataCount($where) {

        $this->db->select('HTip.healthTips_image,HTip.healthTips_categoryId,HTip.healthTips_detail,HTip.healthTips_amount,Cat.category_name');
        $this->db->from('qyura_healthTips AS HTip');
        $this->db->join('qyura_healthCategory Cat', 'HTip.healthTips_categoryId = Cat.category_id');

        $this->db->where($where);

        $this->db->where(array('HTip.healthTips_deleted' => 0));
        $this->db->order_by("HTip.creationTime", "desc");
        $data = $this->db->get();

        return $data->result();
    }

    function getSponserdetails($healthtipid = NULL) {

        $this->db->select('Htip.healthTips_id,Htip.healthTips_categoryId,Htip.healthTips_detail,Htip.healthTips_image,Htip.healthTips_image,healthTips_amount,Hcat.category_name');
        $this->db->from('qyura_healthTips Htip');
        $this->db->join('qyura_healthCategory Hcat', 'Hcat.category_id=Htip.healthTips_categoryId');

        $this->db->where(array('Htip.healthTips_id' => $healthtipid));
        $data = $this->db->get();

        $res = $data->result();
        return $res[0];
        //echo $this->db->last_query();exit;
    }

    function fetchsponserdates($where) {

        $this->db->select('Spon.sponsor_id,Spon.sponsor_date');
        //$this->db->select('Htip.healthTips_id,Htip.healthTips_categoryId,Htip.healthTips_detail,Htip.healthTips_image,Htip.healthTips_image,healthTips_amount,Hcat.category_name');
        $this->db->from('qyura_healthTipSponsor Spon');

        $this->db->where($where);
	$this->db->where('Spon.sponsor_deleted','0');
        $data = $this->db->get();
        return $data->result();
       
    }

    function fetchCategories() {
        $this->db->select('category_id,category_name');
        $this->db->from('qyura_healthCategory');
        $this->db->where("category_deleted", "0");
        $this->db->order_by("category_name", "asc");
        return $this->db->get()->result();
    }

    function insertTableData($tableName, $insertData = array()) {
        $this->db->insert($tableName, $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query(); exit;
        return $insert_id;
    }

    function insertHealthtip($insertData) {

        $this->db->insert('qyura_healthTips', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function UpdateTableData($data = array(), $where = array(), $tableName = NULL) {
        foreach ($where as $key => $val) {
            $this->db->where($key, $val);
        }

        $this->db->update($tableName, $data);

        //echo $this->db->last_query();exit;
        return TRUE;
    }

    function fetchTableData($select = array(), $tableName, $condition = array(), $notIn = array(), $fieldName = '') {
        //echo 
        $this->db->select(implode(",", $select));
        $this->db->from($tableName);
        foreach ($condition as $key => $val) {
            $this->db->where($key, $val);
        }
        if (!empty($notIn))
            $this->db->where_not_in($fieldName, $notIn);
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
        //echo $this->db->last_query(); exit;
    }

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
        if ($group_by != false) {
            $this->db->group_by($group_by);
        }


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }

    //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }

    function deleteTable($tableName, $where = array()) {
        $this->db->delete($tableName, $where);
        return TRUE;
    }

    function fetchBookedSponser($conditionId = NULL) {
        $this->db->select("healthTips_detail,healthTips_image,healthTips_amount,category_name,city_name,sponsor_date,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName,' ',doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype");
        $this->db->from('qyura_healthTipSponsor AS Spon');
        $this->db->join('qyura_healthTips AS HTip', "Spon.sponsor_tipId=HTip.healthTips_id");
        $this->db->join('qyura_healthCategory Cat', 'HTip.healthTips_categoryId = Cat.category_id');
        $this->db->join('qyura_city Ct', 'Ct.city_id = Spon.sponsor_cityId');


        if ($conditionId) {
            $this->db->where(array('HTip.healthTips_id' => $conditionId));
        }
        $this->db->where(array('Spon.sponsor_deleted' => 0));
        $this->db->order_by("Spon.sponsor_date", "desc");

        $data = $this->db->get();
        return $data->result();
    }

    

    function fetchHealthtipDataTables($condition = NULL) {



        $this->datatables->select("Spon.sponsor_id,healthTips_detail,healthTips_image,healthTips_amount,category_name,city_name,FROM_UNIXTIME(sponsor_date,'%d-%m-%Y') sponsor_date,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName,' ',doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype");
        $this->datatables->from('qyura_healthTipSponsor AS Spon');
        $this->datatables->join('qyura_healthTips AS HTip', "Spon.sponsor_tipId=HTip.healthTips_id");
        $this->datatables->join('qyura_healthCategory Cat', 'HTip.healthTips_categoryId = Cat.category_id');
        $this->datatables->join('qyura_city Ct', 'Ct.city_id = Spon.sponsor_cityId');

        $search = $this->input->post('search_val');

        if ($search) {
            $this->db->or_like('Cat.category_name', $search);
            $this->db->or_like('Ct.city_name', $search);
        }
        if ($condition) {
            $this->datatables->where(array('HTip.healthTips_id' => $conditionId));
        }
        $this->datatables->where(array('Spon.sponsor_deleted' => 0));
        $this->datatables->order_by("Spon.sponsor_date", "desc");


//        $this->datatables->add_column('view','<a class="fa fa-trash" href="javascript:deleteBookedSponsor($1)"></a>', 'sponsor_id');
	$this->datatables->add_column('view', '<a class="btn btn-appointment waves-effect waves-light m-b-5 applist-btn" href="javascript:deleteBookedSponsor($1)">Delete</a>', 'sponsor_id');
        $this->datatables->order_by("Spon.sponsor_date");
        return $this->datatables->generate();
    }
    
    function createCSVdata($where){
      
        
        
   $this->db->select("healthTips_detail,healthTips_image,healthTips_amount,category_name,city_name,sponsor_date,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN (select hospital_name from qyura_hospital hos where hos.hospital_usersId=sponsor_userId)  
WHEN (Spon.sponser_userRole = 3 ) THEN (select diagnostic_name from qyura_diagnostic diag where diag.diagnostic_usersId=sponsor_userId) 
WHEN (Spon.sponser_userRole = 4 ) THEN (select concat(doctors_fName,' ',doctors_lName) from qyura_doctors doc where doc.doctors_userId=sponsor_userId)  end as miname,
CASE 
WHEN (Spon.sponser_userRole = 1 ) THEN 'Hospital'  
WHEN (Spon.sponser_userRole = 3 ) THEN 'Diagnostic Center' 
WHEN (Spon.sponser_userRole = 4 ) THEN 'Doctor'  end as mitype");
        $this->db->from('qyura_healthTipSponsor AS Spon');
        $this->db->join('qyura_healthTips AS HTip', "Spon.sponsor_tipId=HTip.healthTips_id");
        $this->db->join('qyura_healthCategory Cat', 'HTip.healthTips_categoryId = Cat.category_id');
        $this->db->join('qyura_city Ct', 'Ct.city_id = Spon.sponsor_cityId');


        if ($where) {
            $this->db->where($where);
        }
        $this->db->where(array('Spon.sponsor_deleted' => 0));
        $this->db->order_by("Spon.sponsor_date", "desc");
    
       $data= $this->db->get(); 
       $result= array();
       $i=1;
       foreach($data->result() as $key=>$val){
           
            $result[$i]['miname'] = $val->miname;
            $result[$i]['mitype'] = $val->mitype;
            $result[$i]['sponsordate'] = $val->sponsor_date;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['category_name'] = $val->category_name;
            
           $i++;
        }
         return $result;
        
      }

}
