<?php
defined("BASEPATH") or die("No Direct Access Allowed");
Class M_jurnal extends CI_Model{
    private $tbl_ak_jurnal = 'ak_jurnal';
    function inputJurnal($data){
        if($this->db->insert($this->tbl_ak_jurnal,$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}