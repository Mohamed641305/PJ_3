<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin {
    public function handle( Request $request, Closure $next ): Response {
        if ( !Auth::check() ) {
            return redirect()->route( 'login' )
            ->with( 'error', 'Please login first' );
        }

        if ( Auth::user()->role !== 'admin' ) {
            return redirect()->route( 'welcome' )
            ->with( 'error', 'Access denied. Admins only.' );
        }

        return $next( $request );
    }
}
