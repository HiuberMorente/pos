// CARGAR TABLAS DINÁMICAS PRODUCTOS
$.ajax({

    url:"ajax/ProductsDatatableAjax.php",
    success:function(respuesta){

        console.log("respuesta", respuesta);

    }

});