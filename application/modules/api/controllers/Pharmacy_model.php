<?php
if(!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Pharmacy_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
	
    }
    
    public function getPhamacyList($lat, $long, $notIn, $isemergency) {
           
        $lat = isset($lat) ? $lat : '';
        $long = isset($long) ? $long : '';
        $notIn = isset($notIn) ? $notIn : '';
        
        $where = array('qyura_pharmacy.pharmacy_deleted' => 0, 'usersRoles_parentId' => 0);
        if($isemergency != '' && $isemergency != NULL){
            
              $where['qyura_pharmacy.pharmacy_27Src'] = $isemergency;
         }

        $this->db->select('qyura_pharmacy.pharmacy_id as id, pharmacy_name name, pharmacy_address adr, pharmacy_img imUrl, (
                6371 * acos( cos( radians( ' . $lat . ' ) ) * cos( radians( pharmacy_lat ) ) * cos( radians( pharmacy_long ) - radians( ' . $long . ' ) ) + sin( radians( ' . $lat . ' ) ) * sin( radians( pharmacy_lat ) ) )
                ) AS distance, pharmacy_phn phn, pharmacy_lat lat, pharmacy_long long,qyura_pharmacy.pharmacy_27Src isEmergency')
                ->from('qyura_pharmacy')
                ->join('qyura_usersRoles', 'qyura_usersRoles.usersRoles_userId=qyura_pharmacy.pharmacy_userId','left')
                ->where($where)
                ->having(array('distance <' => USER_DISTANCE))
                ->where_not_in('qyura_pharmacy.pharmacy_id', $notIn)
                ->order_by('distance', 'ASC')
                ->group_by('pharmacy_id')
                ->limit(DATA_LIMIT);


        $response = $this->db->get()->result();
        
        $finalResult = array();
        if (!empty($response)) {
            foreach ($response as $row) {

                $finalTemp = array();
                $finalTemp[] = isset($row->id) ? $row->id : "";
                $finalTemp[] = isset($row->name) ? $row->name : "";
                $finalTemp[] = isset($row->adr) ? $row->adr : "";
                $finalTemp[] = isset($row->imUrl) ? 'assets/pharmacyImages/' . $row->imUrl : "";
                $finalTemp[] = isset($row->phn) ? $row->phn : "";
                $finalTemp[] = isset($row->lat) ? $row->lat : "";
                $finalTemp[] = isset($row->long) ? $row->long : "";
                $finalTemp[] = isset($row->isEmergency) ? $row->isEmergency : "";
                $finalResult[] = $finalTemp;
            }
            return $finalResult;
        } else {
            return $finalResult[] = '';
        }
    }
}
?>
