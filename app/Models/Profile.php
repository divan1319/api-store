<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable =[
        'user_id',
        'dui',
        'telefono',
        'municipio_id',
        'ocupation_id',
        'descripcion',
        'imagen'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ocupation(){
        return $this->belongsTo(Ocupation::class);
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }
}
