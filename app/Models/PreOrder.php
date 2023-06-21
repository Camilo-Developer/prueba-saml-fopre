<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class PreOrder extends Model
{
    use HasFactory;
    protected $table = 'pre_orders';
    protected $primarykey = 'id';
    protected $fillable = [
        'fecha',
        'dependence',
        'cost_center',
        'name_cost_center',
        'name_auth',
        'extension',
        'fecha_claim',
        'observations',
        'total',
        'usuario_id',
        'estado_id',
        'company_id',
    ];

    /*Lista con relacion directa e inversa Revisada*/
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'usuario_id');
    }


    /*Lista con relacion directa e inversa revisada */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'estado_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'pre_order_product')->withPivot('id', 'quantity', 'subtotal');
    }
}
