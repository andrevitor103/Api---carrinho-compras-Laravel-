<?php

    namespace App\Http\Middleware;

  
    use Closure;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Exception;
    use Illuminate\Http\Request;

    /**
     * Essa classe e a mesma JwtMiddleware porém
     * usando um switch case no lugar do if
     */
class JwtMiddleware2
    {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
        public function handle(Request $request, Closure $next )
        {   
            try 
            {  
                $user = JWTAuth::parseToken()->authenticate();
            }
            catch(Exception $e)
            {
                switch($e){
                    case $e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException :
                        return response()->json(['message' => 'Token inválido']);
                        break;
                    case $e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException :
                        return response()->json(['message' => 'Token expirado']);
                        break;
                    default:
                        return response()->json(['message' => 'Token de autorização não encontrado']);
                }
            }
            return $next($request);
        }
    }