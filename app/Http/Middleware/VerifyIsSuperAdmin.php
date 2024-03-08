<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd(Auth::user()->isSuperAdmin());
        if (Auth::user()) {
            if (!Auth::user()->isOrganization()) {
                if (Auth::user()->isSuperAdmin()) {
                    return $next($request);
                } else {
                    return redirect('/app');
                }
            }

            if (Auth::user()->isOrganization()) {
                if (Auth::user()->isSuperAdmin()) {
                    //dd('step1');
                    return $next($request);
                } else {
                    //dd('step2');
                    return redirect('/app-org');
                }
            }

            if (Auth::user()->isSuperAdmin()) {
                return $next($request);
            }
        } else {
            abort(403, 'We thought of this! Unauthorized action');
        }



        // if (Auth::user() && Auth::user()->isSuperAdmin()) {
        //     dd("Super admin");
        //     return
        //         $next($request);
        // }

        // if (Auth::user() && !Auth::user()->isOrganization()) {
        //     dd("Individual");
        //     return redirect('/app');
        // }

        // if (Auth::user() && Auth::user()->isOrganization()) {
        //     dd("Organization");
        //     return redirect('/app-org');
        // }

        abort(403, 'Unauthorized action, need to be admin.');
    }
}
