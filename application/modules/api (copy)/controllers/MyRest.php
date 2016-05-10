<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
// require APPPATH.'/libraries/REST_Controller.php';
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class MyRest extends REST_Controller {
    
    public $time;
    
    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->helper('common_helper');
        $this->load->database();
        $this->load->library('datatables');
        $this->time = time();
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['hospital_get']['limit'] = 500; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    public function singleDelList($options)
    {
        $table = false;
        $select= false;
        extract($options);
        
        
        $where = array($table.'_deleted' => 1 );
        
        if (!empty($select))
            $this->db->select($select);
        
        if (!empty($where))
            $this->db->where($where);

        $query = $this->db->get('qyura_'.$table);
        
        $result = array();
        
        if($this->db->count_all_results()){
            foreach ($query->result_array() as $row){
                   $result[] = $row[$select];
            }  
            return implode(',', $result);
        }
        else
        return '';
    }
    
    

}
