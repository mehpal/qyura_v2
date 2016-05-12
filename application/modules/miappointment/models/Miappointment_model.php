<?php

class Miappointment_model extends Common_model {

    function __construct() {
        parent::__construct();
        //$this->load->helper(array());
    }
    //Display List
    function getDiagnostic($condition = NULL) {
        $now = time();
        $this->datatables->select("qyura_quotations.quotation_timeSlotId as timeSlotId,qyura_quotations.quotation_qtStatus as bookingstatus,qyura_quotations.quotation_MiId,qyura_quotations.quotation_id, qyura_quotations.quotation_dateTime as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as MIname,CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, qyura_quotationBooking.quotationBooking_orderId AS orderId, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge,qyura_quotationBooking.quotationBooking_bookStatus as bookingStatus,group_concat(diagnosticsCat_catName SEPARATOR ' | ') as diagCatName");


        $this->datatables->from("qyura_quotationBooking");

        $this->datatables->join("transactionInfo", "transactionInfo.order_no = qyura_quotationBooking.quotationBooking_orderId", "left");
        $this->datatables->join("qyura_quotations ", " qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId", "left");
        $this->datatables->join("qyura_users ", " qyura_users.users_id=qyura_quotations.quotation_userId", "left");
        $this->datatables->join("qyura_patientDetails ", " qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId", "left");
        $this->datatables->join("qyura_usersFamily ", " qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId", "left");
        $this->datatables->join("qyura_hospital ", " qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId", "left");
        $this->datatables->join("qyura_diagnostic ", " qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId", "left");
        
        $this->datatables->join("qyura_quotationDetailTests", "qyura_quotationDetailTests.quotationDetailTests_quotationId=qyura_quotations.quotation_id", "left");
        $this->datatables->join("qyura_diagnosticsCat ", " qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId", "left");

         $this->datatables->group_by("qyura_quotations.quotation_id");
        $dateFilter = $this->date_range($_POST['startDate'], $_POST['endDate'], 'qyura_quotations.quotation_dateTime');


        if ($dateFilter != NULL && $dateFilter != '')
            $this->datatables->where($dateFilter);

        $this->datatables->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0, "qyura_quotations.quotation_dateTime <>" => 0));

        $this->datatables->edit_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateFormate(dateTime)');

        $this->datatables->add_column('userName', '<h6>$1</h6><p>$2|$3</p>', 'userName,getGender(userGender),userAge');

        $this->datatables->add_column('diagCatName', '<h6>$1</h6>', 'diagCatName');

        $this->datatables->add_column('MIname', '<h6>$1</h6>', 'MIname');

        $this->datatables->edit_column('bookStatus', '$1', 'getStatusDropDown(bookingstatus,quotation_id,2)');

        $this->datatables->add_column('action', '<p><a  class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="' . site_url('miappointment/detail') . '/$1">View Detail</a></p><button type="button" onclick="getTimeSloat($1,$2,$3)" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Change Timing</button>', 'quotation_id,quotation_MiId,timeSlotId');
        
        return $this->datatables->generate();
//        echo $this->datatables->last_query();
//        exit;
    }

    public function date_range($startdateTime = false, $enddateTime = false, $colName = 'date') {
        /* dateTime range filtartion */
        $startdateTime = strtotime($startdateTime);
        $enddateTime = strtotime($enddateTime);
        $sWhere = '';
        if ((isset($startdateTime) && !empty($startdateTime)) OR ( isset($enddateTime) && !empty($enddateTime))) {

            if ($startdateTime != "" AND $enddateTime != "") {
                $sWhere != '' ? $sWhere .= " AND ( {$colName} >= '$startdateTime' && {$colName} <= '$enddateTime' )" : $sWhere .= "( {$colName} >= '$startdateTime' && {$colName} <= '$enddateTime' )";
            } elseif ($startdateTime != "") {
                $sWhere != '' ? $sWhere .= " AND ( {$colName} = '$startdateTime' )" : $sWhere .= "( {$colName} >= '$startdateTime' )";
            } elseif ($enddateTime != "") {
                $sWhere != '' ? $sWhere .= " AND ( {$colName} = '$enddateTime' )" : $sWhere .= "( {$colName} <= '$enddateTime' )";
            }
            return $sWhere;
            //$this->db->where($sWhere);
        }
    }
