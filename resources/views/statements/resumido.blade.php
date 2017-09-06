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
#roboto {
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
                        <b>Estado de Cuenta Resumido</b>
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
                                <th>Estado de Cuenta</th>
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
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalResumido" data-empleado="{{$empleado}}"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
                </div>
        </div>
</div>

<!-- Modal Detallado -->
<div class="modal fade" id="modalResumido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content modal-lg">
    <div class="modal-body">
    <div class="row">
            <div class="col-md-8">
                <h1 id="company-title" align="center"><b>A.S.E.IN.B.E</b></h1>
            </div>
            <div class="col-md-4">
                <p>C&eacute;dula Jur&iacute;dica: <span id="cedula-juridica"></span></p>
                <p>Fecha: <span id="fecha"></span></p>
            </div>
        </div>
        <div class="row">
                <div class="col-md-12"><h3 align="center">Estado de Cuenta Resumido</h3></div>
        </div>
        <div class="row">
                <div class="col-md-6">
                        <p>Nombre: <span id="nombre"></span></p>
                </div>
                <div class="col-md-3">
                        <p>C&eacute;dula: <span id="cedula"></span></p>
                </div>
                <div class="col-md-3">
                        <p>Socio N°: <span id="codigo"></span></p>
                </div>
        </div>
        <div class="row">
                <div class="col-md-12">
                        <p>Saldo Dividendos Capitalizados: <span id="sal_cap"></span></p>
                </div>
        </div>
        <div class="row">
                <div class="col-md-4 center text-center">
                        <p><b>Ahorro Patronal</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo <Au></Au>nterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                        </div>
                </div>
                <div class="col-md-4 center text-center">
                        <p><b>Ahorro Obrero</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo <Au></Au>nterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                        </div>
                </div>
                <div class="col-md-4 center text-center">
                        <p><b>Cr&eacute;ditos</b></p>
                        <div class="row">
                                <div class="col-md-7 text-left">
                                        <span>Saldo <Au></Au>nterior: </span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                                <div class="col-md-4">
                                        <span id="roboto"><u>04-12-2018</u></span>
                                </div>
                                <div class="col-md-3 no-padding">
                                        <span id="roboto"><u>₡ 56.984,68</u></span>
                                </div>
                                <div class="col-md-5">
                                        <span id="roboto"><u>₡ 39.454.456,24</u></span>
                                </div>
                        </div>
                </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary print" data-dismiss="modal">Imprimir</button>
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
     
         $('#modalResumido').on('show.bs.modal', function (event) {
             
         });
     }

</script>
@endpush