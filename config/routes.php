<?php

namespace Config;

// use App\Utils\Migrations;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuarioController;

return function ($app) {

    $app->post('/login', UsuarioController::class .":login");
    $app->get('/user', UsuarioController::class .":getAll");
    $app->get('/test/{id}', UsuarioController::class .":getOne");
};