<?php

class Dashboard_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function fetchHospital() {
        $this->db->select('hospital_id,hospital_name');
        $this->db->from('qyura_hospital');
        $this->db->where(array('hospital_deleted' => 0));
        $this->db->order_by("hospital_name", "asc");
        return $this->db->get()->result();
    }

    function getMiCount() {

        $sql = "SELECT (SELECT COUNT(*) FROM qyura_hospital  WHERE status = 1 AND hospital_deleted = 0) +"
                . " (SELECT COUNT(*) FROM qyura_diagnostic WHERE status = 1 AND diagnostic_deleted = 0) as totalMi";

        $qry = $this->db->query($sql);
        return $qry->result();
    }

    function getDoctorCount() {
        $sql = "SELECT COUNT(*) as totalDoctoras FROM qyura_doctors   WHERE status = 1 AND doctors_deleted = 0";

        $qry = $this->db->query($sql);
        return $qry->result();
    }

    function getUserCount() {
        $sql = "SELECT COUNT(*) as totalUser FROM qyura_users users "
                . "INNER JOIN qyura_usersRoles ON qyura_usersRoles.usersRoles_userId=users.users_id "
                . " WHERE qyura_usersRoles.usersRoles_roleId = 6 AND users.users_active = 1 AND users.users_deleted = 0";

        $qry = $this->db->query($sql);
        return $qry->result();
    }

    function getMiList() {

                $sql = "SELECT 'hospital' AS `type`,`hospital_id` as `id`, `hospital_usersId` as `userId`,CONCAT('assets/hospitalsImages','/',hospital_img) as imUrl, qyura_hospital.hospital_name as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
                FROM `qyura_hospital`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_hospital`.`hospital_usersId`
                LEFT JOIN `qyura_membership` ON `qyura_membership`.`membership_id` = `qyura_hospital`.`hospital_mmbrTyp`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_hospital`.`hospital_cityId`
                WHERE `qyura_hospital`.`hospital_deleted` = 0 
                AND `qyura_hospital`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 1

                union all

                SELECT 'diagnostic' AS `type`,`diagnostic_id` as `id`, `diagnostic_usersId` as `userId`, CONCAT('assets/diagnosticsImage','/',diagnostic_img) as imUrl, qyura_diagnostic.diagnostic_name as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
                FROM `qyura_diagnostic`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId`=`qyura_diagnostic`.`diagnostic_usersId`
                LEFT JOIN `qyura_membership` ON `qyura_membership`.`membership_id` = `qyura_diagnostic`.`diagnostic_mbrTyp`
                 LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_diagnostic`.`diagnostic_cityId`
                WHERE `qyura_diagnostic`.`diagnostic_deleted` = 0 
                AND `qyura_usersRoles`.`usersRoles_roleId` = 3 
                AND `qyura_diagnostic`.`status` = 1 ";

        $qry = $this->db->query($sql);
        return $qry->result();
    }
    
    function getDoctorList() {

                $sql = "`doctors_id` as `id`, `doctors_userId` as `userId`,CONCAT('assets/hospitalsImages','/',hospital_img) as imUrl, doctors_userId.doctors_fName as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
                FROM `qyura_doctors`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_doctors`.`doctors_userId`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_doctors`.`doctors_cityId`
                WHERE `qyura_doctors`.`doctors_deleted` = 0 
                AND `qyura_doctors`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 6";

        $qry = $this->db->query($sql);
        return $qry->result();
    }
    
    
    

    function fetchDoctorData($condition = NULL) {

        $this->db->select('doc.doctors_id,doc.isManual,doc.doctors_pin,doc.doctors_userId,doc.doctors_fName,doc.doctors_lName,CONCAT(doc.doctors_fName," ",doc.doctors_lName)AS doctoesName,doc.doctors_phn,doc.doctor_addr,City.city_name,doc.doctors_img,usr.users_email,doc.doctors_lat,doc.doctors_long,usr.users_id,doc.doctors_registeredMblNo,
        doc.doctors_countryId,doc.doctors_stateId,doc.doctors_dob,doc.doctors_cityId,doc.creationTime,doc.doctors_mobile,doc.doctors_unqId,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_end)) As endTime,GROUP_CONCAT(DISTINCT(qyura_professionalExp.professionalExp_start)) AS startTime,GROUP_CONCAT(qyura_specialities.specialities_name) AS speciality,usr.users_email,GROUP_CONCAT(qyura_hospital.hospital_name) AS hospitalName');
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

}
