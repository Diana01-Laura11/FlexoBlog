<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model // nombre de la clase sea exactamente
{
    use HasFactory;

    // Especifica el nombre de la tabla si no sigue el plural de la convención de Laravel
    protected $table = 'authors';

    // Si el nombre de la clave primaria id_author
    protected $primaryKey = 'id_author';

    // Define si la tabla usa timestamps automáticamente
    public $timestamps = false; // Si no usas los campos created_at y updated_at


    // Los campos que se pueden llenar en masa
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'description',
        'photo',
        'twitter',
        'linkedin',
        'creation_date',
        'modification_date',
        'customer_id',
        'delete_author',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE

    ];

    // UNION CON NOTICIAS
    public function newsNotices()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id_author');
        // return $this->hasMany(NewsNotice::class, 'id_author', 'id');
    }
    
}
//SE CAMBIO LA BD PARA QUE EL ID DE AUTORES SEA AUTOINCREMENTABLE YA QUE ESTABA ESTATICO