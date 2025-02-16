<?php
namespace App\Http\Controllers;

use App\Models\NewCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class NewCategoryController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías que no estan eliminadas desactivadas
        $new_category = NewCategory::where('is_active', true)->paginate(11);
        return view('categories.index', compact('new_category'));
    }

    public function create()
    {
        return view('categories.form');
    }

    public function store(Request $request)
    {
        //   dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        // Validación de los datos de entrada
        $request->validate([
            'name_category' => 'required|max:45',
        ], [
            'name_category.required' => 'El nombre de la categoría es obligatorio.',
            'name_category.max' => 'El nombre de la categoría no puede exceder los 45 caracteres.',
        ]);

        // Generar alias basado en el nombre de la categoría
        $alias = Str::slug($request->input('name_category'));

        // Definir un valor predeterminado para 'status'
        $status = $request->has('status') ? (bool) $request->input('status') : false;

        // Crear la categoría con los datos validados
        NewCategory::create([
            'name_category' => $request->input('name_category'),
            'alias' => $alias,
            'status' => $status,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('categories.index')->with('mensaje', 'Categoría registrada');
    }

    public function edit($id)
    {
        // Buscar la categoría por ID
        $category = NewCategory::findOrFail($id);
        return view('categories.form', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos de entrada
        $request->validate([
            'name_category' => 'required|max:45',
        ], [
            'name_category.required' => 'El nombre de la categoría es obligatorio.',
            'name_category.max' => 'El nombre de la categoría no puede exceder los 45 caracteres.',
        ]);

        // Buscar la categoría por ID
        $category = NewCategory::findOrFail($id);

        // Generar alias basado en el nuevo nombre
        $alias = Str::slug($request->input('name_category'));

        // Definir un valor predeterminado para 'status'
        $status = $request->has('status') ? (bool) $request->input('status') : false;

        // Actualizar la categoría con los datos validados
        $category->update([
            'name_category' => $request->input('name_category'),
            'alias' => $alias,
            'status' => $status,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('categories.index')->with('mensaje', 'Categoría actualizada');
    }

    // public function destroy($id) Original
    // {
    //     // Buscar la categoría por ID
    //     $category = NewCategory::findOrFail($id);

    //     // Eliminar la categoría
    //     $category->delete();

    //     // Redirigir con mensaje de éxito
    //     return redirect()->route('categories.index')->with('mensaje', 'Categoría eliminada');
    // }
    //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

    public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
    {
        // Obtener solo los categories inactivos (eliminados)
        $categoryDelete = NewCategory::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'categoryDelete' a la vista
        return view('categories.deleteRegister', compact('categoryDelete'));
    }
    #...news_id
    public function destroy($id)
    {
        // Buscar el categorY por su ID
        $categoryDelete = NewCategory::findOrFail($id);

        // Desactivar el categories (cambiar 'is_active' a 0 para desactivarlo)
        $categoryDelete->is_active = 0;
        $categoryDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de categories desactivados
        return redirect()->route('categories.index')->with('mensaje', 'Noticia Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    public function restoreCategory($id)
    {
        // dd($id); // Esto detendrá la ejecución y mostrará el valor de $id
        // Buscar el artículo por su ID
        $categoryDelete = NewCategory::findOrFail($id);


        // Verifica si se está recuperando correctamente
        // dd($categoryDelete); // Esto te mostrará los detalles del artículo y te ayudará a verificar

        // Verificar si el categories está inactivo
        if ($categoryDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $categoryDelete->is_active = 1;
            $categoryDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de categories activos
            return redirect()->route('categories.index')->with('mensaje', 'Autor Restaurado Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('categories.index')->with('mensaje', 'El Autor ya está restaurado.');
        }
    }

    // public function show(NewCategory $category)
    // {
    //     return view('categories.show', compact('category'));
    // }
}
