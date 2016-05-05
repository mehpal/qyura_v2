<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sponserhealthtip extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->model('Sponser_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    function index() {

        $data = array();

        $data['title'] = 'Sponser Healthtip';
        $data['allCategories'] = $this->Sponser_model->fetchCategories();
        $this->load->super_admin_template('SponserListing', $data, 'SponserScript');
    }

//Prachi
    function getHealthtipDl($cur_page = 1) {

        if (!empty($_POST["page"]))
            $cur_page = $this->input->post("page");

        $where = array();

        if (!empty($_POST["src_cat"])) {
            $src_cat = $this->input->post("src_cat");
            $where = array("category_id" => $src_cat);
        }

        if (!empty($_POST["date2"]))
            $date2 = $this->input->post("date2");

        $per_page = 9;

        $page = $cur_page - 1;
        $start = $page * $per_page;

        $data['SponserData'] = $this->Sponser_model->fetchSponserData($where, $start, $per_page);
        /* echo $this->db->last_query();
          exit; */
        $msg = "<article class='clearfix p-t-20 appt-detail'>";
        foreach ($data['SponserData'] as $sdata) {

            $msg .= "<aside class='col-md-4 col-sm-6 m-t-20'><div class='sponser-health text-center' ><aside >
                 <h3>" . $sdata->category_name . "</h3><p>" . $sdata->healthTips_detail . "</p><h4><i class='fa fa-inr'></i> " . $sdata->healthTips_amount . "/- Per Day</h4></aside><a href=" . base_url() . "index.php/sponserhealthtip/detailsponser/" . $sdata->healthTips_id . "><figure><h4>SPONSOR</h4></figure></a></div></aside>";
        }
        $msg .= "</article>";

        $data['SponserDataCount'] = $this->Sponser_model->fetchSponserDataCount($where);

        echo $msg .= $this->genPagination($cur_page, count($data['SponserDataCount']), $per_page);
    }

