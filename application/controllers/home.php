<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Webmodel');
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

                // after success login
                if ($user['role_id'] == 1) {
                    // redirect('user/admin');
                    // routing
                    redirect('butterfly');
                } 
                elseif ($user['role_id'] == 2) {
                //    redirect('/user/manager');
                    redirect('maloch');
                }
                elseif ($user['role_id'] == 3) {
                //    redirect('/user/karyawan');
                    redirect('zephys');
                }
                else {
                    // redirect('user/administrator');
                    redirect('gon');
                }
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

    
}