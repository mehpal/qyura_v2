<?php

class Quotation_model extends CI_Model {

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
        // $this->db->where('city_stateid',$stateId);
        $this->db->order_by("city_name", "asc");
        return $this->db->get()->result();
    }

    function fetchHospital($cityId = NULL) {

        $this->db->select('hospital_id,hospital_usersId miId,hospital_name miName');
        $this->db->from('qyura_hospital');
        $this->db->where('hospital_cityId', $cityId);
        $this->db->order_by("hospital_name", "asc");
        return $this->db->get()->result();
    }

    function fetchDiagnostic($cityId = NULL) {

        $this->db->select('diagnostic_id, diagnostic_usersId miId, diagnostic_name miName');
        $this->db->from('qyura_diagnostic');
        $this->db->where('diagnostic_cityId', $cityId);
        $this->db->order_by("diagnostic_name", "asc");
        return $this->db->get()->result();
    }


    
   function insertPrescription($insertData) {
        $this->db->insert('qyura_quotationDetail', $insertData);

        $insert_id = $this->db->insert_id();
        //echo $this->db->last_query();exit;
        return $insert_id;
    }
    
     function sendEmailToResgisterUser($dataUser){

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        
        $data['users'] = $dataUser;

        $this->email->from('admin@qyuram.com', 'QYURA TEAM');
        $this->email->to($this->input->post('patient_email'));
        $body = $this->load->view('userTemplatesEmail',$data, TRUE);
        $this->email->subject('New Registration from qyura');
        $this->email->message($body);

       if($this->email->send()){
           return true;
       }else{
           return false;
       }

     //  echo $this->email->print_debugger();
    }
    
    
    function sendQuotationToUser($qId){
                $this->db->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, IFNULL(hos.hospital_phn,diag.diagnostic_phn) as miNumber, quote.status, quote.quotation_qtStatus as qStatus, usr.users_email as email, pd.patientDetails_mobileNo as contact, (CASE pd.patientDetails_dob WHEN pd.patientDetails_dob <> 0 THEN "0" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") END) as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot, (SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName, CONCAT("assets/patientImages","/",pd.patientDetails_patientImg) as pImg, IFNULL(CONCAT("assets/diagnosticsImage/thumb/original/","/",diagnostic_img), CONCAT("assets/hospitalsImages/thumb/original/","/",hospital_img) ) as miImg, (CASE quote.quotation_docRefeId WHEN  0 THEN quote.quotation_docName ELSE CONCAT(doc.doctors_fName," ", doc.doctors_lName) END) as docName, qBook.quotationBooking_bookStatus as bookStatus, qBook.quotationBooking_id as bookId');

        $this->db->from('qyura_quotations AS quote');

        $this->db->join('qyura_patientDetails AS pd', 'pd.patientDetails_usersId = quote.quotation_userId', 'left');
        $this->db->join('qyura_hospitalTimeSlot AS hosT', 'hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->db->join('qyura_diagnosticCenterTimeSlot AS diagT', 'diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = pd.patientDetails_usersId', 'left');
        $this->db->join('qyura_hospital AS hos', 'hos.hospital_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_diagnostic AS diag', 'diag.diagnostic_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_doctors AS doc', 'doc.doctors_userId = quote.quotation_docRefeId', 'left');
        $this->db->join('qyura_quotationBooking AS qBook', 'qBook.quotationBooking_quotationId = quote.quotation_id', 'left');
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');

        if ($qId)
            $this->db->where(array('quote.quotation_id' => $qId));
        $this->db->where(array('quote.quotation_deleted' => 0));
        
        $data['userDetail'] = $this->db->get()->result();
       
        
        $data['allTest'] = $this->getQuotationTests($qId);
       
        

        
     
        $this->load->library('email');
        
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        


        $this->email->from('admin@qyuram.com', 'QYURA TEAM');
        $this->email->to($data['userDetail'][0]->email);
        $body = $this->load->view('mailTemplate',$data, TRUE);
        $this->email->subject('Quotation response from qyura');
        $this->email->message($body);

       if($this->email->send()){
           return true;
       }else{
           return false;
       }

     //  echo $this->email->print_debugger();
    }

    function fetchQuotationData($condition = NULL) {

        $this->db->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, IFNULL(hos.hospital_phn,diag.diagnostic_phn) as miNumber, quote.status, quote.quotation_qtStatus as qStatus, usr.users_email as email, pd.patientDetails_mobileNo as contact, (CASE pd.patientDetails_dob WHEN pd.patientDetails_dob <> 0 THEN "0" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") END) as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot, (SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName, CONCAT("assets/patientImages","/",pd.patientDetails_patientImg) as pImg, IFNULL(CONCAT("assets/diagnosticsImage/thumb/original/","/",diagnostic_img), CONCAT("assets/hospitalsImages/thumb/original/","/",hospital_img) ) as miImg, (CASE quote.quotation_docRefeId WHEN  0 THEN quote.quotation_docName ELSE CONCAT(doc.doctors_fName," ", doc.doctors_lName) END) as docName, qBook.quotationBooking_bookStatus as bookStatus, qBook.quotationBooking_id as bookId');

        $this->db->from('qyura_quotations AS quote');

        $this->db->join('qyura_patientDetails AS pd', 'pd.patientDetails_usersId = quote.quotation_userId', 'left');
        $this->db->join('qyura_hospitalTimeSlot AS hosT', 'hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->db->join('qyura_diagnosticCenterTimeSlot AS diagT', 'diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = pd.patientDetails_usersId', 'left');
        $this->db->join('qyura_hospital AS hos', 'hos.hospital_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_diagnostic AS diag', 'diag.diagnostic_usersId = quote.quotation_MiId', 'left');
        $this->db->join('qyura_doctors AS doc', 'doc.doctors_userId = quote.quotation_docRefeId', 'left');
        $this->db->join('qyura_quotationBooking AS qBook', 'qBook.quotationBooking_quotationId = quote.quotation_id', 'left');
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');

        if ($condition)
            $this->db->where(array('quote.quotation_id' => $condition));
        $this->db->where(array('quote.quotation_deleted' => 0));

        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
    }

    function fetchQuotationDataTables($condition = NULL) {
        // echo 'ttt'; exit;
        $this->datatables->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, quote.status, (CASE quote.quotation_qtStatus WHEN 1 THEN "Sent" WHEN 0 THEN "Pending" END) as qStatus, usr.users_email as email, pd.patientDetails_mobileNo as contact, (CASE pd.patientDetails_dob WHEN pd.patientDetails_dob <> 0 THEN "0" ELSE FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") END) as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot,(SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName, (CASE quote.quotation_docRefeId WHEN  0 THEN quote.quotation_docName ELSE CONCAT(doc.doctors_fName," ", doc.doctors_lName) END) as docName');

        $this->datatables->from('qyura_quotations AS quote');

        $this->datatables->join('qyura_patientDetails AS pd', 'pd.patientDetails_usersId = quote.quotation_userId', 'left');
        $this->datatables->join('qyura_hospitalTimeSlot AS hosT', 'hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->datatables->join('qyura_diagnosticCenterTimeSlot AS diagT', 'diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId', 'left');
        $this->datatables->join('qyura_users AS usr', 'usr.users_id = pd.patientDetails_usersId', 'left');
        $this->datatables->join('qyura_hospital AS hos', 'hos.hospital_usersId = quote.quotation_MiId', 'left');
        $this->datatables->join('qyura_diagnostic AS diag', 'diag.diagnostic_usersId = quote.quotation_MiId', 'left');
        $this->datatables->join('qyura_doctors AS doc', 'doc.doctors_userId = quote.quotation_docRefeId', 'left');
       
        $this->datatables->group_by('quotation_id');
        $this->datatables->order_by('quote.creationTime', 'desc');

       $search = $this->input->post('searchVal');
        if($search){
            $this->db->group_start();
            $this->db->or_like('quote.quotation_unqId',$search);
            $this->db->or_like('IFNULL(hos.hospital_name,diag.diagnostic_name)',$search);
            $this->db->or_like('CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName)',$search);
            $this->db->or_like('usr.users_email',$search);
            $this->db->or_like('pd.patientDetails_mobileNo',$search);
            $this->db->or_like('(CASE quote.quotation_qtStatus WHEN 1 THEN "Sent" WHEN 0 THEN "Pending" END)',$search);
            $this->db->or_like('(CASE quote.quotation_docRefeId WHEN  0 THEN quote.quotation_docName ELSE CONCAT(doc.doctors_fName," ", doc.doctors_lName) END)',$search);
            $this->db->group_end();
        }  

        $fromDate = $this->input->post('fromDate');

        $toDate = $this->input->post('toDate');

        if ($fromDate != '' && $toDate != '') {
            $this->db->where('quotation_dateTime >=', strtotime($fromDate));
            $this->db->where('quotation_dateTime <=', strtotime($toDate));
        }
        
        $isSent = $this->input->post('isSent');
        
        if($isSent){
            $this->db->where('quote.quotation_qtStatus', $isSent);
        }

        // $this->db->get(); 
        // echo $this->db->last_query(); exit;

        $this->datatables->add_column('docName', '<h6>$1</h6>', 'docName');
        $this->datatables->add_column('uniqueId', '<h6>$1</h6>', 'uniqueId');
        $this->datatables->add_column('pName', '<h6>$1</h6><p>$2 $3</p>', 'pName, getGender(gender), isBlank(userAge)');
        $this->datatables->add_column('miName', '<h6>$1</h6><p>$2</p>', 'miName,cityName');
        $this->datatables->add_column('contact', '<h6>$1</h6><p>$2</p>', 'email, contact');
        $this->datatables->add_column('dt', '<h6>$1</h6><p>$2</p>', 'getDateFormat(dt), timeslot');
        $this->datatables->edit_column('qStatus', '<h6>$1</h6>', 'qStatus');

        $this->datatables->add_column('action', '<h6><a type="button" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="quotation/viewPrescription/$1">View Prescription</a></h6>
                                                <button type="button" disabled="disabled" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Send Quote</button>', 'qId');

        return $this->datatables->generate();
    }

    function UpdateTableData($data = array(), $where = array(), $tableName = NULL) {
        foreach ($where as $key => $val) {
            $this->db->where($key, $val);
        }

        $this->db->update($tableName, $data);

        //echo $this->db->last_query();exit;
        return TRUE;
    }


    //Function for update
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

    function fetchQuotationPrescription($condition = NULL) {
        $this->db->select('quotationDetail_id as prescriptionId, CONCAT("assets/proImg/","/",quotationDetail_prescription) as pricription');
        $this->db->from('qyura_quotationDetail');
        $this->db->where(array('quotationDetail_quotationId' => $condition, 'quationDetail_deleted' => 0));
        $this->db->order_by('creationTime', 'desc');
        $data = $this->db->get();
        //echo $this->db->last_query();exit;
        return $data->result();
    }

   

    public function getQuotationTests($qtnId) {

        $this->db->select('quotationDetailTests_id as testId, quotationDetailTests_diagnosticCatId as diagnoCatId, diagnosticsCat_catName as catName, quotationDetailTests_testName as testName, quotationDetailTests_date as date, quotationDetailTests_price as price, quotationDetailTests_instruction as instruction')
                ->from('qyura_quotationDetailTests')
                ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId = qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId')
                ->where(array('quotationDetailTests_quotationId' => $qtnId, 'quotationDetailTests_deleted' => 0));
        
                $data = $this->db->get();
                
                $quotationTests = $data->result();

                if (isset($quotationTests) && $quotationTests != null) {
                    return $quotationTests;
                } else
             return false;
    }
    
    
    function getDiagnoCat(){
         $this->db->select('diagnosticsCat_catId as catId, diagnosticsCat_catName as catName')
                ->from('qyura_diagnosticsCat')
                ->where(array('diagnosticsCat_deleted' => 0))
                ->order_by('creationTime', 'desc');
        
                $data = $this->db->get();
                
                $dignoCat = $data->result();

                if (isset($dignoCat) && $dignoCat != null) {
                    return $dignoCat;
                } else
             return false;
    }
    
    // by pawan
    public function setPatientProf($profData)
    {
        //dump($this->tables['patient']);
        //dump($profData);
        $this->db->insert($this->tables['patient'], $profData);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function setSocialProf($socialData)
    {
        //dump($this->tables['patient']);
        //dump($profData);
        $this->db->insert($this->tables['userSocial'], $socialData);
        $id = $this->db->insert_id();
        return $id;
    }
    
  //  quotation history by anish 
    
        function fetchQuotationHistoryDataTables( $condition = NULL){
          $this->datatables->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, quote.quotation_qtStatus as qStatus,FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot,(SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName,quoteBook.quotationBooking_quotationId,quoteBook.quotationBooking_amount as amount,quoteBook.quotationBooking_bookStatus as convertStatus');
         
        $this->datatables->from('qyura_quotations AS quote');
        
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_usersId = quote.quotation_userId','left');
         $this->db->join('qyura_quotationBooking AS quoteBook','quoteBook.quotationBooking_quotationId = quote.quotation_id','left');
        $this->db->join('qyura_hospitalTimeSlot AS hosT','hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_diagnosticCenterTimeSlot AS diagT','diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_users AS usr','usr.users_id = pd.patientDetails_usersId','left');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = quote.quotation_MiId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = quote.quotation_MiId','left');
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');
       // $this->db->get(); 
      //  echo $this->db->last_query(); exit;
        $fromDate = $this->input->post('fromDate');

        $toDate = $this->input->post('toDate');

        if ($fromDate != '' && $toDate != '') {
            $this->db->where('quotation_dateTime >=', strtotime($fromDate));
            $this->db->where('quotation_dateTime <=', strtotime($toDate));
        }
        
        $search = $this->input->post('srch');
        if($search){
            $this->db->group_start();
            $this->db->or_like('quote.quotation_unqId',$search);
            $this->db->or_like('IFNULL(hos.hospital_name,diag.diagnostic_name)',$search);
            $this->db->or_like('CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName)',$search);
            $this->db->or_like('IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)',$search);
            $this->db->or_like('quotationBooking_amount',$search);
            $this->db->group_end();
        }        
       
         $this->datatables->add_column('uniqueId', '<h6>$1</h6>', 'uniqueId');
         $this->datatables->add_column('pName', '<h6>$1</h6><p>$2  $3</p>', 'pName, getGender(gender), isBlank(userAge)');
          $this->datatables->add_column('amount', '<h6>$1</h6>', 'amount');
         $this->datatables->add_column('miName', '<h6>$1</h6><p>$2</p>', 'miName,cityName');
         $this->datatables->add_column('dt', '<h6>$1</h6>', 'getDateFormat(dt)');
         $this->datatables->edit_column('qStatus', '<h6>$1</h6>', 'getQuoteStatus(qStatus)');
         $this->datatables->edit_column('convertStatus', '<h6>$1</h6>', 'getBookQuoteStatus(convertStatus)');
       
         $this->datatables->add_column('action', '<h6><a type="button" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="quotation/viewPrescription/$1">View Prescription</a></h6>
                                                <button type="button" disabled="disabled" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Send Quote</button>','qId');
         
         return  $this->datatables->generate(); 
    }
    
    
        function createQuoteCSVdata($fromDate, $toDate = null, $search = null){
           
        $this->db->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, quote.status, quote.quotation_qtStatus as qStatus, usr.users_email as email, pd.patientDetails_mobileNo as contact, FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot,(SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName');
         
        $this->db->from('qyura_quotations AS quote');
        
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_usersId = quote.quotation_userId','left');
        $this->db->join('qyura_hospitalTimeSlot AS hosT','hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_diagnosticCenterTimeSlot AS diagT','diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_users AS usr','usr.users_id = pd.patientDetails_usersId','left');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = quote.quotation_MiId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = quote.quotation_MiId','left');
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');
        
        
        if($search != null){
            $this->db->group_start();
            $this->db->or_like('quote.quotation_unqId',$search);
            $this->db->or_like('IFNULL(hos.hospital_name,diag.diagnostic_name)',$search);
            $this->db->or_like('CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName)',$search);
            $this->db->or_like('IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)',$search);
            $this->db->or_like('FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y")',$search);
            $this->db->or_like('patientDetails_mobileNo',$search);
            $this->db->or_like('users_email',$search);
            $this->db->group_end();
        }
        
         if ($fromDate != null && $toDate != null) {
            $this->db->where('quotation_dateTime >=', strtotime($fromDate));
            $this->db->where('quotation_dateTime <=', strtotime($toDate));
        }
        
        $data= $this->db->get(); 
      // echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['miName'] = $val->miName;
            $result[$i]['uniqueId'] = $val->uniqueId;
            $result[$i]['pName'] = $val->pName;
            $result[$i]['dt'] = getDateFormat($val->dt);
            $result[$i]['email']=$val->email;
            $result[$i]['qStatus'] = $val->qStatus;
           $i++;
        }
         return $result;
        
      }
      
      function createCSVdata($fromDate, $toDate = null, $search = null){
        $this->db->select('quote.quotation_id as qId, quote.quotation_unqId as uniqueId, quote.quotation_MiId as MI, quote.quotation_userId User, quote.quotation_dateTime as dt,  quote.creationTime createdAt, IFNULL(hos.hospital_name,diag.diagnostic_name) as miName, quote.quotation_qtStatus as qStatus,FROM_UNIXTIME(UNIX_TIMESTAMP(), "%Y") - FROM_UNIXTIME(pd.patientDetails_dob, "%Y") as userAge, pd.patientDetails_gender as gender, CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName) as pName, IFNULL(CONCAT(hosT.hospitalTimeSlot_startTime,"-",hosT.hospitalTimeSlot_endTime),CONCAT(diagT.diagnosticCenterTimeSlot_startTime,"-",diagT.diagnosticCenterTimeSlot_endTime)) as timeslot,(SELECT city_name from qyura_city where city_id=IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)) as cityName,quoteBook.quotationBooking_quotationId,quoteBook.quotationBooking_amount as amount,quoteBook.quotationBooking_bookStatus as convertStatus');
         
         $this->db->from('qyura_quotations AS quote');
        
        $this->db->join('qyura_patientDetails AS pd','pd.patientDetails_usersId = quote.quotation_userId','left');
         $this->db->join('qyura_quotationBooking AS quoteBook','quoteBook.quotationBooking_quotationId = quote.quotation_id','left');
        $this->db->join('qyura_hospitalTimeSlot AS hosT','hosT.hospitalTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_diagnosticCenterTimeSlot AS diagT','diagT.diagnosticCenterTimeSlot_id = quote.quotation_timeSlotId','left');
        $this->db->join('qyura_users AS usr','usr.users_id = pd.patientDetails_usersId','left');
        $this->db->join('qyura_hospital AS hos','hos.hospital_usersId = quote.quotation_MiId','left');
        $this->db->join('qyura_diagnostic AS diag','diag.diagnostic_usersId = quote.quotation_MiId','left');
        $this->db->group_by('quotation_id');
        $this->db->order_by('quote.creationTime', 'desc');
        
        if($search != null){
            $this->db->group_start();
            $this->db->or_like('quote.quotation_unqId',$search);
            $this->db->or_like('IFNULL(hos.hospital_name,diag.diagnostic_name)',$search);
            $this->db->or_like('CONCAT(pd.patientDetails_patientName," ",pd.patientDetails_pLastName)',$search);
            $this->db->or_like('IFNULL(hos.hospital_cityId,diag.diagnostic_cityId)',$search);
            $this->db->or_like('quotationBooking_amount',$search);
            $this->db->group_end();
        }        
        
        if ($fromDate != null && $toDate != null) {
            $this->db->where('quotation_dateTime >=', strtotime($fromDate));
            $this->db->where('quotation_dateTime <=', strtotime($toDate));
        }
        
        
        $data= $this->db->get(); 
      // echo $this->db->last_query(); exit;
        $result= array();
        $i=1;
        foreach($data->result() as $key=>$val){
            $result[$i]['miName'] = $val->miName;
            $result[$i]['uniqueId'] = $val->uniqueId;
            $result[$i]['pName'] = $val->pName;
            $result[$i]['amount'] = $val->amount;
            $result[$i]['dt'] = getDateFormat($val->dt);
            $result[$i]['qStatus'] = $val->qStatus;
            $result[$i]['convertStatus'] = $val->convertStatus;
           $i++;
        }
         return $result;
        
      }
      
      
/*  dr list */
      
      public function getDrMIList($MiId = '',$MiType = '') {

            
        $this->db->select('qyura_doctors.doctors_userId,CONCAT(doctors_fName," ",doctors_lName) as drName')
                ->from('qyura_doctors')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId = qyura_doctors.doctors_userId')
                ->where(array('qyura_usersRoles.usersRoles_roleId' => ROLE_DOCTORE, 'qyura_doctors.doctors_deleted' => 0,
                               'qyura_usersRoles.usersRoles_parentId' => $MiId));
        
                $qry = $this->db->get();
                
                
               return $qry->result(); 

    }

}
