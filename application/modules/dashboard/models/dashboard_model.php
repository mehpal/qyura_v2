<?php

class Dashboard_model extends My_model {

    /**
     * admin model page.
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

    /**
     * authSession
     * set active after user login
     * @access public
     * @param string
     * @return boolean (true/false)
     */
    function authSession($table, $id) {
        $this->db->select('*');
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where($id);
            }
        }
        if (!empty($table)) {
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                $result = $query->row();
                $session_auth = array(
                    'id' => $row->id,
                    'islogin' => TRUE
                );
                $this->session->set_userdata($session_auth);
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    /**
     * getResult
     * get all data
     * @access public
     * @param string
     * @return array
     */
    function getRow($table, $id = '', $coloumns = '', $order = '',$limit = '') {
        if (is_array($coloumns) && !empty($coloumns)) {
            $this->db->select($coloumns);
        } else {
            $this->db->select('*');
        }
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where($id);
            }
        }
        if (!empty($order)) {
            $this->db->order_by($order, 'DESC');
        }
         if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (!empty($table)) {
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * setRow
     * set all data
     * @access public
     * @param string
     * @return string
     */
    function setRow($table, $data) {
        if (is_array($data) && !empty($data) && !empty($table)) {

            if ($this->db->insert($table, $data)) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * updateRow
     * update row data
     * @access public
     * @param string
     * @return string
     */
    function updateRow($table, $data, $id) {
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where($id);
            }
            if (!empty($table) && !empty($data) && is_array($data)) {

                if ($this->db->update($table, $data)) {
                    return $this->db->affected_rows();
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * deleteRow
     * delete row data
     * @access public
     * @param string
     * @return string
     */
    function deleteRow($table, $id) {
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where($id);
            }
            if (!empty($table)) {
                if ($this->db->delete($table)) {
                    return $this->db->affected_rows();
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * countRow
     * count all rows in table
     * @access public
     * @param string
     * @return string
     */
    function countRow($table, $id = '') {
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $this->db->where($id);
            }
            $this->db->from($table);
            $query = $this->db->get();
            return $query->num_rows();
        } else {
            if (!empty($table)) {
                return $this->db->count_all($table);
            } else {
                return FALSE;
            }
        }
    }

    /**
     * whereInRow
     * where in array multiple value check in one table field name get all recoed
     * @param string
     * @return array
     */
    function whereInRow($table, $whereIn, $id) {
        if (is_array($whereIn) && !empty($id)) {
            $this->db->where_in($id, $whereIn);
        }
        if (!empty($table)) {
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * searchRow
     * search row data in table
     * @param string
     * @return array
     */
    function searchRow($table, $data, $order = '') {
        if (!empty($data) && is_array($data)) {
            $this->db->like($data);
        }
        if (!empty($order)) {
            $this->db->order_by($order, 'DESC');
        }
        if (!empty($table)) {
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * joinWhereRow
     * join table and get records using where
     * @param string
     * @return array
     */
    function joinWhereRow($table, $field, $join, $id) {
        if (!empty($id)) {
            if (!is_array($id)) {
                $this->db->where('id', $id);
            } else {
                $tyhis->db->where($id);
            }
        }
        if (!empty($field) && is_array($field)) {
            $this->db->select($field);
        }
        if (!empty($table)) {
            $this->db->from($table);
        }
        if (!empty($join) && is_array($join)) {
            foreach ($join as $key => $val):
                $this->db->join($key, $val);
            endforeach;
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result;
        } else {
            return FALSE;
        }
    }
    
    function totalOderIncome()
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->select_sum('totalPrice');
        $result = $this->db->get();
        return $result->row_array();
    }
    
    
     function get_order_by_date()
     {  
        $con= 'orderDate <= (NOW() - INTERVAL 1 MONTH)';
	$this->db->select('*');
        $this->db->from('users');
        $this->db->join('order','users.id = order.fkUserId');
       // $this->db->join('orderDeliveryStatus','orderDeliveryStatus.odrStatusId = order.fkOdrStatusId');
        $this->db->where($con);
        $this->db->order_by('orderDate','asc');
        $query = $this->db->get();
        return $query->result();
                
     }

}
