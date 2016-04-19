<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wel extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        $this->load->view('welcome_message');
    }

    public function curl() {

//  Calling cURL Library
        $this->load->library('curl');

//  Setting URL To Fetch Data From
        $this->curl->create('http://www.formget.com/');

//  To Temporarily Store Data Received From Server
        $this->curl->option('buffersize', 10);

//  To support Different Browsers
        $this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');

//  To Receive Data Returned From Server
        $this->curl->option('returntransfer', 1);

//  To follow The URL Provided For Website
        $this->curl->option('followlocation', 1);

//  To Retrieve Server Related Data
        $this->curl->option('HEADER', true);
        
        $this->curl->option('HEADER', true);

//  To Set Time For Process Timeout
        $this->curl->option('connecttimeout', 600);

//  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
        $data = $this->curl->execute();

//  To Display Returned Data
        echo $data;
    }
    
    public function clickatellDemo()
    {
        $this->load->library('clickatell');
        
        $msgId  = $this->clickatell->send_message('9826286226','hi dosto');
        
        dump($msgId);
        
        $balance = $this->clickatell->get_balance();
        
        dump($balance);
        
        $ping = $this->clickatell->ping();
                
        dump($ping);
        
        $authenticate = $this->clickatell->authenticate();
        
        dump($authenticate);
        
        $authenticate = $this->clickatell->send_sms('919669200456,919826286226','hi dosto');
        
        dump($authenticate);
    }
    
    public function sendsms()
    {
        
        $this->load->library('clickatell');
        
        $msgId  = $this->clickatell->send_message('7566643335','hi dosto');
        
        dump($msgId);
    }
    
    public function sarv()
    {
        $this->load->library('clickatell');
        
        $msgId  = $this->clickatell->send_message('9826286226','hi dosto');
        
        dump($msgId);
        
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */