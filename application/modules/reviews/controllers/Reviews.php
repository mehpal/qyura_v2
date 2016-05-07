<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('reviews_model');
        $this->load->library('form_validation');
        $this->load->library('Ajax_pagination');
        $this->perPage = 3;
    }

    function index() {
        $data = array();
        //echo strtotime(date('12:10:10'));
        //exit();
        $data['topRateds'] = $this->reviews_model->recentReviewRated();
       // echo"<pre>";
       // print_r( $data['topRateds']);
       // echo"<pre>";
       // exit();
        $data['title'] = 'Rate & Reviews';
        
        $totalRec = count($this->reviews_model->fetchReviews());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = site_url().'/reviews/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;

        $config['full_tag_open'] = '<ul class="pagination list-inline pull-right list-unstyled call-pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['reviews'] = $this->reviews_model->fetchReviews(array('limit'=>$this->perPage));
       // dump($data['reviews']);
        //exit();
        $this->load->super_admin_template('reviewsListing', $data, 'reviewsScript');
    }
    /**
     * @project Qyura
     * @method ajaxPaginationData
     * @description ajax pagination
     * @access public
     * @return array
     */
     function ajaxPaginationData()
    {
        $filter = $this->input->post('filter');
        $sDate = $this->input->post('sDate');
        $eDate = $this->input->post('eDate');
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
     
        //total rows count
        $totalRec = count($this->reviews_model->fetchReviews(array('filter'=>$filter,'sDate' => $sDate, 'eDate' => $eDate)));
        
        //pagination configuration
        $config['first_link']  = 'First';   
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = site_url().'/reviews/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $config['additional_data'] = array('page' => $offset,'filter'=>$filter,'sDate' => $sDate, 'eDate' => $eDate);
        
        $config['full_tag_open'] = '<ul class="pagination list-inline pull-right list-unstyled call-pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>>';
        $config['first_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_link'] = 'prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['reviews'] = $this->reviews_model->fetchReviews(array('start'=>$offset,'limit'=>$this->perPage,'filter'=>$filter,
            'sDate' => $sDate, 'eDate' => $eDate));
        // echo $this->db->last_query();
      // exit();
         $this->load->view('ajax_page_view', $data, false);
    }
   

     /**
     * @project Qyura
     * @method createCSV
     * @description reviews create csv file
     * @access public
     * @return array
     */
   function createCSV(){
       
        $sDate ='';
        $eDate ='';
       // dump($_POST);
        //exit();
       if(isset($_POST['date-1']) && isset($_POST['date-2']) && !empty($_POST['date-1']) && !empty($_POST['date-2'])){
          $sDate = $this->input->post('date-1');
          $eDate = $this->input->post('date-2');
       }
        $filter = $this->input->post('filter');
        $reviews = $this->reviews_model->fetchReviews(array('filter'=>$filter,'sDate' => $sDate, 'eDate' => $eDate));

        $result = array();
        $i = 1;
        $imgUrl = base_url() . 'assets/patientImages/';
        foreach ($reviews as $key => $val) {
            $result[$i]['reviewBy'] = $val['reviewBy'];
            //$result[$i]['patientDetails_patientImg'] = $imgUrl . $val['patientDetails_patientImg'];
            $result[$i]['reviews_details'] = $val['reviews_details'];
            $result[$i]['reviews_rating'] = $val['reviews_rating'];
            $result[$i]['reviewTo'] = $val['reviewTo'];
            $result[$i]['reviews_post_details'] = $val['reviews_post_details'];
            $result[$i]['creationTime'] = date('d F Y',strtotime($val['createDates']));
            $i++;
        }
        

        $array[]= array('Patient Name','Patient Review','Rating','MI Name','MI Comment','Review Date');
       
        $arrayFinal = array_merge($array,$result);
       
        array_to_csv($arrayFinal,'Reviews.csv');
        return True;
        exit;
    }
   /**
     * @project Qyura
     * @method postComment
     * @description post comment
     * @access public
     * @return array
     */
    function postComment(){
        $message = "";
        $st = '';
        $comment = $this->input->post('comment');
        $miId = $this->input->post('miId');
        $reviewId = $this->input->post('reviewId');
        $status = $this->input->post('status');
        if(!empty($comment)):
            (!empty($status)) ? $st = $status : $st = 0;
           $option = array(
               'table' => 'qyura_reviews-post',
               'data' => array(
                   'reviews_post_reviewsId' => $reviewId,
                   'reviews_post_usersId' => $miId,
                   'reviews_post_details' => $comment,
                   'status' => $st,
                   'reviews_post_deleted' => 0,
                   'creationTime' => strtotime(date('Y-m-d H:i:s'))
               )
           ); 
           $response = $this->reviews_model->customInsert($option); 
	

           if($response){
               $message = "Your post comment has been successfully";
                $st = 200;
           }else{
              $message = "failed to post";
              $st = 400; 
           }
            
        else:
          
            $message = "Comment field can not be blank.";
            $st = 400;
            
        endif;
        
        echo json_encode(array('status' => $st, 'message' => $message));
        
    }
    
    /**
     * @project Qyura
     * @method getPost
     * @description post get records
     * @access public
     * @return array
     */
    
    function getPost($miId,$reviewId,$countId){
       $template = ""; 
       $st="";
       $miname = $this->input->post('miname');
       $option = array(
          'table' => 'qyura_reviews-post',
          'where' => array(
              'reviews_post_reviewsId' => $reviewId,
              'reviews_post_usersId' => $miId,
              'reviews_post_deleted' => 0
          )
       ); 
       $postData = $this->reviews_model->customGet($option); 
       if($postData){
          
           foreach($postData as $post){
              ($post->status == 1) ? $st ="checked" : $st="";
              
              $template.='<h3>'.  ucwords($miname).'</h3>'; 
              $template.= '<aside class="well clearfix m-t-10">';
              $template.= '<p class="text-justify">'.$post->reviews_post_details.'</p>';
              $template.= '<h3>Reply On Behalf of '.  ucwords($miname).'</h3>';
              $template.= '<section class="clearfix m-t-10">';
              $template.= '<div class="col-md-12 clearfix text-right m-t-5">'; 
              $template.= '<span style="display:none" class="text-success" id="success-post_'.$countId.'">Your post successfully update.</span>';
              
              $template.='<input type="checkbox" value="1" name="statuscheck" id="statuscheck_'.$countId.'" '.$st.'/> publish';
              $template.='<button class="btn btn-default btn-md" onClick="postPublish('.$countId.','.$miId.','.$reviewId.');">Publish</button>';
              $template.= '</div>';
              $template.= '</section>';
              $template.=' </aside>';
           }
           
       } 
        echo $template;
    }

   /**
     * @project Qyura
     * @method postPublish
     * @description postpublish unpublish
     * @access public
     * @return array
     */
    
    function postPublish(){
 
        $message = "";
        $st = '';
        $miId = $this->input->post('miId');
        $reviewId = $this->input->post('reviewId');
        $status = $this->input->post('status');
        
          (!empty($status)) ? $st = $status : $st = 0;
           
           $option = array(
               'table' => 'qyura_reviews-post',
               'data' => array(
                   'status' => $st,
                   'modifyTime' => strtotime(date('Y-m-d H:i:s'))
                   ),
               'where' => array(
                   'reviews_post_reviewsId' => $reviewId,
                   'reviews_post_usersId' => $miId,
                  )
           ); 
           $response = $this->reviews_model->customUpdate($option); 
           if($response){
                $st = 200;
           }else{
               $st = 400; 
           }

        echo $st;
        
    }
    
    
   
}
