<?php

namespace Config;

use Slim\App;
use App\Middlewares\JSONResponseMiddleware;


return function (App $app) {
    $app->addBodyParsingMiddleware();

    //Carga header Content-type -> JSON en las respuestas
    $app->add(new JSONResponseMiddleware());
};