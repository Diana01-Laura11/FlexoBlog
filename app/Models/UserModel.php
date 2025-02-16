<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserModel extends Model
{
    use HasFactory;


    // Nombre de la tabla en la base de datos
    protected $table = 'users';

    // Llave primaria personalizada
    protected $primaryKey = 'id';

    // Desactivamos los timestamps automáticos de Laravel
    public $timestamps = false;

    // Columnas asignables en el modelo
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'role_id',
        'customer_id',
        'created_by',
        'is_active', //VALOR BOOLEANO SERVIRAR PARA SETEAR QUE NO SE ELIMINE SOLO SE OCULTE


    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];



    // HACEMOS EL JOIN CON ROLES
    /*
    UserModel::class: Esto hace referencia al modelo usuarios.
    'role_id': Es el nombre de la columna en la tabla users que contiene la clave foránea.
    'id': Es el nombre de la clave primaria en la tabla roles, que corresponde a la columna que id apunta.
     */
    // En el modelo User (UserModel.php)
    public function roles()
    {
        return $this->belongsTo(Rol::class, 'role_id', 'id');
    }



    #...Como un usuario puede estar relacionado con varios clientes, agregamos la relación belongsToMany() en UserModel.php
    #... Clients::class: Relacionamos con el modelo Clients (que representa la tabla customers).
    #...'customer_user': Especificamos la tabla intermedia.
    #...'user_id': Clave foránea en customer_user que hace referencia a users.id.
    #...'customer_id': Clave foránea en customer_user que hace referencia a customers.id.
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'customer_user', 'user_id', 'customer_id');
    }


  //NUEVO
//     // app/Models/User.php
// public function managedClients() {
//     return $this->belongsToMany(Clients::class, 'customer_user', 'user_id', 'customer_id');
// }

public function client()
{
    return $this->belongsTo(Clients::class, 'customer_id', 'id');
}


}
