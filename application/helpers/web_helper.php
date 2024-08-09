<?php

function is_logged_in()
{
    $ci = get_instance();
    $ci->load->model('Webmodel');
    
    // Check if user is logged in
    if (!$ci->session->userdata('username')) {
        redirect('home');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $class = $ci->router->fetch_class(); // Get controller class
        $method = $ci->router->fetch_method(); // Get controller method

        // Example role access rules
        $access_rules = [
            'admin' => ['admin/index', 'admin/kelola_user','admin/get_sub_departments',
            'admin/add_user_page','admin/open_periode','admin/add_user', 'admin/kelola_menu', 
            'admin/add_menu_page', 'admin/add_menu', 'admin/kelola_otorisasi', 'admin/update_otorisasi', 
            'admin/edit_user_page', 'admin/edit_user', 'admin/delete_user','admin/get_user_by_id', 
            'admin/reset_password_page', 'admin/reset_password', 'admin/backup_database',
            'admin/close_periode','admin/kelola_department','admin/add_department', 'admin/add_subdepartment', 
            'admin/add_department_page','admin/edit_department_page', 'admin/edit_department','admin/edit_sub_department_page', 
            'admin/edit_sub_department','admin/get_department_code','admin/delete_department','admin/delete_sub_department',
            'admin/get_department_code','admin/ajax_search','admin/check_user_add','admin/check_department_added',
            'admin/check_sub_department_added','admin/kelola_akses_report','admin/edit_akses_report_page',
            'admin/edit_akses_report','admin/monitoring_report',
            
            'karyawan/kelola_kolom','karyawan/add_column_page','karyawan/add_column', 
            'karyawan/laporan_data','karyawan/add_laporan_page','karyawan/get_data_report',
            'karyawan/get_sub_reports', 'karyawan/get_attribute_id', 'karyawan/add_laporan', 
            'karyawan/edit_column_page', 'karyawan/update_column', 'karyawan/delete_column',
            'karyawan/ganti_password_page','karyawan/ganti_password','karyawan/get_satuan',
            'karyawan/edit_laporan_page', 'karyawan/tambah_satuan', 'karyawan/tambah_satuan_page',
            'karyawan/kelola_satuan','karyawan/get_laporan_data', 'karyawan/search_kolom',
            'karyawan/edit_satuan_page','karyawan/edit_satuan','karyawan/delete_satuan',
            'karyawan/edit_laporan','karyawan/check_laporanid','karyawan/search_reports',
            'karyawan/checkData','karyawan/get_existing_reports','karyawan/delete_laporan'
            ],

            'karyawan' => ['karyawan/index', 'karyawan/kelola_kolom','karyawan/add_column_page',
            'karyawan/add_column', 'karyawan/laporan_data','karyawan/add_laporan_page',
            'karyawan/get_sub_reports', 'karyawan/get_attribute_id', 'karyawan/add_laporan', 
            'karyawan/edit_column_page', 'karyawan/update_column', 'karyawan/delete_column',
            'karyawan/ganti_password_page','karyawan/ganti_password','karyawan/get_satuan',
            'karyawan/edit_laporan_page', 'karyawan/tambah_satuan','karyawan/get_laporan_data',
            'karyawan/edit_laporan','karyawan/check_laporanid','karyawan/get_status_periode', 
            'karyawan/kelola_satuan', 'karyawan/tambah_satuan_page','karyawan/edit_satuan_page',
            'karyawan/edit_satuan','karyawan/delete_satuan','karyawan/search_reports',
            'karyawan/checkData','karyawan/get_existing_reports','karyawan/get_data_report', 'karyawan/search_kolom',

            'admin/kelola_user','admin/get_sub_departments','admin/kelola_akses_report','admin/edit_akses_report_page',
            'admin/add_user_page','admin/add_user', 'admin/kelola_menu', 'admin/add_menu_page', 
            'admin/add_menu', 'admin/kelola_otorisasi', 'admin/update_otorisasi', 'admin/edit_user_page', 
            'admin/edit_user', 'admin/delete_user','admin/get_user_by_id', 'admin/reset_password_page', 
            'admin/reset_password','admin/kelola_kolom', 'admin/backup_database','admin/ajax_search',
            'karyawan/delete_laporan','karyawan/get_report_data'
            ],

            'manager' => ['manager/index', 
            
            'karyawan/kelola_kolom','karyawan/add_column_page',
            'karyawan/add_column', 'karyawan/laporan_data','karyawan/add_laporan_page',
            'karyawan/get_sub_reports', 'karyawan/get_attribute_id', 'karyawan/add_laporan', 
            'karyawan/edit_column_page', 'karyawan/update_column', 'karyawan/delete_column',
            'karyawan/ganti_password_page','karyawan/ganti_password','karyawan/get_satuan',
            'karyawan/edit_laporan_page', 'karyawan/tambah_satuan','karyawan/get_laporan_data',
            'karyawan/edit_laporan','karyawan/check_laporanid','karyawan/kelola_satuan', 
            'karyawan/tambah_satuan_page', 'karyawan/edit_satuan_page','karyawan/edit_satuan',
            'karyawan/delete_satuan', 'karyawan/search_reports','karyawan/checkData', 'karyawan/get_existing_reports', 'karyawan/search_kolom',

            'admin/kelola_user','admin/get_sub_departments','karyawan/get_data_report',
            'admin/add_user_page','admin/add_user', 'admin/kelola_menu', 'admin/add_menu_page', 
            'admin/add_menu', 'admin/kelola_otorisasi', 'admin/update_otorisasi', 'admin/edit_user_page', 
            'admin/edit_user', 'admin/delete_user','admin/get_user_by_id', 'admin/reset_password_page', 
            'admin/reset_password', 'admin/backup_database', 'admin/ajax_search','karyawan/delete_laporan',
            'admin/kelola_akses_report','admin/edit_akses_report_page','admin/monitoring_report',
            ],

            'admin_department' => ['admin_department/index',
            
            'karyawan/kelola_kolom','karyawan/add_column_page','karyawan/get_data_report',
            'karyawan/add_column', 'karyawan/laporan_data','karyawan/add_laporan_page',
            'karyawan/get_sub_reports', 'karyawan/get_attribute_id', 'karyawan/add_laporan', 
            'karyawan/edit_column_page', 'karyawan/update_column', 'karyawan/delete_column',
            'karyawan/ganti_password_page','karyawan/ganti_password','karyawan/get_satuan',
            'karyawan/edit_laporan_page', 'karyawan/tambah_satuan','karyawan/get_laporan_data',
            'karyawan/edit_laporan','karyawan/check_laporanid','karyawan/kelola_satuan', 
            'karyawan/tambah_satuan_page', 'karyawan/edit_satuan_page','karyawan/edit_satuan',
            'karyawan/delete_satuan', 'karyawan/search_reports','karyawan/checkData','karyawan/get_existing_reports', 'karyawan/search_kolom',

            'admin/index', 'admin/kelola_user','admin/get_sub_departments',
            'admin/add_user_page','admin/open_periode','admin/add_user', 'admin/kelola_menu', 
            'admin/add_menu_page', 'admin/add_menu', 'admin/kelola_otorisasi', 'admin/update_otorisasi', 
            'admin/edit_user_page', 'admin/edit_user', 'admin/delete_user','admin/get_user_by_id', 
            'admin/reset_password_page', 'admin/reset_password', 'admin/backup_database',
            'admin/close_periode','admin/kelola_department','admin/add_department', 'admin/add_subdepartment', 
            'admin/add_department_page','admin/edit_department_page', 'admin/edit_department','admin/edit_sub_department_page', 
            'admin/edit_sub_department','admin/get_department_code','admin/delete_department','admin/delete_sub_department',
            'admin/get_department_code','admin/ajax_search','admin/check_user_add','admin/check_department_added',
            'admin/check_sub_department_added','admin/kelola_akses_report','admin/edit_akses_report_page',
            'admin/edit_akses_report','admin/monitoring_report',
            ]
        ];

        // Get role name from role_id
        $role = $ci->db->get_where('user_role', ['id' => $role_id])->row()->role;

        // Create access path string
        $access_path = strtolower($class.'/'.$method);

        // Check if the user's role has access to the requested path
        if (!in_array($access_path, $access_rules[$role])) {
            redirect('errorpage');
        }
    }
}
