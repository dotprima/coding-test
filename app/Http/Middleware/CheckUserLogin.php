<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $token = $request->header('Token');
        if(isset($token)){
            $login = Login::where('token', $token)->first();
            if($login){
                $request['user_id'] = $login['id_user'];
                $request['token'] = $login['token'];
                return $next($request);
            }else{
                return response("Token Unauthorized",401);
            }
 
        }else{
            return response("Unauthorized",401);
        }
        
    }
}
