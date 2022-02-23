<?php
    /**
    * Gestiona el acceso y modificación de la base de datos. 
    *
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
class gestionLibros {
    /**
    * Establece la conexión con la base de datos. 
    *
    * @param string $servidor Nombre o Ip del servidor.
    * @param string $usuario Nombre del usuario de acceso a la base de datos.
    * @param string $contrasena Contraseña del usuario para acceso a base de datos.
    * @param string $baseDatos Nombre de la base de datos.
    * @return object Objeto de la clase mysqli con la conexión a la base de datos,
    * retorna null si la conexión es fállida.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    function conexion($servidor, $usuario, $contrasena, $baseDatos) {
        //Crear la conexión
        @$mysqli = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

        //Comprobar que la conexión es correcta
        if ($mysqli->connect_errno) {
            return null;
        } else {
            //Establecemos la codificación de caracteres de la conexión
            $mysqli->set_charset("utf8");
            return $mysqli;
        }
    }
    
    /**
    * Consulta la información del autor pasado por parámetro o la del todos los
    * autores si no se pasa nigún parámetro. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idAutor Identificador del autor. Parámetro opcional.
    * @return array Si la consulta es correcta devuelve un array asociativo con
    * todas las filas de la consulta, si la consulta no es correcta devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarAutores($mysqli, $idAutor = -1) {
        //Si no pasamos parámetro id de autor, mostramos todos los autores
        if ($idAutor == -1) {
            $sql = "SELECT * FROM autor";
            //Crear objeto con el resultado de la consulta
            $resultset = $mysqli->query($sql);
            if ($resultset->num_rows > 0 && !$mysqli->error) {
                //Recuperar el resultaod de la consulta
                $resultado = $resultset->fetch_all(MYSQLI_ASSOC);
                return $resultado;
            } else {
                return null;
            }
            //Si pasamos parámetro id de autor, mostramos datos del autor asociado
        } else {
            $sql = "SELECT * FROM autor where id='$idAutor'";
        }
        //Crear objeto con el resultado de la consulta
        $resultset = $mysqli->query($sql);
        if ($resultset->num_rows > 0 && !$mysqli->error) {
            //Recuperar el resultaod de la consulta
            $resultado = $resultset->fetch_assoc();
            return $resultado;
        } else {
            return null;
        }
    }
    
    /**
    * Consulta los datos del autor pasado por parámetro. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idAutor Identificador del libro que se pretende buscar.
    * @return array Si la consulta es correcta devuelve un array asociativo con
    * con la fila devuelta, si la consulta no es correcta devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarDatosAutor($mysqli, $idAutor) {

        $sql = "SELECT * FROM autor where id='$idAutor'";
        //Crear objeto con el resultado de la consulta
        $resultset = $mysqli->query($sql);
        if ($resultset->num_rows > 0 && !$mysqli->error) {
            //Recuperar el resultaod de la consulta
            $resultado = $resultset->fetch_assoc();
            return $resultado;
        } else {
            return null;
        }
    }

    /**
    * Consulta el listado de libros del autor pasado por parámetro o todos los
    * libros si no se pasa nigún parámetro. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idAutor Identificador del autor. Parámetro opcional.
    * @return array Si la consulta es correcta devuelve un array asociativo con
    * todas las filas de la consulta, si la consulta no es correcta devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarLibros($mysqli, $idAutor = -1) {
        //Si no pasamos parámetro id de autor, mostramos todos los libros
        if ($idAutor == -1) {
            $sql = "SELECT titulo FROM libro";

            $resultset = $mysqli->query($sql);
            if ($resultset->num_rows > 0 && !$mysqli->error) {
                $resultado = $resultset->fetch_all(MYSQLI_ASSOC);
                return $resultado;
            } else {
                return null;
            }
            //Si pasamos parámetro id de autor, mostramos los libros del autor asociado
        } else {
            $sql = "SELECT * FROM libro where id_autor='$idAutor'";
            //Crear objeto con el resultado de la consulta
            $resultset = $mysqli->query($sql);
            if ($resultset->num_rows > 0 && !$mysqli->error) {
                //Recuperar el resultaod de la consulta
                $resultado = $resultset->fetch_all(MYSQLI_ASSOC);
                return $resultado;
            } else {
                return null;
            }
        }
    }

    /**
    * Consulta los datos del libro pasado por parámetro. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idLibro Identificador del libro que se pretende buscar.
    * @return array Si la consulta es correcta devuelve un array asociativo con
    * con la fila devuelta, si la consulta no es correcta devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarDatosLibro($mysqli, $idLibro) {

        $sql = "SELECT l.id, l.titulo, l.f_publicacion, l.id_autor, a.nombre, "
                . "a.apellidos FROM libro l "
                . "INNER JOIN autor a "
                . "ON l.id_autor = a.id "
                . "WHERE l.id = '$idLibro';";
        //Crear objeto con el resultado de la consulta
        $resultset = $mysqli->query($sql);
        if ($resultset->num_rows > 0 && !$mysqli->error) {
            //Recuperar el resultaod de la consulta
            $resultado = $resultset->fetch_assoc();
            return $resultado;
        } else {
            return null;
        }
    }
 
    /**
    * Elimina el autor pasado por parámetro y los libros asociados a él. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idAutor Identificador del autor que se prentende eliminar.
    * @return boolean Retorna true si la operación de borrado ha tenido éxito,
    * retorna false si no ha tenido éxito.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function borrarAutor($mysqli, $idAutor) {
        //Deshabilitar autocommit
        $mysqli->autocommit(false);

        //Iniciamos transacción
        $mysqli->begin_transaction();

        //Unsamos una variable para controlar la correcta ejecución
        $all_query_ok = true;

        $sql_1 = "DELETE FROM libro where id_autor='$idAutor'";
        $sql_2 = "DELETE FROM autor where id='$idAutor'";

        //Ejecutamos las sentencias sql y chequeamos que se hacen correctamente
        //Borramos libros del autor referenciado por su id
        $mysqli->query($sql_1) ? null : $all_query_ok = false;
        //Borramos autor referenciado por su id
        $mysqli->query($sql_2) ? null : $all_query_ok = false;

        //Comprobar que las operaciones han salido bien
        if ($all_query_ok) {

            //Si no hay errores hacemos permanentes los cambios en la BD
            $mysqli->commit();
            return true;
        } else {
            //Si hay errores cancelar la transacción en curso
            $mysqli->rollback();
            return false;
        }

        //Habilitar de nuevo autocommit
        $mysqli->autocommit(true);
    }
    
    /**
    * Elimina el libro pasado por parámetro. 
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param integer $idLibro Identificador del libro que se prentende eliminar.
    * @return boolean Retorna true si la operación de borrado ha tenido éxito,
    * retorna false si no ha tenido éxito.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function borrarLibro($mysqli, $idLibro) {

        $sql = "DELETE FROM libro where id='$idLibro'";
        //Ejecutar la operación de borrado
        $mysqli->query($sql);
        if (!$mysqli->error) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
    * Consulta la información de todos los autores y de todos los libros asociados
    * a ellos.
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @return object Si la consulta es correcta devuelve un objeto de la clase 
    * mysqli_result con el resultado de la consulta, si la consulta es incorrecta
    * devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarAutoresLibros($mysqli) {

        $sql = "SELECT nombre, apellidos, nacionalidad, titulo 
                FROM autor 
                INNER JOIN libro
                WHERE autor.id = libro.id_autor;";

        //Crear objeto con el resultado de la consulta
        $resultset = $mysqli->query($sql);
        //Comprobar que la consulta ha tenido éxito
        if ($resultset->num_rows > 0 && !$mysqli->error) { 
            return $resultset;
        } else {
            return null;
        }
    }
    
    /**
    * Consulta los autores y los libros asociados según la sugerencia introducida  
    * en el input del formulario.
    *
    * @param object $mysqli Objeto con la conexión a la base de datos.
    * @param string $sugerencia String con la sugerencia del nombre de autor
    * enviada por ajax.
    * @return array asociativo Si la consulta es correcta un array asociativo
    * con el resultado del autor y los libros asociados según la sugerencia, si
    * la consulta es incorrecta devuelve null.
    * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
    * @version 1.0 Estable
    */
    public function consultarSugerencias($mysqli, $sugerencia) {

        $sql = "SELECT nombre, apellidos, nacionalidad, titulo 
                FROM autor 
                INNER JOIN libro
                WHERE autor.id = libro.id_autor AND autor.nombre LIKE '$sugerencia%';";

        //Crear objeto con el resultado de la consulta
        $resultset = $mysqli->query($sql);
        //Comprobar que la consulta ha tenido éxito
        if ($resultset->num_rows > 0 && !$mysqli->error) { 
            //Recuperar el resultaod de la consulta
            $resultado = $resultset->fetch_all(MYSQLI_ASSOC);
            return $resultado;
        } else {
            return null;
        }
    }
}
 