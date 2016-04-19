<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class City extends MyRest {

    function __construct() {

        parent::__construct();
    }

    public function list_get() {
        $options = array('table' => 'qyura_city', 'order' => array('city_name' => 'asc'));
        $datas = $this->common_model->customGet($options);
        $response = array();
        if($datas != null && $datas)
        {
            
            foreach ($datas as $data)
            {
                $temp = array();
                $temp[] = $data->city_id;
                $temp[] = $data->city_stateid;
                $temp[] = $data->city_name;
                $temp[] = $data->city_lat;
                $temp[] = $data->city_long;
                $temp[] = $data->city_center;
                $response[] = $temp;
            }
            
            $colums = array('city_id','city_stateid','city_name','city_lat','city_long','city_center');
            
            if (!empty($response) && $response != NULL ) {
                $response = array('status' => TRUE, 'message' => ' City list!', 'data' => $response,'colums'=>$colums );
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'There is no city yet!' );
                $this->response($response, 400);
            }
        }
    }

}
