<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Forms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importa la clase Log
use Illuminate\Support\Facades\Auth;
use Laravel\Prompts\FormBuilder;
use Illuminate\Support\Facades\DB;



use function Laravel\Prompts\form;

class FormsController extends Controller
{
    // Mostrar todos los formularios
    // public function index()ORIGINAL
    // {
    //      // Obtener solo los FORMULARIOs activos
    //     $FormsData = Forms::where('is_active', true)->paginate(11); // Usamos paginate para paginar los resultados
    //     return view('forms.index', compact('FormsData'));

    // }

    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene un cliente asociado
        if ($authUser && $authUser->customers->isNotEmpty()) {
            $customer = $authUser->customers->first(); // Obtener el primer cliente

            // Obtener solo las noticias asociadas a ese cliente y que estén activas
            $FormsData = Forms::whereHas('customers', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            })->where('is_active', true)->paginate(11);
        } else {
            // Si el usuario no tiene cliente, devolver una colección vacía
            $FormsData = collect();
        }

        return view('forms.index', compact('FormsData'));
    }




    // Mostrar el formulario para crear uno nuevo
    public function create()
    {
        return view('forms.createForm');
    }


    // METODO PARA CREAR FORMULARIO
    public function saveForm(Request $request)
    {
        // Valida los datos antes de crearlos es aqui donde ponemos que no se vayan valores vacios por seguirdad
        $request->validate([
            'title' => 'required|string|max:70',
            'form' => 'required|json',

        ], [

            'form.required' => 'El campo contenido de formulario es obligatorio.',
            'form.json' => 'El campo contenido debe ser un JSON válido.',
            'title.required' => 'NO PUEDES DEJAR CAMPOS VACIOS',
            'title.max' => 'El título solo debe tener máximo 70 caracteres',
        ]);

        // Definir un valor predeterminado para 'status' esto hara que tenga seguridad y solo esperara valores booleanos asi como poder insertar 1 o 0
        $status = $request->has('status') ? (bool) $request->input('status') : false;


        // Convierte el contenido del formulario a un array
        $formData = json_decode($request->input('form'), true);


        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['error' => 'El contenido del formulario no es un JSON válido.']);
        }

        // Crea un nuevo formulario
        $form = new Forms();
        $form->title = $request->input('title'); // Guarda el título
        $form->content = json_encode($formData); // Guarda el contenido como JSON
        $form->user_id = auth()->id(); // Asumiendo que el usuario está autenticado, guarda el ID del usuario
        $form->status = $status; // Asigna el valor de status
        $form->save(); // Guarda en la base de datos


        #... CREAR EL REGISTRO EN LAS TABLAS INTERDIARIAS
        // // Obtener el ID del usuario logueado
        $userId = auth()->id();

        // Obtener el cliente al que pertenece el usuario
        $customer = DB::table('customer_user')
            ->where('user_id', $userId)
            ->first();

        if (!$customer) {
            return response()->json(['error' => 'El usuario no tiene un cliente asignado.'], 403);
        }

        $customerId = $customer->customer_id;

        // Asignar EL FORMULARIO al cliente en la tabla intermedia 'customer_forms'
        DB::table('customer_forms')->insert([
            'customer_id' => $customerId,
            'form_id' => $form->form_id, // Usar el ID del formulario recién creada
            'assigned_at' => now(),
        ]);

        return redirect()->route('forms.index')->with('mensaje', 'Formulario creado correctamente');
        // Obtén los datos del formulario

    }


    // FUNCION PARA EDITAR Y ACTUALIZAR
    // Mostrar el formulario para editar un formulario existente
    public function editForm($id)
    {
        // Encuentra el formulario por su ID
        $form = Forms::findOrFail($id);
        return view('forms.editForm', compact('form'));
    }

    // METODO PARA ACTUALIZAR FORMULARIO
    public function updateForm(Request $request, $id)
    {
        // Valida los datos
        $request->validate([
            'title' => 'required|string|max:70',
            'form' => 'required|json',
        ], [

            'form.required' => 'El campo contenido de formulario es obligatorio.',
            'form.json' => 'El campo contenido debe ser un JSON válido.',
            'title.required' => 'NO PUEDES DEJAR CAMPOS VACIOS',
            'title.max' => 'El título solo debe tener máximo 70 caracteres',
        ]);

        // Definir un valor predeterminado para 'status' esto hara que tenga seguridad y solo esperara valores booleanos asi como poder insertar 1 o 0
        $status = $request->has('status') ? (bool) $request->input('status') : false;
        // Convierte el contenido del formulario a un array
        $formData = json_decode($request->input('form'), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withErrors(['error' => 'El contenido del formulario no es un JSON válido.']);
        }

        // Encuentra el formulario por su ID y actualiza los campos
        $form = Forms::findOrFail($id);
        $form->title = $request->input('title'); // Actualiza el título
        $form->content = json_encode($formData); // Actualiza el contenido como JSON
        $form->status = $status; // Asigna el valor de status
        $form->save(); // Guarda los cambios en la base de datos

        #...ACTUALIZAR REGISTROS CON TABLA INTERMEDIARIA
        // Obtener el ID del usuario logueado
        $userId = auth()->id();

        // Obtener el cliente al que pertenece el usuario
        $customer = DB::table('customer_user')
            ->where('user_id', $userId)
            ->first();

        if (!$customer) {
            return response()->json(['error' => 'El usuario no tiene un cliente asignado.'], 403);
        }

        $customerId = $customer->customer_id;

        // Verificar si ya existe la asignación de la promoción al cliente
        $existingAssignment = DB::table('customer_forms')
            ->where('customer_id', $customerId)
            ->where('form_id', $form->form_id)
            ->first();

        if (!$existingAssignment) {
            DB::table('customer_forms')->insert([
                'customer_id' => $customerId,
                'form_id' => $form->form_id,
                'assigned_at' => now(),
            ]);
        }






        return redirect()->route('forms.index')->with('mensaje', 'Formulario actualizado correctamente');
    }


    //FUNCION DE DELETE NOTICIA POR ID
    // public function destroy($id)ORIGINAL
    // {
    //     // Buscara  la categoría por su ID
    //     $form = Forms::findOrFail($id);

    //     // Eliminar la categoría
    //     $form->delete();

    //     // Mensaje de éxito


    //     // Redireccionar a la lista de categorías
    //     return redirect()->route('forms.index')->with('mensaje', 'Formulario eliminada');
    // }




    public function showFormPreview(Forms $forms)
    {
        try {
            $formContent = json_decode($forms->content, true);

            if (!is_array($formContent)) {
                abort(500, 'El contenido del formulario no es un array válido.');
            }

            return view('forms.viewPreviewForm', compact('formContent'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Error en formulario: Asegúrate de que los nombres de los campos coincidan correctamente.',
                '!! SOLUCIONA EL PROBLEMA EDITANDO TU FORMULARIO !!',
                '- Label y name deben ser iguales.',
                '- Label y class deben ser iguales.',
                '- Label, class y Name deben ser iguales.',
                '-Label, class, Name y value deben ser iguales.',
                '- Name y value deben ser iguales.',
                '- Content y class deben ser iguales.',
            ]);
        }
    }




    //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

    public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
    {
        // Obtener solo los articles inactivos (eliminados)
        $formDelete = Forms::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'formDelete' a la vista
        return view('forms.deleteRegister', compact('formDelete'));
    }
    #...form_id
    public function destroy($form_id)
    {
        // Buscar el articles por su ID
        $formDelete = Forms::findOrFail($form_id);

        // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
        $formDelete->is_active = 0;
        $formDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('forms.index')->with('mensaje', 'Formulario Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    // Restaurar un artículo
    public function restoreForm($form_id)
    {
        // Buscar el artículo por su ID
        $formDelete = Forms::findOrFail($form_id);

        // Verificar el regsitro antes de actualizar
        // dd($articleDelete); // Verifica si se está recuperando correctamente

        // Verificar si el Formulario está inactivo
        if ($formDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $formDelete->is_active = 1;
            $formDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de Formulario activos
            return redirect()->route('forms.index')->with('mensaje', 'Formulario Restaurado Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('forms.index')->with('mensaje', 'El Formulario ya está restaurado.');
        }
    }
}
