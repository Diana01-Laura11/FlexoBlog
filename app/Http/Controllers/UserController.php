<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Rol;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function index()ORIGINAL
    // {
    //     // // Obtener solo los clientes activos
    //     $users = UserModel::where('is_active', true)->paginate(11);

    //     // Pasar los usuarios  a la vista mapeamos con la variable $user
    //     return view('users.index', compact('users'));
    // }
    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario es un administrador
        if ($authUser->role->name == 'admin') {
            // Obtener solo los usuarios que fueron creados por el administrador autenticado
            $users = UserModel::where('created_by', $authUser->id)->where('is_active', true)->paginate(11);
        } else {
            // Si no es administrador, no se muestran usuarios
            $users = collect();  // Una colección vacía
        }

        // Pasar los usuarios a la vista
        return view('users.index', compact('users'));
    }


    //FUNCION PARA CREAR USUARIOS 
    public function create()
    {
        $createUsr = UserModel::all(); //Obtiene todos los usuarios de la db
        // $assignAdministrator = UserModel::where('is_active', true)->where('role_id', 7)->get(); // Obtener todos los usuarios activos con role_id igual a 1 (administradores)
        // filtrar a los usuarios que tienen el rol de "admin"
        $assignAdministrator = UserModel::where('is_active', true)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->get();
        $rolesAdd = Rol::all(); // <---- Obtener todos los roles disponibles
        $clientsAdd = Clients::where('is_active', true)->get(); // Obtener todos los clientes activos disponibles
        // $clientsAdd = Clients::all(); // <---- Obtener todos los clientes disponibles
        // dd($clientsAdd);

        return view('users.create', compact('createUsr', 'rolesAdd', 'clientsAdd', 'assignAdministrator'));
        // return view('promotions.create');
    }


    public function saveUser(Request $request)
    {
        // dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        // Obtener el usuario actualmente autenticado
        // $user = auth()->user();
        //VALIDAMOS LOS CAMPOS QUE  CADA CAMPO AL INSERTAR DATSOS NO SE ENVIEN DE MANERA VACIA, QUE LAS FECHAS SEAN VALIDAS Y QUE NO EXISTAN DUPLICADOS 
        $validated = $request->validate([
            // 'name' => 'required|string|max:70',
            'created_by' => 'required|string',
            'name' => 'required|string|max:70|unique:users,name',
            'email' => 'required|string|max:100|unique:users,email',
            'password' => 'required|string|max:700',
            // Validamos el  join
            'role_id' => 'required|integer|exists:roles,id',
            'customer_id' => 'required|exists:customers,id'
            // 'client_id' => 'required|integer|exists:customer_user,user_id',

            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'name.required' => 'El name es obligatorio.',
            'name.max' => 'El name no puede exceder los 70 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.max' => 'El email no puede exceder los 70 caracteres.',
            'password.required' => 'El password es obligatorio.',
            'password.max' => 'El password no puede exceder los 700 caracteres.',
            'role_id.required' => 'El rol  es obligatorio.',
            'created_by.required' => 'El Responsable  es obligatorio.',
            // 'customer_id.required' => 'El cliente  es obligatorioooooo.',


            //EN CASO DE HABER VALORES DUPLICADOS NO DEJAR CREAR USUARIO
            'name.unique' => 'Este nombre ya está registrado.',
            'email.unique' => 'Este correo ya está registrado.',

        ]);




        // AQUI SI CREA EL USUARIO 
        //     UserModel::create([
        //         'name' => $validated['name'],
        //         'email' => $validated['email'],
        //         'password' => Hash::make($validated['password']),  // Hasheando la contraseña

        //         // 'password' => $validated['password'],
        //         'created_at' => now(),
        //         //CREAMOS EL ROL DE USARIO CON EL JOIN
        //         'role_id' => $validated['role_id'],
        //         'customer_id' => $validated['customer_id'],

        //     ]);



        //     // Redirigir al listado de noticias
        //     return redirect()->route('users.index')->with('mensaje', '¡Exito! Usuario Creado');
        // }
        // Crear el usuario
        $user = UserModel::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'created_by' => $validated['created_by'],
            // 'created_by' => $user->id,  // Usar el ID del usuario autenticado como creador
            // 'created_by' => $validated['created_by'],
            'password' => Hash::make($validated['password']),  // Hasheando la contraseña
            'created_at' => now(),
            'updated_at' => now(),
            'role_id' => $validated['role_id'],
        ]);

        // Agregar el usuario a la tabla intermedia `customer_user`
        $user->customers()->attach($validated['customer_id']);

        // Redirigir al listado de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('mensaje', '¡Exito! Usuario Creado');
    }



    //FUNCION PARA EDITAR USUARIOS

    public function editUser($id)
    {
        // Obtener el usuario actualmente autenticado
        //  $userAuth = auth()->user();
        // Encuentra el usuario por su ID la variable userEdit se encargara de setar los valores tanto en back y front
        $userEdit = UserModel::findOrFail($id);
        $rolesEdit = Rol::all(); // <---- Obtener todos los roles disponibles
        $clientEdit = Clients::where('is_active', true)->get();
        // filtrar a los usuarios que tienen el rol de "admin"
        $assignAdministrator = UserModel::where('is_active', true)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->get();
        // Depurar la promoción encontrada
        // dd($userEdit);
        return view('users.edit', compact('userEdit', 'rolesEdit', 'clientEdit', 'assignAdministrator'));
        // return view('users.edit', compact('userEdit', 'rolesEdit', 'clientEdit','userAuth'));
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        //Validacion de datos de entrada
        $validated = $request->validate([
            'created_by' => 'required|string',
            'name' => 'required|string|max:70',
            'email' => 'required|string|max:100',
            // 'password' => 'required|string|max:700',
            // Validamos el  join
            'role_id' => 'required|integer|exists:roles,id',
            'customer_id' => 'required|exists:customers,id'

            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'name.required' => 'El name es obligatorio.',
            'name.max' => 'El name no puede exceder los 70 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.max' => 'El email no puede exceder los 70 caracteres.',
            // 'password.required' => 'El password es obligatorio.',
            // 'password.max' => 'El password no puede exceder los 700 caracteres.',
            'role_id.required' => 'El rol  es obligatorio.',
            'customer_id.required' => 'El cliente  es obligatorio.',

            'created_by.required' => 'El Responsable  es obligatorio.',



        ]);

        $userEdit = UserModel::findOrFail($id);

        // Actualiza el rol
        $userEdit->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'created_by' => $validated['created_by'],

            // 'created_by' => auth()->user()->id, // Usar el ID del usuario autenticado (administrador)
            // 'created_by' => $userEdit->id,  // Usar el ID del usuario autenticado como creador

            // 'password' => $validated['password'],
            'updated_at' => now(),
            'created_at' => now(),
            //CREAMOS EL ROL DE USARIO CON EL JOIN
            'role_id' => $validated['role_id'],

        ]);
        /*si el usuario entra a editar y no cambia nada en los clientes seleccionados 
        (es decir, no modifica la lista de clientes), no hará ningún cambio en la tabla intermedia, 
        manteniendo los registros tal como están, sin agregar ni eliminar nada. */
        // Usar sync() para actualizar la relación de muchos a muchos
        $userEdit->customers()->sync($validated['customer_id']);



        // Redirigir al listado de noticias
        return redirect()->route('users.index')->with('mensaje', 'Roles Y Permisos Asignados ¡Exitosamente!');
    }



    //FUNCION DE DELETE NOTICIA POR ID
    // public function destroy($id)
    // {
    //     // Buscara  la categoría por su ID
    //     $user = UserModel::findOrFail($id);

    //     // Eliminar la categoría
    //     $user->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('users.index')->with('mensaje', 'Rol eliminada');
    // }


    //FUNCIONES PARA ELIMINAR PERO QUE NO ELIMINEN SOLO OCULTEN EL REGISTRO

    // public function show() //Funcion para mostrar lapagina delete register
    // {
    //     // Obtener solo los clientes inactivos (eliminados)
    //     $userDelete = UserModel::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

    //     // Pasar la variable 'clientDelete' a la vista
    //     return view('users.deleteRegister', compact('userDelete'));
    // }
    public function show()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario es un administrador
        if ($authUser->role->name == 'admin') {
            // Obtener solo los usuarios eliminados (inactivos) creados por el administrador autenticado
            $userDelete = UserModel::where('created_by', $authUser->id)
                ->where('is_active', false)
                ->paginate(15); // Usamos paginate para paginar los resultados
        } else {
            // Si no es administrador, no se muestran usuarios eliminados
            $userDelete = collect();  // Una colección vacía
        }

        // Pasar la variable 'userDelete' a la vista
        return view('users.deleteRegister', compact('userDelete'));
    }


    public function destroy($id)
    {
        // Buscar el cliente por su ID
        $userDelete = UserModel::findOrFail($id);

        // Desactivar el cliente (cambiar 'is_active' a 0 para desactivarlo)
        $userDelete->is_active = 0;
        $userDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('users.index')->with('mensaje', 'Usuario Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    public function restoreUser($id)
    {
        // Buscar el cliente por su ID
        $userDelete = UserModel::findOrFail($id);

        // Restaurar el cliente (cambiar 'is_active' a 1 para activarlo)
        $userDelete->is_active = 1;
        $userDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes activos
        return redirect()->route('users.index')->with('mensaje', 'Usuario Restaurado Con Éxito');
    }




    //FUNCION PARA USUARIOS EN ESPERA
    // public function waitingUsers()
    // {
    //      // Obtener solo los clientes inactivos (eliminados)
    //     $userWait = UserModel::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

    //     // Pasar la variable 'clientDelete' a la vista
    //     return view('users.waitingUsers', compact('userWait'));
    // }
    public function waitingUsers()
    {
        // Obtener usuarios inactivos donde role_id o created_by sean NULL
        $userWait = UserModel::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('role_id')
                    ->orWhereNull('created_by');
            })
            ->paginate(15);

        // Pasar los datos a la vista
        return view('users.waitingUsers', compact('userWait'));
    }


    public function welcomeClient()
    { 
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene clientes asignados
        if ($authUser) {
            $clients = $authUser->customers; // Obtener los clientes relacionados al usuario
            // dd($clients); // Verifica qué clientes está obteniendo

        } else {
            $clients = collect(); // Si no hay usuario autenticado, devolver colección vacía
        }

        return view('users.welcomeClient', compact('clients'));
    }

    // public function welcomeClient()
    // { 
    //     $authUser = Auth::user();
    
    //         $clients = $authUser->customers; // Obtener los clientes relacionados al usuario
    
    //     return view('users.welcomeClient', compact('clients'));
    // }
    
    
}
