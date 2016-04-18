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
     * 
     * $username = urlencode("u12765");
$msg_token = urlencode("Ij3aEZ");
$sender_id = urlencode("Mysarv"); // optional (compulsory in transactional sms)
$message = urlencode("dgdfgdf");
$mobile = urlencode("7566643335");

$api = "http://manage.sarvsms.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile."";
     */
    public function __construct() {
        $this->ci = & get_instance();
        //$this->ci->config->load('clickatell');
        $this->ci->config->load('sarv');

//        $this->username = urlencode($this->ci->config->item('clickatell_username'));
//        $this->password = urlencode($this->ci->config->item('clickatell_password'));
//        $this->api_id = urlencode($this->ci->config->item('clickatell_api_id'));
        
        $this->username = urlencode($this->ci->config->item('username'));
        $this->msg_token = urlencode($this->ci->config->item('msg_token'));
        $this->sender_id = urlencode($this->ci->config->item('sender_id'));
        //$this->from_no = $this->ci->config->item('clickatell_from_no');
        
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
    public function send_message_sarv($to, $message) {
//        if ($this->session_id == FALSE) {
//            //$this->authenticate();
//        }

        

            $message = urlencode($message);
            
            
            $url = "http://manage.sarvsms.com/api/send_transactional_sms.php?username=".$this->username."&msg_token=".$this->msg_token."&sender_id=".$this->sender_id."&message=".$message."&mobile=".urlencode($to)."";
            
            dump($url);

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
        
    }
    
    
    public function send_message($mobile_no, $message){
    
                $length = 6;
                $characters = '0123456789';
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
                
                $post_data = array(
                    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
                    // For promotional, this will be ignored by the SMS gateway
                    'From' => '08039512095',
                    'To'   => $mobile_no,
		    'Priority' => 'high',
                    'Body' => "$message", //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
                );

                $exotel_sid = "froyo"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
                $exotel_token = "1edf133173574c62525e4bf034b50952f655c799"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings

                $url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FAILONERROR, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

                $http_result = curl_exec($ch);
                $error = curl_error($ch);
                $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

                curl_close($ch);
                
                return $http_result;
    }
    
    /**
     * Method to send a text message to number
     *
     * @access  public
     * @param   string $to
     * @param   string $message
     * @return  message_id
     */
    public function send_message_click($to, $message) {
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