//Prachi Display Edit Page
    function detailSponser($sponsor_tipId) {
        $data = array();
        $data['editdetail'] = 'none';
        $data['detail'] = 'block';
        $data['allStates'] = $this->Sponser_model->fetchStates();
        $data['allMIDoc'] = $this->Sponser_model->fetchAllMIDoc();
                
        $data['SponserDetail'] = $this->Sponser_model->getSponserdetails($sponsor_tipId);
        // echo $this->db->last_query();
        //exit;
        $data['sponsor_tipId'] = $sponsor_tipId;

        $data['title'] = "Detail Data";
        $this->load->super_admin_template('SponserDetail', $data, 'SponserScript');
    }

    function fetchCity() {
        $stateId = $this->input->post('stateId');
        $cityData = $this->Sponser_model->fetchCity($stateId);
        $cityOption = '';
        $cityOption .='<option value=>Select Your City</option>';
        foreach ($cityData as $key => $val) {
            $cityOption .= '<option value=' . $val->city_id . '>' . strtoupper($val->city_name) . '</option>';
        }
        echo $cityOption;
        exit;
    }

    function getMI() {
        //$city_id = $this->input->post('city_id');
        $mi_type = $this->input->post('mi_type');
        $option = '';
        if ($mi_type == 1) {
            $options = array(
                'table' => 'qyura_hospital',
                'where' => array('qyura_hospital.hospital_deleted' => 0),
            );
            $hospital = $this->common_model->customGet($options);

            if (isset($hospital) && $hospital != NULL) {
                $option .= '<option value="">Select Hospital</option>';
                foreach ($hospital as $hospi) {
                    $option .= '<option value="' . $hospi->hospital_usersId . '">' . $hospi->hospital_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Hospital not available. </option>';
            }
        } else if ($mi_type == 3) {
            $options = array(
                'table' => 'qyura_diagnostic',
                'where' => array('qyura_diagnostic.diagnostic_deleted' => 0),
            );
            $diagnostic = $this->common_model->customGet($options);
            if (isset($diagnostic) && $diagnostic != NULL) {
                $option .= '<option value="">Select Diagnostic</option>';
                foreach ($diagnostic as $diagno) {
                    $option .= '<option value="' . $diagno->diagnostic_usersId . '">' . $diagno->diagnostic_name . '</option>';
                }
            } else {
                $option .= '<option value=""> Diagnostic not available. </option>';
            }
        } else {
            $options = array(
                'table' => 'qyura_doctors',
                'where' => array('qyura_doctors.doctors_deleted' => 0),
            );
            $doctors = $this->common_model->customGet($options);
            if (isset($doctors) && $doctors != NULL) {
                $option .= '<option value="">Select Doctor</option>';
                foreach ($doctors as $docs) {
                    $option .= '<option value="' . $docs->doctors_userId . '">' . $docs->doctors_fName . ' ' . $docs->doctors_lName . '</option>';
                }
            } else {
                $option .= '<option value=""> Doctors not available. </option>';
            }
        }
        echo $option;
    }

   function fetchsponserdates() {
        $city_id = $this->input->post('city_id');
        // $city_id = 705;
        
        $mi_centre = $this->input->post('mi_centre');
        $sponarr = explode("_",$mi_centre);
        
        $centerType = $sponarr["1"];
        $mi_centre = $sponarr["0"];
        
        $htipid = $this->input->post('htipid');
        //$htipid = 3;

        $datestr = "";

        //$where = array("sponsor_cityId" => $city_id, "sponsor_tipId" => $htipid);
        $where = array("sponsor_cityId" => $city_id);

        $sponserdate = $this->Sponser_model->fetchsponserdates($where);
//        $dateArray = NULL;
//        foreach($sponserdate as $sd){
//            $dateArray[] = $sd->sponsor_date;
//        }
//        $vals = array_count_values($dateArray); 
//        $i = 0;
//        foreach ($vals as $key=>$spdate) {
//            if($spdate >= 20)
//                $datestr .= date("Y-m-d", $key) . ",";
//            //$datestr = $spdate->sponsor_date.",";
//            $i++;
//        }
//        echo trim($datestr, ",");
        
        $i = 0;
        foreach ($sponserdate as $spdate) {

            $datestr .= date("Y-m-d", $spdate->sponsor_date) . ",";

            //$datestr = $spdate->sponsor_date.",";

            $i++;
        }
        echo trim($datestr, ",");

        exit;
    }
    
    function bookSponserdates() {
        $HtipId = $this->input->post('HtipId');
        $sponser_stateId = $this->input->post('sponser_stateId');
        $sponser_cityId = $this->input->post('sponser_cityId');
        //$centerType = $this->input->post('centerType');
        
        $mi_centre = $this->input->post('mi_centre');
        $bookdates = explode(",", $this->input->post('bookdates'));
        
        $sponarr = explode("_",$mi_centre);
        
        $centerType = $sponarr["1"];
        $mi_centre = $sponarr["0"];

        for ($i = 0; $i < sizeof($bookdates); $i++) {

            $mydate = strtotime($bookdates[$i]);

            $insertdata = array(
                "sponsor_tipId" => $HtipId,
                "sponsor_userId" => $mi_centre,
                "sponser_userRole" => $centerType,
                "sponsor_cityId" => $sponser_cityId,
                "sponsor_date" => $mydate,
                "sponsor_deleted" => 0,
                "creationTime" => strtotime(date("Y-m-d")),
                "status" => 0
            );

            $this->Sponser_model->insertTableData("qyura_healthTipSponsor", $insertdata);
        }

        $this->session->set_flashdata('message', 'Dates Successfully Booked!');
        redirect('sponserhealthtip');
        exit;
    }


    function genPagination($cur_page, $count, $per_page) {
        $msg = "";
        $page = $cur_page - 1;

        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        $start = $page * $per_page;

        $no_of_paginations = ceil($count / $per_page);

        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }

        $msg .= "<article class='clearfix m-t-20 p-b-20'><ul class='list-inline list-unstyled pull-right call-pagination'  id='paginationid'>";

// FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $cur_page > 1) {
            $msg .= "<li ><a href='javascript:loadme(1)'>First</a></li>";
        } else if ($first_btn) {
            $msg .= "<li p='1' class='disabled'><a href='#'>First</a></li>";
        }

        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $msg .= "<li ><a href='javascript:loadme($pre)'>Previous</a></li>";
        } else if ($previous_btn) {
            $msg .= "<li class='disabled'><a href='#'>Previous</a></li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $msg .= "<li class='active'><a href='#'>{$i}</a></li>";
            else
                $msg .= "<li><a href='javascript:loadme($i)'>{$i}</a></li>";
        }

