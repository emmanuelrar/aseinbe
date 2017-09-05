<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @yield('style')
    <!-- Styles -->
    <link href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/datatables.net-dt/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.css') }}">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="{{ asset('bower_components/sweetalert2/dist/sweetalert2.min.js') }}"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse" style="position: fixed; width: 100vw; z-index: 9;">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">SNG</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Mi Cuenta</a>
                </li>
                <li class="nav-item">
                    <a class="text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                </ul>
            </div>
        </nav>
    </header>

    <main style="padding-top: 62px;">
        <div class="">
            <div class="row">
                <div class="col-md-2 col-sm-5">
                    <div class="nav-side-menu">
                        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                    
                            <div class="menu-list">
                    
                                <ul id="menu-content" class="menu-content collapse out">
                                    <li>
                                    <a href="{{route('index')}}">
                                    <i class="fa fa-dashboard fa-lg"></i> Dashboard
                                    </a>
                                    </li>
                    
                                    <li data-toggle="collapse" data-target="#products" class="collapsed">
                                    <a href="#"><i class="fa fa-file-text fa-lg"></i> Reportes <span class="arrow"></span></a>
                                    </li>
                                    <ul class="sub-menu collapse" id="products">
                                        <li><a href="{{route('captura-planilla')}}"> Captura de Planilla </a></li>
                                        <li><a href="{{route('reporte-prestamos')}}"> Reporte de Prestamos </a></li>
                                        <li><a href="{{route('dividendos')}}"> Detalle de Dividendos </a></li>
                                        <li><a href="{{route('acumulados')}}"> Reporte de Acumulados </a></li>
                                    </ul>
                                                        
                                    <li data-toggle="collapse" data-target="#setting" class="collapsed">
                                    <a href="#"><i class="fa fa-address-card-o" aria-hidden="true"></i> Estados de Cuenta <span class="arrow"></span></a>
                                    </li>  
                                    <ul class="sub-menu collapse" id="setting">
                                    <li><a href="{{route('detallado')}}"> Detallado </a></li>
                                    <li><a href="{{route('resumido')}}"> Resumido </a></li>
                                    </ul>
                    
                                    <li>
                                    <a href="{{ route('creditos') }}">
                                    <i class="fa fa-money" aria-hidden="true"></i> Creditos
                                    </a>
                                    </li>
                    
                                    <li>
                                    <a href="{{route('employees')}}">
                                    <i class="fa fa-users fa-lg"></i> Empleados
                                    </a>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-sm-7 mainContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <p align="center">SNG &copy; Todos los derechos reservados.</p>                
            </div>
        </div>        
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <p align="center">2010 - 2017</p>                                
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bower_components/tether/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script>
        switch ('{{\Request::route()->getName()}}') {
            case 'employees':
                    $('#menu-content li:contains("Empleados")').addClass('active');
                break;
            case 'index':
                    $('#menu-content li:contains("Dashboard")').addClass('active');
                break;
            case 'index':
                    $('#menu-content li:contains("Estados de Cuenta")').addClass('active');
                break;
            case 'creditos':
                    $('#menu-content li:contains("Creditos")').addClass('active');
                break;
            case 'dividendos':
                    $('#menu-content li:contains("Detalle de Dividendos")').parent().prev().addClass('active');            
                    $('#menu-content li:contains("Detalle de Dividendos")').addClass('active');
                break;
            case 'captura-planilla':
                    $('#menu-content li:contains("Captura de Planilla")').parent().prev().addClass('active');
                    $('#menu-content li:contains("Captura de Planilla")').addClass('active');
                break;
            case 'reporte-prestamos':
                $('#menu-content li:contains("Reporte de Prestamos")').parent().prev().addClass('active');
                    $('#menu-content li:contains("Reporte de Prestamos")').addClass('active');
            break;
            case 'acumulados':
                $('#menu-content li:contains("Reporte de Acumulados")').parent().prev().addClass('active');
                    $('#menu-content li:contains("Reporte de Acumulados")').addClass('active');
            break;
            case 'detallado':
                    $('#menu-content li:contains("Detallado")').parent().prev().addClass('active');
                    $('#menu-content li:contains("Detallado")').addClass('active');
                break;
            case 'resumido':
                    $('#menu-content li:contains("Resumido")').parent().prev().addClass('active');
                    $('#menu-content li:contains("Resumido")').addClass('active');
                break;
        }
    </script>
    @stack('script')
</body>
</html>
