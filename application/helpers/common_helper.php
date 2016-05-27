<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

function getDistance($lat, $lng, $preLat, $preLong) {
    //  return $lat; die();    
    $R = 6371; // Radius of the earth in km
    $dLat = deg2rad($lat - $preLat);  // deg2rad below
    $dLon = deg2rad($lng - $preLong);

    $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat)) * cos(deg2rad($preLat)) * sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $d = $R * $c; // Distance in km
    return ($d / 1.609344);  // Distance in mi
}

if (!function_exists('getIntrast')) {

    function getIntrast($price, $percentage) {
        return $price + (($price * $percentage) / 100);
    }

}

if (!function_exists('getDiscount')) {

    function getDiscount($price, $percentage) {
        return $price - (($price * $percentage) / 100);
    }

}

if (!function_exists('getYearBtTwoDate')) {

    function getYearBtTwoDate($datetime1, $datetime2) {
        $datetime1 = new DateTime("@$datetime1");

        $datetime2 = new DateTime("@$datetime2");

        $startDate = new DateTime($datetime1->format('Y-m-d'));
        $endDate = new DateTime($datetime2->format('Y-m-d'));

        $difference = $endDate->diff($startDate);

        return $difference->y; // This will print '12' die();
    }

}

function convertNumberToDay($number) {
    $number = trim($number);
    $number = intval($number);
    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    return $days[$number]; // we subtract 1 to make "0" match "Monday", "1" match "Tuesday"
}

function getDoctorAvailibilitySession($number) {
    $session = array('Morning', 'Afternoon', 'Evening', 'Night');
    return $session[$number];
}

function getDay($day = NULL) {
    $days = array('Monday' => 0, 'Tuesday' => 1, 'Wednesday' => 2, 'Thursday' => 3, 'Friday' => 4, 'Saturday' => 5, 'Sunday' => 6);
    if ($day != NULL)
        return $days[$day];
    else
        return $days;
}

if (!function_exists('createImage')) {

    function createImage($img, $path, $name = null) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);

        $data = base64_decode($img);

        if ($name == null)
            $name = time() . '.png';

        $success = file_put_contents($path . $name, $data);

        if ($success)
            return $name;

        return $success;
    }

}


if (!function_exists('replaceStr')) {

    function replaceStr($str = "", $repTo = NULL, $repWith = NULL) {
        if ($repTo != NULL && $repWith != NULL && $str != '') {
            $str = str_replace($repTo, $repWith, $str);

            return $str;
        } else {
            return FALSE;
        }
    }

}


