<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller{

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('Webmodel');
        $this->load->library('form_validation');
	}

        private function get_user_data() {
            $username = $this->session->userdata('username');
            
            // Ambil data user
            $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
            $this->db->from('user');
            $this->db->join('user_department', 'user.department_id = user_department.id');
            $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
            $this->db->where('user.username', $username);
            return $this->db->get()->row_array();
        }

    public function index(){
        // Ambil data user
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $this->load->view('dashboard', $data);
    }

    public function kelola_kolom() {
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Report'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        $id = $this->session->userdata('id');
        $data['user'] = $this->get_user_data();
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        // Ambil kolom yang sudah ada
        $data['columns'] = $this->Webmodel->get_all_columns_with_user($id);
        // Ambil data hasil input dari sesi dan kemudian hapus dari sesi
        $data['input_results'] = $this->session->userdata('input_results') ?? [];
        $this->session->unset_userdata('input_results');

        $this->load->view('karyawan/kelola_kolom', $data);
    }
    
    // Controller untuk menampilkan halaman tambah kolom
    public function add_column_page() {
        $data['user'] = $this->get_user_data();
    
        // Ambil data menu berdasarkan role_id
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
        // Ambil semua role untuk otorisasi menu
        $data['roles'] = $this->db->get('user_role')->result_array();

        $data['suggested_status'] = json_encode(array_column($this->Webmodel->get_suggested_status(), 'status'));
    
        // Tampilkan form tambah kolom
        $this->load->view('karyawan/tambah_kolom', $data);
    }

    public function add_column() {
        $this->form_validation->set_rules('report', 'Report', 'required|trim');
        $this->form_validation->set_rules('sub_report', 'Sub Report', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            // Mengembalikan error validasi dalam format JSON
            $errors = validation_errors();
            echo json_encode(['status' => 'error', 'message' => $errors]);
        } else {
            // Data yang diinput oleh pengguna
            $report = ucwords(strtolower($this->input->post('report')));
            $sub_report = ucwords(strtolower($this->input->post('sub_report')));
            $status = ucwords(strtolower($this->input->post('status')));
            $user_id = $this->input->post('user_id');
    
            $input_data = [
                'user_id' => $user_id,
                'report' => $report,
                'sub_report' => $sub_report,
                'status' => $status
            ];
    
            // Masukkan data kolom ke database
            $this->Webmodel->insert_column($input_data);
    
            // Insert to log data
            $log_data = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Menambah Report',
                'date' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('log_data', $log_data);
    
            // Ambil semua data dengan report dan user_id yang sama
            $this->db->where('report', $report);
            $this->db->where('user_id', $user_id);
            $existing_reports = $this->db->get('kolom_attributes')->result_array();
    
            // Mengembalikan respons sukses dalam format JSON
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'data' => $existing_reports
            ]);
        }
    }
        

    public function edit_column_page($column_id) {
        $data['user'] = $this->get_user_data();
    
        // Ambil data menu berdasarkan role_id
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
        // Ambil semua role untuk otorisasi menu
        $data['roles'] = $this->db->get('user_role')->result_array();
    
        // Ambil data kolom berdasarkan ID kolom yang ingin diedit
        $data['kolom'] = $this->db->get_where('kolom_attributes', ['id' => $column_id])->row_array();

        $data['suggested_status'] = json_encode(array_column($this->Webmodel->get_suggested_status(), 'status'));
    
        // Tampilkan form edit kolom
        $this->load->view('karyawan/edit_kolom', $data);
    }    

    public function update_column() {
        $this->form_validation->set_rules('report', 'Report', 'required|trim|xss_clean');
        $this->form_validation->set_rules('sub_report', 'Sub Report', 'required|trim|xss_clean');
        $this->form_validation->set_rules('status', 'Status', 'required|trim|xss_clean');
    
        if ($this->form_validation->run() == false) {
            $this->edit_column_page($this->input->post('id'));
        } else {
            $data = [
                'report' => ucwords(strtolower($this->input->post('report', TRUE))),
                'sub_report' => ucwords(strtolower($this->input->post('sub_report', TRUE))),
                'status' => ucwords(strtolower($this->input->post('status', TRUE)))
            ];
    
            $this->db->where('id', $this->input->post('id', TRUE));
            
            if ($this->db->update('kolom_attributes', $data)) {
                header('Content-Type: application/json');
                echo json_encode([
                    'report_lama' => ucwords(strtolower($this->input->post('report', TRUE))),
                    'report_baru' => ucwords(strtolower($this->input->post('reporthid', TRUE))),
                    'sub_report_lama' => ucwords(strtolower($this->input->post('sub_report', TRUE))),
                    'sub_report_baru' => ucwords(strtolower($this->input->post('sub_reporthid', TRUE))),
                    'status_lama' => ucwords(strtolower($this->input->post('status', TRUE))),
                    'status_baru' => ucwords(strtolower($this->input->post('statushid', TRUE))),
                ]);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data kolom berhasil diperbarui!</div>');
                redirect('mino');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui data kolom. Silakan coba lagi.</div>');
                $this->edit_column_page($this->input->post('id', TRUE));
            }
        }
    }

    public function delete_column() {        
        $columnid = $this->input->post('id');
        $this->db->delete('kolom_attributes',['id'=>$columnid]);
        $this->db->delete('kolom_values',['kolom_id'=>$columnid]);

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus kolom id '. $columnid
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        redirect('murad');
    }

    public function get_report_data() {
        $report = $this->input->post('report');
    
        $this->db->select('ka.id, ka.report, ka.sub_report, ka.status, kv.value, kv.periode, kv.satuan');
        $this->db->from('kolom_attributes ka');
        $this->db->join('kolom_values kv', 'ka.id = kv.kolom_id');
        $this->db->where('ka.report', $report);
        $this->db->order_by('kv.periode', 'DESC'); // Mengurutkan berdasarkan kv.id dalam urutan ascending
        $query = $this->db->get();
        $data = $query->result_array();
    
        echo json_encode($data);
    }
    
    
    public function laporan_data(){
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Data Report'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }
        // Ambil data user
        $data['user'] = $this->get_user_data();
    
        // Ambil data kolom_attributes
        $this->db->select('id, report, sub_report, status');
        $this->db->from('kolom_attributes');
        $this->db->where('user_id', $data['user']['id']);
        $query = $this->db->get();
        $result = $query->result_array();
    
        // Mengelompokkan data
        $grouped_data = [];
        foreach ($result as $row) {
            $report = $row['report'];
            $status = $row['status'];
            $sub_report = $row['sub_report'];
            $kolom_id = $row['id'];
    
            // Hitung total value dan ambil satuan untuk kolom_id ini
            $this->db->select('SUM(CAST(value AS numeric)) AS total_value, satuan');
            $this->db->from('kolom_values');
            $this->db->where('kolom_id', $kolom_id);
            $this->db->group_by('satuan');
            $total_query = $this->db->get();
            $total_result = $total_query->row();

            // Periksa apakah $total_result tidak null
            if ($total_result) {
                $total_value = $total_result->total_value;
                $satuan = $total_result->satuan;
            } else {
                $total_value = 0; // Atau nilai default lainnya
                $satuan = ''; // Atau nilai default lainnya
            }
    
            if (!isset($grouped_data[$report])) {
                $grouped_data[$report] = [];
            }
            if (!isset($grouped_data[$report][$status])) {
                $grouped_data[$report][$status] = [];
            }
    
            // Memastikan tidak ada duplikasi sub_report
            if (!isset($grouped_data[$report][$status][$kolom_id])) {
                $grouped_data[$report][$status][$kolom_id] = [
                    'sub_reports' => [],
                    'total' => 0,
                    'satuan' => $satuan
                ];
            }
            if (!in_array($sub_report, $grouped_data[$report][$status][$kolom_id]['sub_reports'])) {
                $grouped_data[$report][$status][$kolom_id]['sub_reports'][] = $sub_report;
            }
    
            // Tambahkan total value ke data terkelompok
            $grouped_data[$report][$status][$kolom_id]['total'] = $total_value;
        }
    
        $data['grouped_data'] = $grouped_data;
    
        // Ambil data menu berdasarkan role_id
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
        $this->load->view('karyawan/kelola_laporan', $data);
    }    

    public function add_laporan_page() {
        // Mendapatkan data user dari session
        $user = $this->session->userdata('id'); // Sesuaikan dengan nama session yang Anda gunakan
        $data['user'] = $this->get_user_data();
    
        $this->db->select('MAX(id) AS id, user_id, report, MAX(sub_report) AS sub_report, MAX(status) AS status');
        $this->db->from('kolom_attributes');
        $this->db->where('user_id', $user);
        $this->db->group_by('user_id, report');
        $data['report'] = $this->db->get()->result_array();

        // Ambil data satuan
        $this->db->select('satuan');
        $this->db->from('satuan');
        $this->db->where('user_id', $user);
        $data['satuan'] = $this->db->get()->result_array();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        /// Cek status periode di tabel user
        $this->db->select('status_periode');
        $this->db->from('user');
        $this->db->where('id', $user);
        $status_periode_query = $this->db->get();

        // Periksa apakah ada data dan ambil status_periode
        $status_periode = $status_periode_query->row_array()['status_periode'] ?? null;

        // Tentukan apakah bulan dan tahun dapat diedit
        $canEdit = $status_periode === '0';
        $data['canEdit'] = $canEdit;

        // Load view 'karyawan/tambah_laporan'
        $this->load->view('karyawan/tambah_laporan', $data);
    }

    public function add_laporan() {

        $kolom_id = $this->input->post('id');
        $value = str_replace(',', '', $this->input->post('value')); // Hapus koma pemisah ribuan
        $periode = $this->input->post('tahun').'-'.$this->input->post('bulan').'-01';
        $satuan = $this->input->post('satuan');
        $status = $this->input->post('status');

        $checkDB = $this->db->get_where('kolom_values',[
            'kolom_id' => $kolom_id,
            'periode' => $periode
        ]) -> row_array();

        if(!$checkDB){
            $data = [
                'kolom_id' => $kolom_id,
                'value' => $value,
                'periode' => $periode,
                'satuan' => $satuan
            ];
            $this->db->insert('kolom_values', $data);
        }else{
            $total_value = $checkDB['value'] + $value;
            $data = [
                'value' => $total_value,
                'satuan' => $satuan
            ];
            $this->db->update('kolom_values', $data,['id'=>$checkDB['id']]);
        }
        
        $result = [
            'id' => $this->input->post('id'),
            'value' => $this->input->post('value'),
            'period' => $this->input->post('tahun').'-'.$this->input->post('bulan'),
            'report' => $this->input->post('report'),
            'subreport' => $this->input->post('subreport'),
            'satuan' => $this->input->post('satuan'),
            'status' => $status,
            'bulan' => $this->input->post('bulan'),
            'tahun' => $this->input->post('tahun'),
        ];

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menambah laporan data untuk '. $this->input->post('report') . ' (' . $this->input->post('subreport') .'/'.$this->input->post('tahun').'-'.$this->input->post('bulan').'-01'.')'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        // var_dump($result);
        // Di controller PHP
        echo json_encode($result);
    }

    public function delete_laporan(){
        $kolom_id = $this->input->post('id');
        $periode = $this->input->post('period');
        $this->db->select('ka.report, ka.sub_report, ka.status, ka.id, kv.periode');
        $this->db->from('kolom_values kv');
        $this->db->join('kolom_attributes ka', 'kv.kolom_id = ka.id');
        $this->db->join('user u', 'u.id = ka.user_id');
        $this->db->where('ka.id', $kolom_id);
        $this->db->group_by('ka.report, ka.sub_report, ka.status, ka.id, kv.periode, kv.id');
        $this->db->order_by('kv.periode', 'DESC'); // Urutkan berdasarkan periode
        $query = $this->db->get();
        $report_data = $query->row_array();

        $this->db->delete('kolom_values',['kolom_id'=>$kolom_id, 'periode'=>$periode]);
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus data report '. $report_data['report']. ' ( '.$report_data['sub_report'].'/'.$periode.' )'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
        header('Content-Type: application/json'); // Pastikan header JSON ditambahkan
        echo json_encode(['id' => $kolom_id, 'report' => $report_data['report'], 
        'subreport' => $report_data['sub_report'], 'period'=>$this->input->post('period')]);
    }

    public function get_data_report(){
        $kolom_id = $this->input->post('id');
        $period = $this->input->post('period');
        if ($kolom_id !== null) {
            $data = $this->Webmodel->get_reports_by_kolom_id($kolom_id,$period);
            header('Content-Type: application/json'); // Pastikan header JSON ditambahkan
            echo json_encode($data);
        } else {
            header('Content-Type: application/json'); // Pastikan header JSON ditambahkan
            echo json_encode(['error' => 'Invalid ID']);
        }
    }
    

    // Di dalam controller (misalnya karyawan.php)
    public function get_sub_reports() {
        $user_id = $this->session->userdata('id'); // Sesuaikan dengan session user_id Anda
        $report = $this->input->post('report'); // Ambil nilai 'report' dari POST data

        // Panggil method untuk mengambil sub report berdasarkan report
        $sub_reports = $this->Webmodel->get_sub_reports_by_report($user_id, $report);

        // Keluarkan hasil dalam format JSON
        echo json_encode($sub_reports);
    }

    public function get_attribute_id() {
        $userid = $this->session->userdata('id');
        $report = $this->input->post('report');
        $sub_report = $this->input->post('subreport');
        $status = $this->input->post('status');
    
        $this->db->select('id');
        $this->db->from('kolom_attributes');
        $this->db->where('report', $report);
        $this->db->where('sub_report', $sub_report);
        $this->db->where('status', $status);
        $this->db->where('user_id', $userid);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            echo json_encode(['status' => true, 'id' => $result->id]);
        } else {
            echo json_encode(['status' => false, 'message' => 'No matching attribute found']);
        }
    }

    public function get_satuan() {
        $user_id = $this->session->userdata('id'); // Ambil user_id dari session
    
        // Ambil data satuan dari database
        $this->db->select('satuan');
        $this->db->from('satuan');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->result();
            echo json_encode(['status' => true, 'data' => $result]);
        } else {
            echo json_encode(['status' => false, 'message' => 'No satuan found']);
        }
    }    

    public function edit_laporan_page() {
        /// Mendapatkan data user dari session
        $user_id = $this->session->userdata('id'); 
        $idTarget = $this->input->get('laporanid');
        
        $data['user'] = $this->get_user_data();

        // Ambil bulan dan tahun sekarang
        $currentMonth = date('m'); // Format MM
        $currentYear = date('Y'); // Format YYYY
        $data['periode_now'] = $currentYear.'-'.$currentMonth.'-01';

        // Ambil data laporan berdasarkan laporan_id
        $this->db->select('ka.report, ka.sub_report, ka.status, SUM(CAST(kv.value AS numeric)) as total_value, ka.id, kv.periode, kv.id, kv.satuan, u.status_periode');
        $this->db->from('kolom_values kv');
        $this->db->join('kolom_attributes ka', 'kv.kolom_id = ka.id');
        $this->db->join('user u', 'u.id = ka.user_id');
        $this->db->where('ka.id', $idTarget);
        $this->db->group_by('ka.report, ka.sub_report, ka.status, ka.id, kv.periode, kv.id, kv.satuan, u.status_periode');
        $this->db->order_by('kv.periode', 'DESC'); // Urutkan berdasarkan periode
        $query = $this->db->get();

        $data['laporan'] = $query->result_array();

        if (empty($data['laporan'])) {
            show_404();
        }

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        // Load view 'karyawan/edit_laporan'
        $this->load->view('karyawan/edit_laporan', $data);
    }

    public function check_laporanid() {
        $laporanid = $this->input->post('laporanid');
        $exists = $this->db->where('kolom_id', $laporanid)->count_all_results('kolom_values') > 0;
        
        echo json_encode(['exists' => $exists]);
    }
    

    public function edit_laporan(){
        if($this->input->post('editLapType')=="editlaporanperiodesekarang"){
            $id = $this->input->post('idedit');
            $report = $this->input->post('reportedit');
            $subreport = $this->input->post('subreportedit');
            $bulan = $this->input->post('valuebulanedit');
            $tahun = $this->input->post('tahunedit');
            $value = str_replace(',', '', $this->input->post('valueedit'));
            $satuan = $this->input->post('satuanedit');
            $satuanbefore = $this->input->post('satuanbefore');
            $status = $this->input->post('statusedit');
            $tanggal = $tahun.'-'.$bulan;
            $result = [
                'value' => $value,
                'period' => $tahun . '-' . $bulan,
                'report' => $report,
                'subreport' => $subreport,
                'satuan' => $satuan,
                'satuanbefore' => $satuanbefore,
                'status' => $status,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ];

            $data = [
                'value' => $value,
                'satuan' => $satuan
            ];
            $this->db->update('kolom_values', $data, ['id'=>$id]);
            $datas = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Mengedit Laporan Data '.$report.' ('.$subreport.'/'.$tanggal.')'
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$datas);
            
            header('Content-Type: application/json'); // Pastikan header JSON ditambahkan
            echo json_encode($result);
            return;
        }
        else{
            $id = $this->input->post('id');
            $report = $this->input->post('report');
            $subreport = $this->input->post('subreport');
            $tanggal = $this->input->post('tanggal');
            $value = $this->input->post('value');
            $satuan = $this->input->post('satuan');
            $data = [
                'value' => $value,
                'satuan' => $satuan
            ];
            $this->db->update('kolom_values', $data, ['id'=>$id]);
            $datas = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Mengedit Laporan Data '.$report.' ('.$subreport.'/'.$tanggal.')'
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$datas);
        }

    }

    public function get_laporan_data() {
        $laporanId = $this->input->get('laporanid');
        
        // Ambil data laporan berdasarkan laporan_id
        $this->db->select('ka.report, ka.sub_report, ka.status, CAST(kv.value AS numeric) as total_value, ka.id, kv.periode, kv.satuan, kv.id as id_kv');
        $this->db->from('kolom_values kv');
        $this->db->join('kolom_attributes ka', 'kv.kolom_id = ka.id');
        $this->db->where('kv.id', $laporanId);
        $query = $this->db->get();
        $laporan = $query->row_array();
    
        if ($laporan) {
            echo json_encode(['status' => true, 'laporan' => $laporan]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
    }

    public function get_status_periode() {
        $report = $this->input->post('report');
        $subreport = $this->input->post('subreport');
        $status = $this->input->post('status');
        $user_id = $this->session->userdata('id'); // Mengambil user_id dari session
    
        $this->db->select('status_periode');
        $this->db->from('kolom_values kv');
        $this->db->join('kolom_attributes ka', 'kv.kolom_id = ka.id');
        $this->db->where('ka.report', $report);
        $this->db->where('ka.sub_report', $subreport);
        $this->db->where('ka.status', $status);
        $this->db->where('ka.user_id', $user_id);
        $this->db->where('status_periode', 0);
        $this->db->where('periode <', date('Y-m-01')); // Selain bulan sekarang
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            echo '0'; // Terdapat data dengan status_periode 0
        } else {
            echo '1'; // Tidak terdapat data dengan status_periode 0
        }
    }
    
    public function kelola_satuan(){
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Satuan'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        $user = $this->session->userdata('id'); // Sesuaikan dengan nama session yang Anda gunakan
        $data['user'] = $this->get_user_data();

        // Ambil data satuan
        $this->db->select('id, satuan');
        $this->db->from('satuan');
        $this->db->where('user_id', $user);
        $data['satuan'] = $this->db->get()->result_array();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $this->load->view('karyawan/kelola_satuan', $data);
    }

    public function tambah_satuan_page(){
        $user = $this->session->userdata('id'); // Sesuaikan dengan nama session yang Anda gunakan
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $this->load->view('karyawan/tambah_satuan', $data);
    }

    public function tambah_satuan(){
        header('Content-Type: application/json');
        $satuan = ucwords(strtolower($this->input->post('newSatuan')));
        $id = $this->session->userdata('id');
        $cekSatuan = $this->db->get_where('satuan',['satuan'=>$satuan,'user_id'=>$id])->row_array();

        if(!empty($satuan)){
            if(!$cekSatuan){
                $data = [
                    'satuan' => $satuan,
                    'user_id' => $id
                ];
                $this->db->insert('satuan', $data);
                // insert to log data
                $datas = [
                    'user_id' => $this->session->userdata('id'),
                    'activity' => 'Menambah Satuan '.$satuan
                ];
                $this->db->set('date', 'NOW()', FALSE);
                $this->db->insert('log_data',$datas);
                $response = "<response><status>true</status><message>Satuan Berhasil Ditambahkan</message></response>";
            }else{
                $response = "<response><status>duplicate</status><message>Satuan Sudah Ada</message></response>";
            }
        } else {
            $response = "<response><status>false</status><message>Satuan tidak boleh kosong</message></response>";
        }
        $this->output->set_content_type('text/xml')->set_output($response);
    }

    public function edit_satuan_page($satuanId){
        $data['user'] = $this->get_user_data();
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['satuan'] = $this->db->get_where('satuan',['id'=>$satuanId])->row_array();
        $this->load->view('karyawan/edit_satuan', $data);
    }

    public function edit_satuan(){
        header('Content-Type: application/json');
        $satuan = ucwords(strtolower($this->input->post('satuan')));
        $satuanId = $this->input->post('id');
        $id = $this->session->userdata('id');
        $cekSatuan = $this->db->get_where('satuan',['satuan'=>$satuan,'user_id'=>$id])->row_array();

        if(!empty($satuan)){
            if(!$cekSatuan){
                $data = [
                    'satuan' => $satuan
                ];
                $this->db->update('satuan', $data, ['id' => $satuanId]);
                // insert to log data
                $datas = [
                    'user_id' => $this->session->userdata('id'),
                    'activity' => 'Mengedit satuan '.$satuan
                ];
                $this->db->set('date', 'NOW()', FALSE);
                $this->db->insert('log_data',$datas);
                $response = "<response><status>true</status><message>Satuan Berhasil Diupdate</message></response>";
            }else{
                $response = "<response><status>duplicate</status><message>Satuan Sudah Ada</message></response>";
            }
        } else {
            $response = "<response><status>false</status><message>Satuan tidak boleh kosong</message></response>";
        }
        $this->output->set_content_type('text/xml')->set_output($response);
    }

    public function delete_satuan(){
        $satuanId = $this->input->post('id');
        $satuan = $this->db->get_where('satuan',['id'=>$satuanId])->row();
        $this->db->delete('satuan',['id'=>$satuanId]);
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus satuan '.$satuan->satuan
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
    }
    
    public function ganti_password_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $menu_name = 'Ganti Password'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        $this->load->view('ganti_password',$data);
    }

    public function ganti_password(){
        header('Content-Type: application/json');
        $this->form_validation->set_rules('pass_old', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('pass_new', 'Password Baru', 'required|trim|min_length[8]');

        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department') -> result_array();

        if ($this->form_validation->run() == false){
            redirect('lauriel');
        } else {
            $verifyPass = password_verify($this->input->post('pass_old'),$data['user']['password']);
            if($verifyPass){
                $data = [
                    'password' => password_hash($this->input->post('pass_new'),PASSWORD_DEFAULT),
                ];
                
                // Update data ke database
                $this->db->update('user', $data, ['id' => $this->session->userdata('id')]);
                // insert to log data
                $data = [
                    'user_id' => $this->session->userdata('id'),
                    'activity' => 'Mengganti password'
                ];
                $this->db->set('date', 'NOW()', FALSE);
                $this->db->insert('log_data',$data);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Ganti password berhasil !'
                ]);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Salah !</div>');
                redirect('lauriel');
            }
        }
    }

    public function search_reports() {
        $query = $this->input->get('query');
        $user_id = $this->session->userdata('id'); // Ambil user_id dari session
    
        log_message('debug', 'User ID from session: ' . $user_id); // Tambahkan log
    
        if ($user_id === null) {
            log_message('error', 'User ID is null. Make sure the user is logged in and the session is set.');
            echo '<tr><td colspan="6">User ID is null. Please log in again.</td></tr>';
            return;
        }
    
        $result = $this->Webmodel->search_reports($query, $user_id);
    
        // Mengelompokkan data
        $grouped_data = [];
        foreach ($result as $row) {
            $report = $row['report'];
            $status = $row['status'];
            $sub_report = $row['sub_report'];
            $kolom_id = $row['kolom_id'];
            $total_value = $row['total_value'];
            $satuan = $row['satuan'];
    
            if (!isset($grouped_data[$report])) {
                $grouped_data[$report] = [];
            }
            if (!isset($grouped_data[$report][$status])) {
                $grouped_data[$report][$status] = [];
            }
    
            // Memastikan tidak ada duplikasi sub_report
            if (!isset($grouped_data[$report][$status][$kolom_id])) {
                $grouped_data[$report][$status][$kolom_id] = [
                    'sub_reports' => [],
                    'total' => 0,
                    'satuan' => $satuan
                ];
            }
            if (!in_array($sub_report, $grouped_data[$report][$status][$kolom_id]['sub_reports'])) {
                $grouped_data[$report][$status][$kolom_id]['sub_reports'][] = $sub_report;
            }
    
            // Tambahkan total value ke data terkelompok
            $grouped_data[$report][$status][$kolom_id]['total'] = $total_value;
        }
    
        if (empty($grouped_data)) {
            echo '<tr><td colspan="6">Data tidak ditemukan</td></tr>';
        } else {
            foreach ($grouped_data as $report => $statuses) {
                foreach ($statuses as $status => $kolom_ids) {
                    foreach ($kolom_ids as $kolom_id => $details) {
                        if ($details['total'] > 0) {
                            echo '<tr>';
                            echo '<td>' . $report . '</td>';
                            echo '<td>';
                            foreach ($details['sub_reports'] as $sub_report) {
                                echo $sub_report . '<br>';
                            }
                            echo '</td>';
                            echo '<td>' . $details['satuan'] . '</td>';
                            echo '<td>' . $status . '</td>';
                            echo '<td>' . $details['total'] . '</td>';
                            echo '<td>';
                            echo '<button class="btn btn-sm btn-primary detail-btn" data-laporanid="' . $kolom_id . '"><i class="fas fa-pen"></i> Detail</button>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                }
            }
        }
    }       

    public function get_existing_reports() {
        $this->db->distinct();
        $this->db->select('report');
        $query = $this->db->get('kolom_attributes');
        $reports = $query->result_array();
        
        // Mengambil hanya nilai report
        $report_names = array_column($reports, 'report');
        
        echo json_encode($report_names);
    }

    public function search_kolom() {
        $query = $this->input->get('query');
        $user_id = $this->session->userdata('id'); // Ambil user_id dari session
    
        if ($user_id === null) {
            echo '<tr><td colspan="5">User ID is null. Please log in again.</td></tr>';
            return;
        }
    
        $result = $this->Webmodel->search_kolom($query, $user_id);
    
        if (empty($result)) {
            echo '<tr><td colspan="5">Data tidak ditemukan</td></tr>';
        } else {
            $counter = 1; // Variabel penghitung
            foreach ($result as $row) {
                echo '<tr>';
                echo '<td>' . $counter++ . '</td>';
                echo '<td>' . $row['report'] . '</td>';
                echo '<td>' . $row['sub_report'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-sm btn-primary edit-btn" data-columnid="' . $row['kolom_id'] . '"><i class="fas fa-pen"></i> Edit</button>';
                if ($this->session->userdata('role_id') == 1) {
                    echo ' | <button class="btn btn-sm btn-danger btnDel" data-columnid="' . $row['kolom_id'] . '"><i class="fas fa-trash"></i> Delete</button>';
                }
                echo '</td>';
                echo '</tr>';
            }
        }
    }    
    
}