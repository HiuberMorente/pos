
//editar cliente
$(".btnEditClient").click(function(){
   let idClient = $(this).attr("idClient");

   let data = new FormData();
   data.append("idClient", idClient);

   $.ajax({
       url: "ajax/ClientAjax.ajax.php",
       method: "POST",
       data: data,
       cache: false,
       contentType: false,
       processData: false,
       dataType: "json",
       success: function(response){
           console.log(response["direccion"]);

           $("#idClient").val(response["id"]);
           $("#editarClienteNombre").val(response["nombre"]);
           $("#editarClienteApellido").val(response["apellido"]);
           $("#editarNIT").val(response["nit"]);
           $("#editarEmail").val(response["email"]);
           $("#editarTelefono").val(response["telefono"]);
           $("#editarDireccion").val(response["direccion"]);
           $("#editarFechaRegistro").val(response["fechaRegistro"]);
       }
   });
});

//delete client

$(".btnEliminarCliente").click(function(){
    let idCliente = $(this).attr("idClient");

    Swal.fire({
        icon: "warning",
        title: "¿Está seguro de eliminar al cliente?",
        text: "¡Si no lo está, puede cancelar la acción!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar cliente!",
    }).then((result) => {
        if(result.value){
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }
    });
});