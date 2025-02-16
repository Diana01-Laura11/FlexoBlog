<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Rol;
use App\Models\UserModel;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        // Obtener todOS LOS ROLES EXISTENTES
        $rolUser = Rol::all();

        // Pasar las promociones a la vista mapeamos con la variable $promotions
        return view('roles.index', compact('rolUser'));
    }

    public function create()
    {
        return view('roles.create');
    }



    public function saveRol(Request $request)
    {
        //  dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        //VALIDAMOS LOS CAMPOS QUE  CADA CAMPO AL INSERTAR DATOS
        $request->validate([
            'name' => 'required|string|in:admin,editor,sales,user',
            'description' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    // Definir qué permisos son válidos para cada rol
                    $validPermissions = [
                        /*Administrador (admin) - Acceso completo al sistema. Gestiona usuarios, roles, permisos y todo el contenido. */
                        // 'admin' => ['admin'],
                        'admin' => ['Acceso completo al sistema. Gestiona usuarios, roles, permisos y todo el contenido.'],
                        /* Editor (editor) - Puede crear, editar y publicar contenido (artículos, noticias, galerías, descargables). No gestiona usuarios ni roles.*/
                        // 'editor' => ['editor'],
                        'editor' => ['Puede crear, editar y publicar contenido (artículos, noticias, autores, formularios, imagenes, categorias, promociones, galerías, descargables). No gestiona usuarios ni roles.'],
                        /*Ventas (sales) - Gestiona promociones y ve contactos. No gestiona contenido de blog ni usuarios.*/
                        // 'sales' => ['sales'],
                        'sales' => ['Ventas (sales) - Gestiona promociones y  contactos(clientes). No gestiona contenido de blog ni usuarios.'],
                        /*Usuario (user) - Rol básico. Puede ver contenido público y enviar formularios.*/
                        // 'user' => ['user'],
                        'user' => ['Rol básico. Puede ver contenido público y enviar formularios.'],
                    ];

                    // Verificar si el permiso es válido para el rol elegido
                    if (!isset($validPermissions[$request->name]) || !in_array($value, $validPermissions[$request->name])) {
                        $fail('El permiso seleccionado no es válido para el rol elegido.');
                    }
                } 
            ],
        ], [
            'name.required' => 'El rol es obligatorio.',

        ]);

        // AQUI SI CREA LA PROMOCION 
        // Rol::create([
        //     'name' => $validated['name'],
        //     'description' => $validated['description'],
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);


        // Si pasa la validación, se guarda en la BD
        Rol::create([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Redirigir al listado de noticias
        return redirect()->route('roles.index')->with('mensaje', '¡Exito! Rol y permiso asignados correctamente.');
    }


    //FUNCION DE DELETE NOTICIA POR ID
    // public function destroy($id)
    // {
    //     // Buscara  la categoría por su ID
    //     $rolUser = Rol::findOrFail($id);

    //     // Eliminar la categoría
    //     $rolUser->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('roles.index')->with('mensaje', 'Rol eliminada');
    // }
    public function destroy($id)
    {
        // Buscar el rol por su ID
        $rolUser = Rol::findOrFail($id);

        // Verificar si hay usuarios asociados con este rol
        $usersWithRole = UserModel::where('role_id', $id)->count();

        // Si hay usuarios asociados, mostrar un mensaje y no eliminar el rol
        // if ($usersWithRole > 0) {
        //     return redirect()->route('roles.index')->with('mensaje', 'Lo lamento, no puedo completar esta acción porque estás intentando eliminar un registro de roles, pero hay registros en la tabla users que están relacionados con ese role_id. Para completar esta acción, primero debes eliminar o reasignar a los usuarios que tienen este rol.');
        // }
        if ($usersWithRole > 0) {
            return redirect()->route('roles.index')->withErrors([
                'error' => 'Lo lamento, no puedo completar esta acción porque estás intentando eliminar un registro de roles, pero hay registros en la tabla users que están relacionados con ese role_id. Para completar esta acción, primero debes eliminar o reasignar a los usuarios que tienen este rol.'
            ]);
        }
        
        
        

        // Eliminar el rol si no hay usuarios asociados
        $rolUser->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('roles.index')->with('mensaje', 'Rol eliminado correctamente.');
    }
}
