<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('GSB2SIO/public/selection', 'Selection::index');
$routes->get('GSB2SIO/public/note', 'Note::index');

