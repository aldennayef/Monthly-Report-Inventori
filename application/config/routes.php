<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

# MODUL

$route['monthly_report'] = 'home/direct_monthly_report';
$route['inventori'] = 'home/direct_inventori';

# MONTHLY REPORT

# ROUTES >>>>> ADMIN
$route['murad'] = 'user/admin/kelola_user';
$route['butterfly'] = 'user/admin';
$route['wonder'] = 'user/admin/add_user_page';
$route['kahli'] = 'user/admin/add_user';
$route['thane'] = 'user/admin/edit_user_page';
$route['violet'] = 'user/admin/edit_user';
$route['yorn'] = 'user/admin/delete_user';
$route['thane'] = 'user/admin/edit_user_page';
$route['paine'] = 'user/admin/reset_password_page';
$route['quillen'] = 'user/admin/reset_password';
$route['kenu'] = 'user/admin/kelola_menu';
$route['miya'] = 'user/admin/add_menu_page';
$route['freya'] = 'user/admin/add_menu';
$route['angela'] = 'user/admin/kelola_department';
$route['kesi'] = 'user/admin/kelola_otorisasi';
$route['kesi/(:num)'] = 'user/admin/kelola_otorisasi/$1';
$route['upsi/(:num)'] = 'user/admin/update_otorisasi/$1';
$route['grakk'] = 'user/admin/backup_database';
$route['toro'] = 'user/admin/add_department_page';
$route['flash'] = 'user/admin/add_department';
$route['joker'] = 'user/admin/add_subdepartment';
$route['max'] = 'user/admin/edit_department_page';
$route['ryoma'] = 'user/admin/edit_department';
$route['shinra'] = 'user/admin/edit_sub_department_page';
$route['denji'] = 'user/admin/edit_sub_department';
$route['luru'] = 'user/admin/ajax_search';
$route['rourke'] = 'user/admin/kelola_akses_report';
$route['slimz/(:num)'] = 'user/admin/edit_akses_report_page/$1';
$route['dextra'] = 'user/admin/monitoring_report';




# ROUTES >>>>> KARYAWAN
$route['zephys'] = 'user/karyawan';
$route['mino'] = 'user/karyawan/kelola_kolom';
$route['seizu'] = 'user/karyawan/add_column_page';
$route['kirito'] = 'user/karyawan/add_column';
$route['hayate'] = 'user/karyawan/laporan_data';
$route['tulen'] = 'user/karyawan/add_laporan_page';
$route['zata'] = 'user/karyawan/add_laporan';
$route['edit_column/(:num)'] = 'user/karyawan/edit_column_page/$1';
$route['aang'] = 'user/karyawan/update_column'; 
$route['shin'] = 'user/karyawan/delete_column'; 
$route['lauriel'] = 'user/karyawan/ganti_password_page';
$route['ignis'] = 'user/karyawan/ganti_password';
$route['raz'] = 'user/karyawan/get_satuan';
$route['aleister'] = 'user/karyawan/edit_laporan_page';
$route['azzenka'] = 'user/karyawan/tambah_satuan';
$route['ilumia'] = 'user/karyawan/edit_laporan';
$route['fennik'] = 'user/karyawan/check_laporanid';
$route['omen'] = 'user/karyawan/kelola_satuan';
$route['taara'] = 'user/karyawan/tambah_satuan_page';
$route['arum/(:num)'] = 'user/karyawan/edit_satuan_page/$1';
$route['valhein'] = 'user/karyawan/edit_satuan';
$route['laville'] = 'user/karyawan/delete_satuan';
$route['ronaldo'] = 'user/karyawan/search_reports';
$route['pessi'] = 'user/karyawan/get_existing_reports';
$route['kepot'] = 'user/karyawan/search_kolom';


# ROUTES >>>>> MANAGER
$route['maloch'] = 'user/manager';


# ROUTES >>>>> FACTORY MANAGER
$route['gon'] = 'user/admin_department';

# INVENTORI
$route['dsb'] = 'inventori/proses';
$route['dem'] = 'inventori/proses/detail_item';
$route['dejim'] = 'inventori/proses/detail_jenisitem';
$route['aip/(:any)'] = 'inventori/proses/aksi_item_page/$1';
$route['deus'] = 'inventori/proses/detail_users';
$route['decs'] = 'inventori/proses/detail_clusters';
$route['tbc'] = 'inventori/proses/tambah_clusters';
$route['act'] = 'inventori/proses/aksi_clusters';
$route['akm'] = 'inventori/proses/aksi_item';
$route['deb'] = 'inventori/proses/detail_pembelian';
$route['apbp/(:any)'] = 'inventori/proses/aksi_pembelian_page/$1';
$route['akpb'] = 'inventori/proses/aksi_pembelian';
$route['depak'] = 'inventori/proses/detail_pemakaian';
$route['apmp/(:any)'] = 'inventori/proses/aksi_pemakaian_page/$1';
$route['akpkai'] = 'inventori/proses/aksi_pemakaian';
$route['kjg'] = 'inventori/proses/kunjungan';
$route['dop'] = 'inventori/proses/dataopname';
$route['akdo'] = 'inventori/proses/aksi_dataopname';
$route['detop'] = 'inventori/proses/detail_dataopname';
$route['inventori/proses/more_info'] = 'inventori/proses/more_info';
$route['bakri'] = 'inventori/proses/backup_database';
$route['astokp'] = 'inventori/proses/aksi_adjust_stok_page';
$route['astok'] = 'inventori/proses/aksi_adjust_stok';
$route['deastok'] = 'inventori/proses/detail_adjust_stok';