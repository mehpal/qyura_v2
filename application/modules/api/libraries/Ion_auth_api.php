<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name:  Ion Auth
 *
 * Version: 2.5.2
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */
class Ion_auth_api {

    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     * */
    protected $status;

    /**
     * extra where
     *
     * @var array
     * */
    public $_extra_where = array();

    /**
     * extra set
     *
     * @var array
     * */
    public $_extra_set = array();

    /**
     * caching of users and their groups
     *
     * @var array
     * */
    public $_cache_user_in_group;

    /**
     * __construct
     *
     * @return void
     * @author Ben
     * */
    public function __construct() {
        $this->load->config('auth_conf_api', TRUE);
        $this->load->library(array('email'));
        $this->lang->load('ion_auth_api');
        $this->load->helper(array('cookie', 'language', 'url', 'string'));

        $this->load->library('session');

        $this->load->model('auth_model');

        $this->_cache_user_in_group = & $this->auth_model->_cache_user_in_group;

        //auto-login the user if they are remembered
        if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api')) && get_cookie($this->config->item('remember_cookie_name', 'auth_conf_api'))) {
            $this->auth_model->login_remembered_user();
        }

        $email_config = $this->config->item('email_config', 'auth_conf_api');

        if ($this->config->item('use_ci_email', 'auth_conf_api') && isset($email_config) && is_array($email_config)) {
            $this->email->initialize($email_config);
        }

