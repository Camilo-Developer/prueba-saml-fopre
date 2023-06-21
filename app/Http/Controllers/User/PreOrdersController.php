<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PreOrder;
use Illuminate\Support\Facades\Session;

class PreOrdersController extends Controller
{
    public function index(){
        $preorders = PreOrder::all();
        return view('users.fopre.pendientes',compact('preorders'));
    }
    public function checkCartuser(PreOrder $preorder,$id){
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Buscar la preorden asociada al usuario actual
        $preorder = PreOrder::where('id', $id)
            ->where('usuario_id', $user->id)
            ->first();

        // Verificar si se encontró la preorden
        if ($preorder) {
            // Mostrar la vista solo con la preorden del usuario actual
            return view('users.fopre.checks-pays', compact('preorder'));
        } else {
            // Preorden no encontrada para el usuario actual, mostrar un error o redirigir
            return abort(403);
        }
    }

    public function checkCart(Request $request)
    {


        $preorders = PreOrder::create([
            'fecha' => $request->fecha,
            'dependence' => $request->dependence,
            'cost_center' => $request->cost_center,
            'name_auth' => $request->name_auth,
            'name_cost_center' => $request->name_cost_center,
            'extension' => $request->extension,
            'fecha_claim' => $request->fecha_claim,
            'observations' => $request->observations,
            'total' => $request->total,
            'company_id' => $request->company_id,
            'usuario_id' => auth()->user()->id,
            'estado_id' => 3,
        ]);


        // Asociar los productos a la PreOrder en la tabla de detalle
        //dd(session('cart'));
        foreach (session('cart') as $id => $details) {
            $product = Product::find($id);
            $preorders->products()->attach($product, [
                'quantity' => $details['quantity'],
                'subtotal' => $details['precio_producto'] * $details['quantity'],
            ]);
        }
        Session::forget('cart');
        return redirect()->route('users.checkpays', $preorders->id)->with('success', 'El pedido anticipado Se ha creado correctamente.');
    }
}
