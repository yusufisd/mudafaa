<?php

namespace App\Http\Middleware;

use App\Models\UserModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PerControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $per): Response
    {
        if (Auth::guard('user_model')->check()) {
            $auth = Auth::guard('user_model')->user();
            $user = UserModel::where('email', $auth->email)->first();
            if (in_array($per, $user->Role->permissions)) {
                return $next($request);
            } else {
                abort(401, 'YETKİNİZ BULUNMAMAKTADIR');
            }
        }else{
            return $next($request);
        }
    }
}
