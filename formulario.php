<!DOCTYPE html>
<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tarea 8 - DWES Formulario</title>
        <style>
            @import url('estilo/estilo.css');
        </style>
        <script src="jquery/jquery-3.2.1.min.js"></script>
        <script src="validaciones.js"></script>
    </head>
    <body>
        <header>
            <img src="imagenes/logo.gif" alt="Logo de la página">
            <h1>Buscador de libros</h1>
        </header>
        <section>
 
            <form id="formulario" action="?" method="get">
                <label for="texto">Introduzca título:</label>
                <input list="text" id="texto" name="texto"/>
                <ul id="text"></ul>
                <span class="error ocultar" id="error_texto">
                    Solo se admiten caracteres alfanúmericos </span>
            </form>
        </section>
    </body>
</html>

