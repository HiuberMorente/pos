//ventas dinamicas

$.ajax({
   url: "ajax/SalesDatatableAjax.ajax.php",
   success: function(response){

   }
});

$('.tableSales').DataTable({
    responsive: true,
    "ajax": "ajax/SalesDatatableAjax.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

}).columns.adjust().responsive.recalc();

//agegrando productos a la venta desde tabla
$(".tableSales tbody").on("click", "button.agregarProducto", function(){

    let idProducto = $(this).attr("idProduct");

    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");

    let data = new FormData();
    data.append("idProduct", idProducto);

    $.ajax({
        url: "ajax/ProductsAjax.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response){

            let descripcion = response["descripcion"];
            let stock = response["stock"];
            let precioVenta = response["precioVenta"];

            // evitar agregar producto cuando stock es 0
            if(stock == 0){
                Swal.fire({
                    icon: 'error',
                    title: '¡No hay stock disponible!',
                    confirmButtonText: '¡Cerrar!'
                });
                $("button[idProduct='"+idProducto+"']").addClass("btn-primary agregarProducto");
                return;
            }

            $(".newProduct").append(
                '<div class="row" style="padding: 5px 15px">'+
                '  <!-- descripcion del producto-->\n' +
'                    <div class="col-sm-6">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <button type="button" ' +
'                                    class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'">\n' +

'                              <i class="fa fa-times"></i>\n' +
'                            </button>\n' +
'                          </span>\n' +
'                        <input type="text"\n' +
'                               class="form-control nuevaDescripcionProducto"\n' +
'                               name="agregarProducto"\n' +
                            '   idProducto="'+idProducto+'"' +
'                               value="'+descripcion+'" \n' +
'                               readonly' +
'                               required>\n' +
'                      </div>\n' +
'                    </div>\n' +
'\n' +
'                    <!-- cantidad del producto-->\n' +
'                    <div class="col-sm-3">\n' +
'                      <input type="number"\n' +
'                             class="form-control nuevaCantidadProducto"\n' +
'                             name="nuevaCantidadProducto"\n' +
'                             min="1"\n' +
'                             value="1" \n' +
'                             stock="'+stock+'" \n' +
                            ' nuevoStock="'+ Number(stock - 1) +'" \n' +
'                             required>\n' +
'                    </div>\n' +
'\n' +
'                    <!--precio del producto-->\n' +
'                    <div class="col-sm-3 ingresoPrecio">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <i class="fab fa-quora"></i>\n' +
'                          </span>\n' +
'                        <input type="text"\n' +
'                               class="form-control nuevoPrecioProducto"\n' +
'                               name="nuevoPrecioProducto"\n' +
                '               precioReal="'+precioVenta+'"' +
'                               value="'+precioVenta+'" \n' +
'                               readonly' +
'                               required>\n' +
'\n' +
'                      </div> ' +
                    '</div>' +
                '</div>');

            //Sumar Total de los precios
            sumarTotalPrecios();

            //Agregar impuesto
            agregarImpuesto();

            //listar productos json
            listarProductos();


            //formato a los precios
            $(".nuevoPrecioProducto").number(true, 2);
        }
    });
});




//cuando cargue la tabla y se navegue
$(".tableSales").on("draw.dt", function (){
    if(localStorage.getItem("quitarProducto") !== null){
        let listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
        for (let i = 0; i < listaIdProductos.length; i++){
            $("button.recuperarBoton[idProduct='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
            $("button.recuperarBoton[idProduct='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
        }

    }
});


let idQuitarProdcuto = [];
localStorage.removeItem("quitarProducto");

//quitar productos de venta y recuperar boton
$(".formularioVenta").on("click", "button.quitarProducto", function(){
    $(this).parent().parent().parent().parent().remove();

    let idProducto = $(this).attr("idProducto");

    //almacenar en localstorage id de producto a quitar
    if(localStorage.getItem("quitarProducto") === null){
        idQuitarProducto = [];
    }else{
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    }

    idQuitarProducto.push({"idProducto":idProducto});
    localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));


    $("button.recuperarBoton[idProduct='"+idProducto+"']").removeClass('btn-default');
    $("button.recuperarBoton[idProduct='"+idProducto+"']").addClass('btn-primary agregarProducto');


    //comprobar si ya no existen productos
    if($('.newProduct').children().length === 0){

        $('#nuevoImpuestoVenta').val(0);
        $('#nuevoTotalVenta').val(0);
        $('#totalVenta').val(0);
        $('#nuevoTotalVenta').attr('total', 0);

        $('#nuevoCambioEfectivo').val(0);


    }else{

        //Sumar Total de los precios
        sumarTotalPrecios();

        //agregar impuesto
        agregarImpuesto();

        //listar productos json
        listarProductos();

    }



});


//agregando producdos desde boton para dispositivos moviles

