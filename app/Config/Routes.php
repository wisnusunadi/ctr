<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LoginApp::login');
$routes->get('/register', 'LoginApp::register');
$routes->post('/register', 'LoginApp::store_register');
$routes->post('/login', 'LoginApp::store_login');
$routes->get('/logout', 'LoginApp::logout');

//Murid
$routes->get('/murid', 'Dashboard::murid_dash', ['filter' => 'auth']);

// Admin
$routes->get('/admin', 'Dashboard::admin_dash', ['filter' => 'auth']);
$routes->get('/rekap_nilai', 'Dashboard::rekap_nilai', ['filter' => 'auth']);

//MataPelajaran
$routes->post('/mapel/nilai/', 'Dashboard::mapel_nilai_store', ['filter' => 'auth']);
$routes->delete('/mapel/nilai/delete/(:num)', 'Dashboard::mapel_nilai_delete/$1', ['filter' => 'auth']);
$routes->get('/mapel/nilai/(:num)', 'Dashboard::mapel_nilai/$1', ['filter' => 'auth']);
$routes->get('/mapel', 'Dashboard::mapel_view', ['filter' => 'auth']);
$routes->get('/mapel/edit/(:num)', 'Dashboard::mapel_edit/$1', ['filter' => 'auth']);
$routes->post('/mapel/update/(:num)', 'Dashboard::mapel_update/$1', ['filter' => 'auth']);
$routes->get('/mapel/create', 'Dashboard::mapel_create', ['filter' => 'auth']);
$routes->delete('/mapel/delete/(:num)', 'Dashboard::mapel_delete/$1', ['filter' => 'auth']);
$routes->post('/mapel/', 'Dashboard::mapel_store', ['filter' => 'auth']);

//ADmin
$routes->get('/guru', 'Dashboard::guru_view', ['filter' => 'auth']);
$routes->get('/guru/edit/(:num)', 'Dashboard::guru_edit/$1', ['filter' => 'auth']);
$routes->post('/guru/update/(:num)', 'Dashboard::guru_update/$1', ['filter' => 'auth']);
$routes->delete('/guru/delete/(:num)', 'Dashboard::guru_delete/$1', ['filter' => 'auth']);
$routes->post('/guru', 'Dashboard::guru_store', ['filter' => 'auth']);
$routes->get('/guru/create', 'Dashboard::guru_create', ['filter' => 'auth']);


//Murid
$routes->post('/murids', 'Dashboard::murid_store', ['filter' => 'auth']);
$routes->get('/murids', 'Dashboard::murid_view', ['filter' => 'auth']);
$routes->get('/murids/create', 'Dashboard::murid_create', ['filter' => 'auth']);
$routes->get('/murids/edit/(:num)', 'Dashboard::murid_edit/$1', ['filter' => 'auth']);
$routes->post('/murids/update/(:num)', 'Dashboard::murid_update/$1', ['filter' => 'auth']);
$routes->delete('/murids/delete/(:num)', 'Dashboard::murid_delete/$1', ['filter' => 'auth']);
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
