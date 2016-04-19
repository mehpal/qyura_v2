<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class Reviews extends MyRest {

    function __construct() {
        // Construct our parent class

        parent::__construct();
        $this->load->model(array('reviews_model'));
dump($_POST);
exit();
    }

    function setReview_post() {

        $this->bf_form_validation->set_rules('reviewBy', 'Reviewed By', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('reviewTo', 'Reviewed To', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('reviewCause', 'Reviewed Becaused', 'xss_clean|trim|alpha_numeric|required');
        $this->bf_form_validation->set_rules('review', 'Review', 'xss_clean|trim|required|min_length[20]|max_length[300]|callback__alpha_dash_space');
        $this->bf_form_validation->set_rules('rating', 'Rating', 'xss_clean|trim|required|numeric|is_natural_no_zero|min_length[1]|max_length[1]|callback__rating_check');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $reviewBy = isset($_POST['reviewBy']) ? $this->input->post('reviewBy') : '';
            $reviewTo = isset($_POST['reviewTo']) ? $this->input->post('reviewTo') : '';
            $reviewCause = isset($_POST['reviewCause']) ? $this->input->post('reviewCause') : '';
            $review = isset($_POST['review']) ? $this->input->post('review') : '';
            $rating = isset($_POST['rating']) ? $this->input->post('rating') : '';

            $whereisCheck = array(
                'reviews_userId' => $reviewBy,
                'reviews_relateId' => $reviewTo,
                'reviews_aptmntId' => $reviewCause
            );

            $fav_isCheck = $this->reviews_model->review_isChecked($whereisCheck);

            if ($fav_isCheck) {

                $response = array('status' => FALSE, 'message' => 'You already reviewed to this appointment');
                $this->response($response, 400);
                exit;
            } else {

                $data = array(
                    'reviews_userId' => $reviewBy,
                    'reviews_relateId' => $reviewTo,
                    'reviews_aptmntId' => $reviewCause,
                    'reviews_details' => $review,
                    'reviews_rating' => $rating,
                    'creationTime' => time(),
                    'status' => 1
                );

                $response = $this->reviews_model->setReviewAndRating('qyura_reviews', $data);
            }


            if ($response) {

                $response = array('status' => TRUE, 'message' => ' Thanks your feedback for this appointment');
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!');
                $this->response($response, 400);
            }
        }
    }

    function reviews_list_post() {

        $this->bf_form_validation->set_rules('miUserId', 'miUserId', 'xss_clean|numeric|required|trim');
        if ($this->bf_form_validation->run($this) == FALSE) {
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $reviews_relateId = $this->input->post('miUserId');
            $options = array(
                'table' => 'qyura_reviews',
                'where' => array('qyura_reviews.reviews_deleted' => 0, 'qyura_reviews.reviews_relateId' => $reviews_relateId),
                'join' => array(
                    array('qyura_fav', 'qyura_fav.fav_relateId = qyura_reviews.reviews_relateId', 'left'),
                    array('qyura_users', 'qyura_users.users_id = qyura_reviews.reviews_userId', 'left'),
                    array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId = qyura_reviews.reviews_userId', 'left'),
                ),
            );
            $reviews = $this->common_model->customGet($options);

            $response = array();
            if (isset($reviews) && $reviews != NULL) {
                foreach ($reviews as $review) {
                    $reviews_array = array();
                    $reviews_array[] = $review->reviews_details;
                    $reviews_array[] = ($review->fav_isFav != NULL && $review->fav_isFav == 1) ? 1 : 0;
                    $reviews_array[] = $review->reviews_relateId;
                    $reviews_array[] = $review->reviews_rating;
                    $reviews_array[] = $review->users_id;
                    //$reviews_array['users_username'] = $review->users_username;
                    $reviews_array[] = $review->patientDetails_patientName;
                    $path = realpath(FCPATH . 'assets/patientImages');
                    $path = $path.'/'.$review->patientDetails_patientImg;
                    if(file_exists($path))
                    $reviews_array[] = $review->patientDetails_patientImg;
                    else
                    $reviews_array[] = '';  
                    
                    $response[] = $reviews_array;
                }
            }
            $colums = array('reviews_details', 'favorite', 'reviews_relateId', 'reviews_rating', 'users_id', 'patientDetails_patientName','patientImg');
            if (!empty($response) && $response != NULL) {
                $response = array('status' => TRUE, 'message' => ' Review list!', 'data' => $response, 'colums' => $colums);
                $this->response($response, 200);
            } else {
                $response = array('status' => FALSE, 'message' => 'There is no review yet!');
                $this->response($response, 400);
            }
        }
    }

    function _alpha_dash_space($str_in = '') {
        // echo $str_in; exit;
        if (!preg_match("/^([-a-zA-Z_ ])+$/i", $str_in)) {
            $this->bf_form_validation->set_message('_alpha_dash_space', 'The %s field may only contain alpha characters, spaces, underscores, and dashes.');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _rating_check($str_in = '') {
        if ($str_in > 5) {
            $this->bf_form_validation->set_message('_rating_check', 'The %s field may only contain max 5 star');

            return FALSE;
        } else {
            return TRUE;
        }
    }

    function myReviews_post() {

        $this->bf_form_validation->set_rules('reviewBy', 'Reviewed By', 'xss_clean|numeric|required|trim');

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {

            $reviewBy = isset($_POST['reviewBy']) ? $this->input->post('reviewBy') : '';

            $where = array(
                'reviews_userId' => $reviewBy,
                'reviews_deleted' => 0
            );

            $response = $this->reviews_model->getMyReviews($where);

            if (!empty($response) && $response != NULL) {

                $response = array('status' => TRUE, 'message' => ' Review list!', 'data' => $response);
                $this->response($response, 200);
            } else {

                $response = array('status' => FALSE, 'message' => 'There is no review yet!');
                $this->response($response, 400);
            }
        }
    }

}
