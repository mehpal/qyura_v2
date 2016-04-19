<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class FamilyMemberApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct(); 
        $this->load->model(array('family_model'));
    }
    
    function relationType_get() {
        $relations = $this->family_model->getRelations();

        if(isset($relations) && $relations != NULL){
            $response['status'] = TRUE;
            $response["result"] = $relations;
            $response['msg'] = 'success';
            $this->response($response, 200);
        }else{
            $response['status'] = False;
            $response['msg'] = 'There is no relationship configured!';
            $this->response($response, 400);
        }
    }  

    function addFamilyMember_post() {

        $this->form_validation->set_rules('userId', 'User Id', 'xss_clean|trim|required');
        $this->form_validation->set_rules('name', 'Name', 'xss_clean|trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'xss_clean|trim|required|numeric');
        $this->form_validation->set_rules('age', 'Age', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('relation', 'Relation', 'xss_clean|trim|numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
        
            $userId   = (isset($_POST['userId']) && $_POST['userId'] != "" ) ? $_POST['userId'] : "";
            $name     = (isset($_POST['name']) && $_POST['name'] != "" ) ? $_POST['name'] : "";
            $gender   = (isset($_POST['gender']) && $_POST['gender'] != "" ) ? $_POST['gender'] : "";
            $age      = (isset($_POST['age']) && $_POST['age'] != "" ) ? $_POST['age'] : "";
            $relation = (isset($_POST['relation']) && $_POST['relation'] != "" ) ? $_POST['relation'] : "";
            
            $data = array(
                'usersfamily_usersId'=>$userId,
                'usersfamily_name'=>$name,
                'usersfamily_gender'=>$gender,
                'usersfamily_age'=>$age,
                'usersfamily_relationId'=>$relation,
                'creationTime'=>time()
            );
            
            $memberId = $this->family_model->addMember("qyura_usersFamily",$data);
            
            if(isset($memberId) && $memberId != NULL){
                $response['status'] = TRUE;
                $response['msg'] = 'New member is added successfully!!!';
                $this->response($response, 200);
            }else{
                $response['status'] = False;
                $response['msg'] = 'Sorry, there is an error in adding your family member please try again!!!';
                $this->response($response, 400);
            }
        }  
    }
    
    function editFamilyMember_post() {

        $this->form_validation->set_rules('memberId', 'member Id', 'xss_clean|trim|required|numeric');
        $this->form_validation->set_rules('name', 'Name', 'xss_clean|trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'xss_clean|trim|required|numeric');
        $this->form_validation->set_rules('age', 'Age', 'xss_clean|trim|numeric|required');
        $this->form_validation->set_rules('relation', 'Relation', 'xss_clean|trim|numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
        
            $memberId   = (isset($_POST['memberId']) && $_POST['memberId'] != "" ) ? $_POST['memberId'] : "";
            $name     = (isset($_POST['name']) && $_POST['name'] != "" ) ? $_POST['name'] : "";
            $gender   = (isset($_POST['gender']) && $_POST['gender'] != "" ) ? $_POST['gender'] : "";
            $age      = (isset($_POST['age']) && $_POST['age'] != "" ) ? $_POST['age'] : "";
            $relation = (isset($_POST['relation']) && $_POST['relation'] != "" ) ? $_POST['relation'] : "";
            
            $data = array(
                'usersfamily_name'=>$name,
                'usersfamily_gender'=>$gender,
                'usersfamily_age'=>$age,
                'usersfamily_relationId'=>$relation,
                'modifyTime'=>time()
            );
            
            $where = array("usersfamily_id"=>$memberId);
            $updateId = $this->family_model->editMember("qyura_usersFamily",$data,$where);
            
            if(isset($updateId) && $updateId != 0){
                $response['status'] = TRUE;
                $response['msg'] = 'Member information updated successfully!!!';
                $this->response($response, 200);
            }else{
                $response['status'] = TRUE;
                $response['msg'] = 'There is no changes in member information!';
                $this->response($response, 200);
            }
        }  
    }
    
    function familyMemberList_post() {
        
        $this->form_validation->set_rules('userId', 'User Id', 'xss_clean|trim|required');
        
        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
        
            $userId   = (isset($_POST['userId']) && $_POST['userId'] != "" ) ? $_POST['userId'] : "";
           
            $memberList = $this->family_model->memberList($userId);

            if(isset($memberList) && $memberList != NULL){
                $response['status'] = TRUE;
                $response['data'] = $memberList;
                $response['msg'] = 'Here is the list of family members';
                $this->response($response, 200);
            }else{
                $response['status'] = False;
                $response['msg'] = 'No family member is add in your account!';
                $this->response($response, 400);
            }
        }  
    }
    
    function deleteFamilyMember_post() {
        
        $this->form_validation->set_rules('memberId', 'member Id', 'xss_clean|trim|required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {
        
            $memberId   = (isset($_POST['memberId']) && $_POST['memberId'] != "" ) ? $_POST['memberId'] : "";
           
            $data = array(
                'usersfamily_deleted'=>1
            );
            
            $where = array("usersfamily_id"=>$memberId);
            $updateId = $this->family_model->editMember("qyura_usersFamily",$data,$where);
            
            if(isset($updateId) && $updateId != NULL){
                $response['status'] = TRUE;
                $response['msg'] = 'Family member removed Successfully!!';
                $this->response($response, 200);
            }else{
                $response['status'] = False;
                $response['msg'] = 'Sorry, there is an error in deleting this member!!';
                $this->response($response, 400);
            }
        }  
    }
}
