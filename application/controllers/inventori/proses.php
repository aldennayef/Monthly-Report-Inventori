<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->db_inv = $this->load->database('inventori', TRUE);
        $this->load->model('inventori');
    }

    public function index(){
        if($this->session->userdata('role_id')){
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
        if($this->session->userdata('role_id')){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['all_users'] = $this->inventori->get_all_user();
            $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_users', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
        }    
    }

    public function aksi_users(){
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
    
    public function detail_clusters(){
        if($this->session->userdata('role_id')){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_clusters', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
        }    
    }
    public function tambah_clusters(){
        if($this->session->userdata('role_id')){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            // $data['clusters'] = $this->inventori->get_all_cluster();
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/tambah_cluster', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
        }    
    }

    public function aksi_clusters(){
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
                    
                            $this->db_inv->set('act_date', 'NOW()', FALSE);
                            $this->db_inv->insert('log_data', $logdata);
                        }
                    
                        // Masukkan data ke dalam tabel cluster melalui model dengan insert_batch
                        if ($this->inventori->insert_batch_cluster($data)) {
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'success']);
                        } else {
                            header('Content-Type: application/json');
                            echo json_encode(['status'=> 'failed']);
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
    

    public function detail_item(){
        if($this->session->userdata('role_id')){
            $nik = $this->session->userdata('nik');
            // $subDept = $this->inventori->get_sub_dept_by_username($username);
            $data['item'] = $this->inventori->get_items_by_nik($nik);
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/v_item', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
        }
    }

    public function tambah_item(){
        if($this->session->userdata('role_id')){
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $data['jenis_items'] = $this->inventori->get_jenis_items_by_nik_cluster($this->session->userdata('nik'));
            $this->load->view('inventori/header', $data);
            $this->load->view('inventori/navbar');
            $this->load->view('inventori/sidebar',$data);
            $this->load->view('inventori/tambah_item', $data);
            $this->load->view('inventori/footer');
        }else{
            $this->load->view('inventori/error_page');
        }
    }
    
    public function aksi_item() {
        if ($this->session->userdata('role_id')) {
            $data['user'] = $this->inventori->get_user_data($this->session->userdata('username'));
            $userData = $this->inventori->check_nik($this->session->userdata('nik'));
            $type = $this->input->post('type');
    
            if ($type === 'add') {
                // Ambil data dari form
                $kodeitem = $this->input->post('kodeitem');
                $jenisitem = $this->input->post('jenisitem');
                $namaitem = $this->input->post('namaitem');
                $noteitem = $this->input->post('note');
    
                foreach ($kodeitem as $i => $kode) {
                    if (!$this->inventori->get_items_by_kode($kode)) {
                        // Siapkan data untuk dimasukkan
                        $data = array(
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
    
                        try {
                            // Insert data ke tabel items
                            $this->db_inv->insert('items', $data);
                            // Insert data ke tabel log_data
                            $this->db_inv->set('act_date', 'NOW()', FALSE);
                            $this->db_inv->insert('log_data', $logdata);
                        } catch (Exception $e) {
                            error_log('Error: ' . $e->getMessage());
                            header('Content-Type: application/json');
                            echo json_encode(['status' => 'failed']);
                            return;
                        }
                    } else {
                        header('Content-Type: application/json');
                        echo json_encode(['status' => 'duplicate', 'kode' => $kode]);
                        return;
                    }
                }
    
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success']);
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'failed']);
            }
        } else {
            $this->load->view('inventori/error_page');
        }
    }
    

}