//Diagnostic Detail
    public function getDetail($qtnId) {
        $now = time();
        //,CASE when qyura_quotations.quotation_payMode=17 THEN 'CASH'end as paymode
        $this->db->select("qyura_quotations.quotation_timeSlotId as timeSlotId,qyura_quotations.quotation_MiId,qyura_quotations.quotation_id, qyura_quotations.quotation_dateTime as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_mblNo WHEN(hospital_usersId is not null) THEN hospital_mblNo END) as MImblNo, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as MIname, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_hmsId WHEN(hospital_usersId is not null) THEN hospital_hmsId END) as hmsId, qyura_diagnosticsCat.diagnosticsCat_catName AS diagCatName, qyura_quotationBooking.quotationBooking_orderId AS orderId, qyura_quotationBooking.quotationBooking_bookStatus as bookStatus, qyura_quotationBooking.quotationBooking_orderId AS orderId,CASE qyura_quotations.quotation_qtStatus WHEN '11' THEN 'Pending' WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Canceled'  WHEN '19' THEN 'Expired' WHEN '14' THEN 'Completed' ELSE NULL END AS bookingStatus,qyura_quotations.quotation_qtStatus, CASE qyura_quotations.	quotation_payStatus WHEN '16' THEN 'Paid' WHEN '15' THEN 'Unpaid'ELSE NULL END AS paymentStatus, transactionInfo.payment_method AS paymentMethod,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_img WHEN(hospital_usersId is not null) THEN hospital_img END) as MIimg,(CASE WHEN(diagnostic_usersId is not null) THEN 'diagnostic' WHEN(hospital_usersId is not null) THEN 'hospital' END) as type,CASE when qyura_quotations.quotation_payMode=17 THEN 'CASH'end as paymode");

        $this->db->from("qyura_quotationBooking");
        $this->db->join("transactionInfo", "transactionInfo.order_no = qyura_quotationBooking.quotationBooking_orderId", "left");
        $this->db->join("qyura_quotations ", "qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId", "left");
        $this->db->join("qyura_users ", " qyura_users.users_id=qyura_quotations.quotation_userId", "left");
        $this->db->join("qyura_patientDetails ", " qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId", "left");
        $this->db->join("qyura_usersFamily ", " qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId", "left");
        $this->db->join("qyura_hospital ", " qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId", "left");
        //$this->db->join("qyura_diagnosticCenterTimeSlot ", "qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_id=qyura_quotations.quotation_timeSlotId", "left");
        //$this->db->join("qyura_hospitalTimeSlot ", "qyura_hospitalTimeSlot.hospitalTimeSlot_id=qyura_quotations.quotation_timeSlotId", "left");
        $this->db->join("qyura_diagnosticsCat ", " qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotations.quotation_diagnosticsCatId", "left");
        $this->db->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0, 'qyura_quotations.quotation_id' => $qtnId));
        $data = $this->db->get()->row();

        if (isset($data) && !empty($data) && $data != null)
            return $data;
        else
            return FALSE;
    }

    public function getQuotationTests($qtnId) {

        $option = array(
            'select' => 'qyura_quotations.quotation_id,qyura_quotationDetailTests.quotationDetailTests_id as testId,qyura_quotationDetailTests.quotationDetailTests_quotationDetailId as qtDetailId,qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId as diagCatId,qyura_diagnosticsCat.diagnosticsCat_catName as diagCatName,qyura_quotationDetailTests.quotationDetailTests_testName as testName,qyura_quotationDetailTests.quotationDetailTests_price as price,qyura_quotationDetailTests.quotationDetailTests_date as dateTime,qyura_quotationDetailTests.quotationDetailTests_instruction as instruction,qyura_quotationDetail.quotationDetail_prescription as prescription,qyura_reports.report_report as report',
            'table' => 'qyura_quotations',
            'join' => array(
                array('qyura_quotationBooking', 'qyura_quotationBooking.quotationBooking_quotationId=qyura_quotations.quotation_id', 'left'),
                array('qyura_reports', 'qyura_reports.report_bookingOrderId=qyura_quotationBooking.quotationBooking_orderId', 'left'),
                array('qyura_quotationDetailTests', 'qyura_quotationDetailTests.quotationDetailTests_quotationId=qyura_quotations.quotation_id', 'right'),
                array('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId', 'left'),
                array('qyura_quotationDetail', 'qyura_quotationDetail.quotationDetail_id=qyura_quotationDetailTests.quotationDetailTests_quotationDetailId', 'left')
            ),
            'where' => array('qyura_quotations.quotation_id' => $qtnId, 'qyura_quotations.quotation_deleted' => 0, 'qyura_quotationDetailTests.quotationDetailTests_deleted' => 0)
        );

        $quotationTests = $this->customGet($option);

        if (isset($quotationTests) && $quotationTests != null) {
            return $quotationTests;
        } else
            return false;
    }

    public function getQuotationUserDetail($qtnId) {
        $now = time();
        $this->db->select("CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName,  CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge,qyura_patientDetails.patientDetails_address as address,qyura_country.country,qyura_state.state_statename,qyura_city.city_name,qyura_patientDetails.patientDetails_pin as pin,qyura_users.users_mobile as mobile,qyura_patientDetails.patientDetails_patientImg as patientImg")
                ->from("qyura_quotationBooking")
                ->join("qyura_quotations ", "qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId", "left")
                ->join("qyura_patientDetails ", " qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId", "left")
                ->join("qyura_users", "qyura_users.users_id=qyura_quotations.quotation_userId", "left")
                ->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId", "left")
                ->join("qyura_country", "qyura_country.country_id=qyura_patientDetails.patientDetails_countryId", "left")
                ->join("qyura_state", "qyura_state.state_id=qyura_patientDetails.patientDetails_stateId", "left")
                ->join("qyura_city", "qyura_city.city_id=qyura_patientDetails.patientDetails_cityId", "left")
                ->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0, 'qyura_quotationBooking.quotationBooking_quotationId' => $qtnId));
        $data = $this->db->get()->row();
        if (isset($data) && !empty($data) && $data != null)
            return $data;
        else
            return FALSE;
    }

    public function qtTestTotalAmount($qtnId) {
        $option = array(
            'select' => 'sum(qyura_quotationDetailTests.quotationDetailTests_price) as price',
            'table' => 'qyura_quotations',
            'join' => array(
                array('qyura_quotationDetailTests', 'qyura_quotationDetailTests.quotationDetailTests_quotationId=qyura_quotations.quotation_id', 'right')
            ),
            'where' => array('qyura_quotations.quotation_id' => $qtnId, 'qyura_quotations.quotation_deleted' => 0, 'qyura_quotationDetailTests.quotationDetailTests_deleted' => 0),
            'limit' => 1,
            'single' => TRUE
        );

        $quotationTests = $this->customGet($option);

        return $quotationTests;
    }
