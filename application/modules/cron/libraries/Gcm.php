<?php
/**
 *
 * @package GCM (Google Cloud Messaging)
 * @copyright (c) 2012 AntonGorodezkiy
 * info: https://github.com/antongorodezkiy/codeigniter-gcm/
 * Description: PHP Codeigniter Google Cloud Messaging Library
 * License: BSD
 *
 * Copyright (c) 2012, AntonGorodezkiy
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * 3. Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

class GCM {

	protected $apiKey = '';
	protected $apiSendAddress = '';
	protected $payload = array();
	protected $additionalData = array();
	protected $recepients = array();
	protected $message = '';
        
	public $status = array();
	public $messagesStatuses = array();
	public $responseData = null;
	public $responseInfo = null;
        
        private $_CI;

	protected $errorStatuses = array(
		'Unavailable' => 'Maybe missed API key',
		'MismatchSenderId' => 'Make sure you\'re using one of those when trying to send messages to the device. If you switch to a different sender, the existing registration IDs won\'t work.',
		'MissingRegistration' => 'Check that the request contains a registration ID',
		'InvalidRegistration' => 'Check the formatting of the registration ID that you pass to the server. Make sure it matches the registration ID the phone receives in the google',
		'NotRegistered' => 'Not registered',
		'MessageTooBig' => 'The total size of the payload data that is included in a message can\'t exceed 4096 bytes'
	);

	/**
	 * Constructor
	 */
	public function __construct() {
 
            $this->_CI =& get_instance();
//echo "HERE";
            $this->_CI->config->load('gcm', TRUE);
            
            $config = $this->_CI->config->item('gcm');
 
            foreach ($config as $key => $value)  {
                $this->$key = $value;
            }
            
            if (!$this->apiKey) {
                show_error('GCM: Needed API Key');
            }

            if (!$this->apiSendAddress) {
                show_error('GCM: Needed API Send Address');
            }
	}

	

        public function sendPush($info ) {

            $url = $this->apiSendAddress;
//            print_r($info);
            if(isset($info) && $info != NULL && count($info) > 1000){

                $result = array_chunk($info, 1000);
                
                if(isset($result) && count($result)>0)
                {
//                    print_r($result);
                    
                    foreach($result as $i){
                        
                        $checklength= strlen($i->msg);
                        $title = $i->title;

                        if($checklength > 80) {
                            $message = substr($i->msg ,0,500);
                        } else {
                            $message = $i->msg ;
                        } 
                    
                        $contentTitle = $title;

                        $message = $message;
                        $type = $i->type ;
                        $bundle=array('msg' => $message,'title' => $contentTitle,'type' => $type,"cronMsgId"=>$i->cronMsgId);
                        $urls[] = $url;
                        $data[] = array(
                            'data' => array('msg' => $message,'title' => $contentTitle,'type' => $type,"cronMsgId"=>$i->cronMsgId),
                            'dry_run'=>false,
                            'delay_while_idle' =>true,
                            'registration_ids' => $i->device
                        );
                    }
                }
            }else{
                /// --- MAJOR CHANGES When there is REGID which is less then 1000 then this will work ----
                foreach($info as $i){
                   // print_r($i);
                    
                    $checklength= strlen($i['msg']);
                    $title = $i['title'];

                    if($checklength > 80) {
                        $message = substr($i['msg'] ,0,500);
                    } else {
                        $message = $i['msg'] ;
                    } 

                    $contentTitle = $title;

                    $message = $message;
                    $type = $i['module_id'] ;
               
                    $bundle=array('msg' => $message,'title' => $contentTitle,'type' => $type,"cronMsgId"=>$i['item_id'],"subtype"=>$i['subtype'] );
                    $urls[] = $url;
                    $data[] = array(
                        'dry_run'=>false,
                        'delay_while_idle' =>true,
                        'registration_ids' => array($i['device']),
                        'data' => $bundle,
                    );
                    
                }
                
                $response = $this->MultiRequests($urls,$data);
                print_r($response);
            }
        }
       
	/*--------------------------------------------------------------
	 | Initiate Function for send curl multipal request simultanousaly
	 ----------------------------------------------------------------
	*/
        public function MultiRequests($urls , $data) {
           
            $curlMultiHandle = curl_multi_init();
            $curlHandles = array();

            foreach($urls as $id => $url) {
                $curlHandles[$id] = $this->CreateHandle($url, $data[$id]);
               
                curl_multi_add_handle($curlMultiHandle, $curlHandles[$id]);
            }
            $running = null;
            do {
                curl_multi_exec($curlMultiHandle, $running);
            } while($running > 0);
            
            foreach($curlHandles as $id => $handle) {
                $responses[$id] = curl_multi_getcontent($handle);
                curl_multi_remove_handle($curlMultiHandle, $handle);
            }
            
            curl_multi_close($curlMultiHandle);
        
            return $responses;
	}
        
         
        /*------------------------------------------------------------
	 | Function for send curl multipal request simultanousaly
	 ------------------------------------------------------------*/
        
        public function CreateHandle($url , $data) {  
            
            $curlHandle = curl_init($url);
           
            /// --- CHANGES BY Shilky ----
            $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" .$this->apiKey);
             
            $defaultOptions = array (
                CURLOPT_HTTPHEADER =>$headers,		
                CURLOPT_ENCODING => "gzip" ,
                CURLOPT_FOLLOWLOCATION => true ,
                CURLOPT_RETURNTRANSFER => true ,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_VERBOSE=>TRUE
            );
            
            curl_setopt_array($curlHandle , $defaultOptions);
            
            return $curlHandle;
            
	}
        
}

