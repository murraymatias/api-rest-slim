<?php

declare(strict_types=1);

namespace App\Utils;

use Exception;
use \Firebase\JWT\JWT;

class Auth
{
    private static $key = 'pro3-parcial';

    public static function createJWT(array $data)
    {
        $payload = array(
            "iss" => "localhost",
            "iat" => time(),
            "nbf" => time() + 1,
            "exp" => time() + 36000, //10 horas,
            "data" => $data
        );

        return JWT::encode($payload, Auth::$key);
    }

    public static function validToken(string $token)
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

    public static function getPayload(string $token)
    {
        return (array) JWT::decode($token, Auth::$key, array('HS256'));
    }
}