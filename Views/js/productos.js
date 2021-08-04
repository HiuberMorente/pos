

$('.productTable').DataTable({
  responsive: true,
  "ajax": "ajax/ProductsDatatableAjax.ajax.php",
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
    },
    "buttons": {
      "copy": "Copiar",
      "colvis": "Visibilidad",
      "collection": "Colección",
      "colvisRestore": "Restaurar visibilidad",
      "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
      "copySuccess": {
        "1": "Copiada 1 fila al portapapeles",
        "_": "Copiadas %d fila al portapapeles"
      },
      "copyTitle": "Copiar al portapapeles",
      "csv": "CSV",
      "excel": "Excel",
      "pageLength": {
        "-1": "Mostrar todas las filas",
        "1": "Mostrar 1 fila",
        "_": "Mostrar %d filas"
      },
      "pdf": "PDF",
      "print": "Imprimir"
    },
    "autoFill": {
      "cancel": "Cancelar",
      "fill": "Rellene todas las celdas con <i>%d<\/i>",
      "fillHorizontal": "Rellenar celdas horizontalmente",
      "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
      "add": "Añadir condición",
      "button": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
      },
      "clearAll": "Borrar todo",
      "condition": "Condición",
      "conditions": {
        "date": {
          "after": "Despues",
          "before": "Antes",
          "between": "Entre",
          "empty": "Vacío",
          "equals": "Igual a",
          "notBetween": "No entre",
          "notEmpty": "No Vacio",
          "not": "Diferente de"
        },
        "number": {
          "between": "Entre",
          "empty": "Vacio",
          "equals": "Igual a",
          "gt": "Mayor a",
          "gte": "Mayor o igual a",
          "lt": "Menor que",
          "lte": "Menor o igual que",
          "notBetween": "No entre",
          "notEmpty": "No vacío",
          "not": "Diferente de"
        },
        "string": {
          "contains": "Contiene",
          "empty": "Vacío",
          "endsWith": "Termina en",
          "equals": "Igual a",
          "notEmpty": "No Vacio",
          "startsWith": "Empieza con",
          "not": "Diferente de"
        },
        "array": {
          "not": "Diferente de",
          "equals": "Igual",
          "empty": "Vacío",
          "contains": "Contiene",
          "notEmpty": "No Vacío",
          "without": "Sin"
        }
      },
      "data": "Data",
      "deleteTitle": "Eliminar regla de filtrado",
      "leftTitle": "Criterios anulados",
      "logicAnd": "Y",
      "logicOr": "O",
      "rightTitle": "Criterios de sangría",
      "title": {
        "0": "Constructor de búsqueda",
        "_": "Constructor de búsqueda (%d)"
      },
      "value": "Valor"
    },
    "searchPanes": {
      "clearMessage": "Borrar todo",
      "collapse": {
        "0": "Paneles de búsqueda",
        "_": "Paneles de búsqueda (%d)"
      },
      "count": "{total}",
      "countFiltered": "{shown} ({total})",
      "emptyPanes": "Sin paneles de búsqueda",
      "loadMessage": "Cargando paneles de búsqueda",
      "title": "Filtros Activos - %d"
    },
    "select": {
      "1": "%d fila seleccionada",
      "_": "%d filas seleccionadas",
      "cells": {
        "1": "1 celda seleccionada",
        "_": "$d celdas seleccionadas"
      },
      "columns": {
        "1": "1 columna seleccionada",
        "_": "%d columnas seleccionadas"
      }
    },
    "thousands": ".",
    "datetime": {
      "previous": "Anterior",
      "next": "Proximo",
      "hours": "Horas",
      "minutes": "Minutos",
      "seconds": "Segundos",
      "unknown": "-",
      "amPm": [
        "am",
        "pm"
      ]
    },
    "editor": {
      "close": "Cerrar",
      "create": {
        "button": "Nuevo",
        "title": "Crear Nuevo Registro",
        "submit": "Crear"
      },
      "edit": {
        "button": "Editar",
        "title": "Editar Registro",
        "submit": "Actualizar"
      },
      "remove": {
        "button": "Eliminar",
        "title": "Eliminar Registro",
        "submit": "Eliminar",
        "confirm": {
          "_": "¿Está seguro que desea eliminar %d filas?",
          "1": "¿Está seguro que desea eliminar 1 fila?"
        }
      },
      "multi": {
        "title": "Múltiples Valores",
        "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
        "restore": "Deshacer Cambios",
        "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
      }
    },
    "info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
  }
});


