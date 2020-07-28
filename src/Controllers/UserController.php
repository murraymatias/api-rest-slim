<?php

declare(strict_types=1);

namespace App\Controllers;

Use App\Utils\Auth;
use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class UserController 
{
    public function getAll(Request $request, Response $response, $args)
    {
        $data = User::all();
        $status = $data ? 'success':'fail';
        $rta = array('status'=> $status, 'data'=> $data);
        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    public function getOne(Request $request, Response $response, $args)
    {
        $id = $request->getHeader('id');
        $data = User::find($id);
        $status = $data ? 'success':'fail';
        $rta = array('status'=> $status, 'data'=> $data);
        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    public function create(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();

        $user = User::where('email', '=', $params['email'])->get();


        if(isset($params['usuario']) && isset($params['email']) && isset($params['tipo']) && isset($params['clave']) && count($user) == 0){
            $model = new User;
            $model->usuario = $params['usuario'];
            $model->email = $params['email'];
            $model->tipo = $params['tipo'];
            $model->clave = password_hash($params['clave'], PASSWORD_DEFAULT);

            $data= $model->save();

            $status = $data ? 'success':'fail';
        }elseif(count($user)>0)
        {
            $data = 'Repeated user';    
            $status = 'fail';
        }
        else{
            $data ='Missing info';    
            $status = 'fail';
        }

        $rta = array('status'=> $status, 'data'=> $data);
        $response->getBody()->write(json_encode($rta));
        return $response;
    }
    public function update(Request $request, Response $response, $args)
    {

    }
    public function delete(Request $request, Response $response, $args)
    {

    }
    public function login(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();

        $users = User::where('email', '=', $params['email'])->get();
        $user = $users[0];

        if(isset($params['clave']) && count($users)>0 && password_verify($params['clave'],$user->clave)){

            $status = 'success';
            $data = Auth::createJWT(array('id'=>$user->id));

        }
        else{

            $data ='Wrong info';    
            $status = 'fail';
        }

        // $status = "ok";
        // $data = var_dump($user);

        $rta = array('status'=> $status, 'data'=> $data);
        $response->getBody()->write(json_encode($rta));
        return $response;
    }

    public function getLevel($id)
    {
        $user = User::find($id);

        return $user->tipo;
    }
}