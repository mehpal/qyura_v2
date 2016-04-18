<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Clickatell Class
 *
 * @package		Clickatell
 * @subpackage	Libraries
 * @category	SMS Gateway
 * @author		Zachie du Bruyn
 */
class Clickatell {

    const ERR_NONE = 0;
    const ERR_AUTH_FAIL = 1;
    const ERR_SEND_MESSAGE_FAIL = 2;
    const ERR_SESSION_EXPIRED = 3;
    const ERR_PING_FAIL = 4;
    const ERR_CALL_FAIL = 5;

    // public vars
    public $error = SELF::ERR_NONE;
    public $error_message = '';
    // private vars
    private $ci;
    private $session_id = FALSE;
    
    /**
    * The last reply received from the API.
    * 
    * @var string
    */
   protected $last_reply;
   
   /**
    * Flag to make the class aware if cUrl is
    * enabled.
    * 
    * @var boolean 
    */
   protected $curl;


   /**
    * The Clickate API URL
    * 
    * @var string
    */
   protected $url	= 'http://api.clickatell.com/http/sendmsg';

    const BASEURL = "http://api.clickatell.com";

    /**
     * Class constructor - loads CodeIgnighter and Configs
     */
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->config->load('clickatell');

        $this->username = $this->ci->config->item('clickatell_username');
        $this->password = $this->ci->config->item('clickatell_password');
        $this->api_id = $this->ci->config->item('clickatell_api_id');
        $this->from_no = $this->ci->config->item('clickatell_from_no');
        
        // cUrl is the preferred method, should it be available
        $this->curl = in_array('curl', get_loaded_extensions());

        // If cUrl is not enabled, warn the user
        if(!$this->curl) log_message('debug', 'It\'s highly recommended that you enable cUrl to use the Clickatel library.');
    }

    /**
     * Method for Authentication with Clickatell
     *
     * @return string $session_id
     */
    public function authenticate() {
        $url = self::BASEURL . '/http/auth?user=' . $this->username
                . '&password=' . $this->password . '&api_id=' . $this->api_id;

        $result = $this->_do_api_call($url);
        $result = explode(':', $result);

        if ($result[0] == 'OK') {
            $this->session_id = trim($result[1]);
            return $this->session_id;
        } else {
            $this->error = self::ERR_AUTH_FAIL;
            $this->error_message = $result[0];
            return FALSE;
        }
    }

    /**
     * Method to send a text message to number
     *
     * @access  public
     * @param   string $to
     * @param   string $message
     * @return  message_id
     */
    public function send_message($to, $message) {
        if ($this->session_id == FALSE) {
            $this->authenticate();
        }

        if ($this->error == self::ERR_NONE) {

            $message = urlencode($message);
            $url = self::BASEURL . '/http/sendmsg?session_id=' . $this->session_id
                    . '&to=' . $to . '&text=' . $message . '&from=' . $this->from_no . '&MO=1';

            $result = $this->_do_api_call($url);
            $result = explode(':', $result);

            if ($result[0] == 'ID') {
                $api_message_id = $result[1];
                return $api_message_id;
            } else {
                $this->error = self::ERR_SEND_MESSAGE_FAIL;
                $this->error_message = $result[0];
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_balance() {
        if ($this->session_id == FALSE) {
            $this->authenticate();
        }

        if ($this->error == self::ERR_NONE) {
            $url = self::BASEURL . '/http/getbalance?session_id=' . $this->session_id;

            $result = $this->_do_api_call($url);
            $result = explode(':', $result);

            if ($result[0] == 'Credit') {
                return (float) $result[1];
            } else {
                $this->error = self::ERR_CALL_FAIL;
                $this->error_message = $result[0];
                return FALSE;
            }
        }
    }

    /**
     * Method to send a ping to keep session live
     *
     * @access  public
     * @return  bool $success
     */
    public function ping() {
        if ($this->session_id == FALSE) {
            $this->authenticate();
        }

        if ($this->error == self::ERR_NONE) {
            $url = self::BASEURL . '/http/ping?session_id=' . $this->session_id;

            $result = $this->_do_api_call($url);
            $result = explode(':', $result);

            if ($result[0] == 'OK') {
                return TRUE;
            } else {
                $this->error = self::ERR_PING_FAIL;
                $this->error_message = $result[0];
                return FALSE;
            }
        }
    }

    /**
     * Method to call HTTP url - to be expanded
     *
     * @param   string $url
     * @return  string response
     */
    private function _do_api_call($url) {
        $result = file($url);
        $result = implode("\n", $result);
        return $result;
    }

    /**
     * Submits a message to the API.
     * 
     * @param mixed $to			Either a string with the number or 
     * 							an array containing multiple numbers.
     * 
     * @param string $message	The message
     * @return boolean
     */
    public function send_sms($to, $message) {
        // Are there multiple receivers?
        if (is_array($to))
            $to = implode(',', $to);

        // Prepare the message
        $message = urlencode(str_replace(' ', '+', $message));

        // Build the request
        $request = array(
            'api_id' => $this->api_id,
            'user' => $this->username,
            'password' => $this->password,
            'to' => $to,
            'text' => $message
        );

        // cUrl is the preferred method to send the request
        if ($this->curl) {
            $ch = curl_init($this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, '5');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            $result = trim(curl_exec($ch));
        } else {
            $request = $this->url . '?' . http_build_query($request);
            $result = file_get_contents($request);
        }

        $this->last_reply = $result;

        // If the reply wasn't empty, it shouldn't contain errors
        if (!empty($this->last_reply)) {
            return !preg_match("/ERR/", $this->last_reply);
        }

        // The reply was empty
        return FALSE;
    }

    /**
     * Returns the last reply received from the API.
     * 
     * @return mixed		Either a string with the message or FALSE if none is set.
     */
    public function last_reply() {
        return isset($this->last_reply) ? $this->last_reply : FALSE;
    }

}

/* End of file Clickatell.php */
/* Location: ./application/libraries/Clickatell.php */