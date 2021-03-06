<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller {

    public $data = array();
    public $configCustomData = array();
    public $tables = array();
    public $currentDate = '';
    public $currentDateTime = '';
    public $currentTime = '';
    public $currentTimestamp = '';
    public $titlePrifix = 'Qyura | ';
    public $access_denied;
    public $popupMessage = 'You must be an administrator to view this page.';
    public $sessionExp = "Your session has expired. Please log in again";
    public $_moduleId = '';
    public $error_message = '';

    public function __construct() {
        parent::__construct();
        header('Content-Type: text/html; charset=utf-8');
        $this->currentDate = date('Y-m-d');
        $this->currentDateTime = date('Y-m-d H:i:s');
        $this->currentTime = date('H:i:s');
        $this->currentTimestamp = time();

        $this->loader = '<div style="width:100%; text-align:center;"><div><img src="' . base_url() . 'images/ajax-loader.gif" /></div></div>';
        $this->small_loader = '<div><img src="' . base_url() . 'images/loader.gif" /></div>';
        $this->access_denied = $this->session->flashdata('access_denied');
        $this->load->helper(array('csv', 'download'));
    }

    /**
     * @project Qyura
     * @method resizeImage
     * @description image resize according to height and width global method
     * @access public
     * @param image_data, url, original_crop
     * @return string
     */
    public function resizeImage($image_data = '', $url = '', $original_crop = '', $imageName = '') {

        $thumb = array(200 => "thumb_200/" . $imageName . "_", 100 => "thumb_100/" . $imageName . "_", 50 => "thumb_50/" . $imageName . "_", 150 => "thumb_150/" . $imageName . "_");

        $is_width = $image_data['w'];
        $is_height = $image_data['h'];

        $project_path = substr($image_data['full_path'], 0, strpos($image_data['full_path'], '/assets'));
        $original_crop = ltrim($original_crop, '.');
        $original_crop_file = $project_path . $original_crop;

        $img_exp = explode('.', $original_crop_file);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $original_crop_file;

        foreach ($thumb as $key => $th) {
            if ($is_width >= $key) {
                $config['new_image'] = $url . $th . $image_data['micro'] . '.' . $img_exp[1];
                $config['width'] = $key;
                $config['height'] = $key;
                $this->image_lib->initialize($config);
                $src = $config['new_image'];
                $data['new_image'] = substr($src, 2);
                $data['img_src'] = base_url() . $data['new_image'];
                // Call resize function in image library.
                $this->image_lib->resize();
            }
        }
        return $data;
    }

    /**
     * @project Qyura
     * @method cropImage
     * @description image crop according to x axis and y axis global method
     * @access public
     * @param image_data , url
     * @return string
     */
    function cropImage($image_data = '', $url = '', $imageName = '') {


        //$img = substr($image_data['full_path'], 51);
        $img_exp = explode('.', $image_data['full_path']);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path'];
        $config['x_axis'] = $image_data['x'];
        $config['y_axis'] = $image_data['y'];
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $image_data['w'];
        $config['height'] = $image_data['h'];
        $config['new_image'] = $url . "original/" . $imageName . "_" . $image_data['micro'] . '.' . $img_exp[1];
        $this->image_lib->initialize($config);
        $src = $config['new_image'];
        $data['crop_image'] = substr($src, 2);
        $data['crop_image'] = base_url() . $data['crop_image'];
        // Call crop function in image library.
        $this->image_lib->crop();

        $this->resizeImage($image_data, $url, $src, $imageName);

        return $data;
    }

    /**
     * @project Qyura
     * @method uploadImageWithThumb
     * @description image upload after croping global method
     * @access public
     * @param upload_data, fileName, fileName, upload_url, thumb_url
     * @return string
     */
    function uploadImageWithThumb($upload_data = '', $fileName = '', $path = '', $upload_url = '', $thumb_url = '', $imageName = '') {

        $imagesname = '';
        if ($_FILES[$fileName]['name']) {


            $temp = explode(".", $_FILES[$fileName]["name"]);
            $microtime = round(microtime(true));
            $newfilename = "" . $imageName . "_" . $microtime . '.' . end($temp);

            $config['upload_path'] = $path;
            $config['upload_url'] = base_url() . $upload_url;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['max_size'] = '2000';
            $config['max_width'] = '2048';
            $config['max_height'] = '2048';
            $config['file_name'] = $newfilename;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($fileName)) {
                $data = array();
                $this->error_message = $this->upload->display_errors();
                return false;
            } else {
                $image_data = $this->upload->data();
                $image_data ['x'] = $upload_data->x;
                $image_data ['y'] = $upload_data->y;
                $image_data ['w'] = $upload_data->width;
                $image_data ['h'] = $upload_data->height;
                $image_data ['micro'] = $microtime;


                $data = $this->cropImage($image_data, $thumb_url, $imageName);
                return $newfilename;
            }
        }
    }

    function checkFileUploadValidation() {

        if (!empty($_POST['avatar_file'])) {
            $path = realpath(FCPATH . 'assets/diagnosticsImage/');
            $upload_data = $this->input->post('avatar_file');
            $upload_data = json_decode($upload_data);

            if ($upload_data->width > 120 && $upload_data->height > 120) {
                $response = array('state' => 200);
            } else {
                $response = array('state' => 400, 'message' => 'Height and Width must exceed 150px.');
            }
            echo json_encode($response);
        } else {
            $response = array('state' => 400, 'message' => 'Please select avtar');
            echo json_encode($response);
        }
    }

    /**
     * @project Qyura
     * @method isValidLatitude,isValidLongitude
     * @description lat long call back function validation
     * @access public
     * @return boolean
     */
    function isValidLatitude($latitude) {
        if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{2,20}$/", $latitude)) {
            return true;
        } else {
            return false;
        }
    }

    function isValidLongitude($longitude) {
        if (preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{2,20}$/", $longitude)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @method status
     * @description active inactive common function 
     * @access public
     * @param int
     * @return boolean
     */
    function status() {
        $table_field_name = $this->input->post('table_field_name'); //table field name
        $status_value = $this->input->post('status'); // status value
        $table_name = $this->input->post('table'); //table name
        $field_value = $this->input->post('field_value'); //field value
        $response = array();
        if (!empty($table_field_name) && !empty($table_name) && !empty($field_value)) {

            $where = array($table_field_name => $field_value);
            if ($status_value == 0) {
                $update_data['status'] = 1;
            } else {
                $update_data['status'] = 0;
            }

            $options = array(
                'table' => $table_name,
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->common_model->customUpdate($options);

            if ($update) {
                echo $update;
            } else
                echo 0;
        }else {
            echo 0;
        }
    }

    /**
     * @method getCityByMI
     * @description get city by MI
     * @access public
     * @param int
     * @return boolean
     */
    function puStatus() {
        $table_field_name = $this->input->post('table_field_name'); //table field name
        $status_value = $this->input->post('status'); // status value
        $table_name = $this->input->post('table'); //table name
        $field_value = $this->input->post('field_value'); //field value
        $response = array();
        if (!empty($table_field_name) && !empty($table_name) && !empty($field_value)) {

            $where = array($table_field_name => $field_value);
            if ($status_value == 2) {
                $update_data['status'] = 3;
            }

            $options = array(
                'table' => $table_name,
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->common_model->customUpdate($options);

            if ($update) {
                echo $update;
            } else
                echo 0;
        }else {
            echo 0;
        }
    }

    function getCityByMI($id = '') {

        $this->db->select('city.city_id,city.city_name,city.city_center');
        $this->db->from('qyura_city AS city');

        switch ($id) {

            case 1:
                $this->db->join('qyura_bloodBank AS blood', 'blood.cityId = city.city_id', 'inner');
                $this->db->where(array('blood.bloodBank_deleted' => 0));
                break;

            case 2:
                $this->db->join('qyura_ambulance AS ambulance', 'ambulance.ambulance_cityId = city.city_id', 'inner');
                $this->db->where(array('ambulance.ambulance_deleted' => 0));
                break;

            case 3:
                $this->db->join('qyura_diagnostic AS diag', 'diag.diagnostic_cityId = city.city_id', 'inner');
                $this->db->where(array('diag.diagnostic_deleted' => 0));
                break;

            case 4:
                $this->db->join('qyura_doctors AS doctor', 'doctor.doctors_cityId = city.city_id', 'inner');
                $this->db->where(array('doctor.doctors_deleted' => 0));
                break;

            case 5:
                $this->db->join('qyura_hospital AS hospital', 'hospital.hospital_cityId = city.city_id', 'inner');
                $this->db->where(array('hospital.hospital_deleted' => 0));
                break;

            case 6:
                $this->db->join('qyura_medicartOffer AS medicart', 'medicart.medicartOffer_cityId = city.city_id', 'inner');
                $this->db->where(array('medicart.medicartOffer_deleted' => 0));
                break;

            case 7:
                $this->db->join('qyura_pharmacy AS pharmacy', 'pharmacy.pharmacy_cityId = city.city_id', 'inner');
                $this->db->where(array('pharmacy.pharmacy_deleted' => 0));
                break;
        }

        $this->db->order_by("city.city_name", "asc");
        $this->db->group_by('city.city_name');
        $data = $this->db->get();
        return $data->result();
    }

    /**
     * @method updateTimeSlot
     * @description update time slot
     * @access public
     * @param int
     * @return boolean
     */
    function updateTimeSlot() {

        $redirectUrl = $this->input->post('redirectControllerMethod');
        $mi_user_id = $this->input->post('mi_user_id');
        $miId = $this->input->post('mi_id');
        $timeSlotsIds = array();

        for ($j = 1; $j < 8; $j++) {

            $totalSlot = $this->input->post("totalSlot_$j");
            for ($k = 1; $k <= $totalSlot; $k++) {
                if ($this->input->post("check_" . $j . "_" . $k) == 1) {

                    $charge_ids = $this->input->post("charge_ids_" . $j . "_" . $k);
                    $hour_label = $this->input->post("hour_label_" . $j . "_" . $k);
                    $openTime = $this->input->post("openTime_" . $j . "_" . $k);
                    $closeTime = $this->input->post("closeTime_" . $j . "_" . $k);
                    $dayNUmber = $this->input->post('dayNumber_' . $j);

                    $option = array(
                        'table' => 'qyura_miTimeSlot',
                        'select' => 'slot_id',
                        'where' => array('mi_user_id' => $mi_user_id, 'dayNumber' => $dayNUmber)
                    );
                    $isSlotData = $this->common_model->customGet($option);

                    if (!empty($isSlotData)) {

                        $options = array(
                            'table' => 'qyura_miTimeSlot',
                            'data' => array(
                                'hourLabel' => $hour_label,
                                'openingHours' => strtotime($openTime),
                                'closingHours' => strtotime($closeTime),
                                'modifyTime' => strtotime(date('Y-m-d H:i:s'))
                            ),
                            'where' => array(
                                'mi_user_id' => $mi_user_id,
                                'dayNumber' => $dayNUmber,
                                'slot_id' => $isSlotData[0]->slot_id)
                        );

                        $update = $this->common_model->customUpdate($options);
                    } else {

                        $options = array(
                            'table' => 'qyura_miTimeSlot',
                            'data' => array(
                                'mi_user_id' => $mi_user_id,
                                'dayNumber' => $dayNUmber,
                                'hourLabel' => $hour_label,
                                'openingHours' => strtotime($openTime),
                                'closingHours' => strtotime($closeTime),
                                'creationTime' => strtotime(date('Y-m-d H:i:s'))
                            ),
                        );
                        $insert = $this->common_model->customInsert($options);
                    }
                } else {

                    $dayNumber = $this->input->post('dayNumber_' . $j);

                    $option = array(
                        'table' => 'qyura_miTimeSlot',
                        'where' => array('mi_user_id' => $mi_user_id, 'dayNumber' => $dayNumber)
                    );
                    $isSlotData = $this->common_model->customDelete($option);
                }
            }
        }

        if (true) {
            $this->session->set_flashdata('message', 'Time Slot Update successfully!');
            redirect($redirectUrl . '/' . $miId . '/timeSlot');
        } else {
            $this->session->set_flashdata('error', 'Time Slot Update failed !');
            redirect($redirectUrl . '/' . $miId . '/timeSlot');
        }
    }

    /**
     * @method setTimeSlotMi
     * @description add time slot
     * @access public
     * @param int
     * @return boolean
     */
    function setTimeSlotMi() {

        $redirectUrl = $this->input->post('redirectControllerMethod');
        $miId = $this->input->post('mi_id');
        $timeSlotsIds = array();
        for ($j = 1; $j < 8; $j++) {

            $totalSlot = $this->input->post("totalSlot_$j");
            for ($k = 1; $k <= $totalSlot; $k++) {
                if ($this->input->post("check_" . $j . "_" . $k) == 1) {
                    $charge_ids = $this->input->post("charge_ids_" . $j . "_" . $k);
                    $hour_label = $this->input->post("hour_label_" . $j . "_" . $k);
                    $openTime = $this->input->post("openTime_" . $j . "_" . $k);
                    $closeTime = $this->input->post("closeTime_" . $j . "_" . $k);

                    $slot = array(
                        'mi_user_id' => $this->input->post('mi_user_id'),
                        'dayNumber' => $this->input->post('dayNumber_' . $j),
                        'hourLabel' => $hour_label,
                        'openingHours' => strtotime($openTime),
                        'closingHours' => strtotime($closeTime),
                        'creationTime' => strtotime(date('Y-m-d H:i:s'))
                    );

                    $options = array
                        (
                        'data' => $slot,
                        'table' => 'qyura_miTimeSlot'
                    );
                    $insertId = $this->common_model->customInsert($options);
                }
            }
        }

        if ($insertId) {
            $this->session->set_flashdata('message', 'Time Slot insert successfully!');
            redirect($redirectUrl . '/' . $miId . '/timeSlot');
        } else {
            $this->session->set_flashdata('error', 'Time Slot insert failed !');
            redirect($redirectUrl . '/' . $miId . '/timeSlot');
        }
    }

    function sendEmailRegister($emailId) {

        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('support@qyura.com', 'QYURA TEAM');
        $this->email->to($emailId);
        $body = "Hello " . $emailId;
        $this->email->subject('Conguratilation! Welcome to Qyura');
        $this->email->message($body);

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function updateMultipleIds($formData, $dbData, $mainId, $table) {
        $newDbData = array();
        $newDbData = '';
        $date = strtotime(date('Y-m-d'));
        if (isset($dbData) && count($dbData) == 0) {
            foreach ($formData as $key => $value) {
                $insert = $this->common_model->customQuery("insert into $table(`doctorSpecialities_doctorsId`,`doctorSpecialities_specialitiesId`,`creationTime`)values($mainId,$value,$date)", $single = false, $updDelete = false, $noReturn = true);
            }
            return true;
        }

        foreach ($dbData as $key => $value) {
            $newDbData[] = $dbData[$key]->doctorSpecialities_specialitiesId;
        }


        // array to delete rows from table
        $deleteArray = array();
        $addArray = array();

        $deleteArray = array_diff($newDbData, $formData);

        // array to add rows in table
        $addArray = array_diff($formData, $newDbData);

        // loop to delete rows
        if (!empty($deleteArray) && count($deleteArray)) {
            foreach ($deleteArray as $key => $value) {
                $response = $this->common_model->customQuery("delete from $table where doctorSpecialities_doctorsId = $mainId and doctorSpecialities_specialitiesId = $value", $single = false, $updDelete = false, $noReturn = true);
            }
        }

        // loop to add rows
        if (!empty($addArray) && count($addArray)) {
            foreach ($addArray as $key => $value) {
                $response = $this->common_model->customQuery("insert into $table(`doctorSpecialities_doctorsId`,`doctorSpecialities_specialitiesId`,`creationTime`)values($mainId,$value,$date)", $single = false, $updDelete = false, $noReturn = true);
            }
        }
        return $response;
    }

    function isEmailRegister() {

        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        if (!empty($email)) {
            $resonse = $this->common_model->fetchEmail($email, $role, $id);
            if ($resonse) {
                echo "false";
            } else {
                echo "true";
            }
        } else {
            echo "false";
        }
    }

    function isMobileRegister() {

        $mobileNo = $this->input->post('mobileNo');
        $id = $this->input->post('id');
        $role = $this->input->post('role');
        if (!empty($mobileNo)) {
            $resonse = $this->common_model->fetchMobileNo($mobileNo, $role, $id);
            if ($resonse) {
                echo "false";
            } else {
                echo "true";
            }
        } else {
            echo "false";
        }
    }

    function deliveryOrderSentMail($orderDetails) {
        
//        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $sender_email = 'yummylbox@gmail.com';
        $config['protocol'] = 'smtp';

        $config['smtp_host'] = 'ssl://smtp.googlemail.com';

        $config['smtp_port'] = 465;

        $config['smtp_user'] = $sender_email;

        $config['smtp_pass'] = "@yummy12";

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($sender_email, 'YUMMY TEAM');
        $this->email->to($orderDetails['userInfo']->email);
        $body = $this->load->view('mail_template', $orderDetails, TRUE);
        $this->email->subject('yummylunchbox New Order from yummy');
        $this->email->message($body);
        $this->email->set_mailtype("html");
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
    function send_mail($from,$to,$subject,$title,$msg) {
        
        $config = array(
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'protocol' => 'sendmail',
            'mailpath' => '/usr/sbin/sendmail',
        );
        
        $this->email->initialize($config);
	$this->email->set_newline("\r\n");
        $this->email->to($to);
        $this->email->from($from,$title);
        $this->email->subject($subject);
        $this->email->message($msg);
        $mail = $this->email->send();
        //show_error($this->email->print_debugger());
        if ($mail)
            return true;
        else {
            return FALSE;
            
        }
    }

}
