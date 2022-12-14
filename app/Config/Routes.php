<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Untuk Front End Site
$routes->get('/', 'Home::index');

// Untuk Back End Site

// Login, Dashboard, Logout
$routes->get('/login', 'Auth::index');
$routes->post('/logining', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/admin', 'Dashboard::index');

// Category
$routes->get('/category', 'Category::index');
$routes->post('/saveCategory', 'Category::newCategory');
$routes->post('/updateCategory', 'Category::updateCategory');
$routes->post('/deleteCategory', 'Category::deleteCategory');

// Product Menu
$routes->get('/product', 'Product::index');
$routes->get('/newProduct', 'Product::newProduct');
$routes->get('/updateStatus/(:num)', 'Product::updateStatus/$1');
$routes->post('/saveProduct', 'Product::saveProduct');
$routes->post('/updateProduct', 'Product::updateProduct');
$routes->post('/deleteProduct', 'Product::deleteProduct');

// Company Profile Menu
$routes->get('/company', 'Company::index');
$routes->post('/saveCompany', 'Company::saveProfile');

// News
$routes->get('/news', 'News::index');
$routes->post('/news', 'News::saveNews');



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
