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

        if ($roleid == 1 || $roleid == 3) {
            $roleid = 13;
            $ses_roleid = $this->session->userdata('ses_mi_roleid');
        } else if ($roleid == 7) {
            $ses_roleid = $this->session->userdata('ses_sa_roleid');
        } else if ($roleid == 4) {
            $ses_roleid = $this->session->userdata('ses_doc_roleid');
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
    

    

}
