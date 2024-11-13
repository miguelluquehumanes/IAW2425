/* Rellena este fichero */
$(document).ready(function () {
    $("#btn-ocultar").click(function () {
        $("h1, p").hide();
    });
    $("#btn-mostrar").click(function(){
        $("h1, p").show();
    });
});
