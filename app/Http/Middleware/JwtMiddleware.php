<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
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
        try 
        {
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e) 
        {   
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                 return response()->json(['message' => 'Token inválido']);
            }
            elseif($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return response()->json(['message' => 'Token expirado']);
            }else{
                 return response()->json(['message' => 'Token de autorização não encontrado']);
            }

        }
        
        return $next($request);
    }
}
