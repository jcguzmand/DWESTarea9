<!DOCTYPE html>
<html>
    <head>
        <title>Tarea - 9 Api Pokemon</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            @import url('estilo/estilo1.css');
        </style>
    </head>
    <body>
        <h1>Buscador de Pokemon</h1>
        <div id="container">
            <form method="get" action="?">
                <label>Introduzca nombre o un número:</label><br>
                <input type="text" name="nombre" id="entrada"></input>
                <input type="submit" value="Buscar" id="boton"></input>
            </form>

            <?php
            if ($_GET) {

                if (isset($_GET["nombre"]) && $_GET["nombre"] != "") {
                    $nombre = $_GET["nombre"];

                    $api = curl_init("https://pokeapi.co/api/v2/pokemon/$nombre");
                    curl_setopt($api, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($api);
                    curl_close($api);

                    $json = json_decode($response);

                    if (!$json) {
                        echo "<h2>No existe el Pokemon buscado.</h2>";
                    } else {

                        echo "<h2>NOMBRE</h2>";
                        echo "<p> {$json->species->name} </p>";

                        echo "<h2>TIPO</h2>";
                        echo "<p> {$json->types[0]->type->name} </p>";

                        echo "<h2>HABILIDADES</h2>";

                        foreach ($json->abilities as $k => $v) {
                            echo "<li> {$v->ability->name} </li>";
                        }

                        echo "<h2>IMAGEN</h2>";
                        echo "<img src=' {$json->sprites->back_default} '>";
                        echo "<img src=' {$json->sprites->front_default} '>";
                        ?>
                    </div>
                </body>
            </html>

            <?php
        }
    }
}
?>




