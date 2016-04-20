<?php

class Pharmacy_model extends MY_model {

    function __construct() {
        parent::__construct();
    }

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
        //s $this->db->where('qyura_usersRoles.usersRoles_roleId', 5);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        // return $this->db->last_query(); exit;

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function insertPharmacyUser($insertData) {
        $this->db->insert('qyura_users', $insertData);
        $insert_id = $this->db->insert_id();
        // echo $this->db->last_query();exit;
        return $insert_id;
    }

    function insertPharmacy($insertData) {
        //echo "here";exit;
        $this->db->insert('qyura_pharmacy', $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return $insert_id;
    }

    function fetchpharmacyData($condition = NULL) {
        $this->db->select('pharmacy.pharmacy_id,pharmacy.pharmacy_docatId,pharmacy.pharmacy_usersId,City.city_name,pharmacy.pharmacy_name, (CASE pharmacy_type  WHEN  1 THEN "Medicine" WHEN 2 THEN "Homyopathic" WHEN  3 THEN "Herbal" END) as pharmacy_type, pharmacy.pharmacy_address,pharmacy.pharmacy_phn,pharmacy.pharmacy_img,pharmacy.pharmacy_cntPrsn, (CASE pharmacy_mmbrTyp WHEN 1 THEN "Life Time" WHEN 2 THEN "Health Club" END) AS pharmacy_mmbrTyp ,usr.users_id,usr.users_email, (CASE pharmacy_27Src WHEN 0 THEN "No" WHEN 1 THEN "Yes"  END) as pharmacy_27Src ,pharmacy.pharmacy_lat,pharmacy.pharmacy_long,pharmacy_zip,pharmacy_countryId,pharmacy_stateId,pharmacy_cityId,pharmacy_background_img, pharmacy.pharmacy_isManual, pharmacy.pharmacy_mobl');
        $this->db->from('qyura_pharmacy AS pharmacy');
        $this->db->join('qyura_city AS City', 'City.city_id = pharmacy.pharmacy_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = pharmacy.pharmacy_usersId', 'left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = pharmacy.pharmacy_usersid','left'); // changed
        if ($condition)
            $this->db->where(array('pharmacy.pharmacy_id' => $condition));
        $this->db->where(array('pharmacy.pharmacy_deleted' => 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("pharmacy.creationTime", "desc");
        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
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

    function fetchPharmacyDataTables($condition = NULL) {

        $imgUrl = base_url() . 'assets/pharmacyImages/thumb/thumb_100/$1';

        $this->datatables->select('pharmacy.pharmacy_id as id,pharmacy.pharmacy_usersId,City.city_name,pharmacy.pharmacy_name,pharmacy.pharmacy_type,pharmacy.pharmacy_address, TRIM( TRAILING "|" FROM pharmacy_phn) as pharmacy_phn ,pharmacy.pharmacy_img,pharmacy.pharmacy_cntPrsn,pharmacy.pharmacy_mmbrTyp,usr.users_id,usr.users_email,pharmacy.pharmacy_27Src,pharmacy.pharmacy_lat,pharmacy.pharmacy_long,pharmacy.status as sts');
        $this->datatables->from('qyura_pharmacy AS pharmacy');
        $this->datatables->join('qyura_city AS City', 'City.city_id = pharmacy.pharmacy_cityId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = pharmacy.pharmacy_usersId', 'left');


        $search = $this->input->post('name');
        if ($search) {
            $this->db->group_start();
            $this->db->or_like('pharmacy.pharmacy_name', $search);
            $this->db->or_like('pharmacy.pharmacy_address', $search);
            $this->db->or_like('pharmacy.pharmacy_phn', $search);
            $this->db->group_end();
        }

        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('pharmacy_cityId', $city) : '';

        $states = $this->input->post('status');
        isset($states) && $states != '' ? $this->datatables->where('pharmacy.status', $states) : '';



        if ($condition)
            $this->datatables->where(array('pharmacy.pharmacy_id' => $condition));
        $this->datatables->where(array('pharmacy.pharmacy_deleted' => 0));

        $this->datatables->add_column('pharmacy_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'pharmacy_img');

         $this->datatables->add_column('status', '$1', 'statusCheck(pharmacy,qyura_pharmacy,pharmacy_id,id,sts)');
         
        $this->datatables->add_column('pharmacy_address', '$1 </br><a  href="pharmacy/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'pharmacy_address,id');

        $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="pharmacy/detailPharmacy/$1">View Detail</a> <a href="#"  class="btn btn-success waves-effect waves-light m-b-5 applist-btn hide">Edit Detail</a>', 'id');
        $this->datatables->order_by("pharmacy.creationTime");
        return $this->datatables->generate();
        // echo $this->datatables->last_query();
    }

    function createCSVdata($where, $orWhere = NULL) {
        $imgUrl = base_url() . 'assets/pharmacyImages/thumb/original/';
        $this->db->select('pharmacy_name,city_name,pharmacy_phn,pharmacy_address');
        $this->db->from('qyura_pharmacy');
        $this->db->order_by('pharmacy_id', 'desc');
        $this->db->join('qyura_city', 'city_id = pharmacy_cityId', 'left');

        if ($orWhere != null) {
            $this->db->group_start();
            $this->db->or_like($orWhere);
            $this->db->group_end();
        }

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
            // $result[$i]['pharmacy_img'] = $imgUrl . $val->pharmacy_img;
            $result[$i]['pharmacy_name'] = $val->pharmacy_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['phone'] = $val->pharmacy_phn;
            $result[$i]['pharmacy_address'] = $val->pharmacy_address;
            $i++;
        }
        return $result;
    }

    function fetchTableData($select = array(), $tableName, $condition = array(), $notIn = array(), $fieldName = '') {
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

    // check existence
    function checkExisting($email) {

        $query = 'SELECT count(users_id) as isExit FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_HOSPITAL . ' AND (SELECT count(users_id) FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_PHARMACY . ' ) > 0 ';

        $data = $this->db->query($query)->result();

        if ($data[0]->isExit == 1) {

            echo json_encode(array('status' => 0, 'message' => 'already exist'));
        } elseif ($data[0]->isExit == 0) {

            $query2 = 'SELECT count(users_id) userId, hospital_address, hospital_lat, hospital_long, hospital_usersId FROM qyura_users INNER JOIN qyura_usersRoles ON qyura_users.users_id = qyura_usersRoles.usersRoles_userId INNER JOIN qyura_hospital ON qyura_hospital.hospital_usersId = qyura_users.users_id WHERE users_email = "' . $email . '" AND usersRoles_roleId = ' . ROLE_HOSPITAL . ' ';
            $getData = $this->db->query($query2)->row();

            if (isset($getData) && $getData != NULL) {

                echo json_encode(array('status' => 1, 'message' => 'hospital exist', 'address' => $getData[0]->hospital_address, 'lat' => $getData[0]->hospital_lat, 'lng' => $getData[0]->hospital_long, 'userId' => $getData[0]->hospital_usersId));
            } else {

                echo json_encode(array('status' => 2, 'message' => 'new user'));
            }
        }
    }

}
