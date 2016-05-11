<?php class DiagonsticCenter_models extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function diaginsticList($lat, $long, $notIn, $isemergency, $radius, $rating, $isHealtPkg, $isConsulting, $userId, $search = null,$cityId=NULL) {

        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';

        $where = array('diagnostic_deleted' => 0, 'usersRoles_roleId' => ROLE_DIAGNOSTICS, 'qyura_diagnostic.status' => 1);
        
        if ($isemergency != '' && $isemergency != NULL && $isemergency == 1) {
            $where['qyura_diagnostic.isEmergency'] = $isemergency;
        }
        
        if ($rating != '' && $rating != NULL && $rating != 0) {
            $having['rat'] = number_format($rating, 1);
        }

        $healtPkg = '';
        $healtPkg = ', (SELECT count(healthPackage_id) from qyura_healthPackage where healthPackage_MIuserId = diagnostic_usersId AND healthPackage_deleted = 0 AND qyura_healthPackage.status = 1) as isHealtPkg';
        if ($isHealtPkg != '' && $isHealtPkg != NULL && $isHealtPkg == 1) {
            $having['isHealtPkg !='] = 0;
        }

        $isConsun = '';
        $isConsun = ', (SELECT count(usersRoles_id) from qyura_usersRoles where usersRoles_parentId = diagnostic_usersId AND usersRoles_roleId = ' . ROLE_DOCTORE . ') as isConsulting';
        if ($isConsulting != '' && $isConsulting != NULL && $isConsulting == 1) {
            $having['isConsulting !='] = 0;
        }

        $this->db->select('qyura_diagnostic.isEmergency,diagnostic_usersId userId,qyura_diagnostic.diagnostic_id as id, (CASE WHEN(fav_userId is not null ) THEN fav_isFav ELSE 0 END) fav, diagnostic_deleted as rat, diagnostic_address adr,diagnostic_name name, CONCAT("0","",diagnostic_phn) as  phn, diagnostic_lat AS lat, diagnostic_long AS long, diagnostic_img imUrl, ( 6371 * acos( cos( radians(' . $lat . ')) * cos( radians(diagnostic_lat)) * cos( radians( diagnostic_long ) - radians( ' . $long . ' )) + sin( radians(' . $lat . ')) * sin( radians(diagnostic_lat)))) AS distance, ' . $healtPkg . ', ' . $isConsun . ',   Group_concat(DISTINCT qyura_diagnosticsCat.diagnosticsCat_catName order by diagnosticsCat_catName ) as diaCat
     ,(
CASE 
 WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
 WHEN (reviews_rating is not null) 
 THEN 
      ROUND( (AVG(reviews_rating)), 1)
 WHEN (qyura_ratings.rating is not null) 
 THEN
      ROUND( (AVG(qyura_ratings.rating)), 1)
 END)
 AS `rat`
')
                ->from('qyura_diagnostic')
                ->join('qyura_diagnosticsHasCat', 'qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticId=qyura_diagnostic.diagnostic_id', 'left')
                ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId', 'left')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->join('qyura_fav', 'qyura_fav.fav_relateId = qyura_diagnostic.diagnostic_usersId AND fav_userId = ' . $userId . '  ', 'left')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_diagnostic.diagnostic_usersId', 'left')
                
                ->where($where)
                ->where_not_in('diagnostic_id', $notIn)
                ->order_by('distance', 'ASC')
                
                ->limit(DATA_LIMIT);
        if(isset($having) && is_array($having)){
 $this->db->having($having);
        }
        if ($cityId != NULL) {
            $cityCon = array('diagnostic_cityId' => $cityId);
            $this->db->where($cityCon);
        } else {
            
            $havingRadius = array('distance <=' => $radius);
            $this->db->having($havingRadius);
        }

        if($search != null){
             $this->db->join('qyura_diagnosticServices', 'qyura_diagnosticServices.diagnosticServices_diagnosticId = qyura_diagnostic.diagnostic_id', 'left');
             
             $this->db->join('qyura_diagnosticSpecialities', 'qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId = qyura_diagnostic.diagnostic_id', 'left');
             $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_diagnosticSpecialities.diagnosticSpecialities_specialitiesId', 'left');
             
             
             
             $searchParams = array('diagnostic_name', 'diagnostic_address', 'specialities_name', 'diagnosticServices_serviceName' , 'diagnosticsCat_catName');
             
             $lkCount = 0;
             foreach ($searchParams as $params){
             if($params == 'diagnostic_name') {
                $this->db->like('('.$params, $search);
                } else {
                    if(count($searchParams)-1 == $lkCount)
                    $this->db->or_like($params, $search,'end',FALSE);
                    else
                    $this->db->or_like($params, $search);
                } 
                $lkCount++;
             }
         }
         
         $this->db->group_by('diagnostic_id');
        
        $response = $this->db->get()->result();
//        echo $this->db->last_query();
//          print_r($response); die();
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {
                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->fav) ? $row->fav : "";
                $finalTemp[] = isset($row->rat) ? $row->rat : "";
                $finalTemp[] = isset($row->adr) ? $row->adr : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
              //  $finalTemp[] = isset($row->upTm) ? $row->upTm : "";
                $finalTemp[] = isset($row->imUrl) && $row->imUrl != '' ? 'assets/diagnosticsImage/thumb/original/' . $row->imUrl : "";
                $finalTemp[] = isset($row->diaCat) ? $row->diaCat : ""; 
                $finalTemp[] = isset($row->isHealtPkg) && $row->isHealtPkg > 0 ? "1" : "0";
                $finalTemp[] = isset($row->isConsulting) && $row->isConsulting > 0 ? "1" : "0";
                $finalTemp[] = isset($row->userId) ? $row->userId : "";
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "0";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult;
        }
    }

    function diagonstic_Details($diaUsrId) {

        $this->db->select('diagnostic_id,diagnostic_usersId,diagnostic_address, diagnostic_lat, diagnostic_long, diagnostic_aboutUs, CONCAT("0","",diagnostic_phn) as diagnostic_mblNo, CONCAT("assets/diagnosticsImage/thumb/original","/",diagnostic_img) as img, diagnostic_isEmergency as isEmergency');
        $this->db->from('qyura_diagnostic');
        $this->db->where(array('diagnostic_id' => $diaUsrId, 'diagnostic_deleted' => 0));
        return $this->db->get()->row();
    }

    public function getDiagAwards($diagnosticId, $limit = NULL) {
        $this->db->select('diagnosticAwards_id as awards_id,diagnosticAwards_awardsName name,diagnosticAwards_awardYear year, agency_name ');
        $this->db->from('qyura_diagnosticAwards');
        $this->db->join('qyura_awards', 'qyura_awards.awards_id = qyura_diagnosticAwards.diagnosticAwards_awardsId', 'left');
        $this->db->join('qyura_awardAgency','qyura_awardAgency.awardAgency_id = qyura_diagnosticAwards.diagnosticAwards_awardsAgency ','left');
        $this->db->where(array('diagnosticAwards_diagnosticId' => $diagnosticId, 'diagnosticAwards_deleted' => 0));
        $this->db->group_by('diagnosticAwards_id');
        $this->db->order_by('diagnosticAwards_awardYear',"DESC");
        if ($limit != NULL)
            $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function getDiagonGallery($diagnosticId) {
        $this->db->select('diagonsticImages_id id, CONCAT("assets/diagnosticsImage","/",diagonsticImages_ImagesName) as img');
        $this->db->from('qyura_diagonsticsImages');
        $this->db->where(array('diagonsticImages_diagonsticId' => $diagnosticId, 'diagonsticImages_deleted' => 0));
        return $this->db->get()->result();
    }

    function diagnosticsCat_Details($diagnosticId, $limit = 4) {
        $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS diagnosticsCatName,qyura_DiagnosticDiagCatTest.DiagCatTest_id');
        $this->db->from('qyura_DiagnosticDiagCatTest');
        $this->db->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId = qyura_DiagnosticDiagCatTest.DiagCatTest_diagCatId', 'left');
        $this->db->where(array('qyura_DiagnosticDiagCatTest.DiagCatTest_DiagnosticId' => $diagnosticId, 'qyura_DiagnosticDiagCatTest.DiagCatTest_deleted' => 0));
        if ($limit)
            $this->db->limit($limit);

        return $this->db->get()->result();
    }

    function diagnosticServices_Details($diagnosticId, $limit = NULL) {
        $this->db->select('diagnosticServices_serviceName AS servicesName,diagnosticServices_id as id');
        $this->db->from('qyura_diagnosticServices');
        $this->db->where(array('qyura_diagnosticServices.diagnosticServices_diagnosticId' => $diagnosticId, 'qyura_diagnosticServices.diagnosticServices_deleted' => 0));
        if ($limit != NULL)
            $this->db->limit($limit);

        return $this->db->get()->result();
    }

    function diagnosticSpecialities_Details($diagnosticId, $limit = NULL) {

        $this->db->select('Group_concat(DISTINCT (CASE diagnostic_specialityNameFormate WHEN 1 THEN qyura_specialities.specialities_drName WHEN 0 THEN qyura_specialities.specialities_name END) order by qyura_specialities.specialities_name SEPARATOR ", ") as specialitiesName, qyura_diagnosticSpecialities.diagnosticSpecialities_id');
        $this->db->from('qyura_diagnosticSpecialities');
        $this->db->join('qyura_diagnostic', 'qyura_diagnostic.diagnostic_id = qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId', 'left');
        $this->db->join('qyura_specialities', 'qyura_specialities.specialities_id = qyura_diagnosticSpecialities.diagnosticSpecialities_specialitiesId', 'left');
        $this->db->where(array('qyura_diagnosticSpecialities.diagnosticSpecialities_diagnosticId' => $diagnosticId, 'qyura_diagnosticSpecialities.diagnosticSpecialities_deleted' => 0,
            'qyura_specialities.specialities_deleted' => 0));
        if ($limit != NULL)
            $this->db->limit($limit);

        return $this->db->get()->result();
    }

    public function getDiagnosticsDoctors($diagnosticId, $diagnosticUsersId, $limit = NULL) {
        
        $this->db->select('doctors_id, CONCAT("assets/doctorsImages/thumb/original","/",doctors_img) as doctors_img, doctors_fName, doctors_lName');
        $this->db->from('qyura_doctors');
        // $this->db->join('qyura_doctors','qyura_doctors.doctors_userId = qyura_usersRoles.usersRoles_userId','left');
        $this->db->where(array('qyura_doctors.doctors_parentId' => $diagnosticUsersId, 'qyura_doctors.doctors_roll' => ROLE_DOCTORE_CHILD, 'doctors_deleted' => 0, 'qyura_doctors.status' => 1));
        if ($limit != NULL)
            $this->db->limit($limit);
        $doctors = $this->db->get()->result();

        $doctorResult = array();
        if (!empty($doctors)) {
            foreach ($doctors as $doctor) {
                $doctorTemp = array();
                $doctorTemp['doctors_id'] = $doctor->doctors_id;
                $doctorTemp['img'] = $doctor->doctors_img;
                $doctorTemp['fName'] = $doctor->doctors_fName;
                $doctorTemp['lName'] = $doctor->doctors_lName;
                $doctorResult[] = $doctorTemp;
            }
            return $doctorResult;
        }

        return $doctorResult;
    }

    public function getDiagnosticsReviewCount($diagnosticId) {
        $sql = "SELECT COUNT('reviews_id') as reviews
                FROM `qyura_reviews`
                WHERE `reviews_deleted` = '0' and `reviews_relateId` = '{$diagnosticId}' ";
        $query = $this->db->query($sql)->row();
        return $query->reviews;
    }

    public function getDiagnosticsAvgRating($diagonsticUserId) {
        $this->db->select('(
                    CASE 
                        WHEN (reviews_rating is not null AND qyura_ratings.rating is not null) 
                        THEN ROUND( (AVG(reviews_rating+qyura_ratings.rating))/2, 1)
                        WHEN (reviews_rating is not null) 
                        THEN 
                            ROUND( (AVG(reviews_rating)), 1)
                        WHEN (qyura_ratings.rating is not null) 
                        THEN
                            ROUND( (AVG(qyura_ratings.rating)), 1)
                        END)
                     AS `rat` ')
                ->from('qyura_diagnostic')
                ->join('qyura_reviews', 'qyura_reviews.reviews_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->join('qyura_ratings', 'qyura_ratings.rating_relateId=qyura_diagnostic.diagnostic_usersId', 'left')
                ->where(array('qyura_diagnostic.diagnostic_usersId' => $diagonsticUserId,"qyura_reviews.reviews_deleted"=>0,"qyura_ratings.rating_deleted"=>0));
        $result = $this->db->get()->row();
        return isset($result->rat) && $result->rat != '' ? $result->rat : '';
        //echo $this->db->last_query(); exit;
    }

    public function getDiagnosticsPkg($diagonsticId) {
        $this->db->select('healthPackage_id,healthPackage_packageTitle,healthPackage_packageId,healthPackage_packageTitle,healthPackage_expiryDateStatus,healthPackage_date,healthPackage_bestPrice,healthPackage_discountedPrice,healthPackage_description,healthPackage_deleted,modifyTime');
        $this->db->from('qyura_healthPackage');
        $this->db->where(array('healthPackage_MIuserId' => $diagonsticId, 'healthPackage_deleted' => 0, 'status' => 1));
        return $this->db->get()->result();
    }

    function getDiagnosticsCat($diagonsticId, $limit = NULL) {

        $this->db->select('qyura_diagnosticsCat.diagnosticsCat_catName AS diagnosticsCatName,diagnosticsCat_catId as hospitalDiagCatTest_diagTestId, CONCAT("assets/diagnosticsCatImages","/",qyura_diagnosticsCat.diagnosticsCat_catImage) as image')
                ->from('qyura_diagnosticsHasCat')
                ->join('qyura_diagnosticsCat', 'qyura_diagnosticsCat.diagnosticsCat_catId=qyura_diagnosticsHasCat.diagnosticsHasCat_diagnosticsCatId', 'left')
                ->where(array('diagnosticsHasCat_diagnosticId' => $diagonsticId, 'diagnosticsCat_deleted' => 0));
        if ($limit)
            $this->db->limit($limit);

        return $this->db->get()->result();
    }

    public function getDiagnosticsds($diagonsticId, $limit = 3) {
        $this->db->select('diagnosticAwards_diagnosticId,diagnosticAwards_awardsName,modifyTime');
        $this->db->from('qyura_diagnosticAwards');
        $this->db->where(array('qyura_diagnosticAwards.diagnosticAwards_diagnosticId' => $diagonsticId, 'qyura_diagnosticAwards.diagnosticAwards_deleted' => 0));
        if ($limit)
            $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function getDoctorsRole($userId) {
        $this->db->select('qyura_doctors.doctors_id,qyura_usersRoles.usersRoles_userId,qyura_usersRoles.usersRoles_roleId,qyura_usersRoles.usersRoles_parentId');
        $this->db->from('qyura_usersRoles');
        $this->db->join('qyura_doctors', 'qyura_doctors.doctors_userId=qyura_usersRoles.usersRoles_userId', 'left');
        $this->db->where(array('qyura_usersRoles.usersRoles_userId' => $userId, 'qyura_usersRoles.usersRoles_deleted' => 0));
        return $this->db->get()->result();
    }

    public function getDiagonHelthPkg($diagonsticId) {
        
        $this->db->select('healthPackage_id, healthPackage_packageTitle, healthPackage_packageId, FORMAT(healthPackage_bestPrice,0) as healthPackage_bestPrice, FORMAT(healthPackage_discountedPrice,0) as healthPackage_discountedPrice');
        $this->db->from('qyura_healthPackage');
//        $this->db->join('qyura_diagonsticPackage', 'qyura_diagonsticPackage.diagonsticPackage_healthPackageId = qyura_healthPackage.healthPackage_id');
        $this->db->where(array('healthPackage_MIuserId' => $diagonsticId, 'healthPackage_deleted' => 0,'qyura_healthPackage.status' => 1));
        $this->db->group_by('healthPackage_id');
        return $this->db->get()->result();
        
    }
    
        // mi time slot
    
    public function miTimeSlot($userId)
    {
         $this->db->select('(CASE WHEN (openingHours is NULL) THEN 0 ELSE openingHours END) AS openingHours , (CASE WHEN (closingHours is NULL) THEN 0 ELSE closingHours END) AS closingHours');
        $this->db->from('qyura_miTimeSlot');
        $this->db->where(array('deleted' => 0, 'status' => 1, 'mi_user_id' => $userId, 'hourLabel' => date("l")));
        return $this->db->get()->row();
        
    }
    
    public function getCollectionCenter($diagonsticId){
        
         $this->db->select('collectionCenter_id as centerId, collectionCenter_name as centerName, collectionCenter_address as centerAddress, collectionCenter_lat as centerLat, collectionCenter_long as centerLong');
        $this->db->from('qyura_diagnoCollectionCenter');
//        $this->db->join('qyura_diagonsticPackage', 'qyura_diagonsticPackage.diagonsticPackage_healthPackageId = qyura_healthPackage.healthPackage_id');
        $this->db->where(array('collectionCenter_diagnoId' => $diagonsticId, 'collectionCenter_deleted' => 0,'qyura_diagnoCollectionCenter.status' => 1));
        $this->db->group_by('collectionCenter_id');
        return $this->db->get()->result();
    }

}
