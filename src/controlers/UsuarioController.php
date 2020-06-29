<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Usuario;
use App\Utils\Auth;
use Exception;

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
        $data = $request->getParsedBody();

        $user = Usuario::where('email',$data['email'])->get();
        
        if(empty($user[0])){
            if(isset($data['usuario']) && isset($data['email']) && isset($data['clave']) && isset($data['tipo']))
            {
                try
                {
                    $user = new Usuario();
                    
                    $user->usuario = $data['usuario'];
                    $user->email = $data['email'];
                    $user->clave = password_hash($data['clave'], PASSWORD_DEFAULT);
                    $user->tipo = $data['tipo'];

                    $user->save();

                    $response->getBody()->write("OK");
                }
                catch(Exception $e)
                {
                    $response->getBody()->write($e->getMessage());
                }
                finally
                {
                    return $response;
                }            
            }
        }
        else
        {
            $response->getBody()->write("Datos duplicados");    
            return $response;
        }
    }

    public function update(Request $request, Response $response, $args) : Response
    {
        return $response;
    }

    public function delete(Request $request, Response $response, $args) : Response
    {
        return $response;
    }

    public function login(Request $request, Response $response, $args) : Response
    {
        $body = $request->getParsedBody();

        $users = Usuario::where('email',$body['email'])->get();

        if(!empty($users))
        {
            $user = $users[0];
            if(password_verify($body['clave'],$user->clave))
            {
                $arr = array(
                    'id' => $user['id'],
                    'usuario' => $user['usuario'],
                    'email' => $user['email'],
                    'tipo' => $user['tipo']
                );            
    
                $token = Auth::createJWT(Auth::generarPayload($arr));
    
                $response->getBody()->write(json_encode($token));
                return $response;
            }
        }

        $response->getBody()->write("Datos Invalidos");
        return $response;
     
    }
};