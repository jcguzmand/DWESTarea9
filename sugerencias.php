<?php

//Incluimos el archivo con los métodos para manejar la base de datos
include "gestionLibros.php";

//Creamos objeto gestionLibros
$bd = new gestionLibros();

//Crear conexión con la base de datos
$mysqli = $bd->conexion("localhost", "juancarlos", "1234", "libros");

//Obtener el parámetro GET de la URL
$sugerencia = $_REQUEST["sugerencia"];

//Creamos el array que contendrá las coincidencias
$sugerencias_autores = "";

//Comprobamos que el parámetro GET de la URL contiene datos 
if ($sugerencia !== "") {

    //Recuperar datos de la consulta según la sugerencia extraida
    $lista_autores = $bd->consultarSugerencias($mysqli, $sugerencia);
    
    //Comprobamos que el array devuelto por la consulta no está vacío
    if (isset($lista_autores)) {
        //Si el array contiene datos formamos una cadena para mostrarlos en 
        //una lista desordenada, mostrando cada autor en un encabezado <h4>
        foreach ($lista_autores as $key => $autor) {

            $anterior = $key - 1;
            $posterior = $key + 1;

            if ($key == 0) {
                $sugerencias_autores .= "<h4>" . $autor["nombre"] . "</h4><ul>";
            } else if ($autor["nombre"] != $lista_autores[$anterior]["nombre"]) {
                $sugerencias_autores .= "<h4>" . $autor["nombre"] . "</h4><ul>";
            }
            $sugerencias_autores .= "<li>" . $autor["titulo"] . "</li>";
            if ($key == count($lista_autores) - 1) {
                $sugerencias_autores .= "</ul>";
            } else if ($autor["nombre"] != $lista_autores[$posterior]["nombre"]) {
                $sugerencias_autores .= "<ul>";
            }
        }
    } else {
        //Si la consulta a la base de datos no trae ninguna sugerencia
        $sugerencias_autores = "";
    }
} else {
    //Si la sugerencia de la url viene vacía la salida tambien irá vacía
    $sugerencias_autores = "";
}
//Resultado de la consulta
echo($sugerencias_autores);
?>
