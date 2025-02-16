

<?php


// <!-- SE CREARA TODA LA LOGICA PARA CONVERSION DE ARCHIVOS DE STRING A JSON   -->

use App\Models\NewsNotice;

function convertArrayToJson(array $array)
{
    // Convertir el array a un string JSON
    $json = json_encode($array);

    // Verificar si hubo un error durante la conversión a JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        return "Error al convertir el array a JSON: " . json_last_error_msg();
    }

    // Retornar el string JSON
    return $json;
}

// Función para convertir string JSON a JSON válido
function convertStringToJson($string)
{
    // Verifica si el string es válido y se puede convertir a un array
    if (is_string($string)) {
        // Decodificar el string JSON a un array
        $decodedArray = json_decode($string, true);

        // Verificar si la decodificación fue exitosa
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decodedArray; // Retorna el array decodificado
        } else {
            // Si hubo un error en la decodificación, retorna un mensaje de error
            return "Error al convertir el string a JSON: " . json_last_error_msg();
        }
    }

    // Si el parámetro no es un string, se retorna un error
    return "El valor no es un string.";
}
