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
    
 function fetchusercity(){
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_cityId = qyura_city.city_id');
        $this->db->group_by("city_name"); 
        return $this->db->get()->result();
    }
    function fetchCities() {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');

        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }

    //Function for insert


    function fetchinsurance() {
        $this->db->select('insurance_Name,insurance_id');
        $this->db->from('qyura_insurance');
        $this->db->order_by("insurance_Name", "asc");
        return $this->db->get()->result();
    }

    function checkUserExistence($email, $id) {
        $query = 'SELECT count(users_id) as isExit FROM qyura_users  WHERE users_email = "' . $email . '" and users_id != "' . $id . '"';
        $data = $this->db->query($query)->result();
        if ($data[0]->isExit >= 1) {
            echo json_encode(FALSE);
        } else {
            echo json_encode(TRUE);
        }
    }

    function fetchfamilyMember() {
        $this->db->select('relation_type,relation_id');
        $this->db->from(' qyura_familyRelation');
        $this->db->order_by("relation_type", "asc");
        return $this->db->get()->result();
    }

    function fetchUsersDataTables($condition = NULL) {

        $imgUrl = base_url() . 'assets/usersImage/thumb/thumb_100/$1';

        $this->datatables->select('patient.patientDetails_id as id,patient.patientDetails_usersId,patient.patientDetails_unqId,City.city_name,patient.patientDetails_patientName,patient.patientDetails_address,patient.patientDetails_mobileNo,patient.patientDetails_patientImg,patient.patientDetails_dob,patient.status as sts,Users.users_id as user_id,Users.status as user_status,usersRoles.usersRoles_roleId');

        $this->datatables->from('qyura_patientDetails AS patient');
        $this->datatables->join('qyura_city AS City', 'City.city_id = patient.patientDetails_cityId', 'left');
        $this->datatables->join('qyura_users AS Users', 'Users.users_id = patient.patientDetails_usersId', 'left');
        $this->datatables->join('qyura_usersRoles AS usersRoles', 'usersRoles.usersRoles_userId = Users.users_id', 'left');
        
        $search = $this->input->post('bloodBank_name');
        if ($search) {
            $this->db->or_like('patient.patientDetails_patientName', $search);
            $this->db->or_like('patient.patientDetails_address', $search);
            $this->db->or_like('patient.patientDetails_mobileNo', $search);
        }

        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('patientDetails_cityId', $city) : '';

        $states = $this->input->post('status');
        isset($states) && $states != '' ? $this->datatables->where('patient.status', $states) : '';


        $this->datatables->order_by('patientDetails_id');

        if ($condition)
            $this->datatables->where(array('patient.ambulance_id' => $condition));

        $this->datatables->where(array('patient.patientDetails_deleted' => 0,'usersRoles.usersRoles_roleId' => 6));

        $this->datatables->add_column('patientDetails_patientImg', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'patientDetails_patientImg');
       $this->datatables->add_column('patientDetails_patientName', '<h6>$1</h6><p>$2</p>', 'patientDetails_patientName,patientDetails_unqId');
        $this->datatables->add_column('patientDetails_dob', '$1', 'getDateFormat(patientDetails_dob)');

        $this->datatables->add_column('status', '$1', 'statusCheck(users,qyura_users,users_id,user_id,user_status)');

        $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="users/editUserView/$1">Edit</a>', 'patientDetails_usersId');

        return $this->datatables->generate();
        // echo $this->datatables->last_query();
    }



}
