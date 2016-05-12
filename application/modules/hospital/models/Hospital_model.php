<?php

class Hospital_model extends My_model {

    function __construct() {
        parent::__construct();
    }

    
       // fetch award agency
   function fetchAwardAgency() {
        $this->db->select('awardAgency_id,agency_name');
        $this->db->from('qyura_awardAgency');
        $this->db->where(array('agency_deleted' => 0, 'status' => 1));
        $this->db->order_by("agency_name", "asc");
        $this->db->group_by("awardAgency_id");
        return $this->db->get()->result();
    }
    
   // fetch all cities associated to hospital
   function allCities() {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_cityId=qyura_city.city_id', 'right');
        $this->datatables->where_in('qyura_hospital.status', array(0,1));
        $this->db->order_by("city_name", "asc");
        $this->db->group_by("city_id");
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

    function checkUserExistence($email) {
        $query = 'SELECT count(users_id) as isExit FROM qyura_users  WHERE users_email = "' . $email . '" ';

        $data = $this->db->query($query)->result();
        // echo $data[0]->isExit; exit;
        if ($data[0]->isExit == 1) {
            echo json_encode(array('status' => 0, 'message' => 'User already exist'));
        } else {
            echo json_encode(array('status' => 1, 'message' => 'new user'));
        }
    }

    // remove insurance company from hospital
    function deletInsurance($id = null) {
        $response = '';
        if ($id != null)
            $response = $this->db->delete('qyura_hospitalInsurance', array('hospitalInsurance_id' => $id));

        if ($response) {
            echo json_encode(array('status' => 1, 'message' => 'insurance successfully reomved!'));
        } else {
            echo json_encode(array('status' => 0, 'message' => 'some error occurred while removing insurance company!'));
        }
    }

    function fetchCity($stateId = NULL) {
        $this->db->select('city_id,city_name');
        $this->db->from('qyura_city');
        if ($stateId != null)
            $this->db->where('city_stateid', $stateId);
        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }

    function getHospitalType() {
        $this->db->select('hospitalType_id,hospitalType_name');
        $this->db->from('qyura_hospitalType');
        $this->db->where('hospitalType_deleted', 0);
        $this->db->where('hospitalType_miRole',1);
        $this->db->order_by("hospitalType_name", "asc");
        return $this->db->get()->result();
    }

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId', 1);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        //return $this->db->last_query();

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function inserHospitalUser($insertData) {

        $this->db->insert('qyura_users', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertHospital($insertData) {

        $this->db->insert('qyura_hospital', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertBloodbank($insertData) {

        $this->db->insert('qyura_bloodBank', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertPharmacy($insertData) {
        $this->db->insert('qyura_pharmacy', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertTableData($tableName, $insertData = array()) {
        $this->db->insert($tableName, $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query(); exit;
        return $insert_id;
    }

    function insertAmbulance($insertData) {
        $this->db->insert('qyura_ambulance', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertHospitalServiceName($insertData) {
        $this->db->insert('qyura_hospitalServices', $insertData);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function fetchHospitalData($conditionId = NULL) {
        $this->db->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_phn,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId,Hos.isEmergency,Blood.bloodBank_name,Blood.bloodBank_phn,Blood.bloodBank_photo, Pharmacy.pharmacy_name,Pharmacy.pharmacy_phn, Hos.hospital_type,Hos.hospital_dsgn,usr.users_mobile,Hos.hospital_mmbrTyp,Hos.hospital_background_img,Ambu.ambulance_name,Ambu.ambulance_phn,Ambu.ambulance_img, Hos.hospital_type as hosTypeId, hosType.hospitalType_name as hosType, Hos.isManual as isManual, Hos.hospital_mbl, Hos.hospital_aboutUs, Hos.availibility_24_7, Hos.hasPharmacy, Ambu.docOnBoard , Hos.docatId, Hos.specialityNameFormate, Ambu.ambulance_id, Blood.bloodBank_id, Hos.isBloodBankOutsource, Hos.hasBloodbank');
        
        $this->db->from('qyura_hospital AS Hos');
        $this->db->join('qyura_city AS City', 'City.city_id = Hos.hospital_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = Hos.hospital_usersId', 'left');
        
        $this->db->join('qyura_bloodBank AS Blood', 'Blood.users_id = Hos.hospital_usersId', 'left');
        $this->db->join('qyura_pharmacy AS Pharmacy', 'Pharmacy.pharmacy_usersId = Hos.hospital_usersId', 'left');
        $this->db->join('qyura_ambulance AS Ambu', 'Ambu.ambulance_usersId = Hos.hospital_usersId', 'left');
        
        $this->db->join('qyura_hospitalType AS hosType', 'hosType.hospitalType_id = Hos.hospital_type', 'left');
        //$this->db->join('qyura_usersRoles AS Roles','Roles.usersRoles_userId = Hos.hospital_usersid','left'); // changed
        if ($conditionId) {
            $this->db->where(array('Hos.hospital_id' => $conditionId));
        }
        $this->db->where(array('Hos.hospital_deleted' => 0));
        $this->datatables->where_in('Hos.status', array(0,1));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("Hos.creationTime", "desc");
        $data = $this->db->get();
        return $data->result();
        // echo $this->db->last_query(); exit;
        //echo "<pre>";print_r($data);echo "</pre>";
        //exit;
    }

    function insertUsersRoles($insertData) {
        $this->db->insert('qyura_usersRoles', $insertData);
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

    function fetchHospitalDataTables($condition = NULL) {

        $imgUrl = base_url() . 'assets/hospitalsImages/thumb/thumb_100/$1';

        $this->datatables->select('Hos.hospital_id,Hos.hospital_zip,Hos.hospital_usersId,Hos.hospital_name,Hos.hospital_address,City.city_name,Hos.hospital_img,Hos.hospital_cntPrsn,usr.users_email,Hos.hospital_lat,Hos.hospital_long,usr.users_id,
        Hos.hospital_countryId,Hos.hospital_stateId,Hos.hospital_cityId,Hos.hospital_phn,Hos.status');
        $this->datatables->from('qyura_hospital AS Hos');
        $this->datatables->join('qyura_city AS City', 'City.city_id = Hos.hospital_cityId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = Hos.hospital_usersId', 'left');


        $search = $this->input->post('name');
        if ($search) {
            $this->db->group_start();
            $this->db->or_like('Hos.hospital_name', $search);
            $this->db->or_like('Hos.hospital_phn', $search);
            $this->db->or_like('Hos.hospital_address', $search);
            $this->db->group_end();
        }

        $city = $this->input->post('cityId');
        isset($city) && $city != '' ? $this->datatables->where('hospital_cityId', $city) : '';

        $states = $this->input->post('hosStateId');
        isset($states) && $states != '' ? $this->datatables->where('hospital_stateId', $states) : '';
        
        $status = $this->input->post('status');
        isset($status) && $status != '' ? $this->datatables->where('Hos.status', $status) : '';



        if ($condition)
        $this->datatables->where(array('Hos.hospital_id' => $condition));
        $this->datatables->where(array('Hos.hospital_deleted' => 0));
        $this->datatables->where_in('Hos.status', array(0,1));

        $this->datatables->add_column('hospital_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'hospital_img');

        $this->datatables->add_column('hospital_address', '$1 </br><a  href="hospital/map/$2" class="btn btn-info btn-xs waves-effect waves-light" target="_blank">View Map</a>', 'hospital_address,hospital_id');

        $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="hospital/detailHospital/$1">View Detail</a>', 'hospital_id');
         
        
         $this->datatables->add_column('status', '$1', 'checkStatus(status,hospital_id)');
        
        $this->datatables->order_by("Hos.creationTime");
        
        return $this->datatables->generate();
        // echo $this->datatables->last_query();
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

    function fetchInsurance($hospitalId) {
        $this->db->select('Hos.hospitalInsurance_id,Hos.hospitalInsurance_insuranceId,Insu.insurance_Name,Insu.insurance_img');
        $this->db->from('qyura_hospitalInsurance AS Hos');
        $this->db->join('qyura_insurance AS Insu', 'Insu.insurance_id = Hos.hospitalInsurance_insuranceId', 'left');
        $this->db->where(array('Hos.hospitalInsurance_hospitalId' => $hospitalId, 'Insu.insurance_deleted' => 0, 'Hos.hospitalInsurance_deleted' => 0));

        $data = $this->db->get();
        return $data->result();
    }

    function fetchAllInsurance($insurance_condition = array()) {
        $this->db->select('insurance_id,insurance_Name,insurance_img,insurance_detail');
        $this->db->from('qyura_insurance');
        $this->db->where(array('insurance_deleted' => 0));
        if (!empty($insurance_condition))
            $this->db->where_not_in('insurance_id', $insurance_condition);
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
    }

    function fetchAwards($hospitalId) {
        $this->db->select('hospitalAwards_awardsName,hospitalAwards_id,hospitalAwards_awardYear, qyura_awardAgency.agency_name as hospitalAwards_awardsAgency, qyura_awardAgency.awardAgency_id');
        $this->db->from('qyura_hospitalAwards');
        $this->db->join('qyura_awardAgency', 'qyura_awardAgency.awardAgency_id = qyura_hospitalAwards.hospitalAwards_awardsAgency');
        $this->db->where(array('hospitalAwards_deleted' => 0, 'hospitalAwards_hospitalId' => $hospitalId));
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
    }

    function fetchServices($hospitalId) {
        $this->db->select('hospitalServices_id,hospitalServices_serviceName');
        $this->db->from('qyura_hospitalServices');
        $this->db->where(array('hospitalServices_deleted' => 0, 'hospitalServices_hospitalId' => $hospitalId));
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
    }

    function fetchhospitalSpecialityData($hospitalId) {
        $this->db->select('Spl.specialities_name,Hspl.hospitalSpecialities_id,Hspl.hospitalSpecialities_specialitiesId');
        $this->db->from('qyura_hospitalSpecialities AS Hspl');
        $this->db->join('qyura_specialities AS Spl', 'Spl.specialities_id = Hspl.hospitalSpecialities_specialitiesId', 'left');
        $this->db->where(array('Hspl.hospitalSpecialities_hospitalId' => $hospitalId, 'Hspl.hospitalSpecialities_deleted' => 0, 'Spl.specialities_deleted' => 0));
        $this->db->order_by("Hspl.hospitalSpecialities_orderForHos", "asc");
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
    }

    function fetchhospitalDiagonasticData($hospitalId) {
        $this->db->select('Dia.diagnosticsCat_catName,Hdia.hospitalDiagnosticsCat_hospitalId,Hdia.hospitalDiagnosticsCat_id,Hdia.hospitalDiagnosticsCat_diagnosticsCatId');
        $this->db->from('qyura_diagnosticsCat AS Dia');
        $this->db->join('qyura_hospitalDiagnosticsCat AS Hdia', 'Hdia.hospitalDiagnosticsCat_diagnosticsCatId = Dia.diagnosticsCat_catId', 'left');
        $this->db->where(array('Hdia.hospitalDiagnosticsCat_hospitalId' => $hospitalId, 'Hdia.hospitalDiagnosticsCat_deleted' => 0, 'Dia.diagnosticsCat_deleted' => 0));
        $this->db->order_by("Hdia.creationTime", "desc");
        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
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

    function fetchHospitalDoctorDataTables($hospitalUserId) {

        $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        $doctorUrl = site_url() . '/hospital/detailHospital/$2/doctor/$1/editDoctor';
        $timeUrl = site_url() . '/hospital/detailHospital/$2/doctor/$1/timeSlot';
        $this->datatables->select('doctors_userId userId,qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, qyura_doctors.doctors_consultaionFee as consFee, GROUP_CONCAT(qyura_specialities.specialities_name) as specialityName,qyura_doctors.doctors_phon,qyura_doctors.doctors_img ,qyura_doctors.doctors_mobile,qyura_doctors.doctors_unqId, qyura_hospital.hospital_id, qyura_doctors.doctors_showExp,qyura_doctors.status,qyura_doctors.doctors_expYear as exp'); 

        $this->datatables->from('qyura_doctors');
        
        $this->datatables->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_doctors.doctors_parentId', 'left');
       
     //   $this->datatables->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=qyura_doctors.doctors_id', 'left');


        $this->datatables->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left');
        $this->datatables->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left');

        $this->db->group_by('doctors_id');
        
        $this->db->order_by('doctors_id', 'desc');


        $search = $this->input->post('doctor_search');
        if ($search) {
            $this->db->group_start();
            $this->db->or_like('qyura_doctors.doctors_fName', $search);
            $this->db->or_like('qyura_doctors.doctors_phn', $search);
            $this->db->or_like('qyura_doctors.doctors_consultaionFee', $search);
            $this->db->or_like('qyura_specialities.specialities_name', $search);
            $this->db->or_like('qyura_doctors.doctors_expYear', $search);
            $this->db->group_end();
        }

        $this->datatables->where(array('doctors_deleted' => 0, 'doctors_roll' => 9, 'doctors_parentId' => $hospitalUserId));

        $this->datatables->add_column('exp', '$1 Years', 'getDocExp(exp)');
        $this->datatables->add_column('name', '$1</br>$2', 'name,doctors_unqId');
        $this->datatables->add_column('consFee', "<i class='fa fa-inr'></i> $1", 'consFee');

        $this->datatables->add_column('doctors_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'doctors_img');

        $this->datatables->add_column('view', '<a class="btn btn-info waves-effect waves-light m-b-5 applist-btn" href=' .$doctorUrl. '>Edit Detail</a><a class="btn btn-info waves-effect waves-light m-b-5 applist-btn" href=' .$timeUrl. '>Edit Time Slot</a>', 'id,hospital_id');
        $this->datatables->add_column('status', '$1', 'statusCheck(doctor, qyura_doctors, doctors_id, id, status)');

        return $this->datatables->generate();
    }

    function createCSVdata($where, $orWhere = null) {
        $imgUrl = base_url() . 'assets/hospitalImages/thumb/original/';
        $this->db->select('hospital_name, city_name, hospital_phn, hospital_address');
        $this->db->from('qyura_hospital');
        $this->db->order_by('hospital_id','desc');
        $this->db->join('qyura_city', 'city_id = hospital_cityId', 'left');
        if($orWhere != null){
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
            //$result[$i]['hospital_img'] = $imgUrl . $val->hospital_img;
            $result[$i]['hospital_name'] = $val->hospital_name;
            $result[$i]['city_name'] = $val->city_name;
            $result[$i]['hospital_phn'] = $val->hospital_phn;
            $result[$i]['hospital_address'] = $val->hospital_address;
            $i++;
        }
        return $result;
    }
    
    
   
   
   
   function getDoctorDeatil($condition){
       
       
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        $this->db->select('doc.doctors_id, doc.doctors_27Src, doc.isManual,doc.doctors_consultaionFee,doc.doctors_pin,doc.doctors_userId,doc.doctors_fName,doc.doctors_lName,CONCAT(doc.doctors_fName," ",doc.doctors_lName)AS doctoesName,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,doc.doctors_email,doc.doctors_phon,doc.doctors_lat,doc.doctors_long,usr.users_id,doc.doctors_registeredMblNo,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_dob,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId,usr.users_email, doc.doctors_email, doc.doctors_phon, doc.doctors_showExp,doc.doctors_expYear,spec.specialities_id,spec.specialities_name as specName,deg.degree_id,deg.degree_SName,deg.degree_FName,docAca.doctorAcademic_id,docAca.doctorAcademic_degreeId,docAca.doctorAcademic_degreeInsAddress,docAca.doctorAcademic_degreeYear,docAca.doctorAcademic_specialitiesId');
       
        $this->db->from('qyura_doctors AS doc');
        $this->db->join('qyura_city AS City', 'City.city_id = doc.doctors_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = doc.doctors_userId', 'left');
        $this->db->join('qyura_doctorSpecialities as docSpec', 'docSpec.doctorSpecialities_doctorsId=doc.doctors_id', 'left');
        $this->db->join('qyura_specialities as spec', 'spec.specialities_id=docSpec.doctorSpecialities_specialitiesId', 'left');
        $this->db->join('qyura_doctorAcademic as docAca', 'docAca.doctorAcademic_doctorsId=doc.doctors_id', 'left');
        $this->db->join('qyura_degree as deg', 'deg.degree_id=docAca.doctorAcademic_degreeId', 'left');
        if ($condition)
        $this->db->where(array('doc.doctors_id' => $condition));
        $this->db->where(array('doc.doctors_deleted' => 0));
        //$this->db->where(array('docSpec.doctorSpecialities_deleted' => 0));
       // $this->db->where(array('spec.specialities_deleted' => 0,'spec.type' => 1));
        //$this->db->where(array('deg.degree_deleted' => 0));
        //$this->db->where(array('docAca.doctorAcademic_deleted' => 0));
        return  $this->db->get()->result();

 
   }
  
   function getDocAcaSpec($condition){
       
        $this->db->select('spec.specialities_id, docAca.doctorAcademic_id, degree.degree_FName, degree.degree_SName, degree.degree_id, docAca.doctorAcademic_degreeInsAddress, docAca.doctorAcademic_degreeYear');
       
        $this->db->from('qyura_doctorAcademic AS docAca');
       // $this->db->join('qyura_doctors as doc', 'doc.doctors_id=docAca.doctorAcademic_doctorsId', 'left');
        $this->db->join('qyura_specialities as spec', 'spec.specialities_id=docAca.doctorAcademic_specialitiesId', 'left');
        $this->db->join('qyura_degree as degree', 'degree.degree_id = docAca.doctorAcademic_degreeId', 'left');
        
        if ($condition)
            
        $this->db->where(array('docAca.doctorAcademic_doctorsId' => $condition));
        
       // $this->db->where(array('doc.doctors_deleted' => 0));
        $this->db->where(array('spec.specialities_deleted' => 0,'spec.type' => 1));
        $this->db->where(array('docAca.doctorAcademic_deleted' => 0));
        return  $this->db->get()->result();

 
   }
}