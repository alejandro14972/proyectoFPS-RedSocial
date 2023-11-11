
    $( document ).ready(function() {
        $(".table").hide();
      });
    
    ///-------------Script ver mensajes recibidos, hace una petición al peticionmensajesserver.php

    function verMensajes() {
        $(".table").show().css("color","white");
        $("#mostrar").empty();
        $("#formulario").empty();
        $("#enviadoCambio").text("Enviado por:");
        $("#mensajeId").show();
        $("#boton1").attr('disabled','disabled');
        $("#boton2").removeAttr('disabled');
        $("#boton3").removeAttr('disabled');

        var aux = document.getElementById("correo").innerHTML;

        console.log(aux);

        $.post("peticionMensajesServer.php", {
            correo: aux
        }, function(objec2) {

            console.log(objec2);

            if (objec2 == "") {
                document.getElementById("mostrar").innerHTML = "No tienes mensajes";
            } else {
                for (let i = 0; i < objec2.length; i++) {

                    var mensajes = "<tr><td>" + objec2[i][0].id + "</td><td>" +
                                                objec2[i][0].emisor + "</td><td>" +
                                                objec2[i][0].asunto + "</td><td>" +
                                                objec2[i][0].mensajeria + "</td><td>" +
                        "<input type='button' id='" + objec2[i][0].id + "' class='btn btn-warning idValor' value='Abrir mensaje' onclick='verMensajesporId()'></td><tr>";
                    document.getElementById("mostrar").innerHTML += mensajes;
                    $("#borrarCambio").hide();
                    $(".delete").hide(); //necesito esto aquí ya que si borro el mensaje, se lo borro al emisor también.
                }
            }

        });
    }



    ///-------------Script ver mensajes enviados, hace una petición al peticionmensajeEnviados.php

    function verMensajesEnviados() {
        $(".table").show().css("color","white");
        $("#mostrar").empty();
        $("#formulario").empty();
        $("#borrarCambio").show();
        $("#enviadoCambio").text("Enviado a:");
        $("#mensajeId").hide();
        $("#boton2").attr('disabled','disabled');
        $("#boton3").removeAttr('disabled');
        $("#boton1").removeAttr('disabled');

        var aux = document.getElementById("correo").innerHTML;

        console.log(aux);


        $.post("peticionMensajesEnviados.php", {
            correo: aux
        }, function(objec2) {

            console.log(objec2);

            if (objec2 == "") {

                document.getElementById("mostrar").innerHTML = "No tienes mensajes";
            } else {

                for (let i = 0; i < objec2.length; i++) {

                    var mensajes = "<tr><td>" + objec2[i][0].id + "</td><td>" +
                        objec2[i][0].receptor + "</td><td> " +
                        objec2[i][0].asunto + "</td><td>" +
                        objec2[i][0].mensajeria + "</td><td>" +
                        "<input type='button' id='" + objec2[i][0].id + "' class='btn btn-warning idValor' value='Abrir mensaje' onclick='verMensajesporId()'></td><td>" +
                        "<a href = ./borrarMensaje.php?mensaje_borrar=" +
                        objec2[i][0].id + "><i class='fa fa-trash btn btn-danger'></i></a></td><tr>";
                    document.getElementById("mostrar").innerHTML += mensajes;

                }
            }

        });
    }

    ///-------------Script ver enviar mensajes

    function nuevoMensaje() {
        $("#mostrar").empty();
        $(".table").hide();
        $("#mensajeId").hide();
        $("#boton3").attr('disabled','disabled');
        $("#boton2").removeAttr('disabled');
        $("#boton1").removeAttr('disabled');

        var aux = document.getElementById("correo").innerHTML;

        console.log(aux);

        var formulario =
            "<form action='mensajeria2.php' method='post'>" +
            "<div class='form-group'><br>" +
            "<label><input type='text' id='emisor2' class='form-control' name='emisor' value=" + aux + " required></label><br>" +
            "<label>Para: <input type='text' id='receptor' class='form-control busqueda' name='receptor' required/></label><br>" +
            "<span>Sugerencias: <span><i id= resultado></i><br>" +
            "<label>Asunto: <input type='text' id='asunto' class='form-control' name='asunto' required/></label><br>" +
            "Mensaje:<textarea id='mensaje' name='mensaje' rows='10' cols='50' class='form-control' placeholder='250 carácteres' size='250' required></textarea><br>" +
            "<input id='boton' type='submit' value='Enviar mensaje' name ='boton'>" +
            "</div>" +
            "</form>";

        document.getElementById("formulario").innerHTML += formulario;

        $("#emisor2").hide(); //se oculta el input emisor

        //////Sugerencias de correos al ir escribiendo //////

        $(document).ready(function() {

            $(".busqueda").keyup(function(event) { //pasamos un parametro 
                var t = $(".busqueda").val();
                console.log(t);

                $.get("sugerencias.php", {
                    letra: t
                }, function(objec) {
                    console.log(objec);
                    document.getElementById("resultado").innerHTML = objec;
                });
            });
        });
    }
    ///-------------Script leer información del mensajes u hide de todo y dar al server un id y pintar


    function verMensajesporId() {
        $("#mensajeId").empty();
        $("#mensajeId").show();
        
        //$(".table").hide();
       //$("#idValor").attr('disabled', 'disabled');
       

        $(document).ready(function() {
            $('.idValor').click(function() {
                var aux = ($(this).attr('id'));
                console.log(aux);
                $.post("verMensaje.php", {
                    id: aux
                }, function(objec2) {

                    console.log(objec2);

                    if (objec2 == "") {

                        document.getElementById("mensajeId").innerHTML = "No tienes mensajes";
                    } else {
                        var mensajes = 
                            "<input type='button id='regresar' class='btn btn-success volver' value='Regresar' onclick='recargar()'>" +
                            "<h3>Enviado por: </h3>" + objec2[0][0].receptor +
                            "<h3>Asunto: </h3>" + objec2[0][0].asunto +
                            "<h3>Mensaje: </h3>" + objec2[0][0].mensajeria

                        ;
                        document.getElementById("mensajeId").innerHTML += mensajes;

                    }

                });
            });
        });
    }

    ///-------------Script jquery trygger
    function recargar() {
        // permite esconder el mensaje
        $("#mensajeId").empty();
       // window.location.reload();
       //$(".volver").remove();
       $("#boton2").trigger("click");
    }
