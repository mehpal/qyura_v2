<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class DoctorBooking_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    public function bookAppointment($table, $data) {

        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();

        return $id;
    }
    
    public function editAppointment($table,$data,$where) {
        
        $data = $this->_filter_data($table, $data);

        $id = $this->db->update($table, $data,$where);
      
        return $this->db->affected_rows();
    }
    
    public function getBookedAppointment($orderId) {
        $this->db->select('doctorAppointment_unqId as appontimentId, qyura_specialities.specialities_name, users_username, doctorAppointment_date as bookingDate,doctorAvailabilitySession_start,doctorAvailabilitySession_end,CASE WHEN (	doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN ( doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS `userName`, CASE WHEN (doctorAppointment_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 1 THEN "Male" WHEN 2 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS `userGender`, `users_mobile` AS `usersMobile`, CASE WHEN (doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(patientDetails_dob, "%Y") END ) END AS `userAge`,( CASE doctorAppointment_status WHEN 1 THEN "completed" WHEN 2 THEN "Cancelled" WHEN 3 THEN "Pending" END) as status, `payment_method` as `paymentMethod`,( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as paymentStatus, `doctorAppointment_ptRmk` as `remark`, CASE WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 1 ) THEN qyura_hospital.hospital_address WHEN (`qyura_doctorAppointment`.`doctorAppointment_docType` = 2 ) THEN qyura_diagnostic.diagnostic_address ELSE qyura_doctors.doctor_addr END AS `address`,');
        $this->db->from('qyura_doctorAppointment');
        $this->db->join('transactionInfo', 'transactionInfo.order_no = qyura_doctorAppointment.doctorAppointment_unqId', 'left');
        $this->db->join('qyura_users', 'qyura_users.users_id = qyura_doctorAppointment.doctorAppointment_doctorUserId', 'left');
        $this->db->join('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_doctorAppointment.doctorAppointment_pntUserId', 'left');
        $this->db->join('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id = qyura_doctorAppointment.doctorAppointment_memberId', 'left');
        $this->db->join('qyura_hospital', 'qyura_hospital.hospital_usersId = qyura_doctorAppointment.doctorAppointment_doctorParentId', 'left');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId = qyura_doctorAppointment.doctorAppointment_specialitiesId', 'left');
        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorAppointment.doctorAppointment_specialitiesId', 'left');
        $this->db->join('qyura_doctorAvailabilitySession', 'qyura_doctorAvailabilitySession.doctorAvailabilitySession_id = qyura_doctorAppointment.doctorAppointment_finalTiming', 'left');
        
        $this->db->where(array("qyura_doctorAppointment.doctorAppointment_unqId"=>$orderId));
        
        return $this->db->get()->result();
    }
    
    public function checkDocTimeSlot($hospitalId, $doctorUserId,$slotId,$day) { 
        
        $this->db->select("doctorAvailabilitySession_start")
                ->from("qyura_doctorAvailabilitySession")
                ->join("qyura_doctorAvailability","qyura_doctorAvailability.doctorAvailability_id = qyura_doctorAvailabilitySession.doctorAvailability_doctorAvailabilityId","inner")
                ->where(array("doctorAvailabilitySession_id"=>$slotId,"doctorAvailability_day"=>$day,"doctorAvailability_refferalId"=>$hospitalId,"doctorAvailability_docUsersId"=>$doctorUserId));
        
        $response = $this->db->get();
//        echo date("Y-m-d");die();
        if ($response->num_rows() >= 1) {
            
            $response->row()->doctorAvailabilitySession_start;
            $time = strtotime($response->row()->doctorAvailabilitySession_start);
            $currentTime = time();
            $currentTime = strtotime("-2 hour",$currentTime);
            
            if($time >= $currentTime){
                return TRUE;
            }else{
                return FALSE;
            }
            
        } else {
            return FALSE;
        }
    }
    
}

?>