// TO ENABLE THE NEXT BUTTON
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $msg .= "<li ><a href='javascript:loadme($nex)'>Next</a></li>";
        } else if ($next_btn) {
            $msg .= "<li  class='disabled'><a href='#'>Next</a></li>";
        }

        // TO ENABLE THE END BUTTON

        if ($last_btn && $cur_page < $no_of_paginations) {
            $msg .= "<li><a href='javascript:loadme($no_of_paginations)'>Last</a></li>";
        } else if ($last_btn) {
            $msg .= "<li class='disabled' ><a href='loadme($no_of_paginations)'>Last</a></li>";
        }
        $msg .="</ul></article>";
        return $msg;
    }

    //Booked Sponser
    function bookedSponser() {
        $data = array();

        $data['BookedSponData'] = $this->Sponser_model->fetchBookedSponser();
         /*echo "<pre>";
         echo $this->db->last_query();
          print_r($data['BookedSponData']);
          exit; */
        $data['title'] = 'Booked Sponser';
        $this->load->super_admin_template('BookedSponser', $data, 'SponserScript');
    }

    function getBookedSponserDl() {
        echo $r =  $this->Sponser_model->fetchHealthtipDataTables();
        exit;
    }

    function deleteBookedSponsor($sponsor_Id) {
        $todate = strtotime(date("Y-m-d"));
        $updatedata = array(
            'sponsor_deleted' => 1,
        );

        $where = array(
            'sponsor_id' => $sponsor_Id
        );
        $response = '';

        $where2 = array("sponsor_id" => $sponsor_Id);
        $response = $this->Sponser_model->fetchTableData(array("*"), "qyura_healthTipSponsor", $where2);
        if (!empty($response)) {
            if ($response[0]->sponsor_date > $todate) {
                $response = $this->Sponser_model->UpdateTableData($updatedata, $where, 'qyura_healthTipSponsor');
                if ($response) {
                    $updateUserdata = array(
                        'modifyTime' => strtotime(date("Y-m-d H:i:s"))
                    );
                    $whereUser = array(
                        'sponsor_id' => $sponsor_Id
                    );
                    $response = $this->Sponser_model->UpdateTableData($updateUserdata, $whereUser, 'qyura_healthTipSponsor');
                    if ($response) {
                        echo 1;
                        exit;
                        /*$this->session->set_flashdata('message', 'Data deleted successfully !');
                        redirect("sponserhealthtip/bookedsponser");*/
                    }
                }
            } else {
                echo 2;
                exit;
                /*$this->session->set_flashdata('message', 'Heathtip Sponsor date passed ! Could not be deleted !');
                redirect("sponserhealthtip/bookedsponser");*/
            }
        } else {
            echo 3;
            exit;
            /*$this->session->set_flashdata('message', 'Healthtip is Currently Sponsered !');
            redirect("sponserhealthtip/bookedsponser");*/
        }
    }
     function createCSV($search=NULL){
         
       $where=array('healthTips_deleted'=> 0);
       $search = trim($search);
       if($search)
       {
           $where["category_name like '$search%' OR city_name like '$seach%'"] = NULL; 
       }
        
        $array[]= array('Booked Sponsor','Sponsor Type','Date','City','Category');      
        $data = $this->Sponser_model->createCSVdata($where);
        $arrayFinal = array_merge($array,$data);
        array_to_csv($arrayFinal,'Sponsor.csv');
        return True;
        exit;
    }

}
