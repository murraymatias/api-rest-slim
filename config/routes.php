<?php

namespace Config;

use App\Controllers\MascotaController;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuarioController;
use App\Controllers\TipoMascotaController;
use App\Middlewares\JWTMiddleware;
use App\Middlewares\AdministradorMiddleware;
use App\Middlewares\ClienteMiddleware;

return function ($app) {

    $app->post('/registro', UsuarioController::class .":add");
    $app->post('/login', UsuarioController::class .":login");
    $app->post('/tipo_mascota', TipoMascotaController::class .":add")->add(new AdministradorMiddleware());
    $app->post('/mascotas', MascotaController::class .":add")->add(new ClienteMiddleware);
    // $app->group('/turnos', function (RouteCollectorProxy $group)
    // {
    // }
};