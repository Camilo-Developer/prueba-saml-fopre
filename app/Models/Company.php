<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $primarykey = 'id';
    protected $fillable = [
        //Datos de la empresa
        'nombre_empresa',
        'usuario_id',
        'estado_id',
        'imagen_company',
        'nit',
        'razon_social',
        'direccion_correspondencia',
        'correo_correspondencia',
        'celular_correspondencia',
        'ubicacion',
        'logo',
        //Vincular como proveedor
        'comprobante_registro',
        //Documentos Sanitarios
        'registro_invima',
        'examen_microbiologico',
        'bpm',
        'formato_sgsst',
        'protocolos_bioseguridad',
        'plan_saneamiento',
        'copia_carnet_manipulacion',
        'copia_carnet_vacunacion',
        'copia_plantilla_arp',
        //Productos
        'productos',
        //REQUERIMIENTOS LOGÍSTICOS Y TÉCNICOS
        'logistico',
        'electrico',
        'gas',
        'carpa',
        'tamaño_carpa',
        'observaciones',
        'array_medios_pago',

    ];

    /*Lista con relacion directa e inversa Revisada*/
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'usuario_id');
    }

    /*Lista con relacion directa e inversa Revisada */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'estado_id');
    }

    /*Lista con relacion directa e inversa Revisada */
    public function products()
    {
        return $this->hasMany('App\Models\Product', 'company_id');
    }

    /*Lista con relacion directa e inversa Revisada*/
    public function salereports()
    {
        return $this->hasMany('App\Models\SaleReport', 'company_id');
    }
    public function preorders()
    {
        return $this->hasMany('App\Models\PreOrder', 'company_id');
    }
}
