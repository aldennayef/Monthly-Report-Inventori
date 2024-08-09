<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Errorpage extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}

    public function index(){
        $this->load->view('error_page');
    }

    public function toDashboard(){
        $roleId = $this->session->userdata('role_id');
        if($roleId == 1){
            redirect('user/admin');
        }elseif ($roleId == 2) {
            redirect('user/manager');
        }else{
            redirect('user/karyawan');
        }
    }

}