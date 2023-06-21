<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function dashboard(){
        if (auth()->user()->hasRole('Admin')){
            return redirect()->route('admin.dashboard');
        }elseif (auth()->user()->hasRole('Empresa')){
            $companies = auth()->user()->companys; // Obtener la colección de empresas asociadas al usuario

            if ($companies->isEmpty()) {
                return view('error.error_dashboard'); // Si no tiene ninguna empresa asociada, redirigir a la vista de error
            } else {
                foreach ($companies as $company) {
                    $estado = $company->state; // Obtener el objeto de estado asociado a la empresa
                    if ($estado && $estado->type_state_id == 3) {
                        return redirect()->route('admin.requeridos', ['company' => $company]); // Si algún estado tiene type_state_id 3, redirigir a la vista Requeridos
                    } elseif ($estado && $estado->type_state_id == 1) {
                        return redirect()->route('admin.dashboard'); // Si algún estado tiene type_state_id 1, redirigir a admin.dashboard
                    }
                }
                return view('error.error_dashboard'); // Si ningún estado tiene type_state_id 1 ni 3, redirigir a la vista de error
            }
        }elseif (auth()->user()->hasRole('Usuario')){
            return redirect('/');
        }else{
            Auth::logout();
            return redirect()->route('login');
        }
    }
    public function requeridos_companies(Company $company){

        return view('users.fopre.validate-companie', compact('company'));
    }
}
