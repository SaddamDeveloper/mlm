<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, $guard=null)
    {
        if (! $request->expectsJson()) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                   case 'admin':
                       $route = 'admin/dashboard';
                       break;
                   case 'member':
                       $route = 'member/dashboard';
                       break;
                  default:
                       $route = 'web.userLoginForm';
               }
               return redirect($route);
           }
        }
    }
}
