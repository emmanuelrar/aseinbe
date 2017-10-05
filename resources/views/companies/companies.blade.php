@extends('layouts.main')

@section('style')
<style>
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
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: darkred !important;
}
</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Lista de Empresas</b>
                        <div style="float: right;">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertModal">Añadir Empresa <i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($empresas as $empresa)
                        <tr>
                                <td>{{$empresa->id}}</td>
                                <td>{{$empresa->nombre}}</td>
                                <td align="center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-empresa="{{$empresa}}"><i class="fa fa-pencil-square fa-lg text-white" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-danger delete" data-id="{{$empresa->id}}"><i class="fa fa-trash fa-lg text-white" aria-hidden="true"></i></button>
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
        <h5 class="modal-title">Modificar empresa</h5>
      </div>
      <div class="modal-body">
        <form action="{{route('update-employee')}}" id="updateForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
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
        <h5 class="modal-title">Agregar empresa</h5>
      </div>
      <div class="modal-body">
        <form action="{{route('insert-employee')}}" id="insertForm">
            {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
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
    
    $('#insertModal').on('show.bs.modal', function (event) {

        $('.insert').on('click', function() {
                $('#insertForm').validate({
                        rules: {
                                nombre: "required",
                        },
                        messages: {
                                nombre: "Debe introducir un nombre valido.",
                        },
                        submitHandler: function(form) {
                                $.ajax({
                                method: 'POST',     
                                url: 'empresas/insert',
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
        var id = $(this).data('id');
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
                method: 'GET',     
                url: 'empresas/delete/' + id,
                success: function() {
                        swal(
                        'Eliminado',
                        'El empresa ha sido eliminado.',
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
        var empresa = button.data('empresa');
        $('.modal-title').text(empresa.nombre);
        $('#editModal #nombre').val(empresa.nombre);
        
        $('.update').on('click', function() {
           $.ajax({
                method: 'POST',     
                url: 'empresas/update/' + empresa.id,
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

}

</script>
@endpush