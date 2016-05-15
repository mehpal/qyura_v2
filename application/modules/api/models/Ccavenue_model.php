<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ccavenue_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function fetchPatData($where) {

        $this->db->select("patientDetails_mobileNo,concat(patientDetails_patientName,' ',patientDetails_pLastName) patname,patientDetails_address,patientDetails_pin,users_email,users_mobile,state_statename,city_name,country");
        $this->db->from("qyura_patientDetails pat");
        $this->db->join("qyura_users", "qyura_users.users_id=pat.patientDetails_usersId", "left");
        $this->db->join("qyura_country", "qyura_country.country_id=pat.patientDetails_countryId", "left");
        $this->db->join("qyura_state", "qyura_state.state_id=pat.patientDetails_stateId", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=pat.patientDetails_cityId", "left");
        $this->db->where($where);

        //$data = $this->db->get()->row();
        return $data = $this->db->get()->row();
    }

    public function fetchMIdata($centertype, $miid) {

        if ($centertype == 1) {//Hos
            return $this->common_model->fetchSingleData("hospital_usersId as miuserid", "qyura_hospital", array("hospital_id" => $miid));
        } elseif ($centertype == 2) {//DIag
            return $this->common_model->fetchSingleData("diagnostic_usersId as miuserid", "qyura_diagnostic", array("diagnostic_id" => $miid));
        } elseif ($centertype == 3) {//Indi
            return $this->common_model->fetchSingleData("doctors_userId as miuserid", "qyura_doctors", array("doctors_id" => $miid));
        }
        return false;
    }

}