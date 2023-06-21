<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\TypeState;

class StatesController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.states.index')->only('index');
        $this->middleware('can:admin.states.edit')->only('edit', 'update');
        $this->middleware('can:admin.states.create')->only('create', 'store');
        $this->middleware('can:admin.states.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typestates = TypeState::all();
        $states = State:: paginate(5);
        return view('admin.states.index', compact('states', 'typestates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typestates = TypeState::all();

        $states = State:: all();
        return view('admin.states.create', compact('states', 'typestates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'nombre_estado' => 'required',
            'type_state_id' => 'required',
        ]);

        State::create([
            'color' => $request->color,
            'nombre_estado' => $request->nombre_estado,
            'type_state_id' => $request->type_state_id,
        ]);
        return redirect()->route('admin.states.index')->with('success', 'El Estado se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        State::all();
        return view('admin.states.show',compact( 'state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $typestates = TypeState::all();

        State::all();
        return view('admin.states.edit', compact('state', 'typestates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'color' => 'required',
            'nombre_estado' => 'required',
        ]);

        $state->update($request->all());
        return redirect()->route('admin.states.index')->with('edit', 'El Estado se ha editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        try {
            $state->delete();
            return redirect()->back()->with('success', 'Se elimino el estado con éxito');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'No se puede eliminar este post debido a una restricción de integridad referencial.');
        }

    }
}
