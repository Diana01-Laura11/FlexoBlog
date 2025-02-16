<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;


     // Nombre de la tabla en la base de datos
     protected $table = 'roles';

     // Llave primaria personalizada
     protected $primaryKey = 'id';
 
     // Desactivamos los timestamps automáticos de Laravel
     public $timestamps = false;
 
     // Columnas asignables en el modelo
     protected $fillable = [
         'name',
         'description',
         'created_at',
         'updated_at',
        
 
     ];

     protected $casts = [
       
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];


    // En el modelo Role (Role.php)
public function user()
{
    return $this->hasMany(UserModel::class, 'role_id', 'id');
}


    //  Table: roles
    //  Columns:
    //  id int AI PK 
    //  name varchar(50) 
    //  description varchar(255) 
    //  created_at datetime 
    //  updated_at datetime

    

}
