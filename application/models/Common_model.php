<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->load->config('ion_auth', TRUE);
        $this->load->helper('cookie');
        $this->load->helper('date');
        $this->lang->load('ion_auth_api');
	$this->load->library(array("ion_auth"));

        $this->identity_column = $this->config->item('identity', 'ion_auth');
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $this->salt_length = $this->config->item('salt_length', 'ion_auth');
        $this->join = $this->config->item('join', 'ion_auth');


        //initialize hash method options (Bcrypt)
        $this->hash_method = $this->config->item('hash_method', 'ion_auth');
        $this->default_rounds = $this->config->item('default_rounds', 'ion_auth');
        $this->random_rounds = $this->config->item('random_rounds', 'ion_auth');
        $this->min_rounds = $this->config->item('min_rounds', 'ion_auth');
        $this->max_rounds = $this->config->item('max_rounds', 'ion_auth');
    }

    /**
     * Hashes the password to be stored in the database.
     *
     * @return void
     * @author Developer
     * */
    public function hash_password($password, $salt = false) {
        if (empty($password)) {
            return FALSE;
        }

        //bcrypt
        if ($this->hash_method == 'bcrypt') {

            if ($this->random_rounds) {
                $rand = rand($this->min_rounds, $this->max_rounds);
                $rounds = array('rounds' => $rand);
            } else {
                $rounds = array('rounds' => $this->default_rounds);
            }

            $CI = & get_instance();

            $rounds['salt_prefix'] = '$2y$';
            $CI->load->library('frontbcrypt', $rounds);
            return $CI->frontbcrypt->hash($password);
        }


        if ($this->store_salt && $salt) {
            return sha1($password . $salt);
        } else {
            $salt = $this->salt();
            return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
        }
    }

    /**
     * This function takes a password and validates it
     * against an entry in the users table.
     *
     * @return void
     * @author Mathew
     * */
    public function hash_password_db($id, $password) {
        if (empty($id) || empty($password)) {
            return FALSE;
        }

        // $this->trigger_events('extra_where');

        $query = $this->db->select('users_id,users_password, users_salt')
                ->where('users_id', $id)
                ->limit(1)
                ->get('qyura_users');

        $hash_password_db = $query->row();

        if ($query->num_rows() !== 1) {
            return FALSE;
        }

        // bcrypt
        if ($this->hash_method == 'bcrypt') {
            $CI = & get_instance();
            $CI->load->library('frontbcrypt', null);

            if ($CI->frontbcrypt->verify($password, $hash_password_db->users_password)) {
                return TRUE;
            }
            return FALSE;
        }



        if ($this->store_salt) {
            return sha1($password . $hash_password_db->users_salt);
        } else {
            $salt = substr($hash_password_db->users_password, 0, $this->salt_length);

            return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
        }
    }

    /**
     * Generates a random salt value.
     *
     * @return void
     * @author developer
     * */
    public function salt() {
        return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
    }

    /**
     * encrypt value
     *
     * @return void
     * @author developer
     * */
    public function encryptPassword($password) {
        $salt = $this->store_salt ? $this->salt() : FALSE;
        return $this->hash_password($password, $salt);
    }

    /**
     * decript value.
     *
     * @return void
     * @author Mathew
     * */
    public function decryptPassword($id, $password) {

        return $this->hash_password_db($id, $password);
    }

    //Clear session data
    public function clearSessionData() {
        foreach ($this->session->userdata as $sess_var) {
            unset($sess_var);
        }
    }

    //Make the ID encrypted
    public function id_encrypt($str) {
        return $str * 55;
    }

    //Make the ID decrypted
    public function id_decrypt($str) {
        return $str / 55;
    }

    //Password 
    public function password_encrip($str) {
        return $str * 55;
    }
    
    
   function fetchSingleData($select,$table,$where) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $res = $this->db->get()->row();
        return $res;
    }
    function fetchAllData($select,$table,$where) {
        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $res = $this->db->get()->result();
        return $res;
    }
    
    public function mypermission($roleid = NULL) {

        if ($roleid == 1 || $roleid == 3 || $roleid == 13) {
            $roleid = 13;
            $ses_roleid = $this->session->userdata('ses_mi_roleid');
        } else if ($roleid == 7) {
            $ses_roleid = $this->session->userdata('ses_sa_roleid');
        } else if ($roleid == 4) {
            $ses_roleid = $this->session->userdata('ses_doc_roleid');
        }
        
        if($roleid == 13)
        {
            return TRUE;
        }
        
        if(!preg_match('/'.$roleid.'/',$ses_roleid)){ 
            $this->ion_auth->logout();
            $this->session->set_flashdata('message', 'You do not have access to this page!');
            redirect('auth/login/err', "refresh");
        }
        
        return TRUE;
    }
    
    public function getMITimeSlot($MIId = NULL, $Day = NULL) {

        if($MIId != NULL){
            $this->db->select("openingHours, closingHours")
                ->from("qyura_miTimeSlot")
                ->where(array("dayNumber"=>$Day,"mi_user_id"=>$MIId, "deleted"=>0));
         $res =  $this->db->get()->row();
        return $res;
        }else
            return FALSE;
    }
    public function change_appointment_status()
    {
       $today = strtotime(date("Y-m-d"));
        $mydata = $this->fetchAllData("*","qyura_doctorAppointment",array("($today - cast(doctorAppointment_date AS SIGNED))="=>"86400","(doctorAppointment_status=11 OR doctorAppointment_status=12)"=>NULL,"doctorAppointment_status!=19"=>NULL));
//        echo $this->db->last_query();
//        echo "<pre>";
//        print_r($mydata);
//        exit;
        if(!empty($mydata))
        {
             $updateOption = array(
                'data' => array(
                    'doctorAppointment_status' => 19,
                ),
                'table' => 'qyura_doctorAppointment',
                'where' => array("($today - cast(doctorAppointment_date AS SIGNED))="=>"86400","(quotation_qtStatus=11 OR quotation_qtStatus=12)"=>NULL,"doctorAppointment_status!=19"=>NULL)
            );
            $isUpdate = $this->customUpdate($updateOption);
        }
        
        $mydata = $this->fetchAllData("*","qyura_quotations",array("($today - cast(quotation_dateTime AS SIGNED))="=>"86400","(quotation_qtStatus=11 OR quotation_qtStatus=12)"=>NULL,"quotation_qtStatus!=19"=>NULL));
        if(!empty($mydata))
        {
             $updateOption = array(
                'data' => array(
                    'quotation_qtStatus' => 19,
                ),
                'table' => 'qyura_quotations',
                'where' => array("($today-cast(quotation_dateTime AS SIGNED))="=>"86400","(quotation_qtStatus=11 OR quotation_qtStatus=12)"=>NULL,"quotation_qtStatus!=19"=>NULL)
            );
            $isUpdate = $this->customUpdate($updateOption);
        }
        
        exit;
    }
    
    function fetchHospitalData($conditionId = NULL) {
        $this->db->select(
        '"Hospital" as label,0 as miOptLabel,Hos.hospital_id as miId, usr.users_id as users_id, Hos.hospital_name as miName,
        Hos.hospital_type as miType, usr.users_email as miEmail, usr.users_mobile as userMobile, City.city_name as city_name, 
        State.state_statename as statename, 
        Hos.hospital_countryId as countryId, Hos.hospital_stateId as stateId, Hos.hospital_cityId as cityId,
        Hos.hospital_zip as zip, Hos.hospital_phn as phn, Hos.hospital_address as address, Hos.hospital_long as long, 
        Hos.hospital_lat as lat, Hos.hospital_img as img, Hos.hospital_cntPrsn as cntPrsn, Hos.docatId as docatId,
        Hos.hospital_mbl as miMobile, Hos.hospital_aboutUs as aboutUs, Hos.specialityNameFormate as specialityNameFormate, Hos.hospital_dsgn as dsgn,
        Hos.hospital_mmbrTyp as miMbrTyp,
        Hos.availibility_24_7 as availibility_24_7, Hos.isEmergency as isEmergency, Hos.isManual as isManual,  
        Hos.hasPharmacy as hasPharmacy, Hos.hasBloodbank as hasBloodbank, Hos.isBloodBankOutsource,Hos.hospital_background_img as background_img,
        
        Blood.bloodBank_id, Blood.bloodBank_name, Blood.bloodBank_phn, Blood.bloodBank_photo, 
        
        Pharmacy.pharmacy_id, Pharmacy.pharmacy_name, Pharmacy.pharmacy_phn,
        
        Ambu.ambulance_id, Ambu.ambulance_name,Ambu.ambulance_phn,Ambu.ambulance_img, Ambu.docOnBoard'
        );
        
        $this->db->from('qyura_hospital AS Hos');
        $this->db->join('qyura_city AS City', 'City.city_id = Hos.hospital_cityId', 'left');
        $this->db->join('qyura_state AS State', 'State.state_id = Hos.hospital_stateId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = Hos.hospital_usersId', 'left');
        
        $this->db->join('qyura_bloodBank AS Blood', 'Blood.users_id = Hos.hospital_usersId', 'left');
        $this->db->join('qyura_pharmacy AS Pharmacy', 'Pharmacy.pharmacy_usersId = Hos.hospital_usersId', 'left');
        $this->db->join('qyura_ambulance AS Ambu', 'Ambu.ambulance_usersId = Hos.hospital_usersId', 'left');
        
        $this->db->join('qyura_hospitalType AS hosType', 'hosType.hospitalType_id = Hos.hospital_type', 'left');
        
        if ($conditionId) {
            $this->db->where($conditionId);
        }
        
        $this->db->where(array('Hos.hospital_deleted' => 0));
        $this->db->where_in('Hos.status', array(0,1));
        $this->db->order_by("Hos.creationTime", "desc");
        $data = $this->db->get();
        return $data->row();
    }
    
    function fetchdiagnosticDataDetails($conditionId = NULL) {

        $this->db->select(
        "'Diagnostic' as label,1 as miOptLabel,diag.diagnostic_id as miId, usr.users_id as users_id, diag.diagnostic_name as miName,
        diag.diagnostic_type as miType,usr.users_email as miEmail, usr.users_mobile as userMobile, City.city_name as city_name, 
        State.state_statename as statename, 
        diag.diagnostic_countryId as countryId, diag.diagnostic_stateId as stateId, diag.diagnostic_cityId as cityId,
        diag.diagnostic_zip as zip, diag.diagnostic_phn as phn, diag.diagnostic_address as address, diag.diagnostic_long as long,
        diag.diagnostic_lat as lat, diag.diagnostic_img as img, diag.diagnostic_cntPrsn as cntPrsn, diag.diagnostic_docatId as docatId,
        diagnostic_mblNo as as miMobile, diag.diagnostic_aboutUs as aboutUs, diag.diagnostic_specialityNameFormate as specialityNameFormate, diag.diagnostic_dsgn as dsgn,
        diag.diagnostic_mbrTyp as miMbrTyp,
        diag.diagnostic_availibility_24_7 as availibility_24_7, diag.diagnostic_isEmergency as isEmergency, diag.isManual as isManual,  
        diag.diagnostic_hasPharmacy as hasPharmacy, diag.diagnostic_hasBloodbank as hasBloodbank, diag.diagnostic_isBloodBankOutsource as isBloodBankOutsource,diag.diagnostic_background_img as background_img
        ");
        $this->db->from('qyura_diagnostic AS diag');
        $this->db->join('qyura_city AS City', 'City.city_id = diag.diagnostic_cityId', 'left');
        $this->db->join('qyura_state AS State', 'State.state_id = diag.diagnostic_stateId', 'left');
        $this->db->join('qyura_users AS usr', 'usr.users_id = diag.diagnostic_usersId', 'left');
        if ($conditionId) {
            $this->db->where($conditionId);
        }
        $this->db->where(array('diag.diagnostic_deleted' => 0));
        $this->db->where_in('diag.status', array(0,1));
        $this->db->order_by("diag.creationTime", "desc");
        $data = $this->db->get();
        return $data->row();
    }
    

    

}
