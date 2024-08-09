<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller{

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

        $data['log_data'] = $this->Webmodel->log_data();

        $this->load->view('dashboard', $data);
    }

    public function open_periode() {
        $user_id = $this->input->post('id'); // Ambil user_id dari POST request
    
        if (!$user_id) {
            error_log('Error: missing user_id');
            echo 'error: missing user_id';
            return;
        }

        $this->db->set('status_periode', 0);
        $this->db->where('id', $user_id);
        $result = $this->db->update('user');

        $getNama = $this->db->select('nama')->get_where('user', ['id'=>$user_id])->row();

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Membuka periode untuk '. $getNama->nama
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        error_log('Query Result: ' . $result); // Tambahkan log untuk melihat hasil query

        if ($result) {
            if ($this->db->affected_rows() > 0) {
                error_log('Update successful: ' . $this->db->affected_rows() . ' rows affected.');
                echo 'success';
            } else {
                error_log('Error: no rows affected');
                echo 'error: no rows affected';
            }
        } else {
            $error = $this->db->error();
            error_log('Error: ' . $error['message']);
            echo 'error: ' . $error['message'];
        }
    }

    public function close_periode() {
        $user_id = $this->input->post('id'); // Ambil user_id dari POST request
    
        if (!$user_id) {
            error_log('Error: missing user_id');
            echo 'error: missing user_id';
            return;
        }

        $this->db->set('status_periode', 1);
        $this->db->where('id', $user_id);
        $result = $this->db->update('user');

        $getNama = $this->db->select('nama')->get_where('user', ['id'=>$user_id])->row();

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menutup periode untuk '. $getNama->nama
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

        error_log('Query Result: ' . $result); // Tambahkan log untuk melihat hasil query

        if ($result) {
            if ($this->db->affected_rows() > 0) {
                error_log('Update successful: ' . $this->db->affected_rows() . ' rows affected.');
                echo 'success';
            } else {
                error_log('Error: no rows affected');
                echo 'error: no rows affected';
            }
        } else {
            $error = $this->db->error();
            error_log('Error: ' . $error['message']);
            echo 'error: ' . $error['message'];
        }
    }
    
    

    // Kelola User #################################################################
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

        $this->db->select('user.id, user.nama, user.nik, user.role_id, user.status_periode, user.username, user_department.department, user_sub_department.sub_department, user_role.role');
        $this->db->from('user');
        $this->db->join('user_department', 'user.department_id = user_department.id');
        $this->db->join('user_sub_department', 'user.sub_department_id = user_sub_department.id');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->order_by('user.id', 'ASC');
        $data['all_users'] = $this->db->get()->result_array();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department')->result_array();
        $data['sub_department'] = $this->db->get('user_sub_department')->result_array();

        $this->load->view('admin/kelola_users', $data);
    }

    public function get_sub_departments(){
        $department_id = $this->input->post('department_id');
        $this->db->select('id, sub_department');
        $this->db->from('user_sub_department');
        $this->db->where('department_id', $department_id);
        $query = $this->db->get();
        $result = $query->result_array();
        echo json_encode($result);
    }

    public function add_user_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department') -> result_array();


        $this->load->view('admin/tambah_user',$data);
    }

    public function add_user(){
        $name = ucwords(strtolower($this->input->post('nama')));
        $nik = $this->input->post('nik');
        $uName = $this->input->post('username');
        $pWord = $this->input->post('password');
        $dept = $this->input->post('department');
        $subdept = $this->input->post('sub_department');
        $role = $this->input->post('posisi');

        // $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]',[
        //     'is_unique' => 'Username sudah terdaftar !'
        // ]);
        // $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        // $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        // $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
        // $this->form_validation->set_rules('department', 'Department', 'required|trim');
        // $this->form_validation->set_rules('sub_department', 'Sub Department', 'required|trim');

        // if ($this->form_validation->run() == false) {
        //     $data['user'] = $this->get_user_data();

        //     $role_id = $this->session->userdata('role_id');
        //     $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        //     $data['department'] = $this->db->get('user_department') -> result_array();

        //     $this->load->view('admin/tambah_user',$data);
        // } else {
            $data = [
                'nama' => $name,
                'nik' => $nik,
                'username' => $uName,
                'password' => password_hash($pWord, PASSWORD_DEFAULT),
                'department_id' => $dept,
                'sub_department_id' => $subdept,
                'role_id' => $role,
                'status_periode' => 1
            ];
            $this->db->insert('user', $data);

            // insert to log data
            $data = [
                'user_id' => $this->session->userdata('id'),
                'activity' => 'Menambah user '. $name
            ];
            $this->db->set('date', 'NOW()', FALSE);
            $this->db->insert('log_data',$data);
        // }
    }

    public function check_user_add(){
        $username = $this->input->post('username');
        $nik = $this->input->post('nik');
        $result1 = $this->Webmodel->get_user_by_username($username);
        $result2 = $this->Webmodel->get_user_by_nik($nik);
        if($result1){
            echo json_encode(['status' => '1']);
        }elseif($result2){
            echo json_encode(['status' => '2']);
        }else{
            echo json_encode(['status' => '0']);
        }
    }

    public function edit_user_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department') -> result_array();

        $idTarget = $this->input->get('userid');
        $data['userTarget'] = $this->Webmodel->get_user_by_id($idTarget);

        $this->load->view('admin/edit_user',$data);
    }

    public function edit_user(){
        $name = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $uName = $this->input->post('username');
        $dept = $this->input->post('department');
        $subdept = $this->input->post('sub_department');
        $role_id = $this->input->post('posisi');
        $id = $this->input->post('id');
    
            $data = [
                'nama' => $name,
                'nik' => $nik,
                'username' => $uName,
                'department_id' => $dept,
                'sub_department_id' => $subdept,
                'role_id' => $role_id,
                'status_periode' => 1
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

    public function get_sub_departments_by_department_by_id(){
        $idUser = $this->input->post('id');
        $user = $this->db->get_where('user', ['id' => $idUser]) -> row_array();
        if($user){
            $this->output->set_content_type('application/json')->set_output(json_encode($user));
        }else{
            $this->output->set_status_header(404)->set_output(json_encode(['error' => 'User not found']));
        }
    }

    // Kelola Menu #################################################################
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

    public function kelola_akses_report(){
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Akses Report'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }
        // Ambil data user
        $data['user'] = $this->get_user_data();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        // Ambil data manager beserta departmentnya
        $data['managers'] = $this->Webmodel->get_managers_with_department();

        // Ambil data PIC untuk masing-masing manager
        foreach ($data['managers'] as &$manager) {
            $manager['pic'] = $this->Webmodel->get_pics_by_department($manager['department_id']);
            $manager['reports'] = $this->Webmodel->get_reports_by_manager($manager['id']);
        }


        $this->load->view('admin/kelola_akses_report',$data);
    }

    public function edit_akses_report_page($manager_id){
        $role_id = $this->session->userdata('role_id');
        $data['user'] = $this->get_user_data();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
        // Dapatkan data manager berdasarkan ID
        $data['manager'] = $this->Webmodel->get_manager_by_id($manager_id);
        
        // Dapatkan semua kolom report
        $kolom_reports = $this->Webmodel->get_all_kolom_reports_with_department();
        
        // Dapatkan akses report yang sudah diberikan kepada manager
        $access_reports = $this->Webmodel->get_access_reports_by_manager($manager_id);

        // Group reports by department
        $grouped_reports = [];
        foreach ($kolom_reports as $report) {
            $grouped_reports[$report['department']][] = $report;
        }
        
        $data['grouped_reports'] = $grouped_reports;
        $data['access_reports'] = $access_reports;
    
        $this->load->view('admin/edit_akses_report',$data);
    }

    public function edit_akses_report() {
        $user_id = $this->input->post('manager_id'); // Pastikan Anda mengirimkan manager_id dari form
        $selected_reports = $this->input->post('reports'); // Array of selected kolom_id

        // Dapatkan akses report yang sudah diberikan kepada manager
        $existing_access_reports = $this->Webmodel->get_access_reports_by_manager($user_id);

        // Hapus akses yang tidak lagi dicentang
        foreach ($existing_access_reports as $access_report) {
            if (!in_array($access_report['kolom_id'], $selected_reports)) {
                $this->Webmodel->remove_report_access($user_id, $access_report['kolom_id']);
            }
        }

        // Tambahkan akses baru jika belum ada
        foreach ($selected_reports as $kolom_id) {
            if (!$this->Webmodel->check_access_exists($user_id, $kolom_id)) {
                $this->Webmodel->add_report_access($user_id, $kolom_id);
            }
        }


        // Redirect atau tampilkan pesan sukses
        // $this->session->set_flashdata('success', 'Report access updated successfully.');
        // redirect('desired_redirect_url'); // Ganti dengan URL tujuan Anda
    }

    public function kelola_department() {
        // Mengambil menu berdasarkan role_id
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Kelola Department'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }
        $data['user'] = $this->get_user_data();

        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
    
        // Mengambil semua department dengan sub_department
        $this->db->select('user_department.kode, user_department.department, user_sub_department.sub_department');
        $this->db->from('user_department');
        $this->db->join('user_sub_department', 'user_department.kode = user_sub_department.kode_dept', 'left');
        $this->db->order_by('user_department.kode','ASC');
        $data['departments'] = $this->db->get()->result_array();
    
        // Mengambil semua department
        $this->db->order_by('kode', 'ASC');
        $data['department'] = $this->db->get('user_department')->result_array();
        $this->db->order_by('kode_dept', 'ASC');
        $data['sub_department'] = $this->db->get('user_sub_department')->result_array();

        // Menampilkan view kelola_department
        $this->load->view('admin/kelola_department', $data);
    }
    

    public function add_department_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $data['department'] = $this->db->get('user_department')->result_array();

        $this->load->view('admin/tambah_department', $data);
    }

    public function add_department(){
        $kodeDept = $this->input->post('kode_dept');
        $dept = ucwords(strtolower($this->input->post('department')));

        $data = [
            'department' => $dept,
            'kode' => $kodeDept
        ];
        
        $this->db->insert('user_department', $data);
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menambah department '. $dept .'( '. $kodeDept. ' )'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
    }

    public function check_department_added(){
        $kode = $this->input->post('kode_dept');
        
        $result = $this->Webmodel->get_department_by_kode($kode);
        
        if($result){
            echo json_encode(['status' => '1']);
        }
        else{
            echo json_encode(['status' => '0']); 
        }  
    }

    public function check_sub_department_added(){
        $kodedept = $this->input->post('kodedept');
        $name = ucwords(strtolower($this->input->post('sub_department')));
        $result = $this->Webmodel->get_sub_department_by_name($kodedept,$name);
        if($result){
            echo json_encode(['status' => '1']);
        }else{
            echo json_encode(['status' => '0']);
        }
    }

    public function get_department_code() {
        $department_id = $this->input->post('department_id');
        $department = $this->db->get_where('user_department', ['id' => $department_id])->row_array();

        if ($department) {
            echo json_encode(['kode' => $department['kode']]);
        } else {
            echo json_encode(['kode' => '']);
        }
    }

    public function delete_department(){
        $deptId = $this->input->post('id');
        $this->db->delete('user_department', ['id'=>$deptId]);
        $this->db->delete('user_sub_department', ['department_id'=>$deptId]);
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus department id '. $deptId
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
    }

    public function add_subdepartment(){
        $kodeDept = $this->input->post('kodedept');
        $idDept = $this->input->post('department');
        $sub = ucwords(strtolower($this->input->post('sub_department')));

        $data = [
            'sub_department' => $sub,
            'department_id' => $idDept,
            'kode_dept' => $kodeDept,
        ];
        
        $this->db->insert('user_sub_department', $data);
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menambah sub department '. $sub .'( '. $kodeDept. ' )'
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
    }

    public function edit_department_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $idTarget = $this->input->get('deptid');
        $data['dataTarget'] = $this->db->get_where('user_department',['id' => $idTarget]) -> row_array();
        $this->load->view('admin/edit_department', $data);
    }

    public function edit_sub_department_page(){
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);

        $idTarget = $this->input->get('subid');
        $data['department'] = $this->db->get('user_department')->result_array();
        $data['dataTarget'] = $this->db->get_where('user_sub_department',['id' => $idTarget]) -> row_array();
        $this->load->view('admin/edit_sub_department', $data);
    }

    public function edit_department(){
        $kodeDept = $this->input->post('kodedept');
        $dept = ucwords(strtolower($this->input->post('department')));
        $idDept = $this->input->post('id');

        $data = [
            'department' => $dept,
            'kode' => $kodeDept
        ];
        $this->db->update('user_department', $data, ['id' => $idDept]);

        $datas = [
            'kode_dept' => $kodeDept
        ];
        $this->db->update('user_sub_department', $datas, ['department_id' => $idDept]);

        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Mengupdate department '. $dept
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);

    }

    public function edit_sub_department() {
        // Mengambil data dari input form
        $kodeDept = $this->input->post('kodedept'); // Kode Department
        $subDept = ucwords(strtolower($this->input->post('sub_department'))); // Nama Sub Department
        $idSubDept = $this->input->post('id'); // ID Sub Department yang akan diupdate
        $departmentId = $this->input->post('department_id'); // ID Department baru (jika ada perubahan)
    
        // Menyiapkan data untuk update sub department
        $dataSubDept = [
            'sub_department' => $subDept,
            'kode_dept' => $kodeDept,
            'department_id' => $departmentId // Update ID department jika diperlukan
        ];
        
        // Melakukan update pada tabel user_sub_department
        $this->db->update('user_sub_department', $dataSubDept, ['id' => $idSubDept]);
    
        // Insert ke log data
        $logData = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Mengupdate sub department ' . $subDept
        ];
        $this->db->set('date', 'NOW()', FALSE); // Set waktu saat ini
        $this->db->insert('log_data', $logData);
    
        // Redirect atau menampilkan pesan sukses
        // Anda bisa menggunakan flashdata untuk menampilkan pesan sukses
        $this->session->set_flashdata('success', 'Sub Department berhasil diperbarui.');
    }

    public function delete_sub_department(){
        $subdeptId = $this->input->post('id');
        $this->db->delete('user_sub_department', ['id'=>$subdeptId]);
        // insert to log data
        $data = [
            'user_id' => $this->session->userdata('id'),
            'activity' => 'Menghapus sub department id '. $subdeptId
        ];
        $this->db->set('date', 'NOW()', FALSE);
        $this->db->insert('log_data',$data);
    }
    
    public function kelola_otorisasi($menu_id) {
        $data['user'] = $this->get_user_data();

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
        $backupDir = 'E:\backup_db';

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

    #######################################################

    public function kelola_kolom() {
        $id = $this->session->userdata('id');
        $data['user'] = $this->get_user_data();

        $role_id = $this->session->userdata('role_id');
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
    
        // Tampilkan form tambah kolom
        $this->load->view('karyawan/tambah_kolom', $data);
    }

    public function add_column() {
        $this->form_validation->set_rules('report', 'Report', 'required|trim');
        $this->form_validation->set_rules('sub_report', 'Sub Report', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
    
        if ($this->form_validation->run() == false) {
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
            $this->db->insert('log_data', $logdata);
            
            // Ambil data hasil input dari sesi dan tambahkan data baru
            $input_results = $this->session->userdata('input_results') ?? [];
            $input_results[] = $input_data;
            $this->session->set_userdata('input_results', $input_results);
            
            // Mengembalikan respons sukses dalam format JSON
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'report' => $report // Pastikan untuk mengirimkan kembali nilai report
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
    
    public function laporan_data(){
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

    public function edit_laporan_page() {
        // Mendapatkan data user dari session
        $user_id = $this->session->userdata('id'); 
        $idTarget = $this->input->get('laporanid');
        
        $data['user'] = $this->get_user_data();
        
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
    
    
    public function tambah_satuan(){
        header('Content-Type: application/json');
        $satuan = ucwords(strtolower($this->input->post('satuan')));
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
                    'message' => 'Ganti password berhasil!'
                ]);
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Lama Salah !</div>');
                redirect('lauriel');
            }
        }
    }
    
    public function ajax_search() {
        log_message('debug', 'luru method called');
        $query = $this->input->get('query');
        log_message('debug', 'Query parameter: ' . $query);

        try {
            $users = $this->Webmodel->search_users($query);
            log_message('debug', 'Users retrieved: ' . print_r($users, true));

            if (empty($users)) {
                echo '<tr><td colspan="9">Data tidak ditemukan</td></tr>';
            } else {
                $no = 1; foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $user['nama'] . '</td>';
                    echo '<td>' . $user['nik'] . '</td>';
                    echo '<td>' . $user['username'] . '</td>';
                    echo '<td>' . $user['department'] . '</td>';
                    echo '<td>' . $user['sub_department'] . '</td>';
                    echo '<td>' . $user['role'] . '</td>';
                    echo '<td>';
                    if($user['role_id']!=1){
                        echo '<button class="btn btn-sm btn-primary edit-btn" data-userid="' . $user['id'] . '"><i class="fas fa-pen"></i> Edit</button> | ';
                        echo '<button class="btn btn-sm btn-danger btnDel" data-userid="' . $user['id'] . '"><i class="fas fa-trash"></i> Delete</button>';
                    }
                    echo '</td>';
                    echo '<td>';
                    if($user['role_id'] != 1){
                        if ($user['status_periode'] == 1) {
                            echo '<button class="btn btn-sm btn-success btnOpen" data-userid="' . $user['id'] . '"><i class="fas fa-door-open"></i> Open&nbsp;&nbsp;</button>';
                        } else {
                            echo '<button class="btn btn-sm btn-danger btnClose" data-userid="' . $user['id'] . '"><i class="fas fa-door-open"></i> Closed</button>';
                        }
                    }
                    echo '</td>';
                    echo '</tr>';
                }
            }
        } catch (Exception $e) {
            log_message('error', 'Error in luru method: ' . $e->getMessage());
            echo 'Internal Server Error';
        }
    }

    public function monitoring_report(){
        $role_id = $this->session->userdata('role_id');
        $menu_name = 'Monitoring Report'; // Nama menu yang sesuai dengan fungsi saat ini

        // Periksa akses
        $access_info = $this->Webmodel->userHasAccess($role_id, $menu_name);
        if ($access_info === null) {
            redirect('errorpage');
        }

        // Ambil data user
        $data['user'] = $this->get_user_data();
        $data['menu'] = $this->Webmodel->getUserMenu($role_id);
        // Ambil department user yang sedang login
        $department_id = $data['user']['department_id'];
        // Dapatkan data PIC yang belum mengisi report untuk periode berjalan
        $data['unfilled_reports'] = $this->Webmodel->get_unfilled_reports($department_id);

        // Hitung periode yang sedang berjalan
        $currentDate = new DateTime();
        $currentDay = $currentDate->format('d');
        if ($currentDay < 6) {
            $currentDate->modify('-1 month');
        }
        $monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $currentMonth = $monthNames[(int)$currentDate->format('m') - 1];
        $currentYear = $currentDate->format('Y');
        $data['current_period'] = $currentMonth . ' ' . $currentYear;
        $this->load->view('admin/monitoring_report', $data);
    }

    public function get_unfilled_reports() {
        $currentPeriod = date('Y-m-d'); // Periode berjalan, misalnya "2024-08"
        
        $this->db->select('u.id as user_id, u.nama as pic, ka.report, ka.sub_report, ka.status');
        $this->db->from('user u');
        $this->db->join('kolom_attributes ka', 'u.id = ka.user_id');
        $this->db->join('kolom_values kv', 'ka.id = kv.kolom_id AND kv.periode = \'' . $currentPeriod . '\'', 'left');
        $this->db->where('u.role_id', 3); // PIC memiliki role_id = 3
        $this->db->where('kv.id IS NULL', null, false); // Kondisi di mana data belum diisi
    
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
}