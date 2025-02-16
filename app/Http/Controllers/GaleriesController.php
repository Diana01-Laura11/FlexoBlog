<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeries;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Forms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class GaleriesController extends Controller
{

    // public function index()ESSTE ES ORIGINAL TUYO SERGIO
    // {

    //     // Pasar las galerias a la vista mapeamos con la variable $galeries
    //     // Obtener todas las galerias
    //     $galleries = Galeries::all();

    //     // Pasar las galerias a la vista mapeamos con la variable $variables
    //     return view('galeries.index', compact('galleries'));
    // }


    #AGREGADO DE MARCO 
    //AQUI MUESTRA LAS GALLERIAS ASOCIADAS A ESE USUARIO CON ESE CLIENTE UTILIZANDO JOIN
    //#NOTA DESCOMENTA ESTE Y COMENTA EL TUYO CUUANDO HAYAS TERMINADO
    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene un cliente asociado
        if ($authUser && $authUser->customers->isNotEmpty()) {
            $customer = $authUser->customers->first(); // Obtener el primer cliente

            // Obtener solo las noticias asociadas a ese cliente y que estén activas
            $galleries = Galeries::whereHas('customers', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            })->where('is_active', true)->paginate(11);
        } else {
            // Si el usuario no tiene cliente, devolver una colección vacía
            $galleries = collect();
        }

        return view('galeries.index', compact('galleries'));
    }




    public function create()
    {
        $form = Forms::where('is_active', true)->get(); // Obtiene todas los formularios no eliminadas
        // $form = Forms::all(); //Obtiene todos los formularios de la db

        return view('galeries.create', compact('form'));
    }

    // FUNCION PARA IMAGENES

    public function showImages(Request $request)
    {
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


    public function saveGalleries(Request $request)
    {

        // Validar datos del formulario
        //dd($request->all()); // Muestra todos los datos enviados por el formulario
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:70',
                'status' => 'required|in:Published,Unpublished',
                'content' => 'nullable|string',
                'publish_date' => 'nullable|date',
                'creation_date' => now(),
                'modification_date' => now(),
                'tool' => 'nullable|string',
                'link' => 'nullable|url',
                'new_window' => 'nullable|boolean',
                'microdata' => 'nullable|array',
                'metadata' => 'nullable|array',
                'forms' => 'nullable|array',
                'related_galleries' => 'nullable|array',
                'banners' => 'nullable|string',
                //Imagenes
                'images' => 'nullable|array',

                'testimonials' => 'nullable|array',
                'testimonials.*.name' => 'required|string|max:100',
                'testimonials.*.testimonio' => 'required|string|max:250',
                'testimonials.*.cargo' => 'nullable|string|max:50',
                'testimonials.*.empresa' => 'nullable|string|max:100',

                /*'usuario_id' => 'nullable|exists:users,id',
        'usuario_id' => 'nullable|exists:users,id',

        'usuario_id' => 'nullable|exists:users,id',
        */
            ],
            [
                // Mensajes de campo obligatorio
                'title.required' => 'El título es obligatorio.',
                'title.max' => 'El título no puede superar los 70 caracteres.',

                'content.required' => 'El contenido es obligatorio.',

                'publish_date.date' => 'La fecha de publicación debe ser una fecha válida.',

                'imagenes.array' => 'Debes seleccionar al menos una imagen.',

                'banner.string' => 'El banner debe ser una cadena de caracteres.',
                'banner_link.url' => 'El link del banner debe ser una URL válida.',

                'formularios.array' => 'Debes seleccionar al menos un formulario.',

                'ogdata.array' => 'El OGdata es obligatorio.',

                'metadata.array' => 'Las plabras claves son obligatorias.',

                'testimonials.*.name.required' => 'El nombre del testimonial es obligatorio.',
                'testimonials.*.name.max' => 'El nombre del testimonial no puede superar los 100 caracteres.',
                'testimonials.*.testimonio.required' => 'El testimonial es obligatorio.',
                'testimonials.*.testimonio.max' => 'El testimonial no puede superar los 250 caracteres.',
                'testimonials.*.cargo.max' => 'El cargo del testimonial no puede superar los 50 caracteres.',
                'testimonials.*.empresa.max' => 'La empresa del testimonial no puede superar los 100 caracteres.',

            ]
        );

        // Verifica si ya existe un título duplicado
        $existingTitle = Galeries::where('title', $request->input('title'))->exists();
        if ($existingTitle) {
            return redirect()->back()->withErrors(['title' => 'Ya existe una promocion con esos datos. Por favor, crea otro.']);
        }

        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';

        $alias = Str::slug($request->input('title'));
        $counter = 1;
        while (Galeries::where('alias', $alias)->exists()) {
            $alias = Str::slug($request->input('title')) . '-' . $counter++;
        }



        $gallery =  galeries::create([
            'title' => $request->input('title'),
            'alias' => $alias,
            'status' => $status,
            'content' => $request->input('content'),
            'testimonials' => $request->input('testimonials'),
            'publish_date' => $request->input('publish_date'),
            'creation_date' => now(),
            'modification_date' => now(),
            'tool' => $request->input('tool'),
            'link' => $request->input('link'),
            'new_window' => $request->input('new_window'),
            'images' => $request->input('images'),
            'microdata' => $request->input('microdata'),
            'metadata' => $request->input('metadata'),
            'ogdata' => $request->input('ogdata'),
            'related_galleries' => $request->input('related_galleries'),
            'banners' => $request->input('banners'),
            'form_id' => $request->input('form_id'),
        ]);

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

        // Asignar la promoción al cliente en la tabla intermedia 'customer_galleries'
        DB::table('customer_galleries')->insert([
            'customer_id' => $customerId,
            'gallery_id' => $gallery->gallery_id, // Usar el ID de la promoción recién creada
            'assigned_at' => now(),
        ]);



        // Redirigir al listado de galerías con un mensaje de éxito
        return redirect()->route('galeries.index')->with('success', 'Galería creada exitosamente.');
    }

    //FUNCION PARA EDITAR VALIDAR Y ACTUALIZAR
    public function editGaleries(Request $gallery_id)
    {
        // Encuentra la galeria por su ID la variable gallerieEdit se encargara de setar los valores tanto en back y front
        $galleryEdit = Galeries::findOrFail($gallery_id);
        $formEdit = Forms::where('is_active', true)->get(); // Obtiene todas los formularios con filtrado de no eliminados solo activos
        // $formEdit = Forms::all(); // <---- Obtener todos los formularios disponibles Y MANTENLO EN ESTA VARIABLE

        // Depurar la promoción encontrada
        // dd($galleryEdit);



        return view('galeries.edit');
    }

    public function updateGalleries(Request $request, $gallery_id)
    {

        // Validar datos del formulario
        //dd($request->all()); // Muestra todos los datos enviados por el formulario
        $validatedData = $request->validate(
            [
                'title' => 'string|max:70',
                'status' => 'in:Published,Unpublished',
                'content' => 'string',
                'publish_date' => 'nullable|date',
                'creation_date' => now(),
                'modification_date' => now(),
                'tool' => 'nullable|string',
                'link' => 'nullable|url',
                'new_window' => 'nullable|boolean',
                'microdata' => 'nullable|array',
                'metadata' => 'nullable|array',
                'forms' => 'nullable|array',
                'related_galleries' => 'nullable|array',
                'banners' => 'nullable|string',
                //Imagenes
                'images' => 'nullable|array',

                'testimonials' => 'nullable|array',
                'testimonials.*.name' => 'string|max:100',
                'testimonials.*.testimonio' => 'string|max:250',
                'testimonials.*.cargo' => 'nullable|string|max:50',
                'testimonials.*.empresa' => 'nullable|string|max:100',

                /*'usuario_id' => 'nullable|exists:users,id',
        */
            ],
            [
                'title.max' => 'El título no puede superar los 70 caracteres.',

                'publish_date.date' => 'La fecha de publicación debe ser una fecha válida.',

                'banner.string' => 'El banner debe ser una cadena de caracteres.',

                'banner_link.url' => 'El link del banner debe ser una URL válida.',

            ]
        );

        $galleryEdit = Galeries::findOrFail($gallery_id);
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));

        $galleryEdit::update([
            'title' => $request->input('title'),
            'alias' => $alias,
            'status' => $status,
            'content' => $request->input('content'),
            'testimonials' => $request->input('testimonials'),
            'publish_date' => $request->input('publish_date'),
            'creation_date' => now(),
            'modification_date' => now(),
            'tool' => $request->input('tool'),
            'link' => $request->input('link'),
            'new_window' => $request->input('new_window'),
            'images' => $request->input('images'),
            'microdata' => $request->input('microdata'),
            'metadata' => $request->input('metadata'),
            'ogdata' => $request->input('ogdata'),
            'forms' => $request->input('forms'),
            'related_galleries' => $request->input('related_galleries'),
            'banners' => $request->input('banners'),
            'form_id' => $validatedData['form_id'],
        ]);

        //ACTUALIZAR CON REGISTROS DE TABLA INTERMEDIA

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

        // Verificar si ya existe la asignación de la galeria  al cliente
        $existingAssignment = DB::table('customer_galleries')
            ->where('customer_id', $customerId)
            ->where('gallery_id', $galleryEdit->gallery_id)
            ->first();

        if (!$existingAssignment) {
            DB::table('customer_galleries')->insert([
                'customer_id' => $customerId,
                'gallery_id' => $galleryEdit->gallery_id,
                //    'assigned_at' => now()
            ]);
        }


        return redirect()->route('galeries.index')->with('mensaje', 'Galeria actualizada exitosamente');
    }

    //FUNCION DE DELETE promocion POR ID

    // public function deleteGalerie($gallery_id)ORIGINAL
    // {
    //     // dd($promotion_id);  // Esto imprimirá el ID y detendrá la ejecución
    //     // Buscara  la promocion por su ID
    //     $deleteGalleries = Galeries::find($gallery_id);

    //     // Eliminar la categoría
    //     $deleteGalleries->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('galeries.index')->with('mensaje', 'Promocion eliminada');
    // }

    //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

    public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
    {
        // Obtener solo las galeras inactivos (eliminados)
        $galleryDelete = Galeries::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'galleryDelete' a la vista
        return view('galeries.deleteRegister', compact('galleryDelete'));
    }
    #...gallery_id
    public function destroy($gallery_id)
    {
        // Buscar el articles por su ID
        $galleryDelete = Galeries::findOrFail($gallery_id);

        // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
        $galleryDelete->is_active = 0;
        $galleryDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('galeries.index')->with('mensaje', 'Galeria Eliminada Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    public function restoreGallery($gallery_id)
    {
        // dd($gallery_id); // Esto detendrá la ejecución y mostrará el valor de $gallery_id
        // Buscar el artículo por su ID
        $galleryDelete = Galeries::findOrFail($gallery_id);


        // Verifica si se está recuperando correctamente
        // dd($galleryDelete); // Esto te mostrará los detalles del Galeria y te ayudará a verificar

        // Verificar si el Formulario está inactivo
        if ($galleryDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $galleryDelete->is_active = 1;
            $galleryDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de Galeria activos
            return redirect()->route('galeries.index')->with('mensaje', 'Galeria Restaurada Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('galeries.index')->with('mensaje', 'La Galeria ya está restaurada.');
        }
    }















































    //FUCION  PARA MOSTRAR EL CONTENIDO DE UNA VISTA PREVIA
    public function preview($gallery_id)
    {

        $galleriesPreview = Galeries::find($gallery_id);

        // Verificar si se encontró el artículo
        if (!$galleriesPreview) {
            // Si no se encontró, devolver un mensaje adecuado
            return response()->json(['error' => 'No se encontró el ID de la Galeria'], 404);
        }

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($galleriesPreview->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array

        // Reemplazar el marcador en el contenido del artículo con el nombre del formulario
        if ($form) {
            $galleriesPreview->content = str_replace("$/id:{$form->form_id}/$", $form->title, $galleriesPreview->content);
        }

        // Pasar el artículo, formulario y el contenido del formulario a la vista
        return view('galeries.preview', compact('galleriesPreview', 'form', 'formContent'));
    }


    public function searchGaleries(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json(['message' => 'Por favor ingresa un título de la galeria.'], 400);
        }

        $galeries = Galeries::where('title', 'like', '%' . $query . '%')
            ->where('status', 'Published')
            ->get();

        return response()->json($galeries);
    }

    //FUNCION PARA MOSTRAR VISTA FINAL
    // public function viewWeb($gallery_id, $alias)
    // {
    //     // Obtener el artículo publicado con el alias
    //     $viewFinalWeb = Galeries::where('alias', $alias)
    //         ->where('status', 'Published')
    //         ->first();

    //     if (!$viewFinalWeb) {
    //         return redirect()->route('galeries.index')->with('error', 'Galeria no publicada');
    //     }

    //     // Decodificar los datos JSON
    //     $og_data = json_decode($viewFinalWeb->og_data, true);
    //     $metadata = json_decode($viewFinalWeb->metadata, true);
    //     $microdata = json_decode($viewFinalWeb->microdata, true);

    //     // Asegurarse de que las variables sean arrays válidos
    //     $og_data = (is_array($og_data)) ? $og_data : [];
    //     $metadata = (is_array($metadata)) ? $metadata : [];
    //     $microdata = (is_array($microdata)) ? $microdata : [];

    //     // Obtener las publicaciones relacionadas, excluyendo la actual
    //     $publishedGaleries = Galeries::where('status', 'Published')
    //         ->where('gallery_id', '!=', $viewFinalWeb->gallery_id)
    //         ->take(3) // Limitar a 3 artículos
    //         ->get();

    //     // Obtener el formulario relacionado al artículo
    //     $form = Forms::find($viewFinalWeb->form_id); // Asegúrate que el nombre del modelo es "Form"

    //     // Si existe el formulario, reemplazar el marcador en el contenido del artículo
    //     if ($form) {
    //         $viewFinalWeb->content = str_replace("$/id:{$form->form_id}/$", $form->titlee, $viewFinalWeb->content);
    //     }
    //     $formContent = $form ? json_decode($form->content, true) : null;


    //     // Muestra los datos del formulario para revisar su estructura
    //     // dd($formContent);

    //     return view('galeries.viewOnWeb', compact('viewFinalWeb', 'metadata', 'og_data', 'microdata', 'publishedgalleriess','formContent'));
    // }
}
