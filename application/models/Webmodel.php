<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webmodel extends CI_Model{

    public function get_user_by_id($id){
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_user_by_username($username){
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        return $this->db->get()->row_array();
    }

    public function get_user_by_nik($nik){
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.nik', $nik);
        return $this->db->get()->row_array();
    }

    public function get_department_by_kode($kode){
        return $this->db->get_where('user_department',['kode'=>$kode])->row_array();
    }

    public function get_sub_department_by_name($kode_dept,$name){
        return $this->db->get_where('user_sub_department',['sub_department'=>$name, 'kode_dept' => $kode_dept])->row_array();
    }

    public function getUserMenu($role_id) {
        $this->db->select('menu.*');
        $this->db->from('menu');
        $this->db->join('user_access_menu', 'menu.id = user_access_menu.menu_id');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->order_by('menu.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getAllMenus() {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('menu')->result_array();
    }

    public function get_menu_by_id($menu_id) {
        return $this->db->get_where('menu', ['id' => $menu_id])->row_array();
    }

    public function get_all_roles() {
        $this->db->select('id as role_id, role');
        return $this->db->get('user_role')->result_array();
    }


    public function get_access_roles($menu_id) {
        $this->db->select('user.nama, user_role.role, user_access_menu.role_id');
        $this->db->from('user_access_menu');
        $this->db->join('user_role', 'user_access_menu.role_id = user_role.id');
        $this->db->join('user', 'user.role_id = user_role.id'); 
        $this->db->where('user_access_menu.menu_id', $menu_id);
        return $this->db->get()->result_array();
    }

    public function clear_access_roles($menu_id) {
        $this->db->delete('user_access_menu', ['menu_id' => $menu_id]);
    }

    public function insert_access_role($menu_id, $role_id) {
        $data = [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ];
        $this->db->insert('user_access_menu', $data);
    }

    public function get_all_columns_with_user($id) {
        $this->db->select('kolom_attributes.*, user.nama as nama_user');
        $this->db->from('kolom_attributes');        
        $this->db->join('user', 'kolom_attributes.user_id = user.id');
        $this->db->where('user_id', $id);
        $this->db->order_by('kolom_attributes.id', 'ASC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function insert_column($data) {
        $this->db->insert('kolom_attributes', $data);
    }

    public function get_all_tables() {
        $query = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public'");
        return $query->result_array();
    }

    public function get_table_data($table) {
        $query = $this->db->get($table);
        return $query->result_array();
    }

    // Mendapatkan semua data report dari tabel kolom_attributes
    public function get_reports() {
        $query = $this->db->get('kolom_attributes'); // Ambil semua data dari tabel kolom_attributes
        return $query->result_array(); // Mengembalikan hasil dalam bentuk array
    }

    // Mendapatkan semua data sub report dari tabel kolom_attributes
    public function get_sub_reports() {
        $query = $this->db->get('kolom_attributes'); // Ambil semua data dari tabel kolom_attributes
        return $query->result_array(); // Mengembalikan hasil dalam bentuk array
    }

    // Mendapatkan data report berdasarkan user_id
    // Webmodel.php

    public function get_reports_by_user($user_id) {
        $this->db->select('DISTINCT(ka.report)');
        $this->db->from('kolom_attributes ka');
        $this->db->where('ka.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Di dalam Webmodel.php
    public function get_sub_reports_by_report($user_id, $report) {
        $this->db->select('id, sub_report, status');
        $this->db->from('kolom_attributes');
        $this->db->where('user_id', $user_id);
        $this->db->where('report', $report);
        $this->db->group_by('id, sub_report');
        $sub_reports = $this->db->get()->result_array();
        return $sub_reports;
    }

    public function get_id_from_database($user_id, $report, $subreport, $status) {
        $this->db->select('id');
        $this->db->from('kolom_attributes');
        $this->db->where('user_id', strval($user_id));
        $this->db->where('report', $report);
        $this->db->where('sub_report', $subreport);
        $this->db->where('status', $status);
        $query = $this->db->get();
    
        // Check if query returns a row
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            return null; // Return null if no row is found
        }
    }

    public function update_closed_column() {
        $current_date = date('d'); // Mendapatkan hari dalam bulan

        // Jika tanggal 22
        if ($current_date == '22') {
            $last_month_date = date("Y-m-d", strtotime("first day of previous month")); // Mendapatkan tanggal pertama bulan kemarin
            $last_day_of_last_month = date("Y-m-t", strtotime($last_month_date)); // Mendapatkan tanggal terakhir bulan kemarin

            // Update kolom closed menjadi 1 untuk data yang memiliki periode bulan kemarin atau sebelumnya
            $this->db->set('closed', 1);
            $this->db->where('closed !=', 1);
            $this->db->where('periode <=', $last_day_of_last_month);
            $this->db->update('kolom_values');
        }
    }
    
    public function userHasAccess($role_id, $menu_name) {
        $this->db->select('menu.id, menu.menu'); // Memilih kolom yang dibutuhkan dari tabel menu
        $this->db->from('menu');
        $this->db->join('user_access_menu', 'menu.id = user_access_menu.menu_id');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->where('menu.menu', $menu_name); // Menambahkan kondisi untuk nama menu
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan hasil sebagai array
        } else {
            return null; // Mengembalikan null jika tidak ada hasil
        }
    }

    // Fungsi untuk mendapatkan semua sub_department
    public function get_all_sub_department() {
        $this->db->select('id, sub_department, department_id, kode_dept');
        $this->db->from('user_sub_department');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function get_suggested_status() {
        $this->db->select('status');
        $this->db->from('kolom_attributes');
        $this->db->group_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }

    // application/models/Webmodel.php
    public function get_department_by_id($id)
    {
        return $this->db->get_where('user_department', ['id' => $id])->row_array();
    }

    public function search_users($query) {
        log_message('debug', 'search_users method called with query: ' . $query);

        $lower_query = strtolower($query); // Mengubah query menjadi huruf kecil

        try {
            $this->db->select('u.id, u.nama, u.nik, u.username, u.role_id, d.department, sd.sub_department, r.role, u.status_periode');
            $this->db->from('user u');
            $this->db->join('user_department d', 'u.department_id = d.id', 'left');
            $this->db->join('user_sub_department sd', 'u.sub_department_id = sd.id', 'left');
            $this->db->join('user_role r', 'u.role_id = r.id', 'left');
            $this->db->like('LOWER(u.username)', $lower_query);
            $this->db->or_like('LOWER(u.nama)', $lower_query);
            $this->db->or_like('LOWER(u.nik)', $lower_query);
            $this->db->or_like('LOWER(d.department)', $lower_query);
            $this->db->or_like('LOWER(sd.sub_department)', $lower_query);
            $this->db->or_like('LOWER(r.role)', $lower_query);
            $this->db->order_by('u.id', 'ASC'); // Menambahkan order_by untuk mengurutkan berdasarkan kolom 'nama' secara ascending
            $query = $this->db->get();
            log_message('debug', 'Query executed: ' . $this->db->last_query());

            return $query->result_array();
        } catch (Exception $e) {
            log_message('error', 'Error in search_users method: ' . $e->getMessage());
            return [];
        }
    }

    public function search_reports($query, $user_id) {
        $lower_query = strtolower($query);
        $sql = "
            SELECT ka.id as kolom_id, ka.report, ka.sub_report, ka.status, kv.satuan, SUM(CAST(kv.value AS NUMERIC)) as total_value
            FROM kolom_attributes ka
            LEFT JOIN kolom_values kv ON ka.id = kv.kolom_id
            LEFT JOIN satuan s ON kv.satuan = s.id::text
            WHERE ka.user_id = ?
            AND (
                LOWER(ka.report) LIKE LOWER(?)
                OR LOWER(ka.sub_report) LIKE LOWER(?)
                OR LOWER(ka.status) LIKE LOWER(?)
                OR LOWER(kv.satuan) LIKE LOWER(?)
            )
            GROUP BY ka.id, ka.report, ka.sub_report, ka.status, kv.satuan
            HAVING SUM(CAST(kv.value AS NUMERIC)) > 0
            ORDER BY total_value DESC
        ";
        $params = [
            $user_id,
            "%$lower_query%",
            "%$lower_query%",
            "%$lower_query%",
            "%$lower_query%"
        ];
        $query = $this->db->query($sql, $params);
        $results = $query->result_array();
    
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'Results: ' . print_r($results, true));
    
        return $results;
    }

    public function get_reports_by_kolom_id($kolom_id,$period){
        $this->db->select('kolom_values.id, kolom_values.kolom_id, kolom_values.value, kolom_values.periode, kolom_values.satuan, kolom_attributes.report, kolom_attributes.sub_report, kolom_attributes.status');
        $this->db->from('kolom_values');
        $this->db->join('kolom_attributes', 'kolom_values.kolom_id = kolom_attributes.id');
        $this->db->where('kolom_values.kolom_id', $kolom_id);
        $this->db->where('kolom_values.periode', $period);
        return $this->db->get()->result_array();
    }

    public function get_managers_with_department() {
        $this->db->select('user.id, user.nama, user_department.department, user.department_id');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->where('user.role_id', 2);
        return $this->db->get()->result_array();
    }

    public function get_pics_by_department($department_id) {
        $this->db->select('user.id, user.nama');
        $this->db->from('user');
        $this->db->where('user.role_id', 3);
        $this->db->where('user.department_id', $department_id);
        return $this->db->get()->result_array();
    }

    public function get_all_kolom_reports() {
        $this->db->select('id, report, sub_report, status');
        $this->db->from('kolom_attributes');
        return $this->db->get()->result_array();
    }
    
    public function get_access_reports_by_manager($manager_id) {
        $this->db->select('kolom_id');
        $this->db->from('report_access');
        $this->db->where('user_id', $manager_id);
        return $this->db->get()->result_array();
    }
    

    public function get_manager_by_id($id){
        $this->db->select('user.id, user.nama, user_department.department, user.department_id');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->where('user.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_all_kolom_reports_with_department() {
        $this->db->select('ka.id, ka.report, ka.sub_report, ka.status, ud.department');
        $this->db->from('kolom_attributes ka');
        $this->db->join('user u', 'ka.user_id = u.id');
        $this->db->join('user_department ud', 'u.department_id = ud.id');
        return $this->db->get()->result_array();
    }

    public function get_reports_by_manager($manager_id) {
        $this->db->select('kolom_attributes.*');
        $this->db->from('report_access');
        $this->db->join('kolom_attributes', 'report_access.kolom_id = kolom_attributes.id');
        $this->db->where('report_access.user_id', $manager_id);
        return $this->db->get()->result_array();
    }

    public function check_access_exists($user_id, $kolom_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('kolom_id', $kolom_id);
        $query = $this->db->get('report_access');
        
        return $query->num_rows() > 0;
    }

    public function add_report_access($user_id, $kolom_id) {
        $data = [
            'user_id' => $user_id,
            'kolom_id' => $kolom_id
        ];
        $this->db->insert('report_access', $data);
    }

    public function remove_report_access($user_id, $kolom_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('kolom_id', $kolom_id);
        $this->db->delete('report_access');
    }

    public function get_kolom_reports() {
        $this->db->select('*');
        $this->db->from('kolom_attributes');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_access_role($manager_id) {
        $this->db->select('kolom_id');
        $this->db->from('report_access');
        $this->db->where('user_id', $manager_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function log_data(){
        $this->db->select('log_data.*, user.nama');
        $this->db->from('log_data');
        $this->db->join('user', 'log_data.user_id = user.id');
        return $this->db->get()->result_array();
    }

    public function get_unfilled_reports($department_id) {
        // Mendapatkan tanggal saat ini
        $currentDate = new DateTime();
        $currentDay = $currentDate->format('d');
        
        // Jika tanggal kurang dari 6, set periode ke bulan sebelumnya
        if ($currentDay < 6) {
            $currentDate->modify('-1 month');
        }
        
        $currentPeriod = $currentDate->format('Y-m-01'); // Periode berjalan dalam format "yyyy-mm-01"
        
        $this->db->select('u.id as user_id, u.nama as pic, ka.report, ka.sub_report, ka.status');
        $this->db->from('user u');
        $this->db->join('kolom_attributes ka', 'u.id = ka.user_id');
        $this->db->join('kolom_values kv', 'ka.id = kv.kolom_id AND kv.periode = \'' . $currentPeriod . '\'', 'left');
        $this->db->where('u.role_id', 3); // PIC memiliki role_id = 3
        $this->db->where('u.department_id', $department_id); // Filter berdasarkan department
        $this->db->where('kv.id IS NULL', null, false); // Kondisi di mana data belum diisi
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_kolom($query, $user_id) {
        $lower_query = strtolower($query);
        $this->db->select('ka.id as kolom_id, ka.report, ka.sub_report, ka.status');
        $this->db->from('kolom_attributes ka');
        $this->db->join('user u', 'ka.user_id = u.id');
        $this->db->where('ka.user_id', $user_id);
        $this->db->group_start();
        $this->db->like('LOWER(ka.report)', $lower_query);
        $this->db->or_like('LOWER(ka.sub_report)', $lower_query);
        $this->db->or_like('LOWER(ka.status)', $lower_query);
        $this->db->group_end();
        $this->db->order_by('ka.id', 'ASC');
        $query = $this->db->get();
        $results = $query->result_array();
    
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        log_message('debug', 'Results: ' . print_r($results, true));
    
        return $results;
    }
    
    
    
}