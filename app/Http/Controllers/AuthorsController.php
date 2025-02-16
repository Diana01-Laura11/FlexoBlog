<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsNotice;
use App\Models\Author;
use Illuminate\Support\Str;  // de importar Str
use App\Models\NewsNoticeContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\app\utils\utils;
use Illuminate\Support\Facades\File;

//todo: cambiar el nombre de la clase
class AuthorsController extends Controller
{

    //todo: revisar el nombre del metodo
    public function index()
    {

        //Mostrara los autores que no esten desactivados en este caso eliminados
        $authors = Author::where('is_active', true)->paginate(11);
        return view('authors.index', compact('authors'));
    }
    

    public function create()
    {
        // Renderiza la vista para crear un autor
        return view('authors.createAuthors');
    }


    //FUNCION PARA CONVERTIR UNA IMAGEN A BASE 64
    private function convertFileToBase64(Request $request)
    {

        $base64 = '';

        if ($request->hasFile('images')) {
            $imagen = $request->file('images'); // Obtiene el archivo

            // Leer el contenido del archivo y convertirlo a Base64
            $base64 = base64_encode(file_get_contents($imagen->getRealPath()));

            // Obtener el tipo MIME de la imagen
            $mime = $imagen->getMimeType();

            $base64 = "data:$mime;base64,$base64";
        } else {
            $base64 =  'No existe';
        }


        return $this->convertStringToJson('base64', $base64);
    }
    function convertStringToJson(String $key, String $value)
    {
        $data = [
            // $key => $value,
            'base64' => $value
        ];

        return  json_encode($data);
    }


    // private function convertFileToBase64(Request $request, $fieldName)
    // {
    //     if ($request->hasFile($fieldName)) {
    //         $image = $request->file($fieldName); // Obtiene el archivo
    //         $base64 = base64_encode(file_get_contents($image->getRealPath())); // Convierte el contenido a Base64
    //         $mime = $image->getMimeType(); // Obtiene el tipo MIME
    //         return "data:$mime;base64,$base64"; // Retorna la cadena Base64 completa
    //     }

    //     return null; // Devuelve nulo si no hay archivo
    // }


     // FUNCION PARA IMAGENES

