<?php

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
        $token = $request->hasHeader('token') ? $request->getHeader('token') : null;

        if(!Auth::validToken($token)){
            $response = new Response();
            throw new \Slim\Exception\HttpForbiddenException($request);
            return $response->withStatus(403);
        }
        else
        {
            $payload = Auth::getPayload($token);
            $response = $handler->handle($request);
            $existingContent = (string)$response->getBody();
            $resp = new Response();
            $resp = $resp->withHeader();
            $resp->getBody()->write($existingContent);
            return $resp;
        }
    } 
}