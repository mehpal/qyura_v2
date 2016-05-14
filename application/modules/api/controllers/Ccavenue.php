<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class Ccavenue extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        //$this->load->library('session');
        $this->load->helper('crypto_helper');
        $this->load->model(array('Ccavenue_model'));
    }

    function Ccavenue_Request_post() {

        $working_key = '3794D9838D0C5C87EB4F80E843D63715'; //Shared by CCAVENUES 
        $access_code = 'AVHP64DB16BW48PHWB'; //Shared by CCAVENUES

        $integration_type = "iframe_normal";
        $merchant_id = "91637";
        $currency = "INR";
//        $redirect_url = "http://qyura.com/ccavenue/IFRAME_KIT/ccavResponseHandler.php";
//        $cancel_url = "http://qyura.com/ccavenue/IFRAME_KIT/ccavResponseHandler.php&language=EN";
        $redirect_url = site_url() . "/ccavenue/ccavenue_response";
        $cancel_url = site_url() . "/ccavenue/ccavenue_cancel";

//        $this->bf_form_validation->set_rules('specialitiesId', 'Specialities Id', 'xss_clean|numeric|required|trim');
//        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_date');
//        $this->bf_form_validation->set_rules('preferedTimeId', 'Prefered time', 'xss_clean|required|trim|numeric'); //docTimeDayId
//        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim'); // Loged In user Id
//        $this->bf_form_validation->set_rules('memberId', 'Member Id', 'xss_clean|numeric|required|trim'); // 0 =Self as patient
//        $this->bf_form_validation->set_rules('doctorType', 'Doctor Type', 'xss_clean|numeric|required|trim'); //1 Hos /2 Dig /3 ind
//        $this->bf_form_validation->set_rules('doctorId', 'Doctor Id', 'xss_clean|numeric|required|trim'); // Doctor Profile Id
//        $this->bf_form_validation->set_rules('parentId', 'Mi Id', 'xss_clean|numeric|required|trim'); // 0=indi Doctor
//        $this->bf_form_validation->set_rules('consulationFee', 'consulationFee', 'xss_clean|required|trim|numeric');
//        $this->bf_form_validation->set_rules('tax', 'tax', 'xss_clean|trim|numeric');
//        $this->bf_form_validation->set_rules('remark', 'Remark', 'xss_clean|required|trim|max_length[100]'); // Remark
//
//        if ($this->bf_form_validation->run($this) == FALSE) {
//            // setup the input
//            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
//            $this->response($response, 400);
//        } else {
//            $specialitiesId = isset($_POST['specialitiesId']) ? $this->input->post('specialitiesId') : '';
//            $preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '';
//            $preferedTimeId = isset($_POST['preferedTimeId']) ? $this->input->post('preferedTimeId') : ''; //SessionId of slots
//            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
//            $memberId = isset($_POST['memberId']) ? $this->input->post('memberId') : 0;
//            $doctorType = isset($_POST['doctorType']) ? $this->input->post('doctorType') : '';
//            $doctorUserId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '';
//            $parentId = isset($_POST['parentId']) ? $this->input->post('parentId') : 0;
//            $consulationFee = isset($_POST['consulationFee']) ? $this->input->post('consulationFee') : 0;
//            $tax = isset($_POST['tax']) ? $this->input->post('tax') : 0;
//            $remark = isset($_POST['remark']) ? $this->input->post('remark') : '';

        $specialitiesId = isset($_POST['specialitiesId']) ? $this->input->post('specialitiesId') : '38';
        $preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '2016-08-08';
        $preferedTimeId = isset($_POST['preferedTimeId']) ? $this->input->post('preferedTimeId') : '2'; //SessionId of slots
        $userId = isset($_POST['userId']) ? $this->input->post('userId') : '14';
        $memberId = isset($_POST['memberId']) ? $this->input->post('memberId') : 0;
        $doctorType = isset($_POST['doctorType']) ? $this->input->post('doctorType') : '2';
        $doctorUserId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '8';
        $parentId = isset($_POST['parentId']) ? $this->input->post('parentId') : 10;
        $consulationFee = isset($_POST['consulationFee']) ? $this->input->post('consulationFee') : 5;
        $tax = isset($_POST['tax']) ? $this->input->post('tax') : 5;
        $remark = isset($_POST['remark']) ? $this->input->post('remark') : 'test rem';


            $tax_amount = ($consulationFee / 100) * $tax;
            $total_amount = ($consulationFee + $tax_amount);

            $correctSlot = 1;
            $day = getDay(date("l", strtotime($preferedDate)));
            $order_id = "QYURA" . rand(0, 9);
            if ($correctSlot) {

                /* $unique_id = 'APDOC'. $userId . rand(0, 999);
                  $data = array(
                  'doctorAppointment_unqId' => $unique_id,
                  'doctorAppointment_specialitiesId' => $specialitiesId,
                  'doctorAppointment_date' => strtotime($preferedDate),
                  'doctorAppointment_pntUserId' => $userId,
                  'doctorAppointment_memberId' => $memberId,
                  'doctorAppointment_doctorUserId' => $doctorUserId,
                  "doctorAppointment_docType"=>$doctorType,
                  'doctorAppointment_doctorParentId' => $parentId,
                  'doctorAppointment_ptRmk' => $remark,
                  'doctorAppointment_slotId' => $preferedTimeId,
                  'doctorAppointment_totPayAmount' => $total_amount,
                  //'doctorAppointment_payMode' => 17,
                  'doctorAppointment_payStatus' => 15,
                  'creationTime' => time(),
                  'status' => 11
                  );

                  $response = $this->doctorBooking_model->bookAppointment('qyura_doctorAppointment',$data);
                  $currentDate = strtotime(date("Y-m-d")); */

                $patdata = $this->Ccavenue_model->fetchPatData(array('pat.patientDetails_usersId' => $userId));
                if (!empty($patdata)) {

                    $billing_name = $patdata->patientDetails_patientName;
                    $billing_address = $patdata->patientDetails_address;
                    $billing_city = $patdata->city_name;
                    $billing_state = $patdata->state_statename;
                    $billing_zip = $patdata->patientDetails_pin;
                    $billing_country = $patdata->country;
                    $billing_tel = $patdata->patientDetails_mobileNo;
                    $billing_email = $patdata->users_email;

                    $avenuedata = array(
                        "merchant_id" => $merchant_id,
                        "order_id" => $order_id,
                        "amount" => $total_amount,
                        "currency" => $currency,
                        "redirect_url" => $redirect_url,
                        "cancel_url" => $cancel_url,
                        "billing_name" => $billing_name,
                        "billing_address" => $billing_address,
                        "billing_city" => $billing_city,
                        "billing_state" => $billing_state,
                        "billing_zip" => $billing_zip,
                        "billing_country" => $billing_country,
                        "billing_tel" => $billing_tel,
                        "billing_email" => $billing_email,
                        "merchant_param1" => "123",
                        "customer_identifier" => $userid,
                        "integration_type" => "iframe_normal"
                    );
                    foreach
                    (
                    $avenuedata as $key => $value) {
                        $merchant_data.=$key . '=' . $value . '&';
                    }

                    $encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.
                    ?>
                    <form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                        <?php
                        echo "<input type=hidden name=encRequest value=$encrypted_data>";
                        echo "<input type=hidden name=access_code value=$access_code>";
                        ?>
                    </form>
                    <script language='javascript'>document.redirect.submit();</script>
                    <?php
                } else {
                    $response = array('status' => FALSE, 'message' => 'Patient details not found!');
                    $this->response($response, 200);
                }
            }
       // }
    }

    function ccavenue_response() {

        error_reporting(0);

        $workingKey = '3794D9838D0C5C87EB4F80E843D63715';  //Working Key should be provided here.
        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        echo "<center>";

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);

            if ($i == 0)
                $order_id = $information[1];
            if ($i == 1)
                $tracking_id = $information[1];
            if ($i == 2)
                $bank_ref_no = $information[1];
            if ($i == 3)
                $order_status = $information[1];
            if ($i == 4)
                $failure_message = $information[1];
            if ($i == 5)
                $payment_mode = $information[1];
            if ($i == 6)
                $card_name = $information[1];
            if ($i == 10)
                $totalAmount = $information[1];
        }

        if ($order_status === "Success") {
            $response = array('status' => TRUE, 'message' => "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.");
            $this->response($response, 200);
        } else if ($order_status === "Aborted") {
            $response = array('status' => FALSE, 'message' => "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail");
            $this->response($response, 200);
        } else if ($order_status === "Failure") {
            $response = array('status' => FALSE, 'message' => "Thank you for shopping with us.However,the transaction has been declined.");
            $this->response($response, 200);
        } else {
            $response = array('status' => FALSE, 'message' => "Security Error. Illegal access detected.");
            $this->response($response, 200);
        }
    }
    function _check_date($str_in = '')
    {
        $currentDate = strtotime(date("y-m-d"));
        $prfDate = strtotime($str_in);
        if ($prfDate >= $currentDate) {
            return true;
        } else {
            $this->bf_form_validation->set_message('_check_date', 'Please select post date for booking!!');
            return false;
        }
    }

}
