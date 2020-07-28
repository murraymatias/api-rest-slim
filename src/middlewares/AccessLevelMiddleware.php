<?php

declare(strict_types=1);

namespace App\Middleware;


use App\Utils\Auth;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AccessLevelMiddleware
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
        $payload = Auth::getPayload($token);
        $user = User::find($payload['data']->id);

        if($user->tipo != 3)
        {
            throw new \Slim\Exception\HttpUnauthorizedException($request,'Insufficient privilege');
        }
        else
        {            
            return $handler->handle($request);
        }
    } 
}