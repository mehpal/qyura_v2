<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ccavenue_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
       
    }

   
    public function fetchPatData($where) {
        
         $this->db->select("patientDetails_mobileNo,patientDetails_patientName,patientDetails_address,patientDetails_pin,users_email,users_mobile,state_statename,city_name,country")
                ->from("qyura_patientDetails pat")
                ->join("qyura_users", "qyura_users.users_id=pat.patientDetails_usersId", "left")
                ->join("qyura_country", "qyura_country.country_id=pat.patientDetails_countryId", "left")
                ->join("qyura_state", "qyura_state.state_id=pat.patientDetails_stateId", "left")
                ->join("qyura_city", "qyura_city.city_id=pat.patientDetails_cityId", "left")
                ->where($where);
       return $data = $this->db->get()->row();
       
    }
    
}
