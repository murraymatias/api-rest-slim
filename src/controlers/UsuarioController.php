<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Usuario;

class UsuarioController 
{
    /**
     * @brief Devuelve listado de usuarios
     */
    public function getAll(Request $request, Response $response, $args) : Response
    {
        $response->getBody()->write("Its working");

        return $response;
    }
};