let numProducto = 0;

$(".btnAgregarProducto").click(function (){

    numProducto++;

    let data = new FormData();
    data.append("traerProductos", "ok");

    $.ajax({
        url: "ajax/ProductsAjax.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response){

            $(".newProduct").append(
            '<div class="row" style="padding: 5px 15px">'+
            '  <!-- descripcion del producto-->\n' +
'                    <div class="col-sm-6">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <button type="button" ' +
'                                    class="btn btn-danger btn-xs quitarProducto" idProducto>\n' +

'                              <i class="fa fa-times"></i>\n' +
'                            </button>\n' +
'                          </span>\n' +
                '          <div class="form-control" style="padding: 4px 4px 2px 4px">' +
    '                        <select class="selectData nuevaDescripcionProducto agregarProducto col-sm-12"' +
                    '                id="producto'+numProducto+'"' +
                    '                idProducto\n ' +
                    '                name="nuevaDescripcionProducto" ' +
                    '                required>' +
                    '           <option value="">Seleccione el producto</option>' +
                    '         </select>\n' +
                '           </div>' +'                      </div>\n' +
'                    </div>\n' +
'\n' +
'                    <!-- cantidad del producto-->\n' +
'                    <div class="col-sm-3 ingresoCantidad">\n' +
'                      <input type="number"\n' +
'                             class="form-control nuevaCantidadProducto"\n' +
'                             name="nuevaCantidadProducto"\n' +
'                             min="1"\n' +
'                             value="1" \n' +
'                             stock\n' +
                '             nuevoStock\n' +
'                             required>\n' +
'                    </div>\n' +
'\n' +
'                    <!--precio del producto-->\n' +
'                    <div class="col-sm-3 ingresoPrecio">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <i class="fab fa-quora"></i>\n' +
'                          </span>\n' +
'                        <input type="text"\n' +
'                               class="form-control nuevoPrecioProducto"\n' +
'                               name="nuevoPrecioProducto"\n' +
                '               precioReal=""' +
'                               value="" \n' +
'                               readonly' +
'                               required>\n' +
'\n' +
'                      </div> ' +
                '</div>' +
            '</div>' +
                '<script src="/Views/js/plantilla.js"></script>');

            //cargar los productos al select
            response.forEach(forEachFunction);

            function forEachFunction(item, index){

                if(item.stock != 0){

                    $("#producto"+numProducto).append(
                        '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
                    );

                }


            }

            //Sumar Total de los precios
            sumarTotalPrecios();

            //agregar impuesto
            agregarImpuesto();

            //formato a precios
            $(".nuevoPrecioProducto").number(true, 2);
        }

    });
});



//selecionar producto
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){
    let nombreProducto = $(this).val();

    let nuevoPrecioProducto = $(this).parent().parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    let nuevaCantidadProducto = $(this).parent().parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    let data = new FormData();
    data.append("nombreProducto", nombreProducto);

    $.ajax({
        url: "ajax/ProductsAjax.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response){

            $(nuevaCantidadProducto).attr("stock", response['stock']);
            $(nuevaCantidadProducto).attr("nuevoStock", Number(response['stock'])) - 1;
            $(nuevoPrecioProducto).val(response["precioVenta"]);
            $(nuevoPrecioProducto).attr("precioReal", response["precioVenta"]);



            //listar productos json
            listarProductos();

        }
    });
});



//MODIFICAR CANTIDAD DE PRODUCTOS (AUMENTO DE PRECIO DE LOS PRODUCTOS)
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

    let precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    let precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal);

    let nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))){

        $(this).val(1);

        //CANTIDAD SUPERIOR A STOCK, VOLVE A VALORES INICIALES

        let precioFinal = $(this).val() * precio.attr('precioReal');

        precio.val(precioFinal);

        sumarTotalPrecios();




        Swal.fire({
            icon: 'error',
            title: 'La cantidad supera el stock',
            text: '¡Sólo hay ' + $(this).attr("stock") + " unidades!",
            confirmButtonText: '¡Cerrar!'
        });


    }

    //Sumar Total de los precios
    sumarTotalPrecios();

    //agregar impuesto
    agregarImpuesto();

    //agrupar productos en JSon
    listarProductos();

});



//SUMAR TODOS LOS PRECIOS
function sumarTotalPrecios(){

    let precioItem = $(".nuevoPrecioProducto");
    let arraySumarPrecio = [];

    for (let i = 0; i < precioItem.length; i++){

        arraySumarPrecio.push(Number($(precioItem[i]).val()));

    }

    function sumarArrayPrecios(total, cantidad){

        return total + cantidad;


    }

    let sumaTotalPrecio = arraySumarPrecio.reduce(sumarArrayPrecios);



    $('#nuevoTotalVenta').val(sumaTotalPrecio);
    $('#totalVenta').val(sumaTotalPrecio);
    $('#nuevoTotalVenta').attr('total', sumaTotalPrecio);


}

