<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    use HasFactory;

    protected $table = 'modalities';
    protected $primarykey = 'id';
    protected $fillable = [
        'name_modality',
        'img_modality',
        'observations_modality',
        'state_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
