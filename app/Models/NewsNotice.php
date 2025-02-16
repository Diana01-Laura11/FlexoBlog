<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsNotice extends Model
{
    use HasFactory;


    // Nombre de la tabla en la base de datos
    protected $table = 'news';

    // Llave primaria personalizada
    protected $primaryKey = 'news_id';

    // Desactivamos los timestamps automáticos de Laravel
    public $timestamps = false;

    // Columnas asignables en el modelo
    protected $fillable = [
        'title',
        'alias',
        'content',
        'status',
        'creation_date',
        'publish_date',
        'modification_date',
        'ogdata',
        'metadata',
        'microdata',
        'form_id',
        'author_id',
        'principal_Image',
        'secondary_Image',
        'mini_Image',
        'banners',
        'forms',
        'author',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE


    ];

    // Casteo de columnas JSON para manipularlas como arrays u objetos
    // Si tienes campos JSON en la base de datos, puedes definirlos aquí para que Laravel los maneje adecuadamente
    protected $casts = [
        'creation_date' => 'datetime',
        'publish_date' => 'datetime', // Asegúrate de que el nombre de la columna sea el correcto
        'modification_date' => 'datetime',
        'article_creation' => 'datetime',
        'ogdata' => 'string',
        'metadata' => 'string',
        'microdata' => 'string',

    ];


    
    /*
    Author::class: Esto hace referencia al modelo Author.
    'author_id': Es el nombre de la columna en la tabla news que contiene la clave foránea.
    'id_author': Es el nombre de la clave primaria en la tabla authors, que corresponde a la columna que author_id apunta.
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id_author');
    }



    //RELACION DE LA TABLA FORMS
    //Relación con el formulario al que pertenece la noticia
    // public function form()
    // {
    //     return $this->belongsTo(Forms::class, 'form_id', 'id');
    // }

    public function joinForm()
    {
        return $this->belongsTo(Forms::class, 'form_id', 'form_id');
    }




    // Relación Muchos a Muchos con Customers
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'customer_news', 'news_id', 'customer_id')->withTimestamps();
    }
}
