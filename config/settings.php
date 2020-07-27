<?php

declare(strict_types=1);

namespace Config;

use DI\Container;

return function (Container $container){
    $container->set('settings',function (){
        return[
        'name' => 'Slim Application',
        'displayErrorDetails' => true,
        'logErrorDetails' => true,
        'logErrors' => true,
        ];
    });
};