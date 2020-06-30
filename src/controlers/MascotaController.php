<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Mascota;
use Exception;

class MascotaController
{
    public function add(Request $request, Response $response, $args) : Response
    {
        $data = $request->getParsedBody();

        $tipos = Mascota::where('nombre',$data['nombre'])->where('cliente_id',$data['cliente_id'])->get();
        
        if(empty($tipos[0])){
            if(isset($data['nombre'])&&isset($data['fecha_nacimiento'])&&isset($data['cliente_id'])&&isset($data['tipo_mascota_id']))
            {
                try
                {
                    $tipo = new Mascota();
                    
                    $tipo->nombre = $data['nombre'];
                    $tipo->fecha_nacimiento = $data['fecha_nacimiento'];
                    $tipo->cliente_id = $data['cliente_id'];
                    $tipo->tipo_mascota_id = $data['tipo_mascota_id'];

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