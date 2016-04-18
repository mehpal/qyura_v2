<?php

class Data_model extends CI_Model {
    
    /**
     * service model page.
     *
     * Since this model is set as the default model in
     * config/autoload.php, it's displayed
     * 
     * @package	clinicApp
     * @category db model
     */
    function __construct() {
        // parent class construct call
        parent::__construct();
    }

    function get_user_list($table,$columns) {
        
         // echo $_POST['start'];
        //exit;
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = $columns;
        
        // DB table to use
        $sTable = $table;
        //
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
        $start = $this->input->get_post('start', true);
        $end = $this->input->get_post('end', true);
        $gender = $this->input->get_post('gender', true);
        
        
    
       
        // var_dump($output); die();
      // $this->load->view('index');
        /* Array of table columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }

        /* date range filtartion */
        $sWhere = '';
        if((isset($start) && !empty($start)) OR (isset($end) && !empty($end))){
        $startDate = $this->input->get_post('start', true);
        $endDate = $this->input->get_post('end', true);
        $sSearch = $this->input->get_post('sSearch', true);
        
           if( $startDate != "" AND $endDate != ""){
               $sWhere != '' ? $sWhere .= " AND (`date` >= '$startDate' && `date` <= '$endDate')" : $sWhere .= "(`date` >= '$startDate' && `date` <= '$endDate')";
            }
            elseif ($startDate != ""){
               $sWhere != '' ?  $sWhere .= " AND (`date` = '$startDate')" : $sWhere .= "(`date` = '$startDate')";
            }elseif($endDate != ""){
              $sWhere != '' ?  $sWhere .= " AND (`date` = '$endDate')" : $sWhere .= "(`date` = '$endDate')";
          }
        }
        
        // select drop down
        //echo $gender; die();
        if( $gender != ""){
              $sWhere != '' ?   $sWhere .= " AND (`gender` = '$gender')" : $sWhere .= "(`gender` = '$gender')";
        }
            
       if($sWhere != ''){
           $this->db->where($sWhere);
       } 
        // Select Data
        
        
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
        // echo $this->db->last_query(); die();
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
        return $output;
    }

}
