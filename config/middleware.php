<?php

declare(strict_types=1);

namespace Config;

use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {

    $settings = $app->getContainer()->get('settings');

    $app->addBodyParsingMiddleware();
    
    $app->addRoutingMiddleware();
    
    $app->addErrorMiddleware($settings['displayErrorDetails'],$settings['logErrors'],$settings['logErrorDetails']);
};