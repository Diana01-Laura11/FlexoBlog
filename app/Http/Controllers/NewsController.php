<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsNotice;
use App\Models\Forms;
use Illuminate\Support\Str;  // de importar Str
use App\Models\NewsNoticeContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\app\utils\utils;
use App\Models\Author;
use App\Models\Galeries;
use App\Models\Article;
use App\Models\Clients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


//todo: cambiar el nombre de la clase
class NewsController extends Controller
{

    //todo: revisar el nombre del metodo
    // public function index()
    // {
    //     // Recuperar  las noticias QUE SOLO ESTEN ACTIVAS
    //     //Para que se muestren todas las noticias sin límite en la paginación,
    //     $new_notice = NewsNotice::where('is_active', true)->paginate(11);
    //     return view('news.index', compact('new_notice'));
    // }
    // public function index($customerId = null)
    // {
    //     if ($customerId) {
    //         // Si hay un cliente, filtrar sus noticias
    //         $customer = Clients::findOrFail($customerId);
    //         $new_notice = $customer->newsNotices()->paginate(11);
    //     } else {
    //         // Si no hay cliente, mostrar todas las noticias activas
    //         $new_notice = NewsNotice::where('is_active', true)->paginate(11);
    //     }

    //     return view('news.index', compact('new_notice'));
    // }

