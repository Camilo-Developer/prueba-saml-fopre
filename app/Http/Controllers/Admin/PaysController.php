<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;

class PaysController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.pays.index')->only('index');
        $this->middleware('can:admin.pays.edit')->only('edit', 'update');
        $this->middleware('can:admin.pays.create')->only('create', 'store');
        $this->middleware('can:admin.pays.destroy')->only('destroy');
    }

    public function index()
    {
        $pays = Pay::paginate(5);
        return view('admin.pays.index', compact('pays'));
    }

    public function create()
    {
        $pays = Pay::all();
        return view('admin.pays.create', compact('pays'));
    }

    public function store(Request $request)
    {
        $pays = Pay::create([
            'metodo_pago' =>$request->metodo_pago,
        ]);
        return redirect()->route('admin.pays.index')->with('success', 'El medoto de pago se ha creado correctamente.');
    }

    public function show(Pay $pay)
    {
        Pay::all();
        return view('admin.pays.show', compact('pay'));
    }

    public function edit(Pay $pay)
    {
         Pay::all();
        return view('admin.pays.edit',compact('pay'));
    }

    public function update(Request $request, Pay $pay)
    {
        $pay->update($request->all());
        return redirect()->route('admin.pays.index')->with('edit', 'El medoto de pago se ha editado correctamente.');
    }

    public function destroy(Pay $pay)
    {
        $pay->delete();
        return redirect()->route('admin.pays.index')->with('error', 'El medoto de pago se ha eliminado correctamente.');
    }
}
