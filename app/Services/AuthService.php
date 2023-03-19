<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use StdClass;

class AuthService
{
    public function __construct()
    {
        $this->jwtService = new JwtService();
    }

    public function create($payload)
    {
        //todo

        # vincular o primeiro grupo
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
        $payload->group_id = (new GroupService())->list()->first()->id;
        return $this->jwtService->createToken($payload);
    }

    public function loginFromProvider($provider, $payload)
    {
        return DB::transaction(function () use ($provider, $payload) {
            $user = (new User())->updateOrCreate(
                ['provider_id' => $payload->getId()],
                [
                    'name' => $payload->getName(),
                    'email' => $payload->getEmail(),
                    'provider_name' => $provider,
                    'provider_id' => $payload->getId(),
                ]
            );

            if ($user->has("groups")->get()->count() == 0) {
                $group = (new GroupService())->create(['name' => "Minhas Contas"]);
                $user->groups()->attach($group->id);
            }

            return $this->getToken($user->id);
        });
    }
}
