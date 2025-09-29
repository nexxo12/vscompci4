<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/transaksi/pembelian', 'Transaksi::pembelian');
$routes->get('/transaksi/pembelian/deletePembelian/(:segment)', 'Transaksi::deletePembelian/$1');

$routes->get('/transaksi/penjualan', 'Transaksi::penjualan');
$routes->get('/transaksi/penjualan/addbarang', 'Transaksi::addbarang');
$routes->get('/transaksi/penjualan/print/(:segment)', 'Transaksi::printnota/$1');

$routes->get('/transaksi/return_service', 'Transaksi::serviceReturn');

$routes->get('/transaksi/garansi', 'Transaksi::garansi');

$routes->get('/master_barang', 'Master::barang');
$routes->get('/master_customer', 'Master::customer');
$routes->get('/master_supplier', 'Master::supplier');

$routes->get('/karyawan/add', 'Finance::add');
$routes->get('/karyawan/pengaturan', 'Finance::setting');
$routes->get('/karyawan/gaji', 'Finance::gaji');

$routes->get('/laporan/penjualan', 'Finance::laporanpj');
$routes->get('/laporan/pembelian', 'Finance::laporanbl');
$routes->get('/laporan/laba', 'Finance::laba');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
