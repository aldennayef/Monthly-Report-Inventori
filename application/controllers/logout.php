<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function index()
    {
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Log Out dari SIMR '
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        // destroy session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Account Has Been Logged Out !</div>');
		redirect('home');
    }

}