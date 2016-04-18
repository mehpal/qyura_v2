<?php defined('BASEPATH') OR exit('No direct script access allowed.');

 function getDistance($lat,$lng, $preLat, $preLong){
        //  return $lat; die();    
        $R = 6371; // Radius of the earth in km
        $dLat = deg2rad($lat - $preLat);  // deg2rad below
        $dLon = deg2rad($lng - $preLong); 

        $a = sin($dLat/2) *  sin($dLat/2) +  cos(deg2rad($lat)) * cos(deg2rad($preLat)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
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
function getYearBtTwoDate($datetime1,$datetime2){
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
      $days = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday');
      return $days[$number]; // we subtract 1 to make "0" match "Monday", "1" match "Tuesday"
 }
 
   function getDoctorAvailibilitySession($number){
     $session = array('Morning','Afternoon','Evening','Night');
     return $session[$number];
  }
  
  function getDay($day){
    $days = array('Monday' => 0, 'Tuesday' => 1, 'Wednesday' => 2, 'Thursday' => 3, 'Friday' => 4, 'Saturday' => 5, 'Sunday' => 6);
    return $days[$day];
}

if ( ! function_exists('createImage'))
{
    function createImage($img,$path,$name=null)
    {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);

        $data = base64_decode($img);

        if($name == null)
        $name = time().'.png';

        $success = file_put_contents($path.$name, $data);
        
        if($success)
            return $name;
        
        return $success;
    }
}


if ( ! function_exists('replaceStr'))
{
    function replaceStr($str="", $repTo = NULL,$repWith = NULL)
    {
        if($repTo != NULL && $repWith != NULL && $str != ''){ 
            $str = str_replace($repTo, $repWith, $str);
            
            return $str;
        }else{
            return FALSE;    
        }
    }
}


if ( ! function_exists('dateFormate'))
{
    function dateFormate($strToTime)
    {
        
        return date("m  D, Y g:i A",$strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }
}


if ( ! function_exists('dateFormateConvert'))
{
    function dateFormateConvert($strToTime)
    {
        
        return date("M d, Y",$strToTime);
        //return date("Y-m-d H:i:s",$strToTime);
    }
}

if ( ! function_exists('checkStatus'))
{
    function checkStatus($status,$id)
    {
        if($status == 1){

	    $btn  = '<a onClick="enableDisableFn('.$status.','.$id.')" href="#" class="btn btn-success waves-effect waves-light m-b-5 applist-btn">Active</a>';		
            return $btn;

        }else{
	    $btn  = '<a href="#" onClick="enableDisableFn('.$status.','.$id.')" class="btn btn-danger waves-effect waves-light m-b-5 applist-btn">Inactive</a>';		
            return $btn;

        }
        
        //return date("Y-m-d H:i:s",$strToTime);
    }
}

if ( ! function_exists('isUnique'))
{
    function isUnique()
    {
        $default = "QYURA";
        $random = rand(0,999);
        return $default.$random;
    }
}

if ( ! function_exists('getSession'))
{
    function getSession($timeSlot){
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


if ( ! function_exists('getStatus'))
{
    function getStatus($status)
    {
      return  isset($status) && $status == 1 ? 'Active' : 'Deactive';
        
    }
}

if ( ! function_exists('getOppStatus'))
{
    function getOppStatus($status)
    {
      return  isset($status) && $status == 0 ? 'Enable' : 'Disable';
        
    }
}


if ( ! function_exists('getGender'))
{
    function getGender($gender)
    {
      if($gender == 'M' || $gender == 1){
          return 'Male';
      }elseif($gender == 'F' || $gender == 2){
          return 'Female';
      }elseif($gender == '3'){
          return 'Other';
      }else{
          return 'Male';
      }
        
    }
}

if ( ! function_exists('isConvertDays'))
{
    function isConvertDays($days = '')
    {
        
    $convert = $days; // days you want to convert

    $years = ($convert / 365) ; // days / 365 days
    $years = floor($years); // Remove all decimals

    $month = ($convert % 365) / 30.5; // I choose 30.5 for Month (30,31) ;)
    $month = floor($month); // Remove all decimals

    $days = ($convert % 365) % 30.5; // the rest of days

    if(!empty($years)){
        return $years.' years '.$month.' month '.$days.' days';
    }elseif(!empty($month)){
      return $month.' month '.$days.' days';  
    }else{
       return $days.' days'; 
    }

    }
}

if ( ! function_exists('isTimeCalculate'))
{
    function isTimeCalculate($times = '')
    {
        
        
        $currenttime = strtotime(date('H:i:s'));
        $time = strtotime($times);
        $totalMin = round(abs($time - $currenttime) / 60,2);
        if($totalMin > 1){
        $format = '%2d Hours %02d Minutes';
            $hours = floor($totalMin / 60);
            $minutes = ($totalMin % 60);
            
            return sprintf($format, $hours, $minutes);  
         
        }else{
            return "0 Hours";
        }

    }
}

if ( ! function_exists('isStr'))
{
    function isStr($text = '')
    {
        
        
      return substr($text,0,150);

    }
}


if ( ! function_exists('getDateFormat'))
{
    function getDateFormat($dateTime)
    {
      return  isset($dateTime) ?  date('F d, Y', $dateTime) : '';
        
    }
}

if ( ! function_exists('getBookQuoteStatus'))
{
    function getBookQuoteStatus($convertStatus)
    {
        if($convertStatus == '2'){
            return 'Not Converted';
        }
        elseif($convertStatus == '4'){
            return 'Converted';
        }       
    }
}


if ( ! function_exists('getQuoteStatus'))
{
    function getQuoteStatus($qStatus)
    {
      return  isset($qStatus) && $qStatus == 1 ? 'Sent' : 'Pending';
        
    }
}

if ( ! function_exists('isBlank'))
{
    function isBlank($val)
    {
      return  isset($val) && $val != '' && $val != 0  ?  '| '. $val.' Years'  : '| '.'NA';
        
    }
}


/* ================= Function Regards the Time slot of Doctor ==================== */

if(!function_exists("getStr")){
    function getStr($time){
        $nowDate = date("Y-m-d");
        $getStr = strtotime($nowDate . " ". $time);
        return $getStr;
    }
}

if ( ! function_exists('convertNumberToSession'))
{
    function convertNumberToSession($number){
        $session = array('Morning'=>0,'Afternoon'=>1,'Evening'=>2,'Night'=>3);
        return $session[$number];
    }
}


if(!function_exists("getNextDayStr")){
    function getNextDayStr($time){
        $nexDate = date("Y-m-d",strtotime(' +1 day'));
        $getStr = strtotime($nexDate . " ". $time);
        return $getStr;
    }
}

if(!function_exists("defalutTimeSlots")){
    function defalutTimeSlots(){
        $defaultSlot  = array();
        for($k=0;$k<3;$k++){
            
            $startTime = "";
            $endTime = "";
            
            switch($k){
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
            
            $defaultSlot[] = array("id"=>$k,"start"=>$startTime,"end"=>$endTime,"session"=> getDoctorAvailibilitySession($k));
        }
        return $defaultSlot;
    }

        if ( ! function_exists('timeFn'))
    {
        function timeFn($strToTime)
        {

            return date("g:i A",$strToTime);
            //return date("Y-m-d H:i:s",$strToTime);
        }
    }

    if ( ! function_exists('dateFn'))
    {
        function dateFn($strToTime)
        {
            return date("m  D, Y",$strToTime);
            //return date("Y-m-d H:i:s",$strToTime);
        }
    }

    if ( ! function_exists('gendor'))
    {
        function gender($gender)
        { 
            $gender = strtolower($gender);
            $genders = array('m' => "Male", 'f' => "Female", 'o' => "Other", 0 => "Male",1 => "Male", 2 => "Female", 3 => "Other");
            return $genders[$gender];
        }
    }

    if ( ! function_exists('calAge'))
    {
        function calAge($dob)
        {
            $date = dateFn($dob);
            $age = date_diff(date_create($date), date_create('today'))->y;
            return $age;
        }
    }

    if ( ! function_exists('status'))
    {
       function status($stat){
         $status = array(1 => 'Pending', 2 => 'Confirm', 3 => 'Cancle', 4 => 'Completed');
         return $status[$stat];
      }
    }
}
    ?>
