@extends('layouts.main')

@section('style')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
.mainContent {
    padding-top: 0px !important;
}
select.form-control:not([size]):not([multiple])
{
    height: calc(3.25rem + 2px) !important;
}
.error {
        color: red;
}
.card {
        margin-top: 3vh;
}
.modal-lg {
    min-width: 90vw !important;
}
.modal-dialog {
        margin: 10vh 5vw !important;
}
#company-title {
        font-size: 62px;
}
.roboto {
        font-family: 'Roboto';
}
.no-padding {
        padding: 0 0 !important;
}
</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Estado de Cuenta Detallado</b>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Codigo</th>
                                <th>Cuenta Bancaria</th>
                                <th>Telefono</th>
                                <th>Estado de Cuenta</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                                <td>{{$empleado->nombre}}</td>
                                <td>{{$empleado->cedula}}</td>
                                <td>{{$empleado->codigo}}</td>
                                <td>{{$empleado->cta_banc}}</td>
                                <td>{{$empleado->telefono}}</td>
                                <td align="center">
                                        <button type="button" class="btn btn-info detallado" data-toggle="modal" data-target="#modalDetallado" data-empleado="{{$empleado}}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Detallado -->
<div class="modal fade" id="modalDetallado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-body">
      <div class="row">
            <div class="col-md-8">
                <h1 id="company-title" align="center"><b>A.S.E.IN.B.E</b></h1>
            </div>
            <div class="col-md-4">
                <p>C&eacute;dula Jur&iacute;dica: <span id="cedula_juridica"></span></p>
                <p>Fecha: <span id="fecha">{{ Carbon\Carbon::now()}}</span></p>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12"><h3 align="center">Estado de Cuenta Detallado</h3></div>
        </div>
        <div class="row">
                <div class="col-md-6">
                        <p>Nombre: <u><span id="nombre"></span></u></p>
                </div>
                <div class="col-md-3">
                        <p>C&eacute;dula: <u><span id="cedula"></span></u></p>
                </div>
                <div class="col-md-3">
                        <p>Socio N°: <u><span id="codigo"></span></u></p>
                </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                        <p>Saldo Dividendos Capitalizados: <u><span id="sal_cap" class="roboto"></span></u></p>
                </div>
        </div>
        <div class="row">
                <div class="col-md-4 center text-center">
                        <p><b>Ahorro Patronal</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo Anterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_anterior_2"></span></u>
                                </div>
                                <div class="col-md-4">
                                        <u><span class="roboto" id="fecha_anterior"></span></u>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="monto_pa_anterior"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_anterior"></span></u>
                                </div>
                                <div class="col-md-4">
                                        <u><span class="roboto" id="fecha_actual"></span></u>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="monto_pa_actual"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_actual"></span></u>
                                </div>
                        </div>
                </div>
                <div class="col-md-4 center text-center">
                        <p><b>Ahorro Obrero</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo Anterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_ob_anterior_2"></span></u>
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="monto_ob_anterior"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_ob_anterior"></span></u>
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="monto_ob_actual"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_ob_actual"></span></u>
                                </div>
                        </div>
                </div>
                <div class="col-md-4 center text-center">
                        <p><b>Cr&eacute;ditos</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo Anterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_cxc_anterior_2"></span></u>
                                </div>
                                <div class="col-md-4">
                                        <p>Amortizaci&oacute;n: </p>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="amortizacion"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_cxc_anterior"></span></u>
                                </div>
                                <div class="col-md-4">
                                        <p>Credito: </p>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <u><span class="roboto" id="monto_cxc_actual"></span></u>
                                </div>
                                <div class="col-md-5">
                                        <u><span class="roboto" id="saldo_cxc_actual"></span></u>
                                </div>
                        </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary print" data-dismiss="modal">Imprimir</button>
      </div>
    </div>
  </div>
</div>
@endsection


@push('script')
<script>

$('#employee').DataTable({
   "lengthChange": false,
   "fnDrawCallback": function() {
        initButtons();
    }
});

$(document).ready(function() {

        $('.print').on('click', function() {
                printElement(document.getElementById('modalDetallado'));
                window.print();
        });
});

function initButtons() {

    $('#modalDetallado').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $.ajax({
                url: '{{route("detallado")}}/' + empleado.codigo,
                method: 'GET',
                success: function(res) {
                        $('#cedula_juridica').text(res.empresa[0].cedula);
                        $('#nombre').text(empleado.nombre);
                        $('#cedula').text(empleado.cedula);
                        $('#codigo').text(empleado.codigo);
                        $('#sal_cap').text('₡ ' + parseFloat(res.actual[0].sal_cap).toLocaleString());
                        $('#fecha_actual').text(moment(res.actual[0].fecha).format('DD-MM-YYYY'));
                        $('#fecha_anterior').text(moment(res.anterior[0].fecha).format('DD-MM-YYYY'));
                        $('#saldo_anterior_2').text('₡ ' + (parseFloat(res.anterior[0].sal_pa) - parseFloat(res.anterior[0].monto_pa)).toLocaleString());
                        $('#saldo_anterior').text('₡ ' + parseFloat(res.anterior[0].sal_pa).toLocaleString());
                        $('#saldo_actual').text('₡ ' + parseFloat(res.actual[0].sal_pa).toLocaleString());
                        $('#monto_pa_actual').text('₡ ' + parseFloat(res.actual[0].monto_pa).toLocaleString());
                        $('#monto_pa_anterior').text('₡ ' + parseFloat(res.anterior[0].monto_pa).toLocaleString());

                        $('#saldo_ob_anterior_2').text('₡ ' + (parseFloat(res.anterior[0].sal_ob) - parseFloat(res.anterior[0].monto_ob)).toLocaleString());
                        $('#saldo_ob_anterior').text('₡ ' + parseFloat(res.anterior[0].sal_ob).toLocaleString());
                        $('#saldo_ob_actual').text('₡ ' + parseFloat(res.actual[0].sal_ob).toLocaleString());
                        $('#monto_ob_actual').text('₡ ' + parseFloat(res.actual[0].monto_ob).toLocaleString());
                        $('#monto_ob_anterior').text('₡ ' + parseFloat(res.anterior[0].monto_ob).toLocaleString());

                        $('#saldo_cxc_anterior_2').text('₡ ' + (parseFloat(res.anterior[0].sal_cxc) + parseFloat(res.anterior[0].amortiza)).toLocaleString());
                        $('#saldo_cxc_anterior').text('₡ ' + parseFloat(res.anterior[0].sal_cxc).toLocaleString());
                        $('#saldo_cxc_actual').text('₡ ' + parseFloat(res.actual[0].sal_cxc).toLocaleString());
                        $('#monto_cxc_actual').text('₡ ' + parseFloat(res.actual[0].monto_cxc).toLocaleString());
                        $('#amortizacion').text('₡ ' + parseFloat(res.anterior[0].amortiza).toLocaleString());
                }
        })
    });
}

</script>
@endpush