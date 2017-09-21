@extends('layouts.main')

@section('style')
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
.modal-lg {
    min-width: 90vw !important;
}
.modal-dialog {
        margin: 10vh 5vw !important;
}
</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Lista de Empleados</b>
                        <div style="float: right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertModal">Añadir Empleado <i class="fa fa-user-plus" aria-hidden="true"></i></button>
                        </div>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Codigo</th>
                                <th>Salario</th>
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
                                <td>{{$empleado->salario}}</td>
                                <td>{{$empleado->cta_banc}}</td>
                                <td>{{$empleado->telefono}}</td>
                                <td align="center">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal" data-empleado="{{$empleado}}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-empleado="{{$empleado}}"><i class="fa fa-pencil-square fa-lg text-white" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger delete" data-codigo="{{$empleado->codigo}}"><i class="fa fa-trash fa-lg text-white" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Update -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title">Modificar empleado</h5>
      </div>
      <div class="modal-body">
        <form action="{{route('update-employee')}}" id="updateForm">
                {{ csrf_field() }}
        <div class="row">
                <div class="col-md-4">
                        <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                                <label for="cedula">C&eacute;dula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" required>
                        </div>
                        <div class="form-group">
                                <label for="codigo">C&oacute;digo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" required>
                        </div>
                        <div class="form-group">
                                <label for="telefono">Tel&eacute;fono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="form-group">
                                <label for="estado_civil">Estado Civil</label>
                                <select class="form-control" id="estado_civil" name="estado_civil" required>
                                <option>Casado</option>
                                <option>Viudo</option>
                                <option>Soltero</option>
                                <option>Divorciado</option>
                                <option>Concubino</option>
                                </select>
                        </div>
                        <div class="form-group">
                                <label for="conyugue">Conyugue</label>
                                <input type="text" class="form-control" id="conyugue" name="conyugue">
                        </div>
                        <div class="form-group">
                                <label for="hijos">Numero de Hijos</label>
                                <input type="number" class="form-control" id="hijos" name="hijos">
                        </div>
                        <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select class="form-control" id="sexo" name="sexo" required>
                                <option>M</option>
                                <option>F</option>
                                </select>
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="form-group">
                                <label for="salario">Salario</label>
                                <input type="text" class="form-control" id="salario" name="salario" required>
                        </div>
                        <div class="form-group">
                                <label for="fecha_ingreso">Fecha de ingreso</label>
                                <input class="form-control" type="date" id="fecha_ingreso" name="fecha_ingreso" required>
                        </div>
                        <div class="form-group">
                                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo">Activo</label>
                        </div>
                        <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="liquidado" name="liquidado">Liquidado</label>
                        </div>
                </div>
                <div class="col-md-8">
                        <div class="form-group">
                                <label for="cta_banc">Cuenta Bancaria</label>
                                <input type="text" class="form-control" id="cta_banc" name="cta_banc" required>
                        </div>
                </div>
                <div class="col-md-12">
                        <hr>
                        <div class="col-md-6">
                                <h5 align="right">Beneficiario </h5>
                        </div>
                        <div class="col-md-6 text-right">
                                <div>
                                        <button type="button" class="btn btn-primary btn-sm add-beneficiario" data-toggle="modal">Añadir Beneficiario <i class="fa fa-user-plus" aria-hidden="true"></i></button>
                                </div>
                        </div>
                        <hr>
                </div>
                <div id="beneficiarios" style="width: 100%">
                
                </div>
        </div>
        </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary update">Modificar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Insert -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title">Agregar empleado</h5>
      </div>
      <div class="modal-body">
        <form action="{{route('insert-employee')}}" id="insertForm">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                        <label for="cedula">C&eacute;dula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" required>
                </div>
                <div class="form-group">
                        <label for="codigo">C&oacute;digo</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                </div>
                <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select class="form-control" id="estado_civil" name="estado_civil" required>
                        <option>Casado</option>
                        <option>Viudo</option>
                        <option>Soltero</option>
                        <option>Divorciado</option>
                        <option>Concubino</option>
                        </select>
                </div>
                <div class="form-group">
                        <label for="conyugue">Conyugue</label>
                        <input type="text" class="form-control" id="conyugue" name="conyugue">
                </div>
                <div class="form-group">
                        <label for="hijos">Numero de Hijos</label>
                        <input type="number" class="form-control" id="hijos" name="hijos">
                </div>
                <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                        <option>M</option>
                        <option>F</option>
                        </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label for="salario">Salario</label>
                        <input type="text" class="form-control" id="salario" name="salario" required>
                </div>
                <div class="form-group">
                        <label for="ingreso">Fecha de ingreso</label>
                        <input class="form-control" type="date" id="ingreso" name="ingreso" required>
                </div>
                <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input class="form-control" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="form-group">
                        <label for="nacionalidad">Nacionalidad</label>
                        <input type="text" class="form-control" id="nacionalidad" name="nacionalidad">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="activo" name="activo">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="liquidado" name="liquidado">Liquidado</label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                        <label for="cta_banc">Cuenta Bancaria</label>
                        <input type="text" class="form-control" id="cta_banc" name="cta_banc" required>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <div class="col-md-6">
                        <h5 align="right">Beneficiario </h5>
                </div>
                <div class="col-md-6 text-right">
                        <div>
                                <button type="button" class="btn btn-primary btn-sm add-beneficiario" data-toggle="modal">Añadir Beneficiario <i class="fa fa-user-plus" aria-hidden="true"></i></button>
                        </div>
                </div>
                <hr>
            </div>
            <div id="beneficiarios" style="width: 100%">
                <!--  -->
            </div>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary insert">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal View -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
        <form action="#" id="viewForm">
                {{ csrf_field() }}
        <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input readonly type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                        <label for="cedula">C&eacute;dula</label>
                        <input readonly type="text" class="form-control" id="cedula" name="cedula">
                </div>
                <div class="form-group">
                        <label for="codigo">C&oacute;digo</label>
                        <input readonly type="text" class="form-control" id="codigo" name="codigo">
                </div>
                <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input readonly type="text" class="form-control" id="telefono" name="telefono">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <input readonly type="text" class="form-control" id="estado_civil" name="estado_civil">
                </div>
                <div class="form-group">
                        <label for="conyugue">Conyugue</label>
                        <input readonly type="text" class="form-control" id="conyugue" name="conyugue">
                </div>
                <div class="form-group">
                        <label for="hijos">Numero de Hijos</label>
                        <input readonly type="number" class="form-control" id="hijos" name="hijos">
                </div>
                <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input readonly type="text" class="form-control" id="sexo" name="sexo">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-group">
                        <label for="salario">Salario</label>
                        <input readonly type="text" class="form-control" id="salario" name="salario">
                </div>
                <div class="form-group">
                        <label for="fecha_ingreso">Fecha de ingreso</label>
                        <input readonly class="form-control" type="text" id="fecha_ingreso" name="fecha_ingreso">
                </div>
                <div class="form-group">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input readonly class="form-control" type="text" id="fecha_nacimiento" name="fecha_nacimiento">
                </div>
                <div class="form-group">
                        <label for="nacionalidad">Nacionalidad</label>
                        <input readonly type="text" class="form-control" id="nacionalidad" name="nacionalidad">
                </div>
                </div>
                <div class="col-md-4">
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input readonly type="checkbox" class="form-check-input" id="activo" name="activo">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input readonly type="checkbox" class="form-check-input" id="liquidado" name="liquidado">Liquidado</label>
                </div>
                </div>
                <div class="col-md-8">
                <div class="form-group">
                        <label for="cta_banc">Cuenta Bancaria</label>
                        <input readonly type="text" class="form-control" id="cta_banc" name="cta_banc">
                </div>
                </div>
                <div class="col-md-12">
                <hr>
                <h5 align="center">Beneficiario </h5>
                <hr>
                </div>
                <div id="beneficiarios" style="width: 100%">
                        <!--  -->
                </div>
        </div>
        </form>
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
var count = 0;

