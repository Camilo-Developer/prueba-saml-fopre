<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table = 'states';
    protected $primarykey = 'id';
    protected $fillable = [
        'color',
        'nombre_estado',
        'type_state_id',
    ];
    public function typestate()
    {
        return $this->belongsTo('App\Models\TypeState', 'type_state_id');
    }

    /*Lista con relacion directa e inversa revisada*/
    public function users()
    {
        return $this->hasMany('App\Models\User', 'estado_id');
    }

    /*Lista con relacion directa e inversa revisada*/
    public function preorders()
    {
        return $this->hasMany('App\Models\PreOrder', 'estado_id');
    }
    /*Lista con relacion directa e inversa Revisada */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'state_id');
    }

    /*Lista con relacion directa e inversa Revisada*/
    public function companys()
    {
        return $this->hasMany('App\Models\Company', 'estado_id');
    }

    public function modalities()
    {
        return $this->hasMany('App\Models\Modality', 'state_id');
    }

}
