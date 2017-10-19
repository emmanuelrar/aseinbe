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
                        <b>Registro de Pagos/Cuotas</b>
                        <div style="float: right;">
                                <button type="button" class="btn btn-primary registrar-pagos" data-toggle="modal" data-target="#insertModal"> Registrar Pagos <i class="fa fa-balance-scale" aria-hidden="true"></i></button>
                        </div>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>fecha</th>
                                <th>Monto Cuota</th>
                                <th>Monto Restante</th>
                                <th>Cuotas Restantes</th>
                                <th>Amortizado</th>
                                <th>Interes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                                <td>{{$pago->nombre}}</td>
                                <td class="roboto">{{$pago->fecha}}</td>
                                <td class="roboto">₡ {{number_format($pago->monto_cuotas, 2, ',', '.')}}</td>
                                <td class="roboto">₡ {{number_format($pago->monto_restante, 2, ',', '.')}}</td>
                                <td class="roboto">{{$pago->cuotas_restantes}}</td>
                                <td class="roboto">₡ {{number_format($pago->amortizado, 2, ',', '.')}}</td>
                                <td class="roboto">₡ {{number_format($pago->interes, 2, ',', '.')}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

@endsection


@push('script')
<script>

$('#employee').DataTable({
   "lengthChange": false,
   "language": {
      "emptyTable": "No se han realizado pagos de cuotas."
    }
});

$(document).ready(function() {
        $('.registrar-pagos').on('click', function() {
                swal({
                title: '¿Estas seguro(a)?',
                text: "Este cambio no podra revertirse.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Registrar pagos'
                }).then(function () {
                        $.ajax({
                        url: 'pagar',
                        method: 'GET',
                        success: function() {
                                swal(
                                'Pagos registrados',
                                'Los pagos han sido cargados con exito.',
                                'success'
                                ).then(function () {
                                        location.reload();
                                });
                                $('.registrar-pagos').removeAttr('disabled');
                        },
                        error: function() {
                                swal(
                                'Error.',
                                'Ha ocurrido un error al conectar con el servidor.',
                                'error'
                                ); 
                                $('.registrar-pagos').removeAttr('disabled');
                        }
                        });
                },
                function(dismiss) {
                        $('.registrar-pagos').removeAttr('disabled');
                });
        });
});

</script>
@endpush