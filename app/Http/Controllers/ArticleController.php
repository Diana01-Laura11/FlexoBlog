<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\app\utils\utils;
use App\Models\Author;
use App\Models\Forms;
use App\Models\NewCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use Carbon\Carbon;  // Solo esta línea es necesaria


class ArticleController extends Controller
{

    // public function index()ORIGINAL
    // {
    //     //OBTENER lOS ARTICULOS EXISTENTES NO ELIMINADOS
    //     $article = Article::where('is_active', true)->paginate(15);

    //     // Pasarlos  a la vista mapeamos con la variable $article
    //     return view('articles.index', compact('article'));
    // }

    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario tiene un cliente asociado
        if ($authUser && $authUser->customers->isNotEmpty()) {
            $customer = $authUser->customers->first(); // Obtener el primer cliente

            // Obtener solo las noticias asociadas a ese cliente y que estén activas
            $article = Article::whereHas('customers', function ($query) use ($customer) {
                $query->where('customer_id', $customer->id);
            })->where('is_active', true)->paginate(11);
        } else {
            // Si el usuario no tiene cliente, devolver una colección vacía
            $article = collect();
        }

        return view('articles.index', compact('article'));
    }





    public function create()
    {
        // return view('articles.create');ORIGINAL
        // return view('articles.createArticle');
        $authors = Author::where('is_active', true)->get();// Obtiene todos los autores que no han sido eliminadas
        $new_categories = NewCategory::where('is_active', true)->get(); // Obtiene todas las categorias que no han sido eliminadas
        $form = Forms::where('is_active', true)->get(); //OBTIENE SOLO LOS FORMULARIOS ACTIVOS QUE NO ESTAN ELIMINADOS
        
        // $authors = Author::all(); // Obtiene todos los autores
        // $new_categories = NewCategory::all(); // Obtiene todas las categorias
        /*$form = Forms::all(); //Obtiene todos los formularios de la db/*/
        return view('articles.createArticle', compact('authors', 'new_categories', 'form'));
    }



    // FUNCION PARA CREAR ARTICULOS
    public function saveArticle(Request $request)
    {
        //  dd($request->all()); // Muestra todos los datos enviados por el formulario
        // Validamos los campos que enviara al formulario, para ello lo llamamos del modelo
        $validated = $request->validate([
            'title' => 'required|string|max:70',
            'content' => 'required|string',
            // FECHAS
            'publication_date' => 'required|date',
            'og_data.ogtitle' => 'required|string|max:150',
            'og_data.ogdescription' => 'required|string|max:150',
            'metadata.descripcion' => 'required|string|max:150',
            'metadata.metakey' => 'required|string|max:150',
            'microdata.title' => 'required|string|max:150',
            'microdata.description' => 'required|string|max:150',
            // Imagenes
            'principal_Image' => 'required|string',
            'secondary_Image' => 'required|string',
            'mini_Image' => 'required|string',
            'banners' => 'required|string',

            //Hacemos el join con autores validando que llame su id para traer contenido
            'author_id' => 'required|integer|exists:authors,id_author', // Asegura que el autor existe
            'category_id' => 'required|integer|exists:new_categories,id', //Para validar busca el nombre real de la tabla en la base de datos, y no el nombre del modelo.
            'form_id' => 'required|integer|exists:forms,form_id',

            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 70 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'creation_date.required' => 'La fecha de carga o creacion es obligatorio.',
            'publication_date.required' => 'La fecha de publicacion es obligatorio.',
            'modification_date.required' => 'La fecha de modificacion es obligatorio.',

            'og_data.ogtitle' => 'El og Data título es obligatorio.',
            'og_data.ogdescription' => 'El og Data descripcion es obligatorio.',
            'metadata.descripcion' => 'El metadato descripcion es obligatorio.',
            'metadata.metakey' => 'El metaKey de palabras clave es obligatorio.',
            'microdata.title' => 'El microdato del título es obligatorio.',
            'microdata.description' => 'El microdato descripcion es obligatorio.',

            'principal_Image.required' => 'El Imagen principal es obligatorio.',
            'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
            'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
            'banners.required' => 'Los Banners es obligatorio.',

            'author_id.required' => 'El autor  es obligatorio.',
            'form_id.required' => 'El formulario  es obligatorio.',
            'content.required' => 'El contenido del ckeditor  es obligatorio.',

            'category_id.required' => 'La categoria es obligatorio.',
            'category_id.exists' => 'La categoria seleccionado no es válida o no esta activa - publicada.',
            'article_creation.required' => 'La creacion de articulo es obligatorio.',
        ]);


        // Verifica si ya existe un título duplicado
        $existingTitle = Article::where('title', $request->input('title'))->exists();
        if ($existingTitle) {
            return redirect()->back()->withErrors(['title' => 'Ya existe articulos con esos datos. Por favor, crea otro.']);
        }


        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));

        // AQUI SI CREA EL ARTICULO
        $article =   Article::create([
            'title' => $validated['title'],
            'alias' => $alias,
            'status' => $status,
            'content' => $validated['content'],
            'principal_Image' => $validated['principal_Image'],
            'secondary_Image' => $validated['secondary_Image'],
            'mini_Image' => $validated['mini_Image'],
            'banners' => $validated['banners'],
            // Asignar los valores de las fechas
            'creation_date' => Carbon::now(),  // Fecha actual para creation_date
            'modification_date' => Carbon::now(),  // Fecha actual para modification_date
            'publication_date' => $validated['publication_date'],
            'og_data' =>  convertArrayToJson($validated['og_data']),
            'metadata' => convertArrayToJson($validated['metadata']),
            'microdata' => convertArrayToJson($validated['microdata']),
            //CREA LOS JOINS
            'author_id' => $validated['author_id'], // Guarda el ID del autor
            'category_id' => $validated['category_id'],
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
        DB::table('customer_posts')->insert([
            'customer_id' => $customerId,
            'id_post' => $article->id_post, // Usar el ID de la promoción recién creada
            'assigned_at' => now(),
        ]);

        // Redirigir al listado de articulos
        return redirect()->route('articles.index')->with('mensaje', 'Articulo Creado ¡Exitosamente!');
    }





    // PRUEBAS PARA EDITAR ACTUALIZAR


    public function editArticle($id_post)
    {
        // Encuentra promocion por su ID la variable promotionEdit se encargara de setar los valores tanto en back y front
        $articleEdit = Article::findOrFail($id_post);
        $authors = Author::where('is_active', true)->get(); // Amodelo Author esta definido no eliminadas
        $new_categories = NewCategory::where('is_active', true)->get(); // Obtiene todas las categorías no eliminadas
        $formEdit = Forms::where('is_active', true)->get(); // <---- Obtener todos los formularios disponibles no eliminadas
        // Decodificar los campos JSON correctamente
        $og_data = json_decode($articleEdit->og_data);
        $metadata = json_decode($articleEdit->metadata);
        $microdata = json_decode($articleEdit->microdata);

      
        

        // Asegúra que se formate las fechas correctamente (Uso de Carbon)
        $publication_date = $articleEdit->publication_date ? $articleEdit->publication_date->format('Y-m-d') : null;

        return view('articles.editArticle', compact('articleEdit', 'authors', 'new_categories', 'formEdit', 'og_data', 'metadata', 'microdata'));
    }
    public function updateArticle(Request $request, $id_post)
    {
        // dd($request->all()); // Ver todos los datos que se están enviando
        $validated = $request->validate([
            'title' => 'required|string|max:70',
            'content' => 'required|string',
            'principal_Image' => 'required|string',
            'secondary_Image' => 'required|string',
            'mini_Image' => 'required|string',
            'banners' => 'required|string',
            // FECHAS
            'publication_date' => 'required|date',
            // JOINS
            'author_id' => 'required|integer|exists:authors,id_author', //Para validar busca el nombre real de la tabla en la base de datos, y no el nombre del modelo.
            'category_id' => 'required|integer|exists:new_categories,id', //Para validar busca el nombre real de la tabla en la base de datos, y no el nombre del modelo.
            'form_id' => 'required|integer|exists:forms,form_id',

            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder los 70 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'creation_date.required' => 'La fecha de carga o creacion es obligatorio.',
            'publication_date.required' => 'La fecha de publicacion es obligatorio.',
            'modification_date.required' => 'La fecha de modificacion es obligatorio.',

            'og_data.ogtitle' => 'El og Data título es obligatorio.',
            'og_data.ogdescription' => 'El og Data descripcion es obligatorio.',
            'metadata.descripcion' => 'El metadato descripcion es obligatorio.',
            'metadata.metakey' => 'El metaKey de palabras clave es obligatorio.',
            'microdata.title' => 'El microdato del título es obligatorio.',
            'microdata.description' => 'El microdato descripcion es obligatorio.',

            'principal_Image.required' => 'El Imagen principal es obligatorio.',
            'secondary_Image.required' => 'La Imagen secundaria es obligatorio.',
            'mini_Image.required' => 'La Imagen en miniatura es obligatorio.',
            'banners.required' => 'Los Banners es obligatorio.',

            'author_id.required' => 'El autor  es obligatorio.',
            'form_id.required' => 'El formulario  es obligatorio.',
            'content.required' => 'El contenido del ckeditor  es obligatorio.',

            'category_id.required' => 'La categoria es obligatorio.',
            'category_id.exists' => 'La categoria seleccionado no es válida o no esta activa - publicada.',
            'article_creation.required' => 'La creacion de articulo es obligatorio.',
        ]);


        $articleEdit = Article::findOrFail($id_post);
        // Asignar el valor de estado
        $status = $request->input('status') === 'Published' ? 'Published' : 'Unpublished';
        $alias = Str::slug($request->input('title'));
        // Actualiza el artículo con los datos validados
        $articleEdit->update([
            'title' => $validated['title'],
            'alias' => $alias,
            'status' => $status,
            'content' => $validated['content'],
            'principal_Image' => $validated['principal_Image'],
            'secondary_Image' => $validated['secondary_Image'],
            'mini_Image' => $validated['mini_Image'],
            'banners' => $validated['banners'],
            'publication_date' => $validated['publication_date'],
            'modification_date' => Carbon::now(),  // Fecha actual para modification_date AUTOMATICAMENTE CUANDO UN USUARIO HAGA UNA MODIFICACION EN EL EDITAR ACTUALIZAR
            // JOINS PARA INSERTAR ID
            'author_id' => $validated['author_id'],
            'category_id' => $validated['category_id'],
            'form_id' => $validated['form_id'],
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
        $existingAssignment = DB::table('customer_posts')
            ->where('customer_id', $customerId)
            ->where('id_post', $articleEdit->id_post)
            ->first();

        if (!$existingAssignment) {
            DB::table('customer_posts')->insert([
                'customer_id' => $customerId,
                'id_post' => $articleEdit->id_post,
                'assigned_at' => now(),]);
        }


        // Redirigir al listado de artículos con un mensaje de éxito
        return redirect()->route('articles.index')->with('mensaje', 'Artículo actualizado ¡Exitosamente!');
    }






    //COPIA ESTA FUNCION Y PEGALA DENTRO DEL CONTROLADOR DONDE NECESITES GUARDAR IMAGENES
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


    //  INICIA PARA ELIMINAR UN REGISTRO DE ARITUCULO NO LO BORRA SOLO LO OCULTA
    //ORIGINAL public function deleteArticle($id_post)
    // {
    //     // dd($promotion_id);  // Esto imprimirá el ID y detendrá la ejecución
    //     // Buscara  la promocion por su ID
    //     $deleteArticle = Article::findOrFail($id_post);

    //     // Eliminar el articulo
    //     $deleteArticle->delete();

    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('articles.index')->with('mensaje', 'Articulo Eliminado Por Completo');
    // }
    //Mostrar la paginade eliminados
    public function show()
    {
        // Obtener solo los articles inactivos (eliminados)
        $articleDelete = Article::where('is_active', false)->paginate(15); // Usamos paginate para paginar los resultados

        // Pasar la variable 'articleDelete' a la vista
        return view('articles.deleteRegister', compact('articleDelete'));
    }



    public function destroy($id_post)
    {
        // Buscar el articles por su ID
        $articleDelete = Article::findOrFail($id_post);

        // Desactivar el articles (cambiar 'is_active' a 0 para desactivarlo)
        $articleDelete->is_active = 0;
        $articleDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('articles.index')->with('mensaje', 'Articulo Eliminado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }
    //Funcion para restaurar un registro
    // Restaurar un artículo
    public function restoreArticle($id_post)
    {
        // Buscar el artículo por su ID
        $articleDelete = Article::findOrFail($id_post);

        // Verificar el artículo antes de actualizar
        // dd($articleDelete); // Verifica si se está recuperando correctamente

        // Verificar si el artículo está inactivo
        if ($articleDelete->is_active == 0) {
            // Restaurar el artículo (cambiar 'is_active' a 1 para activarlo)
            $articleDelete->is_active = 1;
            $articleDelete->save(); // Guardar los cambios en la base de datos

            // Mensaje de éxito y redirección a la lista de artículos activos
            return redirect()->route('articles.index')->with('mensaje', 'Articulo Restaurado Con Éxito');
        } else {
            // Si ya está activo, redirigir con un mensaje
            return redirect()->route('articles.index')->with('mensaje', 'El artículo ya está restaurado.');
        }
    }













































































































    //FUCION  PARA MOSTRAR EL CONTENIDO DE UNA VISTA PREVIA
    public function preview($id_post)
    {
        // dd($id_post);

        // Intentar encontrar el artículo con el ID proporcionado
        $articlePreview = Article::find($id_post);

        // Verificar si se encontró el artículo
        if (!$articlePreview) {
            // Si no se encontró, devolver un mensaje adecuado
            return response()->json(['error' => 'No se encontró el artículo con el ID especificado.'], 404);
        }

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($articlePreview->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

        // Verificar si el formulario tiene contenido
        $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array

        // Reemplazar el marcador en el contenido del artículo con el nombre del formulario
        if ($form) {
            $articlePreview->content = str_replace("$/id:{$form->form_id}/$", $form->title, $articlePreview->content);
        }

        // Pasar el artículo, formulario y el contenido del formulario a la vista
        return view('articles.preview', compact('articlePreview', 'form', 'formContent'));
    }


    //FUNCION PARA VER EN WEB
    // public function viewOnWeb($id_post, $alias)
    // {
    //     // Pasar el artículo, formulario y el contenido del formulario a la vista
    //     //   return view('articles.viewOnWeb', compact('articlePreview'));


    //     $viewFinalWeb = Article::where('alias', $alias)
    //         ->where('status', 'Published')
    //         ->first();

    //     if (!$viewFinalWeb) {
    //         return redirect()->route('articles.index')->with('error', 'Articulo No Publicado');
    //     }


    //     // Decodificar los datos JSON
    //     $og_data = json_decode($viewFinalWeb->og_data, true);
    //     $metadata = json_decode($viewFinalWeb->metadata, true);
    //     $microdata = json_decode($viewFinalWeb->microdata, true);

    //     // Asegurarse de que las variables sean arrays válidos
    //     $og_data = (is_array($og_data)) ? $og_data : [];
    //     $metadata = (is_array($metadata)) ? $metadata : [];
    //     $microdata = (is_array($microdata)) ? $microdata : [];
    //     // Obtener todas las Articles asociadas excluyendo la que ya esta mostrando
    //     $publishedArticles = Article::where('status', 'Published')
    //         ->where('id_post', '!=', $id_post)
    //         // ->orderBy('created_at', 'desc')
    //         ->take(3) // Limitar a 3 Articles
    //         ->get();


    //     // //MOSTRAR EL FORMULARIO EN LA VISTA PARA QUE NO SE VEA ASI:$/id:109/$


    //     // // Intentar encontrar el artículo con el ID proporcionado
    //     // $viewFinalWeb = Article::find($id_post);
    //     //  // Obtener el formulario relacionado al artículo
    //     //  $form = Forms::find($viewFinalWeb->form_id); // Esto obtiene el formulario correspondiente al ID del formulario

    //     //  // Verificar si el formulario tiene contenido
    //     //  $formContent = $form ? json_decode($form->content, true) : null; // Decodificar el JSON a un array

    //     //  // Reemplazar el marcador en el contenido del artículo con el nombre del formulario
    //     //  if ($form) {
    //     //      $viewFinalWeb->content = str_replace("$/id:{$form->form_id}/$", $form->title, $viewFinalWeb->content);
    //     //  }



    //     return view('articles.viewOnWeb', compact('viewFinalWeb', 'metadata', 'og_data', 'microdata', 'publishedArticles',));
    // }

    //FUNCION PARA BUSCAR ARTICULOS
    public function searchArticle(Request $request)
    {
        // Obtener el término de búsqueda desde el parámetro 'query'
        $query = $request->input('query');

        // Verificar si hay un término de búsqueda
        if (empty($query)) {
            return response()->json(['message' => 'Por favor ingresa un título de articuloss.'], 400);
        }

        // Buscar promociones que contengan el término en el título
        $articlesSearch = Article::where('title', 'like', '%' . $query . '%')
            ->where('status', 'Published')  // Solo las articulos publicadas
            ->get();

        return response()->json($articlesSearch);
    }
    //FUNCION PARA MOSTRAR VISTA FINAL
    public function viewOnWeb($id_post, $alias)
    {
        // Obtener el artículo publicado con el alias
        $viewFinalWeb = Article::where('alias', $alias)
            ->where('status', 'Published')
            ->first();

        if (!$viewFinalWeb) {
            return redirect()->route('articles.index')->with('error', 'Articulo No Publicado');
        }

        // Decodificar los datos JSON
        $og_data = json_decode($viewFinalWeb->og_data, true);
        $metadata = json_decode($viewFinalWeb->metadata, true);
        $microdata = json_decode($viewFinalWeb->microdata, true);

        // Asegurarse de que las variables sean arrays válidos
        $og_data = (is_array($og_data)) ? $og_data : [];
        $metadata = (is_array($metadata)) ? $metadata : [];
        $microdata = (is_array($microdata)) ? $microdata : [];

        // Obtener las publicaciones relacionadas, excluyendo la actual
        $publishedArticles = Article::where('status', 'Published')
            ->where('id_post', '!=', $id_post)
            ->take(3) // Limitar a 3 artículos
            ->get();

        // Obtener el formulario relacionado al artículo
        $form = Forms::find($viewFinalWeb->form_id); // Asegúrate que el nombre del modelo es "Form"

        // Si existe el formulario, reemplazar el marcador en el contenido del artículo
        if ($form) {
            $viewFinalWeb->content = str_replace("$/id:{$form->form_id}/$", $form->titlee, $viewFinalWeb->content);
        }
        $formContent = $form ? json_decode($form->content, true) : null;


        // Muestra los datos del formulario para revisar su estructura
        // dd($formContent);

        // Pasar todos los datos a la vista, EXCEPTO LA VARIABLE $form->title, PORQUE NO QUEREMOS SETEAR 2 VECES EL NOMBRE SOLO LLAMAR EL FORM DE LA BD
        return view('articles.viewOnWeb', compact('viewFinalWeb', 'metadata', 'og_data', 'microdata', 'publishedArticles', 'formContent'));
        // return view('articles.viewOnWeb', compact('viewFinalWeb', 'metadata', 'og_data', 'microdata', 'publishedArticles', 'form', 'formContent'));
    }
}
