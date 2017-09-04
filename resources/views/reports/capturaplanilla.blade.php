@extends('layouts.main')

@section('style')
<style>

</style>
@endsection


@section('content')
<div class="col-md-12">
        <div class="card">
                <div class="card-header bg-info text-white">
                        <b>Captura de Planilla</b>
                </div>
                <div class="card-block">
                <table id="planilla" class="table display" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                                <th>C&oacute;digo</th>
                                <th>C&eacute;dula</th>
                                <th>Nombre</th>
                                <th>Aporte Patronal</th>
                                <th>Aporte Obrero</th>
                                <th>Cuota</th>
                                <th>Interes</th>
                                <th>Amortiza</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($planilla as $item)
                        <tr>
                                <td>{{$item->codigo}}</td>
                                <td>{{$item->cedula}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>₡ {{number_format($item->ap_patronal, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->ap_obrero, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->amt_cuota, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->intereses, 2, ',', '.')}}</td>
                                <td>₡ {{number_format($item->amortiza, 2, ',', '.')}}</td>
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
$('#planilla').DataTable({
   "lengthChange": false,
   "fnDrawCallback": function() {
        initButtons();
    }
});

</script>
@endpush