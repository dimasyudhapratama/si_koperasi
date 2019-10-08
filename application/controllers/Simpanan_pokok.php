<?php
defined("BASEPATH") or die("No Direct Access Allowed");
class Simpanan_pokok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_simpanan_pokok');
    }
    function index()
    {
        $data['title'] = 'Simpanan Pokok';
        $data['path'] = "simpanan_pokok/v_simpanan_pokok";
        $data['simpanan_pokok'] = $this->M_simpanan_pokok->getSimpananpokok();
        $this->load->view('master_template', $data);
    }
}
