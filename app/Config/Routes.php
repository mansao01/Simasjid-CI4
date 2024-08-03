<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login/forgetPassword', 'Login::forgetPassword');
$routes->post('login/sendResetLink', 'Login::sendResetLink');
$routes->get('login/resetPassword', 'Login::resetPassword');
$routes->post('login/processResetPassword', 'Login::processResetPassword');
$routes->get('email-test', 'EmailTest::index');
$routes->get('verify/(:any)', 'Login::verify/$1');
$routes->post('telegram', 'Telegram::index');
$routes->post('telegram/webhook', 'Telegram::webhook');
$routes->get('telegram/setWebhook', 'Telegram::setWebhook');





$routes->setAutoRoute(true);
