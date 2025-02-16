<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class NewsNoticeContent extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue la convención de nombres
    protected $table = 'news'; // Indica que este modelo usa la tabla 'news'
    protected $primaryKey = 'news_id'; // Usar 'news_id' como clave primaria
    public $timestamps = false; // Desactiva el manejo automático de timestamps
    // Especifica los campos que son asignables
    protected $fillable = [
        'content',
        'creation_date',
        'publish_date',
        'modification_date'
    ];
}
