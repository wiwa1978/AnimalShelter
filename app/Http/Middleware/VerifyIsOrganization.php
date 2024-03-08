<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsOrganization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(Auth::user() && Auth::user()->isOrganization());
        if (Auth::user()) {
            //dd('stap 1');
            if (Auth::user()->isOrganization()) {
                //dd('stap 2');
                return $next($request);
            } else {
                //dd('stap 3');
                return
                    redirect('/app');
            }
        } else {
            //dd('stap 4');
            return
                $next($request);
        }


        //abort(403, 'Unauthorized action.');
    }
}
