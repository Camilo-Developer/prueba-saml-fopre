<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;
use App\Models\SaleReport;
use App\Models\PreOrder;




class ChartJSController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;

        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%M') as month_name"))
            ->whereYear('created_at', date('Y'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw("MONTH(created_at)"), DB::raw("DATE_FORMAT(created_at, '%M')"))
            ->orderBy(DB::raw("MONTH(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();

        $total_ventas = DB::table('pay_sale_report')->sum('amount');
        $totalDescuento = $total_ventas - ($total_ventas * 0.08);
        $donacionEstimada = $totalDescuento * 0.3;
        $meta = 1000000; // Reemplaza con el valor de la meta deseada
        $porcentajeCumplimiento = ($total_ventas / $meta) * 100;

        $salesData = DB::table('sale_reports')
        ->join('pay_sale_report', 'sale_reports.id', '=', 'pay_sale_report.sale_report_id')
        ->select('sale_reports.fecha', DB::raw('SUM(pay_sale_report.amount) as total_amount'))
        ->whereYear('sale_reports.fecha', $year)
        ->groupBy('sale_reports.fecha')
        ->orderBy('sale_reports.fecha')
        ->get();

        $fecha = $salesData->pluck('fecha');
        $total_amount = $salesData->pluck('total_amount');

        $salesData = DB::table('sale_reports')
        ->join('pay_sale_report', 'sale_reports.id', '=', 'pay_sale_report.sale_report_id')
        ->join('companies', 'sale_reports.company_id', '=', 'companies.id')
        ->select('sale_reports.company_id', DB::raw('SUM(pay_sale_report.amount) as total_amount'), 'companies.nombre_empresa')
        ->whereYear('sale_reports.fecha', $year)
        ->groupBy('sale_reports.company_id', 'companies.nombre_empresa')
        ->orderByDesc('total_amount')
        ->get();

        $companyLabels = $salesData->pluck('nombre_empresa')->toArray();
        $totalAmounts = $salesData->pluck('total_amount')->toArray();

        $pedido_anticipado = PreOrder::whereHas('state', function ($query) {
            $query->whereHas('typeState', function ($subQuery) {
                $subQuery->where('type_state', 1);
            });
        })->sum('total');



        return view('admin.salereports.chart', compact('labels', 'data','total_ventas','donacionEstimada','porcentajeCumplimiento','fecha','total_amount','companyLabels','totalAmounts','pedido_anticipado'));
    }

}
