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

        $workingkey = '3794D9838D0C5C87EB4F80E843D63715'; //Shared by CCAVENUES 
        $access_code = 'AVHP64DB16BW48PHWB'; //Shared by CCAVENUES
        $merchant_id = "91637";

                        dump($workingkey  );die();

        $integration_type = "iframe_normal";

        $currency = "INR";

        $redirect_url = site_url() . "/api/ccavenue/ccavenue_response";
        $cancel_url = site_url() . "/api/ccavenue/ccavenue_cancel";

        $this->bf_form_validation->set_rules('specialitiesId', 'Specialities Id', 'xss_clean|numeric|required|trim');
        $this->bf_form_validation->set_rules('preferedDate', 'Prefered Date', 'xss_clean|required|trim|max_length[11]|valid_date[y-m-d,-]|callback__check_date');
        $this->bf_form_validation->set_rules('preferedTimeId', 'Prefered time', 'xss_clean|required|trim|numeric'); //docTimeDayId
        $this->bf_form_validation->set_rules('userId', 'User Id', 'xss_clean|numeric|required|trim'); // Loged In user Id
        $this->bf_form_validation->set_rules('memberId', 'Member Id', 'xss_clean|numeric|required|trim'); // 0 =Self as patient
        $this->bf_form_validation->set_rules('doctorType', 'Doctor Type', 'xss_clean|numeric|required|trim'); //1 Hos /2 Dig /3 ind
        $this->bf_form_validation->set_rules('doctorId', 'Doctor Id', 'xss_clean|numeric|required|trim'); // Doctor Profile Id
        $this->bf_form_validation->set_rules('parentId', 'Mi Id', 'xss_clean|numeric|required|trim'); // 0=indi Doctor
        $this->bf_form_validation->set_rules('consulationFee', 'consulationFee', 'xss_clean|required|trim|numeric');
        $this->bf_form_validation->set_rules('tax', 'tax', 'xss_clean|trim|numeric');
        $this->bf_form_validation->set_rules('remark', 'Remark', 'xss_clean|required|trim|max_length[100]'); // Remark

        if ($this->bf_form_validation->run($this) == FALSE) {
            // setup the input
            $response = array('status' => FALSE, 'message' => $this->validation_post_warning());
            $this->response($response, 400);
        } else {
            $specialitiesId = isset($_POST['specialitiesId']) ? $this->input->post('specialitiesId') : '';
            $preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '';
            $preferedTimeId = isset($_POST['preferedTimeId']) ? $this->input->post('preferedTimeId') : ''; //SessionId of slots
            $userId = isset($_POST['userId']) ? $this->input->post('userId') : '';
            $memberId = isset($_POST['memberId']) ? $this->input->post('memberId') : 0;
            $doctorType = $center_type = isset($_POST['doctorType']) ? $this->input->post('doctorType') : '';
            $doctorUserId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '';
            $parentId = $miuser_id = isset($_POST['parentId']) ? $this->input->post('parentId') : 0;
            $consulationFee = isset($_POST['consulationFee']) ? $this->input->post('consulationFee') : 0;
            $tax = isset($_POST['tax']) ? $this->input->post('tax') : 0;
            $remark = isset($_POST['remark']) ? $this->input->post('remark') : '';

//$specialitiesId = isset($_POST['specialitiesId']) ? $this->input->post('specialitiesId') : '38';
//$preferedDate = isset($_POST['preferedDate']) ? $this->input->post('preferedDate') : '2016-05-15';
//$preferedTimeId = isset($_POST['preferedTimeId']) ? $this->input->post('preferedTimeId') : '62'; //SessionId of slots
//$userId = isset($_POST['userId']) ? $this->input->post('userId') : '14';
//$memberId = isset($_POST['memberId']) ? $this->input->post('memberId') : 10;
//$doctorType = $centertype = isset($_POST['doctorType']) ? $this->input->post('doctorType') : '1';
//$doctorUserId = isset($_POST['doctorId']) ? $this->input->post('doctorId') : '40';
//$parentId = $miuser_id = isset($_POST['parentId']) ? $this->input->post('parentId') : 45;
//$consulationFee = isset($_POST['consulationFee']) ? $this->input->post('consulationFee') : 5;
//$tax = isset($_POST['tax']) ? $this->input->post('tax') : 5;
//$remark = isset($_POST['remark']) ? $this->input->post('remark') : 'test rem';


            $tax_amount = ($consulationFee / 100) * $tax;
            $total_amount = ($consulationFee + $tax_amount);

            $correctSlot = 1;
            $day = getDay(date("l", strtotime($preferedDate)));

            if ($correctSlot) {

//                $midata = $this->Ccavenue_model->fetchMIdata($centertype,$miid);
//
//                if(!empty($midata))
//                    $miuser_id = $midata->miuserid;
//                else
//                {
//                    $response = array('status' => FALSE, 'message' => 'MI details not found!');
//                    $this->response($response, 200);
//                }

                $pay_mode = "CCA";

                $records_array1 = array(
                    'creationTime' => strtotime(date('Y-m-d H:i:s')),
                    'doctorAppointment_payMode' => $pay_mode,
                    'doctorAppointment_payStatus' => 15,
                    'doctorAppointment_totPayAmount' => $total_amount,
                    'doctorAppointment_tax' => $tax_amount,
                    //'doctorAppointment_otherFee' => $othr_fee,
                    'doctorAppointment_consulationFee' => $consulationFee,
                    //'doctorAppointment_HMSId' => $hms_id,
                    'doctorAppointment_status' => 11,
                    'doctorAppointment_ptRmk' => $remark,
                    'doctorAppointment_doctorParentId' => $miuser_id,
                    'doctorAppointment_memberId' => $memberId,
                    'doctorAppointment_docType' => $doctorType,
                    'doctorAppointment_doctorUserId' => $doctorUserId,
                    'doctorAppointment_pntUserId' => $userId,
                    //'doctorAppointment_finalTiming' => $final_time,
                    'doctorAppointment_slotId' => $preferedTimeId,
                    //'doctorAppointment_session' => $time_session,
                    'doctorAppointment_date' => strtotime($preferedDate),
                    'doctorAppointment_specialitiesId' => $specialitiesId
                );

                $options = array(
                    'data' => $records_array1,
                    'table' => 'qyura_doctorAppointment'
                );
                $qyura_doctorAppointment = $this->common_model->customInsert($options);

                $cronItemId = $qyura_doctorAppointment;

                $where = array('doctorAppointment_id' => $qyura_doctorAppointment);
                $orderno = $update_data['doctorAppointment_unqId'] = $docUnId = 'APDOC' . $user_id . rand(0, 999);
                $options = array(
                    'table' => 'qyura_doctorAppointment',
                    'where' => $where,
                    'data' => $update_data
                );
                $update = $this->common_model->customUpdate($options);

//insert data in transaction table

                $crnMsg = $this->lang->line("miappointmentReceived");
                $currentDate = date("d-m-Y");
                $cronArray = array("qyura_fkModuleId" => 1, "qyura_fkUserId" => $userId, "qyura_cronMsg" => $crnMsg, "qyura_cronTitle" => $this->lang->line("miappointmentTag"), "qyura_fkItemId" => $cronItemId, "qyura_cronDate" => $currentDate, "qyura_cronMsgsCreation" => $currentDate);

                $options = array(
                    'data' => $cronArray,
                    'table' => 'qyura_cronMsgs'
                );

                $cronId = $this->common_model->customInsert($options);



                $patdata = $this->Ccavenue_model->fetchPatData(array('pat.patientDetails_usersId' => $userId));

                if (!empty($patdata)) {

                    $billing_name = $patdata->patname;
                    $billing_address = $patdata->patientDetails_address;
                    $billing_city = $patdata->city_name;
                    $billing_state = $patdata->state_statename;
                    $billing_zip = $patdata->patientDetails_pin;
                    $billing_country = $patdata->country;
                    $billing_tel = $patdata->patientDetails_mobileNo;
                    $billing_email = $patdata->users_email;

                    $avenuedata = array(
                        "merchant_id" => $merchant_id,
                        "order_id" => $orderno,
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
                        "merchant_param1" => $userId,
                        "customer_identifier" => $userId,
                        "integration_type" => "iframe_normal"
                    );
                    
                    foreach
                    ($avenuedata as $key => $value) {
                        $merchant_data.=$key . '=' . $value . '&';
                    }
                    $encrypted_data = encrypt($merchant_data, $workingkey); // Method for encrypting the data.
                    $data["encrypted_data"] = $encrypted_data;
                    $data["access_code"] = $access_code;
                        dump($encrypted_data  );die();
                    $res = $this->load->view("api/ccavenue",$data,true);
                    $response = array("status"=>1, $result=>$res);
                    dump($response  );die();
//                    echo json_encode($response);
//                    exit();
                    $this->response($response);
                    ?>
                    <!--form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
                        <?php
                        /*echo "<input type=hidden name=encRequest value=$encrypted_data>";
                        echo "<input type=hidden name=access_code value=$access_code>";*/
                        ?>
                    </form>
                    <script language='javascript'>document.redirect.submit();</script-->
                    <?php
                } else {
                    $response = array('status' => FALSE, 'message' => 'Patient details not found!');
                    $this->response($response, 200);
                }
            }
        }
    }

    function Ccavenue_Response_post() {

        $workingkey = '3794D9838D0C5C87EB4F80E843D63715'; //Shared by CCAVENUES 

        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingkey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);

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
            if ($i == 26)
                $userId = $information[1];
        }
        if ($order_status === "Success") {
            $transaction_array1 = array(
                'creationTime' => strtotime(date('Y-m-d H:i:s')),
                'user_id' => $userId,
                'order_no' => $order_id
            );
            $options = array(
                'data' => $transaction_array1,
                'table' => 'transactionInfo'
            );
            $doc_trasaction = $this->common_model->customInsert($options);
            if ($payment_mode == "Credit Card")
                $payMode = "20";
            if ($payment_mode == "Net banking")
                $payMode = "21";
            if ($payment_mode == "Debit Card")
                $payMode = "22";
            if ($payment_mode == "Cash Card")
                $payMode = "23";
            if ($payment_mode == "Mobile Payment")
                $payMode = "24";
            else
                $payMode = "25"; //AvenuesTest
            $where = array('doctorAppointment_unqId' => $order_id);
            $update_data = array("doctorAppointment_payMode" => $payMode, "doctorAppointment_payStatus" => 16);
            $options = array(
                'table' => 'qyura_doctorAppointment',
                'where' => $where,
                'data' => $update_data
            );
            $update = $this->common_model->customUpdate($options);

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
        print_r($response);
        exit;
    }

    function Ccavenue_Cancel_post() {

        $encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
        $rcvdString = $this->decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);

        $dataSize = sizeof($decryptValues);
        $response = array('status' => FALSE, 'message' => "Request Canceled");
        $this->response($response, 200);
        print_r($response);
        exit;
    }

    function _check_date($str_in = '') {
        $currentDate = strtotime(date("y-m-d"));
        $prfDate = strtotime($str_in);
        if ($prfDate >= $currentDate) {
            return true;
        } else {
            $this->bf_form_validation->set_message('_check_date', 'Please select post date for booking!!');
            return false;
        }
    }

    function encrypt($plainText, $key) {
        $secretKey = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
        $plainPad = pkcs5_pad($plainText, $blockSize);
        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
            $encryptedText = mcrypt_generic($openMode, $plainPad);
            mcrypt_generic_deinit($openMode);
        }
        return bin2hex($encryptedText);
    }

    function decrypt($encryptedText, $key) {
        $secretKey = hextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = hextobin($encryptedText);
        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
        mcrypt_generic_init($openMode, $secretKey, $initVector);
        $decryptedText = mdecrypt_generic($openMode, $encryptedText);
        $decryptedText = rtrim($decryptedText, "\0");
        mcrypt_generic_deinit($openMode);
        return $decryptedText;
    }

//*********** Padding Function *********************

    function pkcs5_pad($plainText, $blockSize) {
        $pad = $blockSize - (strlen($plainText) % $blockSize);
        return $plainText . str_repeat(chr($pad), $pad);
    }

//********** Hexadecimal to Binary function for php 4.0 version ********

    function hextobin($hexString) {
        $length = strlen($hexString);
        $binString = "";
        $count = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            $packedString = pack("H*", $subString);
            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString.=$packedString;
            }

            $count+=2;
        }
        return $binString;
    }

}
