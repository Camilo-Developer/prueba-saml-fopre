<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReport extends Model
{
    use HasFactory;
    protected $table = 'sale_reports';
    protected $primarykey = 'id';
    protected $fillable = [
        'fecha',
        'venta_diaria',
        'pay_id',
        'company_id',
    ];
    /*Lista con relacion directa e inversa Revisada*/
    public function paymentMethods()
    {
        return $this->belongsToMany(Pay::class);
    }

    /*Lista con relacion directa e inversa Revisada*/
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
