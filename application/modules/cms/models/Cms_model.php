<?php
class Cms_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }
   
    
    //Function for get
    public function customGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $where_not_in = false;
        $group_by = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }


        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {

                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                }
            }
        }
        if($group_by != false){
            $this->db->group_by($group_by);
        }


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }
   
   //Function for update
    public function customUpdate($options) {
        $table = false;
        $where = false;
        $orwhere = false;
        $data = false;

        extract($options);

        if (!empty($where)) {
            $this->db->where($where);
        }

        // using or condition in where  
        if (!empty($orwhere)) {
            $this->db->or_where($orwhere);
        }
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }

        function fetchcmsDataTables( $condition = NULL){
            
         
         
     $this->datatables->select('cms.cms_id,cms.cms_title,cms.cms_description');
         
     $this->datatables->from('cms');
  
         $search = $this->input->post('cms_title');
   
        if($search){
            $this->db->or_like('cms.cms_description',$search);
        }
     
        $this->datatables->where(array('cms.deleted'=> 0));
        

       
  $this->datatables->add_column('cms_description', '$1', 'isStr(cms_description)');
        
      $this->datatables->add_column('view', '<a class="btn btn-warning waves-effect waves-light m-b-5 applist-btn" href="cms/editView/$1">Edit</a>', 'cms_id');
//     
        return $this->datatables->generate(); 
      //echo $this->datatables->last_query();

    }
   
    
   
    
  
    
}