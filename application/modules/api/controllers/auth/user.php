<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . 'modules/api/libraries/REST_Controller.php';

class User extends REST_Controller {

    public function __construct() {
        /// -- Create Database Connection instance --
        parent::__construct();
        $this->load->model('main_content_model');
    }

    //login 
    function uservalidate_post() {

        $account_type = $this->input->post('account_type');
        if ($account_type == 1) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }if ($account_type == 2) {
            $this->form_validation->set_rules('social_id', 'Social Id', 'trim|required');
        }
        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {

            $account_type = $this->input->post('account_type');
            if ($account_type == 1) {
                $email = $this->input->post('email');
                $password = md5($this->input->post('password'));
                $query = "SELECT * FROM (`app_users`) WHERE `email` =  '$email' AND `password` =  '$password' AND `account_type` = '$account_type' AND `enabled` = '1' AND `deleted` = '0' ";
            } else {
                $social_id = $this->input->post('social_id');
                $query = "SELECT * FROM (`app_users`) WHERE `social_id` =  '$social_id' AND `account_type` = '$account_type' AND `enabled` = '1' AND `deleted` = '0'";
            }

            $users = $this->main_content_model->customQuery($query);

            if (!empty($users) && $users != NULL) {
                $userArray = array(
                    'id' => $users[0]->id,
                    'account_type' => $users[0]->account_type,
                    'name' => $users[0]->name,
                    'email' => $users[0]->email,
                    'mobile' => $users[0]->mobile,
                    'notification' => $users[0]->notification
                );
                if ($account_type == 1) {
                    if(isset($users[0]->image) && $users[0]->image != ''){
                        $userArray['image'] = $users[0]->image;
                    }
                }
                if ($account_type == 2) {
                    $userArray['social_id'] = $users[0]->social_id;
                    $userArray['image'] = $users[0]->image;
                }
                $msg = "Login is success";
                $response = array('status' => TRUE, 'message' => $msg, 'result' => $userArray);
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                if ($account_type == 1) {
                    $message = "Email id does'nt exist";
                    $response = array('status' => FALSE, 'message' => $message);
                    $this->response($response, 400);
                } else {
                    $message = "Your account is not found";
                    $response = array('status' => FALSE, 'message' => $message);
                    $this->response($response, 400);
                }
            }
        }
    }

    //signup
    function userssignup_post() {

        $this->form_validation->set_rules('account_type', 'Account Type', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[app_users.email,deleted=0]');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        //$this->form_validation->set_rules('pushToken', 'Push Token', 'trim|required');
        $this->form_validation->set_rules('deviceType', 'Device Type', 'trim|required');
        $this->form_validation->set_rules('fkCityId', 'City', 'trim|required');

        $account_type = $this->input->post('account_type');
        if ($account_type == 1) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }
        if ($account_type == 2) {
            $this->form_validation->set_rules('social_id', 'Social Id', 'trim|required|is_unique[app_users.social_id,deleted=0]');
            $this->form_validation->set_rules('image', 'Image', 'trim|required');
        }
        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {

            $account_type = $this->input->post('account_type');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $pushToken = $this->input->post('pushToken');
            $deviceType = $this->input->post('deviceType');
            $fkCityId = $this->input->post('fkCityId');
            if(isset($pushToken) && $pushToken != ''){
                $notification = '1';
            }else{
                $notification = '0';
            }
            $records_array = array('createdAt' => date('Y-m-d'), 'fkRoleId' => 5, 'account_type' => $account_type, 'name' => $name, 'email' => $email, 'mobile' => $mobile, 'pushToken' => $pushToken, 'deviceType' => $deviceType,'fkCityId'=>$fkCityId,'notification'=>$notification);

            if ($account_type == 1) {
                $records_array['password'] = md5($this->input->post('password'));
            } else {
                $records_array['social_id'] = $social_id = $this->input->post('social_id');
                $records_array['image'] = $image = $this->input->post('image');
            }

            $options = array
                (
                'data' => $records_array,
                'table' => 'app_users'
            );

            $users = $this->main_content_model->customInsert($options);

            if (!empty($users) && $users != NULL) {
                $userArray = array(
                    'id' => $users,
                    'account_type' => $account_type,
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'notification' => 1,
                );
                if ($account_type == 1) {
                    if(isset($image) && $image != ''){
                        $userArray['image'] = $image;
                    }
                }
                if ($account_type == 2) {
                    $userArray['social_id'] = $social_id;
                    $userArray['image'] = $image;
                }
                $msg = "Sign up successfully";
                $response = array('status' => TRUE, 'message' => $msg, 'result' => $userArray);
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $message = "Error in signup";
                $response = array('status' => FALSE, 'message' => $message);
                $this->response($response, 400);
            }
        }
    }

    //edit profile
    function usersedit_post() {
        $notification = $this->input->post('notification');
        if($notification == 1){
            $this->form_validation->set_rules('pushToken', 'Push Token', 'trim|required');
        }
        $this->form_validation->set_rules('id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('account_type', 'Account Type', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('fkCityId', 'City', 'trim|required');
        $account_type = $this->input->post('account_type');
        
        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {
            $id = $this->input->post('id');
            $account_type = $this->input->post('account_type');
            $name = $this->input->post('name');
            $mobile = $this->input->post('mobile');
            $pushToken = $this->input->post('pushToken');
            if(isset($pushToken) && $pushToken != ''){
                $notification = $this->input->post('notification');
            }else{
                $notification = '0';
            }
            $fkCityId = $this->input->post('fkCityId');
            $records_array = array('name' => $name, 'mobile' => $mobile,'notification' => $notification,'fkCityId'=>$fkCityId);
            $password = $this->input->post('password');
            
            if(isset($password) && $password != ''){
                if ($account_type == 1) {
                    $records_array['password'] = md5($this->input->post('password'));
                }
            }

            $updateOptions = array(
                'where' => array("id" => $id, 'account_type' => $account_type),
                'data' => $records_array,
                'table' => 'app_users'
            );
            $users = $this->main_content_model->customUpdate($updateOptions);

            if (!empty($users) && $users != NULL) {

                $query = "SELECT * FROM (`app_users`) WHERE `id` =  '$id' AND `account_type` = '$account_type' AND `enabled` = '1' AND `deleted` = '0'";
                $usersData = $this->main_content_model->customQuery($query);
                $userArray = array(
                    'id' => $usersData[0]->id,
                    'account_type' => $usersData[0]->account_type,
                    'name' => $usersData[0]->name,
                    'email' => $usersData[0]->email,
                    'mobile' => $usersData[0]->mobile,
                    'notification' => $usersData[0]->notification
                );
                if ($account_type == 1) {
                    if(isset($usersData[0]->image) && $usersData[0]->image != ''){
                        $userArray['image'] = $usersData[0]->image;
                    }
                }
                if ($account_type == 2) {
                    $userArray['social_id'] = $usersData[0]->social_id;
                    $userArray['image'] = $usersData[0]->image;
                }

                $msg = "Profile update successfully";
                $response = array('status' => TRUE, 'message' => $msg, 'result' => $userArray);
                $this->response($response, 200); // 200 being the HTTP response code
            } else {
                $message = "Nothing change in data";
                $response = array('status' => FALSE, 'message' => $message);
                $this->response($response, 400);
            }
        }
    }

    //forgot password
    function userforgotPassword_post() {
        $this->input->post();
        $this->form_validation->set_rules('forgotEmail', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'message' => $message);
            $this->response($response, 400);
        } else {

            $email = $this->input->post('forgotEmail');

            if ($email) {
                $query = "SELECT * FROM (`app_users`) WHERE `email` =  '$email'";
                $users = $this->main_content_model->customQuery($query);
                
                if ($users) {
                    $length = 10;
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, strlen($characters) - 1)];
                    }
                    $password = md5($randomString);

                    $arrayData = array(
                        'password' => $password
                    );
                    $updateOptions = array(
                        'where' => array('email' => $users[0]->email),
                        'data' => $arrayData,
                        'table' => 'app_users'
                    );

                    $passwordUpdate = $this->main_content_model->customUpdate($updateOptions);

                    if ($passwordUpdate) {
                        $this->email->from('forgot@froyofit.com', 'Team Froyofit');
                        $this->email->to($email);
                        //        $this->email->bcc('them@their-example.com');

                        $this->email->subject("Froyofit");
                        $this->email->message("Dear {$users[0]->name},
                        Kindly note down your new Password to log on to our website :
                        Password : $randomString
                        Thank you
                        Team Froyofit.");
                        $send = $this->email->send();
                    }
                    if ($passwordUpdate && $send) {
                        $msg = "A new password has been sent to your e-mail address..";
                        $response = array('status' => TRUE, 'message' => $msg);
                        $this->response($response, 200); // 200 being the HTTP response code
                    } else {
                        $message = "Password is not send";
                        $response = array('status' => FALSE, 'message' => $message);
                        $this->response($response, 400);
                    }
                } else {
                    $message = "Email id does'nt exist";
                    $response = array('status' => FALSE, 'message' => $message);
                    $this->response($response, 400);
                }
            }
        }
    }

    //update image
    function updateImage_post() {

        $this->form_validation->set_rules('id', 'User Id', 'trim|required');
        $this->form_validation->set_rules('account_type', 'Account Type', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->validation_post_warning());
            $this->response($responce, 400);
        } else {

            $id = $this->input->post('id');
            $account_type = $this->input->post('account_type');
            $imageUrl = $this->input->post('image');

            if ($imageUrl != '') {
                $imageName = 'user_' . $id . '_' . time() . '.png';
                $imageUrl = $this->main_content_model->getImageBase64Code($imageUrl);
                $this->load->library('S3');

                if ($this->s3->putObjectString($imageUrl, 'froyofit', $imageName, S3::ACL_PUBLIC_READ)) {
                    $userImageUrl = 'http://froyofit.s3.amazonaws.com/' . $imageName;
                }
            }

            $update_user['image'] = $userImageUrl;

            $updateOptions = array
                (
                'where' => array('id' => $id, 'account_type' =>$account_type),
                'data' => $update_user,
                'table' => 'app_users'
            );

            $isUpdated = $this->main_content_model->customUpdate($updateOptions);
            $msg = "";
            if ($isUpdated) {
                $msg = "Image upload successfully";
            } else {
                $msg = "Error in uploading";
            }
            $result = array("image" => $userImageUrl);
            $response = array('status' => TRUE, 'message' => $msg, 'result' => $result);
            $this->response($response, 200);
        }
    }
    
    function updateServiceImage_post() {
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $this->validation_post_warning());
            $this->response($responce, 400);
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $imageUrl = $this->input->post('image');

            if ($imageUrl != '') {
                $imageName = 'service_' . $name . '_' . time() . '.png';
                $imageUrl = $this->main_content_model->getImageBase64Code($imageUrl);
                $this->load->library('S3');

                if ($this->s3->putObjectString($imageUrl, 'froyofit', $imageName, S3::ACL_PUBLIC_READ)) {
                    $userImageUrl = 'http://froyofit.s3.amazonaws.com/' . $imageName;
                }
            }

            $update_user['serviceIcon'] = $userImageUrl;

            $updateOptions = array
                (
                'where' => array('serviceId' => $id),
                'data' => $update_user,
                'table' => 'services'
            );

            $isUpdated = $this->main_content_model->customUpdate($updateOptions);
            $msg = "";
            if ($isUpdated) {
                $msg = "Image upload successfully";
            } else {
                $msg = "Error in uploading";
            }
            $result = array("image" => $userImageUrl);
            $response = array('status' => TRUE, 'message' => $msg, 'result' => $result);
            $this->response($response, 200);
        }
    }
}

/* End of file welcome.php */