//Consultation detail
    public function getConsultingData($appointmentId) {

//qyura_doctorAvailabilitySession
        // CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS paymentStatus
        $now = time();
        $this->db->select("qyura_doctors.doctors_id as docid,qyura_doctorAppointment.doctorAppointment_doctorUserId as doctorUserId,qyura_doctorAppointment.doctorAppointment_docType as centerType,qyura_doctorAppointment.doctorAppointment_doctorParentId as doctorParentId,qyura_doctorAppointment.doctorAppointment_id as id,qyura_users.users_username AS title, qyura_doctorAppointment.doctorAppointment_date AS dateTime, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_address WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_address ELSE qyura_doctors.doctor_addr END AS address, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_img WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_img ELSE qyura_doctors.doctors_img END AS MIimg, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_name WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_name ELSE qyura_doctors.doctor_addr END AS MIname, qyura_doctorAppointment.doctorAppointment_unqId AS orderId, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '11' THEN 'Pending' WHEN '12' THEN 'Confirmed' WHEN '13' THEN 'Canceled' WHEN '19' THEN 'Expired' WHEN '14' THEN 'Completed' ELSE NULL END AS bookingStatus, CASE qyura_doctorAppointment.	doctorAppointment_payStatus WHEN '16' THEN 'Paid' WHEN '15' THEN 'Unpaid'ELSE NULL END AS paymentStatus, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, qyura_users.users_mobile AS usersMobile, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge, transactionInfo.payment_method AS paymentMethod, qyura_doctorAppointment.doctorAppointment_ptRmk AS remark, '' AS diagCatName, qyura_specialities.specialities_name AS speciality, 'Consultation' AS type, (CASE WHEN(qyura_doctorAppointment.doctorAppointment_date > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) AS upcomingStatus,patient.users_mobile as mobile,doctorAppointment_ptRmk as remarks,qyura_patientDetails.patientDetails_patientImg as patientImg,qyura_country.country,qyura_state.state_statename,qyura_city.city_name,qyura_doctorAppointment.doctorAppointment_consulationFee as consulationFee,qyura_doctorAppointment.doctorAppointment_otherFee as otherFee,qyura_doctorAppointment.doctorAppointment_tax as tax,qyura_doctorAppointment.doctorAppointment_totPayAmount as totPayAmount,qyura_patientDetails.patientDetails_pin as pin,CASE when qyura_doctorAppointment.doctorAppointment_payMode=17 THEN 'CASH'end as paymode");

        $this->db->from("qyura_doctorAppointment");
        $this->db->join("transactionInfo", "transactionInfo.order_no = qyura_doctorAppointment.doctorAppointment_unqId", "left");
        $this->db->join("qyura_users", "qyura_users.users_id=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_users as patient", "patient.users_id=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
      
        $this->db->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
        $this->db->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id=qyura_doctorAppointment.doctorAppointment_memberId", "left");
        
        $this->db->join("qyura_country", "qyura_country.country_id=qyura_patientDetails.patientDetails_countryId", "left");
        $this->db->join("qyura_state", "qyura_state.state_id=qyura_patientDetails.patientDetails_stateId", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=qyura_patientDetails.patientDetails_cityId", "left");

        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_doctors", "qyura_doctors.doctors_userId=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_specialities", "qyura_specialities.specialities_id=qyura_doctorAppointment.doctorAppointment_specialitiesId", "left");

        $this->db->where(array("qyura_doctorAppointment.doctorAppointment_deleted" => 0, "qyura_doctorAppointment.doctorAppointment_date <>" => 0, "qyura_doctorAppointment.doctorAppointment_docType <>" => 3, "qyura_doctorAppointment.doctorAppointment_id" => $appointmentId));
        $this->db->group_by('qyura_doctorAppointment.doctorAppointment_unqId');

        $data = $this->db->get()->row();
        //dump($this->db->last_query());
        if (isset($data) && !empty($data) && $data != null)
            return $data;
        else
            return FALSE;
    }
//Display COnsulting List
    public function getConsultingList() {
        $now = time();
        $this->datatables->select("qyura_doctorAppointment.doctorAppointment_doctorUserId as doctorUserId,qyura_doctorAppointment.doctorAppointment_doctorParentId as doctorParentId,qyura_doctorAppointment.doctorAppointment_id as id,qyura_doctors.doctors_fName AS title, qyura_doctorAppointment.doctorAppointment_date AS dateTime, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_address WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_address ELSE qyura_doctors.doctor_addr END AS address, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_name WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_name ELSE qyura_doctors.doctor_addr END AS MIname, qyura_doctorAppointment.doctorAppointment_unqId AS orderId,qyura_doctorAppointment.doctorAppointment_status  AS bookingStatus, CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS paymentStatus, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, qyura_users.users_mobile AS usersMobile, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge, transactionInfo.payment_method AS paymentMethod, qyura_doctorAppointment.doctorAppointment_ptRmk AS remark, '' AS diagCatName, qyura_specialities.specialities_name AS speciality, 'Consultation' AS type, (CASE WHEN(qyura_doctorAppointment.doctorAppointment_date > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) AS upcomingStatus,doctorAppointment_pntUserId AS pntUserId,doctorAppointment_slotId as slotId, qyura_doctorAppointment.doctorAppointment_finalTiming as finalTime");

        $this->datatables->from("qyura_doctorAppointment");
        $this->datatables->join("transactionInfo", "transactionInfo.order_no = qyura_doctorAppointment.doctorAppointment_unqId", "left");
        $this->datatables->join("qyura_users", "qyura_users.users_id=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->datatables->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
        $this->datatables->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id=qyura_doctorAppointment.doctorAppointment_memberId", "left");
        $this->datatables->join("qyura_hospital", "qyura_hospital.hospital_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->datatables->join("qyura_doctors", "qyura_doctors.doctors_userId=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->datatables->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->datatables->join("qyura_specialities", "qyura_specialities.specialities_id=qyura_doctorAppointment.doctorAppointment_specialitiesId", "left");

        $dateFilter = $this->date_range($_POST['startDate'], $_POST['endDate'], 'qyura_doctorAppointment.doctorAppointment_date');

        if ($dateFilter != NULL && $dateFilter != '')
            $this->datatables->where($dateFilter);

        $this->datatables->where(array("qyura_doctorAppointment.doctorAppointment_deleted" => 0, "qyura_doctorAppointment.doctorAppointment_date <>" => 0, "qyura_doctorAppointment.doctorAppointment_docType <>" => 3));
        $this->datatables->group_by('qyura_doctorAppointment.doctorAppointment_unqId');
        $this->datatables->edit_column('orderId', '<h6>$1</h6><p>$2</p><p>$3</p>', 'orderId,dateFn(dateTime),timeFn(finalTime)');
        $this->datatables->add_column('userName', '<h6>$1</h6><p>$2|$3</p>', 'userName,getGender(userGender),userAge');
        $this->datatables->add_column('title', '<h6>$1</h6><p>$2</p>', 'title,MIname');
        $this->datatables->edit_column('bookStatus', '$1', 'getStatusDropDown(bookingStatus,id,"1")');
        
        $this->datatables->add_column('action', '<p><a  class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="' . site_url('miappointment/consultingDetail') . '/$1">View Detail</a></p><button type="button" onclick="getDrTimeSloat($1,$2,$3,$4)" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Change Timing</button>', 'id,doctorUserId,doctorParentId,slotId');

        return $this->datatables->generate();
    }

    public function getHealthpkgList() {
        $now = time();
        $this->datatables->select('healthPackage_packageTitle as title, healthPkgBooking_finalBookingDate as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as address, healthPkgBooking_orderNo as orderId, ( CASE healthPkgBooking_bkStatus WHEN 0 THEN "Pending" WHEN 1 THEN "Completed" WHEN 2 THEN "Cancelled" END) as bookingStatus, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 0 THEN "Male" WHEN 1 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS userGender, users_mobile AS usersMobile, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(patientDetails_dob, "%Y") END ) END AS userAge, ( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as paymentStatus, payment_method as paymentMethod, "" as remark, "" as diagCatName, "" as speciality, "Health Package" as type, (CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId WHEN(hospital_usersId is not null) THEN hospital_usersId END) as miId');
        $this->datatables->from("qyura_healthPkgBooking");
        $this->datatables->join("qyura_healthPackage", "qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId", "left");
        $this->datatables->join("transactionInfo", "transactionInfo.order_no = qyura_healthPkgBooking.healthPkgBooking_orderNo", "left");
        $this->datatables->join("qyura_hospital", "qyura_hospital.hospital_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->datatables->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->datatables->join("qyura_users", "qyura_users.users_id = qyura_healthPkgBooking.healthPkgBooking_userId", "left");
        $this->datatables->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId = qyura_users.users_id", "left");
        $this->datatables->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id = qyura_healthPkgBooking.healthPkgBooking_memberId", "left");
        
        $dateFilter = $this->date_range($_POST['startDate'], $_POST['endDate'], 'healthPkgBooking_finalBookingDate');

        if ($dateFilter != NULL && $dateFilter != '')
            $this->datatables->where($dateFilter);

        $this->datatables->where(array("healthPkgBooking_deleted" => 0, "healthPkgBooking_finalBookingDate <>" => 0));
        
        $this->datatables->group_by('healthPkgBooking_orderNo');
        
        $this->datatables->edit_column('orderId', '<h6>$1</h6><p>$2</p>', 'orderId,dateFormate(dateTime)');
        $this->datatables->add_column('userName', '<h6>$1</h6><p>$2|$3</p>', 'userName,getGender(userGender),userAge');
        $this->datatables->add_column('title', '<h6>$1</h6>', 'title');
        $this->datatables->edit_column('bookStatus', '$1', 'bookingStatus');
        $this->datatables->add_column('action', '<p><a  class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="' . site_url('miappointment/healthPkgDetail') . '/$1">View Detail</a></p>', 'orderId');

        return $this->datatables->generate();
        
        
    }
    
    public function getHealthPkgDetail($appointmentId){
        $now = time();
        $this->db->select('healthPackage_packageTitle as title, healthPkgBooking_finalBookingDate as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as address, healthPkgBooking_orderNo as orderId, ( CASE healthPkgBooking_bkStatus WHEN 0 THEN "Pending" WHEN 1 THEN "Completed" WHEN 2 THEN "Cancelled" END) as bookingStatus, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN 0 THEN "Male" WHEN 1 THEN "Female" WHEN 3 THEN "Other" END  ELSE CASE patientDetails_gender WHEN "M" THEN "Male" WHEN "F" THEN "Female" WHEN "O" THEN "Other" END END AS userGender, users_mobile AS usersMobile, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN "" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(patientDetails_dob, "%Y") END ) END AS userAge, ( CASE payment_status WHEN 1 THEN "Success" WHEN 4 THEN "Aborted" WHEN 5 THEN "Failure" END) as paymentStatus, payment_method as paymentMethod, "" as remark, "" as diagCatName, "" as speciality, "Health Package" as type, (CASE WHEN(healthPkgBooking_finalBookingDate > UNIX_TIMESTAMP()) THEN "Upcoming" ELSE "Completed" END) as upcomingStatus,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_usersId WHEN(hospital_usersId is not null) THEN hospital_usersId END) as miId,qyura_patientDetails.patientDetails_patientImg as patientImg,qyura_country.country,qyura_state.state_statename,qyura_city.city_name,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_img WHEN(hospital_usersId is not null) THEN hospital_img END) as MIimg');
        $this->db->from("qyura_healthPkgBooking");
        $this->db->join("qyura_healthPackage", "qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId", "left");
        $this->db->join("transactionInfo", "transactionInfo.order_no = qyura_healthPkgBooking.healthPkgBooking_orderNo", "left");
        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->db->join("qyura_users", "qyura_users.users_id = qyura_healthPkgBooking.healthPkgBooking_userId", "left");
        $this->db->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId = qyura_users.users_id", "left");
        $this->db->join("qyura_country", "qyura_country.country_id=qyura_patientDetails.patientDetails_countryId", "left");
        $this->db->join("qyura_state", "qyura_state.state_id=qyura_patientDetails.patientDetails_stateId", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=qyura_patientDetails.patientDetails_cityId", "left");
        $this->db->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id = qyura_healthPkgBooking.healthPkgBooking_memberId", "left");
        
        

        $this->db->where(array("healthPkgBooking_deleted" => 0, "healthPkgBooking_orderNo" => $appointmentId));
        
        $this->db->group_by('healthPkgBooking_orderNo');
        
        $data = $this->db->get()->row();
        //dump($this->db->last_query());
        if (isset($data) && !empty($data) && $data != null)
            return $data;
        else
            return FALSE;
        
        
    }

    public function getConsultingReport($appointmentId) {

        $option = array(
            'select' => 'qyura_reports.report_report as report',
            'table' => 'qyura_doctorAppointment',
            'join' => array(
                array('qyura_reports', 'qyura_reports.report_bookingOrderId=qyura_doctorAppointment.doctorAppointment_unqId', 'left'),
            ),
            'where' => array('qyura_doctorAppointment.doctorAppointment_id' => $appointmentId, 'qyura_doctorAppointment.doctorAppointment_deleted' => 0)
        );

        $quotationTests = $this->customGet($option);

        if (isset($quotationTests) && $quotationTests != null) {
            return $quotationTests;
        } else
            return false;
    }
    
    public function getHealthPkgReport($appointmentId) {

        $option = array(
            'select' => 'qyura_reports.report_report as report',
            'table' => 'qyura_reports',
            'where' => array('qyura_reports.report_bookingOrderId' => $appointmentId, 'qyura_reports.report_deleted' => 0)
        );

        $quotationTests = $this->customGet($option);

        if (isset($quotationTests) && $quotationTests != null) {
            return $quotationTests;
        } else
            return false;
    }

    public function getTimeSlot($Mid, $quotation_id) {
        $this->db->select("(CASE WHEN(diagnostic_usersId IS NOT NULL) THEN CONCAT_WS(' - ',diagnosticCenterTimeSlot_startTime, diagnosticCenterTimeSlot_endTime,diagnosticCenterTimeSlot_sessionType) WHEN(hospital_usersId IS NOT NULL) THEN CONCAT_WS('-',hospitalTimeSlot_startTime, hospitalTimeSlot_endTime,hospitalTimeSlot_sessionType) END) AS timeSlot,
qyura_quotations.quotation_MiId,quotation_timeSlotId,quotation_dateTime,
(CASE WHEN(diagnostic_usersId IS NOT NULL) THEN  diagnosticCenterTimeSlot_id WHEN(hospital_usersId IS NOT NULL) THEN hospitalTimeSlot_id END) AS timesloatAtId");
        $this->db->from("qyura_quotations");
        
        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId = qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_hospitalTimeSlot", "qyura_hospitalTimeSlot.hospitalTimeSlot_hospitalId = qyura_hospital.hospital_id", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId = qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_diagnosticCenterTimeSlot", "qyura_diagnosticCenterTimeSlot.diagnosticCenterTimeSlot_diagnosticId = qyura_diagnostic.diagnostic_id", "left");
        
        $this->db->where(array("qyura_quotations.quotation_MiId" => $Mid, 'qyura_quotations.quotation_id' => $quotation_id));
        $this->db->group_by('timesloatAtId');

        $data = $this->db->get()->result();

        if (isset($data) && $data != null) {
            return $data;
        } else
            return false;
    }
    
    public function getDrTimeSlot($Mid,$doctorUserId) {
        $this->db->select("CONCAT_WS(' - ',doctorAvailabilitySession_start, doctorAvailabilitySession_end,doctorAvailabilitySession_type,doctorAvailability_day) AS timeSlot,abSession.doctorAvailabilitySession_id as sesId,doctorAvailabilitySession_type as sesType,doctorAvailability_day as day");
        $this->db->from("qyura_doctorAvailability as drAvbl");
        $this->db->join("qyura_doctorAvailabilitySession abSession", "abSession.doctorAvailability_doctorAvailabilityId = drAvbl.doctorAvailability_id", "left");
        
        $this->db->where(array("abSession.doctorAvailability_refferalId" => $Mid,'drAvbl.doctorAvailability_docUsersId'=>$doctorUserId,'abSession.doctorAvailabilitySession_deleted'=>0));
        $this->db->group_by('abSession.doctorAvailabilitySession_id');

        $data = $this->db->get()->result();

        if (isset($data) && $data != null) {
            return $data;
        } else
            return false;
    }
    
    public function drAppointmentDetail($appId)
    {
        $this->db->select("doctorAppointment_date as date,doctorAppointment_session as session,doctorAppointment_slotId as slotId,doctorAppointment_finalTiming as finalTiming,doctorAppointment_id AS id");
        $this->db->from("qyura_doctorAppointment as drAppo");
        $this->db->where(array("drAppo.doctorAppointment_id" => $appId));
        $this->db->group_by('drAppo.doctorAppointment_id');

        $data = $this->db->get()->row();

        if (isset($data) && $data != null) {
            return $data;
        } else
            return false;
    }

    public function getConsultantList($h_d_id, $specialityId) {

        $this->db->select('doctors_userId userId,qyura_doctors.doctors_id as id, CONCAT(qyura_doctors.doctors_fName, " ",  qyura_doctors.doctors_lName) AS name, qyura_doctors.doctors_img imUrl, qyura_doctors.doctors_consultaionFee as consFee, qyura_specialities.specialities_name as specialityName, Group_concat(DISTINCT qyura_degree.degree_SName) as degree, qyura_doctors.doctors_lat as lat, qyura_doctors.doctors_long as long,qyura_doctors.doctors_27Src as isEmergency,(
CASE 
 WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
 WHEN (reviews_rating is not null) 
 THEN 
      ROUND( (AVG(reviews_rating)), 1)
 WHEN (qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(qyura_ratings.rating)), 1)
 END)
 AS `rating` ')
                ->from('qyura_usersRoles')
                ->join('qyura_doctors', 'qyura_doctors.doctors_userId = usersRoles_userId', 'left')
                ->join('qyura_doctorAcademic', 'qyura_doctorAcademic.doctorAcademic_doctorsId=qyura_doctors.doctors_id', 'left')
                ->join('qyura_degree', 'qyura_doctorAcademic.doctorAcademic_degreeId=qyura_degree.degree_id', 'left')
                ->join('qyura_doctorSpecialities', 'qyura_doctorSpecialities.doctorSpecialities_doctorsId = qyura_doctors.doctors_id', 'left')
                ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_doctorSpecialities.doctorSpecialities_specialitiesId', 'left')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_doctors.doctors_userId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_doctors.doctors_userId', 'left')
                ->where(array('doctors_deleted' => 0, 'usersRoles_roleId' => ROLE_DOCTORE,'qyura_specialities.specialities_id' => $specialityId,"qyura_doctors.status"=>1))
                ->order_by('name', 'ASC')
                ->group_by('doctors_id')
                ->limit(DATA_LIMIT);

        $response = $this->db->get()->result();
        //echo $this->db->last_query(); exit;
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp['id'] = isset($row->id) ? $row->id : "";
                $finalTemp['name'] = isset($row->name) ? $row->name : "";
                $finalTemp['degree'] = isset($row->degree) ? $row->degree : "";
                $finalTemp['userId'] = isset($row->userId) ? $row->userId : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }
    
    public function getUploadReportsList($params = array(), $search = '') {
        $now = time();

        $searchAryQT = array('quotationBooking_orderId' => $search, '(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END)' => $search, '(CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name ELSE digCity.city_name END)' => $search, "(CASE WHEN (qyura_quotationBooking.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END)" => $search, "(CASE WHEN (qyura_quotationBooking.quotation_familyId = 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END)" => $search, "CASE WHEN (qyura_quotationBooking.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN '' ELSE FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(patientDetails_dob, '%Y') END ) END" => $search);

        $searchHavingAry = array("miName LIKE '%{$search}%'" => null, "city_name LIKE '%{$search}%'" => null, "userName LIKE '%{$search}%'" => null, "userGender LIKE '%{$search}%'" => null, "userAge LIKE '%{$search}%'" => null);

        $this->db->select("qyura_quotationBooking.quotationBooking_quotationId AS id,qyura_quotationBooking.quotationBooking_orderId AS orderId,(CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as miName,CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name ELSE digCity.city_name END AS city_name,CASE WHEN (qyura_quotationBooking.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (qyura_quotationBooking.quotation_familyId = 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END AS userGender, CASE WHEN (qyura_quotationBooking.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN '' ELSE FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(patientDetails_dob, '%Y') END ) END AS userAge, users_mobile AS usersMobile,  users_email AS email,'Diagnostic' AS type");

        $this->db->from("qyura_quotationBooking");

        $this->db->join("qyura_quotations ", "qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId", "left");
        $this->db->join("qyura_users ", " qyura_users.users_id=qyura_quotations.quotation_userId", "left");
        $this->db->join("qyura_patientDetails ", " qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId", "left");
        $this->db->join("qyura_usersFamily ", " qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId", "left");
        $this->db->join("qyura_hospital ", " qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId", "left");

        $this->db->join("qyura_city", "qyura_city.city_id=qyura_hospital.hospital_cityId", "left");
        $this->db->join("qyura_city as digCity", "digCity.city_id=qyura_diagnostic.diagnostic_cityId", "left");

        $this->db->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0));
        $this->db->group_start();
        $this->db->or_like($searchAryQT);
        $this->db->group_end();
        $this->db->group_by('quotationBooking_orderId');
        //$this->db->or_having($searchHavingAry);
        $query1 = $this->db->_compile_select();
        $this->db->_reset_select();

        $searchAryDOC = array('doctorAppointment_unqId' => $search, '(CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_name WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_name ELSE qyura_doctors.doctors_fName END)' => $search, "(CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name WHEN(digCity.city_name IS NOT NULL ) THEN digCity.city_name ELSE docCity.city_name END)" => $search, "(CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END)" => $search, "(CASE WHEN (doctorAppointment_memberId <> 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END)" => $search, "(CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END)" => $search);

        $this->db->select("qyura_doctorAppointment.doctorAppointment_id AS id,qyura_doctorAppointment.doctorAppointment_unqId AS orderId, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_name WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_name ELSE qyura_doctors.doctors_fName END AS miName,CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name WHEN(digCity.city_name IS NOT NULL ) THEN digCity.city_name ELSE docCity.city_name END AS city_name, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (doctorAppointment_memberId <> 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END AS userGender, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge,patient.users_mobile AS usersMobile,patient.users_email AS email,'Doctor' AS type");

        $this->db->from("qyura_doctorAppointment");
        $this->db->join("qyura_users", "qyura_users.users_id=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_users as patient", "patient.users_id=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
        $this->db->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
        $this->db->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id=qyura_doctorAppointment.doctorAppointment_memberId", "left");
        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_doctors", "qyura_doctors.doctors_userId=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=qyura_hospital.hospital_cityId", "left");
        $this->db->join("qyura_city as digCity", "digCity.city_id=qyura_diagnostic.diagnostic_cityId", "left");
        $this->db->join("qyura_city as docCity", "docCity.city_id=qyura_doctors.doctors_cityId", "left");

        $this->db->where(array("qyura_doctorAppointment.doctorAppointment_deleted" => 0, "qyura_doctorAppointment.doctorAppointment_docType <>" => 3));
        $this->db->group_start();
        $this->db->or_like($searchAryDOC);
        $this->db->group_end();
        $this->db->group_by('qyura_doctorAppointment.doctorAppointment_unqId');
        //$this->db->or_having($searchHavingAry);
        $query2 = $this->db->_compile_select();
        $this->db->_reset_select();

        $searchAryHPK = array('healthPkgBooking_orderNo' => $search, '(CASE WHEN(diagnostic_usersId is not null ) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END)' => $search, "(CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name ELSE digCity.city_name END)" => $search, "(CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END)" => $search, "(CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END)" => $search, "(CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN '' ELSE FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(patientDetails_dob, '%Y') END ) END)" => $search);

        $this->db->select("healthPkgBooking_id AS id,healthPkgBooking_orderNo as orderId,(CASE WHEN(diagnostic_usersId is not null ) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as miName, CASE WHEN (qyura_city.city_name  IS NOT NULL  ) THEN qyura_city.city_name ELSE digCity.city_name END AS city_name , CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN CASE usersfamily_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END  ELSE CASE patientDetails_gender WHEN '1' THEN 'Male' WHEN '2' THEN 'Female' WHEN '3' THEN 'Other' END END AS userGender, CASE WHEN (healthPkgBooking_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (CASE patientDetails_dob WHEN 0 THEN '' ELSE FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(patientDetails_dob, '%Y') END ) END AS userAge, users_mobile AS usersMobile,  users_email AS email,'Health Package' AS type");
        $this->db->from("qyura_healthPkgBooking");
        $this->db->join("qyura_healthPackage", "qyura_healthPackage.healthPackage_id = qyura_healthPkgBooking.healthPkgBooking_healthPackageId", "left");
        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId = qyura_healthPkgBooking.healthPkgBooking_miId", "left");
        $this->db->join("qyura_users", "qyura_users.users_id = qyura_healthPkgBooking.healthPkgBooking_userId", "left");
        $this->db->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId = qyura_users.users_id", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=qyura_hospital.hospital_cityId", "left");
        $this->db->join("qyura_city as digCity", "digCity.city_id=qyura_diagnostic.diagnostic_cityId", "left");
        $this->db->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id = qyura_healthPkgBooking.healthPkgBooking_memberId", "left");
        $this->db->where(array("healthPkgBooking_deleted" => 0));
        $this->db->group_start();
        $this->db->or_like($searchAryHPK);
        $this->db->group_end();
        //, "healthPkgBooking_bkStatus" => 4
        $this->db->group_by('healthPkgBooking_orderNo');
        //$this->db->or_having($searchHavingAry);
        $query3 = $this->db->_compile_select();
        $this->db->_reset_select();

        $limit = '';
        if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {

            $limit = " LIMIT " . $params['start'] . "," . $params['limit'];
        } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
            $limit = " LIMIT " . $params['limit'];
        }
        



        $sql = $query1 . " union all " . $query2 . " union all " . $query3 . " " . $limit;

        //dump($sql);

        $data = $this->db->query($sql)->result_array();

        if (isset($data) && $data != null) {
            return $data;
        } else
            return false;
    }

}
