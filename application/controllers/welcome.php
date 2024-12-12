<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function get_user_sub_departments() {
        $this->db->select('sub_department');
        $this->db->distinct();
        $this->db->from('user_sub_department');
        $query = $this->db->get();
        $user_sub_departments = array_column($query->result_array(), 'sub_department');
        echo json_encode(['user_sub_departments' => $user_sub_departments]);
    }

    public function get_reports() {
        $username = $this->session->userdata('username');
        $role_id = $this->session->userdata('role_id');

        // Ambil user ID berdasarkan username
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $user_id = $user->id;

            if ($role_id == 2) { // Manager
                // Ambil kolom_id dari report_access
                $this->db->select('kolom_id');
                $this->db->from('report_access');
                $this->db->where('user_id', $user_id);
                $access_query = $this->db->get();
                $access = array_column($access_query->result_array(), 'kolom_id');

                if (!empty($access)) {
                    $this->db->select('report');
                    $this->db->distinct();
                    $this->db->from('kolom_attributes');
                    $this->db->where_in('id', $access); // Filter berdasarkan report_access
                } else {
                    echo json_encode(['reports' => []]); // Tidak ada akses
                    return;
                }
            } else {
                // Non-manager hanya bisa akses laporan mereka sendiri
                $this->db->select('report');
                $this->db->distinct();
                $this->db->from('kolom_attributes');
                $this->db->where('user_id', $user_id);
            }

            $query = $this->db->get();
            $reports = array_column($query->result_array(), 'report');
            echo json_encode(['reports' => $reports]);
        } else {
            echo json_encode(['reports' => []]); // User tidak ditemukan
        }
    }

    public function chart_data() {
        $report = $this->input->get('report');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $username = $this->session->userdata('username');
        $role_id = $this->session->userdata('role_id');
    
        // Ambil user ID berdasarkan username
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();
    
        if (!$user) {
            echo json_encode(['data' => [], 'error' => 'User not found']);
            return;
        }
    
        $user_id = $user->id;
    
        // Ambil kolom_id berdasarkan role
        $access = [];
        if ($role_id == 2) { // Manager
            $this->db->select('kolom_id');
            $this->db->from('report_access');
            $this->db->where('user_id', $user_id);
            $access_query = $this->db->get();
            $access = array_column($access_query->result_array(), 'kolom_id');
        }
    
        // Query data
        $this->db->select('kolom_attributes.report, kolom_values.periode, kolom_values.value, kolom_values.satuan, kolom_attributes.sub_report, kolom_attributes.status, user.username, user_sub_department.sub_department as user_sub_department');
        $this->db->from('kolom_values');
        $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
        $this->db->join('user', 'kolom_attributes.user_id = user.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id', 'left');
    
        if ($role_id == 2) { // Manager
            if (!empty($access)) {
                $this->db->where_in('kolom_values.kolom_id', $access); // Filter manager berdasarkan report_access
            } else {
                // Jika tidak ada akses, ambil data umum yang bisa dilihat oleh Manager
                $this->db->where('kolom_attributes.report', $report); 
                $this->db->where('kolom_values.periode >=', $start ? $start . '-01' : '1900-01-01');
                $this->db->where('kolom_values.periode <=', $end ? $end . '-01' : date('Y-m-d'));
            }
        }
         else {
            $this->db->where('kolom_attributes.user_id', $user_id);
        }
    
        if ($report) {
            $this->db->where('kolom_attributes.report', $report);
        }
    
        if ($start && $end) {
            $this->db->where('kolom_values.periode >=', $start . '-01');
            $this->db->where('kolom_values.periode <=', $end . '-01');
        }
    
        $query = $this->db->get();
        $data = $query->result();
    
        if (empty($data)) {
            echo json_encode(['data' => [], 'error' => 'No data found']);
            return;
        }
    
        // Buat data untuk "boxes"
        $grouped_data = [];
        foreach ($data as $row) {
            $grouped_data[$row->report][] = $row;
        }
    
        $boxes = [];
        foreach ($grouped_data as $report_name => $rows) {
            $total_value = array_sum(array_column($rows, 'value'));
            $satuan = $rows[0]->satuan;
            $user_sub_department = $rows[0]->user_sub_department;
    
            $boxes[] = [
                'report' => $report_name,
                'total_value' => $total_value,
                'satuan' => $satuan,
                'user_sub_department' => $user_sub_department
            ];
        }
    
        echo json_encode(['boxes' => $boxes, 'data' => $data]);
    }    
    
    public function get_detail_data() {
        $report = $this->input->get('report');
        $periode = $this->input->get('periode');
        $username = $this->session->userdata('username');
        $role_id = $this->session->userdata('role_id');
    
        // Ambil user ID berdasarkan username
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();
    
        if ($user) {
            $user_id = $user->id;
    
            // Perbaiki query untuk role manager
            $this->db->select('kolom_attributes.sub_report, kolom_values.value, kolom_attributes.status, kolom_values.satuan, user_sub_department.sub_department as user_sub_department');
            $this->db->from('kolom_values');
            $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
            $this->db->join('user', 'kolom_attributes.user_id = user.id');
            $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id', 'left');
            $this->db->where('kolom_attributes.report', $report);
            $this->db->where('kolom_values.periode', $periode);
    
            if ($role_id == 2) { // Role Manager
                $this->db->where('kolom_values.kolom_id IN (SELECT kolom_id FROM report_access WHERE user_id = ' . $user_id . ')', null, false);
            } else {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }
    
            $query = $this->db->get();
            $data = $query->result();
            echo json_encode($data);
        } else {
            echo json_encode([]); // User tidak ditemukan
        }
    }
    
    
    public function index() {
        $this->load->view('welcome_message');
    }

    public function search_reports() {
        $search_term = $this->input->get('search_term');
        $username = $this->session->userdata('username');
        $role_id = $this->session->userdata('role_id');

        // Ambil user ID berdasarkan username
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $user_id = $user->id;

            $this->db->select('report, sub_report, value, satuan');
            $this->db->from('kolom_values');
            $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
            $this->db->join('user', 'kolom_attributes.user_id = user.id');

            if ($role_id == 2) {
                $this->db->where_in('kolom_values.kolom_id', function() use ($user_id) {
                    $this->db->select('kolom_id');
                    $this->db->from('report_access');
                    $this->db->where('user_id', $user_id);
                    return $this->db->get_compiled_select();
                }, false);
            } else {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }

            if (!empty($search_term)) {
                $this->db->like('kolom_attributes.report', $search_term);
            }

            $query = $this->db->get();
            $data = $query->result();
            echo json_encode($data);
        } else {
            echo json_encode([]); // User tidak ditemukan
        }
    }
}