if (!function_exists('dateFormate')) {

    function dateFormate($strToTime) {

        return date("m  D, Y g:i A", $strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }

}


if (!function_exists('dateFormateConvert')) {

    function dateFormateConvert($strToTime) {

        return date("M d, Y", $strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }

}

if (!function_exists('checkStatus')) {

    function checkStatus($status, $id) {
        if ($status == 1) {

            $btn = '<a onClick="enableDisableFn(' . $status . ',' . $id . ')" href="#" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Active</a>';
            return $btn;
        } else {
            $btn = '<a href="#" onClick="enableDisableFn(' . $status . ',' . $id . ')" class="btn btn-danger waves-effect waves-light m-b-5 applist-btn">Inactive</a>';
            return $btn;
        }

        //return date("Y-m-d H:i:s",$strToTime);
    }

}

if (!function_exists('isUnique')) {

    function isUnique() {
        $default = "QYURA";
        $random = rand(0, 999);
        return $default . $random;
    }

}

if (!function_exists('getSession')) {

    function getSession($timeSlot) {
        switch ($timeSlot) {
            case 0:
                $session = "Morning";
                break;
            case 1:
                $session = "Afternoon";
                break;
            case 2:
                $session = "Evening";
                break;
            case 3:
                $session = "Night";
                break;
            default:
                $session = "Session is not aloated";
        }
        return $session;
    }

}


if (!function_exists('getStatus')) {

    function getStatus($status) {
        return isset($status) && $status == 1 ? 'Active' : 'Deactive';
    }

}

if (!function_exists('getOppStatus')) {

    function getOppStatus($status) {
        return isset($status) && $status == 0 ? 'Enable' : 'Disable';
    }

}


if (!function_exists('getGender')) {

    function getGender($gender) {
        if ($gender == 'M' || $gender == 1) {
            return 'Male';
        } elseif ($gender == 'F' || $gender == 2) {
            return 'Female';
        } elseif ($gender == '3') {
            return 'Other';
        } else {
            return 'Male';
        }
    }

}

if (!function_exists('isConvertDays')) {

    function isConvertDays($days = '') {

        $convert = $days; // days you want to convert

        $years = ($convert / 365); // days / 365 days
        $years = floor($years); // Remove all decimals

        $month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
        $month = floor($month); // Remove all decimals

        $days = ($convert % 365) % 30.5; // the rest of days

        if (!empty($years)) {
            return $years . ' years ' . $month . ' month ' . $days . ' days ago';
        } elseif (!empty($month)) {
            return $month . ' month ' . $days . ' days ago';
        } else {
            if ($days == 0) {
                return $days . ' days ago';
            } else {
                return $days . ' days ago';
            }
        }
    }

}

if (!function_exists('isTimeCalculate')) {

    function isTimeCalculate($times = '') {


        $currenttime = strtotime(date('H:i:s'));
        $time = strtotime($times);
        $totalMin = round(abs($time - $currenttime) / 60, 2);
        if ($totalMin > 1) {
            $format = '%2d Hours %02d Minutes';
            $hours = floor($totalMin / 60);
            $minutes = ($totalMin % 60);

            return sprintf($format, $hours, $minutes);
        } else {
            return "0 Hours";
        }
    }

}

if (!function_exists('isStr')) {

    function isStr($text = '') {


        return substr($text, 0, 150);
    }

}


if (!function_exists('getDateFormat')) {

    function getDateFormat($dateTime) {
        return isset($dateTime) ? date('F d, Y', $dateTime) : '';
    }

}


if (!function_exists('getDateFormatUser')) {

    function getDateFormatUser($dateTime) {
        return isset($dateTime) ? date('M d, Y', $dateTime) : '';
    }

}

if (!function_exists('getBookQuoteStatus')) {

    function getBookQuoteStatus($convertStatus) {
        if ($convertStatus == '2') {
            return 'Not Converted';
        } elseif ($convertStatus == '4') {
            return 'Converted';
        }
    }

}


if (!function_exists('getQuoteStatus')) {

    function getQuoteStatus($qStatus) {
        $status = '';

        switch ($qStatus) {
            case 11:
                $status = 'Pending';
                break;
            case 12:
                $status = 'Confirmed';
                break;
            case 13:
                $status = 'Canceled';
                break;
            case 14:
                $status = 'Complete';
                break;
            case 15:
                $status = 'Unpaid';
                break;
            case 16:
                $status = 'Paid';
                break;
            case 17:
                $status = 'Cash';
                break;
            case 19:
                $status = 'Expired';
                break;
            case 25:
                $status = 'Sent';
                break;
            case 26:
                $status = 'Not Send';
                break;
        }

        return $status;
    }

}

if (!function_exists('isBlank')) {

    function isBlank($val) {
        return isset($val) && $val != '' && $val != 0 ? '| ' . $val . ' Years' : '| ' . 'NA';
    }

}


/* ================= Function Regards the Time slot of Doctor ==================== */

if (!function_exists("getStr")) {

    function getStr($time) {
        $nowDate = date("Y-m-d");
        $getStr = strtotime($nowDate . " " . $time);
        return $getStr;
    }

}

if (!function_exists('convertNumberToSession')) {

    function convertNumberToSession($number) {
        $session = array('Morning' => 0, 'Afternoon' => 1, 'Evening' => 2, 'Night' => 3);
        return $session[$number];
    }

}


if (!function_exists("getNextDayStr")) {

    function getNextDayStr($time) {
        $nexDate = date("Y-m-d", strtotime(' +1 day'));
        $getStr = strtotime($nexDate . " " . $time);
        return $getStr;
    }

}

if (!function_exists("defalutTimeSlots")) {

    function defalutTimeSlots() {
        $defaultSlot = array();
        for ($k = 0; $k < 3; $k++) {

            $startTime = "";
            $endTime = "";

            switch ($k) {
                case 0:
                    $startTime = "06:00:00";
                    $endTime = "11:59:00";
                    break;
                case 1:
                    $startTime = "12:00:00";
                    $endTime = "17:59:00";
                    break;
                case 2:
                    $startTime = "18:00:00";
                    $endTime = "22:59:00";
                    break;
                case 3:
                    $startTime = "23:00:00";
                    $endTime = "05:59:00";
                    break;
            }

            $defaultSlot[] = array("id" => $k, "start" => $startTime, "end" => $endTime, "session" => getDoctorAvailibilitySession($k));
        }
        return $defaultSlot;
    }

    if (!function_exists('timeFn')) {

        function timeFn($strToTime) {

            return date("g:i A", $strToTime);
            //return date("Y-m-d H:i:s",$strToTime);
        }

    }

    if (!function_exists('dateFn')) {

        function dateFn($strToTime) {
            return date("d M,Y", $strToTime);
            //return date("Y-m-d H:i:s",$strToTime);
        }

    }

    if (!function_exists('gendor')) {

        function gender($gender) {
            $gender = strtolower($gender);
            $genders = array('m' => "Male", 'f' => "Female", 'o' => "Other", 0 => "Male", 1 => "Male", 2 => "Female", 3 => "Other");
            return $genders[$gender];
        }

    }

    if (!function_exists('calAge')) {

        function calAge($dob) {
            $date = dateFn($dob);
            $age = date_diff(date_create($date), date_create('today'))->y;
            return $age;
        }

    }

    if (!function_exists('status')) {

        function status($stat) {
            $status = array(11 => 'Pending', 12 => 'Confirm', 13 => 'Cancle', 14 => 'Completed');
            return $status[$stat];
        }

    }
}

if (!function_exists('statusCheck')) {

    function statusCheck($controller, $table_name, $table_field_name, $table_field_value, $status_value) {
        $template = '';
        if ($status_value == 1) {


            $template = '<a class="btn btn-success waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)" onclick="statusFn(\'' . $controller . '\',\'' . $table_name . '\',\'' . $table_field_name . '\',\'' . $table_field_value . '\',\'' . $status_value . '\')">Active</a>';
        } else {

            $template = '<a class="btn btn-danger waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)" onclick="statusFn(\'' . $controller . '\',\'' . $table_name . '\',\'' . $table_field_name . '\',\'' . $table_field_value . '\',\'' . $status_value . '\')">Inactive</a>';
        }

        return $template;
    }

}

// publish/unpublish function
if (!function_exists('puStatusCheck')) {

    function puStatusCheck($controller, $table_name, $table_field_name, $table_field_value, $status_value) {
        $template = '';
        if ($status_value == 2) {
            $template = '<a class="btn btn-danger waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)" onclick="puStatusFn(\'' . $controller . '\',\'' . $table_name . '\',\'' . $table_field_name . '\',\'' . $table_field_value . '\',\'' . $status_value . '\')">Unverified</a>';
        } else if ($status_value == 0) {
            $template = '<a class="btn btn-danger waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)">Inactive</a>';
        } else if ($status_value == 1) {
            $template = '<a class="btn btn-success waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)">Active</a>';
        } else {

            $template = '<a class="btn btn-primary waves-effect waves-light m-b-5 applist-btn" href="javascript:void(0)">Verified</a>';
        }

        return $template;
    }

}


if (!function_exists('togalHospital')) {

    function togalHospital($timeData) {
        if ($timeData->stayAt == 1) {
            if ($timeData->MItype == 1) {
                return TRUE;
            }

            return FALSE;
        }

        return FALSE;
    }

}

if (!function_exists('togalDiagnostic')) {

    function togalDiagnostic($timeData) {
        if ($timeData->stayAt == 1) {
            if ($timeData->MItype == 2) {
                return TRUE;
            }

            return FALSE;
        }

        return FALSE;
    }

}

if (!function_exists('togalpsChamber')) {

    function togalpsChamber($timeData) {
        if ($timeData->stayAt == 0) {
            return TRUE;
        }

        return FALSE;
    }

}


// get doc exp
if (!function_exists('getDocExp')) {

    function getDocExp($docDate) {
        $date2 = date('Y-m-d');
        if (isset($docDate) && $docDate != NULL) {
            $date1 = $docDate;
        } else {
            $date1 = strtotime(date('Y-m-d'));
        }
        $diff = abs(strtotime($date2) - $date1);
        return $years = floor($diff / (365 * 60 * 60 * 24));
    }

}

if (!function_exists("expYear")) {

    function expYear($date = NULL) {
        $date2 = date('Y-m-d');
        if (isset($date) && $date != NULL) {
            $date1 = $date;
        } else {
            $date1 = strtotime(date('Y-m-d'));
        }
        $diff = abs(strtotime($date2) - $date1);
        $years = floor($diff / (365 * 60 * 60 * 24));
        return $years;
    }

}

if (!function_exists("sendMail")) {

    function sendMail($from, $to, $message) {
        $this->email->from($from, 'Team Froyofit');
        $this->email->to($to);
        $this->email->subject("Froyofit");
        $this->email->message($message);
        $send = $this->email->send();
        if ($send) {
            return '1';
        } else {
            return '0';
        }
    }

}

if (!function_exists("sendSms")) {

    function sendSms($mobileNo, $mess) {
        $post_data = array(
            // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
            // For promotional, this will be ignored by the SMS gateway
            'From' => '08039512095',
            'To' => $mobileNo,
            'Priority' => 'high',
            'Body' => "$mess", //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
        );

        $exotel_sid = "froyo"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
        $exotel_token = "1edf133173574c62525e4bf034b50952f655c799"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings

        $url = "https://" . $exotel_sid . ":" . $exotel_token . "@twilix.exotel.in/v1/Accounts/" . $exotel_sid . "/Sms/send";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));

        $http_result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        if (!empty($http_result) && $http_result != NULL && $error == '') {
            return '1';
        } else {
            return '0';
        }
    }

}

if (!function_exists("smart_wordwrap")) {

    function smart_wordwrap($string, $width = 75, $break = "\n") {
        // split on problem words over the line length
        $pattern = sprintf('/([^ ]{%d,})/', $width);
        $output = '';
        $words = preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        foreach ($words as $word) {
            if (false !== strpos($word, ' ')) {
                // normal behaviour, rebuild the string
                $output .= $word;
            } else {
                // work out how many characters would be on the current line
                $wrapped = explode($break, wordwrap($output, $width, $break));
                $count = $width - (strlen(end($wrapped)) % $width);

                // fill the current line and add a break
                $output .= substr($word, 0, $count) . $break;

                // wrap any remaining characters from the problem word
                $output .= wordwrap(substr($word, $count), $width, $break, true);
            }
        }

        // wrap the final output
        return wordwrap($output, $width, $break);
    }

}

if (!function_exists("getBookStatus")) {

    function getBookStatus($check) {
        $status = "";
        switch ($check) {
            case 1:
                $status = "Pending";
                break;
            case 2:
                $status = "Confirm";
                break;
            case 3:
                $status = "Cancle";
                break;
            case 4:
                $status = "Completed";
                break;
        }

        return $status;
    }

}
?>
