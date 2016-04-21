<?php

class Qap_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
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
        if ($group_by != false) {
            $this->db->group_by($group_by);
        }


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }
    
        //Function for insert
    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
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

        function fetchQapDataTables($condition = NULL) {

      //  $imgUrl = base_url() . 'assets/Medicart/$1';

        $this->datatables->select("qyura_qap.qap_id as id,qyura_qap.status as sts,qyura_qap.qap_email,qyura_qap.qap_name,"
                . "qyura_qap.qap_image,qyura_qap.qap_phone,qyura_qap.qap_city,qyura_qap.qap_address,qyura_qap.qap_dateOfGeneration,qyura_qap.qap_code");
        
        
        $this->datatables->from('qyura_qap');
        
        $this->datatables->where(array("qyura_qap.qap_deleted" => 0));
        $this->datatables->order_by('qap_id','asc');
       
        $status = $this->input->post('status');
        isset($status) && $status != '' ? $this->datatables->where('qyura_qap.status', $status) : '';
//        
//        $this->datatables->add_column('medicartOffer_startDate','$1', 'dateFormateConvert(medicartOffer_startDate)');
//        $this->datatables->add_column('medicartOffer_endDate','$1', 'dateFormateConvert(medicartOffer_endDate)');

        
        $this->datatables->add_column('action', '<a href="qap/editView" class="btn btn-warning waves-effect waves-light m-b-5 applist-btn">Edit</a>', 'id');
        
        $this->datatables->add_column('status', '$1', 'statusCheck(qap,qyura_qap,qap_id,id,sts)');

       return  $this->datatables->generate();
       // return $this->datatables->last_query();
    }
    
}