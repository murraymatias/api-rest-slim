<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Utils\Auth;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class ValidTokenMiddleware
{
    /**
     * 
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $token = $request->hasHeader('token') ? $request->getHeaderLine('token') : '';

        if(!Auth::validToken($token)){
            throw new \Slim\Exception\HttpUnauthorizedException($request,'Invalid token');
        }
        else{            
            return $handler->handle($request);
        }
    } 
}