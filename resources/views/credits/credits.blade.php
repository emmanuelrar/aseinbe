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
                                <th>Acciones</th>
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
                                        <button type="button" class="btn btn-info credito" data-toggle="modal" data-target="#modalCredito" data-empleado="{{$empleado}}"><i class="fa fa-university" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Resumido -->
<div class="modal fade" id="modalCredito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
        <div class="modal-header">
                <h4 align="center">Aprobar Cr&eacute;dito</h4>
        </div>
        <div class="modal-body">
                <form id="formCredito">
                        <div class="col-md-4">
                                <p>Nombre: <u id="nombre"></u></p>
                        </div>
                        <div class="col-md-4 text-center">
                                <p>C&oacute;digo: <u id="codigo"></u></p>                                
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="text" name="fecha" class="form-control"s id="fecha">
                                </div>
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
});

function initButtons() {

    $('#modalCredito').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $('#nombre').text(empleado.nombre);
        $('#codigo').text(empleado.codigo);        

        console.log(empleado);
    });
}

</script>
@endpush