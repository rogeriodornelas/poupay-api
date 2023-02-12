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

            $jwtService->validateToken($request->bearerToken());

            return $next($request);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
