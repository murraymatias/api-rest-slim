<?php

namespace App\Utils;

use Exception;
use \Firebase\JWT\JWT;

class Auth
{
    private static $key = 'pro3-parcial';

    public static function createJWT(array $array)
    {
        $payload = array(
            "iss" => "localhost",
            "iat" => time(),
            "nbf" => time() + 1,
            "exp" => time() + 36000 //10 horas
        );
        foreach($array as $key => $value){
            $payload[$key]=$value;
        }

        return JWT::encode($payload, Auth::$key, array('HS256'));
    }

    public static function validToken($token) : boolval
    {
        try
        {
            JWT::decode($token, Auth::$key, array('HS256'));
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public static function getPayload($token)
    {
        return (array) JWT::decode($token, Auth::$key, array('HS256'));
    }
}