$('#employee').DataTable({
   "lengthChange": false,
   "fnDrawCallback": function() {
        initButtons();
    }
});

$(document).ready(function() {
        $('.add-beneficiario').on('click', function() {
                $('#insertModal #beneficiarios, #editModal #beneficiarios').append('<div id="beneficiario_' + count + '" style="width: 100%;"><div class="col-md-4"><div class="form-group"><label for="nombre_s">Nombre</label>'
                + '<input required type="text" class="form-control" id="nombre_s" name="nombre_beneficiario[]"></div></div>'
                + '<div class="col-md-2"><div class="form-group"><label for="cedula_beneficiario">Cedula</label>'
                + '<input required type="text" class="form-control" id="cedula_beneficiario" name="cedula_beneficiario[]"></div></div>'
                + '<div class="col-md-3"><div class="form-group"><label for="parentesco">Parentesco</label>'
                + '<input required type="text" class="form-control" id="parentesco" name="parentesco[]"></div></div><div class="col-md-2">'
                + '<div class="form-group"><label for="porcentaje">Porcentaje</label>'
                + '<input required type="number" class="form-control" id="porcentaje" name="porcentaje[]"></div></div>'
                + '<div class="col-md-1" style="top: 4vh;"><button type="button" class="btn btn-danger remove" data-name="beneficiario_' + count + '"><i class="fa fa-minus" aria-hidden="true"></i></button></div></div>');
                count++;

                $('.remove').on('click', function() {
                        $('#'+$(this).data('name')).remove();
                });
        });

    
    $('#insertModal').on('show.bs.modal', function (event) {

        $('.insert').on('click', function() {
                $('#insertForm').validate({
                        rules: {
                                nombre: "required",
                                cedula: "required",
                                cta_banc: "required",
                                codigo: "required",
                                telefono: "required",
                                fecha_nacimiento: "required",
                                fecha_ingreso: "required",
                                hijos: "required",
                                nacionalidad: "required",
                                estado_civil: "required",
                                salario: "required",
                                sexo: "required",
                                'nombre_beneficiario[]':{
                                        required: true
                                }
                        },
                        messages: {
                                nombre: "Debe introducir un nombre valido.",
                                codigo: "Debe introducir un codigo valido.",
                                cedula: "Debe introducir una cedula valida.",
                                cta_banc: "Debe introducir una cuenta bancaria valida.",
                                telefono: "Debe introducir un telefono valido.",
                                fecha_nacimiento: "Debe introducir una fecha de nacimiento valida.",
                                fecha_ingreso: "Debe introducir una fecha de ingreso valida.",
                                hijos: "Debe introducir un valor valido, si no tiene hijos coloque 0.",
                                nacionalidad: "Debe seleccionar una opcion.",
                                salario: "Debe introducir una cedula valida.",
                                sexo: "Debe seleccionar una opcion.",
                                'nombre_beneficiario[]': {
                                        required: "Debe introducir el nombre completo del beneficiario."
                                },
                                'cedula_beneficiario[]': {
                                        required: "Debe introducir una cedula valida."
                                },
                                'parentesco[]': {
                                        required: "Defina la relacion del empleado con el beneficiario."
                                },
                                'porcentaje[]': {
                                        required: "Defina el porcentaje que el beneficiario recibira."
                                },
                        },
                        submitHandler: function(form) {
                                $.ajax({
                                method: 'post',     
                                url: 'empleado/insert',
                                data: $(form).serialize(),
                                success: function() {
                                        swal(
                                        'Registrado.',
                                        'El registro ha sido creado.',
                                        'success'
                                        ).then(function () {
                                                location.reload();
                                        });
                                },
                                error: function() {
                                        swal(
                                        'Error.',
                                        'Ha ocurrido un error al conectar con el servidor.',
                                        'error'
                                        ); 
                                }
                                });
                        }
                });
                if($('#insertForm').valid()) {
                        $('#insertForm').submit();
                }
        });
    });
});

