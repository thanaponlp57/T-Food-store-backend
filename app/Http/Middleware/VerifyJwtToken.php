<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTProvider;

class VerifyJwtToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('authorization');

        if (!$token) {
            return response()->json(['msg' => 'Token not found']);
        }

        try {
            $credentials = JWTProvider::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch (Exception $e) {
            return response()->json(['msg' => 'Token Invalid']);
        }

        if ($credentials['iss'] !== env('APP_NAME')) {
            return response()->json(['msg' => 'Token does not belong to this app']);
        }

        if ($credentials['exp'] < time()) {
            return response()->json(['msg' => 'Token expired']);
        }

        return $next($request);
    }
}
