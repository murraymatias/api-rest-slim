<?php

declare(strict_types=1);

namespace Config;

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Database;
use Slim\Factory\AppFactory;
use DI\Container;

// Instantiate Illuminate
new Database();

$container = new Container();

$settings = require_once __DIR__ . '/settings.php';

$settings($container);

AppFactory::setContainer($container);

$app = AppFactory::create();
$app->setBasePath("/suarezmurray.SPPROGIII3D/public");

// Register middleware
(require_once __DIR__ . '/middleware.php')($app);

// Register routes
(require_once __DIR__ . '/routes.php')($app);

return $app;