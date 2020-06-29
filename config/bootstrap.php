<?php

namespace Config;

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Database;
use Slim\Factory\AppFactory;

// Instanciar Illuminate
new Database();

$app = AppFactory::create();
$app->setBasePath("/suarezmurray.SPPROGIII3D/public");
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true,true,true);

// REGISTRAR RUTAS
(require_once __DIR__ . '/routes.php')($app);

// REGISTRAR MIDDLEWARE
(require_once __DIR__ . '/middlewares.php')($app);

return $app;