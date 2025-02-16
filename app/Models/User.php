<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function role()
    {
        return $this->belongsTo(Rol::class, 'role_id', 'id');
    }

      #...Como un cliente puede estar relacionado con varios usuarios, agregamos la relación belongsToMany() en UserModel.php
    #...UserModel::class: Relacionamos con el modelo UserModel (que representa la tabla users).
    #...'customer_user': Especificamos la tabla intermedia.
    #...'customer_id': Clave foránea en customer_user que hace referencia a customers.id.
    #...'user_id': Clave foránea en customer_user que hace referencia a users.id.
    public function customers(): BelongsToMany {
        return $this->belongsToMany(Clients::class, 'customer_user', 'user_id', 'customer_id');
    }




    //NUEVO
    // En app/Models/User.php
public function createdUsers()
{
    return $this->hasMany(User::class, 'created_by'); // 'created_by' es la columna en la tabla 'users' que hace referencia al administrador
}




}
