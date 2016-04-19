<?php

require APPPATH . 'modules/api/controllers/MyRest.php';

class FavoriteApi extends MyRest {

    function __construct() {
        // Construct our parent class
       
        parent::__construct();
        $this->load->model(array('favorite_model'));
    }
    
    function setFav_post() {

        $this->form_validation->set_rules('favBy','User Id Favorite By','xss_clean|numeric|required|trim');
        $this->form_validation->set_rules('FavTo', 'Mi User Id Favoritr To', 'xss_clean|numeric|required|trim');
        $this->form_validation->set_rules('isFav', 'Is Favorite', 'xss_clean|trim|numeric|min_length[1]|max_length[1]');

        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $userId = isset($_POST['favBy']) ? $this->input->post('favBy') : '';
            $miUserId = isset($_POST['FavTo']) ? $this->input->post('FavTo') : '';
            $isFav = isset($_POST['isFav']) ? $this->input->post('isFav') : '';
            
            $whereisCheck = array(
                      'fav_userId'=>$userId,
                      'fav_relateId'=>$miUserId,
                      'fav_isFav'=>($isFav == 0) ? 1 : 0
                     );
            
            $fav_isCheck = $this->favorite_model->fav_isChecked($whereisCheck);
            if($fav_isCheck){  
                $response = array('status' => FALSE, 'message' => 'You already added in favorite list' );
                $this->response($response, 400); 
                exit;
            }
            $whereCheck = array(
                      'fav_userId'=>$userId,
                      'fav_relateId'=>$miUserId
                     );
            $fav_check = $this->favorite_model->fav_check($whereCheck);
            
            if($fav_check == ''){
                $data = array(
                    'fav_userId'=>$userId,
                    'fav_relateId'=>$miUserId,
                    'fav_isFav'=> ($isFav == 0) ? 1 : 0,
                    'creationTime'=>time() 
                 );
                $response = $this->favorite_model->setFav('qyura_fav',$data);
            }else{
                 $where = array(
                      'fav_userId'=>$userId,
                      'fav_relateId'=>$miUserId
                     );
                 $data = array(
                      'fav_isFav'=> ($isFav == 0) ? 1 : 0,
                      'modifyTime'=>time() 
                     
                 );
                 $response = $this->favorite_model->updateFav('qyura_fav',$data,$where);
            }

           
            if ($response) {
                if($isFav == 0){ $msg = 'Successfully added to favorite list'; } else{ $msg = 'Successfully remove from favorite list!'; }
                $response = array('status' => TRUE, 'message' => $msg);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!' );
                $this->response($response, 400);

            }
        }
    }


  function getFav_post() {

        $this->form_validation->set_rules('favBy','User Id Favorite By','xss_clean|numeric|required|trim');

        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $userId = isset($_POST['favBy']) ? $this->input->post('favBy') : '';
            $favList = $this->favorite_model->getFavList($userId);
           // print_r($favList); exit;
            if ($favList) {;
                $response = array('status' => TRUE, 'message' => 'list of all favorites', 'data' => $favList);
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'Empty list' );
                $this->response($response, 400);

            }
        }
    }
    
    
   function removeFav_post() {

        $this->form_validation->set_rules('favId','Favorite Id','xss_clean|required|trim');

        if ($this->form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);

        } else {

            $favId = isset($_POST['favId']) ? $this->input->post('favId') : '';
            $favId = explode(',', $favId);
            $isRemove = $this->favorite_model->removefav('qyura_fav',$favId);
           // print_r($favList); exit;
            if ($isRemove) {;
                $response = array('status' => TRUE, 'message' => 'Remove successfully');
                $this->response($response, 200);

            } else {

                $response = array('status' => FALSE, 'message' => 'Some thing wrong!' );
                $this->response($response, 400);

            }
        }
    }

}   