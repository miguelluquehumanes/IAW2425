/* Rellena este fichero */
$(document).ready(function () {
    $("#btn-aumentar").click(function () {
        $("#encabezado, .pares").animate({
            fontSize: '+=23px'
        });
        $("#encabezado, .pares").addClass("azul");
    });
    $("#btn-disminuir").click(function(){
        $("#encabezado,.pares").animate({
            fontSize: '-=23px'
        });
        $("#encabezado, .pares").removeClass("azul");
    });
});