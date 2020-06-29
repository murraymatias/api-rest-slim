<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Usuario;
use App\Utils\Auth;

class UsuarioController 
{
    /**
     * @brief Devuelve listado de usuarios
     */
    public function getAll(Request $request, Response $response, $args) : Response
    {
        $response->getBody()->write(json_encode(Usuario::all()));

        return $response;
    }

    public function getOne(Request $request, Response $response, $args) : Response
    {
        $response->getBody()->write(json_encode(Usuario::where('id',$args['id'])->get()));

        return $response;
    }

    public function add(Request $request, Response $response, $args) : Response
    {

    }

    public function update(Request $request, Response $response, $args) : Response
    {

    }

    public function delete(Resquest $request, Response $response, $args) : Response
    {

    }

    public function login(Request $request, Response $response, $args) : Response
    {
        $body = $request->getParsedBody();

        $user = Usuario::where('email',$body['email'])->where('password',$body['password'])->get();

        if(!empty($user))
        {
            
        }

        $response->getBody()->write(json_encode($user));
        return $response;
    }
};