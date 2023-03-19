<?php

namespace App\Services;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    private $key;

    public function __construct()
    {
        $this->key = sha1('poupay@token');
    }

    public function createToken(Object $payload, $expiration = 1296000)
    {
        $payload->exp = time() + $expiration;
        $tokenJWT = JWT::encode((array)$payload, $this->key, 'HS256');
        $tokenURL = JWT::urlsafeB64Encode($tokenJWT);
        return [
            'access_token' => $tokenURL
        ];
    }

    public function validateToken($token)
    {
        if (is_null($token)) {
            throw new Exception('Token bearer é obrigatório', 401);
        }
        $tokenDecode = JWT::urlsafeB64Decode($token);
        $playload = JWT::decode($tokenDecode, new Key($this->key, 'HS256'));
        return $playload;
    }
}
