<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventori extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->db_inv = $this->load->database('inventori', TRUE);
        $this->db_user = $this->load->database('db_user', TRUE);
	}

    public function get_department_id_by_nik($nik){
        return $this->db->get_where('user',['nik'=>$nik])->row();
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
        // $query = $this->db_inv->query("
        //     SELECT * from items
        //     WHERE id_cluster = ?", array($id_cluster));
        
        // return $query->result_array();

        $this->db_inv->select('items.id_cluster AS iid_cluster, items.kode_item AS ikode_item, items.jenis AS ijenis, 
        items.nama AS inama, items.note AS inote, items.create_at AS icreate_at, stok.*');
        $this->db_inv->from('items');
        $this->db_inv->join('stok', 'items.kode_item = stok.kode_item', 'left');
        $this->db_inv->where('items.id_cluster', $id_cluster);
        $this->db_inv->order_by('items.kode_item', 'ASC');
        return $this->db_inv->get()->result_array();
    }

    public function get_jenis_items_by_nik_cluster($nik) {
        $this->db_inv->select('user.*, jenis_item.*');
        $this->db_inv->from('user');
        $this->db_inv->join('jenis_item', 'user.id_cluster = jenis_item.id_cluster');
        $this->db_inv->where('user.nik', $nik);
        return $this->db_inv->get()->result_array();
    }

    public function insert_jenisitem($data){
        return $this->db_inv->insert('jenis_item',$data);
    }

    public function delete_nama_jenis($data, $idcluster) {
        // $data harus berupa array of strings
        return $this->db_inv->where_in('nama_jenis', $data)
                            ->where('id_cluster', $idcluster)
                            ->delete('jenis_item');
    }

    public function get_jenis_item_by_nama_cluster($namajenis,$idcluster){
        return $this->db_inv->get_where('jenis_item',['nama_jenis'=>$namajenis,'id_cluster'=>$idcluster])->row_array();
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
        LEFT JOIN dblink('dbname=inventori user=postgres password=password port=7070', 
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
        // return $this->db_inv->get_where('pembelian', ['id_cluster'=>$id_cluster])->result_array();
        $this->db_inv->select('pembelian.*,stok.*');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('stok', 'pembelian.kode_item = stok.kode_item');
        $this->db_inv->where('pembelian.id_cluster', $id_cluster);
        return $this->db_inv->get()->result_array();
    }

    public function count_kode_beli($kodePrefix) {
        $this->db_inv->select_max('kode_beli', 'max_kode');
        $this->db_inv->like('kode_beli', $kodePrefix, 'after');
        $result = $this->db_inv->get('pembelian')->row();
    
        if ($result && isset($result->max_kode)) {
            $lastKode = intval(str_replace($kodePrefix, '', $result->max_kode));
            return $lastKode;
        }
        return 0;
    }
    
    public function count_no_po($kodePrefix) {
        $this->db_inv->select_max('no_po', 'max_po');
        $this->db_inv->like('no_po', $kodePrefix, 'after');
        $result = $this->db_inv->get('pembelian')->row();
    
        if ($result && isset($result->max_po)) {
            $lastPO = intval(str_replace($kodePrefix, '', $result->max_po));
            return $lastPO;
        }
        return 0;
    }

    public function insert_batch_pembelian($data){
        return $this->db_inv->insert_batch('pembelian',$data);
    }

    public function check_kode_beli($kode){
        return $this->db_inv->get_where('pembelian', ['kode_beli'=>$kode])->row_array();
    }

    public function check_kode_item($kode){
        return $this->db_inv->get_where('pembelian', ['kode_item'=>$kode])->row_array();
    }

    public function insert_batch_stok($data){
        return $this->db_inv->insert_batch('stok',$data);
    }

    public function check_stok($kodeitem){
        return $this->db_inv->get_where('stok',['kode_item'=>$kodeitem])->row_array();
    }
    
    public function insert_pembelian($data) {
        $this->db_inv->insert('pembelian', $data);
    }

    public function update_qty_pembelian($data,$kodebeli,$kodeitem){
        return $this->db_inv->update('pembelian',$data, ['kode_beli'=>$kodebeli,'kode_item'=>$kodeitem]);
    }
    
    public function update_stok($kode_item, $data) {
        $this->db_inv->where('kode_item', $kode_item);
        $this->db_inv->update('stok', $data);
    }
    
    public function insert_stok($data) {
        $this->db_inv->insert('stok', $data);
    }
    
    public function get_pemakaian_by_id_cluster($idcluster){
        // return $this->db_inv->get_where('pemakaian', ['id_cluster'=>$idcluster])->result_array();
        $this->db_inv->select('pemakaian.*, items.*, stok.*');
        $this->db_inv->from('pemakaian');
        $this->db_inv->join('stok', 'pemakaian.id_stock = stok.id_stock');
        $this->db_inv->join('items', 'stok.kode_item = items.kode_item');
        $this->db_inv->where('pemakaian.id_cluster', $idcluster);
        $this->db_inv->order_by('pemakaian.nopakai', 'ASC');
        return $this->db_inv->get()->result_array();
    }

    public function count_no_pakai($kodePrefix, $id_cluster) {
        $this->db_inv->select_max('nopakai', 'max_kode');
        $this->db_inv->like('nopakai', $kodePrefix, 'after');
        $this->db_inv->where('id_cluster', $id_cluster);
        $result = $this->db_inv->get('pemakaian')->row();
    
        if ($result && isset($result->max_kode)) {
            $lastKode = intval(str_replace($kodePrefix, '', $result->max_kode));
            return $lastKode;
        }
        return 0;
    }
    
    public function get_item_from_po_by_id_cluster($id_cluster){
        $this->db_inv->select('pembelian.*, items.*');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('items', 'pembelian.kode_item = items.kode_item');
        $this->db_inv->where('pembelian.id_cluster', $id_cluster);
        return $this->db_inv->get()->result_array();
    }

    public function get_item_by_no_po($no_po, $kodeitem, $id_cluster) {
        $this->db_inv->select('pembelian.*, items.*, stok.*');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('items', 'pembelian.kode_item = items.kode_item');
        $this->db_inv->join('stok', 'stok.kode_item = items.kode_item'); // Join ke tabel stok untuk mendapatkan id_stock
        $this->db_inv->where('pembelian.no_po', $no_po);
        $this->db_inv->where('items.kode_item', $kodeitem);
        $this->db_inv->where('pembelian.id_cluster', $id_cluster);
        return $this->db_inv->get()->result_array();
    }
    

    public function get_data_user_from_external_db(){
    
        return $this->db_user->get('user')->result_array();
    }

    public function get_data_user_from_external_db_by_nik($nik){
        $this->db_user->select('nama,department');
        $this->db_user->from('user');
        $this->db_user->where('nik', $nik);
        $query = $this->db_user->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_all_users_from_external_db() {
        $this->db_user->select('nik, nama, department');
        $this->db_user->from('user');
        $query = $this->db_user->get();
        return $query->result_array();  // Mengembalikan hasil sebagai array
    }
    
    public function insert_pemakaian($data)
    {
        return $this->db_inv->insert('pemakaian',$data);
    }

    public function get_pemakaian_unik_by_id_cluster($idcluster) {
        $this->db_inv->select('
            nopakai,
            ARRAY_AGG(DISTINCT id_stock) as items,
            MIN(id_pakai) as id_pakai, 
            MIN(jenis_pakai) as jenis_pakai, 
            MIN(nama_pemakai) as nama_pemakai, 
            MIN(nik_pemakai) as nik_pemakai, 
            MIN(pemberi) as pemberi, 
            MIN(deskripsi) as deskripsi, 
            MIN(waktu) as waktu, 
            MIN(id_cluster) as id_cluster
        ');
        $this->db_inv->from('pemakaian');
        $this->db_inv->where('id_cluster', $idcluster);
        $this->db_inv->group_by('nopakai');
        $query = $this->db_inv->get();
        return $query->result_array();
    }
    
    public function updateJumlahPemakaian($data,$jmlpakaiold,$nopakai,$idStock,$idcluster){
        return $this->db_inv->update('pemakaian',$data,['id_stock'=>$idStock,'nopakai'=>$nopakai,'jml_pakai'=>$jmlpakaiold,'id_cluster'=>$idcluster]);
    }
    
    public function update_quantity_real($data,$idstock){
        return $this->db_inv->update('stok',$data,['id_stock'=>$idstock]);
    }

    public function update_quantity_real_by_kode_item($data,$kodeitem){
        return $this->db_inv->update('stok',$data,['kode_item'=>$kodeitem]);
    }

    public function get_kunjungan($idcluster){
        return $this->db_inv->get_where('kunjungan', ['id_cluster'=>$idcluster])->result_array();
    }


    public function insert_kunjungan($data){
        return $this->db_inv->insert('kunjungan',$data);
    }

    public function get_detail_items($idcluster) {
        $this->db_inv->select('items.id_cluster, items.kode_item, items.nama, stok.quantity_real, SUM(pembelian.quantity) as total_quantity');
        $this->db_inv->from('items');
        $this->db_inv->join('stok', 'items.kode_item = stok.kode_item');
        $this->db_inv->join('pembelian', 'items.kode_item = pembelian.kode_item', 'left');
        $this->db_inv->where('items.id_cluster', $idcluster);
        $this->db_inv->group_by('items.id_cluster, items.kode_item, items.nama, stok.quantity_real');
        return $this->db_inv->get()->result_array();
    }
    
    public function insert_opname($data){
        return $this->db_inv->insert('opname',$data);
    }

    public function get_data_opname($idcluster) {
        $subquery = $this->db_inv
            ->select('kode_item, MAX(waktu) as max_waktu')
            ->from('opname')
            ->where('id_cluster', $idcluster)
            ->group_by('kode_item')
            ->get_compiled_select();
    
        $this->db_inv->select('o.id_cluster, o.kode_item, o.stok_real, o.selisih, o.hasil, o.waktu');
        $this->db_inv->from('opname o');
        $this->db_inv->join("($subquery) as latest", 'o.kode_item = latest.kode_item AND o.waktu = latest.max_waktu', 'inner');
        $this->db_inv->where('o.id_cluster', $idcluster);
    
        return $this->db_inv->get()->result_array();
    }

    public function get_detail_data_opname($idcluster){
        return $this->db_inv->get_where('opname',['id_cluster'=>$idcluster])->result_array();
    }
    
    // Fungsi untuk mengambil data list chart
    public function list_chart() {
        // Fetch data from the cluster, items, and stok tables
        $this->db_inv->select('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, SUM(stok.quantity_real) as total_items, stok.harga_satuan');
        $this->db_inv->from('cluster');
        $this->db_inv->join('items', 'items.id_cluster = cluster.id_cluster'); // Join tables cluster and items
        $this->db_inv->join('stok', 'stok.kode_item = items.kode_item'); // Join with stok table to get total quantity and price
        $this->db_inv->group_by('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, stok.harga_satuan'); // Group by to include all selected columns
        $query = $this->db_inv->get();
        return $query->result_array();
    }

    public function get_monthly_stock_data($kode_item) {
        $this->db_inv->select("TO_CHAR(stok.exp_date, 'YYYY-MM') as month, SUM(stok.quantity_real) as total_quantity, items.nama as item_name");
        $this->db_inv->from('stok');
        $this->db_inv->join('items', 'items.kode_item = stok.kode_item');
        $this->db_inv->where('stok.kode_item', $kode_item);
        $this->db_inv->group_by("TO_CHAR(stok.exp_date, 'YYYY-MM'), items.nama");
        $this->db_inv->order_by("month", "ASC");
        
        $query = $this->db_inv->get();
        
        if (!$query) {
            $error = $this->db_inv->error(); // Get the error details
            throw new Exception("Database query failed: " . $error['message']);
        }
    
        // Debugging: Log the query result
        log_message('debug', 'get_monthly_stock_data result: ' . json_encode($query->result_array()));
        
        return $query->result_array();
    }
    

    // Fungsi untuk mengambil data pembelian bulanan
    public function get_monthly_purchase_data($kode_item) {
        // Select month and total purchased quantity
        $this->db_inv->select("TO_CHAR(pembelian.realisasi_at, 'YYYY-MM') as month, SUM(pembelian.quantity) as total_quantity");
        $this->db_inv->from('pembelian');
        $this->db_inv->where('pembelian.kode_item', $kode_item);
        $this->db_inv->group_by("TO_CHAR(pembelian.realisasi_at, 'YYYY-MM')");
        $this->db_inv->order_by("month", "ASC");
        
        $query = $this->db_inv->get();
        
        if (!$query) {
            $error = $this->db_inv->error(); // Get the error details
            throw new Exception("Database query failed: " . $error['message']);
        }
        
        return $query->result_array();
    }

    // Fungsi untuk mengambil data pemakaian bulanan
    public function get_monthly_usage_data($kode_item) {
        // Select month and total used quantity
        $this->db_inv->select("TO_CHAR(pemakaian.waktu, 'YYYY-MM') as month, SUM(pemakaian.jml_pakai) as total_quantity");
        $this->db_inv->from('pemakaian');
        $this->db_inv->join('stok', 'stok.id_stock = pemakaian.id_stock'); // Join stok with pemakaian to match items
        $this->db_inv->where('stok.kode_item', $kode_item);
        $this->db_inv->group_by("TO_CHAR(pemakaian.waktu, 'YYYY-MM')");
        $this->db_inv->order_by("month", "ASC");
        
        $query = $this->db_inv->get();
        
        if (!$query) {
            $error = $this->db_inv->error(); // Get the error details
            throw new Exception("Database query failed: " . $error['message']);
        }
        
        return $query->result_array();
    }

    // MANAGER
    public function get_data_item_by_department($department_id) {
        // Buat query menggunakan query builder atau manual query
        $query = $this->db_inv->query("
            SELECT 
                i.kode_item AS ikode_item, 
                i.jenis as ijenis, 
                i.nama as inama, 
                i.note as inote, 
                i.id_cluster as iid_cluster,
                i.create_at as icreate_at, 
                mr_user.nama AS nama_user, 
                mr_user.department_id, 
                s.*
            FROM items i 
            JOIN public.user inv_user ON i.id_cluster = inv_user.id_cluster 
            LEFT JOIN stok s ON s.kode_item = i.kode_item
            JOIN dblink(
                'dbname=monthly_report user=postgres password=password port=7070', 
                'SELECT nik, nama, \"department_id\", role_id FROM public.user'
            ) AS mr_user(nik VARCHAR, nama VARCHAR, department_id INTEGER, role_id INTEGER)
            ON inv_user.nik = mr_user.nik
            WHERE mr_user.role_id = 3 
            AND mr_user.department_id = {$department_id}
        ");
        
        // Kembalikan hasil query
        return $query->result_array();  // Mengembalikan array asosiatif
    }
    

    public function get_data_jenis_item_by_department($department_id){
        // Buat query menggunakan query builder atau manual query
        $query = $this->db_inv->query("
            SELECT j.*, mr_user.nama, mr_user.department_id 
            FROM jenis_item j
            JOIN public.user inv_user ON j.id_cluster = inv_user.id_cluster 
            JOIN dblink(
                'dbname=monthly_report user=postgres password=password port=7070', 
                'SELECT nik, nama, \"department_id\", role_id FROM public.user'
            ) AS mr_user(nik VARCHAR, nama VARCHAR, department_id INTEGER, role_id INTEGER)
            ON inv_user.nik = mr_user.nik
            WHERE mr_user.role_id = 3 
            AND mr_user.department_id = {$department_id}
        ");
        
        // Kembalikan hasil query
        return $query->result_array();  // Mengembalikan array asosiatif
    }
    
    
    // for backup
    public function has_id_cluster_column($table) {
        $fields = $this->db_inv->list_fields($table);
        return in_array('id_cluster', $fields);
    }
    public function get_all_tables() {
        $query = $this->db_inv->query("SELECT table_name FROM information_schema.tables WHERE table_schema='public'");
        return $query->result_array();
    }

    public function get_table_data($table, $id_cluster) {
        if ($id_cluster !== null && $this->has_id_cluster_column($table)) {
            $this->db_inv->where('id_cluster', $id_cluster);
        }
        $query = $this->db_inv->get($table);
        return $query->result_array();
    }
    
    
}