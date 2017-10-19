@extends('layouts.main')

@section('style')
<style>

</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Año de Recaudacion Actual</b>
                        <div style="float: right;">
                                <button type="button" class="btn btn-primary close-year">Cerrar Año Actual <i class="fa fa-archive" aria-hidden="true"></i></button>
                        </div>
                </div>
                <div class="card-block">
                    <table id="year" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Año</th>
                            <th>Monto Capitalizado</th>
                            <th>Fecha Inicio</th>
                            <th>Repartido</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recaudacion as $recaudado)
                        <tr>
                            <td>{{$recaudado->año}}</td>
                            <td>{{$recaudado->monto_capitalizado}}</td>
                            <td>{{$recaudado->fecha_inicio}}</td>
                            <td>{{$recaudado->repartido == 1 ? 'Si' : 'No'}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
</div>

<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Años de Recaudacion Anterior</b>
                </div>
                <div class="card-block">
                    <table id="years" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Año</th>
                            <th>Monto Capitalizado</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Cierre</th>
                            <th>Repartido</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recaudaciones as $recaudado)
                        <tr>
                            <td>{{$recaudado->año}}</td>
                            <td>{{$recaudado->monto_capitalizado}}</td>
                            <td>{{$recaudado->fecha_inicio}}</td>
                            <td>{{$recaudado->fecha_cierre}}</td>
                            <td>{{$recaudado->repartido == 1 ? 'Si' : 'No'}}</td>
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
$('#year').DataTable({
   "lengthChange": false,
   "searching": false,
   "ordering": false,
   paging: false,
   info: false,
   "language": {
      "emptyTable": "No se ha creado un registro para el año actual. Debe crear el registro."
    }
});

$('#years').DataTable({
   "lengthChange": false,
   "language": {
      "emptyTable": "No existen registros anteriores."
    }
});

$(document).ready(function() {

    $('.close-year').on('click', function() {
        // 
    });
    
    $('.update').on('click', function() {
        $.ajax({
            url: 'configuracion/update',
            method: 'POST',
            data: $('#updateConfiguration').serialize(),
            success: function() {
                swal(
                    'Datos modificados.',
                    'Los datos han sido actualizados.',
                    'success'
                    ).then(function () {
                            location.reload();
                });
            },
            error: function() {
                swal(
                    'Error.',
                    'Ha ocurrido un error al conectar con la aplicacion.',
                    'error'
                    );
            }
        });
    });

});
</script>
@endpush