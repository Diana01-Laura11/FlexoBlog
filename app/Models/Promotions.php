<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// clase promociones que extiende del modelo 
class Promotions extends Model
{
    use HasFactory;

    // Deshabilitar el manejo automático de created_at y updated_at
    public $timestamps = false;

    //Se pone a fuerzas esto ya que la clave primaria de la tabla tiene un nombre diferente al predeterminado (id).
    protected $primaryKey = 'promotion_id';  // Establece la columna correcta para la clave primaria
    //Mapeamos la tabla que estaremos utilizando
    protected $table = 'promotions';

    /**
     * Los atributos que se pueden asignar de manera masiva.
     */
    protected $fillable = [
        'title',
        'alias',
        'subtitle',
        'content',
        'status',
        'start_date',
        'end_date',
        'terms', 
        'extras',
        'link',
        'metadata',
        'microdata',
        'banners', 
        'principal_Image', 
        'secondary_Image', 
        'mini_Image',
        'form_id',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE

      
    ];
     /**
     * Esto se hace para formatear fechas sean reconocidas como dateTime  start_date y end_date se convierten en instancias de "Carbon" automáticamente, y se usa format() directamente en controlador/Blade:
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    /*HACEMOS JOIN CON FORMULARIOS */
     /*
    Forms::class: Esto hace referencia al modelo FORMULARIOS.
    'form_id int AI PK : Es el nombre de la columna en la tabla promotions que contiene la clave foránea.
    'form_id int': Es el nombre de la clave primaria en la tabla forms
     */

     public function joinForm()
    {
        return $this->belongsTo(Forms::class, 'form_id', 'form_id');
    }


    // Relación de muchos a muchos con clientes
    public function customers()
    {
        return $this->belongsToMany(Clients::class, 'customer_promotions', 'promotion_id', 'customer_id')
                    ->withPivot('assigned_at','updated_at'); // Incluye el campo pivot 'assigned_at'
    }
}
