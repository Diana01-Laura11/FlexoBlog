<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCategory extends Model // nombre de la clase sea exactamente NewCategory
{
    use HasFactory;

    protected $fillable = [
        'name_category',
        'alias',
        'status',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE
    ];

    //  /**
    //  * Esto se hace para formatear fechas sean reconocidas como dateTime creation_date  publication_date  modification_date se convierten en instancias de "Carbon" automáticamente, y se usa format() directamente en controlador/Blade:
    //  */
    // protected $casts = [
    //     'created_at' => 'datetime',
    //     'updated_at' => 'datetime',
    // ];
}
