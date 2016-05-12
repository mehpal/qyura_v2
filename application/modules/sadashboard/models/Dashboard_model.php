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

}
