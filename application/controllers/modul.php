<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load database kedua
        $this->load->database();
        $this->db3 = $this->load->database('database3', TRUE);
	}

    public function index(){
        if($this->session->userdata('role_id')){
            $data['moduls']= $this->db3->get('moduls')->result_array();
            $this->load->view('modul',$data);
        }else{
            redirect('home');
        }
    }
    
}