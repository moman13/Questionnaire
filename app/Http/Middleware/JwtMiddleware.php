<?php

namespace App\Http\Middleware;


use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['code'=>401,'status' =>false , 'message' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['code'=>401,'status' =>false ,'message' => 'Token is Expired']);
            }else{
                return response()->json(['code'=>401,'status' =>false ,'message'=>'Authorization Token not found']);
            }
        }
//        if(auth('api')->check()){
//            if(auth('api')->user()->status == 0){
//                return response()->json(['code'=>401,'status'=>false,
//                    'message'=>'User Not Active Yet ',
//                ]);
//            }
//            if(auth('api')->user()->is_active == 0){
//                return response()->json(['code'=>401,'status'=>false,
//                    'message'=>'Admin stop your account',
//                ]);
//            }
//
//        }


        return $next($request);
    }
}
