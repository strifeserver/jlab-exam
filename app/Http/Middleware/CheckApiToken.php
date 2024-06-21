<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }
        $personalAccessToken = PersonalAccessToken::findToken($token);
        if (!$personalAccessToken || $personalAccessToken->tokenable_type !== 'Modules\System\Entities\Account' || $personalAccessToken->tokenable_type !== 'Modules\System\Entities\Customer') {
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }

        $request->user = $personalAccessToken->tokenable;

        return $next($request);
    }
}
