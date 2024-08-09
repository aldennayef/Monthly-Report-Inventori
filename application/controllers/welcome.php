<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
        $user_sub_department = $this->input->get('user_sub_department');
        $role_id = $this->session->userdata('role_id');
        $username = $this->session->userdata('username');

        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $user_id = $user->id;

            $this->db->select('report');
            $this->db->distinct();
            $this->db->from('kolom_attributes');

            if ($role_id != 2) {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }

            $query = $this->db->get();
            $reports = array_column($query->result_array(), 'report');
            echo json_encode(['reports' => $reports]);
        } else {
            echo json_encode(['reports' => []]);
        }
    }

    public function chart_data() {
        $report = $this->input->get('report');
        $role_id = $this->session->userdata('role_id');
        $username = $this->session->userdata('username');

        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $user_id = $user->id;
            $start = $this->input->get('start');
            $end = $this->input->get('end');

            $start_date = $start ? $start . '-01' : null;
            $end_date = $end ? $end . '-01' : null;

            $this->db->select('kolom_attributes.report, kolom_values.periode, kolom_values.value, kolom_values.satuan, kolom_attributes.sub_report, kolom_attributes.status, user.username, user_sub_department.sub_department as user_sub_department');
            $this->db->from('kolom_values');
            $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
            $this->db->join('user', 'kolom_attributes.user_id = user.id');
            $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id', 'left');

            if ($report) {
                $this->db->where('kolom_attributes.report', $report);
            }

            if ($role_id != 2) {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }

            if (!empty($start_date) && !empty($end_date)) {
                $this->db->where('kolom_values.periode >=', $start_date);
                $this->db->where('kolom_values.periode <=', $end_date);
            }

            $query = $this->db->get();

            if ($query === false) {
                $error = $this->db->error();
                log_message('error', 'Database error: ' . print_r($error, true));
                echo json_encode(['error' => 'Database query failed']);
                return;
            }

            $data = $query->result();

            $grouped_data = [];
            foreach ($data as $row) {
                $grouped_data[$row->report][] = $row;
            }

            $boxes = [];
            foreach ($grouped_data as $report => $values) {
                $total_value = array_sum(array_column($values, 'value'));
                $username = $values[0]->username;
                $satuan = $values[0]->satuan;
                $user_sub_department = $values[0]->user_sub_department;
                $boxes[] = [
                    'report' => $report,
                    'total_value' => $total_value,
                    'username' => $username,
                    'satuan' => $satuan,
                    'user_sub_department' => $user_sub_department
                ];
            }

            echo json_encode(['boxes' => $boxes, 'data' => $data]);
        } else {
            echo json_encode([]);
        }
    }

    public function get_detail_data() {
        $report = $this->input->get('report');
        $periode = $this->input->get('periode');
        $role_id = $this->session->userdata('role_id');
        $username = $this->session->userdata('username');

        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $user_id = $user->id;

            $this->db->select('kolom_attributes.sub_report, kolom_values.value, kolom_attributes.status, kolom_values.satuan, user_sub_department.sub_department as user_sub_department');
            $this->db->from('kolom_values');
            $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
            $this->db->join('user', 'kolom_attributes.user_id = user.id');
            $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id', 'left');
            $this->db->where('kolom_attributes.report', $report);
            $this->db->where('kolom_values.periode', $periode);

            if ($role_id != 2) {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }

            $query = $this->db->get();
            $data = $query->result();

            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    public function search_reports() {
        $search_term = $this->input->get('search_term');
        $role_id = $this->session->userdata('role_id');
        $username = $this->session->userdata('username');

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

            if ($role_id != 2) {
                $this->db->where('kolom_attributes.user_id', $user_id);
            }

            if (!empty($search_term)) {
                $this->db->like('kolom_attributes.report', $search_term);
            }

            $query = $this->db->get();
            $data = $query->result();

            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }
}
?>
