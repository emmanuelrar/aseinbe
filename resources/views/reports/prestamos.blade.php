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
                        <b>Reporte de Prestamos</b>
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
                                <th>Monto Prestamo</th>
                                <th>Fecha</th>
                                <th>Consecutivo</th>
                        </tr>
                        </thead>
                        <tbody id="table-body">
                        @foreach($prestamos as $item)
                        <tr>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->cedula}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>₡ {{number_format($item->monto_cxc, 2, ',', '.')}}</td>
                                <td>{{$item->Date}}</td>
                                <td>{{$item->consec}}</td>
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
   "order": [[ 5, "desc" ]]
});

$(document).ready(function() {
    $('#reportrange').daterangepicker({
    "ranges": {
        "Hoy": [
            moment().startOf('day'),
            moment().endOf('day')
        ],
        "Ayer": [
            moment().subtract(1, 'days').startOf('day'),
            moment().subtract(1, 'days').endOf('day')
        ],
        "Ultimos 7 Días": [
            moment().subtract(6, 'days').startOf('day'),
            moment().endOf('day')
        ],
        "Ultimos 30 Días": [
            moment().subtract(29, 'days').startOf('day'),
            moment().endOf('day')
        ],
        "Este Mes": [
            moment().startOf('month'),
            moment().endOf('month')
        ],
        "Mes Pasado": [
            moment().subtract(1, 'month').startOf('month'),
            moment().subtract(1, 'month').endOf('month')
        ]
        },
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
        "startDate": "08/27/2017",
        "endDate": "09/02/2017"
    }, function(start, end, label) {
        $.ajax({
            url: '{{ route("reporte-prestamos") }}/' + start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD'),
            method: 'GET',
            success: function(res) {
                $('#planilla').html('');

                $.each(res, function(index, value) {
                    $('#table-body').append('<tr>'
                        + '<td>' + value.codigo + '</td>'
                        + '<td>' + value.cedula + '</td>'
                        + '<td>' + value.nombre + '</td>'
                        + '<td>₡ ' + value.monto_cxc + '</td>'
                        + '<td>' + value.Date + '</td>'
                        + '<td>' + value.consec + '</td></tr>');
                });
                console.log(res);           
            }
        });
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
});

</script>
@endpush