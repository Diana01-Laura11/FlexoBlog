<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Clients extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'customers';

    // Llave primaria personalizada
    protected $primaryKey = 'id';

    // Desactivamos los timestamps automáticos de Laravel
    public $timestamps = false;

    protected $fillable = [

        'business_name', //Razón Social
        'trade_name', //Nombre comercial
        'rfc', //RFC
        'address', //Dirección
        'manager_first_name', //Nombre (de Encargado)
        'manager_last_name', //Apellido (de encargado)
        'manager_email', //email (de encargado)
        'manager_phone', //teléfono (de encargado)
        'company_phone', //Teléfono de la empresa
        'url', //url
        'created_at',
        'updated_at',
        'password',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE

    ];

    /**
     * Esto se hace para formatear fechas sean reconocidas como dateTime creation_date  publication_date  modification_date se convierten en instancias de "Carbon" automáticamente, y se usa format() directamente en controlador/Blade:
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    #...Como un cliente puede estar relacionado con varios usuarios, agregamos la relación belongsToMany() en UserModel.php
    #...UserModel::class: Relacionamos con el modelo UserModel (que representa la tabla users).
    #...'customer_user': Especificamos la tabla intermedia.
    #...'customer_id': Clave foránea en customer_user que hace referencia a customers.id.
    #...'user_id': Clave foránea en customer_user que hace referencia a users.id.
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(UserModel::class, 'customer_user', 'customer_id', 'user_id');
    }

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(NewsNotice::class, 'customer_news', 'customer_id', 'news_id')->withTimestamps();
    }


    // Relación de muchos a muchos con promociones
    public function promotions()
    {
        return $this->belongsToMany(Promotions::class, 'customer_promotions', 'customer_id', 'promotion_id')
            ->withPivot('assigned_at', 'updated_at'); // Incluye el campo pivot 'assigned_at'
    }

    public function posts()
    {
        return $this->belongsToMany(Article::class, 'customer_posts', 'customer_id', 'id_post')
            ->withPivot('assigned_at'); //Asignar fecha de creacion
    }

    //RELACION MUCHOS A MUCHOS CON FORMULARIOS
    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(Forms::class, 'customer_forms', 'customer_id', 'form_id')->withTimestamps();
    }


    //RELACION MUCHOS A MUCHOS CON GALLERIAS
    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Galeries::class, 'customer_galleries', 'customer_id', 'gallery_id')->withTimestamps();
    }
}
