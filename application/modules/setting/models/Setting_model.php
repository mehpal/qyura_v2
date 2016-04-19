<?php

class Setting_model extends CI_Model {

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

    function getAdmin($userId = '') {

        $this->db->select('qyura_users.users_id,qyura_users.users_username,qyura_users.users_password,qyura_users.users_email,'
                        . 'qyura_users.users_mobile,qyura_patientDetails.patientDetails_countryId,qyura_patientDetails.patientDetails_stateId,qyura_patientDetails.patientDetails_patientName as name,'
                        . 'qyura_patientDetails.patientDetails_cityId,qyura_patientDetails.patientDetails_dob,qyura_patientDetails.patientDetails_address,qyura_patientDetails.patientDetails_pin,qyura_patientDetails.patientDetails_patientImg')
                ->from('qyura_users')
                ->join("qyura_usersRoles", "qyura_usersRoles.usersRoles_userId = qyura_users.users_id", "left")
                ->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId = qyura_users.users_id", "left")
                ->where(array('qyura_users.users_id' => $userId,
                    'qyura_users.users_deleted' => 0,
                    'qyura_usersRoles.usersRoles_roleId' => 7
        ));

        return $this->db->get()->result();
    }

}
