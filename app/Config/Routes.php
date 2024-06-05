<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PublicController::index');
$routes->get('create_account', 'PublicController::create_account');
$routes->get('user_types', 'PublicController::user_types');
$routes->get('customer_registration', 'PublicController::customer_registration');
$routes->get('brand_partner_registration', 'PublicController::brand_partner_registration');
$routes->post('register_customer', 'PublicController::register_customer');
$routes->post('register_brand_partner', 'PublicController::register_brand_partner');
$routes->get('coming_soon', 'PublicController::coming_soon');

