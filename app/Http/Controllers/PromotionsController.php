<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promotions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Metadata\Metadata;
use App\Models\Forms;

use app\utils\utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



class PromotionsController extends Controller
{
    // public function index() ORIGINAL
    // {
    //     // Obtener solo las promociones activas no eliminadas
    //     $promotions = Promotions::where('is_active', true)->paginate(11);

    //     // Pasar las promociones a la vista mapeamos con la variable $promotions
    //     return view('promotions.index', compact('promotions'));
    // }

    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene un cliente asociado
        if ($authUser && $authUser->customers->isNotEmpty()) {
            $customer = $authUser->customers->first(); // Obtener el primer cliente

            // Obtener solo las noticias asociadas a ese cliente y que estén activas
            $promotions = Promotions::whereHas('customers', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            })->where('is_active', true)->paginate(11);
        } else {
            // Si el usuario no tiene cliente, devolver una colección vacía
            $promotions = collect();
        }

        return view('promotions.index', compact('promotions'));
    }


    public function create()
    {
        // $form = Forms::all(); //Obtiene todos los formularios de la db
        $form = Forms::where('is_active', true)->get(); //OBTIENE SOLO LOS FORMULARIOS ACTIVOS QUE NO ESTAN ELIMINADOS

        return view('promotions.create', compact('form'));
        // return view('promotions.create');
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

    public function savePromotion(Request $request)
    {
        //  dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        //VALIDAMOS LOS CAMPOS QUE  CADA CAMPO AL INSERTAR DATSOS NO SE ENVIEN DE MANERA VACIA, QUE LAS FECHAS SEAN VALIDAS Y QUE NO EXISTAN DUPLICADOS 
        $validated = $request->validate([

            'title' => 'required|string|max:70',
            'subtitle' => 'required|string|max:120',
            'content' => 'required|string',
            'status' => 'required|in:Published,Unpublished',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', //Asegura que end_date sea igual o posterior a start_date, lógico para rangos de fechas.
            'terms' => 'required|string',
            'link.name' => 'required|string|max:200',
            'link.link' => 'required|string|max:200',
            'extras.extras' => 'required|string|max:200',
            'metadata.descripcion' => 'required|string|max:200',
            'metadata.metakey' => 'required|string|max:200',
            'microdata.title' => 'required|string|max:200',
            'microdata.description' => 'required|string|max:200',
            // Imagnes
            'principal_Image' => 'required|string',
            'secondary_Image' => 'required|string',
            'mini_Image' => 'required|string',
            'banners' => 'required|string',
            //Hacemos validacion del join
            'form_id' => 'required|integer|exists:forms,form_id',


            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 70 caracteres.',

            'subtitle.required' => 'El subtítulo es obligatorio.',
            'subtitle.max' => 'El subtítulo no puede exceder los 120 caracteres.',

            'content.required' => 'El contenido es obligatorio.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser válida.',

            'end_date.required' => 'La fecha de finalización es obligatoria.',
            'end_date.date' => 'La fecha de finalización debe ser válida.',
            'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',

            'terms.required' => 'Los términos o condiciones son obligatorios.',

            'link.name.required' => 'El nombre del enlace o herramienta es obligatorio.',
            'link.name.max' => 'El nombre del enlace o herramienta no puede exceder los 200 caracteres.',

            'link.link.required' => 'El enlace es obligatorio.',
            'link.link.max' => 'El enlace no puede exceder los 200 caracteres.',

            'extras.extras.required' => 'El campo de extras es obligatorio.',
            'extras.extras.max' => 'El campo de extras no puede exceder los 200 caracteres.',

            'metadata.descripcion.required' => 'La descripción es obligatoria.',
            'metadata.descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',

            'metadata.metakey.required' => 'Las palabras clave son obligatorias.',
            'metadata.metakey.max' => 'Las palabras clave no pueden exceder los 200 caracteres.',

            'microdata.title.required' => 'El título de microdatos es obligatorio.',
            'microdata.title.max' => 'El título de microdatos no puede exceder los 200 caracteres.',

            'microdata.description.required' => 'La descripción de microdatos es obligatoria.',
            'microdata.description.max' => 'La descripción de microdatos no puede exceder los 200 caracteres.',

            'principal_Image.required' => 'El Imagen principal es obligatorio.',
            'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
            'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
            'banners.required' => 'Los Banners es obligatorio.',
            'form_id.required' => 'El formulario  es obligatorio.',

        ]);


        // Verifica si ya existe un título duplicado
        $existingTitle = Promotions::where('title', $request->input('title'))->exists();
        if ($existingTitle) {
            return redirect()->back()->withErrors(['title' => 'Ya existe una promocion con esos datos. Por favor, crea otro.']);
        }

        //VALIDAR QUE LAS FECHAS SEAN CORRECTAS Y NO PERMITIR FECHAS ATRASADAS AL FORMATO ESTABLERCIDO
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        if ($endDate < $startDate) {
            // Si la fecha de fin es menor que la fecha de inicio, redirigir con un mensaje de error
            return redirect()->route('promotions.create') //redirecciona al create de nuevo
                ->with('error', 'Error: La fecha de fin no puede ser anterior a la fecha de inicio.');
        }

        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));

        // AQUI SI CREA LA PROMOCION 
        // promotions::create([
        //     'title' => $validated['title'],
        //     'alias' => $alias,
        //     'subtitle' => $validated['subtitle'],
        //     'content' => $validated['content'],
        //     'principal_Image' => $validated['principal_Image'],
        //     'secondary_Image' => $validated['secondary_Image'],
        //     'mini_Image' => $validated['mini_Image'],
        //     'banners' => $validated['banners'],
        //     'status' => $status,
        //     'start_date' => $validated['start_date'],
        //     'end_date' => $validated['end_date'],
        //     'terms' => $validated['terms'] ?? null,
        //     'extras' => convertArrayToJson($validated['extras']),
        //     'link' => convertArrayToJson($validated['link']),
        //     'metadata' => convertArrayToJson($validated['metadata']),
        //     'microdata' => convertArrayToJson($validated['microdata']),
        //     //Creamos con el join
        //     'form_id' => $validated['form_id'],

        // ]);

        // Crear la promoción con el modelo de Eloquent
        $promotion = Promotions::create([
            'title' => $validated['title'],
            'alias' => $alias,
            'subtitle' => $validated['subtitle'],
            'content' => $validated['content'],
            'principal_Image' => $validated['principal_Image'],
            'secondary_Image' => $validated['secondary_Image'],
            'mini_Image' => $validated['mini_Image'],
            'banners' => $validated['banners'],
            'status' => $status,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'terms' => $validated['terms'] ?? null,
            'extras' => convertArrayToJson($validated['extras']),
            'link' => convertArrayToJson($validated['link']),
            'metadata' => convertArrayToJson($validated['metadata']),
            'microdata' => convertArrayToJson($validated['microdata']),
            // Creamos con el join
            'form_id' => $validated['form_id'],
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

        // Asignar la promoción al cliente en la tabla intermedia 'customer_promotions'
        DB::table('customer_promotions')->insert([
            'customer_id' => $customerId,
            'promotion_id' => $promotion->promotion_id, // Usar el ID de la promoción recién creada
            'assigned_at' => now(),
        ]);



        // Redirigir al listado de noticias
        return redirect()->route('promotions.index')->with('mensaje', 'Promocion creada exitosamente');
    }





    //FUNCION PARA EDITAR VALIDAR Y ACTUALIZAR

    public function editPromotion($promotion_id)
    {
        // Encuentra promocion por su ID la variable promotionEdit se encargara de setar los valores tanto en back y front
        $promotionEdit = Promotions::findOrFail($promotion_id);
        $formEdit = Forms::where('is_active', true)->get(); //TRAE SOLO LOS FORMULARIO QUE ESTA ACTIVOS Y NO HAN SIDO BORRADOS

        // $formEdit = Forms::all(); // <---- Obtener todos los formularios disponibles Y MANTENLO EN ESTA VARIABLE

        // Depurar la promoción encontrada
        // dd($promotionEdit);

        // Decodificar los campos JSON correctamente
        $extras = json_decode($promotionEdit->extras);
        $link = json_decode($promotionEdit->link);
        $metadata = json_decode($promotionEdit->metadata);
        $microdata = json_decode($promotionEdit->microdata);
        // Asegúra que se formate las fechas correctamente (Uso de Carbon)
        $start_date = $promotionEdit->start_date ? $promotionEdit->start_date->format('Y-m-d') : null;
        $end_date = $promotionEdit->end_date ? $promotionEdit->end_date->format('Y-m-d') : null;


        return view('promotions.edit', compact('promotionEdit', 'metadata', 'microdata', 'extras', 'link', 'formEdit'));
    }

    public function updatePromotion(Request $request, $promotion_id)
    {
        // dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        //Validacion de datos de entrada
        $validated = $request->validate([

            'title' => 'required|string|max:70',
            'subtitle' => 'required|string|max:120',
            'content' => 'required|string',
            'status' => 'required|in:Published,Unpublished',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', //Asegura que end_date sea igual o posterior a start_date, lógico para rangos de fechas.
            'terms' => 'required|string',
            'link.name' => 'required|string|max:200',
            'link.link' => 'required|string|max:200',
            'extras.extras' => 'required|string|max:200',
            'metadata.descripcion' => 'required|string|max:200',
            'metadata.metakey' => 'required|string|max:200',
            'microdata.title' => 'required|string|max:200',
            'microdata.description' => 'required|string|max:200',
            // IMAGENES:
            'principal_Image' => 'required|string',
            'secondary_Image' => 'required|string',
            'mini_Image' => 'required|string',
            'banners' => 'required|string',
            //JOIN VALIDACION
            'form_id' => 'required|integer|exists:forms,form_id',


            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 70 caracteres.',

            'subtitle.required' => 'El subtítulo es obligatorio.',
            'subtitle.max' => 'El subtítulo no puede exceder los 120 caracteres.',

            'content.required' => 'El contenido es obligatorio.',

            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'start_date.date' => 'La fecha de inicio debe ser válida.',

            'end_date.required' => 'La fecha de finalización es obligatoria.',
            'end_date.date' => 'La fecha de finalización debe ser válida.',
            'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',

            'terms.required' => 'Los términos o condiciones son obligatorios.',

            'link.name.required' => 'El nombre del enlace o herramienta es obligatorio.',
            'link.name.max' => 'El nombre del enlace no puede exceder los 200 caracteres.',

            'link.link.required' => 'El enlace es obligatorio.',
            'link.link.max' => 'El enlace no puede exceder los 200 caracteres.',

            'extras.extras.required' => 'El campo de extras es obligatorio.',
            'extras.extras.max' => 'El campo de extras no puede exceder los 200 caracteres.',

            'metadata.descripcion.required' => 'La descripción es obligatoria.',
            'metadata.descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',

            'metadata.metakey.required' => 'Las palabras clave son obligatorias.',
            'metadata.metakey.max' => 'Las palabras clave no pueden exceder los 200 caracteres.',

            'microdata.title.required' => 'El título de microdatos es obligatorio.',
            'microdata.title.max' => 'El título de microdatos no puede exceder los 200 caracteres.',

            'microdata.description.required' => 'La descripción de microdatos es obligatoria.',
            'microdata.description.max' => 'La descripción de microdatos no puede exceder los 200 caracteres.',

            'principal_Image.required' => 'El Imagen principal es obligatorio.',
            'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
            'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
            'banners.required' => 'Los Banners es obligatorio.',

            'form_id.required' => 'El formulario  es obligatorio.',

        ]);




        $promotionEdit = Promotions::findOrFail($promotion_id);
        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));
        // Actualiza la promocion
        $promotionEdit->update([
            'title' => $validated['title'],
            'alias' => $alias,
            'subtitle' => $validated['subtitle'],
            'content' => $validated['content'],
            'principal_Image' => $validated['principal_Image'],
            'secondary_Image' => $validated['secondary_Image'],
            'mini_Image' => $validated['mini_Image'],
            'banners' => $validated['banners'],
            'status' => $status,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'terms' => $validated['terms'] ?? null,
            'extras' => convertArrayToJson($validated['extras']),
            'link' => convertArrayToJson($validated['link']),
            'metadata' => convertArrayToJson($validated['metadata']),
            'microdata' => convertArrayToJson($validated['microdata']),
            //cREAMOS FORMULARIO CON EL JOIN
            'form_id' => $request['form_id'],

        ]);

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
        $existingAssignment = DB::table('customer_promotions')
            ->where('customer_id', $customerId)
            ->where('promotion_id', $promotionEdit->promotion_id)
            ->first();

        if (!$existingAssignment) {
            DB::table('customer_promotions')->insert([
                'customer_id' => $customerId,
                'promotion_id' => $promotionEdit->promotion_id,
                'assigned_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Redirigir al listado de noticias
        return redirect()->route('promotions.index')->with('mensaje', 'Promocion actualizada exitosamente');
    }





    //FUNCION DE DELETE promocion POR ID

    // public function deletePromotion($promotion_id)ORIGINAL
    // {
    //     // dd($promotion_id);  // Esto imprimirá el ID y detendrá la ejecución
    //     // Buscara  la promocion por su ID
    //     $promotions = Promotions::findOrFail($promotion_id);

    //     // Eliminar la categoría
    //     $promotions->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('promotions.index')->with('mensaje', 'Promocion eliminada');
    // }




    //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

    public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
    {
        // Obtener solo los articles inactivos (eliminados)
        $promotionDelete = Promotions::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'promotionDelete' a la vista
        return view('Promotions.deleteRegister', compact('promotionDelete'));
    }
    #...promotion_id
    public function destroy($promotion_id)
    {
        // Buscar el articles por su ID
        $promotionDelete = Promotions::findOrFail($promotion_id);

        // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
        $promotionDelete->is_active = 0;
        $promotionDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('promotions.index')->with('mensaje', 'Promoción Eliminada Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    public function restorePromotion($promotion_id)
    {
        // dd($promotion_id); // Esto detendrá la ejecución y mostrará el valor de $promotion_id
        // Buscar el artículo por su ID
        $promotionDelete = Promotions::findOrFail($promotion_id);


        // Verifica si se está recuperando correctamente
        // dd($promotionDelete); // Esto te mostrará los detalles del artículo y te ayudará a verificar

        // Verificar si el Formulario está inactivo
        if ($promotionDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $promotionDelete->is_active = 1;
            $promotionDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de Promociónes activos
            return redirect()->route('promotions.index')->with('mensaje', 'Promoción Restaurado Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('promotions.index')->with('mensaje', 'La Promoción ya está restaurada.');
        }
    }
































    //FUNCION PARA MOSTRAR UNA VENTANA EMERGENTE DE LA OPCION DE VISTA EN WEB

    // public function preview($promotion_id)
    // {
    //     // Intentar encontrar la promoción con el ID proporcionado
    //     $promotionsPreview = Promotions::find($promotion_id);

    //     // Verificar si se encontró la promoción
    //     if (!$promotionsPreview) {
    //         // Si no se encontró, devolver un mensaje adecuado
    //         return response()->json(['error' => 'No se encontró la promoción con el ID especificado.'], 404);
    //     }

    //     // Si se encontró, pasar el modelo a la vista
    //     return view('promotions.preview', compact('promotionsPreview'));
    // }


    public function preview($promotion_id)
    {

        // Intentar encontrar el artículo con el ID proporcionado
        $promotionPreview = Promotions::find($promotion_id);

        // Verificar si se encontró el artículo
        if (!$promotionPreview) {
            // Si no se encontró, devolver un mensaje adecuado
            return response()->json(['error' => 'No se encontró la promoción con el ID especificado.'], 404);
        }

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($promotionPreview->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array

        // Reemplazar el marcador en el contenido del artículo con el nombre del formulario
        if ($form) {
            $promotionPreview->content = str_replace("$/id:{$form->form_id}/$", $form->title, $promotionPreview->content);
        }

        // Pasar el artículo, formulario y el contenido del formulario a la vista
        return view('promotions.preview', compact('promotionPreview', 'form', 'formContent'));
    }


    public function searchPromotions(Request $request)
    {
        // Obtener el término de búsqueda desde el parámetro 'query'
        $query = $request->input('query');

        // Verificar si hay un término de búsqueda
        if (empty($query)) {
            return response()->json(['message' => 'Por favor ingresa un título de promoción.'], 400);
        }

        // Buscar promociones que contengan el término en el título
        $promotions = Promotions::where('title', 'like', '%' . $query . '%')
            ->where('status', 'Published')  // Solo las noticias publicadas
            ->get();

        return response()->json($promotions);
    }





    // public function previewFinalWeb($promotion_id, $alias, Request $request)
    public function previewFinalWeb($promotion_id, $alias,)
    {
        $previewFinalWeb = Promotions::where('alias', $alias)
            ->where('status', 'Published')
            ->first();

        if (!$previewFinalWeb) {
            return redirect()->route('promotions.index')->with('error', 'Promocion no encontrada No Publicada');
        }

        // Decodificar los datos JSON
        $extras = json_decode($previewFinalWeb->extras, true);
        $link = json_decode($previewFinalWeb->link, true);
        $metadata = json_decode($previewFinalWeb->metadata, true);
        $microdata = json_decode($previewFinalWeb->microdata, true);

        // Asegurarse de que las variables sean arrays válidos
        $ogdata = (is_array($extras)) ? $extras : [];
        $metadata = (is_array($metadata)) ? $metadata : [];
        $microdata = (is_array($microdata)) ? $microdata : [];

        // Obtener todas las promociones asociadas excluyendo la que ya esta mostrando
        $publishedPromotions = Promotions::where('status', 'Published')
            ->where('promotion_id', '!=', $promotion_id)
            // ->orderBy('created_at', 'desc')
            ->take(3) // Limitar a 3 promociones
            ->get();
        // Obtener el formulario relacionado al artículo
        $form = Forms::find($previewFinalWeb->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array
        if ($form) {
            $previewFinalWeb->content = str_replace("$/id:{$form->form_id}/$", $form->titleE, $previewFinalWeb->content);
        }

        // Mostrar promociones próximamente, es decir, que todavía no se estrenan
        $futurePromotions = Promotions::where('start_date', '>', now())
            ->orderBy('start_date', 'asc') // Ordenar por fecha de inicio más cercana
            ->take(10) // Limitar a 3 promociones futuras
            ->get();





        // Capturar el término de búsqueda desde la solicitud (query)
        // $query = $request->input('query');

        // // Buscar promociones que contengan el término en el título y que estén publicadas
        // $searchPromotions = Promotions::where('title', 'like', '%' . $query . '%')
        //     ->where('status', 'Published')
        //     ->get();


        // Obtener el término de búsqueda desde el parámetro 'query'


        // Pasar los datos decodificados a la vista
        return view('promotions.previewFinalWeb', compact('previewFinalWeb', 'extras', 'link', 'metadata', 'microdata', 'publishedPromotions', 'futurePromotions', 'formContent'));
    }
}
