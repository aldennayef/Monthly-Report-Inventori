<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->db_inv = $this->load->database('inventori', TRUE);
	}

    public function get_user_data($username) {
        // $username = $this->session->userdata('username');
        
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        return $this->db->get()->row_array();
    }

    public function get_sub_dept_by_username($username){
        $this->db->select('sub_department_id');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->row_array();
    }

    public function get_items_by_id_cluster($id_cluster) {
        
        // Query dengan menggunakan dblink untuk join antar database
        $query = $this->db_inv->query("
            SELECT * from items
            WHERE id_cluster = ?", array($id_cluster));
        
        return $query->result_array();
    }

    public function get_jenis_items_by_nik_cluster($nik) {
        $this->db_inv->select('user.*, jenis_item.*');
        $this->db_inv->from('user');
        $this->db_inv->join('jenis_item', 'user.id_cluster = jenis_item.id_cluster');
        $this->db_inv->where('user.nik', $nik);
        return $this->db_inv->get()->result_array();
    }
    
    public function get_suggested_jenis() {
        $this->db_inv->select('jenis');
        $this->db_inv->from('items');
        $this->db_inv->group_by('jenis');
        $query = $this->db_inv->get();
        return $query->result_array();
    }

    public function get_all_user() {
        // Pastikan koneksi database utama sudah di-load
        $this->load->database();
    
        // Query untuk mengambil data user dari database utama
        $query = $this->db->query("
        SELECT u.*, ud.*, usd.*, invu.nama_cluster
        FROM public.user u
        JOIN public.user_department ud ON u.department_id = ud.id
        JOIN public.user_sub_department usd ON u.sub_department_id = usd.id
        LEFT JOIN dblink('dbname=inventori user=postgres password=password port=9603', 
                         'SELECT DISTINCT u.nik, u.id_cluster, c.nama_cluster 
                          FROM public.user u 
                          JOIN public.cluster c ON u.id_cluster = c.id_cluster') 
               AS invu(nik VARCHAR, id_cluster INT, nama_cluster VARCHAR) 
        ON u.nik = invu.nik;
        
        ");
        
        return $query->result_array();
    }
    
    public function get_all_cluster(){
        return $this->db_inv->get("cluster")->result_array();
    }
    public function insert_batch_cluster($data) {
        // Insert banyak data ke dalam tabel cluster sekaligus
        return $this->db_inv->insert_batch('cluster', $data);
    }
    
    public function get_cluster_by_id($id){
        return $this->db_inv->get_where('cluster',['id_cluster' => $id]) -> row_array();
    }
    
    public function get_cluster_by_kode($kode){
        return $this->db_inv->get_where('cluster',['kode_cluster' => $kode]) -> row_array();
    }
    
    public function update_cluster($id,$data){
        return $this->db_inv->update('cluster', $data, ['id_cluster'=>$id]);
    }
    
    public function check_nik($nik){
        return $this->db_inv->get_where('user', ['nik' => $nik])->row();
    }
    
    public function insert_nik_cluster($nik, $id_cluster){
        return $this->db_inv->insert('user',['nik'=>$nik, 'id_cluster'=>$id_cluster]);
    }
    
    public function update_user_cluster($nik, $id_cluster){
        return $this->db_inv->update('user', ['id_cluster' => $id_cluster], ['nik' => $nik]);
    }
    
    public function get_items_by_kode($kode){
        return $this->db_inv->get_where('items',['kode_item'=>$kode])->row_array();
    }
    
    public function insert_batch_item($data) {
        // Insert banyak data ke dalam tabel item sekaligus
        return $this->db_inv->insert_batch('items', $data);
    }

    public function delete_item($id_cluster, $kode_item){
        return $this->db_inv->delete('items',['id_cluster'=>$id_cluster,'kode_item'=>$kode_item]);
    }

    public function update_item($data, $where){
        return $this->db_inv->update('items', $data, $where);
    }

    public function get_pembelian_by_id_cluster($id_cluster){
        return $this->db_inv->get_where('pembelian', ['id_cluster'=>$id_cluster])->result_array();
    }
    
}