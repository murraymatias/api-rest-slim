<?php

namespace Config;

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\AlumnosController;
use App\Middleware\BeforeMiddleware;
use App\Middleware\AlumnoValidateMiddleware;


return function ($app) {
    $app->group('/alumnos', function (RouteCollectorProxy $group) {
        $group->get('[/]', AlumnosController::class . ':getAll');
        $group->get('/:id', AlumnosController::class . ':getOne');
        $group->post('[/]', AlumnosController::class . ':add')->add(AlumnoValidateMiddleware::class);
        $group->put('/:id', AlumnosController::class . ':update')->add(AlumnoValidateMiddleware::class);
        $group->delete('/:id', AlumnosController::class . ':delete');
    })->add(new BeforeMiddleware());

    $app->group('/materias', function (RouteCollectorProxy $group) {
        $group->get('[/]', AlumnosController::class . ':getAll');
        $group->get('/:id', AlumnosController::class . ':getOne');
        $group->post('[/]', AlumnosController::class . ':add');
        $group->put('/:id', AlumnosController::class . ':update');
        $group->delete('/:id', AlumnosController::class . ':delete');
    });
};