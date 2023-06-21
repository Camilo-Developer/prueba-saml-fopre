<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PreOrder;
use App\Models\Product;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PreOrdersController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.preorders.index')->only('index');
        $this->middleware('can:admin.preorders.edit')->only('edit', 'update');
        $this->middleware('can:admin.preorders.create')->only('create', 'store');
        $this->middleware('can:admin.preorders.destroy')->only('destroy');
    }
    public function index()
    {
        $nombreEstado = 3;
        if (auth()->user()->hasRole('Admin')) {
            $preorders = PreOrder::whereHas('state', function ($query) use ($nombreEstado) {
                $query->where('type_state_id', $nombreEstado);
            })->paginate(5);

            return view('admin.preorders.index', compact('preorders'));
        } elseif (auth()->user()->hasRole('Empresa')) {
            $companies = auth()->user()->companys()->pluck('id');
            $preorders = PreOrder::whereHas('state', function ($query) use ($nombreEstado) {
                $query->where('type_state_id', $nombreEstado);
            })
            ->whereIn('company_id', $companies)
            ->paginate(5);

            return view('admin.preorders.index', compact('preorders'));
        }
    }


    public function create()
    {
        if (auth()->user()->hasRole('Admin')) {
            $products = Product::all();
        } elseif (auth()->user()->hasRole('Empresa')) {
            $companies = auth()->user()->companys()->pluck('id');
            $products = Product::whereIn('company_id', $companies)->paginate(5);
        }
        $preorders = PreOrder::all();
        $users = User::all();
        $states = State::all();
        $companies = Company::all();

        return view('admin.preorders.create', compact('preorders', 'users', 'states', 'products', 'companies'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasRole('Admin')){
        $preorder = PreOrder::create([
            'fecha' => Carbon::now(),
            'dependence' => $request->dependence,
            'cost_center' => $request->cost_center,
            'name_cost_center' => $request->name_cost_center,
            'extension' => $request->extension,
            'name_auth' => "Peywba",
            'fecha_claim' => $request->fecha_claim,
            'observations' => $request->observations,
            'total' => $request->total_value, // Guarda el subtotal como total en la tabla de PreOrder
            'company_id' => (int) implode('',$request->company_id),
            'usuario_id' => (int) implode('',$request->usuario_id),
            'estado_id' => 3,
        ]);
        } elseif (auth()->user()->hasRole('Empresa')){
            $preorder = PreOrder::create([
                'fecha' => Carbon::now(),
                'dependence' => $request->dependence,
                'cost_center' => $request->cost_center,
                'name_cost_center' => $request->name_cost_center,
                'extension' => $request->extension,
                'name_auth' => "Peywba",
                'fecha_claim' => $request->fecha_claim,
                'observations' => $request->observations,
                'total' => $request->total_value, // Guarda el subtotal como total en la tabla de PreOrder
                'company_id' => $request->company_id,
                'usuario_id' => (int) implode('',$request->usuario_id),
                'estado_id' => 3,
            ]);
        }



        foreach ($request->products as $id => $details) {
            $product = Product::find($details['id']);

            $cantidad = intval($details['cantidad']);
            $precio =  intval($details['precio']);
            $resultado = $cantidad * $precio;
            $preorder->products()->attach($product, [
                'quantity' => $cantidad,
                'subtotal' => $resultado,
            ]);
        }

        return redirect()->route('admin.preorders.index')->with('success', 'El pedido anticipado se ha creado correctamente.');
    }


    public function show(PreOrder $preorder)
    {
        return view('admin.preorders.show',compact('preorder'));
    }

    public function edit(PreOrder $preorder)
    {
        if (auth()->user()->hasRole('Admin')) {
            $products = Product::all();
            $companies = Company::all();
            $states = State::all();
        } elseif (auth()->user()->hasRole('Empresa')) {
            $companies = auth()->user()->companys()->pluck('id');
            $products = Product::whereIn('company_id', $companies)->paginate(5);
            $states = State::all();

        }
        $users = User::all();

        return view('admin.preorders.edit',compact('preorder', 'products', 'users', 'companies', 'states'));
    }

    public function update(Request $request, PreOrder $preorder)
    {

        $preorder->update($request->all());

        if (is_array($request->products)) {
            foreach ($request->products as $id => $details) {

                $product = Product::find($details['id']);

                $cantidad = floatval($details['cantidad']);

                $precio = floatval(preg_replace('/[^\d.]/', '', $details['precio']));
                $precio = intval(str_replace( ['.'],'',$precio));
                $resultado = $cantidad * $precio;

                $preorder->products()->attach($product, [
                    'quantity' => $cantidad,
                    'subtotal' => $resultado,
                ]);
            }
        }


        return redirect()->route('admin.preorders.index')->with('edit', 'El pedido anticipado se ha editado correctamente');
    }

    public function destroy(PreOrder $preorder)
    {
        $preorder->delete();
        return redirect()->route('admin.preorders.index')->with('success','El pedido anticipado se ha eliminado con éxito');
    }
    public function entregados()
    {

        $nombreEstado = 1;
        if (auth()->user()->hasRole('Admin')) {
            $preorders = PreOrder::whereHas('state', function ($query) use ($nombreEstado) {
                $query->where('type_state_id', $nombreEstado);
            })->paginate(5);

            return view('admin.preorders.entregados', compact('preorders'));
        } elseif (auth()->user()->hasRole('Empresa')) {
            $companies = auth()->user()->companys()->pluck('id');
            $preorders = PreOrder::whereHas('state', function ($query) use ($nombreEstado) {
                $query->where('type_state_id', $nombreEstado);
            })
            ->whereIn('company_id', $companies)
            ->paginate(5);

            return view('admin.preorders.entregados', compact('preorders'));
        }
    }

    public function getUsers(Request $request)
    {
        $usuarios = User::where('name', 'LIKE', '%' . $request->usuario_id . '%')
            ->orWhere('lastname', 'LIKE', '%' . $request->usuario_id . '%')
            ->get();

        return response()->json($usuarios);
    }

    public function getCompanies(Request $request)
    {
        $empresa = Company::where('nombre_empresa', 'LIKE', '%' . $request->company_id . '%')
            ->get();

        return response()->json($empresa);
    }



}
