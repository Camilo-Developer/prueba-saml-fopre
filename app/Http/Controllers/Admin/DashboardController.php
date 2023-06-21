<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\User;
use App\Models\Product;
use App\Models\Pay;
use App\Models\SaleReport;
use App\Models\Company;
use Spatie\Permission\Models\Role;



class DashboardController extends Controller
{

    public function index(){
        if (auth()->user()->hasRole('Admin')){
            $total_states = State::count();
            $total_users = User::count();
            $total_products = Product::count();
            $total_pays = Pay::count();
            $total_salereports = SaleReport::count();
            $total_companies = Company::count();
            $total_roles = Role::count();
            $total_preorders = PreOrder::count();
            return view('admin.dashboard.index', compact('total_users', 'total_states', 'total_products',  'total_pays', 'total_salereports', 'total_companies', 'total_roles', 'total_preorders'));

        }elseif (auth()->user()->hasRole('Empresa')){
            $companies = auth()->user()->companys()->pluck('id');
            $total_preorders = PreOrder::whereIn('company_id', $companies)->count();


            $companies = auth()->user()->companys()->pluck('id');
            $total_products = Product::whereIn('company_id', $companies)->count();

            $total_pays = Pay::count();
            $total_salereports = SaleReport::count();
            return view('admin.dashboard.index', compact( 'total_products',  'total_pays', 'total_salereports','total_preorders'));
        }
    }
    public function requeridos_companies(){
        return view('admin.companies.document_required');
    }
}