    //Para mostrar solo las noticias asociadas al cliente del usuario autenticado, SE filtraN las noticias según la relación en la base de datos.
    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene un cliente asociado
        if ($authUser && $authUser->customers->isNotEmpty()) {
            $customer = $authUser->customers->first(); // Obtener el primer cliente

            // Obtener solo las noticias asociadas a ese cliente y que estén activas
            $new_notice = NewsNotice::whereHas('customers', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            })->where('is_active', true)->paginate(11);
        } else {
            // Si el usuario no tiene cliente, devolver una colección vacía
            $new_notice = collect();
        }

        return view('news.index', compact('new_notice'));
    }







    // todo: crear que? te lleva a un a view 
    public function create()
    {
        //TRAEMOS OBTENEMOS LOS  FORMULARIOS EXISTENTES

        // $forms = Forms::all();
        $form = Forms::where('is_active', true)->get(); //Obtiene todos los formularios de la db siempre y cuando esten activos no eliminados

        // dd($forms);
        // Obtener todos los autores
        // $authors = Author::all(); // Obtiene todos los autores
        $authors = Author::where('is_active', true)->get(); //Obtiene todos los autores de la db siempre y cuando esten activos no eliminados
        // Renderiza la vista para crear una noticia
        // return view('news.create-news');
        return view('news.create-news', compact('form', 'authors'));
    }

    //CREAMOS LA FUNCION PRIVADA PARA CONVERTIR EL STRING A JSON


    // Función privada para generar el JSON del autor
    private function createAuthorContentJson($validated)
    {
        // Asegúrate de que 'description' tenga un valor predeterminado si está vacío
        // Asegúrate de que 'description' y 'authorContent' tengan un valor predeterminado si están vacíos
        $authorContent = $validated['authorContent'] ?? 'Contenido no proporcionado';
        $description = $validated['description'] ?? 'Descripción no proporcionada';

        // Extrae otros datos de la validación
        $id_author = $validated['id_author'];
        $first_name = $validated['first_name'];
        $last_name = $validated['last_name'];
        $middle_name = $validated['middle_name'];
        $description = $validated['description'];  // Este valor es redundante en este caso, lo puedes omitir si no lo vas a usar.
        $twitter = $validated['twitter'];
        $linkedin = $validated['linkedin'];
        $photo = $validated['photo'];

        // Convertir el contenido a JSON
        $authorContentJson = json_encode([
            // return json_encode([
            'id_author' => $id_author,
            'authorContent' => $authorContent,
            'description' => $description,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'middle_name' => $middle_name,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'photo' => $photo,
            'timestamp' => now(),
        ]);

        // Retornar el JSON generado
        return $authorContentJson;
        // // Mostrar el JSON convertido
        // dd($authorContentJson);
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


    public function store(Request $request)
    {



        // dd($request->all()); // Muestra todos los datos enviados por el formulario
        // Validar los datos del formulario, incluyendo la imagen que n o esten vacios al enviar
        $validated = $request->validate([

            'title' => 'required|string|max:70',
            'content' => 'required|string',
            'metadata.descripcion' => 'required|string|max:200',
            'metadata.metakey' => 'required|string|max:200',
            'ogdata.ogtitle' => 'required|string|max:200',
            'ogdata.ogdescription' => 'required|string|max:200',
            'microdata.title' => 'required|string|max:200',
            'microdata.description' => 'required|string|max:200',
            'publish_date' => 'required|date',

            'principal_Image' => 'required|string',
            'secondary_Image' => 'required|string',
            'mini_Image' => 'required|string',
            'banners' => 'required|string',
            //Join valiacion
            'form_id' => 'required|integer|exists:forms,form_id',
            'author_id' => 'required|integer|exists:authors,id_author', // Asegura que el autor existe



        ],  [
            'title.required' => 'El título es obligatorio.',
            'content.required' => 'El contenido no puede estar vacío.',
            'metadata.descripcion.required' => 'La descripción no puede estar vacía.',
            'metadata.metakey.required' => 'Palabras clave no puede estar vacía.',
            'ogdata.ogtitle.required' => 'El título de ogdata no puede estar vacío.',
            'ogdata.ogdescription.required' => 'La descripción de ogdata no puede estar vacía.',
            'microdata.title.required' => 'El título de microdata no puede estar vacío.',
            'microdata.description.required' => 'La descripción de microdata no puede estar vacía.',
            'images.required' => 'La imagen es obligatoria.',
            'images.image' => 'El archivo debe ser una imagen.',
            'images.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'images.max' => 'La imagen no puede pesar más de 2MB.',
            'form_id.required' => 'El formulario es obligatorio.',
            'form_id.integer' => 'El formulario seleccionado no es válido.',
            'formContent.required' => 'El contenido del formulario es obligatorio.',
            'author_id.required' => 'El autor  es obligatorio.',


            'principal_Image.required' => 'El Imagen principal es obligatorio.',
            'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
            'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
            'banners.required' => 'Los Banners es obligatorio.',
            'photo.required' => 'LA FOTO DEL AUTOR es obligatorio.',
            'form_id.required' => 'El formulario es obligatorio.',
            'publish_date.required' => 'La fecha de publicacion es obligatorio.',




            // Mensajes para cuando se exceden los límites de caracteres
            'title.max' => 'El título no puede exceder los 70 caracteres.',
            'metadata.descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',
            'metadata.metakey.max' => 'Las palabras clave no pueden exceder los 200 caracteres.',
            'ogdata.ogtitle.max' => 'El título de ogdata no puede exceder los 200 caracteres.',
            'ogdata.ogdescription.max' => 'La descripción de ogdata no puede exceder los 200 caracteres.',
            'microdata.title.max' => 'El título de microdata no puede exceder los 200 caracteres.',
            'microdata.description.max' => 'La descripción de microdata no puede exceder los 200 caracteres.',
        ]);

        $userId = auth()->id(); // Obtener el ID del usuario logueado

        $customer = DB::table('customer_user')
            ->where('user_id', $userId)
            ->first(); // Obtener el cliente al que pertenece el usuario

        if (!$customer) {
            return response()->json(['error' => 'El usuario no tiene un cliente asignado.'], 403);
        }

        $customerId = $customer->customer_id;



        // Verifica si ya existe un título duplicado
        $existingTitle = NewsNotice::where('title', $request->input('title'))->exists();
        if ($existingTitle) {
            return redirect()->back()->withErrors(['title' => 'Ya existe una noticia con esos datos. Por favor, crea otro.']);
        }

        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));




        try {
            // Muestra los datos que se enviarán a la base de datos
            // dd([
            //     'title' => $validated['title'],
            //     'alias' => $alias,
            //     'content' => $validated['content'],
            //     'status' => $status,
            //     'creation_date' => now(),
            //     'publish_date' => now(),
            //     'modification_date' => now(),
            //     'ogdata' => convertArrayToJson($validated['ogdata']),
            //     'metadata' => convertArrayToJson($validated['metadata']),
            //     'microdata' => convertArrayToJson($validated['microdata']),
            //     'images' => $this->convertFileToBase64($request),
            //     'forms' => json_encode([
            //         'form_id' => $validated['form_id'],
            //         'formContent' => is_array($validated['formContent']) ? $validated['formContent'] : json_decode($validated['formContent'], true),
            //     ]),
            //     'author' => $authorContentJson,
            // ]);

            // Crear la noticia
            //ORIGINAL NewsNotice::create([
            $newsNotice = NewsNotice::create([

                'title' => $validated['title'],
                'alias' => $alias,
                'content' => $validated['content'],
                'principal_Image' => $validated['principal_Image'],
                'secondary_Image' => $validated['secondary_Image'],
                'mini_Image' => $validated['mini_Image'],
                'banners' => $validated['banners'],
                'status' => $status,
                'publish_date' => $validated['publish_date'],
                'creation_date' => now(),
                'modification_date' => now(),
                'ogdata' =>  convertArrayToJson($validated['ogdata']),
                'metadata' => convertArrayToJson($validated['metadata']),
                'microdata' => convertArrayToJson($validated['microdata']),

                'form_id' => $validated['form_id'],
                'author_id' => $validated['author_id'], // Guarda el ID del autor


            ]);
            // Asignar la noticia al cliente en la tabla intermedia customer_news
            DB::table('customer_news')->insert([
                'customer_id' => $customerId,
                'news_id' => $newsNotice->news_id,
                'assigned_at' => now(),
            ]);

            // Relacionar la noticia con el cliente en `customer_news`
            // $news->customers()->attach($validated['customer_id']);

            // Depuración: muestra el objeto creado
            // dd($newsNotice); // Verifica si el objeto fue creado correctamente
        } catch (\Exception $e) {



            dd($e->getMessage());
            return back()->withErrors(['error' => 'Error al crear la noticia: ' . $e->getMessage()]);
        }

        // Redirigir al listado de noticias
        return redirect()->route('news.index')->with('mensaje', 'Noticia creada exitosamente');
    }






    public function editContent($id)
    {
        $newsNotice = NewsNotice::findOrFail($id);
        $formEdit = Forms::where('is_active', true)->get(); //Obtiene todos los formularios de la db siempre y cuando esten activos no eliminados
        $authors = Author::where('is_active', true)->get(); //Obtiene todos los autores de la db siempre y cuando esten activos no eliminados
        // $authors = Author::all(); // Amodelo Author esta definido

        // Depuración: Verifica si el id_author es correcto
        // dd($newsNotice->id_author); 

        // Decodificar los campos JSON correctamente
        $ogdata = json_decode($newsNotice->ogdata);
        $metadata = json_decode($newsNotice->metadata);
        $microdata = json_decode($newsNotice->microdata);

        // Asegúra que se formate las fechas correctamente (Uso de Carbon)
        $publish_date = $newsNotice->publish_date ? $newsNotice->publish_date->format('Y-m-d') : null;

        //Llamamos el apartado de los formularios
        // Obtener todos los formularios disponibles
        $forms = Forms::all(); // Obtén todos los formularios de la base de datos
        // Depuración: Verifica si los formularios están llegando correctamente
        // dd($forms);  // Esto mostrará el contenido de $forms y detendrá la ejecución
        $authors = Author::all(); // Obtén todos los authores de la base de datos
        $selectedAuthor = Author::find($newsNotice->id_author);
        // Pasar las variables a la vista
        // return view('news.edit-content', compact('newsNotice', 'ogdata', 'metadata', 'microdata', 'forms', 'authors', 'selectedAuthor', 'authorName', 'formEdit'));
        return view('news.edit-content', compact('newsNotice', 'ogdata', 'metadata', 'microdata', 'forms', 'authors', 'formEdit'));
    }


    public function updateContent(Request $request, $id)
    {

        // dd($request->all()); // Ver todos los datos que se están enviando
        // Validación de los datos de entrada que no se envien vacios

        $request->validate(
            [
                'title' => 'required|string|max:70',
                'content' => 'required|string',
                'metadata.descripcion' => 'required|string|max:200',
                'metadata.metakey' => 'required|string|max:200',
                'ogdata.ogtitle' => 'required|string|max:200',
                'ogdata.ogdescription' => 'required|string|max:200',
                'microdata.title' => 'required|string|max:200',
                'microdata.description' => 'required|string|max:200',
                'principal_Image' => 'required|string',
                'secondary_Image' => 'required|string',
                'mini_Image' => 'required|string',
                'banners' => 'required|string',
                // FECHAS
                'publish_date' => 'required|date',
                //Join valiacion
                'form_id' => 'required|integer|exists:forms,form_id',
                'author_id' => 'required|integer|exists:authors,id_author', //Para validar busca el nombre real de la tabla en la base de datos, y no el nombre del modelo.



            ], //Mensaje que se dispararan si hay errores
            [
                'title.required' => 'El título es obligatorio.',
                'content.required' => 'El contenido no puede estar vacío.',
                'metadata.descripcion.required' => 'La descripción no puede estar vacía.',
                'metadata.metakey.required' => 'Palabras clave no puede estar vacía.',
                'ogdata.ogtitle.required' => 'El título de ogdata no puede estar vacío.',
                'ogdata.ogdescription.required' => 'La descripción de ogdata no puede estar vacía.',
                'microdata.title.required' => 'El título de microdata no puede estar vacío.',
                'microdata.description.required' => 'La descripción de microdata no puede estar vacía.',
                'images.nullable' => 'La imagen es obligatoria.',
                'images.image' => 'El archivo debe ser una imagen.',
                'images.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
                'images.max' => 'La imagen no puede pesar más de 2MB.',
                'form_id.required' => 'El formulario es obligatorio.',
                'form_id.integer' => 'El formulario seleccionado no es válido.',
                'formContent.required' => 'El contenido del formulario es obligatorio.',
                'id_author' => 'El author seleccionado no es válido.',
                'authorContentJson' => 'El author es obligatorio.',
                'id_author.required' => 'El author es obligatorio.',
                'id_author.integer' => 'El author seleccionado no es válido.',
                'authorContent.required' => 'El authorsas es obligatorio.',
                'description.required' => 'La descripción es obligatorio.',
                'photo.required' => 'LA FOTO DEL AUTOR es obligatorio.',
                'principal_Image.required' => 'El Imagen principal es obligatorio.',
                'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
                'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
                'banners.required' => 'Los Banners es obligatorio.',
                'form_id.required' => 'El formulario  es obligatorio.',
                'author_id.required' => 'El autor  es obligatorio.',

                // Mensajes para cuando se exceden los límites de caracteres
                'title.max' => 'El título no puede exceder los 70 caracteres.',
                'metadata.descripcion.max' => 'La descripción no puede exceder los 200 caracteres.',
                'metadata.metakey.max' => 'Las palabras clave no pueden exceder los 200 caracteres.',
                'ogdata.ogtitle.max' => 'El título de ogdata no puede exceder los 200 caracteres.',
                'ogdata.ogdescription.max' => 'La descripción de ogdata no puede exceder los 200 caracteres.',
                'microdata.title.max' => 'El título de microdata no puede exceder los 200 caracteres.',
                'microdata.description.max' => 'La descripción de microdata no puede exceder los 200 caracteres.',
            ]
        );

        // // Llama a la función privada para crear el JSON
        // $authorContentJson = $this->createAuthorContentJson($request);

        // Buscar la categoría por ID
        $newsNotice = NewsNotice::findOrFail($id);

        // Asignar el valor de estado dA SEGURIDAD ASI COMO PERMITE SOLO VALORES DE PUBLICADO Y NO PUBLICADO
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));
        $form = Forms::find($request['form_id']);
        if (!$form) {
            return back()->withErrors(['forms' => 'Formulario no encontrado.']);
        }

        // Actualizar la categoría con los datos validados
        $newsNotice->update([
            'title' => $request->input('title'),
            'alias' => $alias,
            'content' => $request->input('content'),
            'status' => $status,
            'principal_Image' => $request['principal_Image'],
            'secondary_Image' => $request['secondary_Image'],
            'mini_Image' => $request['mini_Image'],
            'banners' => $request['banners'],
            // 'creation_date' => now(),
            // 'publish_date' => now(),
            'modification_date' => now(),
            'publish_date' => $request['publish_date'],
            // 'modification_date' => Carbon::now(),  // Fecha actual para modification_date AUTOMATICAMENTE CUANDO UN USUARIO HAGA UNA MODIFICACION EN EL EDITAR ACTUALIZAR
            'ogdata' =>  convertArrayToJson($request['ogdata']),
            'metadata' => convertArrayToJson($request['metadata']),
            'microdata' => convertArrayToJson($request['microdata']),
            //Creamos los joins
            'form_id' => $request['form_id'],
            'author_id' => $request['author_id'],


            // 'author' => $authorContentJson, // Aquí se guarda el JSON del autor

        ]);

        // Obtener el cliente del usuario logueado
        $userId = auth()->id();
        $customer = DB::table('customer_user')->where('user_id', $userId)->first();

        if (!$customer) {
            return response()->json(['error' => 'El usuario no tiene un cliente asignado.'], 403);
        }

        // Obtener el ID del cliente
        $customerId = $customer->customer_id;

        // Actualizar la relación en la tabla intermedia
        DB::table('customer_news')
            ->updateOrInsert(
                ['customer_id' => $customerId, 'news_id' => $newsNotice->news_id],
                ['assigned_at' => now()]
            );

        return redirect()->route('news.index')->with('mensaje', 'Noticia Atualizado !Correctamente¡');
    }





    //FUNCION DE DELETE NOTICIA POR ID
    // public function destroy($id)ORIGINAL
    // {
    //     // Buscara  la categoría por su ID
    //     $newsNotice = NewsNotice::findOrFail($id);

    //     // Eliminar la categoría
    //     $newsNotice->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('news.index')->with('mensaje', 'Noticia eliminada');
    // }
    //FUNCIONES PARA ELIMINAR NOTA: NO SE ELIMINA SOLO SE OCULTA

    public function show() //FUNCION QUE MUESTRA LA RUTA DE LA PAGINA PARA ELIMINAR
    {
        // Obtener solo los articles inactivos (eliminados)
        $newsDelete = NewsNotice::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'newsDelete' a la vista
        return view('news.deleteRegister', compact('newsDelete'));
    }
    #...news_id
    public function destroy($news_id)
    {
        // Buscar el articles por su ID
        $newsDelete = NewsNotice::findOrFail($news_id);

        // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
        $newsDelete->is_active = 0;
        $newsDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('news.index')->with('mensaje', 'Noticia Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    public function restoreNews($news_id)
    {
        // dd($news_id); // Esto detendrá la ejecución y mostrará el valor de $news_id
        // Buscar el artículo por su ID
        $newsDelete = NewsNotice::findOrFail($news_id);


        // Verifica si se está recuperando correctamente
        // dd($newsDelete); // Esto te mostrará los detalles del artículo y te ayudará a verificar

        // Verificar si el Formulario está inactivo
        if ($newsDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $newsDelete->is_active = 1;
            $newsDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de Formulario activos
            return redirect()->route('news.index')->with('mensaje', 'Noticia Restaurado Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('news.index')->with('mensaje', 'La Noticia ya está restaurada.');
        }
    }


































    public function preview($news_id)
    {
        // Verifica si el ID realmente llega al controlador
        // dd($news_id);   
        // return view('news.show-web', compact('news'));
        // Intentar encontrar el artículo con el ID proporcionado
        $newsPreview = NewsNotice::find($news_id);

        // Verificar si se encontró el artículo
        if (!$newsPreview) {
            // Si no se encontró, devolver un mensaje adecuado
            return response()->json(['error' => 'No se encontró la noticia con el ID especificado.'], 404);
        }

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($newsPreview->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array

        // Reemplazar el marcador en el contenido del artículo con el nombre del formulario
        if ($form) {
            $newsPreview->content = str_replace("$/id:{$form->form_id}/$", $form->title, $newsPreview->content);
        }

        // Pasar el artículo, formulario y el contenido del formulario a la vista
        return view('news.preview', compact('newsPreview', 'form', 'formContent'));
    }




    public function searchNews(Request $request)
    {
        // Obtener el término de búsqueda desde el parámetro 'query'
        $query = $request->input('query');

        // Buscar noticias que contengan el término en el título
        $searchNews = NewsNotice::where('title', 'like', '%' . $query . '%')
            ->where('status', 'Published')  // Solo las noticias publicadas
            ->get();

        // Devolver los resultados como respuesta JSON
        return response()->json($searchNews);
    }


    public function showFinalFinal($id, $alias)
    {
        // Obtener la noticia específica
        //ORIGINAL $newsNotice = NewsNotice::where('alias', $alias)
        //     ->where('status', 'Published')
        //     ->first();

        // Obtener la noticia específica junto con el autor
        $newsNotice = NewsNotice::with('author') // Carga la relación directamente
            ->where('alias', $alias)
            ->where('status', 'Published')
            ->first();

        if (!$newsNotice) {
            return redirect()->route('news.index')->with('error', 'Noticia no encontrada');
        }
        // Cargar el autor de la noticia
        $author = $newsNotice->author; // Esta es la relación que definimos en el modelo


        // Decodificar los datos JSON
        $ogdata = json_decode($newsNotice->ogdata, true);
        $metadata = json_decode($newsNotice->metadata, true);
        $microdata = json_decode($newsNotice->microdata, true);
        $authorContentJson = json_decode($newsNotice->authorContentJson, true);
        // // Decodificar el JSON del autor
        // $author = json_decode($newsNotice->author, true);

        // Asegurar que los datos decodificados sean arrays válidos
        $ogdata = is_array($ogdata) ? $ogdata : [];
        $metadata = is_array($metadata) ? $metadata : [];
        $microdata = is_array($microdata) ? $microdata : [];
        $authorContentJson = (is_array($authorContentJson)) ? $authorContentJson : [];
        // Asegura de que es un array válido
        $author = is_array($author) ? $author : [];

        // Obtener otras noticias publicadas, excluyendo la actual
        $publishedNews = NewsNotice::where('status', 'Published')
            ->where('news_id', '!=', $id)
            // ->orderBy('created_at', 'desc')
            ->take(5) // Limitar a 20 noticias
            ->get();

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($newsNotice->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array
        if ($form) {
            $newsNotice->content = str_replace("$/id:{$form->form_id}/$", $form->titleE, $newsNotice->content);
        }
        // Pasar todos los datos a la vista
        // ORIGINAL return view('news.viewOnWeb', compact('newsNotice', 'ogdata', 'metadata', 'microdata', 'publishedNews', 'author', 'authorContentJson', 'author'));
        return view('news.viewOnWeb', compact('newsNotice', 'ogdata', 'metadata', 'microdata', 'publishedNews', 'formContent'));
    }
}
