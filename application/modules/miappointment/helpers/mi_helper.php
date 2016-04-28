<?php defined('BASEPATH') OR exit('No direct script access allowed.');
if (!function_exists('detailRouter')) {

    function detailRouter($name,$id,$orderId) {
         switch ($name) {
            case 'Diagnostic':
                return site_url('miappointment/detail').'/'.$id;
            case 'Doctor':
                return site_url('miappointment/healthPkgDetail').'/'.$orderId;
            case 'Health Package':
                return site_url('miappointment/consultingDetail').'/'.$id;
            default:
                return site_url('miappointment');
        }
    }
}
if (!function_exists('reportType')) {
function reportType($name) {
         switch ($name) {
            case 'Diagnostic':
                return 1;
            case 'Doctor':
                return 3;
            case 'Health Package':
                return 2;
            default:
                return 0;
        }
    }
}
