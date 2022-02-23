
$(document).ready(function () {
    var validar_texto = true;
    
    //Validación de entrada de texto en el campo de texto usando jQuery
    //se activa con cada evento keyup del teclado
    $("#texto").keyup(function(){
        var texto = $(this).val().toLowerCase();
        if(/^([0-9a-záéíóúñ.,-]+\s?)+$/.test(texto)){
            validar_texto = true;
            //Si la validación es correcta ocultaremos el mensaje de error
            $("#error_texto").removeClass("mostrar");   
        }else{
            validar_texto = false;
            //Si la validación es incorrecta mostraeremos el mensaje de error
            $("#error_texto").addClass("mostrar");
        }
        
        
        var xhr;   
            /**
            * Realiza las peticiones de sugerencias al archivo sugerencias.php
            * con la cadena captada en el campo texto usando ajax, cuando hay un 
            * cambio en el estado de la petición llama a la fucnión respuesta() 
            *
            * @return false 
            * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
            * @version 1.0 Estable
            */
            function loadTexto(){
                //Instanciamos el objeto XMLHttpRequest
                xhr = new XMLHttpRequest();
                //Abrir la comunicación con el servidor
                xhr.open("GET", "sugerencias.php?sugerencia=" + texto, true);
                //Capturar el evento de cambio de estado de la petición y llamada
                //a la función manejadora del evento respuesta()
                xhr.addEventListener("readystatechange", respuesta, false);
                //Enviar la petición
                xhr.send();
                
                return false;
            }
            //Cadena vacía para recopilar las opciones
            var lista = "";
            /**
            * Función callback que obtendrá la respuesta de la petición hecha
            * al archivo sugerencias.php mediante ajax, obtiene la respuesta en 
            * formato texto y lo introduce en el elemento <datalist> del fichero
            * formulario.html
            *
            * @autor Juan Carlos Guzmán Domínguez <jcguzmand@gmail.com>
            * @version 1.0 Estable
            */
            function respuesta(){
                //Controlar que la respuesta es válida
                if(xhr.readyState == 4 && xhr.status == 200){
                    //La respuesta obtenida se introduce en una <ul>
                    document.getElementById("text").innerHTML = xhr.responseText;
                }
            }
        //Llamada a la función
        loadTexto();      
    });
});


