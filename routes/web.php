<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\PromotionsController;
use App\Http\Controllers\GaleriesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Models\Forms;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // ORIGINAL
    return view('auth.login');
    //Ruta que mandara cuando se levante todo el proyecto
    // return view('auth.register');
});
// Ruta para /homeaaaaa
// Route::get('/welcomeValidate', function () {
//     return view('welcomeValidate'); // Nota es bueno asegúrarse de que el nombre del archivo es "hello.blade.php"
// });

// Ruta para bienvenida de cliente
Route::get('/welcomeClient', function () {
    return view('users.welcomeClient');  // Correcta referencia a la vista dentro de la carpeta 'users'
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
    
    Route::get('/news/{id}/edit-content', [App\Http\Controllers\NewsController::class, 'editContent'])->name('news.editContent');
    Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'updateContent'])->name('news.updateContent');
});

// Rutas protegidas para ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
    Route::get('/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
    Route::delete('/news/{id}/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
});
















































































/*rutas de las vistas  Routes of Views */

/* Cliente */
Route::resource('clients', ClientsController::class);

Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients.index');


// Route::post('/clients', [App\Http\Controllers\ClientsController::class, 'store'])->name('clients.store');

Route::put('/clients/{id}', [App\Http\Controllers\ClientsController::class, 'update'])->name('clients.update');

Route::get('/clients/{id}/edit', [App\Http\Controllers\ClientsController::class, 'edit'])->name('clients.edit');

Route::delete('/clients/{id}/delete', [App\Http\Controllers\ClientsController::class, 'destroy'])->name('clients.destroy');

//Rutas para crear y traer clientes
Route::get('/clients/create', [App\Http\Controllers\ClientsController::class, 'create'])->name('clients.create');
Route::post('/clients/saveCustomer', [App\Http\Controllers\ClientsController::class, 'saveCustomer'])->name('clients.saveCustomer');
//Rutas para editar el cliente
Route::get('/clients/{id}/editClient', [App\Http\Controllers\ClientsController::class, 'editCustomer'])->name('clients.editClient');
Route::put('/clients/update/{id}', [App\Http\Controllers\ClientsController::class, 'update'])->name('clients.update');
//RUTAS PARA ELIMINACION DE CLIENTES
// Ruta para mostrar clientes activos
Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients.index');

// Ruta para mostrar clientes desactivados
Route::get('/clients/deleteRegister', [App\Http\Controllers\ClientsController::class, 'show'])->name('clients.deleteRegister');

// Ruta para desactivar un cliente
Route::post('clients/{id}', [App\Http\Controllers\ClientsController::class, 'deleteClient'])->name('clients.deleteClient');

// Ruta para restaurar un cliente
Route::get('/clients/restore/{id}', [App\Http\Controllers\ClientsController::class, 'restoreClient'])->name('clients.restoreClient');







// /*RUTAS PARA NOTICIAS */
// Route::resource('news', NewsController::class);

// Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');

// Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');

// Route::post('/news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
// //RUTA PARA EDITAR DATOS
// Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
// Route::get('/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
// //RUTA PARA EDITAR CONTENIDO DE NOTICIA
// Route::get('/news/{id}/edit-content', [App\Http\Controllers\NewsController::class, 'editContent'])->name('news.editContent');
// Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'updateContent'])->name('news.updateContent');

// //RUTA PARA BORRAR
// Route::delete('/news/{id}/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');

// Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
// /*RUTAS PARA VISTA PREVIA WEB, VISTA PREVIA EN FORMULARIO, VISTA PREVIA NORMAL */
// Route::get('/news/{news_id}', [NewsController::class, 'show'])->name('news.show.web');
// // Ruta para buscar noticias
// Route::get('/searchNews', [NewsController::class, 'searchNews']);
// Route::get('news/{id}/{alias}', [NewsController::class, 'showFinalFinal'])->name('news.showFinalFinal');
// Route::post('/news/showImages', [App\Http\Controllers\NewsController::class, 'showImages'])->name('news.showImages');
// //Ruta para vista previa
// Route::get('news/{news_id}/preview', [App\Http\Controllers\NewsController::class, 'preview'])->name('news.preview');
// Rutas específicas para las noticias

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->name('news.create');
Route::post('/news', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');

// Rutas para editar datos
// Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
// Route::get('/news/{id}/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');

// Rutas para editar contenido de la noticia
Route::get('/news/{id}/edit-content', [App\Http\Controllers\NewsController::class, 'editContent'])->name('news.editContent');
Route::put('/news/{id}', [App\Http\Controllers\NewsController::class, 'updateContent'])->name('news.updateContent');


// Ruta para vista previa
Route::get('news/{news_id}/preview', [App\Http\Controllers\NewsController::class, 'preview'])->name('news.preview');

// Otras rutas personalizadas
// Route::get('/news/{news_id}', [NewsController::class, 'show'])->name('news.show.web');
Route::get('news/{id}/{alias}', [NewsController::class, 'showFinalFinal'])->name('news.showFinalFinal');
Route::get('/searchNews', [NewsController::class, 'searchNews']);
Route::post('/news/showImages', [App\Http\Controllers\NewsController::class, 'showImages'])->name('news.showImages');

// Ruta para mostrar noticias eliminados
Route::get('/news/deleteRegister', [App\Http\Controllers\NewsController::class, 'show'])->name('news.deleteRegister');
// Ruta para eliminar noticia
Route::delete('/news/{news_id}/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.destroy');
// Ruta para restaurar noticia (cambiar 'is_active' a 1)
Route::post('/news/restore/{news_id}', [App\Http\Controllers\NewsController::class, 'restoreNews'])->name('news.restoreNews');

//// Route::post('/news/restore/{news_id}', [App\Http\Controllers\NewsController::class, 'restoreNews'])->name('news.restoreNews');



/* RUTA PARA Articulos */
// Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
// Route::resource('articles', ArticleController::class);
// Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
// // Llamar al metodo de crear articulo
// Route::get('/articles/createArticle', [App\Http\Controllers\ArticleController::class, 'createArticle'])->name('articles.createArticle');
// Route::post('/articles/saveArticle', [App\Http\Controllers\ArticleController::class, 'saveArticle'])->name('articles.saveArticle');
// Route::put('/articles', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{id}/delete', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');
// /* PASO 6: HAS UNA RUTA PARA LAS IMAGENES, ADEMAS DE MODIFICAR EL ARCHIVO /public/assets/js/managerImagen.js 
// MODIFICA LA FUNCION ObtnerImaganes en  
// $.ajax({
//         url: '/articles/showImages', //Por la ruta que pongas en este archivo 
//  */
// Route::post('/articles/showImages', [App\Http\Controllers\ArticleController::class, 'showImages'])->name('articles.showImages');
// /*****************************  */
// Route::delete('/articles/{id_post}/delete-articles', [App\Http\Controllers\ArticleController::class, 'deleteArticle'])->name('articles.deleteArticle');
// //Traer el edtiar
// //Redireccion para el hacer editar
// Route::get('/articles/edit/{id_post}', [App\Http\Controllers\ArticleController::class, 'editArticle'])->name('articles.editArticle');
// //Hacemos el put
// Route::put('/articles/update/{id_post}', [App\Http\Controllers\ArticleController::class, 'updateArticle'])->name('articles.updateArticle');
// //Ruta para vista previa
// Route::get('articles/{id_post}/preview', [App\Http\Controllers\ArticleController::class, 'preview'])->name('articles.preview');
// //Ruta para ver web final
// Route::get('articles/{id_post}/{alias}', [App\Http\Controllers\ArticleController::class, 'viewOnWeb'])->name('articles.viewOnWeb');
// // Route::get('promotions/{promotion_id}/{alias}', [App\Http\Controllers\PromotionsController::class, 'previewFinalWeb'])->name('promotions.previewFinalWeb');
// // Ruta para buscar articulos
// Route::get('/searchArticle',   [App\Http\Controllers\ArticleController::class, 'searchArticle']);
// // RUTA PARA BORRAR Y MOSTRAR ARTICULOS ELIMINADOS
// // Ruta para mostrar ARTICULOS activos
// // // Ruta para mostrar ARTICULOS desactivados
// Route::get('/articles/deleteRegister', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.deleteRegister');
// // Ruta para desactivar un articulos
// Route::post('articles/{id_post}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');
// // Ruta para restaurar un articles
// Route::get('/articles/restore/{id_post}', [App\Http\Controllers\ArticleController::class, 'restoreArticle'])->name('articles.restoreArticle');

/* RUTA PARA Articulos */
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');

// Rutas para crear y guardar artículos
Route::get('/articles/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.createArticle');
Route::post('/articles/saveArticle', [App\Http\Controllers\ArticleController::class, 'saveArticle'])->name('articles.saveArticle');

// Ruta para editar artículos
Route::get('/articles/edit/{id_post}', [App\Http\Controllers\ArticleController::class, 'editArticle'])->name('articles.editArticle');
Route::put('/articles/update/{id_post}', [App\Http\Controllers\ArticleController::class, 'updateArticle'])->name('articles.updateArticle');

// Ruta para mostrar artículos eliminados
Route::get('/articles/deleteRegister', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.deleteRegister');

// Ruta para eliminar artículos
Route::delete('/articles/{id}/delete', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');

// Ruta para restaurar artículos (cambiar 'is_active' a 1)
Route::get('/articles/restore/{id_post}', [App\Http\Controllers\ArticleController::class, 'restoreArticle'])->name('articles.restoreArticle');

// Ruta para vista previa de artículos
Route::get('articles/{id_post}/preview', [App\Http\Controllers\ArticleController::class, 'preview'])->name('articles.preview');

// Ruta para ver en la web
Route::get('articles/{id_post}/{alias}', [App\Http\Controllers\ArticleController::class, 'viewOnWeb'])->name('articles.viewOnWeb');

// Ruta para buscar artículos
Route::get('/searchArticle', [App\Http\Controllers\ArticleController::class, 'searchArticle']);

// Ruta para mostrar imágenes de artículos
Route::post('/articles/showImages', [App\Http\Controllers\ArticleController::class, 'showImages'])->name('articles.showImages');
























/* Promociones */
// Route::get('/promotions', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');

Route::get('/promotions', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');

// Route::resource('promotions', PromotionsController::class);

Route::get('/promotions', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');

Route::get('/promotions/create', [App\Http\Controllers\PromotionsController::class, 'create'])->name('promotions.create');

Route::post('/promotions/savePromotion', [App\Http\Controllers\PromotionsController::class, 'savePromotion'])->name('promotions.savePromotion');

Route::delete('/promotions/{promotion_id}/deletePromotion', [App\Http\Controllers\PromotionsController::class, 'deletePromotion'])->name('promotions.deletePromotion');
//Redireccion para el hacer editar
Route::get('/promotions/edit/{promotion_id}', [PromotionsController::class, 'editPromotion'])->name('promotions.editPromotion');
//Redireccion cuando suceda error de contenido o validacion
Route::get('/promotions/{promotion_id}/edit', [PromotionsController::class, 'editPromotion'])->name('promotions.edit');
Route::put('/promotions/{promotion_id}', [App\Http\Controllers\PromotionsController::class, 'updatePromotion'])->name('promotions.updatePromotion');
/*RUTAS PARA VISTA PREVIA WEB, VISTA PREVIA EN FORMULARIO, VISTA PREVIA NORMAL */
Route::get('promotions/{promotion_id}/preview', [App\Http\Controllers\PromotionsController::class, 'preview'])->name('promotions.preview');
Route::get('promotions/{promotion_id}/{alias}', [App\Http\Controllers\PromotionsController::class, 'previewFinalWeb'])->name('promotions.previewFinalWeb');
Route::post('/promotions/showImages', [App\Http\Controllers\PromotionsController::class, 'showImages'])->name('promotions.showImages');

// Ruta para buscar promociones
Route::get('/searchPromotions',  [App\Http\Controllers\PromotionsController::class, 'searchPromotions']);
// Ruta para mostrar promociones eliminados
Route::get('/promotions/deleteRegister', [App\Http\Controllers\PromotionsController::class, 'show'])->name('promotions.deleteRegister');
// Ruta para eliminar promocion
Route::delete('/promotions/{news_id}/delete', [App\Http\Controllers\PromotionsController::class, 'destroy'])->name('promotions.destroy');
// Ruta para restaurar promociones (cambiar 'is_active' a 1)
Route::post('/promotions/restore/{news_id}', [App\Http\Controllers\PromotionsController::class, 'restorePromotion'])->name('promotions.restorePromotion');








/* Imagenes */
Route::get('/images/create', [App\Http\Controllers\ImagesController::class, 'create'])->name('images.create');
Route::post('/images/saveimagen', [App\Http\Controllers\ImagesController::class, 'saveimagen'])->name('images.saveimagen');
Route::get('/select-server', [ImagesController::class, 'selectServer'])->name('images.selectServer');

/* Categorias */
Route::get('/categories', [App\Http\Controllers\NewCategoryController::class, 'index'])->name('categories.index');

//Metodos
Route::get('/categories/create', [App\Http\Controllers\NewCategoryController::class, 'create'])->name('categories.create');


Route::post('/categories', [App\Http\Controllers\NewCategoryController::class, 'store'])->name('categories.store');

//ruta el metodo delete
Route::delete('/categories/{id}', [App\Http\Controllers\NewCategoryController::class, 'destroy'])->name('categories.destroy');
// Rutas para editar y actualizar
Route::get('/categories/{id}/edit', [App\Http\Controllers\NewCategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [App\Http\Controllers\NewCategoryController::class, 'update'])->name('categories.update');
// Ruta para mostrar categorias eliminados
Route::get('/categories/deleteRegister', [App\Http\Controllers\NewCategoryController::class, 'show'])->name('categories.deleteRegister');
// Ruta para eliminar categorias
Route::delete('/categories/{id}/delete', [App\Http\Controllers\NewCategoryController::class, 'destroy'])->name('categories.destroy');
// Ruta para restaurar categorias (cambiar 'is_active' a 1)
Route::post('/categories/restore/{id}', [App\Http\Controllers\NewCategoryController::class, 'restoreCategory'])->name('categories.restoreCategory');




// RUTA PARA AUTORES
Route::get('/authors', [App\Http\Controllers\AuthorsController::class, 'index'])->name('authors.index');
// Ruta para almacenar el nuevo autor (POST)
Route::post('/authors/create', [App\Http\Controllers\AuthorsController::class, 'createAuthor'])->name('authors.createAuthors');
// Ruta para el formulario de creación de autor (GET)
Route::get('/authors/create', [App\Http\Controllers\AuthorsController::class, 'create'])->name('authors.create');

// Ruta para mostrar el formulario de edición del autor (GET)
Route::get('/authors/{id_author}/edit', [App\Http\Controllers\AuthorsController::class, 'editAuthor'])->name('authors.editAuthor');
Route::put('/authors/{id_author}', [App\Http\Controllers\AuthorsController::class, 'updateAuthor'])->name('authors.updateAuthor');
Route::post('/authors/showImages', [App\Http\Controllers\AuthorsController::class, 'showImages'])->name('authors.showImages');
// Ruta para mostrar autores eliminados
Route::get('/authors/deleteRegister', [App\Http\Controllers\AuthorsController::class, 'show'])->name('authors.deleteRegister');
// Ruta para eliminar autores
Route::delete('/authors/{id_author}/delete', [App\Http\Controllers\AuthorsController::class, 'destroy'])->name('authors.destroy');
// Ruta para restaurar autores (cambiar 'is_active' a 1)
Route::post('/authors/restore/{id_author}', [App\Http\Controllers\AuthorsController::class, 'restoreAuthor'])->name('authors.restoreAuthor');


// Ruta para actualizar el autor (PUT/PATCH)
// Route::put('/authors/{id}', [App\Http\Controllers\AuthorsController::class, 'update'])->name('authors.update');


//ruta el metodo delete
Route::delete('/authors/{id}', [App\Http\Controllers\AuthorsController::class, 'destroy'])->name('authors.destroy');










Route::get('/contacts', [App\Http\Controllers\ContactsController::class, 'index'])->name('contacts.index');


/* INICIA RUTAS PARA Formularios */
// Route::get('/forms', [App\Http\Controllers\FormsController::class, 'index'])->name('forms.index');
// Route::get('/forms/create', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.create');
// Route::get('/forms/createForm', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.createForm');
// Route::post('/save-form-builder', [App\Http\Controllers\FormsController::class, 'saveForm'])->name('forms.saveForm');

// /*RUTAS PARA VISTA PREVIA DEL FORMULARIO*/
// Route::get('/forms/{forms}', [App\Http\Controllers\FormsController::class, 'showFormPreview'])->name('forms.viewPreviewForm');
// Route::put('/forms/{id}/updateForm', [App\Http\Controllers\FormsController::class, 'updateForm'])->name('forms.updateForm');
// Route::get('/forms/{id}/editForm', [App\Http\Controllers\FormsController::class, 'editForm'])->name('forms.editForm');
// //RUTA PARA BORRAR
// //RUTAS PARA ELIMINACION DE FORMULARIOS
// // Ruta para mostrar artículos eliminados
// Route::get('/forms/deleteRegister', [App\Http\Controllers\FormsController::class, 'show'])->name('forms.deleteRegister');
// // Ruta para eliminar formularios
// Route::delete('/forms/{id}/delete', [App\Http\Controllers\FormsController::class, 'destroy'])->name('forms.destroy');

// Ruta para mostrar artículos eliminados
Route::get('/forms/deleteRegister', [App\Http\Controllers\FormsController::class, 'show'])->name('forms.deleteRegister');

// Rutas para otros formularios
Route::get('/forms', [App\Http\Controllers\FormsController::class, 'index'])->name('forms.index');
Route::get('/forms/create', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.create');
Route::get('/forms/createForm', [App\Http\Controllers\FormsController::class, 'create'])->name('forms.createForm');
Route::post('/save-form-builder', [App\Http\Controllers\FormsController::class, 'saveForm'])->name('forms.saveForm');

// Ruta para vista previa del formulario
Route::get('/forms/{forms}', [App\Http\Controllers\FormsController::class, 'showFormPreview'])->name('forms.viewPreviewForm');

// Ruta para editar un formulario
Route::get('/forms/{id}/editForm', [App\Http\Controllers\FormsController::class, 'editForm'])->name('forms.editForm');

// Ruta para actualizar un formulario
Route::put('/forms/{id}/updateForm', [App\Http\Controllers\FormsController::class, 'updateForm'])->name('forms.updateForm');

// Ruta para eliminar formulario
Route::delete('/forms/{id}/delete', [App\Http\Controllers\FormsController::class, 'destroy'])->name('forms.destroy');
// Ruta para restaurar formulario (cambiar 'is_active' a 1)
Route::get('/forms/restore/{form_id}', [App\Http\Controllers\FormsController::class, 'restoreForm'])->name('forms.restoreForm');





/* Galerias */

Route::resource('galeries', GaleriesController::class);
Route::get('/galeries', [App\Http\Controllers\GaleriesController::class, 'index'])->name('galeries.index');
Route::get('/galeries/create', [App\Http\Controllers\GaleriesController::class, 'create'])->name('galeries.create');
Route::post('/galeries', [App\Http\Controllers\GaleriesController::class, 'saveGalleries'])->name('galeries.saveGalleries');
Route::put('/galeries/{gallery_id}', [App\Http\Controllers\GaleriesController::class, 'update'])->name('galeries.update');
Route::get('/galeries/edit/{gallery_id}', [App\Http\Controllers\GaleriesController::class, 'editGaleries'])->name('galeries.edit');
Route::get('galeries/{gallery_id}/preview', [App\Http\Controllers\GaleriesController::class, 'preview'])->name('galeries.preview');
Route::post('/galeries/showImages', [App\Http\Controllers\GaleriesController::class, 'showImages'])->name('galeries.showImages');
// Route::delete('/galeries/{gallery_id}/delete', [App\Http\Controllers\GaleriesController::class, 'deleteGalleries'])->name('galeries.deleteGalleries');

// Ruta para mostrar galerias eliminadas
Route::get('/galeries/deleteRegister', [App\Http\Controllers\GaleriesController::class, 'show'])->name('galeries.deleteRegister');
// Ruta para eliminar galerias
Route::delete('/galeries/{gallery_id}/delete', [App\Http\Controllers\GaleriesController::class, 'destroy'])->name('galeries.destroy');
// Ruta para restaurar galerias (cambiar 'is_active' a 1)
Route::post('/galeries/restore/{gallery_id}', [App\Http\Controllers\GaleriesController::class, 'restoreGallery'])->name('galeries.restoreGallery');


/*Roles roles rol */

Route::get('/roles', [App\Http\Controllers\RolController::class, 'index'])->name('roles.index');

// Route::resource('roles', RolController::class);

// Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
 
Route::get('/roles/create', [App\Http\Controllers\RolController::class, 'create'])->name('roles.create');
Route::post('/roles/saveRol', [App\Http\Controllers\RolController::class, 'saveRol'])->name('roles.saveRol');

// Rutas para eliminar rol
Route::delete('/roles/{id}/delete', [App\Http\Controllers\RolController::class, 'destroy'])->name('roles.destroy');




/*usuarios nuevo pruebas user usuario */
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
//Traer el edtiar
//Redireccion para el hacer editar
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'editUser'])->name('users.editUser');
//Hacemos el put
Route::put('/users/update/{id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('users.updateUser');
// Rutas para eliminar usuario
Route::delete('/users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
//Rutas para crear y traer usuarios
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');

Route::post('/users/saveUser', [App\Http\Controllers\UserController::class, 'saveUser'])->name('users.saveUser');

//RUTAS PARA ELIMINACION DE USUARIOS
// Ruta para mostrar usuarios activos
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

// Ruta para mostrar usuarios desactivados
Route::get('/users/deleteRegister', [App\Http\Controllers\UserController::class, 'show'])->name('users.deleteRegister');

// Ruta para desactivar un usuarios
Route::post('users/{id}', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('users.deleteUser');

// Ruta para restaurar un usuarios
Route::get('/users/restore/{id}', [App\Http\Controllers\UserController::class, 'restoreUser'])->name('users.restoreUser');

// Ruta para mostrar usuarios en espera
Route::get('/usuarios-en-espera', [UserController::class, 'waitingUsers'])->name('users.waitingUsers');

//RUTAS Pautorizacion autorizacion
// Ruta para mostrar usuarios con clientes
// Route::get('/bienvenido-usuario', [App\Http\Controllers\UserController::class, 'welcomeClient'])->name('users.welcomeClient');
Route::get('/welcomeClient', [UserController::class, 'welcomeClient'])->name('welcomeClient');












































/* End Routes of Views */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