function agregarImpuesto(){
    let impuesto = $('#nuevoImpuestoVenta').val();

    let precioTotal = $('#nuevoTotalVenta').attr("total");

    let precioImpuesto = Number(precioTotal * impuesto / 100);

    let totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

    $('#nuevoTotalVenta').val(totalConImpuesto); //total con impuestos incluidos
    $('#totalVenta').val(totalConImpuesto); //total con impuestos incluidos
    $('#nuevoPrecioImpuesto').val(precioImpuesto); //cantidad impuesto
    $('#nuevoPrecioNeto').val(precioTotal); //total sin impuestos

}

$("#nuevoTotalVenta").number(true, 2);


// SELECCIONAR METODO DE PAGO

$('#nuevoMetodoPago').change(function (){
    let metodo = $(this).val();

    if(metodo == "Efectivo"){

        $(this).parent().removeClass('col-sm-6');
        $(this).parent().addClass('col-sm-4');
        $(this).parent().parent().children('.cajasMetodoPago').html(
            '<div class="form-group col-sm-6">' +
                '<div class="input-group">' +
                '   <span class="input-group-text">' +
                '       <i class="fab fa-quora"></i>'+
                '    </span>' +
                '    <input type="text" ' +
                '           class="form-control" ' +
                '           id="nuevoValorEfectivo"' +
                '           name="nuevoValorEfectivo"' +
                '           placeholder="0000" ' +
                '           required>' +
                '</div>' +
            '</div>' +

                '<div class="form-group col-sm-6"' +
                '     id="capturarCambioEfectivo"' +
                '     style="padding-left: 0px">' +
                '   <div class="input-group">' +
                '       <span class="input-group-text">' +
                '           <i class="fab fa-quora"></i>'+
                '       </span>' +
                '       <input type="text" ' +
                '              class="form-control" ' +
                '              id="nuevoCambioEfectivo"' +
                '              name="nuevoCambioEfectivo"' +
                '              placeholder="0000" ' +
                '              required' +
                '              readonly>' +
                '   </div>' +
                '</div>'
        );

        //agregar foramto a
        $('#nuevoValorEfectivo').number(true, 2);
        $('#nuevoCambioEfectivo').number(true, 2);

        //listar metodos de pago
        listarMetodosPago();

    }else if(metodo == "TC" || metodo == "TD"){
        //
        // $(this).parent().removeClass('col-sm-4');
        // $(this).parent().addClass('col-sm-6');
        $(this).parent().parent().children('.cajasMetodoPago').html(

            '  <div class="input-group">\n' +
            '     <span class="input-group-text">\n' +
            '         <i class="fa fa-lock"></i>\n' +
            '      </span>\n' +
            '      <input type="text"\n' +
            '             class="form-control"\n' +
            '              id="nuevoCodigoTransaccion"\n' +
            '              name="nuevoCodigoTransaccion"\n' +
            '              placeholder="Código transacción"\n' +
            '              required>\n' +
            '  </div>\n'
        );
    }else{

        $(this).parent().parent().children('.cajasMetodoPago').children().hide();

    }

});


//cambio de efectivo
$('.formularioVenta').on('change', 'input#nuevoValorEfectivo', function (){

    let efectivo = $(this).val();
    console.log(efectivo);

    let cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

    let nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

    nuevoCambioEfectivo.val(cambio);

});

//cambio transacion tarjetas dbito credito
$('.formularioVenta').on('change', 'input#nuevoCodigoTransaccion', function (){

//listar metodos de pago
    listarMetodosPago();

});



//agrupoar los productos de la venta en formato JSON
function listarProductos(){
    let listaProductos = [];
    // let id = ;
    let descripcion = $('.nuevaDescripcionProducto');
    let cantidad = $('.nuevaCantidadProducto');
    let precio = $('.nuevoPrecioProducto');
    // let total = ;

    for (let i = 0; i < descripcion.length; i++){
      listaProductos.push({
          "id":$(descripcion[i]).attr("idProducto"),
          "descripcion": $(descripcion[i]).val(),
          "cantidad": $(cantidad[i]).val(),
          "stock": $(cantidad[i]).attr('nuevoStock'),
          "precio": $(precio[i]).attr('precioReal'),
          "total": $(precio[i]).val(),
      });
    }


    $('#listaProductos').val(JSON.stringify(listaProductos));

}

//listar metodo de pago
function listarMetodosPago(){

    let listaMetodosPago = '';

    if($("#nuevoMetodoPago").val() == "Efectivo"){

        $('#listaMetodoPago').val('Efectivo');

    }else{

        $('#listaMetodoPago').val($("#nuevoMetodoPago").val()+ '-' + $('#nuevoCodigoTransaccion').val());

    }
}






