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
      $days = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday');
      return $days[$number]; // we subtract 1 to make "0" match "Monday", "1" match "Tuesday"
 }
 
   function getDoctorAvailibilitySession($number){
     $session = array('Morning','Afternoon','Evening', 'Night');
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
 //   function deg2rad($deg) {
  //      return $deg * (pi()/180);
  //  }

    ?>