@extends('layouts.main')

@section('style')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
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
.roboto input{
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
                        <b>Prestamos por Empleado</b>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Monto Disponible</th>
                                <th>Monto Deuda</th>
                                <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                                <td>{{$empleado->nombre}}</td>
                                <td>{{$empleado->cedula}}</td>
                                <td>₡ {{number_format($empleado->aporte_obrero + $empleado->aporte_patron, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($empleado->prestamos, 2, ',', '.')}}</td>
                                <td align="center">
                                        <button type="button" class="btn btn-info credito" data-toggle="modal" data-target="#modalCredito" data-empleado="{{$empleado}}"><i class="fa fa-th-list" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Lista Prestamos -->
<div class="modal fade" id="modalCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
        <div class="modal-header">
                <h4 align="center">Listado de Prestamos</h4>
        </div>
        <div class="modal-body">
            <div id="accordion" role="tablist">
                <!-- Prestamos -->
            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
    },
    "language": {
      "emptyTable": "No se han realizado prestamos."
    }
});

$(document).ready(function() {


});

function initButtons() {

    $('#modalCredito').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $.ajax({
            url: 'lista/' + empleado.cedula,
            method: 'GET',
            success: function(res) {
                console.log(res);
                $('#accordion').html('');

                $.each(res, function(index, value) {
                    console.log(value);
                    $('#accordion').append('<div class="card">'
                    + '<div class="card-header" role="tab" id="heading' + index + '">'
                    + '<h5 class="mb-0">'
                    + '    <a class="collapsed" data-toggle="collapse" href="#collapse' + index + '" aria-expanded="true" aria-controls="collapse' + index + '">'
                    + 'Fecha: ' + moment(value.fecha_inicio).format('DD-MM-YYYY') + ' | Monto Total: ' + parseFloat(value.monto).toLocaleString(undefined, {minimunFractionDigits: 2}) + ' | Monto Cuota:' + parseFloat(value.monto_cuotas).toLocaleString(undefined, {minimumFractionDigits: 2}) + ' | Pagado: ' + (value.pagado == 1 ? 'Si ' : 'No ')
                    + '    </a>'
                    + '</h5>'
                    + '</div>'
                    + '<div id="collapse' + index + '" class="collapse" role="tabpanel" aria-labelledby="heading' + index + '" data-parent="#accordion">'
                    + '<div class="card-body">'
                    + '    <form id="formCredito" class="roboto">'
                    + '            {{ csrf_field() }}'
                    + '            <div class="col-md-6">'
                    + '                    <p>Nombre: <u id="nombre">'+ value.nombre +'</u></p>'
                    + '            </div>'
                    + '            <div class="col-md-6 text-center">'
                    + '                    <p>Cedula: <u id="cedula_txt">'+ value.cedulax    +'</u></p>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="monto">Monto</label>'
                    + '                    <input type="text" name="monto" class="form-control" id="monto" value="' + parseFloat(value.monto - value.monto_interes).toLocaleString(undefined, { minimumFractionDigits: 2 }) + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="interes_txt">Interes</label>'
                    + '                    <input type="text" name="interes_txt" class="form-control" id="interes_txt" value="' + parseFloat(value.monto_interes).toLocaleString(undefined, { minimumFractionDigits: 2 }) + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="total_deuda_txt">Total a Pagar</label>'
                    + '                    <input type="text" name="total_deuda_txt" class="form-control" id="total_deuda_txt" value="' + parseFloat(value.monto).toLocaleString(undefined, { minimumFractionDigits: 2 }) + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="cuotas">Numero de Cuotas (Semanas)</label>'
                    + '                    <input type="text" name="cuotas" class="form-control" id="cuotas" value="' + value.cuotas + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="cuotas_restante">Numero de Cuotas Restantes(Semanas)</label>'
                    + '                    <input type="text" name="cuotas_restante" class="form-control" id="cuotas_restante" value="' + value.cuotas_restantes + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="monto_restante">Monto Restante</label>'
                    + '                    <input type="text" name="monto_restante" class="form-control" id="monto_restante" value="' + parseFloat(value.monto_restante).toLocaleString(undefined, { minimumFractionDigits: 2 }) + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="fecha">Fecha</label>'
                    + '                    <input type="text" name="fecha" class="form-control" id="fecha" value="' + moment(value.fecha_inicio).format('DD-MM-YYYY') + '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="pagado">Pagado</label>'
                    + '                    <input type="text" name="pagado" class="form-control" id="pagado" value="' + (value.pagado == 1 ? 'Si ' : 'No ') +  '" readonly>'
                    + '            </div>'
                    + '            <div class="form-group col-md-4">'
                    + '                    <label for="monto_cuotas">Monto de Cuotas Semanales</label>'
                    + '                    <input type="text" name="monto_cuotas_txt" class="form-control" id="monto_cuotas_txt" value="' + parseFloat(value.monto_cuotas).toLocaleString(undefined, { minimumFractionDigits: 2 }) + '" readonly>'
                    + '            </div>'
                    + '    </form>'
                    + '</div>'
                    + '</div>'
                    + '</div>');
                });
            }
        })
    });

}
</script>
@endpush