$(document).ready(function (){
    $('#selectNitCF').on('change', function (){
        var selected = $(this).val();


        if(selected === 'NIT'){
            console.log('si es NIT 👋 👋 👋')
            $(this).parent().parent().children('.nit').html('<div class="input-group mb-3">\n' +
'                  <span class="input-group-text">\n' +
'                    <i class="fa fa-key"></i>\n' +
'                  </span>\n' +
'                  <input type="number"\n' +
'                         min="0"\n' +
'                         class="form-control input-lg"\n' +
'                         name="nuevoNIT"\n' +
                '         id="nuevoNIT" ' +
'                         placeholder="Ingresar NIT"\n' +
'                         required>\n' +
'            </div>')


        }else{
            $('#nuevoNIT').val('CF');
            $(this).parent().parent().children('.nit').children().hide();

        }

    });
});





//editar cliente
$(".tableClient tbody").on('click', 'button.btnEditClient', function(){

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