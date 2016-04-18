<?php

class Doctor_model extends CI_Model {

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

    function fetchSpeciality() {
        /* $this->db->select('specialitiesCat_id,specialitiesCat_name');
          $this->db->from('qyura_specialitiesCat');
         * this table is disable for the time being
         */
        $this->db->select('specialities_id,specialities_name');
        $this->db->from('qyura_specialities');
        $this->db->where(array('specialities_deleted' => 0));
        $this->db->order_by("specialities_name", "asc");
        return $this->db->get()->result();
    }

    function fetchDegree() {
        $this->db->select('degree_id,degree_SName');
        $this->db->from('qyura_degree');
        $this->db->where(array('degree_deleted' => 0));
        $this->db->order_by("degree_SName", "asc");
        return $this->db->get()->result();
    }

    function fetchHospital() {
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_deleted' => 0));
        $this->db->order_by("hospital_name", "asc");
        return $this->db->get()->result();
    }

    function fetchEmail($email, $usersId = NULL) {
        $this->db->select('users_email');
        $this->db->from('qyura_users');
        $this->db->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_users.users_id', 'left');
        if ($usersId) {
            $this->db->where('qyura_users.users_id !=', $usersId);
        }
        $this->db->where('qyura_usersRoles.usersRoles_roleId', 4);
        $this->db->where('qyura_users.users_email', $email);
        $result = $this->db->get();
        //return $this->db->last_query();

        if ($result->num_rows() > 0)
            return 1;
        else
            return 0;
    }

    function fetchHospitalSpeciality($hospitalId) { //
        $this->db->select('hospitalSpecialities_hospitalId,specialities_id,specialities_name');
        $this->db->from('qyura_hospitalSpecialities');
        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_hospitalSpecialities.hospitalSpecialities_specialitiesId', 'left');
        $this->db->where(array('qyura_hospitalSpecialities.hospitalSpecialities_hospitalId' => $hospitalId, 'qyura_specialities.specialities_deleted' => 0));
        $result = $this->db->get();
        return $result->result();
        //return $this->db->last_query();
    }