        $this->auth_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }
        if ($method == 'create_user') {
            return call_user_func_array(array($this, 'register'), $arguments);
        }
        if ($method == 'update_user') {
            return call_user_func_array(array($this, 'update'), $arguments);
        }
        return call_user_func_array(array($this->auth_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }

    /**
     * forgotten password feature
     *
     * @return mixed  boolian / array
     * @author Mathew
     * */
    public function forgotten_password($identity) {    //changed $email to $identity
        if ($this->auth_model->forgotten_password($identity)) {   //changed
            // Get user information
            $identifier = $this->auth_model->identity_column; // use model identity column, so it can be overridden in a controller
            //$user = $this->where($identifier, $identity)->where('users_active', 1)->where('users_otpActive', 1)->users()->row();  //changed to get_user_by_identity from email
            
            $user = $this->where($identifier, $identity)->or_where('users_mobile', $identity)->where('users_otpActive', 1)->users()->row();

            if ($user) {
                $password = random_string('nozero', 5);
                $data = array(
                    'identity' => $user->{$this->config->item('identity', 'auth_conf_api')},
                    'forgotten_password_code' => $user->users_forgottenPasswordCode,
                    'password' => $password
                );
                    
                $this->load->library('clickatell');
        
                $message = $this->lang->line('mobile_forgot_password');
                $message = str_replace('%s', $password, $message);
                $msgId  = $this->clickatell->send_message($user->users_mobile,$message);    

                if (!$this->config->item('use_ci_email', 'auth_conf_api')) {
                    $this->set_message('forgot_password_successful');
                    return $data;
                } else {
                    $message = $this->load->view($this->config->item('email_templates', 'auth_conf_api') . $this->config->item('email_forgot_password_api', 'auth_conf_api'), $data, true);
                    $this->email->clear();
                    $this->email->from($this->config->item('admin_email', 'auth_conf_api'), $this->config->item('site_title', 'auth_conf_api'));
                    $this->email->to($user->users_email);
                    $this->email->subject($this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_forgotten_password_subject'));
                    $this->email->message($message);
                    $identity = $user->{$this->config->item('identity', 'auth_conf_api')};


                    $change = $this->auth_model->reset_password($identity, $password);
                    $to = $user->users_email;
                    $subject = $this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_forgotten_password_subject');
                    $message = $message;
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
                    $headers .= 'From: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                            'Reply-To: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                    $mailr = mail($to, $subject, $message, $headers);
                    
                    //send message

                    //if ($this->email->send())
                    if ($mailr) {
                        $this->set_message('forgot_password_successful');
                        return TRUE;
                    } else {
                        $this->set_error('forgot_password_unsuccessful');
                        return FALSE;
                    }
                }
            } else {
                //$this->set_error('forgot_password_unsuccessful');
                $this->set_error('forgot_password_otp_active_unsuccessful');
                return FALSE;
            }
        } else {
            $this->set_error('forgot_password_unsuccessful');
            return FALSE;
        }
    }

    /**
     * forgotten_password_complete
     *
     * @return void
     * @author Mathew
     * */
    public function forgotten_password_complete($code) {
        $this->auth_model->trigger_events('pre_password_change');

        $identity = $this->config->item('identity', 'auth_conf_api');
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!$profile) {
            $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $new_password = $this->auth_model->forgotten_password_complete($code, $profile->salt);

        if ($new_password) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $new_password
            );
            if (!$this->config->item('use_ci_email', 'auth_conf_api')) {
                $this->set_message('password_change_successful');
                $this->auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                return $data;
            } else {
                $message = $this->load->view($this->config->item('email_templates', 'auth_conf_api') . $this->config->item('email_forgot_password_complete', 'auth_conf_api'), $data, true);

                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'auth_conf_api'), $this->config->item('site_title', 'auth_conf_api'));
                $this->email->to($profile->email);
                $this->email->subject($this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_new_password_subject'));
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->set_message('password_change_successful');
                    $this->auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                    return TRUE;
                } else {
                    $this->set_error('password_change_unsuccessful');
                    $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
                    return FALSE;
                }
            }
        }

        $this->auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
        return FALSE;
    }

    /**
     * forgotten_password_check
     *
     * @return void
     * @author Michael
     * */
    public function forgotten_password_check($code) {
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        } else {
            if ($this->config->item('forgot_password_expiration', 'auth_conf_api') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->item('forgot_password_expiration', 'auth_conf_api');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->clear_forgotten_password_code($code);
                    $this->set_error('password_change_unsuccessful');
                    return FALSE;
                }
            }
            return $profile;
        }
    }

    /**
     * register
     *
     * @return void
     * @author Mathew
     * */
    public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) { //need to test email activation
        $this->auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'auth_conf_api');

        if (!$email_activation) {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $group_ids);
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $group_ids);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            $deactivate = $this->auth_model->deactivate($id);

            $otp = $this->auth_model->otpCreate($id);



            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }


            if (!$otp) {
                $this->set_error('otp_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->auth_model->activation_code;
            
            $otp_code = $this->auth_model->activationCode;
            
            $identity = $this->config->item('identity', 'auth_conf_api');
            $user = $this->auth_model->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activation_code,
                'activationCode' => $otp_code,
                'mobileNo' => $additional_data['users_mobile']
            );
                
            // send message
                
            
            
            
                
            if (!$this->config->item('use_ci_email', 'auth_conf_api')) {
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                
                $message = $this->load->view($this->config->item('email_templates', 'auth_conf_api') . $this->config->item('email_activate', 'auth_conf_api'), $data, true);

                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'auth_conf_api'), $this->config->item('site_title', 'auth_conf_api'));
                $this->email->to($email);
                $this->email->subject($this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_activation_subject'));
                $this->email->message($message);
                // dump($this->email);

                $to = $email;
                $subject = $this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_activation_subject');
                $message = $message;
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
                $headers .= 'From: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                        'Reply-To: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                $mailr = mail($to, $subject, $message, $headers);

//dump($mailr);
                // look is run from localhost

                if ($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '0.0.0.0' || $_SERVER['SERVER_ADDR'] == '10.10.10.10') {
                    return $data;
                }

                //dump($this->email->send());

                if ($mailr == TRUE) {
                    $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $data;
                }
            }

            $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
            $this->set_error('activation_email_unsuccessful');
            return FALSE;
        }
    }

    public function registerSocial($username, $password = null, $email, $additional_data = array(), $group_ids = array()) { //need to test email activation
        $this->auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'auth_conf_api');

        if ($password == null)
            $password = random_string('nozero', 5);

        if (!$email_activation) {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $group_ids);
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->auth_model->register($username, $password, $email, $additional_data, $group_ids);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            $deactivate = $this->auth_model->deactivate($id);
            //create otp
            $otp = $this->auth_model->otpCreate($id);

            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
            
            if (!$otp) {
                $this->set_error('otp_unsuccessful');
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            
            
            $otp_code = $this->auth_model->activationCode;

            $activation_code = $this->auth_model->activation_code;
            
            $identity = $this->config->item('identity', 'auth_conf_api');
            $user = $this->auth_model->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activation_code,
                'mobileNo' => $additional_data['users_mobile'],
                'activationCode' => $otp_code,
                'password' => $password
            );
                
            // send message
                
            $this->load->library('clickatell');
            $message = $this->lang->line('otp_message');
            $message = str_replace('%s', $otp_code, $message);
            
            
            //dump($message);
            $msgId  = $this->clickatell->send_message($additional_data['users_mobile'],$message);
            //dump($msgId);
            
                
            if (!$this->config->item('use_ci_email', 'auth_conf_api')) {
                $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                $message = $this->load->view($this->config->item('email_templates', 'auth_conf_api') . $this->config->item('email_activate', 'auth_conf_api'), $data, true);

                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'auth_conf_api'), $this->config->item('site_title', 'auth_conf_api'));
                $this->email->to($email);
                $this->email->subject($this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_activation_subject'));
                $this->email->message($message);
                // dump($this->email);

                $to = $email;
                $subject = $this->config->item('site_title', 'auth_conf_api') . ' - ' . $this->lang->line('email_activation_subject');
                $message = $message;
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
                $headers .= 'From: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                        'Reply-To: ' . $this->config->item('admin_email', 'auth_conf_api') . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                $mailr = mail($to, $subject, $message, $headers);

//dump($mailr);
                // look is run from localhost

                if ($_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['SERVER_ADDR'] == '0.0.0.0' || $_SERVER['SERVER_ADDR'] == '10.10.10.10') {
                    return $data;
                }

                //dump($this->email->send());

                if ($mailr == TRUE) {
                    $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $data;
                }
            }

            $this->auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
            $this->set_error('activation_email_unsuccessful');
            return FALSE;
        }
    }

    public function setPatientProf($profData) {
        $patientId = $this->auth_model->setPatientProf($profData);
        return $patientId;
    }

    /**
     * logout
     *
     * @return void
     * @author Mathew
     * */
    public function logout() {
        $this->auth_model->trigger_events('logout');

        $identity = $this->config->item('identity', 'auth_conf_api');
        $this->session->unset_userdata(array($identity => '', 'id' => '', 'users_id' => ''));

        //delete the remember me cookies if they exist
        if (get_cookie($this->config->item('identity_cookie_name', 'auth_conf_api'))) {
            delete_cookie($this->config->item('identity_cookie_name', 'ion_auth_api'));
        }
        if (get_cookie($this->config->item('remember_cookie_name', 'auth_conf_api'))) {
            delete_cookie($this->config->item('remember_cookie_name', 'auth_conf_api'));
        }

        //Destroy the session
        $this->session->sess_destroy();

        //Recreate the session
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->sess_create();
        } else {
            $this->session->sess_regenerate(TRUE);
        }

        $this->set_message('logout_successful');
        return TRUE;
    }

    /**
     * logged_in
     *
     * @return bool
     * @author Mathew
     * */
    public function logged_in() {
        $this->auth_model->trigger_events('logged_in');

        return (bool) $this->session->userdata('identity');
    }

    /**
     * logged_in
     *
     * @return integer
     * @author jrmadsen67
     * */
    public function get_users_id() {
        $users_id = $this->session->userdata('users_id');
        if (!empty($users_id)) {
            return $users_id;
        }
        return null;
    }

    /**
     * is_admin
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function is_admin($id = false) {
        $this->auth_model->trigger_events('is_admin');

        $admin_group = $this->config->item('admin_group', 'auth_conf_api');

        return $this->in_group($admin_group, $id);
    }

    /**
     * in_group
     *
     * @param mixed group(s) to check
     * @param bool user id
     * @param bool check if all groups is present, or any of the groups
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function in_group($check_group, $id = false, $check_all = false) {
        $this->auth_model->trigger_events('in_group');

        $id || $id = $this->session->userdata('users_id');

        if (!is_array($check_group)) {
            $check_group = array($check_group);
        }

        if (isset($this->_cache_user_in_group[$id])) {
            $groups_array = $this->_cache_user_in_group[$id];
        } else {
            $users_groups = $this->auth_model->get_users_groups($id)->result();
            $groups_array = array();
            foreach ($users_groups as $group) {
                $groups_array[$group->id] = $group->name;
            }
            $this->_cache_user_in_group[$id] = $groups_array;
        }
        foreach ($check_group as $key => $value) {
            $groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

            /**
             * if !all (default), in_array
             * if all, !in_array
             */
            if (in_array($value, $groups) xor $check_all) {
                /**
                 * if !all (default), true
                 * if all, false
                 */
                return !$check_all;
            }
        }

        /**
         * if !all (default), false
         * if all, true
         */
        return $check_all;
    }

}
