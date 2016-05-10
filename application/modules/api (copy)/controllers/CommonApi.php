<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class CommonApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //$this->methods['hospital_post']['limit'] = 1; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function hospital_post() {

        $_POST['columns'] = array();

        $_POST['order'][] = array('column' => 0, 'dir' => 'asc');

        $_POST['search'] = array
            (
            'value' => isset($_POST['search_value']) ? $_POST['search_value'] : '',
            'regex' => false
        );

        $aoClumns = array("hospital_id",
            "hospital_address",
            "hospital_name" ,
            "creationTime" ,
            "modifyTime" ,
            "distance");
        for ($i = 0; $i < 5; $i++) {
            $_POST['columns'][] = array
                (
                'data' => $aoClumns[$i],
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

        $_POST['startDate'] = '';
        $_POST['endDate'] = '';
        $_POST['gender'] = '';
        $_POST['ci_csrf_token'] = '';

        $cityId = 1037;
        // vijay nagar lat long
        $lat = isset($_POST['lat']) ? $_POST['lat'] : '22.768430';
        $long = isset($_POST['long']) ? $_POST['long'] : '75.895702';

        // last updated date 16/01/2016
        $lastUpdatedDate = isset($_POST['lastUpdatedDate']) ? $_POST['lastUpdatedDate'] : '1452951625';
            $notIn = isset($_POST['notIn']) ? $_POST['notIn'] : '';

        $notIn = explode(',', $notIn);

        if ($_POST['start'])
            $con = array('hospital_id >' => $_POST['start']);
        else
            $con = array();

        $this->datatables
                ->select('hospital_id,hospital_address,hospital_name,creationTime,modifyTime, (
                3959 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( hospital_lat ) ) * cos( radians( hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( hospital_lat ) ) )
                ) AS distance')
                ->from('qyura_hospital')
                ->loadwhere($con)
                ->having(array('distance <' => 5));
        $this->datatables->where_not_in('hospital_id', $notIn);

        $response = $this->datatables->generate();
        $response = (array)json_decode($response);
        $option = array('table'=>'hospital','select'=>'hospital_id');
        $deleted = $this->singleDelList($option);
        $response['hospital_deleted']= $deleted;
        
        if (!empty($response['data'])) {
            $response['msg']= 'success';
            $response['status']= TRUE;
            $this->response($response, 200); // 200 being the HTTP response code
        } else {
            $response['msg']= 'fail';
             $response['status']= FALSE;
            $this->response(array('error' => 'Hospital could not be found'), 404);
        }
    }

}
