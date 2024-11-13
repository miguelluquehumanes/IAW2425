/* Rellena este fichero */
$(document).ready(function () {
    $("#btn-ocultar").click(function () {
        $("#encabezado, .pares").hide();
        //$(".pares").hide();
    });
    $("#btn-mostrar").click(function(){
        $("#encabezado,.pares").show();
    });
});