<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Proses extends CI_Controller{

    public function __construct() {
        parent::__construct();
        is_logged_in();
        $this->load->model('Webmodel');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->helper('file');
        $this->load->helper('download');
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
    
    // Page 
    public function kelola_user() {
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Users'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        // Ambil data user
        $data['user'] = $this->get_user_data();

        $this->db->select('user.id, user.nama, user.nik, user.username, user_department.department, user_sub_department.sub_department, user_role.role');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $data['all_users'] = $this->db->get()->result_array();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department')->result_array();
        $data['sub_department'] = $this->db->get('user_sub_department')->result_array();

        $this->load->view('admin/kelola_users', $data);
    }

    public function reset_password_page() {
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Reset Password User'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        // Ambil data user
        $data['user'] = $this->get_user_data();
        $data['list_user'] = $this->db->get('user')->result_array();
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
        $data['department'] = $this->db->get('user_department')->result_array();

        $this->load->view('admin/reset_password', $data);
    }

    public function kelola_menu() {
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Menu'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }
        // Ambil data user
        $data['user'] = $this->get_user_data();
        
        // Fetch all menus for admin management
        $data['all_menus'] = $this->Webmodel->getAllMenus();
        
        // Fetch accessible menus for user navigation
        $role_id = $data['user']['role_id'];
        $data['user_menus'] = $this->Webmodel->getUserMenu($role_id);

            // Add access users to each menu
        foreach ($data['all_menus'] as &$menu) {
            $menu['access_users'] = $this->Webmodel->get_access_roles($menu['id']);
        }
        
        // Load view with data
        $this->load->view('admin/kelola_menu', $data);
    }

    public function kelola_kolom() {
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Kolom'; // Nama menu yang sesuai dengan fungsi saat ini

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

    public function laporan_data(){
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Laporan Data'; // Nama menu yang sesuai dengan fungsi saat ini

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
    
            // Hitung total value untuk kolom_id ini
            $this->db->select_sum('CAST(value AS numeric)', 'value');
            $this->db->from('kolom_values');
            $this->db->where('kolom_id', $kolom_id);
            $total_query = $this->db->get();
            $total_result = $total_query->row();
            $total_value = $total_result->value;
    
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
                    'total' => 0
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

    // Function on Kelola Users
    public function add_user_page(){
        $username = $this->session->userdata('username');
        
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department') -> result_array();


        $this->load->view('admin/tambah_user',$data);
    }

    public function add_user(){
        $name = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $uName = $this->input->post('username');
        $pWord = $this->input->post('password');
        $dept = $this->input->post('department');
        $subdept = $this->input->post('sub_department');
        $role = $this->input->post('role_id');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',[
            'is_unique' => 'Username sudah terdaftar !'
        ]);
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('department', 'Department', 'required|trim');
        $this->form_validation->set_rules('sub_department', 'Sub Department', 'required|trim');

        if ($this->form_validation->run() == false) {
            $username = $this->session->userdata('username');
        
            $this->db->select('user.*, user_department.department');
            $this->db->from('user');
            $this->db->join('user_department', 'user.department_id = user_department.id');
            $this->db->where('user.username', $username);
            $data['user'] = $this->db->get()->row_array();

            $role_id = $this->session->userdata('role_id');
            $data['menu'] = $this->Webmodel->getUserMenu($role_id);

            $data['department'] = $this->db->get('user_department') -> result_array();

            $this->load->view('admin/tambah_user',$data);
        } else {
            $data = [
                'nama' => $name,
                'nik' => $nik,
                'username' => $uName,
                'password' => password_hash($pWord, PASSWORD_DEFAULT),
                'department_id' => $dept,
                'sub_department_id' => $subdept,
                'role_id' => $role,
            ];
            $this->db->insert('user', $data);

            // insert to log data
            $data = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Menambah user '. $name
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$data);

            redirect('murad');
        }
    }

    public function edit_user_page(){
        $username = $this->session->userdata('username');
        
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department') -> result_array();

        $idTarget = $this->input->get('userid');
        $data['userTarget'] = $this->db->get_where('user', ['id'=>$idTarget]) -> row_array();

        $this->load->view('admin/edit_user',$data);
    }

    public function edit_user(){
        $name = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $uName = $this->input->post('username');
        $pWord = $this->input->post('password');
        $dept = $this->input->post('department');
        $subdept = $this->input->post('sub_department');
        $role_id = $this->input->post('role_id');
        $id = $this->input->post('id');
    
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        $this->form_validation->set_rules('department', 'Department', 'required|trim');
        $this->form_validation->set_rules('sub_department', 'Sub Department', 'required|trim');
    
        if ($this->form_validation->run() == false) {
            $username = $this->session->userdata('username');
        
            $this->db->select('user.*, user_department.department');
            $this->db->from('user');
            $this->db->join('user_department', 'user.department_id = user_department.id');
            $this->db->where('user.username', $username);
            $data['user'] = $this->db->get()->row_array();
    
            $role_id = $this->session->userdata('role_id');
            $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
            $data['department'] = $this->db->get('user_department')->result_array();
    
            $this->load->view('admin/edit_user', $data);
        } else {
            $data = [
                'nama' => $name,
                'nik' => $nik,
                'username' => $uName,
                'password' => password_hash($pWord, PASSWORD_DEFAULT),
                'department_id' => $dept,
                'sub_department_id' => $subdept,
                'role_id' => $role_id,
            ];
            
            // Pastikan update hanya memperbarui kolom selain kolom `id`
            $this->db->where('id', $id);
            $this->db->update('user', $data);

            // insert to log data
            $data = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Mengedit user '. $name
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$data);

            redirect('murad');
        }
    }

    public function delete_user(){
        $idUser = $this->input->post('id');
        $this->db->delete('user',['id'=>$idUser]);

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus user id '. $idUser
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        redirect('murad');
    }

    // Function On Reset & Change Password
    public function reset_password(){
        $id = $this->input->post('id_nama');
        $pWord = $this->input->post('password');
        
        $data = [
            'password' => password_hash($pWord, PASSWORD_DEFAULT)
        ];
    
        // Memperbarui data pengguna dengan id yang diberikan
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    
        // Insert ke log data
        $log_data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Mereset password user id ' . $id
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data', $log_data);
    
        redirect('paine');
    }

    public function ganti_password_page(){
        // Ambil data user
        $username = $this->session->userdata('username');
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $this->load->view('ganti_password',$data);
    }

    public function ganti_password(){
        header('Content-Type: application/json');
        $this->form_validation->set_rules('pass_old', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('pass_new', 'Password Baru', 'required|trim|min_length[8]');

        $username = $this->session->userdata('username');
        
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

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
                    'message' => 'Ganti password berhasil!'
                ]);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Salah !</div>');
                redirect('lauriel');
            }
        }
    }

    // Function On Menus
    public function kelola_otorisasi($menu_id) {
        $this->load->model('Webmodel');

        // Fetch the current user
        $username = $this->session->userdata('username');
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();

        // Fetch menu details for the given menu_id
        $data['menu_details'] = $this->db->get_where('menu', ['id' => $menu_id])->row_array();

        // Fetch all roles and access roles for the given menu_id
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
        $data['roles'] = $this->Webmodel->get_all_roles();
        $data['access_roles'] = $this->Webmodel->get_access_roles($menu_id);

        // Add menu_id to the data array
        $data['menu_id'] = $menu_id;

        // Debugging output
        error_log(print_r($data['roles'], true));
        error_log(print_r($data['access_roles'], true));
        error_log(print_r($data['menu_details'], true));

        // Load view with data
        $this->load->view('admin/kelola_otorisasi', $data);
    }

    public function update_otorisasi($menu_id)
    {
        // Ambil peran yang dipilih dari pengiriman formulir
        $selected_roles = $this->input->post('roles');

        // Ambil akses peran yang sudah ada untuk menu tertentu
        $existing_roles = $this->db->where('menu_id', $menu_id)->get('user_access_menu')->result_array();

        // Siapkan array untuk akses peran baru
        $new_access_roles = [];

        // Buat array akses peran baru berdasarkan pengiriman formulir
        foreach ($selected_roles as $role_id) {
            $new_access_roles[] = [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ];
        }

        // Bandingkan akses peran yang ada dengan akses peran baru untuk menentukan perubahan
        $to_be_removed = array_udiff($existing_roles, $new_access_roles, function($a, $b) {
            return $a['role_id'] - $b['role_id'];
        });

        $to_be_added = array_udiff($new_access_roles, $existing_roles, function($a, $b) {
            return $a['role_id'] - $b['role_id'];
        });

        // Lakukan operasi database untuk menghapus dan menambahkan akses peran
        foreach ($to_be_removed as $access) {
            $this->db->where('role_id', $access['role_id'])->where('menu_id', $access['menu_id'])->delete('user_access_menu');
        }

        foreach ($to_be_added as $access) {
            $this->db->insert('user_access_menu', $access);
        }
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Mengupdate access menu'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);


        // Redirect kembali ke halaman kelola_otorisasi untuk $menu_id yang dipilih
        redirect('kenu');
    }

    // Function On Columns
    public function add_column_page() {
        $data['user'] = $this->get_user_data();
    
        // Ambil data menu berdasarkan role_id
        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
        // Ambil semua role untuk otorisasi menu
        $data['roles'] = $this->db->get('user_role')->result_array();
    
        // Tampilkan form tambah kolom
        $this->load->view('karyawan/tambah_kolom', $data);
    }

    public function add_column() {
        $this->form_validation->set_rules('report', 'Report', 'required|trim');
        $this->form_validation->set_rules('sub_report', 'Sub Report', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
    
        if ($this->form_validation->run() == false){
            $data['user'] = $this->get_user_data();
            
            $role_id = $this->session->userdata('role_id');
            $data['menu'] = $this->Webmodel->getUserMenu($role_id);
            
            $data['department'] = $this->db->get('user_department')->result_array();
            
            // Ambil data hasil input dari sesi
            $data['input_results'] = $this->session->userdata('input_results') ?? [];
            
            $this->load->view('karyawan/tambah_kolom', $data);
        } else {
            // Data yang diinput oleh pengguna
            $report = $this->input->post('report');
            $sub_report = $this->input->post('sub_report');
            $status = $this->input->post('status');
            
            $input_data = [
                'user_id' => $this->input->post('user_id'),
                'report' => $report,
                'sub_report' => $sub_report,
                'status' => $status
            ];
    
            // Masukkan data kolom ke database
            $this->Webmodel->insert_column($input_data);
            
           // insert to log data
            $logdata = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Menambah Report'
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$logdata);
            
            // Ambil data hasil input dari sesi dan tambahkan data baru
            $input_results = $this->session->userdata('input_results') ?? [];
            $input_results[] = $input_data;
            $this->session->set_userdata('input_results', $input_results);
            
            // Siapkan data untuk menampilkan hasil input dan mengisi ulang form
            $data['user'] = $this->get_user_data();
            $role_id = $this->session->userdata('role_id');
            $data['menu'] = $this->Webmodel->getUserMenu($role_id);
            $data['department'] = $this->db->get('user_department')->result_array();
            $data['input_results'] = $input_results;
            
            // Isi ulang form dengan nilai 'report' yang telah diisi sebelumnya
            $data['report'] = $report;
            $data['sub_report'] = ''; // Kosongkan nilai sub_report
            
            // Tampilkan form tambah kolom dengan hasil input
            $this->load->view('karyawan/tambah_kolom', $data);
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
                'report' => $this->input->post('report', TRUE),
                'sub_report' => $this->input->post('sub_report', TRUE),
                'status' => $this->input->post('status', TRUE)
            ];
    
            $this->db->where('id', $this->input->post('id', TRUE));
            
            if ($this->db->update('kolom_attributes', $data)) {
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

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus user id '. $columnid
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        redirect('murad');
    }

    // Function On Data Values
    public function add_laporan_page() {
        // Mendapatkan data user dari session
        $user = $this->session->userdata('id'); // Sesuaikan dengan nama session yang Anda gunakan
        $username = $this->session->userdata('username');
    
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();
    
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

        // Load view 'karyawan/tambah_laporan'
        $this->load->view('karyawan/tambah_laporan', $data);
    }

    public function add_laporan() {

        $kolom_id = $this->input->post('id');
        $value = $this->input->post('value');
        $periode = $this->input->post('tanggal').'-01';
        $satuan = $this->input->post('satuan');

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
            'period' => $this->input->post('tanggal'),
            'report' => $this->input->post('report'),
            'subreport' => $this->input->post('subreport'),
            'satuan' => $this->input->post('satuan'),
        ];

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menambah laporan data untuk '. $this->input->post('report') . ' (' . $this->input->post('subreport') .'/'.$this->input->post('tanggal').')'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        var_dump($result);

    }

    public function edit_laporan_page() {
        // Mendapatkan data user dari session
        $user_id = $this->session->userdata('id'); 
        $username = $this->session->userdata('username');
        $idTarget = $this->input->get('laporanid');
        
        // Ambil data user
        $this->db->select('user.*, user_department.department, user_sub_department.sub_department');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->where('user.username', $username);
        $data['user'] = $this->db->get()->row_array();
        
        // Ambil data laporan berdasarkan laporan_id
         // Ambil data laporan berdasarkan laporan_id
        $this->db->select('ka.report, ka.sub_report, ka.status, SUM(CAST(kv.value AS numeric)) as total_value, ka.id, kv.periode, kv.id');
        $this->db->from('kolom_values kv');
        $this->db->join('kolom_attributes ka', 'kv.kolom_id = ka.id');
        $this->db->where('ka.id', $idTarget);
        $this->db->group_by('ka.report, ka.sub_report, ka.status, ka.id, kv.periode, kv.id');
        $this->db->order_by('kv.periode', 'ASC'); // Urutkan berdasarkan periode
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

    // Extra
    public function get_user_by_id(){
        // Mengambil ID pengguna dari input POST
        $idUser = $this->input->post('id');

        // Mengambil data pengguna dari database berdasarkan ID
        $user = $this->db->get_where('user', ['id' => $idUser])->row_array();

        // Memeriksa apakah pengguna ditemukan
        if ($user) {
            // Mengatur header content-type sebagai JSON
            header('Content-Type: application/json');

            // Mengembalikan data pengguna dalam format JSON
            echo json_encode($user);
        } else {
            // Jika pengguna tidak ditemukan, mengatur status header 404 dan mengirim pesan kesalahan
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'User not found']);
        }
    }

    public function get_sub_departments(){
        $department_id = $this->input->post('department_id');
        $this->db->select('id, sub_department, role_id');
        $this->db->from('user_sub_department');
        $this->db->where('department_id', $department_id);
        $query = $this->db->get();
        $result = $query->result_array();
        echo json_encode($result);
    }

    public function get_sub_departments_by_department_by_id(){
        $idUser = $this->input->post('id');
        $user = $this->db->get_where('user', ['id' => $idUser]) -> row_array();
        if($user){
            $this->output->set_content_type('application/json')->set_output(json_encode($user));
        }else{
            $this->output->set_status_header(404)->set_output(json_encode(['error' => 'User not found']));
        }
    }

    public function get_sub_reports() {
        $user_id = $this->session->userdata('id'); // Sesuaikan dengan session user_id Anda
        $report = $this->input->post('report'); // Ambil nilai 'report' dari POST data

        // Panggil method untuk mengambil sub report berdasarkan report
        $sub_reports = $this->Webmodel->get_sub_reports_by_report($user_id, $report);

        // Keluarkan hasil dalam format JSON
        echo json_encode($sub_reports);
    }

    public function get_attribute_id() {
        $report = $this->input->post('report');
        $sub_report = $this->input->post('subreport');
        $status = $this->input->post('status');
    
        $this->db->select('id');
        $this->db->from('kolom_attributes');
        $this->db->where('report', $report);
        $this->db->where('sub_report', $sub_report);
        $this->db->where('status', $status);
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

    public function tambah_satuan(){
        header('Content-Type: application/json');
        $satuan = $this->input->post('satuan');
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
                $response = "<response><status>true</status><message>Satuan berhasil ditambahkan</message></response>";
            }else{
                $response = "<response><status>duplicate</status><message>Satuan sudah ada</message></response>";
            }
        } else {
            $response = "<response><status>false</status><message>Satuan tidak boleh kosong</message></response>";
        }
        echo $response;
    }

    // Backup Data
    public function backup_database()
    {
        // Load PhpSpreadsheet library
        require 'vendor/autoload.php';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Fetch database data
        $tables = $this->Webmodel->get_all_tables();

        foreach ($tables as $table) {
            // Access table name from array
            $tableName = $table['table_name'];

            // Create a new worksheet for each table
            $sheet = $spreadsheet->createSheet();
            $sheet->setTitle($tableName);
            
            $data = $this->Webmodel->get_table_data($tableName);
            $column = 'A';
            $row = 1;

            // Set column names
            if (!empty($data)) {
                $field_names = array_keys($data[0]);
                foreach ($field_names as $field) {
                    $sheet->setCellValue($column . $row, $field);
                    $column++;
                }
                $row++;

                // Set data rows
                foreach ($data as $record) {
                    $column = 'A';
                    foreach ($record as $value) {
                        // Make sure there is no array to string conversion
                        if (is_array($value)) {
                            $value = json_encode($value);
                        }
                        $sheet->setCellValue($column . $row, $value);
                        $column++;
                    }
                    $row++;
                }
                $row++;
            }
        }

        // Remove the default sheet created on initialization
        $spreadsheet->removeSheetByIndex(0);

        // Write to file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // Get last month's number and format it
        $lastMonthNumber = date('n', strtotime('first day of last month')); // e.g., 6 for June
        $dateTime = date('Ymd_His');
        $filename = "backup_report_period_{$lastMonthNumber}_{$dateTime}.xlsx";
        $backupDir = 'E:/backup_db';

        // Create the directory if it doesn't exist
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0777, true);
        }

        $filepath = $backupDir . '/' . $filename;
        $writer->save($filepath);

        // Insert ke log data
        $log_data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Melakukan Backup Data'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data', $log_data);

        redirect('butterfly');
    }

}