// CAPTURANDO CATEGORIA PARA ASIGNAR CODIGO
$('#nuevaCategoria').change(function () {
  let idCategoria = $(this).val();

  let categoryData = new FormData();
  categoryData.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/ProductsAjax.ajax.php",
    method: "POST",
    data: categoryData,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (result) {

      if(!result){

        let newCode = idCategoria + "01";
        $("#nuevoCodigo").val(newCode);

      }else{

        let newCode = Number(result["codigo"]) + 1;
        $("#nuevoCodigo").val(newCode);

      }

    }
  })

});


// AGREGANDO PRECIO DE VENTA
$('#nuevoPrecioCompra').change(function () {

  if($('.percentage').prop('checked')){

    let porcentageValue = $('.nuevoPorcentaje').val();


    // noinspection JSJQueryEfficiency
    let percentage =  Number($('#nuevoPrecioCompra').val() * porcentageValue/100) + Number($('#nuevoPrecioCompra').val());


    $('#nuevoPrecioVenta').val(percentage);
    $('#nuevoPrecioVenta').prop("readonly", true);
  }

});

// CAMBIO DE PORCENTAJE
$('.nuevoPorcentaje').change(function () {

  if($('.percentage').prop('checked')){

    let porcentageValue = $('.nuevoPorcentaje').val();


    let percentage =  Number($('#nuevoPrecioCompra').val() * porcentageValue/100) + Number($('#nuevoPrecioCompra').val());


    $('#nuevoPrecioVenta').val(percentage);
    $('#nuevoPrecioVenta').prop("readonly", true);
  }

});



function checkboxSelected(){

  selected = document.getElementById('percentage').checked;
  if(!selected) {
    $('#nuevoPrecioVenta').prop('readonly', false);
  }else{
    $('#nuevoPrecioVenta').prop('readonly', true);
  }

}

// SUBIENDO FOTO DEL PRODUCTO
$(".nuevaImagen").change(function(){

  var imagen = this.files[0];

  // VALIDAR FORMATO DE IMAGEN
  if (imagen["type"] !== "image/jpeg" && imagen["type"] !== "image/png") {

    $(".nuevaImagen").val("");

    Swal.fire({
      icon: 'error',
      title: 'Error al subir la imagen',
      text: '¡La imagen debe estar en formato JPG o PNG!',
      confirmButtonText: "Cerrar"
    });
  }else if(imagen["size"] > 2000000){
    $(".nuevaImagen").val("");

    Swal.fire({
      icon: 'error',
      title: 'Error al subir la imagen',
      text: '¡La imagen no debe pesar mas de 2MB!',
      confirmButtonText: "Cerrar"
    });
  }else{
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event) {

      var rutaImagen = event.target.result;
      $(".previsualizar").attr("src", rutaImagen);

    });
  }

});


//Editar Producto
$(".productTable tbody").on("click", "button.btnEditProducts", function(){
  let idProducto = $(this).attr("idProduct");
  let data = new FormData();
  data.append("idProduct", idProducto);

  $.ajax({
    url: "ajax/ProductsAjax.ajax.php.",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response){
      let categoryData = new FormData();
      categoryData.append("idCategoria", response['idCategoria']);

      $.ajax({
        url: "ajax/CategoriesAjax.ajax.php.",
        method: "POST",
        data: categoryData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#categoryEdit").val(response["id"]);
          $("#categoryEdit").html(response["categoria"]);
        }
      })

    }
  })

});