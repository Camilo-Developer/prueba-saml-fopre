<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\File;



class CompaniesController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.companies.index')->only('index');
        $this->middleware('can:admin.companies.edit')->only('edit', 'update');
        $this->middleware('can:admin.companies.create')->only('create', 'store');
        $this->middleware('can:admin.companies.destroy')->only('destroy');
    }

    public function index()
    {


        $user = Auth::user();

        if ($user->hasRole('Admin')){
            $companies = Company::paginate(5);
        }else{
            $companies = $user->companys()->paginate(5);
        }



        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $companies = Company::all();
        $users = User::all();
        $states = State::all();
        return view('admin.companies.create', compact('companies', 'users', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen_company' => 'required|image|mimes:jpeg,png,svg,jpg|max:1024',
            'nombre_empresa' => 'required',
            'usuario_id' => 'required',
            'estado_id' => 'required'
        ]);

        $company = Company::create($request->except('imagen_company'));

        // Crear la carpeta de la compañía
        $folderName = $request->input('nombre_empresa');
        $folderPath = public_path('storage/companies/' . $folderName);
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true);
        }

        // Guardar la imagen de la compañía
        if ($request->hasFile('imagen_company')) {
            $image = $request->file('imagen_company');
            $imageName = 'imagen.' . $image->getClientOriginalExtension();
            $image->move($folderPath, $imageName);
            $company->imagen_company = $imageName;
            $company->save();
        }

        return redirect()->route('admin.companies.index')->with('success', 'La Empresa se ha creado correctamente.');
    }

    public function show(Company $company)
    {
        Company::all();
        return view('admin.companies.show',compact('company'));
    }

    public function edit(Company $company)
    {
        $companies = Company::all();


        $users = User::all();

        $states = State::all();
        return view('admin.companies.edit',compact('companies', 'users', 'states', 'company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'imagen_company' => 'image|mimes:jpeg,png,svg|max:1024',
            'nombre_empresa' => 'required',
            'usuario_id' => 'required',
            'estado_id' => 'required'
        ]);

        $comp = $request->all();

        if ($imagen_company = $request->file('imagen_company')) {
            // Eliminar la imagen anterior si existe
            if ($company->imagen_company) {
                $rutaImagenAnterior = public_path('storage/companies/' . $company->nombre_empresa . '/' . $company->imagen_company);
                if (File::exists($rutaImagenAnterior)) {
                    File::delete($rutaImagenAnterior);
                }
            }

            // Guardar la nueva imagen
            $rutaGuardarImg = 'storage/companies/' . $company->nombre_empresa;
            $imagenCompany = date('YmdHis') . "." . $imagen_company->getClientOriginalExtension();
            $imagen_company->move($rutaGuardarImg, $imagenCompany);
            $comp['imagen_company'] = $imagenCompany;
        } else {
            unset($comp['imagen_company']);
        }

        $company->update($comp);

        return redirect()->route('admin.companies.index')->with('edit', 'La Empresa se ha editado correctamente.');
    }



    public function destroy(Company $company)
    {
         $company->delete();
        return redirect()->route('admin.companies.index')->with('error', 'La Empresa se ha eliminado correctamente.');
    }
}
