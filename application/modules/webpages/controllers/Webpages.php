<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webpages extends MY_Controller {
    
    public $_error = array();
    public $_startTime = '';
    public $_endTime = '';
    
    public function __construct() {
        parent:: __construct();
    } 

    public function faq() 
    {
        $option = array(
            'table' => 'qyura_faq',
            'select' => '*',
            'where' => array('qyura_faq.faq_deleted' => 0),
            'single' => FALSE
        );
        $data['faq_list'] = $this->common_model->customGet($option);
            
        $data['title'] = "FAQ";
        $this->load->view('faq_page', $data);
    }
}

/* End of file welcome.php */
