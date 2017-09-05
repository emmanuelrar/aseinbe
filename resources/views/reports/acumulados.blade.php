@extends('layouts.main')

@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<style>

</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Detalle de Dividendos</b>
                        <div id="reportrange" class="col-md-3 pull-right" style="color: darkgray; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                            <span></span> <b class="caret"></b>
                        </div>
                </div>
                <div class="card-block">
                <table id="planilla" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>C&oacute;digo</th>
                                <th>C&eacute;dula</th>
                                <th>Nombre</th>
                                <th>Aporte Patronal</th>
                                <th>Aporte Obrero</th>
                                <th>Excedente Capitalizado</th>
                                <th>Total Ahorrado</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        @foreach($acumulados as $item)
                        <tr>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->cedula}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>₡ {{number_format($item->sal_pa, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->sal_ob, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->sal_cap, 2, ',', '.')}}</td>
                                <td>₡ {{number_format(($item->sal_pa + $item->sal_ob + $item->sal_cap), 2, ',', '.')}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>
@endsection


@push('script')
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

<script>

var table = $('#planilla').DataTable({
   "lengthChange": false,
   "destroy": true   
});

$(document).ready(function() {
    $('#reportrange').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "locale": {
            "format": "MM/DD/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Predeterminado",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mie",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "alwaysShowCalendars": true,
        "startDate": moment(),
    }, function(start, label) {
        table.destroy();
        $('#table-body').html('');
        $.ajax({
            url: '{{ route("acumulados") }}/' + start.format('YYYY-MM-DD'),
            method: 'GET',
            success: function(res) {
                $.each(res, function(index, value) {
                    $('#table-body').append('<tr>'
                        + '<td>' + value.codigo + '</td>'
                        + '<td>' + value.cedula + '</td>'
                        + '<td>' + value.nombre + '</td>'
                        + '<td>₡ ' + parseFloat(value.sal_pa).toLocaleString() + '</td>'
                        + '<td>₡' + parseFloat(value.sal_ob).toLocaleString() + '</td>'
                        + '<td>₡' + parseFloat(value.sal_cap).toLocaleString() + '</td>'
                        + '<td>₡' + (parseFloat(value.sal_pa) + parseFloat(value.sal_ob) + parseFloat(value.sal_cap)).toLocaleString() + '</td></tr>');
                });

                table = $('#planilla').DataTable({
                "lengthChange": false,
                "destroy": true
                });
            }
        });
    });
});

</script>
@endpush