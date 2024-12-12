<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customers')->check()) {
            return redirect()->route('login.index');
        }
        return $next($request);
    }
}
