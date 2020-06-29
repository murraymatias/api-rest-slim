<?php

namespace App\Middlewares;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Auth;

class AdministradorMiddleware {
     /**
     * Middleware for JSON Web token validation
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
            $token = (string) $request->getHeader('token')[0];

            $decoded = Auth::checkJWT($token);//check JWT
            
            if($decoded->tipo == 1)
            {
                $response = $handler->handle($request);
                $existingContent = (string) $response->getBody();
                $response = new Response();
                $response->getBody()->write($existingContent);
            }

        return $response;
    }
}