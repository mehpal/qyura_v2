<?php

class Midashboard_model extends CI_Model {
    public $mi_user_id = "";
    public $mi_role_id = "";
    function __construct() {
        parent::__construct();
        $this->mi_user_id = $this->session->userdata('ses_mi_userid');
        $this->mi_role_id = $this->session->userdata('ses_mi_roleid');
    }



    /**
     * @project Qyura
     * @method getMiCount
     * @description mi count
     * @access public
     * @return boolean
     */
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

        $sql = "SELECT 'hospital' AS `type`,`hospital_id` as `id`, `hospital_usersId` as `userId`,CONCAT('assets/hospitalsImages/thumb/thumb_50','/',hospital_img) as imUrl, qyura_hospital.hospital_name as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
                FROM `qyura_hospital`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_hospital`.`hospital_usersId`
                LEFT JOIN `qyura_membership` ON `qyura_membership`.`membership_id` = `qyura_hospital`.`hospital_mmbrTyp`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_hospital`.`hospital_cityId`
                WHERE `qyura_hospital`.`hospital_deleted` = 0 
                AND `qyura_hospital`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 1

                union all

                SELECT 'diagnostic' AS `type`,`diagnostic_id` as `id`, `diagnostic_usersId` as `userId`, CONCAT('assets/diagnosticsImage/thumb/thumb_50','/',diagnostic_img) as imUrl, qyura_diagnostic.diagnostic_name as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
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

        $sql = "SELECT `doctors_id` as `id`, `doctors_userId` as `userId`,CONCAT('assets/doctorsImages/thumb/thumb_50','/',doctors_img) as imUrl, CONCAT(doctors_fName,' ',doctors_lName) AS doctoesName,qyura_city.city_name as city
                FROM `qyura_doctors`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_doctors`.`doctors_userId`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_doctors`.`doctors_cityId`
                WHERE `qyura_doctors`.`doctors_deleted` = 0 
                AND `qyura_doctors`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 4 GROUP BY doctors_userId";

