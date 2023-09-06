<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('GSB2SIO/public/selection', 'Home::selectionMois');
$routes->get('GSB2SIO/public/note', 'Home::note');

