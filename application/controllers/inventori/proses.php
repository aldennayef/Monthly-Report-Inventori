<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->db_inv = $this->load->database('inventori', TRUE);
        $this->load->model('inventori');
    }

    public function index() {
        $nik = $this->session->userdata('nik');
        $role_id = $this->session->userdata('role_id');
        $department_id = $this->session->userdata('department_id');
    
        $user_clusters = $this->inventori->get_user_clusters($nik);
        $jenis_filter = $this->input->get('jenis');
    
        if ($role_id == 3) {
            if ($this->inventori->check_nik($nik)) {
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $data['dashboard_data'] = $this->inventori->get_dashboard_data($user_clusters, null, $jenis_filter);
            } else {
                redirect('home');
                return;
            }
        } elseif ($role_id == 2) {
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['dashboard_data'] = $this->inventori->get_dashboard_data(null, isset($department_id) ? $department_id : null, $jenis_filter);
        } elseif ($role_id == 1 || $role_id == 4) {
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['logdata'] = $this->inventori->get_log_data();
            $data['dashboard_data'] = $this->inventori->get_dashboard_data($user_clusters, null, $jenis_filter);
        } else {
            redirect('home');
            return;
        }
    
        // Ambil jenis items dari dashboard_data untuk filter
        $data['jenis_items'] = $this->inventori->get_jenis_items_from_dashboard($data['dashboard_data']);
    
        $this->load->view('inventori/header', $data);
        $this->load->view('inventori/navbar');
        $this->load->view('inventori/sidebar', $data);
        $this->load->view('inventori/dashboard', $data); // Pastikan view menerima $data['jenis_items']
        $this->load->view('inventori/footer');
    }
    
    
    public function more_info() {
        try {
            // Ambil data dari request POST
            $kode_item = $this->input->post('kode_item');
            $chart_type = $this->input->post('chart_type');
            $start_date = $this->input->post('start_month');
            $end_date = $this->input->post('end_month');
            $month = $this->input->post('month');  // Ambil 'month' untuk chart 'bar'
    
            // Validasi input
            if (empty($kode_item)) {
                throw new Exception("No item code provided");
            }
    
            // Jika start_date atau end_date kosong, ambil semua data (tanpa filter tanggal)
            if (empty($start_date) || empty($end_date)) {
                $start_date = null; // Kosongkan untuk mengambil semua data
                $end_date = null;
            }
    
            // Persiapan variabel
            $labels = [];
            $formatted_data = [];
    
            // Proses chart line
            if ($chart_type === 'line') {
                $chart_data = $this->inventori->get_monthly_stock_data_filtered($kode_item, $start_date, $end_date);
    
                foreach ($chart_data as $data) {
                    $labels[] = $data['month'];  
                    $formatted_data[] = $data['total_quantity'];
                }
    
                if (empty($formatted_data)) {
                    echo json_encode(['labels' => [], 'data' => []]);
                    return;
                }
    
            // Proses chart bar
            } elseif ($chart_type === 'bar') {
                if (empty($month)) {
                    throw new Exception("No month provided for bar chart");
                }
    
                // Ambil data pembelian dan pemakaian
                $purchase_data = $this->inventori->get_monthly_purchase_data($kode_item, $month);
                $usage_data = $this->inventori->get_monthly_usage_data($kode_item, $month);
    
                // Inisialisasi data yang diformat
                $formatted_data = [
                    'purchase' => [],
                    'usage' => []
                ];
    
                $unique_labels = [];
    
                // Proses data pembelian
                foreach ($purchase_data as $data) {
                    $month_label = $data['month'];
                    $unique_labels[$month_label] = $month_label;
                    $formatted_data['purchase'][$month_label] = $data['total_quantity'];
                }
    
                // Proses data pemakaian
                foreach ($usage_data as $data) {
                    $month_label = $data['month'];
                    $unique_labels[$month_label] = $month_label;
                    $formatted_data['usage'][$month_label] = $data['total_quantity'];
                }
    
                // Simpan labels unik dan isi data jika tidak ada
                $labels = array_values($unique_labels);
                foreach ($labels as $month_label) {
                    $formatted_data['purchase'][$month_label] = $formatted_data['purchase'][$month_label] ?? 0;
                    $formatted_data['usage'][$month_label] = $formatted_data['usage'][$month_label] ?? 0;
                }
            }
    
            // Kirim respons JSON
            echo json_encode(['labels' => $labels, 'data' => $formatted_data]);
    
        } catch (Exception $e) {
            // Jika terjadi error, log error dan kirim respons JSON dengan pesan error
            log_message('error', $e->getMessage());
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
    
    
    
    public function detail_users(){
        if($this->session->userdata('role_id') == 1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['all_users'] = $this->inventori->get_all_user();
            $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_users', $data);
        }else{
            redirect('home');
        }    
    }

    public function aksi_users(){
        if($this->session->userdata('role_id')==1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $nik = $this->input->post('nik');
            $nama_user = $this->input->post('nama_user');
            $id_cluster = $this->input->post('id_cluster');
            $namaCluster = $this->inventori->get_cluster_by_id($id_cluster);
            if(!$this->inventori->check_nik($nik)){
                if($this->inventori->insert_nik_cluster($nik, $id_cluster)){
                    $logdata = [
                        'id_user' => $this->session->userdata('id'),
                        'username' => $this->session->userdata('username'),
                        'act_note' => 'Menambah cluster baru = '.$namaCluster['nama_cluster'].' untuk user '.$nama_user.' '. $nik,
                    ];
            
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    $this->db_inv->insert('log_data', $logdata);
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'success_add']);
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed_add']);
                }
            }else{
                if($this->inventori->update_user_cluster($nik, $id_cluster)){
                    $logdata = [
                        'id_user' => $this->session->userdata('id'),
                        'username' => $this->session->userdata('username'),
                        'act_note' => 'Mengupdate cluster baru = '.$namaCluster['nama_cluster'].' untuk user '.$nama_user.' '. $nik,
                    ];
            
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    $this->db_inv->insert('log_data', $logdata);
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'success_update']);
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed_update']);
                }
            }
        }
    }
    
    public function detail_clusters(){
        if($this->session->userdata('role_id')==1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_clusters', $data);
        }else{
            redirect('home');
        }    
    }

    public function tambah_clusters(){
        if($this->session->userdata('role_id')==1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            // $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/tambah_cluster', $data);
        }else{
            redirect('home');
        }    
    }

    public function aksi_clusters(){
        if($this->session->userdata('role_id')==1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $type = $this->input->post('type');
            if($type === 'add'){
                // Ambil data dari form
                $kodeCluster = $this->input->post('kodecluster');
                $namaCluster = $this->input->post('namacluster');
                foreach ($kodeCluster as $kode) {
                    if(!$this->inventori->get_cluster_by_kode($kode)){
                        // Siapkan array untuk menyimpan banyak data
                        $data = array();
                        
                        try {
                            // Looping melalui input dan siapkan data untuk insert batch
                            for ($i = 0; $i < count($kodeCluster); $i++) {
                                // Debugging log
                                error_log('Processing cluster: ' . $namaCluster[$i]);
                        
                                $data[] = array(
                                    'kode_cluster' => $kodeCluster[$i],
                                    'nama_cluster' => $namaCluster[$i],
                                    'create_at' => date('Y-m-d'),
                                );
                        
                                $logdata = [
                                    'id_user' => $this->session->userdata('id'),
                                    'username' => $this->session->userdata('username'),
                                    'act_note' => 'Tambah Cluster Baru = '.$namaCluster[$i],
                                ];
                        
                                
                            }
                        
                            
                        } catch (Exception $e) {
                            error_log('Error: ' . $e->getMessage());
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'failed']);
                        }            
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'duplicate', 'kode'=>$kode]);
                    }
                }
                // Masukkan data ke dalam tabel cluster melalui model dengan insert_batch
                if ($this->inventori->insert_batch_cluster($data)) {
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    $this->db_inv->insert('log_data', $logdata);
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'success']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed']);
                }
            } else {
                $clusterId = $this->input->post('id_cluster');
                $newCluster = $this->input->post('nama_cluster');
                $oldCluster = $this->input->post('nama_cluster_old');
                $newkodeCluster = $this->input->post('kode_cluster');
                $oldkodeCluster = $this->input->post('kode_cluster_old');
                if(!$this->inventori->get_cluster_by_kode($newkodeCluster) || $newkodeCluster == $oldkodeCluster){
                    try{
                        $dataUpdateCluster = [
                            'kode_cluster' => $newkodeCluster,
                            'nama_cluster' => $newCluster
                        ];
                        $logdata = [
                            'id_user' => $this->session->userdata('id'),
                            'username' => $this->session->userdata('username'),
                            'act_note' => 'Mengupdate Cluster Kode '. $oldkodeCluster.' => '.$newkodeCluster.' dan '.$oldCluster.' => '.$newCluster,
                        ];
                
                        $this->db_inv->set('act_date', 'NOW()', FALSE);
                        $this->db_inv->insert('log_data', $logdata);

                        if($this->inventori->update_cluster($clusterId, $dataUpdateCluster)){
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'success']);
                        }else{
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'failed']);
                        }
                    }catch (Exception $e){
                        header('Content-Type: application/json');
                            echo json_encode(['status'=> 'failed']);
                    }
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'duplicate']);
                }
            }
        }
    }
    

    public function detail_item(){
        if($this->session->userdata('role_id') != 1){
            $user = $this->inventori->check_nik($this->session->userdata('nik'));
            
            if($this->session->userdata('role_id') == 3){
                $data['item'] = $this->inventori->get_items_by_id_cluster($user->id_cluster);
            }else{
                $user_dept = $this->inventori->get_department_id_by_nik($this->session->userdata('nik'));
                $data['manager_item'] = $this->inventori->get_data_item_by_department($user_dept->department_id);
            }
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar', $data);
            $this->load->view('inventori/v_item', $data);
        } else {
            $this->load->view('inventori/error_page');
        }
    }
    

    public function aksi_item_page($aksi){
        if($this->session->userdata('role_id')==3){
            $data['aksi'] = $aksi;
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $data['jenis_items'] = $this->inventori->get_jenis_items_by_nik_cluster($this->session->userdata('nik'));
            $data['suggest_jenis'] = json_encode(array_column($this->inventori->get_suggested_jenis($userData->id_cluster), 'jenis'));

            $kodeCluster = $this->inventori->get_kode_cluster($userData->id_cluster);
            // Hitung jumlah kode item yang sudah ada untuk sub_department ini
            $kodePrefix = $kodeCluster['kode_cluster'].'_';
            $lastKodeItem = $this->inventori->count_kode_item($kodePrefix);
            $nextKodeItem = $kodePrefix . ($lastKodeItem + 1);
            $data['next_kode_item'] = $nextKodeItem; // Ini akan digunakan di frontend
            
            if($aksi === 'edit'){
                $data['items'] = $this->inventori->get_items_by_id_cluster($userData->id_cluster);
            }

            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_aksi_item', $data);
        }else{
            redirect('home');
        }
    }
    
    public function aksi_item() {
        if ($this->session->userdata('role_id')==3) {
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $type = $this->input->post('type');
    
            if ($type === 'add') {
                // Ambil data dari form
                $kodeitem = $this->input->post('kodeitem');
                $jenisitem = $this->input->post('jenisitem');
                $namaitem = $this->input->post('namaitem');
                $noteitem = $this->input->post('note');
                foreach ($kodeitem as $kode) {
                    if(!$this->inventori->get_items_by_kode($kode)){
                        // Siapkan array untuk menyimpan banyak data
                        $data = array();
                        $logdata = array();
                        
                        try {
                            // Looping melalui input dan siapkan data untuk insert batch
                            for ($i = 0; $i < count($kodeitem); $i++) {
                                if($jenisitem[$i] && $namaitem[$i] && $noteitem[$i]){
                                    $data[] = array(
                                        'id_cluster' => $userData->id_cluster,
                                        'kode_item' => $kodeitem[$i],
                                        'jenis' => $jenisitem[$i],
                                        'nama' => $namaitem[$i],
                                        'note' => $noteitem[$i],
                                        'create_at' => date('Y-m-d'),
                                        'nik' => $this->session->userdata('nik'),
                                    );
                                    date_default_timezone_set('Asia/Jakarta');
                                    $logdata[] = [
                                        'id_user' => $this->session->userdata('id'),
                                        'username' => $this->session->userdata('username'),
                                        'act_note' => 'Tambah Item Baru = ' . $namaitem[$i] . ' (Kode = ' . $kodeitem[$i] . ' )',
                                        'act_date' => date('Y-m-d H:i:s'),
                                    ];
                                }
                            }

                            for ($i = 0; $i < count($jenisitem); $i++){
                                if($jenisitem[$i]){
                                    if(!$this->inventori->get_jenis_item_by_nama_cluster($jenisitem[$i],$userData->id_cluster)){
                                        $dataJenisItem = array(
                                            'nama_jenis' => $jenisitem[$i],
                                            'create_at' => date('Y-m-d'),
                                            'id_cluster' => $userData->id_cluster
                                        );
                                        $this->inventori->insert_jenisitem($dataJenisItem);
                                    }
                                }
                            }
                        } catch (Exception $e) {
                            error_log('Error: ' . $e->getMessage());
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'failed']);
                        }  
                    }    
                    else {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'duplicate', 'kode' => $kode]);
                        return;
                    }
                }
                // Masukkan data ke dalam tabel cluster melalui model dengan insert_batch
                if ($this->inventori->insert_batch_item($data)) {
                    // $this->db_inv->set('act_date', 'NOW()', FALSE);
                    if ($this->db_inv->insert_batch('log_data', $logdata)) {
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'success']);
                    } else {
                        error_log('Failed to insert log data');
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'failed', 'error' => 'log_failed']);
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed', 'error' => 'batch_failed']);
                }
            }
            else{
                // Ambil data dari form
                $kodeitem = $this->input->post('kodeitem');
                $oldkodeitem = $this->input->post('oldkodeitem');
                $jenisitem = $this->input->post('jenisitem');
                $oldjenisitem = $this->input->post('oldjenisitem');
                $namaitem = $this->input->post('namaitem');
                $oldnamaitem = $this->input->post('oldnamaitem');
                $noteitem = $this->input->post('note');
                $oldnoteitem = $this->input->post('oldnote');

                for ($i = 0; $i < count($jenisitem); $i++) {
                    if ($jenisitem[$i]) {
                        // Ambil semua nama_jenis yang ada di database
                        // Ambil semua nama_jenis yang ada di database
                        $current_nama_jenis = $this->inventori->get_jenis_items_by_nik_cluster($this->session->userdata('nik'));

                        // Ambil hanya kolom nama_jenis dari hasil query
                        $current_nama_jenis_list = array_column($current_nama_jenis, 'nama_jenis');

                        // Hilangkan duplikat dalam inputan
                        $jenisitem_unique = array_unique($jenisitem);

                        // Identifikasi nama_jenis yang perlu dihapus
                        $nama_jenis_to_delete = array_diff($current_nama_jenis_list, $jenisitem_unique);

                        // Identifikasi nama_jenis baru yang perlu ditambahkan
                        $nama_jenis_to_add = array_diff($jenisitem_unique, $current_nama_jenis_list);

                        // Hapus nama_jenis yang tidak ada di inputan
                        if (!empty($nama_jenis_to_delete)) {
                            $this->inventori->delete_nama_jenis($nama_jenis_to_delete, $userData->id_cluster);
                        }

                        // Tambahkan nama_jenis baru yang ada di inputan
                        if (!empty($nama_jenis_to_add)) {
                            foreach ($nama_jenis_to_add as $nama_jenis) {
                                $datax = array(
                                    'nama_jenis' => $nama_jenis,
                                    'id_cluster' => $userData->id_cluster,
                                    'create_at' => date('Y-m-d'),
                                );
                                $this->inventori->insert_jenisitem($datax);
                            }
                        }

                    }
                }
                
    
                foreach ($kodeitem as $i => $kode) {
                    if ($oldkodeitem[$i] === $kodeitem[$i] || !$this->inventori->get_items_by_kode($kode)) {
                        // Siapkan data untuk dimasukkan
                        $data = array(
                            'id_cluster' => $userData->id_cluster,
                            'kode_item' => $kodeitem[$i],
                            'jenis' => $jenisitem[$i],
                            'nama' => $namaitem[$i],
                            'note' => $noteitem[$i],
                            'nik' => $this->session->userdata('nik'),
                        );

                        $target = array(
                            'id_cluster' => $userData->id_cluster,
                            'kode_item' =>$oldkodeitem[$i]
                        );
    
                        $logdata = array(
                            'id_user' => $this->session->userdata('id'),
                            'username' => $this->session->userdata('username'),
                            'act_note' => 'Mengupdate Item = ' . $oldnamaitem[$i] . ' (Kode = ' . $oldkodeitem[$i] . ' | Jenis = '.$oldjenisitem[$i].' | Note = '.$oldnoteitem[$i].' ) ===>>> Item = ' . $namaitem[$i] . ' (Kode = ' . $kodeitem[$i] . ' | Jenis = '.$jenisitem[$i].' | Note = '.$noteitem[$i].' )'
                        );
    
                        try {
                            // Insert data ke tabel items
                            $this->inventori->update_item($data,$target);
                            // Insert data ke tabel log_data
                            $this->db_inv->set('act_date', 'NOW()', FALSE);
                            $this->db_inv->insert('log_data', $logdata);
                        } catch (Exception $e) {
                            error_log('Error: ' . $e->getMessage());
                            header('Content-Type: application/json');
                            echo json_encode(['status' => 'failed']);
                            return;
                        }
                    } 
                    else {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'duplicate', 'kode' => $kode]);
                        return;
                    }
                }
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success']);
            } 
        } 
        else {
            redirect('home');
        }
    }

    public function detail_jenisitem()
    {
        if ($this->session->userdata('role_id')!=1) {
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            if($this->session->userdata('role_id')==2 || $this->session->userdata('role_id')==4){
                $user_dept = $this->inventori->get_department_id_by_nik($this->session->userdata('nik'));
                $data['manager_jenisitem'] = $this->inventori->get_data_jenis_item_by_department($user_dept->department_id);
            }else{
                $data['jenisitem'] = $this->inventori->get_jenis_items_by_nik_cluster($this->session->userdata('nik'));
            }
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_jenisitem', $data);
        }
    }

    public function detail_pembelian(){
        if($this->session->userdata('role_id')==3){
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['pembelian'] = $this->inventori->get_pembelian_by_id_cluster($userData->id_cluster);
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_pembelian', $data);
        }else{
            redirect('home');
        }
    }

    public function aksi_pembelian_page($aksi) {
        if($this->session->userdata('role_id') == 3) {
            $data['aksi'] = $aksi;
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $data['items'] = $this->inventori->get_items_by_id_cluster($userData->id_cluster);
    
            // Hitung jumlah kode beli yang sudah ada untuk sub_department ini
            $kodePrefix = 'KB' . $data['user']['sub_department'];
            $lastKodeBeli = $this->inventori->count_kode_beli($kodePrefix);
            $nextKodeBeli = $kodePrefix . ($lastKodeBeli + 1);
            $data['next_kode_beli'] = $nextKodeBeli; // Ini akan digunakan di frontend
    
            // Hitung jumlah nomor PO yang sudah ada untuk sub_department ini
            $poPrefix = 'PO' . $data['user']['sub_department'];
            $lastNoPO = $this->inventori->count_no_po($poPrefix);
            $nextNoPO = $poPrefix . ($lastNoPO + 1);
            $data['next_no_po'] = $nextNoPO; // Ini akan digunakan di frontend
    
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_aksi_pembelian', $data);
        } else {
            redirect('home');
        }
    }

    public function cek_kode_item() {
        $kodeItem = $this->input->post('kodeitem');
        
        // Panggil model untuk memeriksa apakah kode item ada
        $item = $this->inventori->check_kode_item($kodeItem);
        $harga = $this->inventori->check_stok($kodeItem);
        
        if ($item) {
            // Siapkan respons data
            $response = [
                'status' => 'success',
                'data' => [
                    'satuan' => $item['satuan'],
                    'hargasatuan' => $harga ? $harga['harga_satuan'] : null,
                ],
            ];
        } else {
            // Jika tidak ditemukan
            $response = ['status' => 'not_found'];
        }
    
        // Kirim respons sebagai JSON
        echo json_encode($response);
    }
    
    
    
    public function aksi_pembelian(){
        if($this->session->userdata('role_id')==3){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $type = $this->input->post('type');
            if ($type === 'add') {
                $kodebeli = $this->input->post('kodebeli');
                $nopo = $this->input->post('nopo');
                $kodeitem = $this->input->post('kodeitem');
                $qty = $this->input->post('qty');
                $satuan = $this->input->post('satuan');
                $hargapersatuan = $this->input->post('hargapersatuan');
                $tanggal = $this->input->post('tanggal');
                $expdate = $this->input->post('expdate');

                $data = array();
                $logdata = [];

                try {
                    // Looping melalui input dan siapkan data untuk insert/update satu per satu
                    for ($i = 0; $i < count($kodeitem); $i++) {
                        // Siapkan data untuk tabel pembelian
                        $dataPembelian = array(
                            'id_cluster' => $userData->id_cluster,
                            'kode_beli' => $kodebeli,
                            'no_po' => $nopo,
                            'kode_item' => $kodeitem[$i],
                            // 'quantity' => $qty[$i],
                            'satuan' => $satuan[$i],
                            'status' => 'Belum terealisasi',
                            'realisasi_at' => $tanggal,
                        );

                        // Insert data ke tabel pembelian
                        $this->inventori->insert_pembelian($dataPembelian);

                        $stokStaging = array(
                            'kode_beli' => $kodebeli,
                            'stok_staging' => $qty[$i],
                            'kode_item' => $kodeitem[$i],
                            'harga_satuan' => $hargapersatuan[$i],
                            'exp_date' => $expdate[$i],
                            'id_cluster' => $userData->id_cluster
                        );
                        // Insert stok staging ke staging_stok
                        $this->inventori->insert_staging_stok($stokStaging);

                        // // Cek apakah kode_item sudah ada di stok
                        // $checkItem = $this->inventori->check_stok($kodeitem[$i]);

                        // if ($checkItem) {
                        //     // Jika kode_item sudah ada, lakukan update
                        //     $stokData = array(
                        //         'quantity_real' => $qty[$i] + $checkItem['quantity_real'],
                        //         'exp_date' => $expdate[$i],
                        //         'harga_satuan' => $hargapersatuan[$i],
                        //     );
                        //     $this->inventori->update_stok($kodeitem[$i], $stokData);
                        // } else {
                        //     // Jika kode_item belum ada, lakukan insert
                        //     $stokData = array(
                        //         'kode_item' => $kodeitem[$i],
                        //         'quantity_real' => $qty[$i],
                        //         'exp_date' => $expdate[$i],
                        //         'harga_satuan' => $hargapersatuan[$i],
                        //     );
                        //     $this->inventori->insert_stok($stokData);
                        // }

                        // Cek apakah kode_item sudah ada di stok
                        $checkItem = $this->inventori->check_stok($kodeitem[$i]);

                        if (!$checkItem) {
                            // Jika kode_item sudah ada, lakukan update
                            $stokData = array(
                                'id_cluster' => $userData->id_cluster,
                                'kode_item' => $kodeitem[$i],
                                // 'quantity_real' => $qty[$i],
                                // 'exp_date' => $expdate[$i],
                                // 'harga_satuan' => $hargapersatuan[$i],
                            );
                            $this->inventori->insert_stok($stokData);
                        }
                        
                        // Siapkan data untuk log aktivitas
                        $logdata = [
                            'id_user' => $this->session->userdata('id'),
                            'username' => $this->session->userdata('username'),
                            'act_note' => 'Tambah Pembelian Baru = ' . $kodebeli,
                        ];
                    }

                    // Masukkan log aktivitas
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    if ($this->db_inv->insert('log_data', $logdata)) {
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'success']);
                    } else {
                        error_log('Failed to insert log data');
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'failed', 'error' => 'log_failed']);
                    }
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed']);
                }

            }
            else if($type=='realisasi'){
                $kodebeli = $this->input->post('kodebeli');
                $kodeitem = $this->input->post('kodeitem');
                $stokStaging = $this->inventori->get_stok_staging($kodebeli, $kodeitem);
                if($stokStaging){
                    date_default_timezone_set('Asia/Jakarta');
                    $dataPemb = array(
                        'quantity' => $stokStaging['stok_staging'],
                        'status' => 'Terealisasi',
                        'realisasi_at' => date('Y-m-d H:i:s'),
                    );
                    if($this->inventori->update_qty_pembelian($dataPemb,$kodebeli,$kodeitem)){
                        // Cek apakah kode_item sudah ada di stok
                        $checkItem = $this->inventori->check_stok($kodeitem);

                        if ($checkItem) {
                            // Jika kode_item sudah ada, lakukan update
                            $stokData = array(
                                'quantity_real' => $stokStaging['stok_staging'] + $checkItem['quantity_real'],
                                'exp_date' => $stokStaging['exp_date'],
                                'harga_satuan' => $stokStaging['harga_satuan'],
                            );
                            $this->inventori->update_stok($kodeitem, $stokData);
                        } else {
                            // Jika kode_item belum ada, lakukan insert
                            $stokData = array(
                                'kode_item' => $kodeitem,
                                'quantity_real' => $stokStaging['stok_staging'],
                                'exp_date' => $stokStaging['exp_date'],
                                'harga_satuan' => $stokStaging['harga_satuan'],
                            );
                            $this->inventori->insert_stok($stokData);
                        }
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'failed']);
                    }
                }
            }
            else if($type ==='updatetanggal'){
                $id_beli = $this->input->post('id_beli');
                $exp_date = $this->input->post('exp_date');

                $idstock = $this->inventori->get_kode_item_join_from_pembelian($id_beli);

                $data = array(
                    'exp_date' => $exp_date
                );
                if ($this->inventori->update_tanggal('stok', $data, $idstock)) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success']);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error']);
                }
            }
            else{
                // Ambil data dari form
                $kodeitem = $this->input->post('kodeitem');
                $kodebeli = $this->input->post('kodebeli');
                $updateQuantity = $this->input->post('updateQuantity');
                $updateQtyPembelian = $this->input->post('updateQtyPembelian');
                $updateSatuan = $this->input->post('updateSatuan');
                $updateQtyStaging = $this->input->post('qtyUpdateStaging');

                $dataStagingStok = array(
                    'stok_staging'=>$updateQtyStaging
                );

                $where=array(
                    'kode_beli'=>$kodebeli,
                    'kode_item'=>$kodeitem
                );
                // $datapemb = array(
                //     'quantity'=>$updateQtyPembelian,
                //     'satuan' => $updateSatuan
                // );
                // $datastok = array(
                //     'quantity_real'=>$updateQuantity
                // );

                // if($this->inventori->update_qty_pembelian($datapemb,$kodebeli,$kodeitem)){
                //     if($this->inventori->update_quantity_real_by_kode_item($datastok,$kodeitem)){
                //         header('Content-Type: application/json');
                //         echo json_encode(['status' => 'success']);
                //     }else{
                //         header('Content-Type: application/json');
                //         echo json_encode(['status' => 'failed']);
                //     }
                // }else{
                //     header('Content-Type: application/json');
                //     echo json_encode(['status' => 'failed']);
                // }

                if($this->inventori->get_info_staging_stok($kodebeli,$kodeitem)){
                    if($this->inventori->update_staging_stok($dataStagingStok,$where)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'failed']);
                    }
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'failed']);
                }
            }
        }
        else{
            redirect('home');
        }
    }


    public function detail_pemakaian(){
        if($this->session->userdata('role_id') == 3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));
                $data['pemakaian'] = $this->inventori->get_pemakaian_by_id_cluster($userData->id_cluster);
                $users = $this->inventori->get_all_users_from_external_db();
                $listuser = array_map(function($user) {
                    return $user['nik'] . ' - ' . $user['nama'] . ' - ' . $user['department'];
                }, $users);

                $data['all_user_ex_db'] = json_encode($listuser);
                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar',$data);
                $this->load->view('inventori/v_pemakaian',$data);
            }
            else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }

    public function aksi_pemakaian_page($aksi){
        if($this->session->userdata('role_id') == 3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['aksi'] = $aksi;
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));

                $data['all_user'] = json_encode(array_column($this->inventori->get_data_user_from_external_db(), 'nik'));

                $users = $this->inventori->get_all_users_from_external_db();
                $listuser = array_map(function($user) {
                    return $user['nik'] . ' - ' . $user['nama'] . ' - ' . $user['department'];
                }, $users);

                $data['all_user_ex_db'] = json_encode($listuser);
    
                // Hitung jumlah nomor pakai yang sudah ada untuk sub_department ini
                $kodePrefix = 'PK' . $data['user']['sub_department'].'.';
                $lastNoPakai = $this->inventori->count_no_pakai($kodePrefix, $userData->id_cluster);
                $nextNoPakaiNumber = str_pad($lastNoPakai + 1, 6, '0', STR_PAD_LEFT); // Menambahkan nol di depan sehingga selalu 6 digit
                $nextNoPakai = $kodePrefix . $nextNoPakaiNumber; // Ini akan menjadi nomor pakai berikutnya
                $data['next_no_pakai'] = $nextNoPakai; // Ini akan digunakan di frontend

                $data['items'] = $this->inventori->get_item_from_po_by_id_cluster($userData->id_cluster);

                $data['data_pemakaian'] = $this->inventori->get_pemakaian_unik_by_id_cluster($userData->id_cluster);
                
                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_aksi_pemakaian', $data);
            }
            else {
                redirect('home');
            }
        }
        else {
            redirect('home');
        }
    }

    public function aksi_pemakaian(){
        if($this->session->userdata('role_id')==3){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $type = $this->input->post('type');
            if ($type === 'add') {
                $nopakai = $this->input->post('nopakai');
                $jenispakai = $this->input->post('jenispakai');
                $nik = $this->input->post('nik');
                $idstock = $this->input->post('idstock');
                $kodeitem = $this->input->post('kodeitem');
                $stok = $this->input->post('stok');
                $qty = $this->input->post('qty');
                $nama = $this->input->post('nama');
                $pemberi = $this->input->post('pemberi');
                $deskripsi = $this->input->post('deskripsi');
                $tanggal = $this->input->post('tanggal');

                $data = array();
                $detailDeskripsi = '';
                $logdata = [];

                try {
                    for($i = 0; $i < count($idstock); $i++) {
                        if ($i > 0) {
                            // Tambahkan koma sebagai pemisah sebelum menambahkan item berikutnya, kecuali untuk item pertama
                            $detailDeskripsi .= ', ';
                        }
                        $detailDeskripsi .= $this->inventori->get_nama_item_by_id_stok($idstock[$i]);
                    }
                    // Looping melalui input dan siapkan data untuk insert/update satu per satu
                    for ($i = 0; $i < count($idstock); $i++) {
                        // Siapkan data untuk tabel pembelian
                        $dataPemakaian = array(
                            'jenis_pakai' => $jenispakai,
                            'id_stock' => $idstock[$i],
                            'jml_pakai' => $qty[$i],
                            'nik_pemakai' => $nik,
                            'nama_pemakai' => $nama,
                            'nopakai' => $nopakai,
                            'pemberi' => $pemberi[$i],
                            'deskripsi' => $deskripsi . ' [ '. $detailDeskripsi.' ]',
                            'waktu' => $tanggal,
                            'id_cluster' => $userData->id_cluster,
                        );

                        // Insert data ke tabel pemakaian
                        $this->inventori->insert_pemakaian($dataPemakaian);

                        // Jika kode_item sudah ada, lakukan update
                        $stokData = array(
                            'quantity_real' => $stok[$i] - $qty[$i],
                        );
                        $this->inventori->update_stok($kodeitem[$i], $stokData);
                        
                        // Siapkan data untuk log aktivitas
                        $logdata = [
                            'id_user' => $this->session->userdata('id'),
                            'username' => $this->session->userdata('username'),
                            'act_note' => 'Tambah Pemakaian Baru = ' . $kodeitem[$i],
                        ];
                    }

                    $dataKunjungan = array(
                        'kode_visit' => $nopakai,
                        'jenis_visit' => $jenispakai,
                        'nik_visit' => $nik,
                        'nama_visit' => $nama,
                        'tujuan_visit' => $deskripsi . ' [ '. $detailDeskripsi.' ]',
                        'visit_at' => $tanggal,
                        'id_cluster' => $userData->id_cluster,
                    );

                    // Masukkan log aktivitas
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    if ($this->db_inv->insert('log_data', $logdata)) {
                        if ($this->inventori->insert_kunjungan($dataKunjungan)) {
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'success']);
                        }
                    } else {
                        error_log('Failed to insert log data');
                        header('Content-Type: application/json');
                        echo json_encode(['status'=> 'failed', 'error' => 'log_failed']);
                    }
                } catch (Exception $e) {
                    error_log('Error: ' . $e->getMessage());
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed']);
                }

            }
            else{
                // Ambil data dari form
                $id_stock = $this->input->post('id_stock');
                $nopakai = $this->input->post('nopakai');
                $updateQuantity = $this->input->post('updateQuantity');
                $updateJmlPakai = $this->input->post('updateJmlPakai');
                $jumlahPakaiOld = $this->input->post('jumlahpakai');

                $data = array(
                    'jml_pakai' => $updateJmlPakai
                );

                $dataQR = array(
                    'quantity_real' => $updateQuantity
                );

                if($this->inventori->updateJumlahPemakaian($data,$jumlahPakaiOld,$nopakai,$id_stock,$userData->id_cluster)){
                    if($this->inventori->update_quantity_real($dataQR,$id_stock)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'failed']);
                    }
                }
                else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'failed']);
                }
                
            }
        }
        else{
            redirect('home');
        }
    }
    
    public function cek_nama_item() {
        $no_po = $this->input->post('no_po');
        $kodeitem = $this->input->post('kodeitem');
        $userData = $this->inventori->check_nik($this->session->userdata('nik'));
    
        // Panggil model untuk mengambil data berdasarkan no_po
        $items = $this->inventori->get_item_by_kode_item($kodeitem,$userData->id_cluster);
    
        if ($items) {
            // Iterasi melalui setiap item dan cek apakah quantity_real bernilai null
            foreach ($items as &$item) {
                if (is_null($item['quantity_real'])) {
                    // Jika null, set quantity_real menjadi 0
                    $item['quantity_real'] = 0;
                }
            }
    
            echo json_encode(['status' => 'success', 'data' => $items]);
        } else {
            echo json_encode(['status' => 'not_found']);
        }
    }

    public function get_all_user_by_nik() {
        $nik = $this->input->post('nik');

        if (!empty($nik)) {
            $user = $this->inventori->get_data_user_from_external_db_by_nik($nik);

            if ($user) {
                $response = array(
                    'status' => 'success',
                    'nama' => $user->nama,
                    'department' => $user->department
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'User tidak ditemukan'
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'NIK tidak valid'
            );
        }

        echo json_encode($response);
    }
    
    public function kunjungan(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));
                $data['kunjungan'] = $this->inventori->get_kunjungan($userData->id_cluster);

                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_kunjungan', $data);
            }
            else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }
    
    public function dataopname(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));
                $data['item'] = $this->inventori->get_detail_items($userData->id_cluster);
                $data['dataopname'] = $this->inventori->get_data_opname($userData->id_cluster);

                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_opname', $data);
            }
            else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }

    public function aksi_dataopname(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));

                $id_cluster = $this->input->post('id_cluster');
                $kode_item = $this->input->post('kode_item');
                $nama_item = $this->input->post('nama_item');
                $quantity_real = $this->input->post('quantity_real');
                $sisa_stok = $this->input->post('sisa_stok');
                $selisih = $this->input->post('selisih');
                $result = $this->input->post('result');

                $data = array(
                    'kode_item'=>$kode_item,
                    'nama_item'=>$nama_item,
                    'sisa'=>$sisa_stok,
                    'stok_real'=>$quantity_real,
                    'selisih'=>$selisih,
                    'hasil'=>$result,
                    'waktu'=>date('Y-m-d H:i:s'),
                    'id_cluster'=>$id_cluster,
                );

                if($this->inventori->insert_opname($data)){
                    $logdata = [
                        'id_user' => $this->session->userdata('id'),
                        'username' => $this->session->userdata('username'),
                        'act_note' => 'Data opname item = '.$nama_item.' ('.$kode_item.')',
                    ];
            
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    $this->db_inv->insert('log_data', $logdata);
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'success']);
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status'=> 'failed']);
                }
            }
            else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }

    public function detail_dataopname(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));

                $data['dataopname'] = $this->inventori->get_detail_data_opname($userData->id_cluster);
                $data['detail_opname'] = $this->inventori->get_detail_data_opname($userData->id_cluster);

                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_detail_opname', $data);
            }else{
                redirect('home');
            }
        }else{
            redirect('home');
        }
    }
    
    // public function backup_database() {
    //     if ($this->session->userdata('role_id')) {
    //         $userData = $this->inventori->check_nik($this->session->userdata('nik'));
    //         $idcluster = $userData->id_cluster;
    
    //         // Load PhpSpreadsheet library
    //         require 'vendor/autoload.php';
    //         $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    
    //         // Fetch database data
    //         $tables = $this->inventori->get_all_tables();
    
    //         foreach ($tables as $table) {
    //             $tableName = $table['table_name'];
    //             $sheet = $spreadsheet->createSheet();
    //             $sheet->setTitle($tableName);
    
    //             $data = $this->inventori->get_table_data($tableName, $idcluster);
    //             $column = 'A';
    //             $row = 1;
    
    //             // Set column names
    //             if (!empty($data)) {
    //                 $field_names = array_keys($data[0]);
    //                 foreach ($field_names as $field) {
    //                     $sheet->setCellValue($column . $row, $field);
    //                     $column++;
    //                 }
    //                 $row++;
    
    //                 // Set data rows
    //                 foreach ($data as $record) {
    //                     $column = 'A';
    //                     foreach ($record as $value) {
    //                         if (is_array($value)) {
    //                             $value = json_encode($value);
    //                         }
    //                         $sheet->setCellValue($column . $row, $value);
    //                         $column++;
    //                     }
    //                     $row++;
    //                 }
    //                 $row++;
    //             }
    //         }
    
    //         // Remove the default sheet created on initialization
    //         $spreadsheet->removeSheetByIndex(0);
    
    //         // Write to file
    //         $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    //         $lastMonthNumber = date('n', strtotime('first day of last month'));
    //         $dateTime = date('Ymd_His');
    //         $filename = "backup_inventori_period_{$lastMonthNumber}_{$dateTime}.xlsx";
    //         $backupDir = 'E:\backup_db_inventori';
    
    //         if (!is_dir($backupDir)) {
    //             mkdir($backupDir, 0777, true);
    //         }
    
    //         $filepath = $backupDir . '/' . $filename;
    //         $writer->save($filepath);
    
    //         // Log the action
    //         $logdata = [
    //             'id_user' => $this->session->userdata('id'),
    //             'username' => $this->session->userdata('username'),
    //             'act_note' => 'Melakukan backup data',
    //         ];
    
    //         $this->db_inv->set('act_date', 'NOW()', FALSE);
    //         $this->db_inv->insert('log_data', $logdata);
    
    //         // Return JSON response
    //         header('Content-Type: application/json');
    //         echo json_encode(['status' => 'success', 'message' => 'Backup database berhasil dilakukan.']);
    //     } else {
    //         header('Content-Type: application/json');
    //         echo json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk melakukan backup.']);
    //     }
    // }

    public function backup_database() {
        if ($this->session->userdata('role_id')) {
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $roleId = $this->session->userdata('role_id');
            $userDepartment = $this->inventori->get_department_id_by_nik($this->session->userdata('nik'));
            
            // Load PhpSpreadsheet library
            require 'vendor/autoload.php';
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet(); // Menggunakan sheet aktif
            $sheet->setTitle('Backup Data'); // Beri nama sheet
    
            $column = 'A';  // Awal kolom untuk set kolom pertama
            $row = 1;       // Awal baris untuk set data
    
            $logDataBackedUp = false; // Variabel untuk melacak apakah log_data telah dibackup
    
            if ($roleId == 2) {
                // Ambil semua nik dan id_cluster dari tabel user database inventori, 
                // cocokkan dengan department_id dari tabel user database monthly_report
                $nikList = $this->inventori->get_nik_by_department($userDepartment->department_id);
    
                foreach ($nikList as $nikData) {
                    $id_cluster = $nikData['id_cluster'];  // Ambil id_cluster dari hasil query
                    
                    // Backup data berdasarkan id_cluster di db_inv
                    $tables = $this->inventori->get_all_tables();
                    foreach ($tables as $table) {
                        $tableName = $table['table_name'];
                        
                        // Backup log_data hanya sekali
                        if ($tableName == 'log_data' && $logDataBackedUp) {
                            continue; // Lompat jika log_data sudah dibackup
                        }
    
                        // Backup data dari db_inv berdasarkan id_cluster
                        $data = $this->inventori->get_table_data($tableName, $id_cluster);
    
                        // Set nama tabel di file Excel sebelum data
                        $sheet->setCellValue($column . $row, 'Tabel: ' . $tableName . ' (Cluster ID: ' . $id_cluster . ')');
                        $row++;
    
                        // Set column names
                        if (!empty($data)) {
                            $field_names = array_keys($data[0]);
                            $current_column = $column;
    
                            // Tampilkan nama kolom di Excel
                            foreach ($field_names as $field) {
                                $sheet->setCellValue($current_column . $row, $field);
                                $current_column++;
                            }
                            $row++;
    
                            // Tampilkan data dari tabel
                            foreach ($data as $record) {
                                $current_column = $column;
                                foreach ($record as $value) {
                                    if (is_array($value)) {
                                        $value = json_encode($value);
                                    }
                                    $sheet->setCellValue($current_column . $row, $value);
                                    $current_column++;
                                }
                                $row++;
                            }
                        }
                        $row++; // Tambahkan baris kosong setelah tiap tabel
    
                        // Tandai bahwa log_data telah dibackup
                        if ($tableName == 'log_data') {
                            $logDataBackedUp = true;
                        }
                    }
                }
            } else {
                // Backup normal untuk role_id selain 2
                $idcluster = $userData->id_cluster;
                $tables = $this->inventori->get_all_tables();
    
                foreach ($tables as $table) {
                    $tableName = $table['table_name'];
    
                    // Abaikan tabel log_data jika role_id bukan 2
                    if ($tableName == 'log_data') {
                        continue; // Lompat ke tabel berikutnya
                    }
    
                    // Backup data dari db_inv berdasarkan id_cluster
                    $data = $this->inventori->get_table_data($tableName, $idcluster);
    
                    // Set nama tabel di file Excel sebelum data
                    $sheet->setCellValue($column . $row, 'Tabel: ' . $tableName . ' (Cluster ID: ' . $idcluster . ')');
                    $row++;
    
                    // Set column names
                    if (!empty($data)) {
                        $field_names = array_keys($data[0]);
                        $current_column = $column;
    
                        // Tampilkan nama kolom di Excel
                        foreach ($field_names as $field) {
                            $sheet->setCellValue($current_column . $row, $field);
                            $current_column++;
                        }
                        $row++;
    
                        // Tampilkan data dari tabel
                        foreach ($data as $record) {
                            $current_column = $column;
                            foreach ($record as $value) {
                                if (is_array($value)) {
                                    $value = json_encode($value);
                                }
                                $sheet->setCellValue($current_column . $row, $value);
                                $current_column++;
                            }
                            $row++;
                        }
                    }
                    $row++; // Tambahkan baris kosong setelah tiap tabel
                }
            }
    
            // Write to file
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $lastMonthNumber = date('n', strtotime('first day of last month'));
            $dateTime = date('Ymd_His');
            $filename = "backup_inventori_period_{$lastMonthNumber}_{$dateTime}.xlsx";
            $backupDir = 'E:\backup_db_inventori';
    
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0777, true);
            }
    
            $filepath = $backupDir . '/' . $filename;
            $writer->save($filepath);
    
            // Log the action
            $logdata = [
                'id_user' => $this->session->userdata('id'),
                'username' => $this->session->userdata('username'),
                'act_note' => 'Melakukan backup data',
            ];
    
            $this->db_inv->set('act_date', 'NOW()', FALSE);
            $this->db_inv->insert('log_data', $logdata);
    
            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Backup database berhasil dilakukan.']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Anda tidak memiliki akses untuk melakukan backup.']);
        }
    }
    
    
    
    
    
    
    public function aksi_adjust_stok_page(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));
                $data['item'] = $this->inventori->get_detail_items($userData->id_cluster);
                $data['dataadjuststok'] = $this->inventori->get_data_stok_adjust($userData->id_cluster);

                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_adjust_stok', $data);
            }
            else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }

    public function aksi_adjust_stok(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $id_cluster = $this->input->post('id_cluster');
                $kode_item = $this->input->post('kode_item');
                $quantity_real = $this->input->post('quantity_real');
                $sisa_stok = $this->input->post('sisa_stok');
                $stokAdjust = $this->input->post('stokAdjust');
                $deskripsi = $this->input->post('adjustDetail');
                date_default_timezone_set('Asia/Jakarta');
                $data = array(
                    'kode_item'=>$kode_item,
                    'sisa_stok'=>$sisa_stok,
                    'stok_real'=>$quantity_real,
                    'stok_adjust'=>$stokAdjust,
                    'deskripsi'=>$deskripsi,
                    'adjust_at'=>date('Y-m-d H:i:s'),
                    'id_cluster'=>$id_cluster,
                );
                $datax = array(
                    'quantity_real' => $stokAdjust
                );
                if($this->inventori->insert_stok_adjust($data)){
                    if($this->inventori->update_quantity_real_by_kode_item($datax,$kode_item)){
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'success', 'message' => 'Berhasil Adjust Stok']);
                    }else{
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'failed', 'message' => 'Gagal Memperbarui Stok.']);
                    }
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'failed', 'message' => 'Gagal Adjust Stok.']);
                }
            }else{
                redirect('home');
            }
        }
        else{
            redirect('home');
        }
    }

    public function detail_adjust_stok(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $userData = $this->inventori->check_nik($this->session->userdata('nik'));
                $data['dataadjuststok']= $this->inventori->get_detail_stok_adjust($userData->id_cluster);
                $data['detail_adjuststok']= $this->inventori->get_detail_stok_adjust($userData->id_cluster);
                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar', $data);
                $this->load->view('inventori/v_detail_adjust_stok', $data);
            }
            else{

            }
        }
        else{

        }
    }

}