        $qry = $this->db->query($sql);
        return $qry->result();
    }

    function getPendingQuotationList() {

        $this->db->select('quote.quotation_id, quote.quotation_unqId as uniqueId, quote.quotation_userId UserId,FROM_UNIXTIME(quote.quotation_dateTime,"%d/%m/%Y") as dateTime,  IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, quote.quotation_qtStatus as qStatus, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as userName, (CASE quote.quotation_docRefeId WHEN  0 THEN quote.quotation_docName ELSE CONCAT(doc.doctors_fName," ", doc.doctors_lName) END) as docName, qBook.quotationBooking_bookStatus as bookStatus, qBook.quotationBooking_id as bookId,quote.quotation_docRefeId as docRefeId,(CASE WHEN(diag.diagnostic_usersId IS NOT NULL) THEN "diagnostic" WHEN(hos.hospital_usersId IS NOT NULL) THEN "hospital" END) AS miType,(CASE WHEN(diag.diagnostic_usersId IS NOT NULL) THEN diag.diagnostic_id WHEN(hos.hospital_usersId IS NOT NULL) THEN hos.hospital_id END) AS miPfId,dCat.diagnosticsCat_catName');

        $this->db->from('qyura_quotations AS quote');
        $this->db->join('qyura_patientDetails AS pd', 'pd.patientDetails_usersId = quote.quotation_userId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = pd.patientDetails_usersId', 'left');
        $this->db->join('qyura_hospital AS hos', 'hos.hospital_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_diagnostic AS diag', 'diag.diagnostic_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_doctors AS doc', 'doc.doctors_userId = quote.quotation_docRefeId', 'left');
        $this->db->join('qyura_quotationBooking AS qBook', 'qBook.quotationBooking_quotationId = quote.quotation_id', 'left');
        $this->db->join('qyura_quotationDetailTests AS dTest', 'dTest.quotationDetailTests_quotationId = quote.quotation_id', 'left');
        $this->db->join('qyura_diagnosticsCat AS dCat', 'dCat.diagnosticsCat_catId = dTest.quotationDetailTests_diagnosticCatId', 'left');

        $this->db->where(array('quote.quotation_deleted' => 0));
        $this->db->where(array('qBook.quotationBooking_bookStatus' => 1));
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');
        $data = $this->db->get();
        return $data->result();
    }

    function getNotification() {

        $sql = "SELECT qyura_cronMsg,qyura_cronMsgId,qyura_fkUserId FROM qyura_cronMsgs";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    
    function getCityList(){
        
        $sql = "SELECT city_id,city_name FROM qyura_city where city_deleted = 0 AND status = 1 ORDER BY city_name";
        $qry = $this->db->query($sql);
        return $qry->result();
        
    }
    
    function getTopHospital(){
         $yearMonth = date('Ym');
        $sql = "SELECT FROM_UNIXTIME(qyura_hospital.creationTime, '%Y%m') as ct, `hospital_id` as `id`, `hospital_usersId` as `userId`,CONCAT('assets/hospitalsImages/thumb/thumb_50','/',hospital_img) as imUrl, qyura_hospital.hospital_name as `name`,qyura_membership.membership_name as memberName,qyura_city.city_name as city
                FROM `qyura_hospital`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_hospital`.`hospital_usersId`
                LEFT JOIN `qyura_membership` ON `qyura_membership`.`membership_id` = `qyura_hospital`.`hospital_mmbrTyp`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_hospital`.`hospital_cityId`
                WHERE `qyura_hospital`.`hospital_deleted` = 0 
                AND `qyura_hospital`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 1 HAVING ct= ".$yearMonth." LIMIT 7";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
    
    function getDoctorOfMonth($city = ""){
               $month = date('Ym'); 
               $where="";
               if(!empty($city)){
                   $where = "AND qyura_doctors.doctors_cityId = ".$city."";
               }
               
               $sql = "SELECT FROM_UNIXTIME(qyura_doctorAppointment.creationTime, '%Y%m') as ct,`doctors_id` as `id`, `doctors_userId` as `userId`,CONCAT('assets/doctorsImages/thumb/thumb_100','/',doctors_img) as imUrl, CONCAT(doctors_fName,' ',doctors_lName) AS doctoesName,qyura_city.city_name as city,COUNT(qyura_doctorAppointment.doctorAppointment_id) as totalapp,GROUP_CONCAT(DISTINCT(qyura_specialities.specialities_name)) AS specname,GROUP_CONCAT(DISTINCT(qyura_degree.degree_SName)) AS degree
                FROM `qyura_doctors`
                LEFT JOIN `qyura_usersRoles` ON `qyura_usersRoles`.`usersRoles_userId` = `qyura_doctors`.`doctors_userId`
                LEFT JOIN `qyura_city` ON `qyura_city`.`city_id` = `qyura_doctors`.`doctors_cityId`
                INNER JOIN `qyura_doctorAppointment` ON `qyura_doctorAppointment`.`doctorAppointment_doctorUserId` = `qyura_doctors`.`doctors_userId`
                LEFT JOIN `qyura_doctorSpecialities` ON `qyura_doctorSpecialities`.`doctorSpecialities_doctorsId` = `qyura_doctors`.`doctors_id`
                LEFT JOIN `qyura_specialities` ON `qyura_specialities`.`specialities_id` = `qyura_doctorSpecialities`.`doctorSpecialities_specialitiesId`
                LEFT JOIN `qyura_doctorAcademic` ON `qyura_doctorAcademic`.`doctorAcademic_doctorsId` = `qyura_doctors`.`doctors_id`
                LEFT JOIN `qyura_degree` ON `qyura_degree`.`degree_id` = `qyura_doctorAcademic`.`doctorAcademic_degreeId`
                
                WHERE `qyura_doctors`.`doctors_deleted` = 0 
                AND `qyura_doctors`.`status` = 1 
                AND qyura_usersRoles.usersRoles_roleId = 4 ".$where." GROUP BY doctors_userId HAVING ct= ".$month." ORDER BY doctors_id DESC  LIMIT 1";
               

        $qry = $this->db->query($sql);
        return $qry->result(); 
    }
    
    function getConsultAppointment(){
        $yearMonth = date('Ym');
        $now = time();
        $this->db->select("FROM_UNIXTIME(qyura_doctorAppointment.creationTime, '%Y%m') as ct,qyura_doctorAppointment.doctorAppointment_doctorUserId as doctorUserId,qyura_doctorAppointment.doctorAppointment_doctorParentId as doctorParentId,qyura_doctorAppointment.doctorAppointment_id as id,qyura_doctors.doctors_fName AS title, qyura_doctorAppointment.doctorAppointment_date AS dateTime, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_address WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_address ELSE qyura_doctors.doctor_addr END AS address, CASE WHEN (qyura_doctorAppointment.doctorAppointment_docType = 1 ) THEN qyura_hospital.hospital_name WHEN (qyura_doctorAppointment.doctorAppointment_docType = 2 ) THEN qyura_diagnostic.diagnostic_name ELSE qyura_doctors.doctor_addr END AS MIname, qyura_doctorAppointment.doctorAppointment_unqId AS orderId, CASE qyura_doctorAppointment.doctorAppointment_status WHEN '0' THEN 'pending' WHEN '1' THEN 'confirmed'  WHEN '2' THEN 'cancel' ELSE NULL END AS bookingStatus, CASE transactionInfo.payment_status WHEN '1' THEN 'Success' WHEN 4 THEN 'Aborted' WHEN 5 THEN 'Failure' ELSE NULL END AS paymentStatus, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, qyura_users.users_mobile AS usersMobile, CASE WHEN (qyura_doctorAppointment.doctorAppointment_memberId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge, transactionInfo.payment_method AS paymentMethod, qyura_doctorAppointment.doctorAppointment_ptRmk AS remark, '' AS diagCatName, qyura_specialities.specialities_name AS speciality, 'Consultation' AS type, (CASE WHEN(qyura_doctorAppointment.doctorAppointment_date > CURRENT_TIMESTAMP ) THEN 'Upcoming' ELSE 'Completed' END) AS upcomingStatus,doctorAppointment_pntUserId AS pntUserId,doctorAppointment_slotId as slotId, qyura_doctorAppointment.doctorAppointment_finalTiming as finalTime,qyura_city.city_name,(CASE WHEN(qyura_diagnostic.diagnostic_usersId is not null) qyura_diagnostic.diagnostic_usersId THEN  WHEN(hospital_usersId is not null) THEN hospital_usersId) END) as userId");

        $this->db->from("qyura_doctorAppointment");
        $this->db->join("transactionInfo", "transactionInfo.order_no = qyura_doctorAppointment.doctorAppointment_unqId", "left");
        $this->db->join("qyura_users", "qyura_users.users_id=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_patientDetails", "qyura_patientDetails.patientDetails_usersId=qyura_doctorAppointment.doctorAppointment_pntUserId", "left");
        $this->db->join("qyura_usersFamily", "qyura_usersFamily.usersfamily_id=qyura_doctorAppointment.doctorAppointment_memberId", "left");
        $this->db->join("qyura_hospital", "qyura_hospital.hospital_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_doctors", "qyura_doctors.doctors_userId=qyura_doctorAppointment.doctorAppointment_doctorUserId", "left");
        $this->db->join("qyura_diagnostic", "qyura_diagnostic.diagnostic_usersId=qyura_doctorAppointment.doctorAppointment_doctorParentId", "left");
        $this->db->join("qyura_specialities", "qyura_specialities.specialities_id=qyura_doctorAppointment.doctorAppointment_specialitiesId", "left");
        $this->db->join("qyura_city", "qyura_city.city_id=qyura_hospital.hospital_cityId", "left");
       
        //$dateFilter = $this->date_range($_POST['startDate'], $_POST['endDate'], 'qyura_doctorAppointment.doctorAppointment_date');

        if ($dateFilter != NULL && $dateFilter != '')
            $this->db->where($dateFilter);

        $this->db->where(array("qyura_doctorAppointment.doctorAppointment_deleted" => 0, "qyura_doctorAppointment.doctorAppointment_date <>" => 0, "qyura_doctorAppointment.doctorAppointment_docType <>" => 3));
        $this->db->group_by('qyura_doctorAppointment.doctorAppointment_unqId');
        $this->db->having("ct = ".$yearMonth.""); 
         return $this->db->get()->result();

        
    }
    
    function getDoagnosticAppointment(){
        $yearMonth = date('Ym');
        $now = time();
        $this->db->select("FROM_UNIXTIME(qyura_quotations.creationTime, '%Y%m') as ct,qyura_quotations.quotation_timeSlotId as timeSlotId,qyura_quotations.quotation_MiId,qyura_quotations.quotation_id, qyura_quotations.quotation_dateTime as dateTime, (CASE WHEN(diagnostic_usersId is not null) THEN diagnostic_name WHEN(hospital_usersId is not null) THEN hospital_name END) as MIname, qyura_diagnosticsCat.diagnosticsCat_catName AS diagCatName, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_name ELSE qyura_patientDetails.patientDetails_patientName END AS userName, qyura_quotationBooking.quotationBooking_orderId AS orderId, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_gender ELSE qyura_patientDetails.patientDetails_gender END AS userGender, CASE WHEN (qyura_quotations.quotation_familyId <> 0 ) THEN qyura_usersFamily.usersfamily_age ELSE (FROM_UNIXTIME('{$now}', '%Y') - FROM_UNIXTIME(qyura_patientDetails.patientDetails_dob, '%Y')) END AS userAge,qyura_quotationBooking.quotationBooking_bookStatus as bookStatus,(CASE WHEN(diagnostic_usersId is not null) THEN (SELECT city_name FROM qyura_city where city_id = diagnostic_cityId) WHEN(hospital_usersId is not null) THEN (SELECT city_name FROM qyura_city where city_id = hospital_cityId) END) as city");


        $this->db->from("qyura_quotationBooking");

        $this->db->join("transactionInfo", "transactionInfo.order_no = qyura_quotationBooking.quotationBooking_orderId", "left");
        $this->db->join("qyura_quotations ", " qyura_quotations.quotation_id=qyura_quotationBooking.quotationBooking_quotationId", "left");
        $this->db->join("qyura_users ", " qyura_users.users_id=qyura_quotations.quotation_userId", "left");
        $this->db->join("qyura_patientDetails ", " qyura_patientDetails.patientDetails_usersId=qyura_quotationBooking.quotationBooking_userId", "left");
        $this->db->join("qyura_usersFamily ", " qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId", "left");
        $this->db->join("qyura_hospital ", " qyura_hospital.hospital_usersId=qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_diagnostic ", " qyura_diagnostic.diagnostic_usersId=qyura_quotations.quotation_MiId", "left");
        $this->db->join("qyura_diagnosticsCat ", " qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotations.quotation_diagnosticsCatId", "left");
        //$this->db->join("qyura_city", "qyura_city.city_id=qyura_diagnostic.diagnostic_cityId OR qyura_hospital.hospital_cityId", "left");
        

        if ($dateFilter != NULL && $dateFilter != '')
            $this->db->where($dateFilter);

        $this->db->where(array("qyura_quotationBooking.quotationBooking_deleted" => 0, "qyura_quotations.quotation_dateTime <>" => 0));
        $this->db->having("ct = ".$yearMonth.""); 
       // return $this->db->last_query();
     return $this->db->get()->result();
     
    }

    function getChartAmbulance($year = 0) {
       
        $sql = "SELECT COUNT(*) as total FROM qyura_ambulance WHERE status=1 AND ambulance_deleted=0";
        $qry = $this->db->query($sql);
        $rs = $qry->result();

        $sql1 = "SELECT FROM_UNIXTIME(creationTime, '%Y') as ct FROM qyura_ambulance WHERE status=1 AND ambulance_deleted=0 HAVING ct = " . $year . "";
        $qry = $this->db->query($sql1);

        $yearData = count($qry->result());
        $totalData = (!empty($rs)) ? $rs[0]->total : 0;

        return $new_width = ($yearData / $totalData) * 100;
    }
    
       function getChartPharmacy($year = 0) {
       
        $sql = "SELECT COUNT(*) as total FROM qyura_pharmacy WHERE status=1 AND pharmacy_deleted=0";
        $qry = $this->db->query($sql);
        $rs = $qry->result();

        $sql1 = "SELECT FROM_UNIXTIME(creationTime, '%Y') as ct FROM qyura_pharmacy WHERE status=1 AND pharmacy_deleted=0 HAVING ct = " . $year . "";
        $qry = $this->db->query($sql1);

        $yearData = count($qry->result());
        $totalData = (!empty($rs)) ? $rs[0]->total : 0;

        return $new_width = round(($yearData / $totalData) * 100,1);
    }
    
    function getChartBloodbank($year = 0) {
       
        $sql = "SELECT COUNT(*) as total FROM qyura_bloodBank WHERE status=1 AND bloodBank_deleted=0";
        $qry = $this->db->query($sql);
        $rs = $qry->result();

        $sql1 = "SELECT FROM_UNIXTIME(creationTime, '%Y') as ct FROM qyura_bloodBank WHERE status=1 AND bloodBank_deleted=0 HAVING ct = " . $year . "";
        $qry = $this->db->query($sql1);

        $yearData = count($qry->result());
        $totalData = (!empty($rs)) ? $rs[0]->total : 0;

        return $new_width = round(($yearData / $totalData) * 100,1);
    }
    
      function getChartHospital($year = 0) {
       
        $sql = "SELECT COUNT(*) as total FROM qyura_hospital WHERE status=1 AND hospital_deleted=0";
        $qry = $this->db->query($sql);
        $rs = $qry->result();

        $sql1 = "SELECT FROM_UNIXTIME(creationTime, '%Y') as ct FROM qyura_hospital WHERE status=1 AND hospital_deleted=0 HAVING ct = " . $year . "";
        $qry = $this->db->query($sql1);

        $yearData = count($qry->result());
        $totalData = (!empty($rs)) ? $rs[0]->total : 0;

        return $new_width = round(($yearData / $totalData) * 100,1);
    }
    
       function getChartDiagnostic($year = 0) {
       
        $sql = "SELECT COUNT(*) as total FROM qyura_diagnostic WHERE status=1 AND diagnostic_deleted=0";
        $qry = $this->db->query($sql);
        $rs = $qry->result();

        $sql1 = "SELECT FROM_UNIXTIME(creationTime, '%Y') as ct FROM qyura_diagnostic WHERE status=1 AND diagnostic_deleted=0 HAVING ct = " . $year . "";
        $qry = $this->db->query($sql1);

        $yearData = count($qry->result());
        $totalData = (!empty($rs)) ? $rs[0]->total : 0;

        return $new_width = round(($yearData / $totalData) * 100,1);
    }

}
