<?php

class Partners extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main_content_model');
        $this->lang->load("partners/aerobics", "english");
    }

    function index() {
        $this->load->view('login/loginHeader');
        $this->load->view('login/login');
        $this->load->view('login/loginFooter');
    }
    
//check vendor
    function validate() {

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $query = $this->main_content_model->validate_vendor($email, $password);

            if (is_array($query)) {
                if($query[0]['enabled'] == 0){
                    $ad['error'] = 'Your account is disabled by admin .';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login', $ad);
                    $this->load->view('login/loginFooter');
                }elseif($query[0]['deleted'] == 1){
                    $ad['error'] = 'Your account is deleted by admin .';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login', $ad);
                    $this->load->view('login/loginFooter');
                }else{
                    $this->session->set_userdata('vendorId', $query[0]['vendorId']);
                    $this->session->set_userdata('vendorEmail', $query[0]['centerEmail']);
                    $this->session->set_userdata('contactPerson', $query[0]['contactPerson']);
                    $this->session->set_userdata('vendorRole',$query[0]['fkRoleId']);
                    redirect('partners/vendorServices');
                }
            } else {
                if ($query == 0) {
                    $ad['error'] = 'Invalid Username or Password';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login', $ad);
                    $this->load->view('login/loginFooter');
                } else {
                    $ad['error'] = 'Your account is not active, please check your mail';
                    $this->load->view('login/loginHeader');
                    $this->load->view('login/login', $ad);
                    $this->load->view('login/loginFooter');
                }
            }
        }
    }
    
