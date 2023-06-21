<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Product;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

use Illuminate\Support\Collection;





class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.products.index')->only('index');
        $this->middleware('can:admin.products.edit')->only('edit', 'update');
        $this->middleware('can:admin.products.create')->only('create', 'store');
        $this->middleware('can:admin.products.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $query = Product::query();
        $searchResults = true;

        if (auth()->user()->hasRole('Admin')) {
            if ($request->filled('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('nombre_producto', 'like', "%$search%")
                        ->orWhere('descripcion_producto', 'like', "%$search%")
                        ->orWhereHas('company', function ($q) use ($search) {
                            $q->where('nombre_empresa', 'like', "%$search%");
                        });
                });
            }

            $products = $query->paginate(5);

            if ($request->filled('search') && $products->isEmpty()) {
                $searchResults = false;
            }
        } elseif (auth()->user()->hasRole('Empresa')) {
            $companies = auth()->user()->companys()->pluck('id');
            $products = Product::whereIn('company_id', $companies)->paginate(5);
        }

        return view('admin.products.index', compact('products', 'searchResults'));
    }



    public function create()
    {
        $companies = Company::all();
        $states = State::all();
        return view('admin.products.create',compact('companies', 'states'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'imagen_producto' => 'required|image|mimes:jpeg,png,svg,gif',
            'nombre_producto' => 'required',
            'descripcion_producto' => 'required',
            'precio_producto' => 'required',
            'company_id' => 'required',
            'state_id' => 'required'
        ]);

        $products = $request->all();
        if($imagen_producto = $request->file('imagen_producto')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen_producto->getClientOriginalExtension();
            $imagen_producto->move($rutaGuardarImg, $imagenProducto);
            $products['imagen_producto'] = "$imagenProducto";
        }
        Product::create($products);
        return redirect()->route('admin.products.index')->with('success', 'El Producto se ha creado correctamente.');
    }

    public function show(Product $product)
    {
        Product::all();
        return view('admin.products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        Product::all();
        $companies = Company::all();
        $states = State::all();
        return view('admin.products.edit', compact('product', 'companies', 'states'));
    }

    public function update(Request $request, Product $product)
    {
        $prod = $request->all();
        if($imagen_producto = $request->file('imagen_producto')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen_producto->getClientOriginalExtension();
            $imagen_producto->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen_producto'] = "$imagenProducto";
        }else{
            unset($prod['imagen_producto']);
        }
        $product->update($prod);
        return redirect()->route('admin.products.index')->with('edit', 'El Producto se ha editado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('error', 'El Producto se ha eliminado correctamente.');
    }

    public function showImportForm()
    {
        return view('admin.products.import');
    }

    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        Excel::import(new ProductImport, $file);

        return redirect()->back()->with('success', 'Cargue masivo completado');
    }
}
