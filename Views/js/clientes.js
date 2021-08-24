function nitIsValid(nit) {

  if(!nit){
    return true;
  }

  var nitRegExp = new RegExp('^[0-9]+(-?[0-9kk])?$');

  if(!nitRegExp.test(nit)){
    return false;
  }

  nit = nit.replace(/-/, '');
  var lastChar = nit.length - 1;
  var number = nit.substring(0, lastChar);
  var expectedChecker = nit.substring(lastChar, lastChar + 1).toLowerCase();

  var factor = number.length + 1;
  var total = 0;

  for(var i = 0; i < number.length; i++){

    var character = number.substring(i, i + 1);
    var digit = parseInt(character, 10);

    total += (digit * factor);
    factor = factor - 1;

  }

  var modulus = (11 - (total % 11)) % 11;
  var computedChecker = (modulus === 10 ? 'k' : modulus.toString());

  return expectedChecker === computedChecker;

}


$(document).ready(function (){
    $('#selectNitCF').on('change', function (){
        var selected = $(this).val();


        if(selected === 'NIT'){
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
'                         required>' +
'            </div>');

        }else{
            $('#nuevoNITHide').val('CF');
            $(this).parent().parent().children('.nit').children().hide();

        }

    });


});

$('#modalAgregarCliente').on('change paste keyup', 'input#nuevoNIT',function (){

    var $this = $(this);
    var nit = $this.val();


    if (nit && nitIsValid(nit)) {

        $this.addClass('is-valid');
        $this.removeClass('is-invalid')
        $(this).parent().parent().parent().parent().parent().next().children('#save').prop('disabled', false);
        $('#nuevoNITHide').val('nit');
    } else if (nit) {
        $this.addClass('is-invalid');
        $this.removeClass('is-valid')
        $(this).parent().parent().parent().parent().parent().next().children('#save').prop('disabled', true);


    } else {
        $this.addClass('is-invalid');
        $this.removeClass('is-valid');
        $(this).parent().parent().parent().parent().parent().next().children('#save').prop('disabled', true);
    }

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

var datoNiT = '';
$(".tableClient tbody").on('click', 'button.btnEditClient', function(){
   $('#editarNIT').click(function (){
       var $this = $(this);
       var nit = $this.val();

       if(nit !== 'CF') {


           if (nit && nitIsValid(nit)) {

               $this.addClass('is-valid');
               $this.removeClass('is-invalid')
               $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', false);
           } else if (nit) {
               $this.addClass('is-invalid');
               $this.removeClass('is-valid')
               $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', true);


           } else {
               $this.addClass('is-invalid');
               $this.removeClass('is-valid');
               $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', true);
           }
       }else{
           $this.removeClass('is-valid');
           $this.removeClass('is-invalid');
       }

   })
});



$('#modalEditarCliente').on('change paste keyup', 'input#editarNIT',function (){

    var $this = $(this);
    var nit = $this.val();

    if(nit !== 'CF'){


        if (nit && nitIsValid(nit)) {

            $this.addClass('is-valid');
            $this.removeClass('is-invalid')
            $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', false);
        } else if (nit) {
            $this.addClass('is-invalid');
            $this.removeClass('is-valid')
            $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', true);


        } else {
            $this.addClass('is-invalid');
            $this.removeClass('is-valid');
            $(this).parent().parent().parent().parent().next().children('.edit').prop('disabled', true);
        }
    }else{

        $this.removeClass('is-valid');
        $this.removeClass('is-invalid');

    }

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