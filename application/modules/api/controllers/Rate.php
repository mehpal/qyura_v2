<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Rate extends MyRest {

    function __construct() {

        parent::__construct();
        $this->load->model(array('rate_model'));
    }

    function addRate_post() {
        
        $this->bf_form_validation->set_rules('rateBy', 'Rate By', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('rateTo', 'Rate To', 'xss_clean|trim|required|numeric|is_natural_no_zero');
        $this->bf_form_validation->set_rules('rating', 'rating', 'xss_clean|trim|required|numeric|is_natural_no_zero|min_length[1]|max_length[1]|callback__rating_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $rateBy = isset($_POST['rateBy']) ? $this->input->post('rateBy') : '';
            $rateTo = isset($_POST['rateTo']) ? $this->input->post('rateTo') : '';
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : 0;
            
            $where =  array(
                'rating_userId'=>$rateBy,
                'rating_relateId'=>$rateTo);
            
            $rating_check = $this->rate_model->rating_check($where);
            
            if(!$rating_check)
            {
                $data = array(
                    'rating_userId'=>$rateBy,
                    'rating_relateId'=>$rateTo,
                    'rating'=>$rating,
                    'creationTime'=>time()
                );

                $isInsert = $this->rate_model->addRate('qyura_ratings',$data);

                if($isInsert){
                    
                    $rat = $this->rate_model->getRating($rateTo);
                    $response = array('status' => TRUE, 'message' => 'Thanks for rating', 'rat'=>$rat );
                    $this->response($response, 200);
                }
                else
                {
                    $response = array('status' => FALSE, 'message' => 'Network Error' );
                    $this->response($response, 400);
                }
            }
            else {
                $response = array('status' => FALSE, 'message' => 'You have already rated.' );
                $this->response($response, 200);
            }
            
        }
    }

    function _rating_check($str_in = '')
    {
         if ($str_in > 5) {
            $this->bf_form_validation->set_message('_rating_check', 'The %s field may only contain max 5 star');

            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    
}
