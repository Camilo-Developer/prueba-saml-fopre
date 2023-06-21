<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeState extends Model
{
    use HasFactory;
    protected $table = 'type_states';
    protected $primarykey = 'id';
    protected $fillable = [
        'type_state',
        'name',
    ];
    /*Lista con relacion directa e inversa revisada*/
    public function states()
    {
        return $this->hasMany('App\Models\State', 'type_state_id');
    }
}
