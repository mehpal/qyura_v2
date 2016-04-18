<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('datatables');
        $this->load->model('users/users_model','userModel');
    }
    
    public function index()
    {
       $this->load->view('index');
    }

    public function getUsers()
    {

     $this->datatables
    ->select('actor_id, first_name, last_name, last_update')
    ->from('actor');
    //->date_range('2016-01-13','2016-01-15');

    echo  $data['result'] = $this->datatables->generate();
     // $this->load->view('ajax', $data);

    
    }
}
?>