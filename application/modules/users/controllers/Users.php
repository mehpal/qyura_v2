<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('datatables');
       // $this->load->model('users/users_model','userModel');
    }
    
    public function index()
    {
       $this->load->view('index');
    }

    public function getUsers()
    {

    $startDate = $this->input->post('startDate');
    isset($startDate) && $startDate != '' ? $start = $startDate : $start = '';

    $endDate = $this->input->post('endDate');
    isset($endDate) && $endDate != '' ? $end = $endDate : $end = '';

    $gender = $this->input->post('gender');
    isset($gender) && $gender != '' ? $this->datatables->where('gender',$gender)  : '';

      
     $this->datatables
    ->select('City.Name as CityName, City.District as cityDistrict, City.Population as CityPopulation, Country.Code as code', 'Country.Name as countryName')
    ->from('City')
    ->join('Country','City.CountryCode=Country.Code')
    ->date_range($start,$end);

    echo  $data['result'] = $this->datatables->generate();
     // $this->load->view('ajax', $data);

    
    }
}
?>