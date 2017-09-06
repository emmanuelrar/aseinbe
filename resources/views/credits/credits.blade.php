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
                        <b>Asignaci&oacute;n de Creditos</b>
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
                                        <button type="button" class="btn btn-info detallado" data-toggle="modal" data-target="#modalResumido" data-empleado="{{$empleado}}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Resumido -->
<div class="modal fade" id="modalResumido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="col-md-12"><h3 align="center">Estado de Cuenta Resumido</h3></div>
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
                <div class="col-md-3">
                       <p>Saldo Aporte Patronal: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="sal_pa"></span></u>
                </div>
                <div class="col-md-3">
                        <p>Saldo Prestamo: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="sal_cxc"></span></u>
                </div>

                <div class="col-md-3">
                       <p>Saldo Aporte Obrero: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="sal_ob"></span></u>
                </div>
                <div class="col-md-3">
                        <p>Intereses: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="intereses"></span></u>
                </div>

                <div class="col-md-3">
                       <p>Saldo Excedentes Capitalizado: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="sal_cap"></span></u>
                </div>
                <div class="col-md-3">
                        <p>Prestamo + Intereses: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="prestamo_interes"></span></u>
                </div>

                <div class="col-md-3">
                        <p>Total Ahorrado: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="total"></span></u>
                </div>
                <div class="col-md-6">
                        <!--  -->
                </div>

                <div class="col-md-3">
                       <p>Excedentes del Período: </p>
                </div>
                <div class="col-md-3 text-right">
                        <u><span id="dividen"></span></u>
                </div>
                <div class="col-md-3">
                        <p><b>Disponible: </b></p>
                </div>
                <div class="col-md-3 text-right">
                        <u><b><span id="disponible"></span></b></u>
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
                printElement(document.getElementById('modalResumido'));
                window.print();
        });
});

function initButtons() {

    $('#modalResumido').on('show.bs.modal', function (event) {
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
                        
                        $('#sal_pa').text('₡ ' + parseFloat(res.actual[0].sal_pa).toLocaleString());
                        $('#sal_ob').text('₡ ' + parseFloat(res.actual[0].sal_ob).toLocaleString());
                        $('#sal_cxc').text('₡ ' + parseFloat(res.actual[0].sal_cxc).toLocaleString());
                        $('#intereses').text('₡ ' + parseFloat(res.actual[0].intereses).toLocaleString());
                        $('#sal_cap').text('₡ ' + parseFloat(res.actual[0].sal_cap).toLocaleString());
                        $('#prestamo_interes').text('₡ ' +( parseFloat(res.actual[0].sal_cxc) + parseFloat(res.actual[0].intereses)).toLocaleString());
                        $('#total').text('₡ ' + (parseFloat(res.actual[0].sal_pa) + parseFloat(res.actual[0].sal_ob) + parseFloat(res.actual[0].sal_cap)).toLocaleString());
                        $('#dividen').text('₡ ' + parseFloat(res.actual[0].dividen).toLocaleString());
                        $('#disponible').text('₡ ' + parseFloat(res.actual[0].sal_ob).toLocaleString());
                }
        })
    });
}

</script>
@endpush