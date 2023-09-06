<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('selection', 'Home::selectionMois');
$routes->get('note', 'Home::note');
$routes->get('nouveau', 'Home::nouveau');
$routes->get('edition', 'Home::edition');

