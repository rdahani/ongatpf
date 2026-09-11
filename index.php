<?php

declare(strict_types=1);

$config = require __DIR__ . '/app/bootstrap.php';

$router = new Router();

// Public
$router->get('/', [HomeController::class, 'index']);
$router->get('/a-propos', [PageController::class, 'about']);
$router->get('/domaines', [PageController::class, 'domains']);
$router->get('/projets', [ProjectController::class, 'index']);
$router->get('/projets/{slug}', [ProjectController::class, 'show']);
$router->get('/impact', [PageController::class, 'impact']);
$router->get('/actualites', [NewsController::class, 'index']);
$router->get('/actualites/{slug}', [NewsController::class, 'show']);
$router->get('/ressources', [PageController::class, 'resources']);
$router->get('/partenaires', [PageController::class, 'partners']);
$router->get('/contact', [PageController::class, 'contact']);
$router->post('/contact', [PageController::class, 'contactSubmit']);

// API
$router->get('/api/regions/{slug}', [ApiController::class, 'region']);

// Admin
$router->get('/admin/login', [AdminController::class, 'loginForm']);
$router->post('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/logout', [AdminController::class, 'logout']);
$router->get('/admin', [AdminController::class, 'dashboard']);

$router->get('/admin/projets', [AdminController::class, 'projects']);
$router->get('/admin/projets/create', [AdminController::class, 'projectForm']);
$router->get('/admin/projets/edit/{id}', [AdminController::class, 'projectForm']);
$router->post('/admin/projets/save', [AdminController::class, 'projectSave']);
$router->post('/admin/projets/delete', [AdminController::class, 'projectDelete']);

$router->get('/admin/actualites', [AdminController::class, 'news']);
$router->get('/admin/actualites/create', [AdminController::class, 'newsForm']);
$router->get('/admin/actualites/edit/{id}', [AdminController::class, 'newsForm']);
$router->post('/admin/actualites/save', [AdminController::class, 'newsSave']);
$router->post('/admin/actualites/delete', [AdminController::class, 'newsDelete']);

$router->get('/admin/partenaires', [AdminController::class, 'partners']);
$router->post('/admin/partenaires/save', [AdminController::class, 'partnerSave']);
$router->post('/admin/partenaires/delete', [AdminController::class, 'partnerDelete']);

$router->get('/admin/chiffres', [AdminController::class, 'stats']);
$router->post('/admin/chiffres/save', [AdminController::class, 'statsSave']);

$router->get('/admin/messages', [AdminController::class, 'messages']);
$router->post('/admin/messages/read', [AdminController::class, 'messageRead']);

$router->get('/admin/ressources', [AdminController::class, 'resources']);
$router->post('/admin/ressources/save', [AdminController::class, 'resourceSave']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'] ?? '/');
