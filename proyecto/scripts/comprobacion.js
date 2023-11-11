document.getElementById("btnValidar").addEventListener('click', validarNombre, false);
document.getElementById("btnValidar").addEventListener('click', validarContraseña, false);
document.getElementById("btnValidar").addEventListener('click', revalidarContraseña, false);
document.getElementById("btnValidar").addEventListener('click', validarDescripcion, false);
        var nombreExpresion = new RegExp(/^[a-zA-Z]{1,11}$/);
        var ContraseñaExpresion = new RegExp(/^[1-9]{1,11}$/);  ///^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/
        var descripcionExpresion = new RegExp(/^[a-zA-Z ]{1,300}$/);
        

    function validarNombre() {
        comNombre = document.getElementById("nombre").value;
        var comNombre2 = document.getElementById("nombre");
        console.log(comNombre);
        if (comNombre =="") {
            //alert("campo vacio");
            document.getElementById("comprobacionNombre").innerHTML = "   El campo de Nombre está vacio";
            comNombre2.style.borderColor = "red";
            return false;
        }else if (nombreExpresion.test(comNombre)){
            //alert("Nombre valido");
            comNombre2.style.borderColor = "green";
            return true;
        }else{
            //alert("recuerde solo letras y maximo de 11 caracteres");
            document.getElementById("comprobacionNombre").innerHTML = "   El nombre introducido no es valido. Solo debe de contener letras";
            comNombre2.style.borderColor = "red";
            return false;
        }
    }

    /*
        VALIDACION CONTRASEÑA
    */

    function validarContraseña() {
        comContraseña = document.getElementById("contraseña").value;
        var comContraseña2 = document.getElementById("contraseña");
        console.log(comContraseña);
        if (comContraseña =="") {
            //alert("campo vacio");
            document.getElementById("comprobacionContraseña").innerHTML = "   El campo contraseña esta vacio";
            comContraseña2.style.borderColor = "red";
            return false;
        }else if (ContraseñaExpresion.test(comContraseña)){
            //alert("Nombre valido");
            comContraseña2.style.borderColor = "green";
            return true;
        }else{
            //alert("Apellidos no validos")
            document.getElementById("comprobacionContraseña").innerHTML = "   La contraseña debe de contener digitos. por ahora :)";
            comContraseña2.style.borderColor = "red";
            return false;
        }
    }

    function revalidarContraseña() {
        var comReContraseña = document.getElementById("Rcontraseña").value; //contraseña repetida
        var comContraseña1 = document.getElementById("contraseña").value; //contraseña inicial
        var comContraseñaColor = document.getElementById("Rcontraseña"); //colores

        if (comContraseña1 =="") {
            //alert("campo vacio");
            document.getElementById("comprobacionRcontraseña").innerHTML = "   El campo contraseña esta vacio";
            comContraseñaColor.style.borderColor = "red";
            return false;
        }else if (comContraseña1 == comReContraseña){
            comContraseñaColor.style.borderColor = "green";
            return true;
        }else{
            //alert("Apellidos no validos")
            document.getElementById("comprobacionRcontraseña").innerHTML = "   La contraseña no coincide";
            comContraseñaColor.style.borderColor = "red";
            return false;
        }
        
    }


    function validarDescripcion() {
        comDescripcions = document.getElementById("descripcion").value;
        var comDescripcion2 = document.getElementById("descripcion");
        
        if (comDescripcions =="") {
            //alert("campo vacio");
            document.getElementById("comprobacionApellidos").innerHTML = "   El campo apellidos esta vacio";
            comDescripcion2.style.borderColor = "red";
            return false;
        }else if (descripcionExpresion.test(comDescripcions)){
            //alert("Nombre valido");
            comDescripcion2.style.borderColor = "green";
            return true;
        }else{
            //alert("Apellidos no validos")
            document.getElementById("comprobacionApellidos").innerHTML = "   Los apellidos no son validos";
            comDescripcion2.style.borderColor = "red";
            return false;
        }
    }
