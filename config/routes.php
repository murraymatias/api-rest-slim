<?php

declare(strict_types=1);

namespace Config;

use App\Controllers\UserController;
use App\Middleware\AccessLevelMiddleware;
use App\Middleware\ValidTokenMiddleware;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;

return function ($app) {

    $app->post('/', UserController::class . ':getAll')->add(new AccessLevelMiddleware)->add(new ValidTokenMiddleware);


    $app->post('/registro', UserController::class . ':create');
    $app->post('/login', UserController::class . ':login');

    //Routes inside this group routes need a valid token to access
    $app->group('', function(RouteCollectorProxy $group){

        $group->post('tipo_mascota',UserController::class . ':set');

    })->add(new ValidTokenMiddleware);
};