    function insertDoctorUser($insertData) {
        $this->db->insert('qyura_users', $insertData);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function insertUsersRoles($insertData) {
        $this->db->insert('qyura_usersRoles', $insertData);
        $insert_id = $this->db->insert_id();
        return true;
    }

    function insertDoctorData($insertData, $tableName = NULL) {
        $this->db->insert($tableName, $insertData);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function fetchDoctorData($condition = NULL) {

        $this->db->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,doc.doctors_fName,doc.doctors_lName,CONCAT(doc.doctors_fName," ",doc.doctors_lName)AS doctoesName,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,doc.doctors_registeredMblNo,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_dob,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_end)) As endTime,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_start)) AS startTime,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality,usr.users_email,GROUP_CONCAT(qyura_hospital.hospital_name) AS hospitalName');
        /* $this->db->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,CONCAT(doc.doctors_fname," ",doc.doctors_lname)AS doctoesName,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,
          doc.doctors_countryId,doc.doctors_stateId,doc.doctors_dob,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_end)) As endTime,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_start)) AS startTime, SUM( FROM_UNIXTIME(DISTINCT(qyura_professionalExp.professionalExp_end),"%Y") - FROM_UNIXTIME(DISTINCT(qyura_professionalExp.professionalExp_start),"%Y"))  AS totalExprience,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality,usr.users_email,GROUP_CONCAT(qyura_hospital.hospital_name) AS hospitalName');
         */
        $this->db->from('qyura_doctors AS doc');
        $this->db->join('qyura_city AS City', 'City.city_id = doc.doctors_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = doc.doctors_userId', 'left');
        $this->db->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId = doc.doctors_id', 'left');
        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_professionalExp.professionalExp_specialitiesCatId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_id = qyura_professionalExp.professionalExp_hospitalId', 'left');
        if ($condition)
            $this->db->where(array('doc.doctors_id' => $condition));
        $this->db->where(array('doc.doctors_deleted' => 0));

        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $data->result();
    }
  function getDoctorAvailability($where = array()) {
        
        $doctorAvailability = $this->getDoctorAvailableOnDays($where);
        $result     = array();
        $week       = array();
        $indexId    = array();
        $dayIndex   = array();
        
        if (isset($doctorAvailability) && $doctorAvailability != null) {
            foreach ($doctorAvailability as $availability) {
                
                $tmpAvb = array();
                
                $temAvb['availabilityStatus'] = $availability->AvailabilityStatus;
                $temAvb['AvailabilityId'] = $availability->AvailabilityId;
                $temAvb['dayIndex'] = $availability->day;
                
                $week[] = $availability->day;
                $availabilitySessions = $this->doctorAvailabilitySession($availability->AvailabilityId);
                
                if(isset($availabilitySessions) && $availabilitySessions != null){
                    
                    foreach ($availabilitySessions as $availabilitySession) {
                        
                        $temAvbSess = array();
//                        $temAvb['Name'] = $availabilitySession->miName;
                        $temAvbSess['SessionStart'] = $availabilitySession->SessionStart;
                        $temAvbSess['SessionEnd'] = $availabilitySession->SessionEnd;
                        $temAvbSess['SessionType'] = getDoctorAvailibilitySession($availabilitySession->SessionType);
                        $temAvbSess['SessionTypeIndex'] = $availabilitySession->SessionType;
                        //$temAvbSess = array_merge($temAvbSess,$temAvb['Name']);
                        $temAvb['refferelName'][$availabilitySession->refferalId] = $availabilitySession->miName;
                        $temAvb["session"][$availabilitySession->refferalId][] = (object)$temAvbSess;
                        
                        if(!in_array($availabilitySession->refferalId, $indexId))
                            array_push($indexId, $availabilitySession->refferalId);
                        
                        if(!in_array( $availabilitySession->SessionType, $dayIndex))
                            array_push($dayIndex,  $availabilitySession->SessionType);
                    }
                }
                else  {
                    $temAvb['session'][] = array();
                }
                $result['doctorAvailabilitys'][] = (object)$temAvb;
            }
        }
        $weeks = array('weekIndexs'=>$week);
        $indexId = array('reffreles'=>$indexId);
        $dayIndex = array('dayIndex'=>$dayIndex);
        $result = array_merge($weeks,$result);
        $result = array_merge($dayIndex,$result);
        $result = array_merge($indexId,$result);
//        dump($result);
//        exit(); 
        return (object)$result;
        
    }

    
    function getDoctorAvailabilityBK($where = array()) {
        
        $doctorAvailability = $this->getDoctorAvailableOnDays($where);
        $result = array();
        $week = array();
        
        if (isset($doctorAvailability) && $doctorAvailability != null) {
            foreach ($doctorAvailability as $availability) {
                
                $tmpAvb = array();
                
                $temAvb['availabilityStatus'] = $availability->AvailabilityStatus;
                $temAvb['AvailabilityId'] = $availability->AvailabilityId;
                $temAvb['dayIndex'] = $availability->day;
                
                $week[] = $availability->day;
                
                $availabilitySessions = $this->doctorAvailabilitySession($availability->AvailabilityId);
                
                if(isset($availabilitySessions) && $availabilitySessions != null){
                    
                    $temAvb['session'] = array();
                    $temp = '';
                    foreach ($availabilitySessions as $availabilitySession) {
                        
                        
                        $temAvbSess = array();
                        $temAvbSess['SessionStart'] = $availabilitySession->SessionStart;
                        $temAvbSess['SessionEnd'] = $availabilitySession->SessionEnd;
                        $temAvbSess['SessionType'] = getDoctorAvailibilitySession($availabilitySession->SessionType);
                        $temAvbSess['SessionTypeIndex'] = $availabilitySession->SessionType;
                        $temAvb['session'][] = (object)$temAvbSess;
                    }
                }
                else
                {
                    $temAvb['session'][] = array();
                }
                
                $result['doctorAvailabilitys'][] = (object)$temAvb;
                
            }
        }
        $weeks = array('weekIndexs'=>$week);
        $result = array_merge($weeks,$result);
        return (object)$result;
        
    }

    function doctorAvailabilitySession($doctorAvailabilityId, $refferalId=NULL, $where = array()) {
 
        $con  = array('doctorAvailability_doctorAvailabilityId'=>$doctorAvailabilityId,'doctorAvailabilitySession_deleted'=>0);
        
        if($refferalId !=NULL)
            $con['doctorAvailability_refferalId'] = $refferalId;
        
        $where = array_merge($con,$where);
        $this->db->select("doctorAvailabilitySession_id AS availabilitySessionId, doctorAvailability_refferalId AS refferalId,doctorAvailability_doctorAvailabilityId AS doctorAvailabilityId,doctorAvailabilitySession_start AS SessionStart,doctorAvailabilitySession_end AS SessionEnd,doctorAvailabilitySession_type AS SessionType, "
                . "CASE WHEN (hospital_name is NOT NULL ) THEN `qyura_hospital`.`hospital_name` WHEN (`diagnostic_name`  is NOT NULL ) THEN `qyura_diagnostic`.`diagnostic_name` ELSE CONCAT(`qyura_doctors`.`doctors_fName`,' ',`qyura_doctors`.`doctors_lName`) END AS `miName`" )
                ->from('qyura_doctorAvailabilitySession')
                ->join('qyura_hospital',    "`qyura_hospital`.`hospital_usersId`=`doctorAvailability_refferalId`",    "left")
                ->join('qyura_diagnostic',    "`qyura_diagnostic`.`diagnostic_usersId`=doctorAvailability_refferalId",  "left")
                ->join('qyura_doctors',     "`qyura_doctors`.`doctors_userId`=`doctorAvailability_refferalId`",     "left")
                ->where($where)
                ->group_by('doctorAvailabilitySession_id')
                ->order_by('doctorAvailabilitySession_type, doctorAvailability_refferalId');
        $response = $this->db->get()->result();
//        dump($this->db->last_query());
        return $response;
    }


    function fetchAcademic($doctorId) {
        $this->db->select('qyura_degree.degree_FName AS degreeFullName,qyura_degree.degree_SName AS degreeSmallName, qyura_doctorAcademic.doctorAcademic_id as academic_id, qyura_doctorAcademic.doctorAcademic_degreeId as degreeId, qyura_doctorAcademic.doctorSpecialities_specialitiesCatId as specialitiesCatId, qyura_doctorAcademic.doctorAcademic_doctorsId as doctorsId, qyura_doctorAcademic.doctorAcademic_degreeInsAddress as degreeInsAddress, qyura_doctorAcademic.doctorAcademic_degreeYear as degreeYear');
        $this->db->from('qyura_doctorAcademic');
        $this->db->join('qyura_degree', 'qyura_degree.degree_id = qyura_doctorAcademic.doctorAcademic_degreeId', 'left');
        $this->db->where(array('qyura_doctorAcademic.doctorAcademic_doctorsId' => $doctorId,'qyura_doctorAcademic.doctorAcademic_deleted' => 0));
        $data = $this->db->get();
        return $data->result();
        //echo $this->db->last_query(); exit;
    }

    function fetchExprience($doctorId) {
        $this->db->select('specialities_name,professionalExp_start');
        $this->db->from('qyura_professionalExp');
        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_professionalExp.professionalExp_specialitiesCatId', 'left');
        $this->db->where(array('qyura_professionalExp.professionalExp_usersId' => $doctorId));
        $data = $this->db->get();
        return $data->result();
        //echo $this->db->last_query(); exit;
    }

    function fetchDoctorDataTables() {
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/thumb_100/$1';
        $this->datatables->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,doc.doctors_fname,doc.doctors_lname,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_cityId,DATE_FORMAT(FROM_UNIXTIME(doc.creationTime),"%d-%m-%Y")As joinDate,doc.doctors_mobile,doc.doctors_unqId, SUM( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp,GROUP_CONCAT(qyura_specialities.specialities_name) AS specialityName');
        $this->datatables->from('qyura_doctors AS doc');
        $this->datatables->join('qyura_city AS City', 'City.city_id = doc.doctors_cityId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = doc.doctors_userId', 'left');
        $this->datatables->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=doc.doctors_id', 'left');

        $this->datatables->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_professionalExp.professionalExp_specialitiesCatId', 'left');

        $this->datatables->where(array('doc.doctors_deleted' => 0));

        $this->datatables->order_by("doc.creationTime");
        $this->datatables->group_by("doc.doctors_id");

        $this->datatables->add_column('exp', '$1 Years', 'exp');
        $this->datatables->add_column('name', '$1</br>$2', 'name,doctors_unqId');
        $this->datatables->add_column('consFee', "<i class='fa fa-inr'></i> $1", 'consFee');

        $this->datatables->add_column('doctors_img', '<img class="img-responsive" height="80px;" width="80px;" src=' . $imgUrl . '>', 'doctors_img');

        $this->datatables->add_column('view', '<a disabled class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="doctor/doctorDetails/$1">View Detail</a>', 'doctors_id');

        return $this->datatables->generate();
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
        //echo $this->db->last_query(); exit;
    }

    function createCSVdata($where) {
        $imgUrl = base_url() . 'assets/doctorsImages/thumb/original/';
        $this->db->select('doc.doctors_id,doc.doctors_pin,doc.doctors_userId,doc.doctors_fname,doc.doctors_lname,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId, SUM( FROM_UNIXTIME(qyura_professionalExp.professionalExp_end,"%Y") - FROM_UNIXTIME(qyura_professionalExp.professionalExp_start,"%Y"))  AS exp,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality');
        $this->db->from('qyura_doctors AS doc');
        $this->db->join('qyura_city AS City', 'City.city_id = doc.doctors_cityId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = doc.doctors_userId', 'left');
        $this->db->join('qyura_professionalExp', 'qyura_professionalExp.professionalExp_usersId=doc.doctors_id', 'left');

        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id=qyura_professionalExp.professionalExp_specialitiesCatId', 'left');

        $this->db->where(array('doc.doctors_deleted' => 0));
        //$this->db->where(array('Roles.usersRoles_parentId'=> 0)); // changed
        $this->db->order_by("doc.creationTime", "desc");
        $this->db->group_by("doc.doctors_id");

        $data = $this->db->get();
        //echo $this->db->last_query(); exit;
        $result = array();
        $i = 1;
        foreach ($data->result() as $key => $val) {
            $result[$i]['doctors_img'] = $imgUrl . $val->doctors_img;
            $result[$i]['doctors_name'] = $val->doctors_fname . ' ' . $val->doctors_lname;
            $result[$i]['doctors_unqId'] = $val->doctors_unqId;
            $result[$i]['doctor_addr'] = $val->doctor_addr;
            $result[$i]['speciality'] = $val->speciality;
            $result[$i]['exp'] = $val->exp;
            $result[$i]['date_of_joining'] = date("Y-m-d", $val->creationTime);
            $result[$i]['doctors_phn'] = $val->doctors_phn;
            $result[$i]['doctors_mobile'] = $val->doctors_mobile;
            $i++;
        }
        return $result;
    }
    
    function deleteDoctorAvailability($con=null)
    {
        $this->db->delete('qyura_doctorAvailability', $con); 
        
    }
    
    function getDoctorAvailableOnDays($where)
    {
        $con = array('doctorAvailability_deleted' => 0);
        $where = array_merge($con, $where);

        $this->db->select('doctorAvailability_id AS AvailabilityId,doctorAvailability_docUsersId AS docUsersId,doctorAvailability_day AS day,doctorAvailability_status AS AvailabilityStatus,doctorAvailability_deleted,creationTime,modifyTime')
                ->from('qyura_doctorAvailability')
                ->where($where)
                ->group_by('doctorAvailability_id');
        $doctorAvailability = $this->db->get()->result();
        return $doctorAvailability;
    }
      

}
