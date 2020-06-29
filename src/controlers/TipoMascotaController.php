<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\TipoMascota;
use App\Utils\Auth;
use Exception;

class TipoMascotaController 
{
    public function add(Request $request, Response $response, $args) : Response
    {
        $data = $request->getParsedBody();

        $tipos = TipoMascota::where('tipo',$data['tipo'])->get();
        
        if(empty($tipos[0])){
            if(isset($data['tipo']))
            {
                try
                {
                    $tipo = new TipoMascota();
                    
                    $tipo->tipo = $data['tipo'];

                    $tipo->save();

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
}