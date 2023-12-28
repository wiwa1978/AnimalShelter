<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsIndividual
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (Auth::user()) {
            // /dd('step 1');
            if (!Auth::user()->isOrganization()) {
                //dd('step 2');
                return $next($request);
            } else {
                //dd('step 3');
                return redirect('/app-org');
            }
        } else {
            //dd('step 4');
            return $next($request);
        }
    }
}
