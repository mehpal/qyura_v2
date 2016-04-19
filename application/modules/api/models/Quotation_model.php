<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Quotation_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    public function myQuotationSelfDetail($quotationId) {

        $option = array(
            'select' => 'qyura_quotations.quotation_familyId,qyura_quotations.quotation_userId,CASE 
 WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) 
 THEN
      qyura_usersFamily.usersfamily_name
 ELSE qyura_patientDetails.patientDetails_patientName END AS `name`,
CASE 
 WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) 
 THEN
      qyura_usersFamily.usersfamily_age
 ELSE 0 END AS  `age`,
 CASE 
 WHEN (`qyura_quotations`.`quotation_familyId` <> 0 ) 
 THEN
      qyura_usersFamily.usersfamily_gender
 ELSE "0" END AS `gender`,qyura_users.users_mobile as mobile,qyura_users.users_email as email

',
            'table' => 'qyura_quotations',
            'join' => array(
                array('qyura_users', 'qyura_users.users_id=qyura_quotations.quotation_userId', 'left'),
                array('qyura_patientDetails', 'qyura_patientDetails.patientDetails_usersId=qyura_users.users_id', 'left'),
                array('qyura_usersFamily', 'qyura_usersFamily.usersfamily_id=qyura_quotations.quotation_familyId', 'left')
            ),
            'where' => array('qyura_quotations.quotation_id' => $quotationId,'qyura_quotations.quotation_deleted'=>0),
            'single' => true
        );

        return $myQuotationSelfDetail = $this->customGet($option);
    }

    public function myQuotationTests($quotationId) {

        $option = array(
            'select' => 'qyura_quotations.quotation_id,qyura_quotationDetailTests.quotationDetailTests_id as testId,qyura_quotationDetailTests.quotationDetailTests_quotationDetailId as qtDetailId,qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId as diagCatId,qyura_diagnosticsCat.diagnosticsCat_catName as diagCatName,qyura_quotationDetailTests.quotationDetailTests_testName as testName,qyura_quotationDetailTests.quotationDetailTests_price as price,qyura_quotationDetailTests.quotationDetailTests_date as dateTime,qyura_quotationDetailTests.quotationDetailTests_instruction as instruction',
            'table' => 'qyura_quotations',
            'join' => array(
                array('qyura_quotationDetailTests', 'qyura_quotationDetailTests.quotationDetailTests_quotationId=qyura_quotations.quotation_id', 'right'),
                array('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_quotationDetailTests.quotationDetailTests_diagnosticCatId', 'left'),
                array('qyura_quotationDetail', 'qyura_quotationDetail.quotationDetail_id=qyura_quotationDetailTests.quotationDetailTests_quotationDetailId', 'left')
            ),
            'where' => array('qyura_quotations.quotation_id' => $quotationId,'qyura_quotations.quotation_deleted'=>0,'qyura_quotationDetailTests.quotationDetailTests_deleted'=>0)
        );

        $quotationTests = $this->customGet($option);
        $finalResult = array();
        if(isset($quotationTests) && $quotationTests != null)
        {
            
            foreach ($quotationTests as $quotationTest)
            {
                $finalTemp = array();
                $finalTemp[] = isset($quotationTest->quotation_id) ? $quotationTest->quotation_id : "";
                $finalTemp[] = isset($quotationTest->testId) ? $quotationTest->testId : "";
                $finalTemp[] = isset($quotationTest->qtDetailId) ? $quotationTest->qtDetailId : "";
                $finalTemp[] = isset($quotationTest->diagCatId) ? $quotationTest->diagCatId : ""; 
                $finalTemp[] = isset($quotationTest->diagCatName) ? $quotationTest->diagCatName : ""; 
                $finalTemp[] = isset($quotationTest->testName) ? $quotationTest->testName : ""; 
                $finalTemp[] = isset($quotationTest->price) ? $quotationTest->price : ""; 
                $finalTemp[] = isset($quotationTest->dateTime) ? $quotationTest->dateTime : ""; 
                $finalTemp[] = isset($quotationTest->instruction) ? $quotationTest->instruction : ""; 
                $finalResult[] = $finalTemp;
            }
            
            return $finalResult;
        }
        else
            return (object)$finalResult;
    }
    
    public function qtTestTotalAmount($quotationId)
    {
        $option = array(
            'select' => 'sum(qyura_quotationDetailTests.quotationDetailTests_price) as price',
            'table' => 'qyura_quotations',
            'join' => array(
                array('qyura_quotationDetailTests', 'qyura_quotationDetailTests.quotationDetailTests_quotationId=qyura_quotations.quotation_id', 'right')
                
            ),
            'where' => array('qyura_quotations.quotation_id' => $quotationId,'qyura_quotations.quotation_deleted'=>0,'qyura_quotationDetailTests.quotationDetailTests_deleted'=>0),
            'limit'=>1,
            'single'=>TRUE
            
        );

        $quotationTests = $this->customGet($option);
        
        return $quotationTests;
    }

}

?>
