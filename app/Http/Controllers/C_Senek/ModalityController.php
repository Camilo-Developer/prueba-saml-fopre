<?php

namespace App\Http\Controllers\C_Senek;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Modality;
use App\Models\State;
use Illuminate\Http\Request;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modalities = Modality::paginate(5);
        return view('c-senek.modalities.index', compact('modalities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State:: all();
        $categories = Category:: all();
        return view('c-senek.modalities.create', compact('states','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'imagen_producto' => 'required|image|mimes:jpeg,png,svg|max:1024', 'nombre_producto' => 'required', 'descripcion_producto' => 'required', 'precio_producto' => 'required', 'company_id' => 'required'
        ]);
        $products = $request->all();
        if($imagen_producto = $request->file('imagen_producto')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen_producto->getClientOriginalExtension();
            $imagen_producto->move($rutaGuardarImg, $imagenProducto);
            $products['imagen_producto'] = "$imagenProducto";
        }
        Product::create($products);
        return redirect()->route('c-senek.modalities.index')->with('success', 'El Producto se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $state = State::find($id);
        return view('admin.states.show',compact( 'state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $states = State::find($id);
        return view('admin.states.edit', compact('states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $states = State::find($id)->update($request->all());
        return redirect()->route('states.index')->with('edit', 'El Estado se ha editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            State::find($id)->delete();
            return redirect()->back()->with('success', 'Se elimino el estado con éxito');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'No se puede eliminar este post debido a una restricción de integridad referencial.');
        }

    }
}
