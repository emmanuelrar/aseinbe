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
                                <td>₡ {{number_format($empleado->aporte_obrero + $empleado->aporte_patron, 2, ',', '.')}}</td>
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
                <form id="formCredito">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                                <p>Nombre: <u id="nombre"></u></p>
                        </div>
                        <div class="col-md-6 text-center">
                                <p>Cedula: <u id="cedula"></u></p>                                
                        </div>

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

                        <div class="form-group col-md-4">
                                <label for="monto">Monto</label>
                                <input type="number" name="monto" class="form-control" id="monto">
                        </div>
                        <div class="form-group col-md-4">
                                <label for="interes">Interes Mensual</label>
                                <input type="text" name="interes" class="form-control" id="interes" readonly>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="total_deuda">Total a Pagar</label>
                                <input type="text" name="total_deuda" class="form-control" id="total_deuda" readonly>
                        </div>
                        <div class="form-group col-md-4">
                                <label for="cuotas">Numero de Cuotas (Semanas)</label>
                                <input type="number" name="cuotas" class="form-control" id="cuotas" min="1" max="" value="1">
                        </div>
                        <div class="form-group col-md-4">
                                <label for="monto_cuotas">Monto de Cuotas Mensuales</label>
                                <input type="text" name="monto_cuotas" class="form-control" id="monto_cuotas" readonly>
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
                url: '../configuracion/list',
                method: 'GET',
                success: function(res) {
                        porcentajeInteres = res.porcen_interes;
                        cuotasMaximas = res.cuotas_maximas;
                        
                        $('#modalCredito #cuotas').attr('max', res.cuotas_maximas);
                }
        });

        $('.approve').on('click', function() {
                
        });
});

function initButtons() {

    $('#modalCredito').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $('#monto').val('0');
        $('#interes').val('0');
        $('#monto_cuotas').val('0');
        $('#total_deuda').val('0');
        $('#cuotas').val('1');

        $('#nombre').text(empleado.nombre);
        $('#cedula').text(empleado.cedula);

        $('#acumulado').val('₡' + (parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron)).toLocaleString());
        $('#deuda').val('₡' + parseFloat(empleado.prestamos).toLocaleString());
        $('#disponible').val('₡' + (parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron) - parseFloat(empleado.prestamos)).toLocaleString());
        
        totalDisponible = parseFloat(empleado.aporte_obrero) + parseFloat(empleado.aporte_patron) - parseFloat(empleado.prestamos);
        
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

        $('#interes').val( (parseFloat($('#monto').val()) * (porcentajeInteres/100)).toLocaleString() );

        $('#monto_cuotas').val( (parseFloat($('#monto').val()) / parseInt($('#cuotas').val())).toLocaleString() );
        $('#total_deuda').val( (parseFloat($('#monto').val()) + (parseFloat($('#monto').val()) * (porcentajeInteres/100))).toLocaleString() );
    }
}

</script>
@endpush