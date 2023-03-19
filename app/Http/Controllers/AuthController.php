<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    private AuthService $service;

    public function __construct()
    {
        $this->service = new AuthService();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->service->login($request->all());
            return response()->json($token);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function redirectProvider($provider): JsonResponse
    {
        try {
            $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
            return response()->json(['url' => $url]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

    }

    public function handleProviderCallback($provider): JsonResponse
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
            $token = $this->service->loginFromProvider($provider, $providerUser);
            return response()->json($token);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function getUser(Request $request): JsonResponse
    {
        try {
            $user = $this->service->getUser($request->bearerToken());
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

}
