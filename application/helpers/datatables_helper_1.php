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
?>