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
                        <b>Simulacion de Prestamos</b>
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
                                <td>₡ {{number_format($empleado->aporte_obrero + $empleado->aporte_patron + $empleado->capitalizado, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($empleado->prestamos, 2, ',', '.')}}</td>
                                <td align="center">
                                        <button type="button" class="btn btn-info credito" data-toggle="modal" data-target="#modalCredito" data-empleado="{{$empleado}}"><i class="fa fa-university" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Simulador -->
<div class="modal fade" id="modalCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
        <div class="modal-header">
                <h4 align="center">Analisis de Prestamo</h4>
        </div>
        <div class="modal-body">
                <form id="formCredito" class="roboto">
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-md-6">
                                        <p>Nombre: <u id="nombre"></u></p>
                                </div>
                                <div class="col-md-6 text-center">
                                        <p>Cedula: <u id="cedula_txt"></u></p>                                
                                </div>
                        </div>
                        <input type="hidden" name="cedula" id="cedula">
                        <div class="row">
                                <div class="form-group col-md-4">
                                        <label for="acumulado">Total Acumulado</label>
                                        <input type="text" name="acumulado" class="form-control" id="acumulado" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                        <label for="deuda">Total Deuda</label>
                                        <input type="text" name="deuda" class="form-control" id="deuda" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                        <label for="disponible">Disponible</label>
                                        <input type="text" name="disponible" class="form-control" id="disponible" readonly>
                                </div>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="monto">Monto</label>
                                <input type="number" name="monto" class="form-control" id="monto" min="1">
                        </div>
                        <div class="form-group col-md-4">
                                <label for="interes_txt">Interes</label>
                                <input type="text" name="interes_txt" class="form-control" id="interes_txt" readonly>
                                <input type="hidden" name="interes" class="form-control" id="interes" readonly>                                
                        </div>
                        <div class="form-group col-md-4">
                                <label for="total_deuda_txt">Total a Pagar</label>
                                <input type="text" name="total_deuda_txt" class="form-control" id="total_deuda_txt" readonly>
                                <input type="hidden" name="total_deuda" class="form-control" id="total_deuda" readonly>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="cuotas">Numero de Cuotas (Semanas)</label>
                                <input type="number" name="cuotas" class="form-control" id="cuotas" min="1" value="1">
                        </div>
                        <div class="form-group col-md-4">
                                <label for="monto_cuotas">Monto de Cuotas Semanales</label>
                                <input type="text" name="monto_cuotas_txt" class="form-control" id="monto_cuotas_txt" readonly>
                                <input type="hidden" name="monto_cuotas" class="form-control" id="monto_cuotas" readonly>
                        </div>
                </form>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary approve" data-dismiss="modal">Asignar Prestamo</button>
        </div>
    </div>
  </div>
</div>
@endsection


@push('script')
<script>

var porcentajeInteres = 0;
var cuotasMaximas = 0;
var totalDisponible = 0;

$('#employee').DataTable({
   "lengthChange": false,
   "fnDrawCallback": function() {
        initButtons();
    }
});

$(document).ready(function() {

        $('.print').on('click', function() {
                printElement(document.getElementById('modalCredito'));
                document.print();
        });

        $.ajax({
                url: 'configuracion/lista',
                method: 'GET',
                success: function(res) {
                        porcentajeInteres = res.porcen_interes;
                        cuotasMaximas = res.cuotas_maximas;
                        
                        $('#modalCredito #cuotas').attr('max', res.cuotas_maximas);
                }
        });

        $('.approve').on('click', function() {
                parseFloat($('#total_deuda').val());
                parseFloat($('#monto_cuotas').val());
                $.ajax({
                        url: 'prestamos/insert',
                        method: 'POST',
                        data: $('#formCredito').serialize(),
                        success: function(res) {
                                swal(
                                        'Prestamo realizado.',
                                        'Se ha asignado el prestamo al empleado.',
                                        'success'
                                ).then(function () {
                                        location.reload();
                                });
                        },
                        error: function() {
                                swal(
                                        'Error.',
                                        'Se ha generado un error al conectar con el servidor. Intente nuevamente.',
                                        'error'
                                );
                        }
                });
        });
});

function initButtons() {

    $('#modalCredito').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $('#acumulado').val('0');
        $('#interes').val('0');
        $('#total_deuda').val('0');
        $('#monto').val('0');
        $('#monto_cuotas').val('0');
        $('#cuotas').val('1');

        $('#nombre').text(empleado.nombre);
        $('#cedula').val(empleado.cedula);
        $('#cedula_txt').text(empleado.cedula);

        $('#acumulado').val('₡' + (parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron) + parseFloat(empleado.capitalizado)).toLocaleString(undefined, {minimumFractionDigits: 2}));
        $('#deuda').val('₡' + parseFloat(empleado.prestamos).toLocaleString(undefined, {minimumFractionDigits: 2}));
        $('#disponible').val('₡' + (parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron) + parseFloat(empleado.capitalizado) - parseFloat(empleado.prestamos)).toLocaleString(undefined, {minimumFractionDigits: 2}));
        
        totalDisponible = parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron) + parseFloat(empleado.capitalizado) - parseFloat(empleado.prestamos);
        
    });

    $('#monto').on('keyup', calculate);
    $('#monto').on('click', calculate);
    $('#cuotas').on('click', calculate);
    $('#cuotas').on('keyup', calculate);

    function calculate() {
        if( parseInt($('#cuotas').val()) > cuotasMaximas) {
                $('#cuotas').val(cuotasMaximas);
        }

        if(parseFloat($('#monto').val()) > totalDisponible) {
                $('#monto').val(totalDisponible);
        }

        var monto = parseFloat($('#monto').val());
        var cuotas = parseInt($('#cuotas').val());
        var porcentaje_interes = (porcentajeInteres / 100) / 52 * cuotas;
        var interes = parseFloat(monto * porcentaje_interes);

        $('#interes_txt').val('₡ ' + interes.toLocaleString(undefined, {minimumFractionDigits: 2}) );
        $('#monto_cuotas_txt').val('₡ ' + ((monto + interes) / cuotas).toLocaleString(undefined, {minimumFractionDigits: 2}) );
        $('#total_deuda_txt').val('₡ ' + (monto + interes).toLocaleString(undefined, {minimumFractionDigits: 2}) );

        $('#interes').val( interes );
        $('#monto_cuotas').val( (monto + interes) / cuotas );
        $('#total_deuda').val( monto + interes );
    }
}

</script>
@endpush