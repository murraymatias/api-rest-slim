<?php

namespace Config;

// use App\Utils\Migrations;
// use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuarioController;
use App\Utils\Migrations;

return function ($app) {
    $app->get('[/]', UsuarioController::class .":getAll");
};