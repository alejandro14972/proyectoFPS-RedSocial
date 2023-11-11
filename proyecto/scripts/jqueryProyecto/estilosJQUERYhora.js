var hoy = new Date();

$(document).ready(function() {

    

    if (hoy.getHours() < 12) {
        console.log("log");
        $("a").css({"font-weight":"bold", "color":"#474343"});
        $("td").css("color", "black");
        $("p").css("color", "white");
        $("#enunciado").css("color", "white")
        $("body").css("background","#13837a"); //color verde pistacho
        //$(".img-fluid").attr("src", "./web/css/imagenes/docencia-online-mediana3.png"); //cambiar imagen logo
    }else{
        $("a").css({"font-weight":"bold", "color":"#474343"});
        $("td").css("color", "white");
        $("p").css("color", "white");
        $("h2").css("color", "white");
        $("label").css("color", "white");
        $("body").css("background","#0F947C");
        //$(".img-fluid").attr("src", "./web/css/imagenes/docencia-online-mediana2.png"); //cambiar imagen logo
    }
});

