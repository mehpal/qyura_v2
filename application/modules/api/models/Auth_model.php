<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name:  Ion Auth Model
 *
 * Version: 2.5.2
 *
 * Author:  Ben Edmunds
 * 		   ben.edmunds@gmail.com
 * 	  	   @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Last Change: 3.22.13
 *
 * Changelog:
 * * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */
class Auth_model extends CI_Model {

    /**
     * Holds an array of tables used
     *
     * @var array
     * */
    public $tables = array();

    /**
     * activation code
     *
     * @var string
     * */
    public $activation_code;
    
    
    /**
     * otp code
     *
     * @var string
     * */
    public $activationCode;

    /**
     * forgotten password key
     *
     * @var string
     * */
    public $forgotten_password_code;

    /**
     * new password
     *
     * @var string
     * */
    public $new_password;

    /**
     * Identity
     *
     * @var string
     * */
    public $identity;

    /**
     * Where
     *
     * @var array
     * */
    public $_ion_where = array();
    
    /**
     * or_where
     *
     * @var array
     * */
    public $_ion_or_where = array();

    /**
     * Select
     *
     * @var array
     * */
    public $_ion_select = array();

    /**
     * Like
     *
     * @var arrayfilter
     * */
    public $_ion_like = array();

    /**
     * Limit
     *
     * @var string
     * */
    public $_ion_limit = NULL;

    /**
     * Offset
     *
     * @var string
     * */
    public $_ion_offset = NULL;

    /**
     * Order By
     *
     * @var string
     * */
    public $_ion_order_by = NULL;

    /**
     * Order
     *
     * @var string
     * */
    public $_ion_order = NULL;

    /**
     * Hooks
     *
     * @var object
     * */
    protected $_ion_hooks;

    /**
     * Response
     *
     * @var string
     * */
    protected $response = NULL;

    /**
     * message (uses lang file)
     *
     * @var string
     * */
    protected $messages;

    /**
     * error message (uses lang file)
     *
     * @var string
     * */
    protected $errors;

    /**
     * error start delimiter
     *
     * @var string
     * */
    protected $error_start_delimiter;

    /**
     * error end delimiter
     *
     * @var string
     * */
    protected $error_end_delimiter;

    /**
     * caching of users and their groups
     *
     * @var array
     * */
    public $_cache_user_in_group = array();

    /**
     * caching of groups
     *
     * @var array
     * */
    protected $_cache_groups = array();

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->config('auth_conf_api', TRUE);
        $this->load->helper('cookie');
        $this->load->helper('date');
        $this->lang->load('ion_auth_api');

        //initialize db tables data
        $this->tables = $this->config->item('tables', 'auth_conf_api');

        //initialize data
        $this->identity_column = $this->config->item('identity', 'auth_conf_api');
        $this->identity_mobile = $this->config->item('identity_mobile', 'auth_conf_api');
        $this->store_salt = $this->config->item('store_salt', 'auth_conf_api');
        $this->salt_length = $this->config->item('salt_length', 'auth_conf_api');
        $this->join = $this->config->item('join', 'auth_conf_api');


        //initialize hash method options (Bcrypt)
        $this->hash_method = $this->config->item('hash_method', 'auth_conf_api');
        $this->default_rounds = $this->config->item('default_rounds', 'auth_conf_api');
        $this->random_rounds = $this->config->item('random_rounds', 'auth_conf_api');
        $this->min_rounds = $this->config->item('min_rounds', 'auth_conf_api');
        $this->max_rounds = $this->config->item('max_rounds', 'auth_conf_api');


        //initialize messages and error
        $this->messages = array();
        $this->errors = array();
        $delimiters_source = $this->config->item('delimiters_source', 'auth_conf_api');

        //load the error delimeters either from the config file or use what's been supplied to form validation
        if ($delimiters_source === 'form_validation') {
            //load in delimiters from form_validation
            //to keep this simple we'll load the value using reflection since these properties are protected
            $this->load->library('form_validation');
            $form_validation_class = new ReflectionClass("CI_Form_validation");

            $error_prefix = $form_validation_class->getProperty("_error_prefix");
            $error_prefix->setAccessible(TRUE);
            $this->error_start_delimiter = $error_prefix->getValue($this->form_validation);
            $this->message_start_delimiter = $this->error_start_delimiter;

            $error_suffix = $form_validation_class->getProperty("_error_suffix");
            $error_suffix->setAccessible(TRUE);
            $this->error_end_delimiter = $error_suffix->getValue($this->form_validation);
            $this->message_end_delimiter = $this->error_end_delimiter;
        } else {
            //use delimiters from config
            $this->message_start_delimiter = $this->config->item('message_start_delimiter', 'auth_conf_api');
            $this->message_end_delimiter = $this->config->item('message_end_delimiter', 'auth_conf_api');
            $this->error_start_delimiter = $this->config->item('error_start_delimiter', 'auth_conf_api');
            $this->error_end_delimiter = $this->config->item('error_end_delimiter', 'auth_conf_api');
        }


        //initialize our hooks object
        $this->_ion_hooks = new stdClass;

        //load the bcrypt class if needed
        if ($this->hash_method == 'bcrypt') {
            if ($this->random_rounds) {
                $rand = rand($this->min_rounds, $this->max_rounds);
                $params = array('rounds' => $rand);
            } else {
                $params = array('rounds' => $this->default_rounds);
            }

            $params['salt_prefix'] = $this->config->item('salt_prefix', 'auth_conf_api');
            $this->load->library('bcrypt', $params);
        }

