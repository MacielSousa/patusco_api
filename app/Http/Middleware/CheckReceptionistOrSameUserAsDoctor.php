<?php

namespace App\Http\Middleware;

use App\Models\Consult;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class CheckReceptionistOrSameUserAsDoctor
{
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) 
        {
            $userId = Auth::id();
            $consulta = Consult::find($request->id);
            
            if ($consulta && ($userId == $consulta->doctor_id || Auth::user()->type_user == 'receptionist'))
            {
                return $next($request);
            }
        }
        else {
            return response()->json(['error' => 'Por favor, faça login para continuar.']);
        }
        return response()->json(['error' => 'Você não tem permissão para editar esta consulta.'], 403);
    }
}
