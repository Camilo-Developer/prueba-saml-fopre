<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Product;
use App\Models\PreOrder;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::whereHas('state', function ($query) {
            $query->where('type_state_id', 1);
        })->get();

        return view('users.fopre.companies', compact('companies'));
    }

    public function show(Company $company)
    {
        $products = $company->products()->whereHas('state', function ($query) {
            $query->where('type_state_id', 1);
        })->get();

        return view('users.fopre.show', compact('company', 'products'));
    }

    public function cart(){
        $fechaHoy = Carbon::now()->format('F d, Y');

        return view('users.fopre.cart')->with('fechaHoy', $fechaHoy);
    }
    public function addToCart($id,Request $request){
        $list_product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $request->quantity;
        }  else {
            $cart[$id] = [
                "nombre_producto" => $list_product->nombre_producto,
                "imagen_producto" => $list_product->imagen_producto,
                "descripcion_producto" => $list_product->descripcion_producto,
                "precio_producto" => $list_product->precio_producto,
                "company_id" => $request->company_id,
                "quantity" => $request->quantity,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'El producto se a añadido al carrito con éxito!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
    public function validateCompanies()
    {
        return view('users.fopre.ckeck-auth-companies');
    }
    public function editDocuments(Request $request, Company $company)
    {
        // Obtener la ruta de la carpeta de destino
        $folderPath = public_path('storage/companies/' . $company->nombre_empresa);

        $nombreEmpresa = $company->nombre_empresa;

        // Eliminar caracteres especiales y espacios
        $nombreEmpresa = preg_replace('/[^A-Za-z0-9]/', '', $nombreEmpresa);

        // Convertir a minúsculas
        $nombreEmpresa = strtolower($nombreEmpresa);
        // Guardar los archivos en la carpeta de destino
        if ($request->hasFile('comprobante_registro')) {
            $comprobanteRegistro = $request->file('comprobante_registro');
            $comprobanteRegistro->move($folderPath, 'comprobante_registro_'.$nombreEmpresa.'.'.$comprobanteRegistro->getClientOriginalExtension());
            $company->comprobante_registro = 'companies/comprobante_registro.'.$comprobanteRegistro->getClientOriginalExtension();
        }
        if ($request->hasFile('registro_invima')) {
            $registroInvima = $request->file('registro_invima');
            $registroInvima->move($folderPath, 'registro_invima_'.$nombreEmpresa.'.'.$registroInvima->getClientOriginalExtension());
            $company->registro_invima = 'companies/registro_invima.'.$registroInvima->getClientOriginalExtension();
        }
        if ($request->hasFile('examen_microbiologico')) {
            $examenMicrobiologico = $request->file('examen_microbiologico');
            $examenMicrobiologico->move($folderPath, 'examen_microbiologico_'.$nombreEmpresa.'.'.$examenMicrobiologico->getClientOriginalExtension());
            $company->examen_microbiologico = 'companies/examen_microbiologico.'.$examenMicrobiologico->getClientOriginalExtension();
        }
        if ($request->hasFile('bpm')) {
            $bpm = $request->file('bpm');
            $bpm->move($folderPath, 'bpm_'.$nombreEmpresa.'.'.$bpm->getClientOriginalExtension());
            $company->bpm = 'companies/bpm.'.$bpm->getClientOriginalExtension();
        }
        if ($request->hasFile('formato_sgsst')) {
            $formatoSgsst = $request->file('formato_sgsst');
            $formatoSgsst->move($folderPath, 'formato_sgsst_'.$nombreEmpresa.'.'.$formatoSgsst->getClientOriginalExtension());
            $company->formato_sgsst = 'companies/formato_sgsst.'.$formatoSgsst->getClientOriginalExtension();
        }
        if ($request->hasFile('protocolos_bioseguridad')) {
            $protocoloBioseguridad = $request->file('protocolos_bioseguridad');
            $protocoloBioseguridad->move($folderPath, 'protocolos_bioseguridad_'.$nombreEmpresa.'.'.$protocoloBioseguridad->getClientOriginalExtension());
            $company->protocolos_bioseguridad = 'companies/protocolos_bioseguridad.'.$protocoloBioseguridad->getClientOriginalExtension();
        }
        if ($request->hasFile('plan_saneamiento')) {
            $planSaneamiento = $request->file('plan_saneamiento');
            $planSaneamiento->move($folderPath, 'plan_saneamiento_'.$nombreEmpresa.'.'.$planSaneamiento->getClientOriginalExtension());
            $company->plan_saneamiento = 'companies/plan_saneamiento.'.$planSaneamiento->getClientOriginalExtension();
        }
        if ($request->hasFile('copia_carnet_manipulacion')) {
            $copiaCarnetManipulacion = $request->file('copia_carnet_manipulacion');
            $copiaCarnetManipulacion->move($folderPath, 'copia_carnet_manipulacion_'.$nombreEmpresa.'.'.$copiaCarnetManipulacion->getClientOriginalExtension());
            $company->copia_carnet_manipulacion = 'companies/copia_carnet_manipulacion.'.$copiaCarnetManipulacion->getClientOriginalExtension();
        }
        if ($request->hasFile('copia_carnet_vacunacion')) {
            $copiaCarnetVacunacion = $request->file('copia_carnet_vacunacion');
            $copiaCarnetVacunacion->move($folderPath, 'copia_carnet_vacunacion_'.$nombreEmpresa.'.'.$copiaCarnetVacunacion->getClientOriginalExtension());
            $company->copia_carnet_vacunacion = 'companies/copia_carnet_vacunacion.'.$copiaCarnetVacunacion->getClientOriginalExtension();
        }
        if ($request->hasFile('copia_plantilla_arp')) {
            $copiaPlantillaARP = $request->file('copia_plantilla_arp');
            $copiaPlantillaARP->move($folderPath, 'copia_plantilla_arp_'.$nombreEmpresa.'.'.$copiaPlantillaARP->getClientOriginalExtension());
            $company->copia_plantilla_arp = 'companies/copia_plantilla_arp.'.$copiaPlantillaARP->getClientOriginalExtension();
        }
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo->move($folderPath, 'logo_'.$nombreEmpresa.'.'.$logo->getClientOriginalExtension());
            $company->logo = 'companies/logo.'.$logo->getClientOriginalExtension();
        }
        if ($request->hasFile('productos')) {
            $productos = $request->file('productos');
            $productos->move($folderPath, 'productos_'.$nombreEmpresa.'.'.$productos->getClientOriginalExtension());
            $company->productos = 'companies/productos.'.$productos->getClientOriginalExtension();
        }

        if (!empty($request->logistico) ){
            $company->logistico = $request->logistico;
        }
        if (!empty($request->electrico) ){
            $company->electrico = $request->electrico;
        }

        if (!empty($request->gas)) {
            $company->gas = $request->gas;
        }

        if (!empty($request->carpa)) {
            $company->carpa = $request->carpa;
            $company->tamaño_carpa = $request->tamaño_carpa;
        }

        if (!empty($request->array_medios_pago) ){
            $company->array_medios_pago = $request->array_medios_pago;
        }

        if (!empty($request->observaciones)) {
            $company->observaciones = $request->observaciones;
        }
        if (!empty($request->nit)) {
            $company->nit = $request->nit;
        }
        if (!empty($request->razon_social)) {
            $company->razon_social = $request->razon_social;
        }
        if (!empty($request->direccion_correspondencia)) {
            $company->direccion_correspondencia = $request->direccion_correspondencia;
        }
        if (!empty($request->correo_correspondencia)) {
            $company->correo_correspondencia = $request->correo_correspondencia;
        }
        if (!empty($request->celular_correspondencia)) {
            $company->celular_correspondencia = $request->celular_correspondencia;
        }




        $company->save();

        // Mostrar mensaje de éxito y redirigir a otra vista
        Session::flash('success', 'Los datos han sido guardados correctamente.');
        return redirect()->route('validate.auth.companies')->with('success', 'Los datos han sido guardados correctamente.');


    }

    public function download($folder, $filename)
    {
        $pathToFile = public_path('storage/companies/' . $folder . '/' . $filename);
        dd($pathToFile);
        if (file_exists($pathToFile)) {
            return Response::download($pathToFile);
        }

        abort(404);
    }

}
