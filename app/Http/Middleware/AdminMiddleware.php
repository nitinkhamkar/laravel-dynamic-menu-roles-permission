<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $currentAction = \Route::currentRouteAction();
        list($controller, $method) = explode('@', $currentAction);
        //dd($method);
        if (Auth::user()->hasRole('super-admin')) 
        {
            return $next($request);
        }
        if($method=='create' and (Auth::user()->hasPermissionTo('add')))
          return $next($request);
        else if($method=='edit' and (Auth::user()->hasPermissionTo('edit')))
          return $next($request);
        else if($method=='destroy' and (Auth::user()->hasPermissionTo('delete')))
          return $next($request);
        else if($method=='index' and (Auth::user()->hasPermissionTo('view')))
          return $next($request);
        else 
          abort('401');
                 

    }
}
