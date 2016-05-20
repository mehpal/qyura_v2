<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('getStatusDropDown')) {

    function getStatusDropDown($status,$selid,$selname) {
    	$Confirmed = ($status == 12)?'selected="selected"':'';
    	$Pending = ($status == 11)?'selected="selected"':'';
        $Expired = ($status == 19)?'selected="selected"':'';
        $Canceled = ($status == 13)?'selected="selected"':'';
        $Complete = ($status == 14)?'selected="selected"':'';
        if($status == 12 || $status == 11){
        $dropdwon  = '<select class = "appstatus form-control status-select" onchange="changestatus('.$selid.','.$selname.',this.value)">
        <option '.$Pending.' value="11">Pending</option>
        <option '.$Confirmed.' value="12">Confirmed</option>
        <option '.$Canceled.' value="13">Cancel</option>
        <option '.$Expired.' value="19">Expired</option>
        <option '.$Complete.' value="14">Completed</option>
        </select>';
        
        }elseif($status == 19){
         $dropdwon = '<input type ="text" value = "Expire" readonly="" class = "form-control" style="max-width:100px">';
               
        }elseif($status == 13){
         $dropdwon = '<input type ="text" value = "Cancel" readonly="" class = "form-control" style="max-width:100px">';
               
        }else{
             $dropdwon = '<input type ="text" value = "Complete" readonly="" class = "form-control" style="max-width:100px">';
            
        }
         return $dropdwon;
    }
    
    

}


if (!function_exists('sendQuoteBtn')) {

    function sendQuoteBtn($qid,$status) {
        
        $disabled =  ($status != 'Not Sent') ? 'disabled="disabled"' : '';
        $sendLink =  ($status != 'Not Sent') ? '#' : site_url('quotation/replyQuotation').'?qid='.$qid;
        
    	$btn = '<a type="button" href="'.$sendLink.'" '.$disabled.' class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Reply On Quote</a>';
        return $btn;
    }
    
    

}

if (!function_exists('viewQuoteBtn')) {

    function viewQuoteBtn($qid,$status) {
        
        $disabled =  ($status != 'Sent') ? 'disabled="disabled"' : '';
        $sendLink =  ($status != 'Sent') ? '#' : site_url('quotation/viewPrescription').'/'.$qid;
        
    	$btn = '<a type="button" href="'.$sendLink.'" '.$disabled.' class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">View Prescription</a>';
        return $btn;
    }
    
    

}


?>
