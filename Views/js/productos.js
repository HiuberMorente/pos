// CARGAR TABLAS DINÁMICAS PRODUCTOS
$.ajax({
    url:"ajax/datatablePproductos.ajax.php",
    success:function(respuesta){
        console.log("respuesta", respuesta);
    }
});