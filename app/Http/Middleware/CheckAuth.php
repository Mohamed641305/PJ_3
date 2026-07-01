<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth {
    public function handle( Request $request, Closure $next ): Response {
        // غير مسجل دخول
        if ( !Auth::check() ) {
            return redirect()
            ->route( 'login' )
            ->with( 'error', 'You must login first to access this page.' );
        }

        // Admin
        if ( Auth::user()->role === 'admin' ) {
            return $next( $request );
        }

        // User عادي
        return redirect()
        ->route( 'home' )
        ->with( 'error', 'Access denied. You do not have permission to access this page.' );
    }
}