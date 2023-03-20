<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    //propiedad protected para asignar los campos que se van a guardar en la base de datos
    protected $fillable = [
        'title',
        'content',
        'image'
    ];

}
