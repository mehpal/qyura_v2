<?php

class Reviews_model extends CI_Model {

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

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId', 8);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        //return $this->db->last_query();

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }
    
    
    function fetchReviews($params = array()) {
        $this->db->select('qyura_reviews.reviews_id,qyura_reviews.reviews_userId,qyura_reviews.reviews_details,'
                . 'qyura_reviews.reviews_rating,qyura_reviews.creationTime,(CASE WHEN (hospital_name is not null) THEN hospital_name WHEN (diagnostic_name is not null) THEN diagnostic_name WHEN (doctors_fName is not null) THEN CONCAT(doctors_fName, " ",doctors_lName) END) AS reviewTo,CONCAT(patientDetails_patientName, " ",patientDetails_pLastName) as reviewBy,'
                . 'qyura_patientDetails.patientDetails_patientImg,'
                . 'FROM_UNIXTIME(qyura_reviews.creationTime,"%H:%i:%s") AS times,'
                . '(CASE WHEN (hospital_name is not null) THEN hospital_usersId WHEN (diagnostic_name is not null) THEN diagnostic_usersId WHEN (doctors_fName is not null) THEN doctors_userId END) AS MiUserId,qyura_reviews-post.status as publish,'
                . 'qyura_reviews-post.reviews_post_details');
        
        
        $this->db->from('qyura_reviews');
        $this->db->join('qyura_users as users','users.users_id=qyura_reviews.reviews_userId');
        $this->db->join('qyura_patientDetails','qyura_patientDetails.patientDetails_usersId=users.users_id');
        $this->db->join('qyura_users','qyura_users.users_id=qyura_reviews.reviews_relateId','left');
        $this->db->join('qyura_hospital','qyura_hospital.hospital_usersId=qyura_users.users_id','left');  
        $this->db->join('qyura_diagnostic','qyura_diagnostic.diagnostic_usersId=qyura_users.users_id','left');
        $this->db->join('qyura_doctors','qyura_doctors.doctors_userId=qyura_users.users_id','left');
        $this->db->join('qyura_reviews-post','qyura_reviews-post.reviews_post_reviewsId=qyura_reviews.reviews_id','left');
        
        
        $this->db->where(array("qyura_reviews.reviews_deleted" => 0));
        
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

        if(array_key_exists("filter",$params)){
            if(!empty($params['filter']) &&  $params['filter'] == 'rated'){
                
               $this->db->order_by('qyura_reviews.reviews_rating','desc'); 
               
            }elseif(!empty($params['filter']) &&  $params['filter'] == 'all'){
 
                $this->db->order_by('qyura_reviews.creationTime','desc');  
            }else{
                $this->db->order_by('qyura_reviews.creationTime','desc');
            }

        }else{
            $this->db->order_by('qyura_reviews.creationTime','desc');
        }
        
        
        if(array_key_exists("sDate",$params) && array_key_exists("eDate",$params)){
              if(!empty($params['sDate']) &&  !empty($params['eDate'])){
                  
                    $this->db->where('qyura_reviews.creationTime >=', strtotime(date('Y-m-d',strtotime($params['sDate']))));
                    $this->db->where('qyura_reviews.creationTime <=', strtotime(date('Y-m-d' ,strtotime($params['eDate']))));
              }else{
                  $this->db->order_by('qyura_reviews.creationTime','desc');
              }

        }elseif(!array_key_exists("sDate",$params) && array_key_exists("eDate",$params)){
             $this->db->order_by('qyura_reviews.creationTime','desc');
        }
        
        
        $qry = $this->db->get();
        //return $this->db->last_query();
        return ($qry->num_rows() > 0)?$qry->result_array():FALSE;
        
    }

    function fetchReviewRatingTopRated($condition = NULL) {
         $current = date('Y-m-d');
         $this->db->select('qyura_doctors.doctors_id,qyura_doctors.doctors_userId,qyura_doctors.doctors_img,'
                 . 'CONCAT(doctors_fName, " ",doctors_lName) as name,qyura_ratings.rating,qyura_reviews.reviews_rating,'
                 . '(
                    CASE 
                     WHEN (qyura_reviews.reviews_rating is not null AND qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(qyura_reviews.reviews_rating+qyura_ratings.rating))/2, 1)
                     WHEN (qyura_reviews.reviews_rating is not null) 
                     THEN 
                          ROUND( (AVG(qyura_reviews.reviews_rating)), 1)
                     WHEN (qyura_ratings.rating is not null) 
                     THEN
                          ROUND( (AVG(qyura_ratings.rating)), 1)
                     END)
                     AS rat,
                     (CASE WHEN (hospital_name is not null) THEN hospital_name WHEN (diagnostic_name is not null) 
                     THEN diagnostic_name END) as MIname,
                     (CASE WHEN (hospital_name is not null) THEN qyura_city.city_name WHEN (diagnostic_name is not null) 
                     THEN qyura_city.city_name END) as cityName,
                     FROM_UNIXTIME((CASE WHEN (qyura_ratings.creationTime >= qyura_reviews.creationTime) THEN
                     qyura_ratings.creationTime 
                     ELSE qyura_reviews.creationTime END) 
                     ) as time,DATEDIFF("'.$current.'",FROM_UNIXTIME((CASE WHEN (qyura_ratings.creationTime >= 
                     qyura_reviews.creationTime) THEN
                     qyura_ratings.creationTime 
                     ELSE qyura_reviews.creationTime END) 
                     )) AS days');

        
        $this->db->from('qyura_doctors');
        $this->db->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left');
        $this->db->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left');
        
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_doctors.doctors_userId', 'left');
        
        $this->db->join('qyura_hospital','qyura_hospital.hospital_usersId=qyura_usersRoles.usersRoles_parentId','left');  
        $this->db->join('qyura_diagnostic','qyura_diagnostic.diagnostic_usersId=qyura_usersRoles.usersRoles_parentId','left');
        $this->db->join('qyura_city','qyura_city.city_id=qyura_hospital.hospital_cityId OR qyura_diagnostic.diagnostic_cityId','left');
       // $this->db->join('qyura_city','qyura_city.city_id=qyura_diagnostic.diagnostic_cityId AND ','left');
        
        $this->db->where(array("qyura_doctors.doctors_deleted" => 0));
        $this->db->group_by("qyura_doctors.doctors_id");
        $this->db->order_by('rat','desc');
        
        $qry = $this->db->get();
        //return $this->db->last_query();
        return $qry->result();
        
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
        if ($group_by != false) {
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

    function fetchTableData($select = array(), $tableName, $condition = array(), $notIn = array(), $fieldName = ''){
        $this->db->select(implode(",", $select));
        $this->db->from($tableName);
        foreach ($condition as $key => $val) {
            $this->db->where($key, $val);
        }
        if (!empty($notIn))
            $this->db->where_not_in($fieldName, $notIn);
        $data = $this->db->get();
        return $data->result();
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
    
    function createCSVdata($where) {
        $imgUrl = base_url() . 'assets/ambulanceImages/thumb/original/';
        $this->db->select('ambulance_img,ambulance_name,city_name, SUBSTRING(ambulance_phn, 1, CHAR_LENGTH(ambulance_phn)-1)AS phone,ambulance_address');
        $this->db->from('qyura_ambulance');
        $this->db->join('qyura_city', 'city_id = ambulance_cityId', 'left');
        foreach ($where as $key => $val) {

            if ($where[$key] === 0) {
                $this->db->where($key, $val);
            }
            if ($where[$key] != '') {
                $this->db->where($key, $val);
            }
        }

        $data = $this->db->get();
        $result = array();
        $i = 1;
        foreach ($data->result() as $key => $val) {
            $result[$i]['ambulance_img'] = $imgUrl . $val->ambulance_img;
            $result[$i]['ambulance_name'] = $val->ambulance_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['ambulance_phn'] = $val->phone;
            $result[$i]['ambulance_address'] = $val->ambulance_address;
            $i++;
        }
        return $result;
    }

}