        $this->trigger_events('model_constructor');
    }

    /**
     * Misc functions
     *
     * Hash password : Hashes the password to be stored in the database.
     * Hash password db : This function takes a password and validates it
     * against an entry in the users table.
     * Salt : Generates a random salt value.
     *
     * @author Mathew
     */

    /**
     * Hashes the password to be stored in the database.
     *
     * @return void
     * @author Mathew
     * */
    public function hash_password($password, $salt = false, $use_sha1_override = FALSE) {
        if (empty($password)) {
            return FALSE;
        }

        //bcrypt
        if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt') {
            return $this->bcrypt->hash($password);
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
    public function hash_password_db($id, $password, $use_sha1_override = FALSE) {
        if (empty($id) || empty($password)) {
            return FALSE;
        }
        
        $this->trigger_events('extra_where');

        $query = $this->db->select('users_password, users_salt')
                ->where('users_id', $id)
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);
        
        $hash_password_db = $query->row();
        
        if ($query->num_rows() !== 1) {
            return FALSE;
        }
        
        
        // bcrypt
        if ($use_sha1_override === FALSE && $this->hash_method == 'bcrypt') {
            if ($this->bcrypt->verify($password, $hash_password_db->users_password)) {
                return TRUE;
            }

            return FALSE;
        }

        // sha1
        if ($this->store_salt) {
            $db_password = sha1($password . $hash_password_db->users_salt);
        } else {
            $salt = substr($hash_password_db->users_password, 0, $this->salt_length);

            $db_password = $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
        }

        if ($db_password == $hash_password_db->users_password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Generates a random salt value for forgotten passwords or any other keys. Uses SHA1.
     *
     * @return void
     * @author Mathew
     * */
    public function hash_code($password) {
        return $this->hash_password($password, FALSE, TRUE);
    }

    /**
     * Generates a random salt value.
     *
     * Salt generation code taken from https://github.com/ircmaxell/password_compat/blob/master/lib/password.php
     *
     * @return void
     * @author Anthony Ferrera
     * */
    public function salt() {

        $raw_salt_len = 16;

        $buffer = '';
        $buffer_valid = false;

        if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
            $buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
            $buffer = openssl_random_pseudo_bytes($raw_salt_len);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && @is_readable('/dev/urandom')) {
            $f = fopen('/dev/urandom', 'r');
            $read = strlen($buffer);
            while ($read < $raw_salt_len) {
                $buffer .= fread($f, $raw_salt_len - $read);
                $read = strlen($buffer);
            }
            fclose($f);
            if ($read >= $raw_salt_len) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
            $bl = strlen($buffer);
            for ($i = 0; $i < $raw_salt_len; $i++) {
                if ($i < $bl) {
                    $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                } else {
                    $buffer .= chr(mt_rand(0, 255));
                }
            }
        }

        $salt = $buffer;

        // encode string with the Base64 variant used by crypt
        $base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $base64_string = base64_encode($salt);
        $salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

        $salt = substr($salt, 0, $this->salt_length);


        return $salt;
    }

    /**
     * Activation functions
     *
     * Activate : Validates and removes activation code.
     * Deactivae : Updates a users row with an activation code.
     *
     * @author Mathew
     */

    /**
     * activate
     *
     * @return void
     * @author Mathew
     * */
    public function activate($id, $code = false) {
        $this->trigger_events('pre_activate');

        if ($code !== FALSE) {
            $query = $this->db->select($this->identity_column)
                    ->where('users_activationCode', $code)
                    ->where('users_id', $id)
                    ->limit(1)
                    ->order_by('users_id', 'desc')
                    ->get($this->tables['users']);

            $result = $query->row();

            if ($query->num_rows() !== 1) {
                $this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
                $this->set_error('activate_unsuccessful');
                return FALSE;
            }

            $data = array(
                'users_activationCode' => NULL,
                'users_active' => 1
            );

            $this->trigger_events('extra_where');
            $this->db->update($this->tables['users'], $data, array('users_id' => $id));
        } else {
            $data = array(
                'users_activationCode' => NULL,
                'users_active' => 1
            );

            $this->trigger_events('extra_where');
            $this->db->update($this->tables['users'], $data, array('users_id' => $id));
        }


        $return = $this->db->affected_rows() == 1;
        if ($return) {
            $this->trigger_events(array('post_activate', 'post_activate_successful'));
            $this->set_message('activate_successful');
        } else {
            $this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
            $this->set_error('activate_unsuccessful');
        }


        return $return;
    }
    
    /**
     * activate OTP
     *
     * @return void
     * @author Mathew
     * */
    public function otp_activate($id, $code = false) {
        $this->trigger_events('pre_activate');

        if ($code !== FALSE) {
            $query = $this->db->select($this->identity_column.', users_otpTime')
                    ->where('users_otpCode', $code)
                    ->where('users_id', $id)
                    ->limit(1)
                    ->order_by('users_id', 'desc')
                    ->get($this->tables['users']);

            $result = $query->row();

            if ($query->num_rows() !== 1) {
                $this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
                $this->set_error('otp_activate_unsuccessful');
                return FALSE;
            }
            
            $now = time();
            $otpTime = $result->users_otpTime;
            $acceptTime = ($this->config->item('otp_time_in_min', 'auth_conf_api') != '' && $this->config->item('otp_time_in_min', 'auth_conf_api') != null) ? $this->config->item('otp_time_in_min', 'auth_conf_api'):15;
            $timeDuration = 60*$acceptTime;
            $newTime = $timeDuration+$otpTime;
            
            
            if($now > $newTime)
            {
                $this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
                $this->set_error('otp_expired');
                return FALSE;
            }
            

            $data = array(
                'users_otpCode' => NULL,
                'users_otpActive' => 1
            );

            $this->trigger_events('extra_where');
            $this->db->update($this->tables['users'], $data, array('users_id' => $id));
        } else {
            $data = array(
                'users_otpCode' => NULL,
                'users_otpActive' => 1
            );

            $this->trigger_events('extra_where');
            $this->db->update($this->tables['users'], $data, array('users_id' => $id));
        }


        $return = $this->db->affected_rows() == 1;
        if ($return) {
            $this->trigger_events(array('post_activate', 'post_activate_successful'));
            $this->set_message('otp_activate_successful');
        } else {
            $this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
            $this->set_error('otp_activate_unsuccessful');
        }


        return $return;
    }

    /**
     * Deactivate
     *
     * @return void
     * @author Mathew
     * */
    public function deactivate($id = NULL) {
        $this->trigger_events('deactivate');

        if (!isset($id)) {
            $this->set_error('deactivate_unsuccessful');
            return FALSE;
        }

        $activation_code = sha1(md5(microtime()));
        $this->activation_code = $activation_code;

        $data = array(
            'users_activationCode' => $activation_code,
            'users_active' => 0
        );

        $this->trigger_events('extra_where');
        $this->db->update($this->tables['users'], $data, array('users_id' => $id));

        $return = $this->db->affected_rows() == 1;
        if ($return)
            $this->set_message('deactivate_successful');
        else
            $this->set_error('deactivate_unsuccessful');

        return $return;
    }
    
    
    /**
     * Deactivate
     *
     * @return void
     * @author Mathew
     * */
    public function otpCreate($id = NULL) {
        $this->trigger_events('otp');

        if (!isset($id)) {
            $this->set_error('deactivate_unsuccessful');
            return FALSE;
        }

        $activationCode = random_string('nozero', 5);
        $this->activationCode = $activationCode;

        $data = array(
            'users_otpCode' => $activationCode,
            'users_otpTime' => time(),
            'users_otpActive' => 0
        );

        $this->trigger_events('extra_where');
        $this->db->update($this->tables['users'], $data, array('users_id' => $id));
        $query = $this->db->select($this->identity_column.',users_mobile')
                    
                    ->where('users_id', $id)
                    ->limit(1)
                    ->order_by('users_id', 'desc')
                    ->get($this->tables['users']);

        $userdata  = $query->row();
        
        $return = $this->db->affected_rows() == 1;
        if ($return){
            $this->set_message('otp_successful');
            
            $this->load->library('clickatell');
        
            $message = $this->lang->line('otp_message');
            $message = str_replace('%s', $activationCode, $message);
            $msgId  = $this->clickatell->send_message($userdata->users_mobile,$message);
		
            $subject = 'Qyura OTP';
            $to = $userdata->users_email;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
            $headers .= 'From: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                    'Reply-To: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            $mailr = mail($to, $subject, $message, $headers);
            
            
        }
        else
            $this->set_error('otp_unsuccessful');

        return $return;
    }

    public function clear_forgotten_password_code($code) {

        if (empty($code)) {
            return FALSE;
        }

        $this->db->where('forgotten_password_code', $code);

        if ($this->db->count_all_results($this->tables['users']) > 0) {
            $data = array(
                'forgotten_password_code' => NULL,
                'forgotten_password_time' => NULL
            );

            $this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

            return TRUE;
        }

        return FALSE;
    }

    /**
     * reset password
     *
     * @return bool
     * @author Mathew
     * */
    public function reset_password($identity, $new) {
        $this->trigger_events('pre_change_password');

        if (!$this->identity_check($identity)) {
            $this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
            return FALSE;
        }

        $this->trigger_events('extra_where');

        $query = $this->db->select('users_id, users_password, users_salt')
                ->where($this->identity_column, $identity)
                ->or_where($this->identity_mobile,$identity)
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);

        if ($query->num_rows() !== 1) {
            $this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $result = $query->row();

        $new = $this->hash_password($new, $result->users_salt);

        //store the new password and reset the remember code so all remembered instances have to re-login
        //also clear the forgotten password code
        $data = array(
            'users_password' => $new,
            'users_rememberCode' => NULL,
            'users_forgottenPasswordCode' => NULL,
            'users_forgottenPasswordTime' => NULL,
        );

        $this->trigger_events('extra_where');
        $this->db->update($this->tables['users'], $data, array($this->identity_column => $identity));

        $return = $this->db->affected_rows() == 1;
        if ($return) {
            $this->trigger_events(array('post_change_password', 'post_change_password_successful'));
            $this->set_message('password_change_successful');
        } else {
            $this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
        }

        return $return;
    }

    /**
     * change password
     *
     * @return bool
     * @author Mathew
     * */
    public function change_password($identity, $old, $new) {
        $this->trigger_events('pre_change_password');

        $this->trigger_events('extra_where');

        $query = $this->db->select('users_id, users_password, users_salt')
                ->where($this->identity_column, $identity)
                ->or_where($this->identity_mobile,$identity)
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);
        
        if ($query->num_rows() !== 1) {
            $this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $user = $query->row();
        
        //$old_password_matches = $this->hash_password_db($user->users_id, $old);
        
        
        //if ($old_password_matches === TRUE) {
        if (TRUE) {
            //store the new password and reset the remember code so all remembered instances have to re-login
            $hashed_new_password = $this->hash_password($new, $user->users_salt);
            $data = array(
                'users_password' => $hashed_new_password,
                'users_rememberCode' => NULL,
            );

            $this->trigger_events('extra_where');

            $successfully_changed_password_in_db = $this->db->update($this->tables['users'], $data, array($this->identity_column => $identity));
            
            
            if ($successfully_changed_password_in_db) {
                $this->trigger_events(array('post_change_password', 'post_change_password_successful'));
                $this->set_message('password_change_successful');
            } else {
                $this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
                $this->set_error('password_change_unsuccessful');
            }

            return $successfully_changed_password_in_db;
        }

        $this->set_error('password_change_unsuccessful');
        return FALSE;
    }

    /**
     * Checks username
     *
     * @return bool
     * @author Mathew
     * */
    public function username_check($username = '') {
        $this->trigger_events('username_check');

        if (empty($username)) {
            return FALSE;
        }

        $this->trigger_events('extra_where');

        return $this->db->where(array('users_username' => $username, 'users_deleted' => 0))
                        ->order_by("users_id", "ASC")
                        ->limit(1)
                        ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Checks email
     *
     * @return bool
     * @author Mathew
     * */
    public function email_check($email = '') {
        $this->trigger_events('email_check');

        if (empty($email)) {
            return FALSE;
        }

        $this->trigger_events('extra_where');

        return $this->db->where(array('users_email' => $email, 'users_deleted' => 0))
                        ->order_by("users_id", "ASC")
                        ->limit(1)
                        ->count_all_results($this->tables['users']) > 0;
    }
    
     /**
     * Checks email
     *
     * @return bool
     * @author Mathew
     * */
    public function mobile_check($mobile = '') {
        $this->trigger_events('mobile_check');

        if (empty($mobile)) {
            return FALSE;
        }

        $this->trigger_events('extra_where');

        return $this->db->where(array('users_mobile' => $mobile, 'users_deleted' => 0))
                        ->order_by("users_id", "ASC")
                        ->limit(1)
                        ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Identity check
     *
     * @return bool
     * @author Mathew
     * */
    public function identity_check($identity = '') {
        $this->trigger_events('identity_check');

        if (empty($identity)) {
            return FALSE;
        }

        return $this->db->where($this->identity_column, $identity)
                ->or_where($this->identity_mobile,$identity)
                        ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Insert a forgotten password key.
     *
     * @return bool
     * @author Mathew
     * @updated Ryan
     * @updated 52aa456eef8b60ad6754b31fbdcc77bb
     * */
    public function forgotten_password($identity) {
        if (empty($identity)) {
            $this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_unsuccessful'));
            return FALSE;
        }

        //All some more randomness
        $activation_code_part = "";
        if (function_exists("openssl_random_pseudo_bytes")) {
            $activation_code_part = openssl_random_pseudo_bytes(128);
        }

        for ($i = 0; $i < 1024; $i++) {
            $activation_code_part = sha1($activation_code_part . mt_rand() . microtime());
        }

        $key = $this->hash_code($activation_code_part . $identity);

        // If enable query strings is set, then we need to replace any unsafe characters so that the code can still work
        if ($key != '' && $this->config->item('permitted_uri_chars') != '' && $this->config->item('enable_query_strings') == FALSE) {
            // preg_quote() in PHP 5.3 escapes -, so the str_replace() and addition of - to preg_quote() is to maintain backwards
            // compatibility as many are unaware of how characters in the permitted_uri_chars will be parsed as a regex pattern
            if (!preg_match("|^[" . str_replace(array('\\-', '\-'), '-', preg_quote($this->config->item('permitted_uri_chars'), '-')) . "]+$|i", $key)) {
                $key = preg_replace("/[^" . $this->config->item('permitted_uri_chars') . "]+/i", "-", $key);
            }
        }

        $this->forgotten_password_code = $key;

        $this->trigger_events('extra_where');

        $update = array(
            'users_forgottenPasswordCode' => $key,
            'users_forgottenPasswordTime' => time()
        );
        
        

        $this->db->update($this->tables['users'], $update, array($this->identity_column => $identity));

        $return = $this->db->affected_rows() == 1;

        if ($return){
            $this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_successful'));
        }
        else
            $this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_unsuccessful'));

        return $return;
    }
    
    /**
     * Insert a forgotten password key.
     *
     * @return bool
     * @author Mathew
     * @updated Ryan
     * @updated 52aa456eef8b60ad6754b31fbdcc77bb
     * */
    public function updatePassword($con,$password=false) {
        
        $salt = $this->store_salt ? $this->salt() : FALSE;
        if($password){
            $data = array(
                'password' => $this->hash_password($password, $salt),
            );

            $this->db->update($this->tables['users'], $data, $con);
        }

        $this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_successful'));
        return $password;
    }

    /**
     * Forgotten Password Complete
     *
     * @return string
     * @author Mathew
     * */
    public function forgotten_password_complete($code, $salt = FALSE) {
        $this->trigger_events('pre_forgotten_password_complete');

        if (empty($code)) {
            $this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
            return FALSE;
        }

        $profile = $this->where('users_forgottenPasswordCode', $code)->users()->row(); //pass the code to profile

        if ($profile) {

            if ($this->config->item('forgot_password_expiration', 'auth_conf_api') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->item('forgot_password_expiration', 'auth_conf_api');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->set_error('forgot_password_expired');
                    $this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
                    return FALSE;
                }
            }

            $password = $this->salt();

            $data = array(
                'password' => $this->hash_password($password, $salt),
                'forgotten_password_code' => NULL,
                'active' => 1,
            );

            $this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

            $this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_successful'));
            return $password;
        }

        $this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
        return FALSE;
    }

    /**
     * register
     *
     * @return bool
     * @author Mathew
     * */
    public function register($username, $password, $email, $additional_data = array(), $groups = array()) {
        $this->trigger_events('pre_register');

        $manual_activation = $this->config->item('manual_activation', 'auth_conf_api');
        
        $manual_otp_activation = $this->config->item('manual_otp_activation', 'auth_conf_api');

        if ($this->identity_mobile == 'users_mobile' && $this->mobile_check($email)) {
            $this->set_error('account_creation_duplicate_mobile');
            return FALSE;
        }
        
        if ($this->identity_column == 'users_email' && $this->email_check($email)) {
            $this->set_error('account_creation_duplicate_email');
            return FALSE;
        } elseif ($this->identity_column == 'users_username' && $this->username_check($username)) {
            $this->set_error('account_creation_duplicate_username');
            return FALSE;
        } elseif (!$this->config->item('default_group', 'auth_conf_api') && empty($groups)) {
            $this->set_error('account_creation_missing_default_group');
            return FALSE;
        }

        //check if the default set in config exists in database
        $query = $this->db->get_where('qyura_roles', array('roles_name' => $this->config->item('default_group', 'auth_conf_api')), 1)->row();
        if (!isset($query->roles_id) && empty($groups)) {
            $this->set_error('account_creation_invalid_default_group');
            return FALSE;
        }
        //dump($query);
        //capture default group details
        $default_group = $query;

        // If username is taken, use username1 or username2, etc.
        if ($this->identity_column != 'users_username') {
            $original_username = $username;
            for ($i = 0; $this->username_check($username); $i++) {
                if ($i > 0) {
                    $username = $original_username . $i;
                }
            }
        }

        // IP Address
        $ip_address = $this->_prepare_ip($this->input->ip_address());
        $salt = $this->store_salt ? $this->salt() : FALSE;
        $password = $this->hash_password($password, $salt);

        // Users table.
        $data = array(
            'users_username' => $username,
            'users_password' => $password,
            'users_email' => $email,
            'users_ip_address' => $ip_address,
            'creationTime' => time(),
            'users_active' => ($manual_activation === false ? 1 : 0),
            'users_otpCode' => ($manual_otp_activation === false ? 1 : 0)
            
        );

        if ($this->store_salt) {
            $data['users_salt'] = $salt;
        }

        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $user_data = array_merge($this->_filter_data($this->tables['users'], $additional_data), $data);

        $this->trigger_events('extra_set');

        $this->db->insert($this->tables['users'], $user_data);

        $id = $this->db->insert_id();

        //add in groups array if it doesn't exits and stop adding into default group if default group ids are set
        if (isset($default_group->roles_id) && empty($groups)) {
            $groups[] = $default_group->roles_id;
        }

        if (!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->add_to_group($group, $id);
            }
        }

        $this->trigger_events('post_register');

        return (isset($id)) ? $id : FALSE;
    }
    
    public function registerSocial($username, $password, $email, $additional_data = array(), $groups = array()) {
        $this->trigger_events('pre_register');

        $manual_activation = 1;
        
        $manual_otp_activation = $this->config->item('manual_otp_activation', 'auth_conf_api');
        
        if ($this->identity_mobile == 'users_mobile' && $this->mobile_check($username)) {
            $this->set_error('account_creation_duplicate_mobile');
            return FALSE;
        }

        if ($this->identity_column == 'users_email' && $this->email_check($email)) {
            $this->set_error('account_creation_duplicate_email');
            return FALSE;
        } elseif ($this->identity_column == 'users_username' && $this->username_check($username)) {
            $this->set_error('account_creation_duplicate_username');
            return FALSE;
        }  elseif (!$this->config->item('default_group', 'auth_conf_api') && empty($groups)) {
            $this->set_error('account_creation_missing_default_group');
            return FALSE;
        }

        //check if the default set in config exists in database
        $query = $this->db->get_where('qyura_roles', array('roles_name' => $this->config->item('default_group', 'auth_conf_api')), 1)->row();
        if (!isset($query->roles_id) && empty($groups)) {
            $this->set_error('account_creation_invalid_default_group');
            return FALSE;
        }
        //dump($query);
        //capture default group details
        $default_group = $query;

        // If username is taken, use username1 or username2, etc.
        if ($this->identity_column != 'users_username') {
            $original_username = $username;
            for ($i = 0; $this->username_check($username); $i++) {
                if ($i > 0) {
                    $username = $original_username . $i;
                }
            }
        }

        // IP Address
        $ip_address = $this->_prepare_ip($this->input->ip_address());
        $salt = $this->store_salt ? $this->salt() : FALSE;
        $password = $this->hash_password($password, $salt);

        // Users table.
        $data = array(
            'users_username' => $username,
            'users_password' => $password,
            'users_email' => $email,
            'users_ip_address' => $ip_address,
            'creationTime' => time(),
            'users_active' => ($manual_activation === false ? 1 : 0),
            'users_otpCode' => ($manual_otp_activation === false ? 1 : 0)
        );

        if ($this->store_salt) {
            $data['users_salt'] = $salt;
        }

        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $user_data = array_merge($this->_filter_data($this->tables['users'], $additional_data), $data);

        $this->trigger_events('extra_set');

        $this->db->insert($this->tables['users'], $user_data);

        $id = $this->db->insert_id();

        //add in groups array if it doesn't exits and stop adding into default group if default group ids are set
        if (isset($default_group->roles_id) && empty($groups)) {
            $groups[] = $default_group->roles_id;
        }

        if (!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->add_to_group($group, $id);
            }
        }

        $this->trigger_events('post_register');

        return (isset($id)) ? $id : FALSE;
    }

    
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
    /**
     * login
     *
     * @return bool
     * @author Mathew
     * */
    public function login($identity, $password, $remember = FALSE) {
        $this->trigger_events('pre_login');

        if (empty($identity) || empty($password)) {
            $this->set_error('login_unsuccessful');
            return FALSE;
        }

        $this->trigger_events('extra_where');

        $query = $this->db->select($this->identity_column . ', users_username, users_email, users_id, users_password, users_active,users_otpActive, users_lastLogin,users_mobile')
                ->where($this->identity_column, $identity)
                ->or_where($this->identity_mobile,$identity)
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);

        if ($this->is_time_locked_out($identity)) {
            //Hash something anyway, just to take up time
            $this->hash_password($password);

            $this->trigger_events('post_login_unsuccessful');
            $this->set_error('login_timeout');

            return FALSE;
        }

        if ($query->num_rows() === 1) {
            $user = $query->row();

            $password = $this->hash_password_db($user->users_id, $password);

            if ($password === TRUE) {
//                if ($user->users_active == 0) {
//                    $this->trigger_events('post_login_unsuccessful');
//                    $error = $this->lang->line('login_unsuccessful_not_active_custom');
//                    $error =  str_replace(array('{replace}', '{param}'), array($user->users_email), $error);  
//                    $this->set_error($error);
//
//                    return FALSE;
//                }
                
                if ($user->users_otpActive == 0) {
                    $this->trigger_events('post_login_unsuccessful');
                    $error = $this->lang->line('login_unsuccessful_not_active_otp_custom');
                    $error =  str_replace(array('{replace}', '{param}'), array($user->users_mobile), $error);  
                    $this->set_error($error);
                    return FALSE;
                }

                $this->set_session($user);

                $this->update_last_login($user->users_id);

                $this->clear_login_attempts($identity);

                if ($remember && $this->config->item('remember_users', 'auth_conf_api')) {
                    $this->remember_user($user->users_id);
                }

                $this->trigger_events(array('post_login', 'post_login_successful'));
                $this->set_message('login_successful');

                return $user;
            }
            
        }

        
        //Hash something anyway, just to take up time
        $this->hash_password($password);

        $this->increase_login_attempts($identity);

        $this->trigger_events('post_login_unsuccessful');
        $this->set_error('login_unsuccessful');

        return FALSE;
    }
    
    public function createPassword($password=false)
    {
        $salt = $this->store_salt ? $this->salt() : FALSE;
        if($password)
        {
            $password = $this->hash_password($password, $salt);
            $data['users_password'] = $password;
        }
        
        if ($this->store_salt) {
        $data['users_salt'] = $salt;
        }
        
        if(isset($data) && !empty($data))
        {
            return $data;
        }
        
        return false;
    }
    
    public function login_user_data($identity, $password,$remember = FALSE) {
        $this->trigger_events('pre_login');

        if (empty($identity) || empty($password)) {
            $this->set_error('login_unsuccessful');
            return FALSE;
        }

        $this->trigger_events('extra_where');

        $query = $this->db->select($this->identity_column . ', '.$this->tables['users'].'.users_username, '.$this->tables['users'].'.users_email, '.$this->tables['users'].'.users_mobile, '.$this->tables['users'].'.users_lastLogin, '.$this->tables['users'].'.users_id, '.$this->tables['users'].'.users_active, '.$this->tables['users'].'.users_otpActive, '.$this->tables['users'].'.users_otpTime, '.$this->tables['users'].'.users_logintype as logintype, '.$this->tables['patient'].'.patientDetails_patientName as patientName, '.$this->tables['patient'].'.patientDetails_pLastName as pLastName, '.$this->tables['patient'].'.patientDetails_gender as gender, '.$this->tables['patient'].'.patientDetails_dob as dob, '.$this->tables['patient'].'.patientDetails_address as address, CONCAT("assets/proImg","/",'.$this->tables['patient'].'.patientDetails_patientImg) as patientImg, '.$this->tables['groups'].'.'.$this->join['roles_id'].','.$this->tables['userSocial'].'.userSocial_pushToken as pushToken,'.$this->tables['userSocial'].'.userSocial_device as device,'.$this->tables['userSocial'].'.userSocial_gpId as gpId,'.$this->tables['userSocial'].'.userSocial_fbId as fbId, '.$this->tables['userSocial'].'.userSocial_notification as notification')
                ->where($this->identity_column, $identity)
                ->or_where($this->identity_mobile,$identity)
                ->join($this->tables['patient'],$this->tables['patient'].'.'.$this->join['patient'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->join($this->tables['userSocial'],$this->tables['userSocial'].'.'.$this->join['userSocial'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->join($this->tables['users_groups'],$this->tables['users_groups'].'.'.$this->join['users'].'='.$this->tables['users'].'.'.$this->join['users_id'])
                ->join($this->tables['groups'],$this->tables['groups'].'.'.$this->join['roles_id'].'='.$this->tables['users_groups'].'.'.$this->join['groups'])
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);

        // check password 
        
        
        if ($query->num_rows() === 1) {
            $user = $query->row();

            $password = $this->hash_password_db($user->users_id, $password);

            if ($password === TRUE) {


                $this->set_session($user);

                $this->update_last_login($user->users_id);

                $this->clear_login_attempts($identity);

                if ($remember && $this->config->item('remember_users', 'auth_conf_api')) {
                    $this->remember_user($user->users_id);
                }

                $this->trigger_events(array('post_login', 'post_login_successful'));
                //$this->set_message('login_successful');

                return $user;
            }
            
            return FALSE;
        }
        
        return FALSE;
        
    }

    /**
     * is_max_login_attempts_exceeded
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param string $identity
     * @return boolean
     * */
    public function is_max_login_attempts_exceeded($identity) {
        if ($this->config->item('track_login_attempts', 'auth_conf_api')) {
            $max_attempts = $this->config->item('maximum_login_attempts', 'auth_conf_api');
            if ($max_attempts > 0) {
                $attempts = $this->get_attempts_num($identity);
                return $attempts >= $max_attempts;
            }
        }
        return FALSE;
    }

    /**
     * Get number of attempts to login occured from given IP-address or identity
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param	string $identity
     * @return	int
     */
    function get_attempts_num($identity) {
        if ($this->config->item('track_login_attempts', 'auth_conf_api')) {
            $ip_address = $this->_prepare_ip($this->input->ip_address());
            $this->db->select('1', FALSE);
            if ($this->config->item('track_login_ip_address', 'auth_conf_api'))
                $this->db->where('ip_address', $ip_address);
            else if (strlen($identity) > 0)
                $this->db->or_where('login', $identity);
            $qres = $this->db->get($this->tables['login_attempts']);
            return $qres->num_rows();
        }
        return 0;
    }

    /**
     * Get a boolean to determine if an account should be locked out due to
     * exceeded login attempts within a given period
     *
     * @return	boolean
     */
    public function is_time_locked_out($identity) {

        return $this->is_max_login_attempts_exceeded($identity) && $this->get_last_attempt_time($identity) > time() - $this->config->item('lockout_time', 'auth_conf_api');
    }

    /**
     * Get the time of the last time a login attempt occured from given IP-address or identity
     *
     * @param	string $identity
     * @return	int
     */
    public function get_last_attempt_time($identity) {
        if ($this->config->item('track_login_attempts', 'auth_conf_api')) {
            $ip_address = $this->_prepare_ip($this->input->ip_address());

            $this->db->select_max('time');
            if ($this->config->item('track_login_ip_address', 'auth_conf_api'))
                $this->db->where('ip_address', $ip_address);
            else if (strlen($identity) > 0)
                $this->db->or_where('login', $identity);
            $qres = $this->db->get($this->tables['login_attempts'], 1);

            if ($qres->num_rows() > 0) {
                return $qres->row()->time;
            }
        }

        return 0;
    }

    /**
     * increase_login_attempts
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param string $identity
     * */
    public function increase_login_attempts($identity) {
        if ($this->config->item('track_login_attempts', 'auth_conf_api')) {
            $ip_address = $this->_prepare_ip($this->input->ip_address());
            return $this->db->insert($this->tables['login_attempts'], array('ip_address' => $ip_address, 'login' => $identity, 'time' => time()));
        }
        return FALSE;
    }

    /**
     * clear_login_attempts
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param string $identity
     * */
    public function clear_login_attempts($identity, $expire_period = 86400) {
        if ($this->config->item('track_login_attempts', 'auth_conf_api')) {
            $ip_address = $this->_prepare_ip($this->input->ip_address());

            $this->db->where(array('ip_address' => $ip_address, 'login' => $identity));
            // Purge obsolete login attempts
            $this->db->or_where('time <', time() - $expire_period, FALSE);

            return $this->db->delete($this->tables['login_attempts']);
        }
        return FALSE;
    }

    public function limit($limit) {
        $this->trigger_events('limit');
        $this->_ion_limit = $limit;

        return $this;
    }

    public function offset($offset) {
        $this->trigger_events('offset');
        $this->_ion_offset = $offset;

        return $this;
    }

    public function where($where, $value = NULL) {
        $this->trigger_events('where');

        if (!is_array($where)) {
            $where = array($where => $value);
        }

        array_push($this->_ion_where, $where);

        return $this;
    }
    
    public function or_where($or_where, $value = NULL) {
        $this->trigger_events('or_where');

        if (!is_array($or_where)) {
            $or_where = array($or_where => $value);
        }

        array_push($this->_ion_or_where, $or_where);

        return $this;
    }

    public function like($like, $value = NULL, $position = 'both') {
        $this->trigger_events('like');

        if (!is_array($like)) {
            $like = array($like => array(
                    'value' => $value,
                    'position' => $position,
            ));
        }

        array_push($this->_ion_like, $like);

        return $this;
    }

    public function select($select) {
        $this->trigger_events('select');

        $this->_ion_select[] = $select;

        return $this;
    }

    public function order_by($by, $order = 'desc') {
        $this->trigger_events('order_by');

        $this->_ion_order_by = $by;
        $this->_ion_order = $order;

        return $this;
    }

    public function row() {
        $this->trigger_events('row');

        $row = $this->response->row();

        return $row;
    }

    public function row_array() {
        $this->trigger_events(array('row', 'row_array'));

        $row = $this->response->row_array();

        return $row;
    }

    public function result() {
        $this->trigger_events('result');

        $result = $this->response->result();

        return $result;
    }

    public function result_array() {
        $this->trigger_events(array('result', 'result_array'));

        $result = $this->response->result_array();

        return $result;
    }

    public function num_rows() {
        $this->trigger_events(array('num_rows'));

        $result = $this->response->num_rows();

        return $result;
    }

    /**
     * users
     *
     * @return object Users
     * @author Ben Edmunds
     * */
    public function users($groups = NULL) {
        $this->trigger_events('users');

        if (isset($this->_ion_select) && !empty($this->_ion_select)) {
            foreach ($this->_ion_select as $select) {
                $this->db->select($select);
            }

            $this->_ion_select = array();
        } else {
            //default selects
            $this->db->select(array(
                $this->tables['users'] . '.*',
                $this->tables['users'] . '.users_id as id',
                $this->tables['users'] . '.users_id as users_id',
                $this->tables['users'] . '.users_mobile as users_mobile',
                $this->tables['users'] . '.users_logintype as logintype',
                $this->tables['users'] . '.users_otpActive as users_otpActive',
                $this->tables['users'] . '.users_otpTime as users_otpTime',
                $this->tables['patient'] . '.patientDetails_patientName as patientName',
                $this->tables['patient'] . '.patientDetails_pLastName as pLastName',
                $this->tables['patient'] . '.patientDetails_unqId as pUnqId',
                $this->tables['patient'] . '.patientDetails_address as address',
                $this->tables['patient'] . '.patientDetails_dob as dob',
                $this->tables['patient'] . '.patientDetails_gender as gender',
                //$this->tables['patient'] . '.patientDetails_patientImg as patientImg',
                'CONCAT("assets/proImg","/",'.$this->tables['patient'].'.patientDetails_patientImg) as patientImg',
                $this->tables['userSocial'].'.userSocial_pushToken as pushToken',
                $this->tables['userSocial'].'.userSocial_usersId as scUsersId',
                $this->tables['userSocial'].'.userSocial_device as device',
                $this->tables['userSocial'].'.userSocial_gpId as gpId',
                $this->tables['userSocial'].'.userSocial_fbId as fbId',
                $this->tables['userSocial'].'.userSocial_notification as notification'
            ));
        }

        //filter by group id(s) if passed
        if (isset($groups)) {
            //build an array if only one group was passed
            if (!is_array($groups)) {
                $groups = Array($groups);
            }

            //join and then run a where_in against the group ids
            if (isset($groups) && !empty($groups)) {
                $this->db->distinct();
                $this->db->join(
                        $this->tables['users_groups'], $this->tables['users_groups'] . '.' . $this->join['users'] . '=' . $this->tables['users'] . '.users_id', 'inner'
                );
            }

            // verify if group name or group id was used and create and put elements in different arrays
            $group_ids = array();
            $group_names = array();
            foreach ($groups as $group) {
                if (is_numeric($group))
                    $group_ids[] = $group;
                else
                    $group_names[] = $group;
            }
            $or_where_in = (!empty($group_ids) && !empty($group_names)) ? 'or_where_in' : 'where_in';
            //if group name was used we do one more join with groups
            if (!empty($group_names)) {
                $this->db->join($this->tables['groups'], $this->tables['users_groups'] . '.' . $this->join['groups'] . ' = ' . $this->tables['groups'] . '.roles_id', 'inner');
                $this->db->where_in($this->tables['groups'] . '.roles_name', $group_names);
            }
            if (!empty($group_ids)) {
                $this->db->{$or_where_in}($this->tables['users_groups'] . '.' . $this->join['groups'], $group_ids);
            }
        }

        $this->trigger_events('extra_where');
        
        //for social detail and notification
        $this->db->join($this->tables['patient'],$this->tables['patient'].'.'.$this->join['patient'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT');
        
        $this->db->join($this->tables['userSocial'],$this->tables['userSocial'].'.'.$this->join['userSocial'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT');

        //run each where that was passed
        if (isset($this->_ion_where) && !empty($this->_ion_where)) {
            foreach ($this->_ion_where as $where) {
                $this->db->where($where);
            }

            $this->_ion_where = array();
        }
        
        if (isset($this->_ion_or_where) && !empty($this->_ion_or_where)) {
            foreach ($this->_ion_or_where as $or_where) {
                $this->db->or_where($or_where);
            }

            $this->_ion_or_where = array();
        }

        if (isset($this->_ion_like) && !empty($this->_ion_like)) {
            foreach ($this->_ion_like as $like) {
                $this->db->or_like($like);
            }

            $this->_ion_like = array();
        }

        if (isset($this->_ion_limit) && isset($this->_ion_offset)) {
            $this->db->limit($this->_ion_limit, $this->_ion_offset);

            $this->_ion_limit = NULL;
            $this->_ion_offset = NULL;
        } else if (isset($this->_ion_limit)) {
            $this->db->limit($this->_ion_limit);

            $this->_ion_limit = NULL;
        }

        //set the order
        if (isset($this->_ion_order_by) && isset($this->_ion_order)) {
            $this->db->order_by($this->_ion_order_by, $this->_ion_order);

            $this->_ion_order = NULL;
            $this->_ion_order_by = NULL;
        }

        $this->response = $this->db->get($this->tables['users']);

        return $this;
    }
    
    public function patientUpdate($id=null,array $data = array())
    {
        // Filter the data passed
        $data = $this->_filter_data($this->tables['patient'], $data);

        $this->trigger_events('extra_where');
        if($id != null)
        $this->db->update($this->tables['patient'], $data, array('patientDetails_usersId' => $id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
            $this->set_error('update_patient_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_update_user', 'post_update_user_successful'));
        $this->set_message('update_patient_successful');
        return TRUE;
    }

    /**
     * user
     *
     * @return object
     * @author Ben Edmunds
     * */
    public function user($id = NULL) {
        $this->trigger_events('user');

        //if no id was passed use the current users id
        $id || $id = $this->session->userdata('users_id');

        $this->limit(1);
        $this->order_by('users_id', 'desc');
        $this->where($this->tables['users'] . '.users_id', $id);

        $this->users();

        return $this;
    }

    /**
     * get_users_groups
     *
     * @return array
     * @author Ben Edmunds
     * */
    public function get_users_groups($id = FALSE) {
        $this->trigger_events('get_users_group');

        //if no id was passed use the current users id
        $id || $id = $this->session->userdata('users_id');

        return $this->db->select($this->tables['users_groups'] . '.' . $this->join['groups'] . ' as id, ' . $this->tables['groups'] . '.roles_name, ' . $this->tables['groups'] . '.roles_description')
                        ->where($this->tables['users_groups'] . '.' . $this->join['users'], $id)
                        ->join($this->tables['groups'], $this->tables['users_groups'] . '.' . $this->join['groups'] . '=' . $this->tables['groups'] . '.roles_id')
                        ->get($this->tables['users_groups']);
    }

    /**
     * add_to_group
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function add_to_group($group_ids, $users_id = false) {
        $this->trigger_events('add_to_group');

        //if no id was passed use the current users id
        $users_id || $users_id = $this->session->userdata('users_id');

        if (!is_array($group_ids)) {
            $group_ids = array($group_ids);
        }

        $return = 0;

        // Then insert each into the database
        foreach ($group_ids as $group_id) {
            if ($this->db->insert($this->tables['users_groups'], array($this->join['groups'] => (int) $group_id, $this->join['users'] => (int) $users_id))) {
                //dump($this->db->last_query());
                if (isset($this->_cache_groups[$group_id])) {
                    $group_name = $this->_cache_groups[$group_id];
                } else {
                    $group = $this->group($group_id)->result();
                    $group_name = $group[0]->roles_name;
                    $this->_cache_groups[$group_id] = $group_name;
                }
                $this->_cache_user_in_group[$users_id][$group_id] = $group_name;

                // Return the number of groups added
                $return += 1;
            }
        }

        return $return;
    }

    /**
     * remove_from_group
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function remove_from_group($group_ids = false, $users_id = false) {
        $this->trigger_events('remove_from_group');

        // user id is required
        if (empty($users_id)) {
            return FALSE;
        }

        // if group id(s) are passed remove user from the group(s)
        if (!empty($group_ids)) {
            if (!is_array($group_ids)) {
                $group_ids = array($group_ids);
            }

            foreach ($group_ids as $group_id) {
                $this->db->delete($this->tables['users_groups'], array($this->join['groups'] => (int) $group_id, $this->join['users'] => (int) $users_id));
                if (isset($this->_cache_user_in_group[$users_id]) && isset($this->_cache_user_in_group[$users_id][$group_id])) {
                    unset($this->_cache_user_in_group[$users_id][$group_id]);
                }
            }

            $return = TRUE;
        }
        // otherwise remove user from all groups
        else {
            if ($return = $this->db->delete($this->tables['users_groups'], array($this->join['users'] => (int) $users_id))) {
                $this->_cache_user_in_group[$users_id] = array();
            }
        }
        return $return;
    }

    /**
     * groups
     *
     * @return object
     * @author Ben Edmunds
     * */
    public function groups() {
        $this->trigger_events('groups');

        //run each where that was passed
        if (isset($this->_ion_where) && !empty($this->_ion_where)) {
            foreach ($this->_ion_where as $where) {
                $this->db->where($where);
            }
            $this->_ion_where = array();
        }
        
        if (isset($this->_ion_or_where) && !empty($this->_ion_or_where)) {
            foreach ($this->_ion_or_where as $or_where) {
                $this->db->or_where($or_where);
            }

            $this->_ion_or_where = array();
        }

        if (isset($this->_ion_limit) && isset($this->_ion_offset)) {
            $this->db->limit($this->_ion_limit, $this->_ion_offset);

            $this->_ion_limit = NULL;
            $this->_ion_offset = NULL;
        } else if (isset($this->_ion_limit)) {
            $this->db->limit($this->_ion_limit);

            $this->_ion_limit = NULL;
        }

        //set the order
        if (isset($this->_ion_order_by) && isset($this->_ion_order)) {
            $this->db->order_by($this->_ion_order_by, $this->_ion_order);
        }

        $this->response = $this->db->get($this->tables['groups']);

        return $this;
    }

    /**
     * group
     *
     * @return object
     * @author Ben Edmunds
     * */
    public function group($id = NULL) {
        $this->trigger_events('group');

        if (isset($id)) {
            $this->where($this->tables['groups'] . '.roles_id', $id);
        }

        $this->limit(1);
        $this->order_by('roles_id', 'desc');

        return $this->groups();
    }

    /**
     * update
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function update($id, array $data) {
        $this->trigger_events('pre_update_user');

        $user = $this->user($id)->row();

        $this->db->trans_begin();

        if (array_key_exists($this->identity_column, $data) && $this->identity_check($data[$this->identity_column]) && $user->{$this->identity_column} !== $data[$this->identity_column]) {
            $this->db->trans_rollback();
            $this->set_error('account_creation_duplicate_' . $this->identity_column);

            $this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
            $this->set_error('update_unsuccessful');

            return FALSE;
        }

        // Filter the data passed
        $data = $this->_filter_data($this->tables['users'], $data);

        if (array_key_exists('users_username', $data)|| array_key_exists('users_mobile', $data) || array_key_exists('users_password', $data) || array_key_exists('users_email', $data)) {
            if (array_key_exists('users_password', $data)) {
                if (!empty($data['users_password'])) {
                    $data['users_password'] = $this->hash_password($data['users_password'], $user->users_salt);
                } else {
                    // unset password so it doesn't effect database entry if no password passed
                    unset($data['users_password']);
                }
            }
        }

        $this->trigger_events('extra_where');
        $this->db->update($this->tables['users'], $data, array('users_id' => $user->users_id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
            $this->set_error('update_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_update_user', 'post_update_user_successful'));
        $this->set_message('update_successful');
        return TRUE;
    }

    /**
     * delete_user
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function delete_user($id) {
        $this->trigger_events('pre_delete_user');

        $this->db->trans_begin();

        // remove user from groups
        $this->remove_from_group(NULL, $id);

        // delete user from users table should be placed after remove from group
        $this->db->delete($this->tables['users'], array('id' => $id));

        // if user does not exist in database then it returns FALSE else removes the user from groups
        if ($this->db->affected_rows() == 0) {
            return FALSE;
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->trigger_events(array('post_delete_user', 'post_delete_user_unsuccessful'));
            $this->set_error('delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_delete_user', 'post_delete_user_successful'));
        $this->set_message('delete_successful');
        return TRUE;
    }

    /**
     * update_last_login
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function update_last_login($id) {
        $this->trigger_events('update_last_login');

        $this->load->helper('date');

        $this->trigger_events('extra_where');

        $this->db->update($this->tables['users'], array('users_lastLogin' => time()), array('users_id' => $id));

        return $this->db->affected_rows() == 1;
    }

    /**
     * set_lang
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function set_lang($lang = 'en') {
        $this->trigger_events('set_lang');

        // if the user_expire is set to zero we'll set the expiration two years from now.
        if ($this->config->item('user_expire', 'auth_conf_api') === 0) {
            $expire = (60 * 60 * 24 * 365 * 2);
        }
        // otherwise use what is set
        else {
            $expire = $this->config->item('user_expire', 'auth_conf_api');
        }

        set_cookie(array(
            'name' => 'lang_code',
            'value' => $lang,
            'expire' => $expire
        ));

        return TRUE;
    }

    /**
     * set_session
     *
     * @return bool
     * @author jrmadsen67
     * */
    public function set_session($user) {

        $this->trigger_events('pre_set_session');

        $session_data = array(
            'identity' => $user->{$this->identity_column},
            'username' => $user->users_username,
            'email' => $user->users_email,
            'mobile' => $user->users_mobile,
            'users_id' => $user->users_id, //everyone likes to overwrite id so we'll use users_id
            'old_last_login' => $user->users_lastLogin
        );

        $this->session->set_userdata($session_data);

        $this->trigger_events('post_set_session');

        return TRUE;
    }

    /**
     * remember_user
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function remember_user($id) {
        $this->trigger_events('pre_remember_user');

        if (!$id) {
            return FALSE;
        }

        $user = $this->user($id)->row();

        $salt = $this->salt();

        $this->db->update($this->tables['users'], array('remember_code' => $salt), array('id' => $id));

        if ($this->db->affected_rows() > -1) {
            // if the user_expire is set to zero we'll set the expiration two years from now.
            if ($this->config->item('user_expire', 'auth_conf_api') === 0) {
                $expire = (60 * 60 * 24 * 365 * 2);
            }
            // otherwise use what is set
            else {
                $expire = $this->config->item('user_expire', 'auth_conf_api');
            }

            set_cookie(array(
                'name' => $this->config->item('identity_cookie_name', 'auth_conf_api'),
                'value' => $user->{$this->identity_column},
                'expire' => $expire
            ));

            set_cookie(array(
                'name' => $this->config->item('remember_cookie_name', 'auth_conf_api'),
                'value' => $salt,
                'expire' => $expire
            ));

            $this->trigger_events(array('post_remember_user', 'remember_user_successful'));
            return TRUE;
        }

        $this->trigger_events(array('post_remember_user', 'remember_user_unsuccessful'));
        return FALSE;
    }

    /**
     * login_remembed_user
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function login_remembered_user() {
        $this->trigger_events('pre_login_remembered_user');

        //check for valid data
        if (!get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api')) || !get_cookie($this->config->item('remember_cookie_name', 'auth_conf_api')) || !$this->identity_check(get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api')))) {
            $this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_unsuccessful'));
            return FALSE;
        }

        //get the user
        $this->trigger_events('extra_where');
        $query = $this->db->select($this->identity_column . ', users_id, users_username, users_email, users_mobile, users_lastLogin')
                ->where($this->identity_column, get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api')))
                ->or_where($this->identity_mobile, get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api')))
                ->where('remember_code', get_cookie($this->config->item('remember_cookie_name', 'auth_conf_api')))
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);

        //if the user was found, sign them in
        if ($query->num_rows() == 1) {
            $user = $query->row();

            $this->update_last_login($user->id);

            $this->set_session($user);

            //extend the users cookies if the option is enabled
            if ($this->config->item('user_extend_on_login', 'auth_conf_api')) {
                $this->remember_user($user->id);
            }

            $this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_successful'));
            return TRUE;
        }

        $this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_unsuccessful'));
        return FALSE;
    }

    /**
     * create_group
     *
     * @author aditya menon
     */
    public function create_group($group_name = FALSE, $group_description = '', $additional_data = array()) {
        // bail if the group name was not passed
        if (!$group_name) {
            $this->set_error('group_name_required');
            return FALSE;
        }

        // bail if the group name already exists
        $existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->num_rows();
        if ($existing_group !== 0) {
            $this->set_error('group_already_exists');
            return FALSE;
        }

        $data = array('name' => $group_name, 'description' => $group_description);

        //filter out any data passed that doesnt have a matching column in the groups table
        //and merge the set group data and the additional data
        if (!empty($additional_data))
            $data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);

        $this->trigger_events('extra_group_set');

        // insert the new group
        $this->db->insert($this->tables['groups'], $data);
        $group_id = $this->db->insert_id();

        // report success
        $this->set_message('group_creation_successful');
        // return the brand new group id
        return $group_id;
    }

    /**
     * update_group
     *
     * @return bool
     * @author aditya menon
     * */
    public function update_group($group_id = FALSE, $group_name = FALSE, $additional_data = array()) {
        if (empty($group_id))
            return FALSE;

        $data = array();

        if (!empty($group_name)) {
            // we are changing the name, so do some checks
            // bail if the group name already exists
            $existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->row();
            if (isset($existing_group->id) && $existing_group->id != $group_id) {
                $this->set_error('group_already_exists');
                return FALSE;
            }

            $data['name'] = $group_name;
        }

        // restrict change of name of the admin group
        $group = $this->db->get_where($this->tables['groups'], array('id' => $group_id))->row();
        if ($this->config->item('admin_group', 'auth_conf_api') === $group->name && $group_name !== $group->name) {
            $this->set_error('group_name_admin_not_alter');
            return FALSE;
        }


        // IMPORTANT!! Third parameter was string type $description; this following code is to maintain backward compatibility
        // New projects should work with 3rd param as array
        if (is_string($additional_data))
            $additional_data = array('description' => $additional_data);


        //filter out any data passed that doesnt have a matching column in the groups table
        //and merge the set group data and the additional data
        if (!empty($additional_data))
            $data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);


        $this->db->update($this->tables['groups'], $data, array('id' => $group_id));

        $this->set_message('group_update_successful');

        return TRUE;
    }

    /**
     * delete_group
     *
     * @return bool
     * @author aditya menon
     * */
    public function delete_group($group_id = FALSE) {
        // bail if mandatory param not set
        if (!$group_id || empty($group_id)) {
            return FALSE;
        }
        $group = $this->group($group_id)->row();
        if ($group->name == $this->config->item('admin_group', 'auth_conf_api')) {
            $this->trigger_events(array('post_delete_group', 'post_delete_group_notallowed'));
            $this->set_error('group_delete_notallowed');
            return FALSE;
        }

        $this->trigger_events('pre_delete_group');

        $this->db->trans_begin();

        // remove all users from this group
        $this->db->delete($this->tables['users_groups'], array($this->join['groups'] => $group_id));
        // remove the group itself
        $this->db->delete($this->tables['groups'], array('id' => $group_id));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->trigger_events(array('post_delete_group', 'post_delete_group_unsuccessful'));
            $this->set_error('group_delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_delete_group', 'post_delete_group_successful'));
        $this->set_message('group_delete_successful');
        return TRUE;
    }

    public function set_hook($event, $name, $class, $method, $arguments) {
        $this->_ion_hooks->{$event}[$name] = new stdClass;
        $this->_ion_hooks->{$event}[$name]->class = $class;
        $this->_ion_hooks->{$event}[$name]->method = $method;
        $this->_ion_hooks->{$event}[$name]->arguments = $arguments;
    }

    public function remove_hook($event, $name) {
        if (isset($this->_ion_hooks->{$event}[$name])) {
            unset($this->_ion_hooks->{$event}[$name]);
        }
    }

    public function remove_hooks($event) {
        if (isset($this->_ion_hooks->$event)) {
            unset($this->_ion_hooks->$event);
        }
    }

    protected function _call_hook($event, $name) {
        if (isset($this->_ion_hooks->{$event}[$name]) && method_exists($this->_ion_hooks->{$event}[$name]->class, $this->_ion_hooks->{$event}[$name]->method)) {
            $hook = $this->_ion_hooks->{$event}[$name];

            return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
        }

        return FALSE;
    }

    public function trigger_events($events) {
        if (is_array($events) && !empty($events)) {
            foreach ($events as $event) {
                $this->trigger_events($event);
            }
        } else {
            if (isset($this->_ion_hooks->$events) && !empty($this->_ion_hooks->$events)) {
                foreach ($this->_ion_hooks->$events as $name => $hook) {
                    $this->_call_hook($events, $name);
                }
            }
        }
    }

    /**
     * set_message_delimiters
     *
     * Set the message delimiters
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_message_delimiters($start_delimiter, $end_delimiter) {
        $this->message_start_delimiter = $start_delimiter;
        $this->message_end_delimiter = $end_delimiter;

        return TRUE;
    }

    /**
     * set_error_delimiters
     *
     * Set the error delimiters
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_error_delimiters($start_delimiter, $end_delimiter) {
        $this->error_start_delimiter = $start_delimiter;
        $this->error_end_delimiter = $end_delimiter;

        return TRUE;
    }

    /**
     * set_message
     *
     * Set a message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_message($message) {
        $this->messages[] = $message;

        return $message;
    }

    /**
     * messages
     *
     * Get the messages
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function messages() {
        $_output = '';
        foreach ($this->messages as $message) {
            $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '.' . $message . '.';
            $_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
        }

        return $_output;
    }

    /**
     * messages as array
     *
     * Get the messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     * */
    public function messages_array($langify = TRUE) {
        if ($langify) {
            $_output = array();
            foreach ($this->messages as $message) {
                $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '.' . $message . '.';
                $_output[] = $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
            }
            return $_output;
        } else {
            return $this->messages;
        }
    }

    /**
     * set_error
     *
     * Set an error message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_error($error) {
         
        
        $this->errors[] = $error;

        return $error;
    }

    /**
     * errors
     *
     * Get the error message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function errors() {
        $_output = '';
        foreach ($this->errors as $error) {
            $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '.' . $error . '.';
            
            $_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
        }

        return $_output;
    }

    /**
     * errors as array
     *
     * Get the error messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     * */
    public function errors_array($langify = TRUE) {
        if ($langify) {
            $_output = array();
            foreach ($this->errors as $error) {
                $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '.' . $error . '.';
                $_output[] = $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
            }
            return $_output;
        } else {
            return $this->errors;
        }
    }

//    protected function _filter_data($table, $data) {
//        $filtered_data = array();
//        $columns = $this->db->list_fields($table);
//
//        if (is_array($data)) {
//            foreach ($columns as $column) {
//                if (array_key_exists($column, $data))
//                    $filtered_data[$column] = $data[$column];
//            }
//        }
//
//        return $filtered_data;
//    }

    protected function _prepare_ip($ip_address) {
        //just return the string IP address now for better compatibility
        return $ip_address;
    }

    public function getUserDetail($where,$or_where=null)
    {
        $query = $this->db->select($this->identity_column . ', '.$this->tables['users'].'.users_username, '.$this->tables['users'].'.users_email, '.$this->tables['users'].'.users_mobile, '.$this->tables['users'].'.users_lastLogin, '.$this->tables['users'].'.users_id, '.$this->tables['users'].'.users_active, '.$this->tables['users'].'.users_otpActive, '.$this->tables['users'].'.users_otpTime, '.$this->tables['users'].'.users_logintype as logintype, '.$this->tables['patient'].'.patientDetails_patientName as patientName, '.$this->tables['patient'].'.patientDetails_gender as gender, '.$this->tables['patient'].'.patientDetails_dob as dob, '.$this->tables['patient'].'.patientDetails_pLastName as pLastName, '.$this->tables['patient'].'.patientDetails_address as address, CONCAT("assets/proImg","/",'.$this->tables['patient'].'.patientDetails_patientImg) as patientImg, '.$this->tables['groups'].'.'.$this->join['roles_id'].','.$this->tables['userSocial'].'.userSocial_pushToken as pushToken,'.$this->tables['userSocial'].'.userSocial_device as device,'.$this->tables['userSocial'].'.userSocial_gpId as gpId,'.$this->tables['userSocial'].'.userSocial_fbId as fbId,'.$this->tables['userSocial'].'.userSocial_notification as notification')
                ->where($where)
                
                ->join($this->tables['patient'],$this->tables['patient'].'.'.$this->join['patient'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->join($this->tables['userSocial'],$this->tables['userSocial'].'.'.$this->join['userSocial'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->join($this->tables['users_groups'],$this->tables['users_groups'].'.'.$this->join['users'].'='.$this->tables['users'].'.'.$this->join['users_id'])
                ->join($this->tables['groups'],$this->tables['groups'].'.'.$this->join['roles_id'].'='.$this->tables['users_groups'].'.'.$this->join['groups'])
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);

        // check password 
        
        
        if ($query->num_rows() === 1) {
        return $user = $query->row();
        }
        else
            return false;
    }
    
    public function getSocialData($where){
        $query = $this->db->select($this->identity_column . ', '.$this->tables['users'].'.users_username, '.$this->tables['users'].'.users_email, '.$this->tables['users'].'.users_mobile, '.$this->tables['users'].'.users_id, '.$this->tables['users'].'.users_active, '.$this->tables['users'].'.users_otpActive, '.$this->tables['users'].'.users_otpTime, '.$this->tables['users'].'.users_logintype as logintype, '.$this->tables['userSocial'].'.userSocial_gpId as gpId,'.$this->tables['userSocial'].'.userSocial_notification as notification, '.$this->tables['userSocial'].'.userSocial_fbId as fbId,'.$this->tables['patient'].'.patientDetails_patientName as patientName, '.$this->tables['patient'].'.patientDetails_gender as gender, '.$this->tables['patient'].'.patientDetails_dob as dob, '.$this->tables['patient'].'.patientDetails_pLastName as pLastName, '.$this->tables['patient'].'.patientDetails_address as address, CONCAT("assets/proImg","/",'.$this->tables['patient'].'.patientDetails_patientImg) as patientImg')
                ->join($this->tables['patient'],$this->tables['patient'].'.'.$this->join['patient'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->join($this->tables['userSocial'],$this->tables['userSocial'].'.'.$this->join['userSocial'].'='.$this->tables['users'].'.'.$this->join['users_id'],'LEFT')
                ->where($where)
                ->limit(1)
                ->order_by('users_id', 'desc')
                ->get($this->tables['users']);
        if ($query->num_rows() === 1) {
        return $user = $query->row();
        }
        else
            return false;
    }
    
    
}
