<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    // Deshabilitar el manejo automático de created_at y updated_at
    public $timestamps = false; // Deshabilitar created_at y updated_at
    //Se pone a fuerzas esto ya que la clave primaria de la tabla tiene un nombre diferente al predeterminado (id).
    protected $primaryKey = 'id_post';  // Establece la columna correcta para la clave primaria
    //Mapeamos la tabla que estaremos utilizando
    protected $table = 'posts';


    // protected $fillable = ['title', 'description', 'created_at'];
    protected $fillable = [
        'title',
        'alias',
        'content',
        'status',
        'creation_date',
        'publication_date',
        'modification_date',
        'banners',
        'principal_Image',
        'secondary_Image',
        'mini_Image',
        'og_data',
        'metadata',
        'microdata',
        'author_id',
        'category_id',
        'form_id',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE

        // 'article_creation',


    ];

    /**
     * Esto se hace para formatear fechas sean reconocidas como dateTime creation_date  publication_date  modification_date se convierten en instancias de "Carbon" automáticamente, y se usa format() directamente en controlador/Blade:
     */
    protected $casts = [
        'creation_date' => 'datetime',
        'publication_date' => 'datetime',
        'modification_date' => 'datetime',
        'article_creation' => 'datetime',

    ];


    // HACEMOS EL JOIN CON AUTORES 
    // Explicación paso a paso:
    // En la tabla posts, el campo que guarda la referencia al autor se llama author_id (es la clave foránea).
    // En la tabla authors, la clave primaria se llama id_author (es la clave primaria).
    // Cuando defines una relación belongsTo(), debes enlazar la clave foránea de la tabla actual (posts.author_id) con la clave primaria de la tabla relacionada (authors.id_author).
    // Author::class → Especifica que el modelo relacionado es Author.
    // author_id → Es la clave foránea en la tabla posts.
    // id_author → Es la clave primaria en la tabla authors.
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id_author');
    }


    // NewCategory::class → Especifica que el modelo relacionado es Author.
    // category_id → Es la clave foránea en la tabla posts.
    // id → Es la clave primaria en la tabla new_categories.
    public function newCategory()
    {
        return $this->belongsTo(NewCategory::class, 'category_id', 'id');
    }

     // Forms::class → Especifica que el modelo relacionado es Author.
    // form_id → Es la clave foránea en la tabla posts.
    // form_id → Es la clave primaria en la tabla forms.
    public function joinForm(){
        return $this->belongsTo(Forms::class, 'form_id', 'form_id');
    }



      // Relación Muchos a Muchos con Customers(Clientes para tabla intermediaria)
      public function customers(): BelongsToMany
      {
          return $this->belongsToMany(Clients::class, 'customer_posts', 'id_post', 'customer_id')->withTimestamps();
      }
}
