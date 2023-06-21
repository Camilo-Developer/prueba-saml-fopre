<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PreOrder;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primarykey = 'id';
    protected $fillable = [
        'imagen_producto',
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'impoconsumo_producto',
        'company_id',
        'state_id'
    ];

    /*Lista con relacion directa e inversa Revisada */
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function preorders()
    {
        return $this->belongsToMany('App\Models\PreOrder', 'pre_order_product')->withPivot('id', 'quantity', 'subtotal');;
    }

}
