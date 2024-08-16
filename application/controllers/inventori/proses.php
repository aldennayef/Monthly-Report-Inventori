<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->db_inv = $this->load->database('inventori', TRUE);
        $this->load->model('inventori');
    }

    public function index(){
        if($this->session->userdata('role_id')==3){
            if($this->inventori->check_nik($this->session->userdata('nik'))){
                $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
                $this->load->view('inventori/header', $data);
                $this->load->view('inventori/navbar');
                $this->load->view('inventori/sidebar',$data);
                $this->load->view('inventori/dashboard', $data);
                $this->load->view('inventori/footer');
            }else{
                $this->load->view('inventori/error_page');
            }
        }else if($this->session->userdata('role_id')==1){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/dashboard', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
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
            $this->load->view('inventori/error_page');
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
            $this->load->view('inventori/error_page');
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
            $this->load->view('inventori/error_page');
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
                if(!$this->inventori->get_cluster_by_kode($newkodeCluster)){
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
        if($this->session->userdata('role_id')==3){
            $user=$this->inventori->check_nik($this->session->userdata('nik'));
            // $subDept = $this->inventori->get_sub_dept_by_username($username);
            $data['item'] = $this->inventori->get_items_by_id_cluster($user->id_cluster);
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_item', $data);
        }else{
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
            
            if($aksi === 'edit'){
                $data['items'] = $this->inventori->get_items_by_id_cluster($userData->id_cluster);
            }

            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_aksi_item', $data);
        }else{
            $this->load->view('inventori/error_page');
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
                        
                        try {
                            // Looping melalui input dan siapkan data untuk insert batch
                            for ($i = 0; $i < count($kodeitem); $i++) {
                                
                                $data[] = array(
                                    'id_cluster' => $userData->id_cluster,
                                    'kode_item' => $kodeitem[$i],
                                    'jenis' => $jenisitem[$i],
                                    'nama' => $namaitem[$i],
                                    'note' => $noteitem[$i],
                                    'create_at' => date('Y-m-d'),
                                    'nik' => $this->session->userdata('nik'),
                                );
                        
                                $logdata = [
                                    'id_user' => $this->session->userdata('id'),
                                    'username' => $this->session->userdata('username'),
                                    'act_note' => 'Tambah Item Baru = ' . $namaitem[$i] . ' (Kode = ' . $kodeitem[$i] . ' )',
                                ];
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
                    $this->db_inv->set('act_date', 'NOW()', FALSE);
                    if ($this->db_inv->insert('log_data', $logdata)) {
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
            $this->load->view('inventori/error_page');
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
            $this->load->view('inventori/error_page');
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
            $this->load->view('inventori/error_page');
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
                            'quantity' => $qty[$i],
                            'satuan' => $satuan[$i],
                            'status' => 'ok',
                            'realisasi_at' => $tanggal,
                        );

                        // Insert data ke tabel pembelian
                        $this->inventori->insert_pembelian($dataPembelian);

                        // Cek apakah kode_item sudah ada di stok
                        $checkItem = $this->inventori->check_stok($kodeitem[$i]);

                        if ($checkItem) {
                            // Jika kode_item sudah ada, lakukan update
                            $stokData = array(
                                'quantity_real' => $qty[$i] + $checkItem['quantity_real'],
                                'exp_date' => $expdate[$i],
                                'harga_satuan' => $hargapersatuan[$i],
                            );
                            $this->inventori->update_stok($kodeitem[$i], $stokData);
                        } else {
                            // Jika kode_item belum ada, lakukan insert
                            $stokData = array(
                                'kode_item' => $kodeitem[$i],
                                'quantity_real' => $qty[$i],
                                'exp_date' => $expdate[$i],
                                'harga_satuan' => $hargapersatuan[$i],
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
        else{
            $this->load->view('inventori/error_page');
        }
    }
    

}
