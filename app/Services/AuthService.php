<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use StdClass;

class AuthService
{
    public function __construct()
    {
        $this->jwtService = new JwtService();
    }

    public function login($payload)
    {
        $user = (new User())->where('email', $payload['email'])->first();

        if (!$user) {
            throw new Exception('Usuário não encontrado.');
        }

        if (!Hash::check($payload['password'], $user->password)) {
            throw new Exception('Senha incorreta.');
        }

        return $this->getToken($user->id);
    }

    public function getUser($token)
    {
        $data = $this->jwtService->validateToken($token);
        return (new User())->where('id', $data->user_id)->first();
    }

    public function getToken($user_id)
    {
        $payload = new StdClass();
        $payload->user_id = $user_id;
        return $this->jwtService->createToken($payload);
    }
}
