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
                        <b>Registro de Aportes</b>
                        <div style="float: right;">
                                <button type="button" class="btn btn-primary registrar-aportes" data-toggle="modal" data-target="#insertModal"> Registrar Aportes <i class="fa fa-balance-scale" aria-hidden="true"></i></button>
                        </div>
                </div>
                <div class="card-block">
                <table id="employee" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Aporte Obrero</th>
                                <th>Aporte Patron</th>
                                <th>Fecha</th>
                                <th>Tipo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aportes as $aporte)
                        <tr>
                                <td>{{$aporte->nombre}}</td>
                                <td class="roboto">{{$aporte->cedula}}</td>
                                <td class="roboto">₡ {{number_format($aporte->aporte_obrero, 2, ',', '.')}}</td>
                                <td class="roboto">₡ {{number_format($aporte->aporte_patron, 2, ',', '.')}}</td>
                                <td>{{$aporte->fecha}}</td>
                                <td>{{$aporte->tipo}}</td>                                
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
   "fnDrawCallback": function() {
        initButtons();
    }
});

</script>
@endpush