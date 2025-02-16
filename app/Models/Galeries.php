<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Galeries extends Model
{
    use HasFactory;

    // Se especifica el nombre de la tabla
    protected $table = 'galleries';

    // Llave primaria personalizada
    protected $primaryKey = 'gallery_id';

    // Desactivamos los timestamps automáticos de Laravel
    public $timestamps = false;

    // Campos habilitados para asignación masiva
    protected $fillable = [
        'title',
        'alias',
        'status',
        'content',
        'testimonials',
        'publish_date',
        'creation_date',
        'modification_date',
        'tool',
        'link',
        'new_window',
        'images',
        'ogdata',
        'metadata',
        'microdata',
        'related_galleries',
        'banners',
        'banner_link',
        'ventana_nueva',
        'forms'
        //'user_id',
    ];

    protected $dates = [
        'creation_date',
        'modification_date',
        'publish_date'
    ];

    // Cast automático de campos a tipos específicos
    protected $casts = [
        'images' => 'array',
        'ogdata' => 'array',
        'metadata' => 'array',
        'microdata' => 'array',
        'testimonials' => 'array',
        'form_id' => 'array',
        'publish_date' => 'datetime',
        'creation_date' => 'datetime',
        'modification_date' => 'datetime',
    ];

    /**
     * Relación con el modelo User (Para agregar quién creó la galeria en este caso el autor).
     */
    /*public function author()
    {
        // return $this->belongsTo(Author::class, 'id_author', 'first_name'); 
        // belongsTo(Author::class): Significa que cada noticia tiene un solo autor.
        // 'author_id': Es la columna en la tabla news que hace referencia a la tabla authors.
        // 'id_author': Es la columna en la tabla authors que es la clave primaria.
        return $this->belongsTo(Author::class, 'author_id', 'id_author');
    }*/

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id_author');
    }


    //RELACION DE LA TABLA FORMS
    public function joinForm()
    {
        return $this->belongsTo(Forms::class, 'form_id', 'form_id');
    }


    //RELACION MUCHOS A MUCHOS CON CLIENTES
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'customer_galleries', 'gallery_id', 'customer_id')->withTimestamps();
    }
}
