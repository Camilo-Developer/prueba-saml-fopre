<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Pay;
use App\Models\SaleReport;
use Illuminate\Http\Request;

class SaleReportsController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.salereports.index')->only('index');
        $this->middleware('can:admin.salereports.edit')->only('edit', 'update');
        $this->middleware('can:admin.salereports.create')->only('create', 'store');
        $this->middleware('can:admin.salereports.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')){
            $sales = SaleReport::all();
            $salereports = [];
            $totalAmount = 0;
            foreach ($sales as $sale) {
                $paymentMethods = $sale->paymentMethods()->withPivot('amount')->get();

                $paymentMethodList = $paymentMethods->map(function ($paymentMethod) {
                    return [
                        'name' => $paymentMethod->metodo_pago,
                        'amount' => $paymentMethod->pivot->amount,
                    ];
                });

                $saleTotalAmount = $paymentMethods->sum('pivot.amount');
                $totalAmount += $saleTotalAmount;

                $salereports[] = [
                    'id' => $sale->id,
                    'fecha' => $sale->fecha,
                    'company_id' => $sale->company->nombre_empresa,
                    'payment_methods' => $paymentMethodList,
                    'sale_total_amount' => $saleTotalAmount,
                ];
            }
        }elseif (auth()->user()->hasRole('Empresa')){
            $companies = auth()->user()->companys()->pluck('id');
            $sales = SaleReport::whereIn('company_id', $companies)->paginate(5);
            $salereports = [];
            $totalAmount = 0;
            foreach ($sales as $sale) {
                $paymentMethods = $sale->paymentMethods()->withPivot('amount')->get();

                $paymentMethodList = $paymentMethods->map(function ($paymentMethod) {
                    return [
                        'name' => $paymentMethod->metodo_pago,
                        'amount' => $paymentMethod->pivot->amount,
                    ];
                });

                $saleTotalAmount = $paymentMethods->sum('pivot.amount');
                $totalAmount += $saleTotalAmount;

                $salereports[] = [
                    'id' => $sale->id,
                    'fecha' => $sale->fecha,
                    'company_id' => $sale->company->nombre_empresa,
                    'payment_methods' => $paymentMethodList,
                    'sale_total_amount' => $saleTotalAmount,
                ];
            }

        }


        return view('admin.salereports.index',compact('salereports','totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salereports = SaleReport::all();
        $pays = Pay::all();
        $companies = Company::all();
        return view('admin.salereports.create',compact('salereports', 'pays', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $saleReport = SaleReport::create([
            'fecha' => $request->fecha,
            'company_id' => $request->company_id,
        ]);

        foreach ($request['payment_methods'] as $paymentMethodData) {
            $paymentMethod = Pay::findOrFail($paymentMethodData['id']);
            $saleReport->paymentMethods()->attach($paymentMethod, ['amount' => $paymentMethodData['amount']]);
        }

        return redirect()->route('admin.salereports.index')->with('success', 'El Reporte de venta se ha creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(SaleReport $salereport)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleReport $salereport)
    {
        $pays = Pay::all();
        $paymentMethods = $salereport->paymentMethods()->withPivot('amount')->get();
        $companies = Company::all();
        $paymentMethodsData = [];


        foreach ($paymentMethods as $paymentMethod) {
            $paymentMethodsData[] = [
                'id' => $paymentMethod->id,
                'amount' => $paymentMethod->pivot->amount
            ];
        }
        return view('admin.salereports.edit', compact('salereport', 'pays', 'companies', 'paymentMethodsData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleReport $salereport)
    {
        $salereport->fecha = $request->input('fecha');
        $salereport->company_id = $request->input('company_id');
        $salereport->save();

        $paymentMethods = $request->input('payment_methods');
        $paymentMethodIds = collect($paymentMethods)->pluck('id')->toArray();

        $salereport->paymentMethods()->detach(array_diff($salereport->paymentMethods->pluck('id')->toArray(), $paymentMethodIds));

        foreach ($paymentMethods as $index => $paymentMethod) {
            $salereport->paymentMethods()->syncWithoutDetaching([
                $paymentMethod['id'] => ['amount' => $paymentMethod['amount']]
            ]);
        }

        return redirect()->route('admin.salereports.index')->with('success', 'El Reporte de venta se ha modificado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleReport $salereport)
    {
        $salereport->delete();
        return redirect()->route('admin.salereports.index')->with('error', 'El Reporte de venta se ha eliminado correctamente.');
    }
}
