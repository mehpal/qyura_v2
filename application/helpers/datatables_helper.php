<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('getStatusDropDown')) {

    function getStatusDropDown($status) {
    	$Confirmed = ($status == 0)?'selected="selected"':'';
    	$Pending = ($status == 1)?'selected="selected"':'';
        $dropdwon  = '<select class = "form-control status-select">
        <option '.$Confirmed.' value="1">Confirmed</option>
        <option '.$Pending.' value="2">Pending</option>
        </select>';
        
        return $dropdwon;
    }
    
    

}


if (!function_exists('sendQuoteBtn')) {

    function sendQuoteBtn($qid,$status) {
        
        $disabled =  ($status != 'Not Sent') ? 'disabled="disabled"' : '';
        $sendLink =  ($status != 'Not Sent') ? '#' : site_url('quotation/replyQuotation').'?qid='.$qid;
        
    	$btn = '<a type="button" href="'.$sendLink.'" '.$disabled.' class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Send Quote</a>';
        return $btn;
    }
    
    

}


?>