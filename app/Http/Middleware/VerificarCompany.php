<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->hasRole('Empresa')){
            $companies = auth()->user()->companys;
            if ($companies->isEmpty()){
                return response()->view('error.error_dashboard', [], 500); // Si no tiene ninguna empresa asociada, redirigir a la vista de error
            }else{
                foreach ($companies as $company) {
                    $estado = $company->state; // Obtener el objeto de estado asociado a la empresa
                    if ($estado && $estado->type_state_id == 3) {
                        return redirect()->route('admin.requeridos', ['company' => $company]); // Si algún estado tiene type_state_id 3, redirigir a la vista Requeridos
                    }
                }
                //return response()->view('error.error_dashboard', [], 500);
            }
        }

        return $next($request);
    }
}
