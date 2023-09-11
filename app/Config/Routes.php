<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('GSB2SIO/public/selection', 'Home::selectionMois');
$routes->get('GSB2SIO/public/note', 'Home::note');
$routes->post('GSB2SIO/public/note', 'Home::note');
$routes->get('GSB2SIO/public/nouveau', 'Home::nouveau');
$routes->post('GSB2SIO/public/nouveau', 'Home::nouveau');
$routes->get('GSB2SIO/public/edition', 'Home::edition');
$routes->post('GSB2SIO/public/edition', 'Home::edition');
$routes->get('GSB2SIO/public/supprimer', 'Home::Supprimer');
$routes->get('GSB2SIO/public/deconnexion', 'Home::deconnexion');
$routes->post('GSB2SIO/public/login', 'Home::login');
// Redirige sur index car on est pas censé pouvoir y aller en GET
$routes->get('GSB2SIO/public/login', 'Home::index');