function initButtons() {
    $('.delete').on('click', function() {
        var id = $(this).data('codigo');
        swal({
        title: '¿Estas seguro(a)?',
        text: "Este cambio no podra revertirse.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, deseo eliminarlo'
        }).then(function () {
                $.ajax({
                method: 'get',     
                url: 'empleado/delete/' + id,
                success: function() {
                        swal(
                        'Eliminado',
                        'El empleado ha sido eliminado.',
                        'success'
                        ).then(function () {
                                location.reload();
                        });
                },
                error: function() {
                        swal(
                        'Error.',
                        'Ha ocurrido un error al conectar con el servidor.',
                        'error'
                        ); 
                }
                });
        });
    });

    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');
        $('.modal-title').text(empleado.nombre);
        $('#editModal #nombre').val(empleado.nombre);
        $('#editModal #cedula').val(empleado.cedula);
        $('#editModal #salario').val(parseFloat(empleado.salario).toFixed(0));
        $('#editModal #codigo').val(empleado.codigo);
        $('#editModal #cta_banc').val(empleado.cta_banc);
        $('#editModal #telefono').val(empleado.telefono);
        $('#editModal #fecha_nacimiento').attr('value', moment(empleado.fecha_nacimiento).format("YYYY-MM-DD"));
        $('#editModal #fecha_ingreso').attr('value', moment(empleado.fecha_ingreso).format("YYYY-MM-DD"));
        $('#editModal #hijos').val(empleado.hijos);
        $('#editModal #sexo').val(empleado.sexo);
        $('#editModal #estado_civil').val(empleado.estado_civil);
        $('#editModal #conyugue').val(empleado.conyugue);
        $('#editModal #activo').val(empleado.activo);
        $('#editModal #nacionalidad').val(empleado.nacionalidad);
        $('#editModal #liquidado').val(empleado.liquidado);
        if( empleado.activo == 1 ) {
        $('#editModal #activo').attr('checked', true);
        } else {
        $('#editModal #activo').attr('checked', false);
        }
        if( empleado.liquidado == 1 ) {
        $('#editModal #liquidado').attr('checked', true);
        } else {
        $('#editModal #liquidado').attr('checked', false);
        }
        $('#editModal #beneficiarios').html('');

        $.ajax({
                url: 'empleado/beneficiario/' + empleado.cedula,
                method: 'GET',
                success: function(data) {
                        count = data.length;
                        $.each(data, function(index, value) {
                                $('#editModal #beneficiarios').append('<div id="beneficiario_' + index + '" style="width: 100%;"><div class="col-md-4"><div class="form-group"><label for="nombre_s">Nombre</label>'
                                + '<input required type="text" class="form-control" id="nombre_s" name="nombre_beneficiario[]" value="' + value.nombre + '"></div></div>'
                                + '<div class="col-md-2"><div class="form-group"><label for="cedula_beneficiario">Cedula</label>'
                                + '<input required type="text" class="form-control" id="cedula_beneficiario" name="cedula_beneficiario[]" value="' + value.cedula + '"></div></div>'
                                + '<div class="col-md-3"><div class="form-group"><label for="parentesco">Parentesco</label>'
                                + '<input required type="text" class="form-control" id="parentesco" name="parentesco[]" value="' + value.parentesco + '"></div></div>'
                                + '<input type="hidden" class="form-control" id="id" name="id[]" value="' + value.id + '"><div class="col-md-2">'
                                + '<div class="form-group"><label for="porcentaje">Porcentaje</label>'
                                + '<input required type="number" class="form-control" id="porcentaje" name="porcentaje[]" value="' + value.porcentaje + '"></div></div>'
                                + '<div class="col-md-1" style="top: 4vh;"><button type="button" class="btn btn-danger delete" data-cedula="' + value.cedula + '" data-name="beneficiario_' + index + '"><i class="fa fa-minus" aria-hidden="true"></i></button></div></div></div>');
                        });

                        $('.delete').on('click', function() {
                                var idname = '#'+$(this).data('name');
                                var cedula = $(this).data('cedula');
                                swal({
                                title: '¿Estas seguro(a)?',
                                text: "Este cambio no podra revertirse.",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, deseo eliminarlo'
                                }).then(function () {
                                        $.ajax({
                                                url: 'empleado/beneficiario/eliminar/' + cedula,
                                                method: 'GET',
                                                success: function(res) {
                                                        $(idname).remove();                                                
                                                }
                                        });
                                });
                        });
                }
        });
        
        $('.update').on('click', function() {
           $.ajax({
                method: 'post',     
                url: 'empleado/update',
                data: $('#updateForm').serialize(),
                success: function() {
                        swal(
                        'Actualizado.',
                        'El registro ha sido modificado.',
                        'success'
                        ).then(function () {
                                location.reload();
                        });
                },
                error: function() {
                        swal(
                        'Error.',
                        'Ha ocurrido un error al conectar con el servidor.',
                        'error'
                        ); 
                }
           });
        });
    });

    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');

        $('.modal-title').text(empleado.nombre);
        $('#viewModal #nombre').val(empleado.nombre);
        $('#viewModal #cedula').val(empleado.cedula);
        $('#viewModal #salario').val('₡ ' + parseFloat(empleado.salario).toLocaleString());
        $('#viewModal #codigo').val(empleado.codigo);
        $('#viewModal #cta_banc').val(empleado.cta_banc);
        $('#viewModal #telefono').val(empleado.telefono);
        $('#viewModal #fecha_nacimiento').val(moment(empleado.fecha_nacimiento).format("DD-MM-YYYY"));
        $('#viewModal #fecha_ingreso').val(moment(empleado.fecha_ingreso).format("DD-MM-YYYY"));
        $('#viewModal #hijos').val(empleado.hijos);
        $('#viewModal #sexo').val(empleado.sexo);
        $('#viewModal #estado_civil').val(empleado.estado_civil);
        $('#viewModal #conyugue').val(empleado.conyugue);
        $('#viewModal #activo').val(empleado.activo);
        $('#viewModal #nacionalidad').val(empleado.nacionalidad);
        $('#viewModal #liquidado').val(empleado.liquidado);
        if( empleado.activo == 1 ) {
        $('#viewModal #activo').attr('checked', true);
        } else {
        $('#viewModal #activo').attr('checked', false);
        }
        if( empleado.liquidado == 1 ) {
        $('#viewModal #liquidado').attr('checked', true);
        } else {
        $('#viewModal #liquidado').attr('checked', false);
        }
        $('#viewModal #beneficiarios').html('');
        $.ajax({
                url: 'empleado/beneficiario/' + empleado.cedula,
                method: 'GET',
                success: function(data) {
                        $.each(data, function(index, value) {
                                $('#viewModal #beneficiarios').append('<div class="col-md-4"><div class="form-group"><label for="nombre_s">Nombre</label>'
                                + '<input readonly type="text" class="form-control" value="' + value.nombre + '"></div></div>'
                                + '<div class="col-md-3"><div class="form-group"><label for="cedula_beneficiario">Cedula</label>'
                                + '<input readonly type="text" class="form-control" value="' + value.cedula + '"></div></div>'
                                + '<div class="col-md-3"><div class="form-group"><label for="parentesco">Parentesco</label>'
                                + '<input readonly type="text" class="form-control" value="' + value.parentesco + '"></div></div>'
                                + '<div class="col-md-2"><div class="form-group"><label for="porcentaje">Porcentaje</label>'
                                + '<input readonly type="text" class="form-control" id="porcentaje" name="porcentaje[]" value="' + value.porcentaje + '%"></div></div>');
                        });
                }
        });
    });
}

</script>
@endpush