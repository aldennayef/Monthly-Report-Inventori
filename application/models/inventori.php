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

    public function get_nama_item_by_id_stok($idstok) {
        $this->db_inv->select('stok.id_stock, stok.kode_item, items.nama');
        $this->db_inv->from('stok');
        $this->db_inv->join('items','stok.kode_item = items.kode_item');
        $this->db_inv->where('id_stock', $idstok);
        $result = $this->db_inv->get()->row_array();
        return $result['nama'];
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
        LEFT JOIN dblink('dbname=inventori user=postgres password=password port=5555', 
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

    public function get_kode_item_join_from_pembelian($idbeli){
        $this->db_inv->select('pembelian.id_beli, pembelian.kode_item,stok.id_stock, stok.kode_item AS skode_item');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('stok', 'pembelian.kode_item = stok.kode_item');
        $this->db_inv->where('pembelian.id_beli', $idbeli);
        $result= $this->db_inv->get()->row_array();
        return $result['id_stock'];
    }
    public function update_tanggal($tabel,$data,$where){
        return $this->db_inv->update($tabel, $data, ['id_stock'=>$where]);
    }

    // public function count_kode_beli($kodePrefix) {
    //     $this->db_inv->select_max('kode_beli', 'max_kode');
    //     $this->db_inv->like('kode_beli', $kodePrefix, 'after');
    //     $result = $this->db_inv->get('pembelian')->row();
    
    //     if ($result && isset($result->max_kode)) {
    //         $lastKode = intval(str_replace($kodePrefix, '', $result->max_kode));
    //         return $lastKode;
    //     }
    //     return 0;
    // }
    
    // public function count_no_po($kodePrefix) {
    //     $this->db_inv->select_max('no_po', 'max_po');
    //     $this->db_inv->like('no_po', $kodePrefix, 'after');
    //     $result = $this->db_inv->get('pembelian')->row();
    
    //     if ($result && isset($result->max_po)) {
    //         $lastPO = intval(str_replace($kodePrefix, '', $result->max_po));
    //         return $lastPO;
    //     }
    //     return 0;
    // }

    public function count_kode_beli($kodePrefix) {
        $this->db_inv->select("MAX(CAST(SUBSTRING(kode_beli FROM LENGTH('$kodePrefix')+1) AS INTEGER)) AS max_kode", false);
        $this->db_inv->where("kode_beli LIKE '$kodePrefix%'");
        $query = $this->db_inv->get('pembelian');
        
        $result = $query->row();
        
        if ($result && isset($result->max_kode)) {
            return (int)$result->max_kode;
        }
        return 0;
    }

    public function count_no_po($kodePrefix) {
        $this->db_inv->select("MAX(CAST(SUBSTRING(no_po FROM LENGTH('$kodePrefix')+1) AS INTEGER)) AS max_kode", false);
        $this->db_inv->where("no_po LIKE '$kodePrefix%'");
        $query = $this->db_inv->get('pembelian');
        
        $result = $query->row();
        
        if ($result && isset($result->max_kode)) {
            return (int)$result->max_kode;
        }
        return 0;
    }

    public function insert_batch_pembelian($data){
        return $this->db_inv->insert_batch('pembelian',$data);
    }

    public function insert_staging_stok($data){
        return $this->db_inv->insert('staging_stok',$data);
    }

    public function get_stok_staging($kodebeli,$kodeitem){
        return $this->db_inv->get_where('staging_stok',['kode_beli'=> $kodebeli,'kode_item'=> $kodeitem])->row_array();
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
        $this->db_inv->select('pembelian.kode_item, items.nama');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('items', 'pembelian.kode_item = items.kode_item');
        $this->db_inv->where('pembelian.id_cluster', $id_cluster);
        $this->db_inv->group_by('pembelian.kode_item, items.nama');
        return $this->db_inv->get()->result_array();
    }
    

    public function get_item_by_kode_item($kodeitem, $id_cluster) {
        $this->db_inv->select('pembelian.*, items.*, stok.*');
        $this->db_inv->from('pembelian');
        $this->db_inv->join('items', 'pembelian.kode_item = items.kode_item');
        $this->db_inv->join('stok', 'stok.kode_item = items.kode_item'); // Join ke tabel stok untuk mendapatkan id_stock
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
    
    // Fungsi untuk mengambil data list chart dengan filter jenis
    public function list_chart() {
        $user_id_cluster = $this->session->userdata('id_cluster');  // Ambil id_cluster dari sesi
        $user_role = $this->session->userdata('role_id');
        $department_id = $this->session->userdata('department_id'); // Ambil department_id dari sesi
    
        $this->db_inv->select('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, SUM(stok.quantity_real) as total_items, stok.harga_satuan');
        $this->db_inv->from('cluster');
        $this->db_inv->join('items', 'items.id_cluster = cluster.id_cluster');
        $this->db_inv->join('stok', 'stok.kode_item = items.kode_item');
    
        if ($user_role == 3) { // Jika role karyawan
            $this->db_inv->where('cluster.id_cluster', $user_id_cluster);  // Filter berdasarkan id_cluster
        } elseif ($user_role == 2) { // Jika role manager
            $this->db_inv->join('user', 'user.nik = items.nik');
            $this->db_inv->where('user.department_id', $department_id); // Filter berdasarkan department_id
        }
    
        $this->db_inv->group_by('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, stok.harga_satuan');
        $query = $this->db_inv->get();
    
        return $query->result_array();
    }
    
    // Fungsi untuk mendapatkan jenis-jenis yang ada di dashboard list
    public function get_jenis_items_from_dashboard($dashboard_data) {
        $jenis_items = [];
        foreach ($dashboard_data as $data) {
            if (!in_array($data['jenis'], $jenis_items)) {
                $jenis_items[] = $data['jenis'];
            }
        }
        return $jenis_items;
    }
        
    public function get_monthly_stock_data_filtered($kode_item, $start_date = null, $end_date = null) {
        // Mengambil data stok tanpa filter tanggal jika start_date atau end_date kosong
        $this->db_inv->select("TO_CHAR(opname.waktu, 'YYYY-MM') as month, SUM(opname.stok_real) as total_quantity");
        $this->db_inv->from('opname');
        $this->db_inv->where('opname.kode_item', $kode_item);
    
        // Jika ada filter tanggal, tambahkan ke query
        if (!empty($start_date) && !empty($end_date)) {
            $this->db_inv->where("TO_CHAR(opname.waktu, 'YYYY-MM') >=", $start_date);
            $this->db_inv->where("TO_CHAR(opname.waktu, 'YYYY-MM') <=", $end_date);
        }
    
        $this->db_inv->group_by("TO_CHAR(opname.waktu, 'YYYY-MM')");
        $this->db_inv->order_by("month", "ASC");
    
        $query = $this->db_inv->get();
    
        if (!$query) {
            $error = $this->db_inv->error();
            throw new Exception("Database query failed: " . $error['message']);
        }
    
        return $query->result_array();
    }
    
    
    public function get_monthly_purchase_data($kode_item, $month = null) {
        $this->db_inv->select("TO_CHAR(pembelian.realisasi_at, 'YYYY-MM') as month, SUM(pembelian.quantity) as total_quantity");
        $this->db_inv->from('pembelian');
        $this->db_inv->where('pembelian.kode_item', $kode_item);
        if ($month) {
            $this->db_inv->where("TO_CHAR(pembelian.realisasi_at, 'YYYY-MM') =", $month);
        }
        $this->db_inv->group_by("TO_CHAR(pembelian.realisasi_at, 'YYYY-MM')");
        $this->db_inv->order_by("month", "ASC");
    
        $query = $this->db_inv->get();
    
        if (!$query) {
            $error = $this->db_inv->error();
            throw new Exception("Database query failed: " . $error['message']);
        }
    
        return $query->result_array();
    }
    
    public function get_monthly_usage_data($kode_item, $month = null) {
        $this->db_inv->select("TO_CHAR(pemakaian.waktu, 'YYYY-MM') as month, SUM(pemakaian.jml_pakai) as total_quantity");
        $this->db_inv->from('pemakaian');
        $this->db_inv->join('stok', 'stok.id_stock = pemakaian.id_stock');
        $this->db_inv->where('stok.kode_item', $kode_item);
        if ($month) {
            $this->db_inv->where("TO_CHAR(pemakaian.waktu, 'YYYY-MM') =", $month);
        }
        $this->db_inv->group_by("TO_CHAR(pemakaian.waktu, 'YYYY-MM')");
        $this->db_inv->order_by("month", "ASC");
    
        $query = $this->db_inv->get();
    
        if (!$query) {
            $error = $this->db_inv->error();
            throw new Exception("Database query failed: " . $error['message']);
        }
    
        return $query->result_array();
    }
    
    
        public function get_user_clusters($nik) {
            // Fetch all cluster IDs the user has access to based on their NIK
            $this->db_inv->select('id_cluster');
            $this->db_inv->from('user');
            $this->db_inv->where('nik', $nik);
            
            $query = $this->db_inv->get();
            
            if (!$query) {
                $error = $this->db_inv->error();
                throw new Exception("Database query failed: " . $error['message']);
            }
        
            $result = $query->result_array();
            return array_column($result, 'id_cluster'); // Return an array of cluster IDs
        }
        
        public function get_item_data($kode_item) {
            // Fetch the item data based on the item code, including cluster ID
            $this->db_inv->select('id_cluster, nama as item_name');
            $this->db_inv->from('items');
            $this->db_inv->where('kode_item', $kode_item);
            
            $query = $this->db_inv->get();
            
            if (!$query) {
                $error = $this->db_inv->error();
                throw new Exception("Database query failed: " . $error['message']);
            }
        
            return $query->row_array();
        }
    
        public function get_jenis_items_by_user_clusters($user_clusters) {
            if (empty($user_clusters)) {
                return [];
            }
        
            $this->db_inv->select('DISTINCT items.jenis', false);
            $this->db_inv->from('items');
            $this->db_inv->where_in('items.id_cluster', $user_clusters); 
            $query = $this->db_inv->get();
        
            if (!$query) {
                $error = $this->db_inv->error();
                throw new Exception("Database query failed: " . $error['message']);
            }
        
            return $query->result_array();
        }
        
        public function get_dashboard_data($user_clusters = null, $department_id = null, $jenis_filter = null) {
            $this->db_inv->select('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, SUM(stok.quantity_real) as total_items, stok.harga_satuan');
            $this->db_inv->from('cluster');
            $this->db_inv->join('items', 'items.id_cluster = cluster.id_cluster');
            $this->db_inv->join('stok', 'stok.kode_item = items.kode_item');
        
            if ($this->session->userdata('role_id') == 3) {
                if (!empty($user_clusters)) {
                    $this->db_inv->where_in('cluster.id_cluster', $user_clusters);
                }
            } elseif ($this->session->userdata('role_id') == 2) {
                if (!empty($department_id)) {
                    $this->db_inv->join('user', 'user.nik = items.nik');
                    $this->db_inv->where('user.department_id', $department_id);
                }
            }
        
            if (!empty($jenis_filter)) {
                $this->db_inv->where('items.jenis', $jenis_filter); // Filter by jenis
            }
        
            $this->db_inv->group_by('cluster.nama_cluster, cluster.kode_cluster, items.jenis, items.kode_item, items.nama, stok.harga_satuan');
            $query = $this->db_inv->get();
        
            if (!$query) {
                $error = $this->db_inv->error();
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
                'dbname=monthly_report user=postgres password=password port=5555', 
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
                'dbname=monthly_report user=postgres password=password port=5555', 
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
    
    public function get_log_data(){
        return $this->db_inv->get('log_data')->result_array();
    }

    public function insert_stok_adjust($data){
        return $this->db_inv->insert('stok_adjust', $data);
    }

    public function get_data_stok_adjust($idcluster) {
        $subquery = $this->db_inv
            ->select('kode_item, MAX(adjust_at) as max_adjust_at')
            ->from('stok_adjust')
            ->where('id_cluster', $idcluster)
            ->group_by('kode_item')
            ->get_compiled_select();
    
        $this->db_inv->select('sa.id_cluster, sa.kode_item, sa.stok_real, sa.stok_adjust, sa.adjust_at, sa.deskripsi');
        $this->db_inv->from('stok_adjust sa');
        $this->db_inv->join("($subquery) as latest", 'sa.kode_item = latest.kode_item AND sa.adjust_at = latest.max_adjust_at', 'inner');
        $this->db_inv->where('sa.id_cluster', $idcluster);
    
        return $this->db_inv->get()->result_array();
    }

    public function get_detail_stok_adjust($idcluster) {
        $this->db_inv->select('stok_adjust.*, items.nama');
        $this->db_inv->from('stok_adjust');
        $this->db_inv->join('items','stok_adjust.kode_item = items.kode_item');
        $this->db_inv->where('stok_adjust.id_cluster', $idcluster);
        return $this->db_inv->get()->result_array();
    }

    // baru
    public function get_info_staging_stok($kodebeli,$kodeitem) {
        return $this->db_inv->get_where('staging_stok',['kode_beli'=>$kodebeli, 'kode_item'=>$kodeitem])->row_array();
    }

    public function update_staging_stok($data,$where){
        return $this->db_inv->update('staging_stok',$data,$where);
    }

    public function get_kode_cluster($idcluster){
        return $this->db_inv->get_where('cluster',['id_cluster'=>$idcluster])->row_array();
    }

    public function count_kode_item($kodePrefix) {
        $this->db_inv->select("MAX(CAST(SUBSTRING(kode_item FROM LENGTH('$kodePrefix')+1) AS INTEGER)) AS max_kode", false);
        $this->db_inv->where("kode_item LIKE '$kodePrefix%'");
        $query = $this->db_inv->get('items');
        
        $result = $query->row();
        
        if ($result && isset($result->max_kode)) {
            return (int)$result->max_kode;
        }
        return 0;
    }
    

    public function get_nik_by_department($user_department) {
        // Query ke database inventori untuk mendapatkan nik
        $query = $this->db_inv->query("
            SELECT inv_user.nik, inv_user.id_cluster
            FROM public.user inv_user
            JOIN dblink('dbname=monthly_report user=postgres password=password port=5555', 
                'SELECT nik, \"department_id\", role_id FROM public.user WHERE role_id = 3') 
                AS mr_user(nik VARCHAR, department_id INTEGER, role_id INTEGER)
            ON inv_user.nik = mr_user.nik
            WHERE mr_user.department_id = {$user_department}
        ");
        
        return $query->result_array();  // Mengembalikan array nik dan id_cluster
    }
    

    public function get_table_data_by_nik($tableName, $idcluster, $nik) {
        $this->db_inv->where('id_cluster', $idcluster);
        $this->db_inv->where('nik', $nik);
        $query = $this->db_inv->get($tableName);
        return $query->result_array();
    }
    

}