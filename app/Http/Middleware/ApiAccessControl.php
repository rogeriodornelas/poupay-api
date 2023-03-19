<?php

namespace App\Http\Middleware;

use App\Services\JwtService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class ApiAccessControl
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $jwtService = new JwtService();
            if (!$request->bearerToken()) {
                throw new Exception('Acesso não autorizado!', 401);
            }

            $payload = $jwtService->validateToken($request->bearerToken());
            $request->merge([
                "payload" => (array)$payload
            ]);

            return $next($request);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
