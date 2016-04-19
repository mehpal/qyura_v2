<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('data/data_model','dataModel');
    }
    
    public function index()
    {
       $this->load->view('index');
    }

    public function getTable()
    {
       $columns = array('id', 'first_name', 'last_name', 'gender', 'date');
       $table = 'users';
       $output = $this->dataModel->get_user_list($table,'id',$columns);
       echo json_encode($output);
    }
}
?>