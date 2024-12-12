<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori_backend extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_reports() {
        $nik = $this->session->userdata('nik');

        // Mendapatkan user berdasarkan nik
        $this->db->select('id_cluster');
        $this->db->from('user');
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $id_cluster = $user->id_cluster;

            // Mendapatkan jenis item berdasarkan cluster user
            $this->db->select('DISTINCT jenis');
            $this->db->from('items');
            $this->db->where('id_cluster', $id_cluster);
            $query = $this->db->get();
            $reports = array_column($query->result_array(), 'jenis');

            echo json_encode(['reports' => $reports]);
        } else {
            echo json_encode(['reports' => []]);
        }
    }

    public function chart_data() {
        $report = $this->input->get('report');
        $nik = $this->session->userdata('nik');

        // Mendapatkan user berdasarkan nik
        $this->db->select('id_cluster');
        $this->db->from('user');
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $id_cluster = $user->id_cluster;
            $start = $this->input->get('start');
            $end = $this->input->get('end');

            $start_date = $start ? $start . '-01' : null;
            $end_date = $end ? $end . '-01' : null;

            // Mengambil data dari tabel items berdasarkan report, id_cluster, dan rentang waktu
            $this->db->select('jenis as report, DATE_FORMAT(create_at, "%Y-%m") as periode, COUNT(id_cluster) as value, nama as sub_report');
            $this->db->from('items');
            $this->db->where('id_cluster', $id_cluster);
            if ($report) {
                $this->db->where('jenis', $report);
            }
            if (!empty($start_date) && !empty($end_date)) {
                $this->db->where('create_at >=', $start_date);
                $this->db->where('create_at <=', $end_date);
            }
            $this->db->group_by(['jenis', 'periode', 'nama']);
            $query = $this->db->get();
            $data = $query->result();

            echo json_encode(['data' => $data]);
        } else {
            echo json_encode([]);
        }
    }

    public function get_detail_data() {
        $report = $this->input->get('report');
        $periode = $this->input->get('periode');
        $nik = $this->session->userdata('nik');

        // Mendapatkan user berdasarkan nik
        $this->db->select('id_cluster');
        $this->db->from('user');
        $this->db->where('nik', $nik);
        $query = $this->db->get();
        $user = $query->row();

        if ($user) {
            $id_cluster = $user->id_cluster;

            // Mengambil data detail berdasarkan report, periode, dan id_cluster
            $this->db->select('nama as sub_report, COUNT(id_cluster) as value');
            $this->db->from('items');
            $this->db->where('id_cluster', $id_cluster);
            $this->db->where('jenis', $report);
            $this->db->where('DATE_FORMAT(create_at, "%Y-%m")', $periode);
            $this->db->group_by('nama');
            $query = $this->db->get();
            $data = $query->result();

            echo json_encode($data);
        } else {
            echo json_encode([]);
        }
    }

    public function index() {
        $this->load->view('inventori_dashboard');
    }
}
