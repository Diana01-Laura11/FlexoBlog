<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ClientsController extends Controller
{
    // public function index()ORIGINAL
    // {
    //     // Obtener solo los clientes activos
    //     $clients = Clients::where('is_active', true)->paginate(11); // Usamos paginate para paginar los resultados
    //     return view('clients.index', compact('clients')); // Pasa la variable a la vista

 
    // }

  

    public function index()
    {
        // Obtener el usuario autenticado
        $authUser = Auth::user();

        // Verificar si el usuario es un administrador
        if ($authUser->role->name == 'admin') {
            // Si es admin, obtener todos los clientes activos asociados a él desde la tabla customer_user
            $clients = DB::table('customer_user')
                ->join('customers', 'customer_user.customer_id', '=', 'customers.id')
                ->where('customer_user.user_id', $authUser->id)  // Asegura que el cliente está asociado al usuario logueado
                ->where('customers.is_active', true)  // Filtrar clientes activos
                ->paginate(11);  // Paginación de 11 resultados por página
        } else {
            // Si no es admin, obtener solo los clientes activos asociados al usuario desde customer_user
            $clients = DB::table('customer_user')
                ->join('customers', 'customer_user.customer_id', '=', 'customers.id')
                ->where('customer_user.user_id', $authUser->id)  // Asegura que el cliente está asociado al usuario logueado
                ->where('customers.is_active', true)  // Filtrar clientes activos
                ->paginate(11);  // Paginación de 11 resultados por página
        }

        // Pasar los clientes a la vista
        return view('clients.index', compact('clients'));
    }













    public function create()
    {
        return view('clients.createClient');
    }


    // FUNCION PARA CREAR ARTICULOS
    public function saveCustomer(Request $request)
    {
        //  dd($request->all()); // Muestra todos los datos enviados por el formulario
        // Validamos los campos que enviara al formulario, para ello lo llamamos del modelo
        $validated = $request->validate([
            'business_name' => 'required|string|max:150', //Razón Social
            'trade_name' => 'required|string|max:150', //Nombre comercial
            'rfc' => 'required|string|max:50', //RFC
            'address' => 'required|string', //Dirección
            'manager_first_name' => 'required|string|max:100', //Nombre (de Encargado)
            'manager_last_name' => 'required|string|max:100', //Apellido (de encargado)
            'manager_email' => 'required|string|max:100', //email (de encargado)
            'manager_phone' => 'required|string|max:100', //teléfono (de encargado)
            'company_phone' => 'required|string|max:100', //Teléfono de la empresa
            'url' => 'required|string|max:100',
            // 'password' => 'required|string',
            // //Hacemos el join con autores validando que llame su id para traer contenido
            // 'author_id' => 'required|integer|exists:authors,id_author', // Asegura que el autor existe
            // 'category_id' => 'required|integer|exists:new_categories,id', //Para validar busca el nombre real de la tabla en la base de datos, y no el nombre del modelo.
            // 'form_id' => 'required|integer|exists:forms,form_id',

            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'business_name.required' => 'La Razón Social es obligatoria.',
            'business_name.max' => 'El Razón Social no puede exceder los 150 caracteres.',

            'trade_name.required' => 'El Nombre comercial es obligatorio.',
            'trade_name.max' => 'El Nombre comercial no puede exceder los 150 caracteres.',

            'rfc.required' => 'El RFC es obligatorio.',
            'rfc.max' => 'El RFC no puede exceder los 50 caracteres.',

            'address.required' => 'Tu Dirección es obligatoria.',

            'manager_first_name.required' => 'El Nombre (de Encargado) es obligatorio.',
            'manager_first_name.max' => 'El Nombre (de Encargado) No puede exceder los 100 caracteres.',

            'manager_last_name.required' => 'Los Apellidos (de encargado)  Son Completos y obligatorios.',
            'manager_last_name.max' => 'Los Apellidos (de encargado) no puede exceder los 100 caracteres.',

            'manager_email.required' => 'El email (de encargado)  Son Completos y obligatorios.',
            'manager_email.max' => 'El email (de encargado) no puede exceder los 100 caracteres.',

            'manager_phone.required' => 'El telefono (de encargado)  Son Completos y obligatorios.',
            'manager_phone.max' => 'El telefono (de encargado) no puede exceder los 100 caracteres.',

            'company_phone.required' => 'El Teléfono de la empresa es obligatorio.',
            'company_phone.max' => 'El Teléfono de la empresa no puede exceder los 100 caracteres.',
            'url.required' => 'La URL del sitio web es obligatorio.',
            // 'password.required' => 'La contraseña es obligatoria.',


        ]);




        // AQUI SI CREA EL ARTICULO
        Clients::create([
            'business_name'   => $validated['business_name'], //Razón Social
            'trade_name'    => $validated['trade_name'], //Nombre comercial
            'rfc'    => $validated['rfc'], //RFC
            'address'    => $validated['address'], //Dirección
            'manager_first_name' => $validated['manager_first_name'], //Nombre (de Encargado)
            'manager_last_name' => $validated['manager_last_name'], //Apellido (de encargado)
            'manager_email'  => $validated['manager_email'], //email (de encargado)
            'manager_phone'  => $validated['manager_phone'], //teléfono (de encargado)
            'company_phone'   => $validated['company_phone'], //Teléfono de la empresa
            'url' => $validated['url'], //url
            // 'password' => $validated['password'], //url
            // 'password' => bcrypt('123456789'), // Contraseña fija solo para pruebas            // Asignar los valores de las fechas
            'created_at' => now(),  // Fecha actual para creation_date
            'updated_at' => now(),  // Fecha actual para modification_date
            // 'created_at' => Carbon::now(),  // Fecha actual para creation_date
            // 'updated_at' => Carbon::now(),  // Fecha actual para modification_date

        ]);

        // Redirigir al listado de articulos
        return redirect()->route('clients.index')->with('mensaje', 'Cliente Creado ¡Exitosamente!');
    }






    //FUNCION PARA EDITAR VALIDAR Y ACTUALIZAR

    public function editCustomer($id)
    {
        // Encuentra promocion por su ID la variable promotionEdit se encargara de setar los valores tanto en back y front
        $customerEdit = Clients::findOrFail($id);


        return view('clients.editClient', compact('customerEdit'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all()); // Muestra todos los datos enviados por el foRMULARIO
        //Validacion de datos de entrada
        $validated = $request->validate([
            'business_name' => 'required|string|max:150', //Razón Social
            'trade_name' => 'required|string|max:150', //Nombre comercial
            'rfc' => 'required|string|max:50', //RFC
            'address' => 'required|string', //Dirección
            'manager_first_name' => 'required|string|max:100', //Nombre (de Encargado)
            'manager_last_name' => 'required|string|max:100', //Apellido (de encargado)
            'manager_email' => 'required|string|max:100', //email (de encargado)
            'manager_phone' => 'required|string|max:100', //teléfono (de encargado)
            'company_phone' => 'required|string|max:100', //Teléfono de la empresa
            'url' => 'required|string|max:100',


            // EN CASO DE ERRORES SE DISPARARAN ESTOS MENSAJES POR SEGUIRDAD
        ], [
            'business_name.required' => 'La Razón Social es obligatoria.',
            'business_name.max' => 'El Razón Social no puede exceder los 150 caracteres.',

            'trade_name.required' => 'El Nombre comercial es obligatorio.',
            'trade_name.max' => 'El Nombre comercial no puede exceder los 150 caracteres.',

            'rfc.required' => 'El RFC es obligatorio.',
            'rfc.max' => 'El RFC no puede exceder los 50 caracteres.',

            'address.required' => 'Tu Dirección es obligatoria.',

            'manager_first_name.required' => 'El Nombre (de Encargado) es obligatorio.',
            'manager_first_name.max' => 'El Nombre (de Encargado) No puede exceder los 100 caracteres.',

            'manager_last_name.required' => 'Los Apellidos (de encargado)  Son Completos y obligatorios.',
            'manager_last_name.max' => 'Los Apellidos (de encargado) no puede exceder los 100 caracteres.',

            'manager_email.required' => 'El email (de encargado)  Son Completos y obligatorios.',
            'manager_email.max' => 'El email (de encargado) no puede exceder los 100 caracteres.',

            'manager_phone.required' => 'El telefono (de encargado)  Son Completos y obligatorios.',
            'manager_phone.max' => 'El telefono (de encargado) no puede exceder los 100 caracteres.',

            'company_phone.required' => 'El Teléfono de la empresa es obligatorio.',
            'company_phone.max' => 'El Teléfono de la empresa no puede exceder los 100 caracteres.',
            'url.required' => 'La URL del sitio web es obligatorio.',
            // 'password.required' => 'La contraseña es obligatoria.',


        ]);




        $customerEdit = Clients::findOrFail($id);

        // Actualiza la promocion
        $customerEdit->update([
            'business_name'   => $validated['business_name'], //Razón Social
            'trade_name'    => $validated['trade_name'], //Nombre comercial
            'rfc'    => $validated['rfc'], //RFC
            'address'    => $validated['address'], //Dirección
            'manager_first_name' => $validated['manager_first_name'], //Nombre (de Encargado)
            'manager_last_name' => $validated['manager_last_name'], //Apellido (de encargado)
            'manager_email'  => $validated['manager_email'], //email (de encargado)
            'manager_phone'  => $validated['manager_phone'], //teléfono (de encargado)
            'company_phone'   => $validated['company_phone'], //Teléfono de la empresa
            'url' => $validated['url'], //url
            'updated_at' => now(),

        ]);


        // Redirigir al listado de noticias
        return redirect()->route('clients.index')->with('mensaje', 'Registro Editado ¡Exitosamente!');
    }


    //FUNCION PARA MOSTRAR LOS REGISTROS ARCHIVADOS ELIMINADOS:

    public function show()
    {
        // Obtener solo los clientes inactivos (eliminados)
        $clientDelete = Clients::where('is_active', false)->paginate(11); // Usamos paginate para paginar los resultados

        // Pasar la variable 'clientDelete' a la vista
        return view('clients.deleteRegister', compact('clientDelete'));
    }


    // //FUNCION PARA ELIMINAR UN REGISTRO NOTA: NO LO ELIMINA SOLO LO OCULTA PARA ESPERAR QUE EL ADMIN LO VUELVA A REACTIVAR
    // public function destroy($id)
    // {
    //     // dd($id);  // Esto imprimirá el ID y detendrá la ejecución
    //     // Buscara  la promocion por su ID
    //     $clientDelete = Clients::findOrFail($id);

    //     // Desactivar  (no eliminarla)
    //     $clientDelete->is_active = false;  // Suponiendo que 'is_active' es un campo booleano
    //     $clientDelete->save();  // Guardar los cambios en la base de datos


    //     // Mensaje de éxito Redireccionar a la lista de categorías
    //     return redirect()->route('clients.index')->with('mensaje', 'Cliente Eliminado "Admin Tiene Posibilidad De Restaurar"');
    // }
    // public function restoreClient($id)
    // {
    //     // Buscar el cliente por su ID
    //     $clientDelete = Clients::findOrFail($id);

    //     // Restaurar el cliente (cambiar 'is_active' a true)
    //     $clientDelete->is_active = true;
    //     $clientDelete->save(); // Guardar los cambios en la base de datos

    //     // Mensaje de éxito y redirección a la lista de clientes activos
    //     return redirect()->route('clients.index')->with('mensaje', 'Cliente Restaurado Con Éxito');
    // }


    public function destroy($id)
    {
        // Buscar el cliente por su ID
        $clientDelete = Clients::findOrFail($id);

        // Desactivar el cliente (cambiar 'is_active' a 0 para desactivarlo)
        $clientDelete->is_active = 0;
        $clientDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes desactivados
        return redirect()->route('clients.index')->with('mensaje', 'Cliente Desactivado Con Éxito, "Admin Tiene Posibilidad De Restaurar"');
    }

    public function restoreClient($id)
    {
        // Buscar el cliente por su ID
        $clientDelete = Clients::findOrFail($id);

        // Restaurar el cliente (cambiar 'is_active' a 1 para activarlo)
        $clientDelete->is_active = 1;
        $clientDelete->save(); // Guardar los cambios en la base de datos

        // Mensaje de éxito y redirección a la lista de clientes activos
        return redirect()->route('clients.index')->with('mensaje', 'Cliente Restaurado Con Éxito');
    }
}
