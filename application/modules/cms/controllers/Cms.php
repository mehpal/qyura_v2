<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends MY_Controller {

    public $error_message = '';

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        $this->load->model('cms_model');
    }

    function index() {
        $data = array();

        $data['title'] = 'Content Management System';
        $this->load->super_admin_template('cmsList', $data, 'cmsScript');
    }  
    
     /**
     * @project Qyura
     * @method addcms
     * @description add cms view form
     * @access public
     */
    function addcms() {
        $data = array();
        $data['title'] = 'Add Content Management System';
        $this->load->super_admin_template('addcms', $data, 'cmsScript');
    }
    
     function savecms() {

        //validate form input
        $this->bf_form_validation->set_rules('cms_title', 'CMS Title', 'required|is_unique[cms.cms_title]');
        $this->bf_form_validation->set_rules('cms_description', 'CMS Description', 'required|trim');


        if ($this->bf_form_validation->run() == true) {

                    $title = $this->input->post('cms_title');
                    $code = str_replace(' ', '_', trim($title));
                    
                    
                    $optionsArray = array(
                        'cms_title' => $this->input->post('cms_title'),
                        'cms_description' => $this->input->post('cms_description'),
                        'cms_code' => $code,
                        'createdAt' => date('Y-m-d H:i:s')

                    );
                    $options = array
                        (
                        'data' => $optionsArray,
                        'table' => 'cms'
                    );
                    $insert = $this->cms_model->customInsert($options);
                    if($insert){
                        $this->session->set_flashdata('message','Data insert successfully !');
                        redirect('cms');
                    }else{
                       $this->session->set_flashdata('message','Sorry! an error occured.Try again.');
                       redirect('cms');
                    }

        } else {
            $data['title'] = 'Add Content Management System';
            $this->load->super_admin_template('addcms', $data, 'cmsScript');
        }

       // echo json_encode($responce);
    }

      /**
     * @project Qyura
     * @method cmsView
     * @description  cms view form
     * @access public
     */
    function cmsView($cms_id='') {
     
        $where = array('deleted' => 0, 'cms_id' => $cms_id);
        $tbl = 'cms';
        $option = array(
            'select' => '*',
            'where' => $where,
            'table' => $tbl,
            'single' => true
        );

        $data['result'] = $this->cms_model->customGet($option);

       $this->load->super_admin_template('viewcms', $data, 'cmsScript');

    }

   
     /**
     * @project Qyura
     * @method editView
     * @description edit cms view form
     * @access public
     */
    function editView($cms_id='') {
        
        $where = array('deleted' => 0, 'cms_id' => $cms_id);
        $tbl = 'cms';
        $option = array(
            'select' => '*',
            'where' => $where,
            'table' => $tbl,
            'single' => true
        );

        $data['resultRows'] = $this->cms_model->customGet($option);
        $data['title'] = 'Edit Details';
        $this->load->super_admin_template('editcms', $data, 'cmsScript');
    }

     /**
     * @project Qyura
     * @method updatecms
     * @description add cms view form
     * @access public
     */
    function updatecms() {
       $whereId = $this->input->post('cms_id');
       $this->bf_form_validation->set_rules('cms_title', 'CMS Title', 'required');
        $this->bf_form_validation->set_rules('cms_description', 'CMS Description', 'required');
        if ($this->bf_form_validation->run() == true) {
          
           
             $where = array('cms_id' => $whereId);
                  $title = $this->input->post('cms_title');
                  $code = str_replace(' ', '_', trim($title));
                  $additional_data = array(
                        'cms_title' => $this->input->post('cms_title'),
                        'cms_description' => $this->input->post('cms_description'),
             );
              
                $options = array
                    (
                    'data' => $additional_data,
                    'where' => $where,
                    'table' =>'cms'
                );
                $update = $this->cms_model->customUpdate($options);
                if ($update) {
                   $this->session->set_flashdata('message','Data updated successfully !');
                   redirect('cms');

                } else {
                   $this->session->set_flashdata('message','Data updated successfully !');
                   redirect('cms');
                   
                }
        } else {
            $where = array('deleted' => 0, 'cms_id' => $whereId);
            $tbl = 'cms';
            $option = array(
                'select' => '*',
                'where' => $where,
                'table' => $tbl,
                'single' => true
            );

            $data['resultRows'] = $this->cms_model->customGet($option);
            $data['title'] = 'Edit Details';
            $this->load->super_admin_template('editcms', $data, 'cmsScript');

        }
    }
    
    function getcmsdetail(){
         echo $this->cms_model->fetchcmsDataTables();
    }

}
