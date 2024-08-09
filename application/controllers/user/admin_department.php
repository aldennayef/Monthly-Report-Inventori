<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_department extends CI_Controller{

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('Webmodel');
	}

    public function index(){
        // $data['user'] = $this->db->get_where('user',['username'=>$this->session->userdata('username')])->row_array();
        $username = $this->session->userdata('username');
        $role_id = $this->session->userdata('role_id');
        
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
        
        $this->load->view('dashboard', $data);
    }

}