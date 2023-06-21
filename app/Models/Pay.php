<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $table = 'pays';
    protected $primarykey = 'id';
    protected $fillable = [
        'metodo_pago',
    ];
    /*Lista con relacion directa e inversa Revisada*/
    public function salereports()
    {
        return $this->belongsToMany(SaleReport::class);
    }
}
