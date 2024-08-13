<?php

namespace App\Http\Middleware;

use App\Models\Consult;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckReceptionistOrDoctorRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->type_user === User::TYPE_USER_RECEPTIONIST || Auth::user()->type_user === User::TYPE_USER_DOCTOR) {
                return $next($request);
            }
        }else {
            return response()->json(['error' => 'Por favor, faça login para continuar.']);
        }
        return response()->json(['error' => 'Você não tem permissão para filtrar as consultas.'], 403);
    }
}
