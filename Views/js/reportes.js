//VARIABLE LOCALSTORAGE

if(localStorage.getItem('capturarRango') != null){

    $('#daterange-btnReporte span').html(localStorage.getItem('capturarRangoReporte'));

}else {

    $('#daterange-btnReporte span').html('<i class="fa fa-calendar"></i> Rango de fecha');

}



$('#daterange-btnReporte').daterangepicker(
    {

        ranges   : {
            'Hoy'       : [moment(), moment()],
            'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
            'Último Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate  : moment(),
        alwaysShowCalendars: true,
    },
    function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM DD, YYYY') + ' - ' + end.format('MMMM DD, YYYY'));

        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        var capturarRangoReporte = $('#daterange-btnReporte span').html();

        localStorage.setItem('capturarRangoReporte', capturarRangoReporte);

        window.location = 'index.php?ruta=reportes&fechaInicial=' + fechaInicial + '&fechaFinal=' + fechaFinal;

    }

);

//CANCELAR DATARANGE PICKER
$('#daterange-btnReporte').on('cancel.daterangepicker', function (){
    localStorage.removeItem('capturarRangoReporte');
    localStorage.clear();
    window.location = 'reportes';
});



//CAPTURAR EL DIA DE HOY

$('#daterange-btnReporte').on('click', function (){

});

$('.daterangepicker .ranges li').on('click','#datereange-btnReporte', function (){
    let atributoDatePickerHoy = $(this).attr('data-range-key');

    if(atributoDatePickerHoy === 'Hoy'){

        let currentDate = new Date();

        let day = currentDate.getDate();
        let month = currentDate.getMonth() + 1;
        let year = currentDate.getFullYear();

        var fechaInicial;
        var fechaFinal;

        if(month < 10){

            fechaInicial = year + '-0' + month + '-' + day;
            fechaFinal = year + '-0' + month + '-' + day;

        }else if(day < 10){

            fechaInicial = year + '-' + month + '-0' + day;
            fechaFinal = year + '-' + month + '-0' + day;

        }else if(month < 10 && day < 10){

            fechaInicial = year + '-0' + month + '-0' + day;
            fechaFinal = year + '-0' + month + '-0' + day;

        }else {

            fechaInicial = year + '-' + month + '-' + day;
            fechaFinal = year + '-' + month + '-' + day;

        }


        localStorage.setItem('capturarRangoReporte', 'Hoy');

        window.location = 'index.php?ruta=reportes&fechaInicial=' + fechaInicial + '&fechaFinal=' + fechaFinal;
    }

});


