<?php defined('BASEPATH') OR exit('No direct script access allowed');
// Usage: $this->ios->to('DEVICE_ID')->badge(3)->message('Hello world');
class Ios
{
	private $host = "";
//	private $port = 2196;
	private $cert;
	private $authCert = NULL;
	private $device = NULL;
	private $message = NULL;
	private $badge = NULL;
	private $sound = 'default';
	public  $push = NULL;
        
        private $_CI;
	
	public function __construct()
	{
            $this->_CI =& get_instance();

            $this->_CI->config->load('ios', TRUE);
            
            $config = $this->_CI->config->item('ios');
 
            foreach ($config as $key => $value)  {
                $this->$key = $value;
            }
            
            $this->push =   new ApnsPHP_Push(
                            ApnsPHP_Abstract::ENVIRONMENT_SANDBOX,
                            $this->cert
                        );
        
            // Set the Root Certificate Autority to verify the Apple remote peer
            $this->push->setRootCertificationAuthority($this->authCert);

            // Connect to the Apple Push Notification Service
            $this->push->connect();
            
	}
	
	public function to($device)
	{
            $this->device = $device;

            return $this;
	}
	
	public function message($message)
	{
            $this->message = urlencode($message);
            return $this;
	}
	
	public function badge($badge = 1)
	{
            $this->badge = $badge;
            return $this;
	}
	
	public function sound($sound = 'default')
	{
            $this->sound = $sound;
            return $this;
	}

	public function send()
	{
            // Build the payload
            $payload['aps'] = array('alert' => $this->message, 'badge' => $this->badge, 'sound' => $this->sound);
            $payload = json_encode($payload);

            $stream_context = stream_context_create();
            stream_context_set_option($stream_context, 'ssl', 'local_cert', $this->cert);

            $apns = stream_socket_client('ssl://' . $this->host . ':' . $this->port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

            $message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $this->device)) . chr(0) . chr(strlen($payload)) . $payload;
            fwrite($apns, $message);

            //socket_close($apns);
            fclose($apns);
	}
        
    function sendPush($info)
    {
//	log_message("INFO","Total Number Of iPhone Users::".count($reg)."\n",2);

//        $msg = $num1['Message'];
//      	$title = $num1['Title'];
//	$type = $num1['Type'];
//       
	/// --- SEND PUSH IPHONE APNSPHP ----
       
	foreach($info as $i)
	{
//            pre($i);
            // Instantiate a new Message with a single recipient
            $message = new ApnsPHP_Message($i['device']);
            $message->setCustomIdentifier("Message-Badge-".$i['device']);
            $message->setSound();
            $message->setText($i['msg']);
            $message->setCustomProperty("type", $i['module_id']);
            $message->setCustomProperty("itemId", $i['item_id']);
            $message->setCustomProperty("subtype", $i['subtype']);
            $message->setCustomProperty("cronMsgId", $i['item_id']);

            //echo $i['title'];
            //pre($message);
            $this->push->add($message);
	}
	// Send all messages in the message queue
	$this->push->send();
	// Disconnect from the Apple Push Notification Service
	$this->push->disconnect();
	// Examine the error message container
	$aErrorQueue = $this->push->getErrors();
	if (!empty($aErrorQueue)) 
	{
            $fpY=fopen(BASEPATH.DS."logs".DS.'Iphone_Notification_Error'.date('Y-m-d').".log","a+");
            fwrite($fpY,var_dump($aErrorQueue));
            fclose($fpY);
            log_message("INFO","Iphone Clue Push Failure Users:: {".var_dump($aErrorQueue)."}",2);
            return $aErrorQueue;
	}
	/// --- SEND PUSH IPHONE APNSPHP ----
	
    }
}