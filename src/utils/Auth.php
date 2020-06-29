<?php

namespace App\Utils;

use Exception;
use \Firebase\JWT\JWT;

class Auth
{

    private static $key = 'pro3-parcial';

    public static function createJWT($payload)
    {
        return JWT::encode($payload, Auth::$key);
    }

    public static function generarPayload($array)
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

        return $payload;
    }

    public static function checkJWT($jwt)
    {
        try {
            return JWT::decode($jwt, Auth::$key, array('HS256'));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public static function validJWT($jwt)
    {
        try {
            JWT::decode($jwt, Auth::$key, array('HS256'));
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}