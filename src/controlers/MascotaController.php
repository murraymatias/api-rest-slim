<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Mascota;

class MascotaController 
{
    public function getAll(Request $request, Response $response, $args)
    {
        
    }

    public function getOne(Request $request, Response $response, $args){}

    public function add(Request $request, Response $response, $args){}
    
    public function update(Request $request, Response $response, $args){}
    
    public function delete(Request $request, Response $response, $args){}
}