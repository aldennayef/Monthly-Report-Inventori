<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Webmodel');
        $this->db_inv = $this->load->database('inventori', TRUE);
        $this->load->model('Inventori');
	}

    public function index(){
        $this->load->view('login');
    }

    public function login(){
        $uName = $this->input->post('username');
        $pWord = $this->input->post('password');
        $user = $this->db->get_where('user',['username' => $uName]) -> row_array();
        if($user){
            $verifyPass = password_verify($pWord,$user['password']);
            if($verifyPass){
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nik' => $user['nik'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);

                // insert to log data
                $data = [
                    'user_id' => $user['id'],
                    'activity' => 'Login ke SIMR'
                ];
                $this->db->set('date', 'NOW()', FALSE);
                $this->db->insert('log_data',$data);

                $current_date = date('d'); // Mendapatkan hari dalam bulan

                // Jika tanggal 22
                if ($current_date == '22') {
                    $last_month_date = date("Y-m-d", strtotime("first day of previous month")); // Mendapatkan tanggal pertama bulan kemarin
                    $last_day_of_last_month = date("Y-m-t", strtotime($last_month_date)); // Mendapatkan tanggal terakhir bulan kemarin

                    // Update kolom closed menjadi 1 untuk data yang memiliki periode bulan kemarin atau sebelumnya
                    $this->db->set('status_periode', 1);
                    // $this->db->where('closed !=', 1);
                    $this->db->where('periode <=', $last_day_of_last_month);
                    $this->db->update('kolom_values');
                }
                redirect('modul');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah !</div>');
                redirect('home');
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak ditemukan !</div>');
            redirect('home');
        }
        // $hashPassword = password_verify();
        // $this->load->view('admin/dashboard');
    }

    public function direct_monthly_report(){
        $role_id = $this->session->userdata('role_id');
        if($role_id){
            // after success login
            if ($role_id == 1) {
                // redirect('user/admin');
                // routing
                redirect('butterfly');
            } 
            elseif ($role_id == 2) {
            //    redirect('/user/manager');
                redirect('maloch');
            }
            elseif ($role_id == 3) {
            //    redirect('/user/karyawan');
                redirect('zephys');
            }
            else {
                // redirect('user/administrator');
                redirect('gon');
            }
        }else{
            redirect('home');
        }
    }

    public function direct_inventori(){
        $role_id = $this->session->userdata('role_id');
        $username = $this->session->userdata('username');
        if($role_id){
            $user = $this->db->get_where('user',['username'=>$this->session->userdata('username')]) -> row_array();
            // insert to log data
            $data = [
                'id_user' => $user['id'],
                'username' => $user['username'],
                'act_note' => 'Login ke SIMI'
            ];
            $this->db_inv->set('act_date', 'NOW()', FALSE);
            $this->db_inv->insert('log_data',$data);
            // after success login
            if ($role_id == 1) {
                redirect('dsb');
            } 
            elseif ($role_id == 2) {
                
            }else {
                    redirect('dsb');
            }
        }else{
            redirect('home');
        }
    }

    
}