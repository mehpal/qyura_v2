<?php

//Developed by: Rajmander
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_model extends CI_Model {

    public $configCustomData = array();

    public function __construct() {
        parent::__construct();
        // set config custom data in array
        $this->configCustomData = $this->config->item('customData');
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

    //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
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
        $group_by = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

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

        if ($group_by != false) {

            $this->db->group_by($group_by);
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


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }

    public function customQuery($query, $single = false, $updDelete = false, $noReturn = false) {
        $query = $this->db->query($query);

        if ($single) {
            return $query->row();
        } elseif ($updDelete) {
            return $this->db->affected_rows();
        } elseif (!$noReturn) {
            return $query->result();
        } else {
            return true;
        }
    }

    public function customQueryCount($query) {
        return $this->db->query($query)->num_rows();
    }

    function customCount($options) {
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;

        extract($options);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

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

        return $this->db->count_all_results();
    }

    //Send Mail 
    function customMail($data = false) {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1'; // or utf-8 for html mail
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['wordwrap'] = TRUE;
        $config['validation'] = TRUE; // bool whether to validate email or not  
        $config['charset'] = "utf-8";

        $this->load->library('email', $config);

        if (!$data)
            return FALSE;

        $cc = '';

        if (isset($data['cc']) && (!empty($data['cc']))) {
            $cc = $data['cc'];
        }

        $this->email->from($this->configCustomData['verif_email'], $this->configCustomData['verif_name']);
        $this->email->to($data['toEmail']);
        $this->email->cc($cc);
        $this->email->subject($data['subject']);
        //$this->email->message('Testing the email class. <br /> TEST Again <br /> <h1> H1 Heading </h1>');
        $this->email->message($data['message'] . $data['body']);
        $status = (bool) $this->email->send();
        return $status;
    }

    function getData($tbl = null, $select = null, $con = null, $orderBy = null, $limit = null, $join = null, $between = null, $multiple = TRUE) {
//        pre($this->db->database);

        if ($select != null) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        $this->db->from($tbl);

        if ($join != null) {
            foreach ($join as $j) {
                $type = 'inner';
                if (isset($j['type']))
                    $type = $j['type'];

                $this->db->join($j['table'], $j['relation'], $type);
            }
        }

        if ($con != null)
            $this->db->where($con);

        if ($between != null)
            $this->db->where($between);

        if ($orderBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->order_by($orderBy);

        if ($limit != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->limit($limit);

        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            if ($multiple) {
                return $query->result();
            } else {
                return $query->row();
            }
        } else
            return FALSE;
    }

    public function user_check($where = '', $select = '*') {
        if (empty($where)) {
            return FALSE;
        }

        return $this->db->select($select)->where($where)
                        ->order_by("users_id", "ASC")
                        ->limit(1)
                        ->get('qyura_users')->row();
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
        if ($countryId != null)
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

    // fetch all publish hospital 
    function fetchPublishHospital() {
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        $this->db->where('status', 3);
        $this->db->order_by("hospital_name", "asc");
        $this->db->group_by("hospital_id");
        return $this->db->get()->result();
    }

    // fetch all publish hospital 
    function fetchHosByStatus($status = 3) {
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        if ($status != null)
            $this->db->where('status', $status);
        $this->db->order_by("hospital_name", "asc");
        $this->db->group_by("hospital_id");
        return $this->db->get()->result();
    }

    // fetch all publish hospital 
    function fetchDigByStatus($status = 3) {
        $this->db->select('diagnostic_id,diagnostic_name');
        $this->db->from('qyura_diagnostic');
        if ($status != null)
            $this->db->where('status', $status);
        $this->db->order_by("diagnostic_name", "asc");
        $this->db->group_by("diagnostic_id");
        return $this->db->get()->result();
    }

    function getHospitaldetail($hospitalId) {
        $this->db->select('hospital_address,hospital_address as address,isManual,hospital_zip,hospital_zip as zip,hospital_countryId as countryId,hospital_countryId,hospital_stateId,hospital_stateId as stateId,hospital_cityId,hospital_cityId as cityId,hospital_lat as lat,hospital_lat,hospital_long as long,hospital_long,hospital_name,hospital_name as name');
        $this->db->from('qyura_hospital');
        $this->db->where("hospital_id", "$hospitalId");
        $rows = $this->db->get()->row();


        if (!empty($rows)) {

            // selected country
            $this->db->select('country_id,country');
            $this->db->from('qyura_country');
            $this->db->order_by("country", "asc");
            $allCountry = $this->db->get()->result();

            $countrySelected = '<option>Select Country</option>';
            foreach ($allCountry as $key => $val) {
                $selected = '';
                if ($val->country_id == $rows->countryId)
                    $selected = 'selected="selected"';
                $countrySelected .= '<option ' . $selected . ' value="' . $val->country_id . '">' . $val->country . '</option>';
            }

            // selected state
            $this->db->select('state_id,state_statename');
            $this->db->from('qyura_state');
            $this->db->where('state_countryid', $rows->countryId);
            $this->db->order_by("state_statename", "asc");
            $allState = $this->db->get()->result();

            $stateSelected = '<option>Select State</option>';

            foreach ($allState as $key => $val) {
                $selected = '';
                if ($val->state_id == $rows->stateId)
                    $selected = 'selected="selected"';
                $stateSelected .= '<option ' . $selected . ' value="' . $val->state_id . '">' . $val->state_statename . '</option>';
            }

            // selected city
            $this->db->select('city_id,city_name');
            $this->db->from('qyura_city');
            $this->db->where('city_stateid', $rows->stateId);
            $this->db->order_by("city_name", "asc");
            $allCity = $this->db->get()->result();

            $citySelected = '<option>Select City</option>';

            foreach ($allCity as $key => $val) {
                $selected = '';
                if ($val->city_id == $rows->cityId)
                    $selected = 'selected="selected"';
                $citySelected .= '<option ' . $selected . ' value="' . $val->city_id . '">' . $val->city_name . '</option>';
            }

            echo json_encode(array('status' => 1, 'address' => $rows->address, 'country' => $countrySelected, 'state' => $stateSelected, 'city' => $citySelected, 'zipCode' => $rows->zip, 'lat' => $rows->lat, 'lng' => $rows->long, 'name' => $rows->name));
        } else {
            echo json_encode(array('status' => 0));
        }
    }
    
     function getDiagnosticdetail($diagnoId){
        $this->db->select('diagnostic_address, isManual, diagnostic_zip, diagnostic_countryId, diagnostic_stateId, diagnostic_cityId, diagnostic_lat, diagnostic_long, diagnostic_name');
        $this->db->from('qyura_diagnostic');
        $this->db->where("diagnostic_id", "$diagnoId");
        $rows =  $this->db->get()->row();
      
         
        if (!empty($rows)) {
             
        // selected country
        $this->db->select('country_id,country');
        $this->db->from('qyura_country');
        $this->db->order_by("country", "asc");
        $allCountry = $this->db->get()->result();
        
        $countrySelected = '<option>Select Country</option>';
        foreach ($allCountry as $key=>$val){
            $selected = '';
            if($val->country_id == $rows->diagnostic_countryId) $selected = 'selected="selected"';
            $countrySelected .= '<option '.$selected.' value="'.$val->country_id.'">'.$val->country.'</option>';
            
        }
        
        // selected state
        $this->db->select('state_id,state_statename');
        $this->db->from('qyura_state');
        $this->db->where('state_countryid', $rows->diagnostic_countryId);
        $this->db->order_by("state_statename", "asc");
        $allState = $this->db->get()->result();
        
        $stateSelected = '<option>Select State</option>';
       
        foreach ($allState as $key=>$val){
             $selected = '';
            if($val->state_id == $rows->diagnostic_stateId)$selected = 'selected="selected"';
            $stateSelected .= '<option '.$selected.' value="'.$val->state_id.'">'.$val->state_statename.'</option>';
        }
        
        // selected city
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->where('city_stateid', $rows->diagnostic_stateId);
        $this->db->order_by("city_name", "asc");
        $allCity =  $this->db->get()->result();
        
        $citySelected = '<option>Select City</option>';
       
        foreach ($allCity as $key=>$val){
            $selected = '';
            if($val->city_id == $rows->diagnostic_cityId)$selected = 'selected="selected"';
            $citySelected .= '<option '.$selected.' value="'.$val->city_id.'">'.$val->city_name.'</option>';
        }
        
            echo json_encode(array('status' => 1, 'address' => $rows->diagnostic_address, 'country' => $countrySelected, 'state' => $stateSelected, 'city' => $citySelected, 'zipCode' => $rows->diagnostic_zip, 'lat' => $rows->diagnostic_lat, 'lng' => $rows->diagnostic_long, 'name' => $rows->diagnostic_name));
        } else {
            echo json_encode(array('status' => 0));
        }
        
   }
    // end changes by hemant

    function allHosCities() {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_cityId=qyura_city.city_id', 'right');
        $this->db->order_by("city_name", "asc");
        $this->db->group_by("city_id");
        return $this->db->get()->result();
    }
    
     function fetchEmail($email,$role = NULL,$usersId = NULL){
       $this->db->select('users_email,users_id');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where('qyura_users.users_id !=',$usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId',$role);
         $this->db->where('qyura_users.users_email',$email); 
        $result = $this->db->get();
       //return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    }
    function fetchMobileNo($mobileNo,$role = NULL,$usersId = NULL){
       $this->db->select('users_mobile,users_id');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles','qyura_usersRoles.usersRoles_userId = qyura_users.users_id','left');
        if($usersId) {
            $this->db->where('qyura_users.users_id !=',$usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId',$role);
         $this->db->where('qyura_users.users_mobile',$mobileNo); 
        $result = $this->db->get();
       //return $this->db->last_query();
       
        if($result->num_rows() > 0)
            return 1;
        else             
            return 0; 
    }
//OTP
    function sendSms($mobileNo,$mess){
        $post_data = array(
            // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
            // For promotional, this will be ignored by the SMS gateway
            'From' => '08039534362',
            'To'   => $mobileNo,
            'Priority' => 'high',
            'Body' => "$mess", //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
        );

        $exotel_sid = "qyura"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
        $exotel_token = "d89273da48e34ce6c9c080d87f2ebe48415282b3"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings

        $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

        curl_close($ch);
        if (!empty($http_result) && $http_result != NULL && $error == '') {
            return '1';
        }else{
            return '0';
        }
    }

   function sendMail($from,$to,$message){
        $this->email->from($from, 'Team Qyura');
        $this->email->to($to);
        $this->email->subject("Qyura");
        $this->email->message($message);
        $send = $this->email->send();

        if($send){ return '1';}else{ return '0';}
    }

}
