<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HealthpkgBooking_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    public function bookHealthPkg($table, $data) {

        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();

        if ($id) {
            $unique_id = 'hpk' . $id;
            $this->db->update($table, array('healthPkgBooking_orderNo' => $unique_id), array('healthPkgBooking_id' => $id));
        }

        return $id;
    }

    public function getMyBookedHealthPkg($where) {
        $this->db->select('healthPkgBooking_id as pkgId, healthPackage_packageTitle as title, healthPackage_discountedPrice as price, ( CASE WHEN(healthPkgBooking_bkStatus = 0) THEN "Pending" WHEN(healthPkgBooking_bkStatus = 1) THEN "Completed" WHEN(healthPkgBooking_bkStatus = 2) THEN "Cancelled" END) as status, qyura_healthPkgBooking.creationTime as bookingDate');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->where($where);
        $this->db->where(array('healthPackage_deleted' => 0, 'qyura_healthPackage.status' => 1));
        $this->db->order_by('qyura_healthPkgBooking.creationTime', 'desc');
        return $this->db->get()->result();
    }

    public function getHealpkgDetail($healthPkgBookingId) {

        $healthPkgBookingId = isset($healthPkgBookingId) ? $healthPkgBookingId : '';

        $this->db->select('healthPackage_packageTitle name, healthPackage_discountedPrice price, ( CASE WHEN(healthPkgBooking_bkStatus = 0) THEN "Pending" WHEN(healthPkgBooking_bkStatus = 1) THEN "Completed" END) as status, qyura_healthPkgBooking.creationTime as bookingDate');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->where(array('healthPkgBooking_deleted' => 0, 'healthPackage_deleted' => 0, 'healthPkgBooking_id' => $healthPkgBookingId, 'qyura_healthPackage.status' => 1));
        return $this->db->get()->result();
    }

    public function getHealpkgTest($healthPkgBookingId) {

        $healthPkgBookingId = isset($healthPkgBookingId) ? $healthPkgBookingId : '';

        $this->db->select('healthPackage_includesTest');
        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');

        $this->db->where(array('healthPkgBooking_deleted' => 0, 'healthPkgBooking_id' => $healthPkgBookingId, 'healthPackage_deleted' => 0, 'qyura_healthPackage.status' => 1));

        $finalResult = array();


        $data = $this->db->get()->result();

        if (!empty($data)) {
            $test = $data[0]->healthPackage_includesTest;
            $response = explode('|', $test);

            if (!empty($response) && $response != '') {
                foreach ($response as $row) {
                    $finalTemp = array();
                    $finalTemp['testName'] = isset($row) && $row != '' ? $row : "";
                    $finalResult[] = $finalTemp;
                }
                return $finalResult;
            } else {
                return $finalResult;
            }
        } else {
            return $finalResult;
        }
    }

    public function cancelBooking($table, $data, $where) {

        $data = $this->_filter_data($table, $data);

        $this->db->update($table, $data, $where);

        $id = $this->db->affected_rows();

        return $id;
    }

    public function getUpcomingPkg($where) {

        $this->db->select('healthPackage_packageTitle as title, healthPkgBooking_finalBookingDate as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as address, healthPkgBooking_orderNo as orderId, ( CASE healthPkgBooking_bkStatus WHEN 0 THEN "Pending" WHEN 1 THEN "Completed" WHEN 2 THEN "Cancelled" END) as bookStatus, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 0 THEN "Male" WHEN 1 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS `userGender`, patientDetails_mobileNo AS `usersMobile`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(),"%Y") - FROM_UNIXTIME(patientDetails_dob,"%Y") END ) END AS `userAge`, ( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as PaymentStatus, payment_method as paymentMethod, "" as remark, "" as diagCatName, "" as speciality, "Health Package" as type, (CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus');

        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->join('transactionInfo', 'transactionInfo.order_no = qyura_healthPkgBooking.healthPkgBooking_orderNo', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_healthPkgBooking.healthPkgBooking_miId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_healthPkgBooking.healthPkgBooking_miId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_healthPkgBooking.healthPkgBooking_userId', 'left');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left');
        $this->db->join('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id = qyura_healthPkgBooking.healthPkgBooking_memberId', 'left');

        $this->db->where($where);
        $this->db->where(array('healthPackage_deleted' => 0, 'qyura_healthPackage.status' => 1));
        $this->db->order_by('qyura_healthPkgBooking.creationTime', 'desc');

        $response = $this->db->get()->result();
        dump($this->db->last_query());
        exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['title'] = isset($row->title) && $row->title != '' ? $row->title : "";
                $finalTemp['dateTime'] = isset($row->dateTime) && $row->dateTime != '' ? $row->dateTime : "";
                $finalTemp['address'] = isset($row->address) && $row->address != '' ? $row->address : "";
                $finalTemp['orderId'] = isset($row->orderId) && $row->orderId != '' ? $row->orderId : "";
                $finalTemp['bookStatus'] = isset($row->bookStatus) && $row->bookStatus != '' ? $row->bookStatus : "";
                $finalTemp['userName'] = isset($row->userName) && $row->userName != '' ? $row->userName : "";
                $finalTemp['userGender'] = isset($row->userGender) && $row->userGender != '' ? $row->userGender : "";
                $finalTemp['userMobile'] = isset($row->userMobile) && $row->userMobile != '' ? $row->userMobile : "";
                $finalTemp['userAge'] = isset($row->userAge) && $row->userAge != '' ? $row->userAge : "";
                $finalTemp['PaymentStatus'] = isset($row->PaymentStatus) && $row->PaymentStatus != '' ? $row->PaymentStatus : "";
                $finalTemp['paymentMethod'] = isset($row->paymentMethod) && $row->paymentMethod != '' ? $row->paymentMethod : "";
                $finalTemp['remark'] = isset($row->remark) && $row->remark != '' ? $row->remark : "";
                $finalTemp['diagCatName'] = isset($row->diagCatName) && $row->diagCatName != '' ? $row->diagCatName : "";
                $finalTemp['speciality'] = isset($row->speciality) && $row->speciality != '' ? $row->speciality : "";
                $finalTemp['type'] = isset($row->type) && $row->type != '' ? $row->type : "";
                $finalTemp['upcomingStatus'] = isset($row->upcomingStatus) && $row->upcomingStatus != '' ? $row->upcomingStatus : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    public function preview($where) {

        $this->db->select('healthPackage_packageTitle as title, healthPackage_discountedPrice as price, healthPkgBooking_preferedBookingDate as preferDate,  healthPkgBooking_finalBookingDate as dateTime, users_email as email, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as address, healthPkgBooking_orderNo as orderId, ( CASE healthPkgBooking_bkStatus WHEN 0 THEN "Pending" WHEN 1 THEN "Completed" WHEN 2 THEN "Cancelled" END) as bookStatus, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 0 THEN "Male" WHEN 1 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS `userGender`, patientDetails_mobileNo AS `usersMobile`, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(),"%Y") - FROM_UNIXTIME(patientDetails_dob,"%Y") END ) END AS `userAge`, ( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as PaymentStatus, payment_method as paymentMethod, "" as remark, "" as diagCatName, "" as speciality, "Health Package" as type, (CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus');

        $this->db->from('qyura_healthPkgBooking');
        $this->db->join('qyura_healthPackage', 'qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId', 'left');
        $this->db->join('transactionInfo', 'transactionInfo.order_no = qyura_healthPkgBooking.healthPkgBooking_orderNo', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_healthPkgBooking.healthPkgBooking_miId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_healthPkgBooking.healthPkgBooking_miId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_healthPkgBooking.healthPkgBooking_userId', 'left');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_users.users_id', 'left');
        $this->db->join('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id = qyura_healthPkgBooking.healthPkgBooking_memberId', 'left');

        $this->db->where($where);
        $this->db->where(array('healthPackage_deleted' => 0, 'qyura_healthPackage.status' => 1));
        $this->db->order_by('qyura_healthPkgBooking.creationTime', 'desc');

        $response = $this->db->get()->result();
        //echo $this->db->last_query(); exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['title'] = isset($row->title) && $row->title != '' ? $row->title : "";
                $finalTemp['price'] = isset($row->price) && $row->price != '' ? $row->price : "";
                $finalTemp['preferDate'] = isset($row->preferDate) && $row->preferDate != '' ? $row->preferDate : "";
                $finalTemp['userName'] = isset($row->userName) && $row->userName != '' ? $row->userName : "";
                $finalTemp['userGender'] = isset($row->userGender) && $row->userGender != '' ? $row->userGender : "";
                $finalTemp['usersMobile'] = isset($row->usersMobile) && $row->usersMobile != '' ? $row->usersMobile : "";
                $finalTemp['userAge'] = isset($row->userAge) && $row->userAge != '' ? $row->userAge : "";
                $finalTemp['email'] = isset($row->email) && $row->email != '' ? $row->email : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

}

?>