//signup vendor
    function signUp() {
        //$this->session->sess_destroy();
        
        $options = array('table' => 'services','where' => array('enabled' => 1, 'deleted' => 0));
        $data['services'] = $this->main_content_model->customGet($options);

        $options = array('table' => 'city','order' => array('city.city_name' => 'asc'),);
        $data['city_list'] = $this->main_content_model->customGet($options);
        
        $this->load->view('vendor/vendorHeader');
        $this->load->view('vendorView', $data);
        $this->load->view('vendor/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
//load vendor edit view
    function editProfile() {
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $options = array('table' => 'services','where' => array('enabled' => 1, 'deleted' => 0));
        $data['services'] = $this->main_content_model->customGet($options);

        $vendorId = $this->session->userdata('vendorId');
        $option = array(
            'table' => 'vendorMaster',
            'select' => '*',
            'where' => array('vendorId' => $vendorId, 'vendorMaster.enabled' => 1, 'vendorMaster.deleted' => 0),
            'single' => FALSE
        );
        
        $data['vendorData'] = $this->main_content_model->customGet($option);
        
        $option = array(
            'table' => 'cityService',
            'select' => '*',
            'where' => array('fkVenderId' => $vendorId, 'cityService.enabled' => 1, 'cityService.deleted' => 0),
            'single' => FALSE
        );
        
        $vendorServiceData = $this->main_content_model->customGet($option);
        
        $vendorServiceArray = array();
        foreach($vendorServiceData as $vendorService){
            array_push($vendorServiceArray, $vendorService->fkServiceId);
        }
        $data['vendorServiceArray'] = $vendorServiceArray;
        
        $options = array('table' => 'city','order' => array('city.city_name' => 'asc'),);
        $data['city_list'] = $this->main_content_model->customGet($options);
        
        $head = $this->main_content_model->header();
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $this->load->view('vendor/vendorHeader',$data);
        $this->load->view('vendorEditView');
        $this->load->view('vendor/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
//save vendor information
    function vendorSaveFn() {

        $this->form_validation->set_rules('centerName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerAddress', 'Address', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerEmail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerContact', 'Position', 'required|xss_clean|trim');
        $this->form_validation->set_rules('contactPersonName', 'City', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {

            $options = array('table' => 'services','where' => array('enabled' => 1, 'deleted' => 0));
            $data['services'] = $this->main_content_model->customGet($options);

            $options = array('table' => 'city','order' => array('city.city_name' => 'asc'),);
            $data['city_list'] = $this->main_content_model->customGet($options);

            $this->load->view('vendor/vendorHeader');
            $this->load->view('vendorView', $data);
            $this->load->view('vendor/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $centerName = $this->input->post('centerName');
                $centerAddress = $address = $this->input->post('centerAddress');
                $centerEmail = $this->input->post('centerEmail');
                $password = md5($this->input->post('password'));
                $centerContact = $this->input->post('centerContact');
                $contactPersonName = $this->input->post('contactPersonName');
                $contactMobile = $this->input->post('contactMobile');
                $contactEmail = $this->input->post('contactEmail');
                $fbId = $this->input->post('fbId');
                $twitId = $this->input->post('twitId');
                $selectLanguage = $this->input->post('selectLanguage');
                $city = $this->input->post('city');
                $postcode = $this->input->post('zipCode');
                $activation_code = md5(time());
                $services = $this->input->post('services');
                $aboutUs= $this->input->post('aboutUs');
                $sales_id= $this->input->post('sales_id');
                
                $zip = trim($address).", ".trim($postcode);
                $val = $this->main_content_model->getLnt($zip);
                
                $latitude = $val['lat'];
                $longitude = $val['lng'];
                
                $records_array = array('createdAt' => date('Y-m-d'), 'fkRoleId' => 4, 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail, 'password' => $password, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'fbId' => $fbId, 'twitId' => $twitId, 'language' => serialize($selectLanguage), 'fkCityId' => $city, 'zipCode' => $postcode, 'latitude' => $latitude, 'longitude' => $longitude, 'activation_code' => $activation_code, 'aboutUs' => $aboutUs,'active' => 1);
                
                if(isset($sales_id) && $sales_id != ''){
                    $records_array['sales_id'] = $sales_id;
                }
                
                $options = array
                (
                    'data' => $records_array,
                    'table' => 'vendorMaster'
                );

                $vendorId = $this->main_content_model->customInsert($options);

                foreach ($services as $service){
                    
                    $service_array = array('createdAt' => date('Y-m-d'), 'fkVenderId' => $vendorId, 'fkCityId' => $city, 'fkServiceId' => $service);

                    $options = array
                    (
                        'data'  => $service_array,
                        'table' => 'cityService'
                    );

                    $cityId = $this->main_content_model->customInsert($options);
                }
                
//                $this->email->from('activate@froyofit.com', 'Team Froyofit');
//                $this->email->to($centerEmail);
//                //$this->email->bcc('admin@froyofit.com');
//                $this->email->subject("Froyofit");
//                $this->email->message("Dear {$contactPersonName},
//                            Welcome to Froyofit.Thank you for registering with us. Kindly note down your credentials which will be used to further log in to our website:
//                            User Name :  {$centerEmail}
//                            Password  :  {$this->input->post('password')}
//                            Kindly click on the link below to activate your account :
//                            Link : ".site_url()."partners/activateEmail/$activation_code/$vendorId
//                            Post verification you can login to our system and complete your registration process
//                            Thank you
//                            Team Froyofit.");
//                $this->email->send();

                $this->email->from('support@froyofit.com', 'Team Froyofit');
                $this->email->to('admin@froyofit.com');

                $this->email->subject("Froyofit");
                $this->email->message("Dear admin, 
                        
                        {$contactPersonName},You have been registered successfully with Froyofit. Kindly check mail for further procedure and other details.  ");
                $this->email->send();

                if ($vendorId) {
                    $where = array('vendorId' => $vendorId);
                    $update_data['froyo_id'] = "FFV00".$vendorId;
                    $options = array(
                        'table' => 'vendorMaster',
                        'where' => $where,
                        'data' => $update_data
                    );
                    $update = $this->main_content_model->customUpdate($options);
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners'));
                } else {
                    $error = array("TopError" => "<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }
                echo json_encode($responce);
            }
        }
    }
    
//edit vendor information
    function vendorEditFn() {

        $this->form_validation->set_rules('centerName', 'Name', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerAddress', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('centerContact', 'Position', 'required|xss_clean|trim');
        $this->form_validation->set_rules('contactPersonName', 'City', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {

            $options = array('table' => 'services',);
            $data['services'] = $this->main_content_model->customGet($options);

            $this->load->view('vendor/vendorHeader');
            $this->load->view('vendorEditView', $data);
            $this->load->view('vendor/vendorFooter');
            $this->load->view('scriptPage/vendorScript');
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                $vendorId = $this->input->post('vendorId');
                
                $centerName = $this->input->post('centerName');
                $centerAddress = $address = $this->input->post('centerAddress');
                $centerEmail = $this->input->post('centerEmail');
                $centerContact = $this->input->post('centerContact');
                $contactPersonName = $this->input->post('contactPersonName');
                $contactMobile = $this->input->post('contactMobile');
                $contactEmail = $this->input->post('contactEmail');
                $fbId = $this->input->post('fbId');
                $twitId = $this->input->post('twitId');
                $selectLanguage = $this->input->post('selectLanguage');
                $city = $this->input->post('city');
                $postcode = $this->input->post('zipCode');
                $aboutUs= $this->input->post('aboutUs');
                
                $zip = trim($address).", ".trim($postcode);
                $val = $this->main_content_model->getLnt($zip);
                
                $latitude = $val['lat'];
                $longitude = $val['lng'];
                
                $newServices = $this->input->post('services');                
                
                $option = array(
                    'table' => 'cityService',
                    'select' => '*',
                    'where' => array('fkVenderId' => $vendorId, 'cityService.enabled' => 1, 'cityService.deleted' => 0),
                    'single' => FALSE
                );

                $vendorServiceData = $this->main_content_model->customGet($option);

                $oldServices = array();
                foreach($vendorServiceData as $vendorService){
                    array_push($oldServices, $vendorService->fkServiceId);
                }
                
                foreach ($newServices as $service) {
                    $whereUpdate = array('fkVenderId' => $vendorId, 'fkServiceId' => $service,'deleted' => 0);
                    $arrayResumeData = array('fkCityId' => $city);
                    $updateOptions = array(
                        'where' => $whereUpdate,
                        'data'  => $arrayResumeData,
                        'table' => 'cityService'
                    );

                    $vendorOldDataResume = $this->main_content_model->customUpdate($updateOptions);
                    
                    if (!in_array($service, $oldServices)) {
                        
                        $option = array(
                            'table' => 'cityService',
                            'select' => '*',
                            'where' => array('fkServiceId' => $service, 'fkVenderId' => $vendorId),
                            'single' => TRUE
                        );

                        $oldData = $this->main_content_model->customGet($option);
                        
                        if (isset($oldData) && $oldData != NULL) {

                            $whereUpdate = array('fkVenderId' => $vendorId, 'fkServiceId' => $service);
                            $arrayResumeData = array('deleted' => 0,'fkCityId' => $city);
                            $updateOptions = array(
                                'where' => $whereUpdate,
                                'data'  => $arrayResumeData,
                                'table' => 'cityService'
                            );

                            $vendorOldDataResume = $this->main_content_model->customUpdate($updateOptions);
                            
                            //$result = $this->commonUpdateData($arrayData, $vendorId, 'cityService');
                        } else {
                            
                            $new_service_array = array('createdAt' => date('Y-m-d'), 'fkVenderId' => $vendorId, 'fkCityId' => $city, 'fkServiceId' => $service);
                            $options = array
                                (
                                'data'  => $new_service_array,
                                'table' => 'cityService'
                            );

                            $this->main_content_model->customInsert($options);
                        }
                    }
                }
                
                foreach ($oldServices as $service) {
                    if (!in_array($service, $newServices)) {

                        $whereUpdate = array('fkVenderId' => $vendorId, 'fkServiceId' => $service);
                            $deleteOldService = array('deleted' => 1,'fkCityId' => $city);
                            $updateOptions = array(
                                'where' => $whereUpdate,
                                'data'  => $deleteOldService,
                                'table' => 'cityService'
                            );

                        $vendorServiceDelete = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $records_array = array('createdAt' => date('Y-m-d'), 'centerName' => $centerName, 'centerAdd' => $centerAddress, 'centerEmail' => $centerEmail, 'centerContact' => $centerContact, 'contactPerson' => $contactPersonName, 'contactMobile' => $contactMobile, 'contactEmail' => $contactEmail, 'language' => serialize($selectLanguage) , 'fkCityId' => $city, 'zipCode' => $postcode, 'latitude' => $latitude, 'longitude' => $longitude, 'fbId' => $fbId, 'twitId' => $twitId, 'aboutUs' => $aboutUs);

                if ($this->input->post('password') != '') {
                    $records_array['password'] = md5($this->input->post('password'));
                }
               
                $updateVendorOptions = array(
                    'where' => array('vendorId' => $vendorId),
                    'data'  => $records_array,
                    'table' => 'vendorMaster'
                );
                
                $vendorServiceDelete = $this->main_content_model->customUpdate($updateVendorOptions);

                if ($vendorId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    redirect(site_url('partners/vendorServices'));
                } else {
                    $error = array("TopError" => "<strong>Something went wrong while saving your data... sorry.</strong>");
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }
                echo json_encode($responce);
            }
        }
    }
    
//load deshboard of vendor
    function vendorServices() {

        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $head = $this->main_content_model->header();
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0'";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $this->load->view('vendor/vendorHeader', $data);
        $this->load->view('partnerServices/deshboard');
        $this->load->view('vendor/vendorFooter');
    }
    
//load service view
    function vendorCustomView() {
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $vendorId = '';
        $table = '';
        
        $vendorId = $this->session->userdata('vendorId');
        $data['fkCityId'] = $cityServiceId = $this->uri->segment(3);
        $data['tableName'] = $table = $this->uri->segment(4);
        $data['activeCityId'] = $this->uri->segment(5);
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }

//service details
        $options = array(
            'table' => $table,
            'where' => array('fkcityServiceId' => $cityServiceId, 'services.enabled' => 1, 'services.deleted' => 0, 'cityService.enabled' => 1, 'cityService.deleted' => 0),
            'join' => array(
                array('cityService', 'cityService.cityServiceId = .'.$table.'.fkcityServiceId', 'left'),
                array('services', 'services.serviceId = cityService.fkServiceId', 'left'),
            ),
        );
        
        $data['serviceData'] = $this->main_content_model->customGet($options);
        
//fetch vendor data from venderDocuments table
        $option = array(
            'table' => 'venderDocuments',
            'select' => '*',
            'where' => array('fkcityServiceId' => $cityServiceId, 'enabled' => 1, 'deleted' => 0),
            'single' => FALSE
        );
        
        $data['venderDocumentsArray'] = $venderDocuments = $this->main_content_model->customGet($option);
        
//fetch vendor data from serviceCharges table
        $option = array(
            'table' => 'serviceCharges',
            'select' => '*',
            'where' => array('fkcityServiceId' => $cityServiceId, 'enabled' => 1, 'deleted' => 0),
            'single' => FALSE
        );
        
        $data['venderChargeArray']  = $venderCharges = $this->main_content_model->customGet($option);
        
//fetch vendor data from serviceTimeSlot table
        $option = array(
            'table' => 'serviceTimeSlot',
            'select' => '*',
            'where' => array('fkcityServiceId' => $cityServiceId, 'enabled' => 1, 'deleted' => 0,"forWomen"=>0),
            'order'=> array("dayNumber"=>"ASC"),
            'single' => FALSE
        );
        
        $data['venderTimeSlotArray'] = $venderTimeSlotArray = $this->main_content_model->customGet($option);
        
        $option = array(
            'table' => 'serviceTimeSlot',
            'select' => '*',
            'where' => array('fkcityServiceId' => $cityServiceId, 'enabled' => 1, 'deleted' => 0,"forWomen"=>1),
            'single' => FALSE
        );
        
        $data['womenTimeSlotArray'] = $venderTimeSlotArray = $this->main_content_model->customGet($option);
//        echo $this->db->last_query();
//        print_r($data['venderTimeSlotArray']);
//city service id
        $data['cityServiceId'] = $cityServiceId;
        $head = $this->main_content_model->header();
        $data['servicesArray'] = $head;
        
        $this->load->view('vendor/vendorHeader', $data);
        $this->load->view("partnerServices/$table");
        $this->load->view('vendor/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    } 
    
//view profile
    function viewProfile($vendorId){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        if(!isset($vendorId) && $vendorId == ''){
            $vendorId = $this->session->userdata('vendorId');
        }
        $options = array(
            'table' => 'vendorMaster',
            'where' => array('vendorId' => $vendorId, 'vendorMaster.enabled' => 1, 'vendorMaster.deleted' => 0),
            'join' => array(
                array('city', 'city.id = vendorMaster.fkCityId', 'left'),
            ),
        );
        
        $data['vendorData'] = $this->main_content_model->customGet($options);
        
        $head = $this->main_content_model->header();
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $this->load->view('vendor/vendorHeader', $data);
        $this->load->view('vendorProfileView');
        $this->load->view('vendor/vendorFooter');
    }
    
//<!-- Vendor Services -->    
 
//save/edit aerobics details
    function aerobics() {
        
        $this->form_validation->set_rules('experience', 'Experience field', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
   
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                
                $certification = $this->input->post('certification');
                $provideServices = $this->input->post('provideService');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                //information array of aerobics
                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'certification' => serialize($certification),
                    'moreCertification' => $this->input->post('moreCertification'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'aerobics'
                    );
                    $insertAerobicId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'aerobics'
                        );
                    $insertAerobicId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertAerobicId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertAerobicId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertAerobicId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertAerobicId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertAerobicId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertAerobicId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertAerobicId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                if ($insertAerobicId || $updateTimeId || $updateChargeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
//save/edit cross functional details
    function crossfunctional() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $arrayData = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'aboutUs' => $this->input->post('adoutService'),
                    'updateFlag' => 1
                );
                if($id){
                    $arrayData['updatedAt'] = date('Y-m-d H:i:s');
                    $updateOptions = array(
                        'where' => array('id' => $id),
                        'data'  => $arrayData,
                        'table' => 'crossfunctional'
                    );
                    $result = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $arrayData['createdAt'] = date('Y-m-d');
                    $options = array
                    (
                        'data'  => $arrayData,
                        'table' => 'crossfunctional'
                    );
                    $result = $this->main_content_model->customInsert($options);
                }
                
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit dance details
    function dance() {

        $this->form_validation->set_rules('adoutService', 'About Service', 'required|xss_clean|trim');
        $this->form_validation->set_rules('experience', 'Experience field', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group ', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Categories ', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $categories = $this->input->post('categories');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'aboutUs' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'categories' => serialize($categories),
                    'degree' => $this->input->post('degree'),
                    'centerType' => $this->input->post('centerType'),
                    'currency' => $this->input->post('currency'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'dance'
                    );
                    $insertDanceId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'dance'
                        );
                    $insertDanceId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertDanceId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertDanceId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertDanceId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertDanceId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertDanceId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertDanceId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertDanceId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertDanceId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

// save/edit dietitiannutritionist details
    function dietitiannutritionist() {

        $this->form_validation->set_rules('degree', 'About your degree', 'required|xss_clean|trim');
        $this->form_validation->set_rules('institute', 'Institute', 'required|xss_clean|trim');
        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('dieticianType[]', 'Dietitian Type', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                
                $updateChargeId = ''; 
                $updateTimeId = '';
                
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $amenities = $this->input->post('dieticianType');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'degree' => $this->input->post('degree'),
                    'institute' => $this->input->post('institute'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'recognizedYesNo' => $this->input->post('recognizedYesNo'),
                    'recognizedDetail' => $this->input->post('recognizedDetail'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'dietitiannutritionist'
                    );
                    $insertDietitiannutritionistId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'dietitiannutritionist'
                        );
                    $insertDietitiannutritionistId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertDietitiannutritionistId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertDietitiannutritionistId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertDietitiannutritionistId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertDietitiannutritionistId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertDietitiannutritionistId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertDietitiannutritionistId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertDietitiannutritionistId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertDietitiannutritionistId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit fitness studio details
    function fitnessstudio() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'centerType' => $this->input->post('centerType'),
                    'currency' => $this->input->post('currency'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'fitnessstudio'
                    );
                    $insertFitnessstudioId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'fitnessstudio'
                        );
                    $insertFitnessstudioId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertFitnessstudioId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertFitnessstudioId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertFitnessstudioId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertFitnessstudioId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertFitnessstudioId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertFitnessstudioId = $insertTimeId =$this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertFitnessstudioId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertFitnessstudioId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
//save/edit gym details
    function gym() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'centerType' => $this->input->post('centerType'),
                    'currency' => $this->input->post('currency'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'gym'
                    );
                    $insertGymId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'gym'
                        );
                    $insertGymId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertGymId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertGymId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertGymId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertGymId = $insertChargeId =$this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertGymId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertGymId = $insertTimeId =$this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertGymId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertGymId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit karateMartialart details
    function karatemartialart() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $categories = $this->input->post('categories');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'categories' => serialize($categories),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'ageGroup' => serialize($this->input->post('ageGroup')),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'karatemartialart'
                    );
                    $insertKarateMartialartId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'karatemartialart'
                        );
                    $insertKarateMartialartId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertKarateMartialartId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertKarateMartialartId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertKarateMartialartId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertKarateMartialartId = $insertChargeId =$this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertKarateMartialartId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertKarateMartialartId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertKarateMartialartId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertKarateMartialartId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit kickboxing details
    function kickboxing() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'experience' => $this->input->post('experience'),
                    'amenities' => serialize($amenities),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'kickboxing'
                    );
                    $insertKickboxingId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'kickboxing'
                        );
                    $insertKickboxingId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertKickboxingId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertKickboxingId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertKickboxingId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertKickboxingId = $insertChargeId =$this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertKickboxingId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertKickboxingId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertKickboxingId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertKickboxingId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit massages details
    function massages() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'experience' => $this->input->post('experience'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'item' => $this->input->post('item'),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'typeMass' => $this->input->post('typeMass'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'massages'
                    );
                    $insertMassagesId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'massages'
                        );
                    $insertMassagesId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertMassagesId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertMassagesId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertMassagesId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertMassagesId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertMassagesId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertMassagesId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertMassagesId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertMassagesId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit pilates details
    function pilates() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'recognizedYesNo' => $this->input->post('recognizedYesNo'),
                    'aboutOrganised' => $this->input->post('aboutOrganised'),
                    'experience' => $this->input->post('experience'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'pilates'
                    );
                    $insertPilatesId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'pilates'
                        );
                    $insertPilatesId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertPilatesId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertPilatesId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertPilatesId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertPilatesId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertPilatesId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertPilatesId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertPilatesId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertPilatesId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

//save/edit spinning details
    function spinning() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('partners/saveSpinning');
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'spinning'
                    );
                    $insertSpinningId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'spinning'
                        );
                    $insertSpinningId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertSpinningId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertSpinningId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertSpinningId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertSpinningId = $insertChargeId  = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertSpinningId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertSpinningId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertSpinningId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertSpinningId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }    
    
//save/edit swimming details
    function swimming() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('adoutService', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('trainer', 'Trainer', 'required|xss_clean|trim');
        $this->form_validation->set_rules('changeWaterPool', 'Change Water Pool', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $categories = $this->input->post('categories');
                $amenities = $this->input->post('amenities');
                $dimensions = $this->input->post('dimensions');
                
                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'trainer' => $this->input->post('trainer'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'categories' => serialize($categories),
                    'amenities' => serialize($amenities),
                    'dimensions' => serialize($dimensions),
                    'changeWaterPool' => $this->input->post('changeWaterPool'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'swimming'
                    );
                    $insertSwimmingId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'swimming'
                        );
                    $insertSwimmingId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertSwimmingId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertSwimmingId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertSwimmingId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertSwimmingId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertSwimmingId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertSwimmingId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertSwimmingId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertSwimmingId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }
    
//save/edit yoga details
    function yoga() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $ageGroup = $this->input->post('ageGroup');
                $categories = $this->input->post('categories');
                $amenities = $this->input->post('amenities');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'categories' => serialize($categories),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'yoga'
                    );
                    $insertYogaId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'yoga'
                        );
                    $insertYogaId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertYogaId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertYogaId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertYogaId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertYogaId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertYogaId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertYogaId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertYogaId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertYogaId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

    function zumba() {

        $this->form_validation->set_rules('experience', 'Experience', 'required|xss_clean|trim');
        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');
        $this->form_validation->set_rules('ageGroup[]', 'Age Group', 'required|xss_clean|trim');
        $this->form_validation->set_rules('amenities[]', 'Amenities', 'required|xss_clean|trim');
        $this->form_validation->set_rules('categories[]', 'Categories', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $provideServices = $this->input->post('provideService');
                $ageGroup = $this->input->post('ageGroup');
                $amenities = $this->input->post('amenities');
                $categories = $this->input->post('categories');

                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'awards' => $this->input->post('awards'),
                    'experience' => $this->input->post('experience'),
                    'ifPersonalTrainer' => $this->input->post('ifPersonalTrainer'),
                    'personalTrainer' => $this->input->post('personalTrainer'),
                    'provideService' => serialize($provideServices),
                    'travelling' => $this->input->post('travelling'),
                    'vehicle' => $this->input->post('vehicle'),
                    'ageGroup' => serialize($ageGroup),
                    'amenities' => serialize($amenities),
                    'categories' => serialize($categories),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'zumba'
                    );
                    $insertZumbaId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'zumba'
                        );
                    $insertZumbaId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertZumbaId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertZumbaId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertZumbaId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertZumbaId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertZumbaId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertZumbaId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertZumbaId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertZumbaId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

    function others() {

        $this->form_validation->set_rules('aboutUs', 'Description', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->vendorCustomView();
        } else {
            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
                $updateChargeId = ''; 
                $updateTimeId = '';
                $id = $this->input->post('id');
                $fkcityServiceId = $this->input->post('fkcityServiceId');
                
                $dataArray = array(
                    'fkcityServiceId' => $this->input->post('fkcityServiceId'),
                    'adoutService' => $this->input->post('adoutService'),
                    'aboutUs' => $this->input->post('aboutUs'),
                    'currency' => $this->input->post('currency'),
                    'centerType' => $this->input->post('centerType'),
                    'updateFlag' => 1
                );
                if($id){
                    $updateOptions = array(
                        'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $id),
                        'data'  => $dataArray,
                        'table' => 'others'
                    );
                    $insertOthersId = $this->main_content_model->customUpdate($updateOptions);
                }else{
                    $dataArray['createdAt']= date('Y-m-d');
                    $options = array(
                            'data'  => $dataArray,
                            'table' => 'others'
                        );
                    $insertOthersId = $this->main_content_model->customInsert($options);
                }
                
                //image/documents/video array
                $imageArray = $_FILES['photoList'];
                $documents  = $_FILES['documents'];
                $video = $this->input->post('video');
                
                //upload images
                $insertOthersId = $this->main_content_model->uploadVendorDocuments($imageArray,1,$fkcityServiceId);
                //upload documents
                $insertOthersId = $this->main_content_model->uploadVendorDocuments($documents,2,$fkcityServiceId);
                //upload video url
                $insertOthersId = $this->main_content_model->uploadVendorDocuments($video,3,$fkcityServiceId);
            
                //charges
                $chargeCount = $this->input->post('countChargeId');
                $chargesIds = array();
                for($i=1;$i <= $chargeCount;$i++){
                    
                    if( $this->input->post("chargeType_$i") == 1){
                        $chargeLable = $this->input->post("chargeLable_$i");
                        $chargeAmount = $this->input->post("chargeAmount_$i");
                        $discAmount = $this->input->post("discAmount_$i");
                        $afterDiscount = ($chargeAmount*$discAmount)/100;
                        $afterDiscount = $chargeAmount - $afterDiscount;
                        
                        //find a ids behalf of string
                        $option = array(
                            'table' => 'serviceCharges',
                            'select' => 'id',
                            'where' => array('fkcityServiceId' => $fkcityServiceId, 'chargeLable' => $chargeLable, 'enabled' => 1),
                            'single' => TRUE
                        );

                        $venderDocuments = $this->main_content_model->customGet($option);
                        if(isset($venderDocuments) && $venderDocuments != NULL){
                            array_push($chargesIds, $venderDocuments->id);
                        }
                        $chargeArray = array(
                            'fkCityServiceId' => $fkcityServiceId,
                            'chargeLable' => $chargeLable,
                            'price' => $chargeAmount,
                            'discount' => $discAmount,
                            'discountAmt' => $afterDiscount
                        );
                        $updateChargeId = $this->main_content_model->checkChargeTag($chargeLable,$fkcityServiceId,$chargeArray);
                        if(!$updateChargeId){
                            $chargeArray['createdAt']= date('Y-m-d');
                            $options = array
                            (
                                'data'  => $chargeArray,
                                'table' => 'serviceCharges'
                            );
                            $insertOthersId = $insertChargeId = $this->main_content_model->customInsert($options);
                            array_push($chargesIds, $insertChargeId);
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceCharges',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderDocuments = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderDocuments as $ids){
                    if(!in_array($ids->id, $chargesIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceCharges'
                        );
                        $insertOthersId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                
                $timeSlotsIds = array();
                for($j=1;$j<8;$j++){
                    
                    $totalSlot = $this->input->post("totalSlot_$j");
                    for($k=1;$k<=$totalSlot;$k++){
                        if($this->input->post("check_".$j."_".$k) == 1){
                            $hour_label = $this->input->post("hour_label_".$j."_".$k);
                            $openTime = $this->input->post("openTime_".$j."_".$k);
                            $closeTime = $this->input->post("closeTime_".$j."_".$k);
                            
                            //find a ids behalf of string
                            $option = array(
                                'table' => 'serviceTimeSlot',
                                'select' => 'id',
                                'where' => array('fkcityServiceId' => $fkcityServiceId, 'hourLabel' => $hour_label, 'enabled' => 1),
                                'single' => TRUE
                            );

                            $venderTimesSlots = $this->main_content_model->customGet($option);
                            if(isset($venderTimesSlots) && $venderTimesSlots != NULL){
                                array_push($timeSlotsIds, $venderTimesSlots->id);
                            }
                            $timeArray = array(
                                'fkCityServiceId' => $fkcityServiceId,
                                'dayNumber' => $j,
                                'hourLabel' => $hour_label,
                                'openingHours' => $openTime,
                                'closingHours' => $closeTime,
                            );
                            $updateTimeId = $this->main_content_model->checkTimeTag($hour_label,$fkcityServiceId,$timeArray);
                            if(!$updateTimeId){
                                $timeArray['createdAt']= date('Y-m-d');
                                $options = array
                                (
                                    'data'  => $timeArray,
                                    'table' => 'serviceTimeSlot'
                                );
                                $insertOthersId = $insertTimeId = $this->main_content_model->customInsert($options);
                                array_push($timeSlotsIds, $insertTimeId);
                            }
                        }
                    }
                }
                
                //find all ids behalf of this fkcityserviceid
                $option = array(
                    'table' => 'serviceTimeSlot',
                    'select' => 'id',
                    'where' => array('fkcityServiceId' => $fkcityServiceId, 'enabled' => 1, 'deleted' => 0),
                    'single' => FALSE
                );
                $venderTimeSlot = $this->main_content_model->customGet($option);
                //delete unlisted ids
                foreach($venderTimeSlot as $ids){
                    if(!in_array($ids->id, $timeSlotsIds)){
                        $deleteArray['deleted'] = 1;
                        $updateOptions = array(
                            'where' => array("fkcityServiceId"=>$fkcityServiceId, 'id' => $ids->id),
                            'data'  => $deleteArray,
                            'table' => 'serviceTimeSlot'
                        );
                        $insertOthersId = $this->main_content_model->customUpdate($updateOptions);
                    }
                }
                if ($insertOthersId || $updateChargeId || $updateTimeId) {
                    $this->session->set_flashdata('succ_msg', 'Your Information submited successfully.');
                    $this->main_content_model->checkServiceEdit($this->input->post('fkcityServiceId'));
                } else {
                    $this->session->set_flashdata('err_msg', 'No changes made to be saved.');
                    redirect(site_url('partners/vendorServices'));
                }
                echo json_encode($responce);
            }
        }
    }

    function checkEmailExist() {

        $email = $this->input->post('email');
        $column = $this->input->post('column');
        $query = "SELECT * FROM (`vendorMaster`) WHERE `$column` =  '$email'";
        $users = $this->main_content_model->customQuery($query);

        if (isset($users) && $users != NULL) {
            echo "1";
        } else {
            echo "0";
        }
    }

    function activateEmail() {

        $code = $this->uri->segment(3);
        $vendorId = $this->uri->segment(4);

        if ($vendorId) {
            $query = "SELECT * FROM (`vendorMaster`) WHERE `vendorId` =  '$vendorId' AND `activation_code` =  '$code' AND `active` =  '0'";
            $users = $this->main_content_model->customQuery($query);
            $id = array('vendorId' => $vendorId);
            if ($users) {
                $arrayData = array(
                    'active' => 1
                );
                $result = $this->commonUpdateData($arrayData, $id, 'vendorMaster');
                if ($result) {
                    $this->session->set_flashdata('succ_msg', 'Your Account is activated successfully.');
                    redirect(site_url('partners'));
                } else {
                    $this->session->set_flashdata('err_msg', 'Your Account is already active.');
                    redirect(site_url('partners'));
                }
            } else {
                $this->session->set_flashdata('err_msg', 'Your Account is already active.');
                redirect(site_url('partners'));
            }
        }
    }
    
    function changePassword() {

        $this->form_validation->set_rules('old', 'Old Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|trim');
        $this->form_validation->set_rules('confirm', 'Confirm Password', 'required|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => ajax_validation_errors());
            echo json_encode($responce);
        } else {

            if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

                $vendorId = array('vendorId' => $this->input->post('vendorId'));
                $vendor = $this->input->post('vendorId');
                $old = md5($this->input->post('old'));

                $query = "SELECT * FROM (`vendorMaster`) WHERE `vendorId` =  '$vendor' AND `password` =  '$old' AND `active` =  '1'";
                $users = $this->main_content_model->customQuery($query);
                if ($users) {

                    $data['password'] = md5($this->input->post('password'));
                    $updateOptions = array(
                        'where' => $vendorId,
                        'data' => $data,
                        'table' => 'vendorMaster'
                    );

                    $passwordChange = $this->main_content_model->customUpdate($updateOptions);
                    if ($passwordChange) {
                        $responce = array('status' => 1, 'msg' => 'Your password is successfully changed');
                    } else {
                        $error = array("TopError" => "<strong>Your last password and new password are same.</strong>");
                        $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                    }
                } else {
                    $error = array("TopError" => "<strong>Your old password is wrong.</strong>");
                    $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }

                echo json_encode($responce);
            }
        }
    }

    function logout() {

        $this->session->sess_destroy();
        redirect(site_url('partners'));
    }
    
    function commonUpdateData($arrayData, $Id, $table) {

        if (!empty($table) && !empty($arrayData)) {

            $updateOptions = array(
                'where' => $Id,
                'data' => $arrayData,
                'table' => $table
            );

            $vendorId = $this->main_content_model->customUpdate($updateOptions);

            if ($vendorId) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
//Custom Delete for image, video and documents
    function delete(){
        
        $fkCityServiceId = $this->input->post('fkCityServiceId');
        $del_id = $this->input->post('id');
        $docType = $this->input->post('docType');
        if($del_id)
        {
            //Group
            $where = array('id' => $del_id, 'fkCityServiceId'=>$fkCityServiceId, 'docType'=>$docType);
            $update_data['deleted'] = 1;
            $updateOptions = array
            (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'venderDocuments'
            );

            $update = $this->main_content_model->customUpdate($updateOptions); 

            if($update)
                echo $update;
            else
                echo '0';
        }
        else{
           echo 0;
        }
    }

//trial request for vendor
    function trial_request(){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $head = $this->main_content_model->header();
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $options = array(
            'table' => 'userBooking',
            'where' => array('userBooking.enabled' => 1, 'userBooking.deleted' => 0,'cityService.fkVenderId'=>$vendorId),
            'join' => array(
                array('app_users', 'app_users.id = userBooking.fkUserId', 'left'),
                array('serviceTimeSlot', 'serviceTimeSlot.id = userBooking.fkTimeSlotId', 'left'),
                array('cityService', 'cityService.cityServiceId = userBooking.fkCityServiceId', 'left'),
                array('vendorMaster', 'vendorMaster.vendorId = cityService.fkVenderId', 'left'),
                array('services', 'services.serviceId = cityService.fkServiceId', 'left'),
            ),
        );
        
        $data['user_list'] = $this->main_content_model->customGet($options);
        
        $this->load->view('vendor/vendorHeader',$data);
        $this->load->view('trialList');
        $this->load->view('vendor/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
//heathcare request request from user
    function heathcare_request(){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $head = $this->main_content_model->header();
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $options = array(
            'table' => 'userheathcare',
            'where' => array('userheathcare.enabled' => 1, 'userheathcare.deleted' => 0,'cityService.fkVenderId'=>$vendorId),
            'join' => array(
                array('app_users', 'app_users.id = userheathcare.fkUserId', 'left'),
                array('cityService', 'cityService.cityServiceId = userheathcare.fkCityServiceId', 'left'),
                array('vendorMaster', 'vendorMaster.vendorId = cityService.fkVenderId', 'left'),
                array('services', 'services.serviceId = cityService.fkServiceId', 'left'),
            ),
        );
        
        $data['user_list'] = $this->main_content_model->customGet($options);
        
        $this->load->view('vendor/vendorHeader',$data);
        $this->load->view('heath_partner_list');
        $this->load->view('vendor/vendorFooter');
        $this->load->view('scriptPage/vendorScript');
    }
    
//booking action
    function booking(){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $ena_id  = $this->input->post('id');
        $status  = $this->input->post('status');
        if($ena_id != '' && $status != '')
        {
            $update_data['bookingStatus'] = $status;

            $where = array('bookingId' => $ena_id);
            $updateOptions = array
            (
                'where' => $where,
                'data'  => $update_data,
                'table' => 'userBooking'
            );

            $update = $this->main_content_model->customUpdate($updateOptions); 

            if($update) 
                echo $update;
            else 
                echo '0';
        }
        else{
           echo 0;
        }
    } 
    
//user details
    function details_view(){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $head = $this->main_content_model->header();
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $userId = $this->uri->segment(3);
        
        $vendorId = $this->session->userdata('vendorId');
        
        $con = array('review.deleted'=>0,'review.fkuserId'=>$userId,'review.fkVenderId'=>$vendorId);
        $serviceOpt   =   array(
            'select' => '*',    
            'where'  => $con,
            'table'  => 'review',
            'join' => array(
                array('app_users', 'app_users.id = review.fkuserId', 'left'),
                array('vendorMaster', 'vendorMaster.vendorId = review.fkVenderId', 'left'),
            ),
            'single' => FALSE
        );
        $data['userReviewData']= $this->main_content_model->customGet($serviceOpt);

        $this->load->view('vendor/vendorHeader',$data);
        $this->load->view('userProfileView');
        $this->load->view('vendor/vendorFooter');
    }  
    
//user details
    function user_list(){
        
        if (!$this->session->userdata('vendorEmail')) {
            $this->session->set_flashdata('err_msg', 'Your session has expired please login again .');
            redirect(site_url('partners'));
        }
        
        $head = $this->main_content_model->header();
        
        $vendorId = $this->session->userdata('vendorId');
        $query = "SELECT DISTINCT `cityService`.`fkCityId`,`city`.`city_name`  FROM `cityService` JOIN `city` ON `city`.`id` = `cityService`.`fkCityId` WHERE `fkVenderId` =  '$vendorId' AND `cityService`.`deleted` = '0' ";
        $data['vendor_cities'] = $this->main_content_model->customQuery($query);
        
        $data['servicesArray'] = $head;
        $data['serviceCount'] = count($head);
        
        $userId = $this->uri->segment(3);
        
        $vendorId = $this->session->userdata('vendorId');
        
        $options = array(
            'table' => 'app_users',	
            'where' => array('app_users.enabled' => 1, 'app_users.deleted' => 0,'review.fkVenderId'=>$vendorId),
            'join' => array(
                array('review', 'review.id = app_users.id', 'left'),
                array('userBooking', 'userBooking.fkUserId = app_users.id', 'left'),
                array('userheathcare', 'userheathcare.fkUserId = app_users.id', 'left'),
                array('cityService', 'cityService.cityServiceId = userBooking.fkCityServiceId', 'left'),
                array('vendorMaster', 'vendorMaster.vendorId = cityService.fkVenderId', 'left'),
                array('services', 'services.serviceId = cityService.fkServiceId', 'left'),
            ),
        );
        
        $data['user_list'] = $this->main_content_model->customGet($options);
        print_r($data['user_list']);exit;
        $this->load->view('vendor/vendorHeader',$data);
        $this->load->view('userProfileView');
        $this->load->view('vendor/vendorFooter');
    }  
    
}