<?php

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/DashboardController.php';

$page = $_GET['page'] ?? '';

switch ($page) {

    /*
    |--------------------------------------------------------------------------
    | CONNEXION
    |--------------------------------------------------------------------------
    */

    case 'login':

        $controller = new AuthController();
        $controller->login();

        break;


    /*
    |--------------------------------------------------------------------------
    | INSCRIPTION
    |--------------------------------------------------------------------------
    */

    case 'register':

        $controller = new AuthController();
        $controller->register();

        break;

        case 'forgot-password':
    $controller = new AuthController();
    $controller->forgotPassword();
    break;

    case 'reset-password':
    $controller = new AuthController();
    $controller->resetPassword();
    break;


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    case 'dashboard':

        $controller = new DashboardController();
        $controller->index();

        break;


    /*
    |--------------------------------------------------------------------------
    | PAGE INCONNUE
    |--------------------------------------------------------------------------
    */

    default:

        echo "Page introuvable.";

        break;
}