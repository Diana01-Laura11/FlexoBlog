<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('images.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.create');
    }
    public function saveimagen(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $validated = $request->validate([
                'carpeta' => 'required|string|max:20', // Se asegura que la carpeta no tenga más de 20 caracteres
                'imagen' => 'required|image|mimes:jpeg,png,webp,gif|max:2048', // Se valida que el archivo sea una imagen con extensión correcta y no supere los 2MB
            ]);

            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $location = "assets/imagenes-blog/" . $validated['carpeta'];
                $filename = $file->getClientOriginalName();

                if (file_exists($location . '/' . $filename)) {
                    $filename =   uniqid() . '-' . $filename;
                }

                $file->move($location, $filename);

                return redirect()->route('images.create')->with('mensaje', 'Imagen importada exitosamente');
            }

            // Si no se cargó una imagen
            return redirect()->route('images.create')->with('error', 'No se ha cargado ninguna imagen.');
        } catch (\Exception $e) {
            return redirect()->route('images.create')->with('error', 'Ocurrió un error al intentar cargar la imagen. Por favor, intente nuevamente.');
        }
    }

}
