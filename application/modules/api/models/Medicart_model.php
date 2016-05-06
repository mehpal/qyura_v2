<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Medicart_model extends Common_model {

    public function __construct() {
        parent::__construct();
    }

    function specialityList($lat, $long, $city = NULL) {
//echo "---".$city;die();
        if (isset($city) && $city != NULL) {

            $this->db->select("(CASE WHEN(speciality_display_format = '0') THEN specialities_name ELSE specialities_drName END) as name, specialities_id, CONCAT('assets/specialityImages/3x','/',specialities_img) img,  (SELECT count(medicartSpecialities_medicartId) from qyura_medicartSpecialities JOIN `qyura_medicartOffer` ON `qyura_medicartOffer`.`medicartOffer_id` = `medicartSpecialities_medicartId` where `qyura_medicartOffer`.`status` = 1 AND medicartSpecialities_deleted = 0 AND `qyura_medicartSpecialities`.`status` = 1 AND `medicartSpecialities_specialitiesId` = `specialities_id`) as specialityCount, qyura_medicartOffer.modifyTime, CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_name ELSE qyura_diagnostic.diagnostic_name END AS `MIName`,"
                            . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END AS `lat`,"
                            . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_long ELSE qyura_diagnostic.diagnostic_long END AS `long`, "
                            . '(6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END ) ) * cos( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_long ELSE qyura_diagnostic.diagnostic_long END ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END ) ) )
                ) AS distance')
                    ->from("qyura_specialities")
                    ->join('qyura_medicartSpecialities', 'qyura_medicartSpecialities.medicartSpecialities_specialitiesId=qyura_specialities.specialities_id', "inner")
                    ->join('qyura_medicartOffer', 'qyura_medicartOffer.medicartOffer_id=qyura_medicartSpecialities.medicartSpecialities_medicartId AND `qyura_medicartOffer`.`medicartOffer_cityId` = ' . $city, 'INNER')
                    ->join('qyura_users', 'qyura_users.users_id=qyura_medicartOffer.medicartOffer_MIId', 'left')
                    ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_users.users_id  AND hospital_cityId = ' . $city, 'left')
                    ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_users.users_id  AND diagnostic_cityId = ' . $city, 'left')
                    ->where(array("qyura_specialities.status" => 1, "specialities_deleted" => 0, "type" => 0))
                    ->group_by("specialities_id");

            return $this->db->get()->result();
//            
//            $this->db->get()->result();
//            echo $this->db->last_query();die();
        } else {
            $this->db->select("(CASE WHEN(speciality_display_format = '0') THEN specialities_name ELSE specialities_drName END) as name, specialities_id, CONCAT('assets/specialityImages/3x','/',specialities_img) img,  (SELECT count(medicartSpecialities_medicartId) from qyura_medicartSpecialities JOIN `qyura_medicartOffer` ON `qyura_medicartOffer`.`medicartOffer_id` = `medicartSpecialities_medicartId` where `qyura_medicartOffer`.`status` = 1 AND medicartSpecialities_deleted = 0 AND `qyura_medicartSpecialities`.`status` = 1 AND `medicartSpecialities_specialitiesId` = `specialities_id`) as specialityCount, qyura_medicartOffer.modifyTime, "
                            . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_name ELSE qyura_diagnostic.diagnostic_name END AS `MIName`,"
                            . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END AS `lat`,"
                            . "CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_long ELSE qyura_diagnostic.diagnostic_long END AS `long`, "
                            . '(6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END ) ) * cos( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_long ELSE qyura_diagnostic.diagnostic_long END ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( CASE WHEN (`qyura_hospital`.`hospital_usersId` <> 0 ) THEN qyura_hospital.hospital_lat ELSE qyura_diagnostic.diagnostic_lat END ) ) )
                ) AS distance')
                    ->from("qyura_specialities")
                    ->join('qyura_medicartSpecialities', 'qyura_medicartSpecialities.medicartSpecialities_specialitiesId=qyura_specialities.specialities_id', "inner")
                    ->join('qyura_medicartOffer', 'qyura_medicartOffer.medicartOffer_id = qyura_medicartSpecialities.medicartSpecialities_medicartId', 'inner')
                    ->join('qyura_users', 'qyura_users.users_id=qyura_medicartOffer.medicartOffer_MIId', 'left')
                    ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_users.users_id', 'left')
                    ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_users.users_id', 'left')
                    ->where(array("qyura_specialities.status" => 1, "specialities_deleted" => 0, "type" => 0))
                    ->group_by("specialities_id")
                    ->having(array("distance < " => 60));

            return $this->db->get()->result();
//            $this->db->get()->result();
//            echo $this->db->last_query();die();
        }
    }

    public function getMedlists($option) {
//        dump($option);die();
        $lat = '';
        $long = '';
        $search = '';
        $notin = '';
        $speciality = '';

        extract($option);

        $nowDt = time();

        if (isset($city) && $city != "") {

            $con['qyura_medicartOffer.medicartOffer_cityId'] = $city;
            $con['qyura_medicartOffer.medicartOffer_endDate >'] = $nowDt;
            $con['qyura_medicartOffer.status'] = 1;
            $con['qyura_medicartSpecialities.medicartSpecialities_specialitiesId'] = $speciality;
            $con['qyura_medicartOffer.medicartOffer_range'] = 0;

            $this->db->select('qyura_medicartOffer.medicartOffer_id,'
                            . 'qyura_medicartOffer.medicartOffer_MIId,qyura_medicartOffer.medicartOffer_offerCategory,'
                            . 'qyura_medicartOffer.medicartOffer_title,CONCAT("assets/Medicart","/",qyura_medicartOffer.medicartOffer_image) as medicartOffer_image,'
                            . 'qyura_medicartOffer.medicartOffer_description,qyura_medicartOffer.medicartOffer_allowBooking,'
                            . 'qyura_medicartOffer.medicartOffer_maximumBooking,qyura_medicartOffer.medicartOffer_startDate,'
                            . 'qyura_medicartOffer.medicartOffer_endDate,qyura_medicartOffer.medicartOffer_discount,'
                            . 'qyura_medicartOffer.medicartOffer_ageDiscount,qyura_medicartOffer.medicartOffer_actualPrice,'
                            . 'medicartOffer_totalPrice as medicartOffer_discountPrice,qyura_medicartOffer.medicartOffer_deleted,'
                            . 'qyura_medicartOffer.modifyTime,qyura_hospital.hospital_name,qyura_diagnostic.diagnostic_name,'
                            . 'qyura_medicartOffer.modifyTime,qyura_hospital.hospital_phn,qyura_diagnostic.diagnostic_phn,    
                   qyura_diagnostic.diagnostic_lat,qyura_diagnostic.diagnostic_long,qyura_hospital.hospital_lat,qyura_hospital.hospital_long,')
                    ->from('qyura_medicartOffer')
                    ->join('qyura_offerCat', 'qyura_offerCat.offerCat_id=qyura_medicartOffer.medicartOffer_offerCategory', 'left')
                    ->join('qyura_users', 'qyura_users.users_id=qyura_medicartOffer.medicartOffer_MIId', 'left')
                    ->join('qyura_medicartSpecialities', 'qyura_medicartSpecialities.medicartSpecialities_medicartId=qyura_medicartOffer.medicartOffer_id  AND qyura_medicartSpecialities.medicartSpecialities_specialitiesId = ' . $speciality, "inner")
                    ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_users.users_id', 'left')
                    ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_users.users_id', 'left')
                    ->where($con)
                    ->where_not_in('qyura_medicartOffer.medicartOffer_id', $notIn)
                    ->group_by('qyura_medicartOffer.medicartOffer_id')
                    ->limit(20);
            return $this->db->get()->result();
        } else {

            $con['qyura_medicartOffer.medicartOffer_endDate >'] = $nowDt;
            $con['qyura_medicartOffer.status'] = 1;
            $con['qyura_medicartOffer.medicartOffer_range'] = 0;
            $con['qyura_medicartSpecialities.medicartSpecialities_medicartId'] = $speciality;
            $this->db->select('qyura_medicartOffer.medicartOffer_id,'
                            . 'qyura_medicartOffer.medicartOffer_MIId,qyura_medicartOffer.medicartOffer_offerCategory,'
                            . 'qyura_medicartOffer.medicartOffer_title,CONCAT("assets/Medicart","/",qyura_medicartOffer.medicartOffer_image) as medicartOffer_image, qyura_specialities.specialities_name, '
                            . 'qyura_medicartOffer.medicartOffer_description,qyura_medicartOffer.medicartOffer_allowBooking,'
                            . 'qyura_medicartOffer.medicartOffer_maximumBooking,qyura_medicartOffer.medicartOffer_startDate,'
                            . 'qyura_medicartOffer.medicartOffer_endDate,qyura_medicartOffer.medicartOffer_discount,'
                            . 'qyura_medicartOffer.medicartOffer_ageDiscount,qyura_medicartOffer.medicartOffer_actualPrice,'
                            . 'medicartOffer_totalPrice as medicartOffer_discountPrice,qyura_medicartOffer.medicartOffer_deleted,'
                            . 'qyura_medicartOffer.modifyTime,qyura_hospital.hospital_name,qyura_diagnostic.diagnostic_name,'
                            . 'qyura_medicartOffer.modifyTime,qyura_hospital.hospital_phn,qyura_diagnostic.diagnostic_phn,    
                   qyura_diagnostic.diagnostic_lat,qyura_diagnostic.diagnostic_long,qyura_hospital.hospital_lat,qyura_hospital.hospital_long, (6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( qyura_hospital.hospital_lat ) ) * cos( radians( qyura_hospital.hospital_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( qyura_hospital.hospital_lat ) ) ) ) AS hosDistance, (6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( qyura_diagnostic.diagnostic_lat ) ) * cos( radians( qyura_diagnostic.diagnostic_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( qyura_diagnostic.diagnostic_lat ) ) )
                ) AS diagDistance')
                    ->from('qyura_medicartOffer')
                    ->join('qyura_offerCat', 'qyura_offerCat.offerCat_id=qyura_medicartOffer.medicartOffer_offerCategory', 'left')
                    ->join('qyura_medicartSpecialities', 'qyura_medicartSpecialities.medicartSpecialities_medicartId=qyura_medicartOffer.medicartOffer_id AND qyura_medicartSpecialities.medicartSpecialities_specialitiesId = ' . $speciality, 'INNER')
                    ->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_medicartSpecialities.medicartSpecialities_medicartId', 'INNER')
                    ->join('qyura_users', 'qyura_users.users_id=qyura_medicartOffer.medicartOffer_MIId', 'left')
                    ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_users.users_id', 'left')
                    ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_users.users_id', 'left')
                    ->where($con)
                    ->or_where(array('qyura_diagnostic.diagnostic_deleted' => 0, 'qyura_hospital.hospital_deleted' => 0))
                    ->group_by('qyura_medicartOffer.medicartOffer_id')
                    ->limit(20);

            return $this->db->get()->result();
        }
    }

    public function getMedDetail($medicartOffer_id) {
        $nowDt = time();
        $con = array(
            'qyura_diagnostic.diagnostic_deleted' => 0,
            'qyura_users.users_deleted' => 0,
            'qyura_medicartOffer.medicartOffer_deleted' => 0,
            'qyura_offerCat.offerCat_deleted' => 0,
            'qyura_medicartOffer.medicartOffer_endDate >' => $nowDt,
            'qyura_medicartOffer.medicartOffer_id' => $medicartOffer_id
        );

        $this->db->select('qyura_medicartOffer.medicartOffer_id,'
                        . 'qyura_medicartOffer.medicartOffer_MIId,qyura_medicartOffer.medicartOffer_offerCategory,'
                        . 'qyura_medicartOffer.medicartOffer_title,CONCAT("assets/Medicart","/",qyura_medicartOffer.medicartOffer_image) as medicartOffer_image,'
                        . 'qyura_medicartOffer.medicartOffer_description,qyura_medicartOffer.medicartOffer_allowBooking,'
                        . 'qyura_medicartOffer.medicartOffer_maximumBooking,qyura_medicartOffer.medicartOffer_startDate,'
                        . 'qyura_medicartOffer.medicartOffer_endDate,qyura_medicartOffer.medicartOffer_discount,'
                        . 'qyura_medicartOffer.medicartOffer_ageDiscount,qyura_medicartOffer.medicartOffer_actualPrice,'
                        . 'qyura_medicartOffer.medicartOffer_discountPrice,qyura_medicartOffer.medicartOffer_deleted,'
                        . 'qyura_medicartOffer.modifyTime,qyura_hospital.hospital_name,qyura_diagnostic.diagnostic_name')
                ->from('qyura_medicartOffer')
                ->join('qyura_offerCat', 'qyura_offerCat.offerCat_id=qyura_medicartOffer.medicartOffer_offerCategory', 'left')
                ->join('qyura_users', 'qyura_users.users_id=qyura_medicartOffer.medicartOffer_MIId', 'left')
                ->join('qyura_hospital', 'qyura_hospital.hospital_usersId=qyura_users.users_id', 'left')
                ->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_usersId=qyura_users.users_id', 'left')
                ->where($con)
                ->or_where(array('qyura_diagnostic.diagnostic_deleted' => 0, 'qyura_hospital.hospital_deleted' => 0))
                ->limit(1);
        return $this->db->get()->row();
    }

    public function add($table, $data) {
        $data = $this->_filter_data($table, $data);

        $this->db->insert($table, $data);

        $id = $this->db->insert_id();

        return $id;
    }

    /**
     * booking_check
     *
     * @return bool

     * */
    public function booking_check($where = '') {

        if (empty($where)) {
            return FALSE;
        }

        return $this->db->where($where)
                        ->order_by("medicartBooking_id", "ASC")
                        ->limit(1)
                        ->count_all_results('qyura_medicartBooking') > 0;
    }

    public function getSingleData($where = '', $select = '*') {
        if (empty($where)) {
            return FALSE;
        }

        return $this->db->select($select)->where($where)
                ->order_by("medicartOffer_id", "ASC")
                ->limit(1)
                ->get('qyura_medicartOffer')->row();
    }

    public function totalbookings($medicart) {
        if ($medicart) {
            $this->db->select("count(`medicartBooking_medicartOfferId`) as totalBooking, `medicartOffer_maximumBooking` as allowedBooking")
                ->from("qyura_medicartBooking")
                ->join("qyura_medicartOffer", "qyura_medicartOffer.medicartOffer_id = qyura_medicartBooking.medicartBooking_medicartOfferId")
                ->where(array("medicartBooking_deleted" =>0,"qyura_medicartBooking.status != " =>13,"medicartBooking_medicartOfferId" => $medicart));
            return $this->db->get()->row();
//            $res = $this->db->get();
//            dump($res->row());
//            dump($res->result());
//            echo $this->db->last_query();die();
        } else {
            return 0;
        }
    }

}

?>