     public function showImages(Request $request){
        $folder =  $request->input('folder');

        // Definir el directorio donde se encuentran las imágenes
        $directory = public_path('assets/imagenes-blog/' . $folder);

        // Obtener todos los archivos del directorio
        $files = File::files($directory);
        $fileNames = array_map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'path' => $file->getRealPath(),
            ];
        }, $files);

        // Devuelve las url de los archivos
        return response()->json([
            'files' => $fileNames
        ]);

    }

    //FUNCION PARA CREAR UN AUTOR


    public function createAuthor(Request $request)
    {


        // dd($request->all()); // Muestra todos los datos enviados por el formulario
        // Validar los datos del formulario, incluyendo la imagen que n o esten vacios al enviar
        $validated = $request->validate([
            'first_name' => 'required|string|max:20',
            'middle_name' => 'nullable|string|max:20', // Cambiado 'null' a 'nullable'
            'last_name' => 'required|string|max:20',
            'description' => 'required|string|max:600',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'photo' => 'required|string|max:300',
            'twitter' => 'required|string|max:300',
            'linkedin' => 'required|string|max:300',
            'photo' => 'required|string',
        ], [
            // Mensajes de campo obligatorio 
            'first_name.required' => 'El Nombre es obligatorio.',
            'last_name.required' => 'El Apellido es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'photo.required' => 'La foto es obligatoria.',
            'twitter.required' => 'El Twitter es obligatorio.',
            'linkedin.required' => 'El LinkedIn es obligatorio.',
            'photo.required' => 'La imagen del autor  es obligatorio.',

            // Mensajes para límites de caracteres
            'first_name.max' => 'El Nombre no puede exceder los 20 caracteres.',
            'middle_name.max' => 'El Segundo Nombre no puede exceder los 20 caracteres.',
            'last_name.max' => 'El Apellido no puede exceder los 20 caracteres.',
            'description.max' => 'La descripción no puede exceder los 600 caracteres.',
            'photo.max' => 'La foto no puede exceder los 300 caracteres.',
            'twitter.max' => 'El Twitter no puede exceder los 300 caracteres.',
            'linkedin.max' => 'El LinkedIn no puede exceder los 300 caracteres.',
        ]);


        // Verifica si ya existe un autor duplicado
        $existingfirst_name = Author::where('first_name', $request->input('first_name'))->exists();
        if ($existingfirst_name) {
            return redirect()->back()->withErrors(['first_name' => 'Ya existe un autor con esos datos. Por favor, crea otro.']);
        }



        try {
            // Convierte la imagen a Base64
            // $photoBase64 = $this->convertFileToBase64($request, 'photo');
            // Crear la noticia
            Author::create([

                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'description' => $validated['description'],
                'twitter' => $validated['twitter'],
                'linkedin' => $validated['linkedin'],
                'photo' => $validated['photo'],
                'creation_date' => now(),
                'publish_date' => now(),
                'modification_date' => now(),
                // 'photo' => $this->convertFileToBase64($request),

            ]);
        } catch (\Exception $e) {



            dd($e->getMessage());
            return back()->withErrors(['error' => 'Error al crear el autor: ' . $e->getMessage()]);
        }

        // Redirigir al listado de autores
        return redirect()->route('authors.index')->with('mensaje', 'Autor  creado exitosamente');
    }



    //FUNCION PARA EDITAR


    public function editAuthor($id)
    {
        // Buscar la categoría por ID
        $authorEdit = Author::findOrFail($id);
        return view('authors.editAuthors', compact('authorEdit'));
    }


    public function updateAuthor(Request $request, $id)
    {

        // dd($request->all()); // Ver todos los datos que se están enviando

        // Validación de los datos de entrada que no se envien vacios

        $request->validate(
            [
                'first_name' => 'required|string|max:100',
                'middle_name' => 'nullable|string|max:100',
                'last_name' => 'required|string|max:100',
                'description' => 'required|string|max:600',
                'photo' => 'required|string',
                'twitter' => 'required|string|max:300',
                'linkedin' => 'required|string|max:300',
            ],
            [
                // Mensajes de campo obligatorio
                'first_name.required' => 'El Nombre es obligatorio.',
                'last_name.required' => 'El Apellido es obligatorio.',
                'description.required' => 'La descripción es obligatoria.',
                'photo.required' => 'La foto es obligatoria.',
                'twitter.required' => 'El Twitter es obligatorio.',
                'linkedin.required' => 'El LinkedIn es obligatorio.',

                // Mensajes para límites de caracteres
                'first_name.max' => 'El Nombre no puede exceder los 100 caracteres.',
                'middle_name.max' => 'El Segundo Nombre no puede exceder los 100 caracteres.',
                'last_name.max' => 'El Apellido no puede exceder los 100 caracteres.',
                'description.max' => 'La descripción no puede exceder los 600 caracteres.',
                'photo.max' => 'La foto no puede exceder los 300 caracteres.',
                'twitter.max' => 'El Twitter no puede exceder los 300 caracteres.',
                'linkedin.max' => 'El LinkedIn no puede exceder los 300 caracteres.',
            ]
        );



        // Buscar la categoría por ID
        $authorEdit = Author::findOrFail($id);
        // Actualizar el autor con los datos ya validados
        $authorEdit->update([

            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'description' => $request['description'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],
            'photo' => $request['photo'],
            'creation_date' => now(),
            'publish_date' => now(),
            'modification_date' => now(),
            // 'photo' => $this->convertFileToBase64($request),

        ]);

        return redirect()->route('authors.index')->with('mensaje', 'Datos actualizados');
    }



    //METODO PARA ELIMINAR UN AUTOR POR ID ORIGINAL
    // public function destroy($id)
    // {
    //     // Buscar la categoría por ID
    //     $autorDelete = Author::findOrFail($id);

    //     // Eliminar el autor
    //     $autorDelete->delete();

    //     // Redirigir con mensaje de éxito
    //     return redirect()->route('authors.index')->with('mensaje', 'Autor eliminado');
    // }

     //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

     public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
     {
         // Obtener solo los articles inactivos (eliminados)
         $authorDelete = Author::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados
 
         // Pasar la variable 'authorDelete' a la vista
         return view('authors.deleteRegister', compact('authorDelete'));
     }
     #...news_id
     public function destroy($news_id)
     {
         // Buscar el articles por su ID
         $authorDelete = Author::findOrFail($news_id);
 
         // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
         $authorDelete->is_active = 0;
         $authorDelete->save(); // Guardar los cambios en la base de datos
 
         // Mensaje de éxito y redirección a la lista de clientes desactivados
         return redirect()->route('authors.index')->with('mensaje', 'Noticia Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
     }
     //Funcion para restaurar un registro
     public function restoreAuthor($news_id)
     {
         // dd($news_id); // Esto detendrá la ejecución y mostrará el valor de $news_id
         // Buscar el artículo por su ID
         $authorDelete = Author::findOrFail($news_id);
 
 
         // Verifica si se está recuperando correctamente
         // dd($authorDelete); // Esto te mostrará los detalles del artículo y te ayudará a verificar
 
         // Verificar si el Formulario está inactivo
         if ($authorDelete->is_active == 0) {
             // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
             $authorDelete->is_active = 1;
             $authorDelete->save(); // Guardar los cambios en la base de datos
 
             // Mensaje de éxito y redirección a la lista de Formulario activos
             return redirect()->route('authors.index')->with('mensaje', 'Autor Restaurado Con Éxito');
         } else {
             // Si ya está activo, redirigir con un mensaje
             return redirect()->route('authors.index')->with('mensaje', 'El Autor ya está restaurado.');
         }
     }
}
