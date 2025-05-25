<?php

use App\Controllers\AjaxController;
use App\Controllers\UserController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return redirect()->to('/users');
});

$routes->group('users', function ($routes) {
    $routes->get('/', [UserController::class, 'index'], ['as' => 'users.index']);
    $routes->post('datatable', [UserController::class, 'datatable'], ['as' => 'users.datatable']);
    $routes->post('store', [UserController::class, 'store'], ['as' => 'users.store']);
    $routes->post('update/(:num)', [UserController::class, 'update'], ['as' => 'users.update']);
    $routes->delete('delete/(:num)', [UserController::class, 'delete'], ['as' => 'users.delete']);

    $routes->group('ajax', function ($routes) {
        $routes->get('get-user-by-id/(:num)', [AjaxController::class, 'get_user_by_id'], ['as' => 'users.ajax.get-user-by-id']);
        $routes->post('get-select-departments', [AjaxController::class, 'select_get_departments'], ['as' => 'users.ajax.select-get-departments']);
    });
});
