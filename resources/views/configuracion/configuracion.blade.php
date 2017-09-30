@extends('layouts.main')

@section('style')
<style>

</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Configuracion de Empresa</b>
                </div>
                <div class="card-block">
                    <form id="updateConfiguration" name="update-configuracion">
                        {{ csrf_field() }}
                        <div class="form-group col-md-6">
                            <label for="porcentaje_obrero">Porcentaje Obrero</label>
                            <input type="number" class="form-control" value="{{$configuracion->porcen_aporte_obrero}}" id="porcentaje_obrero" name="porcentaje_obrero">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="porcentaje_patron">Porcentaje Patronal</label>
                            <input type="number" class="form-control" value="{{$configuracion->porcen_aporte_patron}}" id="porcentaje_patron" name="porcentaje_patron">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coutas_max">Maximo de Coutas</label>
                            <input type="number" class="form-control" value="{{$configuracion->coutas_maximas}}" id="coutas_max" name="coutas_max">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="porcentaje_interes">Porcentaje de Interes Mensual</label>
                            <input type="number" class="form-control" value="{{$configuracion->porcen_interes}}" id="porcentaje_interes" name="porcentaje_interes">
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary update">Actualizar</button>
                        </div>
                    </form>
                </div>
        </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        
        $('.update').on('click', function() {
            console.log('Hola Mundo!');
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