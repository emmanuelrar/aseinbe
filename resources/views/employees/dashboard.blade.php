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
                                <th>Aporte</th>
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
                                <td>{{$empleado->ap_obrero}}</td>
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
            <div class="col-md-6">
                <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                        <label for="cedula">C&eacute;dula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula">
                </div>
                <div class="form-group">
                        <label for="cta_banc">Cuenta Bancaria</label>
                        <input type="text" class="form-control" id="cta_banc" name="cta_banc">
                </div>
                <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                </div>
                <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                        <option>M</option>
                        <option>F</option>
                        </select>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="activo" name="activo">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="liquidado" name="liquidado">Liquidado</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                        <label for="beneficiario">Beneficiario</label>
                        <input type="text" class="form-control" id="beneficiario" name="beneficiario">
                </div>
                <div class="form-group">
                        <label for="ced_bene">Cedula Beneficiario</label>
                        <input type="text" class="form-control" id="ced_bene" name="ced_bene">
                </div>
                <div class="form-group">
                        <label for="est_civil">Estado Civil</label>
                        <select class="form-control" id="est_civil" name="est_civil">
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
                        <label for="num_hijos">Numero de Hijos</label>
                        <input type="number" class="form-control" id="num_hijos" name="num_hijos">
                </div>
                <div class="form-group">
                        <label for="fec_naci">Fecha de nacimiento</label>
                        <input class="form-control" type="date" id="fec_naci" name="fec_naci">
                </div>
            </div>
        </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id">
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
            <div class="col-md-6">
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
                        <label for="cta_banc">Cuenta Bancaria</label>
                        <input type="text" class="form-control" id="cta_banc" name="cta_banc" required>
                </div>
                <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                        <option>M</option>
                        <option>F</option>
                        </select>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="activo" name="activo">Activo</label>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="liquidado" name="liquidado">Liquidado</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                        <label for="beneficiario">Beneficiario</label>
                        <input type="text" class="form-control" id="beneficiario" name="beneficiario" required>
                </div>
                <div class="form-group">
                        <label for="ced_bene">Cedula Beneficiario</label>
                        <input type="text" class="form-control" id="ced_bene" name="ced_bene" required>
                </div>
                <div class="form-group">
                        <label for="est_civil">Estado Civil</label>
                        <select class="form-control" id="est_civil" name="est_civil" required>
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
                        <label for="num_hijos">Numero de Hijos</label>
                        <input type="number" class="form-control" id="num_hijos" name="num_hijos">
                </div>
                <div class="form-group">
                        <label for="ingreso">Fecha de ingreso</label>
                        <input class="form-control" type="date" id="ingreso" name="ingreso" required>
                </div>
                <div class="form-group">
                        <label for="fec_naci">Fecha de nacimiento</label>
                        <input class="form-control" type="date" id="fec_naci" name="fec_naci" required>
                </div>
            </div>
        </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id">
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
        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                        <label for="codigo">C&oacute;digo</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" readonly>
                </div>
                <div class="form-group">
                        <label for="nombre">Aporte Patronal</label>
                        <input type="text" class="form-control" id="ap_patronal" name="ap_patronal" readonly>
                </div>
                <div class="form-group">
                        <label for="capitalizado">Capitalizado</label>
                        <input type="text" class="form-control" id="capitalizado" name="capitalizado" readonly>
                </div>
                <div class="form-group">
                        <label for="cta_banc">Cuenta Bancaria</label>
                        <input type="text" class="form-control" id="cta_banc" name="cta_banc" readonly>
                </div>
                <div class="form-group">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" readonly>
                </div>
                <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input type="text" class="form-control" id="sexo" name="sexo" readonly>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="activo" name="activo" disabled>Activo</label>
                </div>
                <div class="form-check form-check-inline">
                        <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" id="liquidado" name="liquidado" disabled>Liquidado</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                        <label for="beneficiario">Beneficiario</label>
                        <input type="text" class="form-control" id="beneficiario" name="beneficiario" readonly>
                </div>
                <div class="form-group">
                        <label for="ap_obrero">Aporte Obrero</label>
                        <input type="text" class="form-control" id="ap_obrero" name="ap_obrero" readonly>
                </div>
                <div class="form-group">
                        <label for="saldo_cxc">Saldo Prestamo</label>
                        <input type="text" class="form-control" id="saldo_cxc" name="saldo_cxc" readonly>
                </div>
                <div class="form-group">
                        <label for="num_hijos">Numero de Hijos</label>
                        <input type="number" class="form-control" id="num_hijos" name="num_hijos" readonly>
                </div>
                <div class="form-group">
                        <label for="ingreso">Fecha de ingreso</label>
                        <input class="form-control" type="text" id="ingreso" name="ingreso" readonly>
                </div>
                <div class="form-group">
                        <label for="fec_naci">Fecha de nacimiento</label>
                        <input class="form-control" type="text" id="fec_naci" name="fec_naci" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
                <input type="hidden" class="form-control" id="id" name="id">
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
    }
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
        $('#id').val(empleado.codigo);        
        $('#nombre').val(empleado.nombre);
        $('#cedula').val(empleado.cedula);
        $('#cta_banc').val(empleado.cta_banc);
        $('#telefono').val(empleado.telefono);
        $('#fec_naci').val(empleado.fec_naci);
        $('#num_hijos').val(empleado.num_hijos);
        $('#conyugue').val(empleado.conyugue);
        $('#est_civil').val(empleado.est_civil);
        $('#beneficiario').val(empleado.beneficiario);
        $('#ced_bene').val(empleado.ced_bene);
        $('#sexo').val(empleado.sexo);
        $('#activo').val(empleado.activo);
        $('#liquidado').val(empleado.liquidado);

        if( empleado.activo == 1 ) {
        $('#activo').attr('checked', true);
        } else {
        $('#activo').attr('checked', false);
        }

        if( empleado.liquidado == 1 ) {
        $('#liquidado').attr('checked', true);
        } else {
        $('#liquidado').attr('checked', false);
        }
        
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

    $('#insertModal').on('show.bs.modal', function (event) {

        $('.insert').on('click', function() {
                $('#insertForm').validate({
                        rules: {
                                nombre: "required",
                                cedula: "required",
                                cta_banc: "required",
                                codigo: "required",
                                telefono: "required",
                                fec_naci: "required",
                                ingreso: "required",
                                num_hijos: "required",
                                est_civil: "required",
                                beneficiario: "required",
                                ced_bene: "required",
                                sexo: "required",
                        },
                        messages: {
                                nombre: "Debe introducir un nombre valido.",
                                codigo: "Debe introducir un codigo valido.",
                                cedula: "Debe introducir una cedula valida.",
                                cta_banc: "Debe introducir una cuenta bancaria valida.",
                                telefono: "Debe introducir un telefono valido.",
                                fec_naci: "Debe introducir una fecha de nacimiento valida.",
                                ingreso: "Debe introducir una fecha de ingreso valida.",
                                num_hijos: "Debe introducir un valor valido, si no tiene hijos coloque 0.",
                                est_civil: "Debe seleccionar una opcion.",
                                beneficiario: "Debe introducir un nombre valido.",
                                ced_bene: "Debe introducir una cedula valida.",
                                sexo: "Debe seleccionar una opcion.",
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

    $('#viewModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var empleado = button.data('empleado');
        $('.modal-title').text(empleado.nombre);
        $('#viewModal #ap_patronal').val('₡ ' + parseFloat(empleado.ap_patronal).toLocaleString());
        $('#viewModal #ap_obrero').val('₡ ' + parseFloat(empleado.ap_obrero).toLocaleString());
        $('#viewModal #codigo').val(empleado.codigo);
        $('#viewModal #cta_banc').val(empleado.cta_banc);
        $('#viewModal #telefono').val(empleado.telefono);
        $('#viewModal #fec_naci').val(empleado.fec_naci);
        $('#viewModal #ingreso').val(empleado.ingreso);
        $('#viewModal #num_hijos').val(empleado.num_hijos);
        $('#viewModal #capitalizado').val('₡ ' + parseFloat(empleado.capitalizado).toLocaleString());
        $('#viewModal #saldo_cxc').val('₡ ' + parseFloat(empleado.saldo_cxc).toLocaleString());
        $('#viewModal #beneficiario').val(empleado.beneficiario);
        $('#viewModal #ced_bene').val(empleado.ced_bene);
        $('#viewModal #sexo').val(empleado.sexo);
        $('#viewModal #activo').val(empleado.activo);
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
    });
}

</script>
@endpush