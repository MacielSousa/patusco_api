<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckReceptionistRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->type_user !== User::TYPE_USER_RECEPTIONIST) {
                return response()->json(['error' => 'Você não tem permissão para realizar essa ação.'], 403);
            }
        } else {
            return response()->json(['error' => 'Por favor, faça login para continuar.']);
        }

        return $next($request);
    }
}
