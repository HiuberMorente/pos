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
'                               class="form-control agregarProducto"\n' +
'                               name="agregarProducto"\n' +
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
'                             required>\n' +
'                    </div>\n' +
'\n' +
'                    <!--precio del producto-->\n' +
'                    <div class="col-sm-3">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <i class="fab fa-quora"></i>\n' +
'                          </span>\n' +
'                        <input type="number"\n' +
'                               class="form-control nuevoPrecioProducto"\n' +
'                               name="nuevoPrecioProducto"\n' +
'                               min="1"\n' +
'                               value="'+precioVenta+'" \n' +
'                               readonly' +
'                               required>\n' +
'\n' +
'                      </div> ' +
                    '</div>' +
                '</div>');
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
    '                        <select class="selectData nuevaDescripcionProducto col-sm-12"' +
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
'                             required>\n' +
'                    </div>\n' +
'\n' +
'                    <!--precio del producto-->\n' +
'                    <div class="col-sm-3 ingresoPrecio">\n' +
'                      <div class="input-group">\n' +
'                          <span class="input-group-text">\n' +
'                            <i class="fab fa-quora"></i>\n' +
'                          </span>\n' +
'                        <input type="number"\n' +
'                               class="form-control nuevoPrecioProducto"\n' +
'                               name="nuevoPrecioProducto"\n' +
'                               min="1"\n' +
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

                $("#producto"+numProducto).append(
                    '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
                );

            }


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

            let numberFormated = Intl.NumberFormat('es-US',{minimumFractionDigits: 2}).format(response["precioVenta"]);

            $(nuevaCantidadProducto).attr("stock", response['stock']);
            $(nuevoPrecioProducto).val(response["precioVenta"]);
            console.log(numberFormated);
        }
    });


});




