<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        if(!empty(Auth::user())){


            if(url()->current() == route('loginPage')){
                return back();
            }

        }

        return $next($request);
    }
}
