<?php
defined("BASEPATH") or die("No Direct Access Allowed");
class M_simpanan_pokok extends CI_Model
{
    private $_table = 'master_simpanan_pokok';

    function getSimpananpokok()
    {
        return $this->db->get($this->_table)->result();
    }
    function addSimpananpokok($data)
    {
        if ($this->db->insert($this->_table, $data) == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
