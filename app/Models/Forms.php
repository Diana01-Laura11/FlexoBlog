<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Forms extends Model
{
    use HasFactory;
    // Especificar el nombre de la tabla si es diferente del plural del nombre del modelo
    protected $table = 'forms';
    // Definir la clave primaria personalizada
    protected $primaryKey = 'form_id';

    //Esto hace que Laravel gestione automáticamente `created_at` y `updated_at.
    public $timestamps = false; // Desactiva el manejo automático de timestamps

    // Cast para interpretar `status` como booleano YA QUE ES DE TIPO BIT y NO ES DE TIPO status tinyint(1)
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $fillable = [
        'title',
        'content',
        'creation_date',
        'modification_date',
        'status',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE
    ];

    //COMO LA TABLA TIENE CAMPO FORANEO NECESITA RELACIONARLA EN EL MODELO
    // Relación con el modelo User (si corresponde)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    //UNION CON NOTICIAS
    public function newsNotices()
    {
        return $this->hasMany(NewsNotice::class, 'form_id', 'id');
    }

    //RELACION MUCHOS A MUCHOS CON CLIENTES (customers)
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'customer_forms', 'form_id', 'customer_id')->withTimestamps();
    }

}
