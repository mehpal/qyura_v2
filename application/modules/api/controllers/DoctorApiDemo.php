<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class DoctorApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //echo 'hemant'; die();
        //$this->methods['hospital_post']['limit'] = 1; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function doctorlist_post() {

         $this->form_validation->set_rules('draw','Draw','xss_clean|numeric');
         $this->form_validation->set_rules('length','Length','required|xss_clean|numeric');
         $this->form_validation->set_rules('start','Start','required|xss_clean|numeric');
         $this->form_validation->set_rules('search_value','Search Value','xss_clean|alpha_numeric');
         $this->form_validation->set_rules('userId','User Id','xss_clean|numeric');
         $this->form_validation->set_rules('lat','Lat','decimal');
         $this->form_validation->set_rules('long','Long','decimal');
         $this->form_validation->set_rules('specialityid','Speciality Id','required|xss_clean|numeric');
         $this->form_validation->set_rules('lastupdatedtime','Last update time','xss_clean|numeric');
      
      if($this->form_validation->run() == FALSE)
      { 
        // setup the input
         $message = 'something wrong';
         $response =  array('status'=>FALSE,'message'=>$message);
         $this->response($response, 400);
      }
      else 
      {        

        $_POST['columns'] = array();

        $_POST['order'][] = array('column' => 0, 'dir' => 'asc');

        $_POST['search'] = array
            (
            'value' => isset($_POST['search_value']) ? $_POST['search_value'] : '',
            'regex' => false
        );

        $aoClumns = array("id","name","dob","imUrl","distance","rating","speciality","consFee");
        for ($i = 0; $i < 5; $i++) {
            $_POST['columns'][] = array
                (
                'data' => $i,
                'name' => '',
                'searchable' => true,
                'orderable' => true,
                'search' => array
                    (
                    'value' => '',
                    'regex' => false
                )
            );
        }
   
        $lat = isset($_POST['lat']) ? $_POST['lat'] : '';
        $long = isset($_POST['long']) ? $_POST['long'] : '';
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $specialityid = isset($_POST['specialityid']) ? $_POST['specialityid'] : '';

        // last updated date 16/01/2016
        $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';
        $notIn = isset($_POST['notIn']) ? $_POST['notIn'] : '';

        $notIn = explode(',', $notIn);

        if ($_POST['start'])
            $con = array('doctors_id >' => $_POST['start']);
        else
            $con = array();

        $this->datatables
                ->select('doctors_id, CONCAT(doctors_lName,  doctors_lName) AS name, doctors_dob, doctors_img, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( doctors_lat ) ) * cos( radians( doctors_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( doctors_lat ) ) )
                ) AS distance, qyura_doctors.doctors_deleted as rating ,qyura_specialities.specialities_name as speciality, qyura_doctors.doctors_deleted as consFee')
                ->from('qyura_doctors')
                ->loadwhere($con)
                ->join('qyura_doctorSpecialities','qyura_doctorSpecialities.doctorSpecialities_usersId=qyura_doctors.doctors_id','left')
                ->join('qyura_specialities','qyura_specialities.specialities_id=qyura_doctorSpecialities.doctorSpecialities_specialitiesId','left')
                ->where('qyura_doctors.doctors_deleted = 0')
                ->where('qyura_specialities.specialities_id = '.$specialityid.'  ')
                ->having(array('distance <' => 5));
        $this->datatables->where_not_in('doctors_id', $notIn);
        $this->datatables->edit_column('doctors_img', base_url().'assets/doctorsImages/$1', 'doctors_img');

        $response = $this->datatables->generate();
       // echo $this->db->last_query(); die();
         $response = (array)json_decode($response);
       // echo '</pre>';
      //  print_r($response); die();
        $option = array('table'=>'doctors','select'=>'doctors_id');
        $deleted = $this->singleDelList($option);
        $response['doctors_deleted']= $deleted;
        
        if (!empty($response['data'])) {
            $response['msg']= 'success';
            $response['status']= TRUE;
            $response['colName'] = $aoClumns;
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
            $response['msg']= 'fail';
             $response['status']= FALSE;
            $this->response(array('error' => 'Doctors could not be found'), 404);
        }
    }
}


}
