<!doctype html>
<html lang="pt-br">

<head>
	<title>Controle Estoque v1.0</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	
	<link rel="stylesheet" href="../../vendor/linearicons/style.css">
	
	
</head>

<body>
    <!-- WRAPPER -->
    <div id="app" style="display:none">
        <div id="wrapper">
            <!-- NAVBAR -->
            @guest
            @else
            
            <!-- END NAVBAR -->
            <!-- LEFT SIDEBAR -->
            <div id="sidebar-nav" class="sidebar">
                <div class="sidebar-scroll">
                    <nav>
                            
                        <ul class="nav">
                                <li><a href="#" class=""><h4><span>Controle Estoque v1.0</span></h4></a></li>
                            
                            <li><a href="{{ route('home') }}" class="active"><i class="lnr lnr-home"></i> <span>Inicio</span></a></li>
                            <li><a href="{{ route('categoria') }}" class=""><i class="lnr lnr-tag"></i> <span>Categorias</span></a></li>
                            <li><a href="{{ route('cliente') }}" class=""><i class="lnr lnr-user"></i> <span>Clientes</span></a></li>
                            <li><a href="{{ route('estoque') }}" class=""><i class="lnr lnr-inbox"></i> <span>Estoque</span></a></li>
                            <li><a href="{{ route('historico') }}" class=""><i class="lnr lnr-history"></i> <span>Histórico</span></a></li>          
                            @if(Auth::user()->nivel_acesso == 1)
                            <li><a href="{{ route('user') }}" class=""><i class="lnr lnr-users"></i> <span>Usuários</span></a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            @endguest
            <!-- END LEFT SIDEBAR -->
            <!-- MAIN -->
            <div class="main">
                <!-- MAIN CONTENT -->
                <div class="main-content">
                    
                    <div class="container-fluid">
                            @guest
                            @else
                            <nav class="navbar navbar-default ">
                                    <div class="container-fluid">
                                        <div class="navbar-btn">
                                            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-menu"></i></button>
                                        </div>

                                        <div id="navbar-menu">
                                            <ul class="nav navbar-nav navbar-right">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                                        
                                                        <li>
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                                <i class="lnr lnr-exit"></i>
                                                                Logout
                                                            </a>
                                
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                @endguest
                        @yield('content')
                    </div>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
            <!-- END MAIN -->
            <div class="clearfix"></div>
            <footer>
                <div class="container-fluid">
                    <p class="copyright">&copy; 2018 <a href="#" target="_blank">Ofuji</a>. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
    </div>
	<!-- END WRAPPER -->
	<!-- Javascript -->

	<script src="{{ asset('js/app.js') }}"></script>
	
	<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
       </script>
	
	
</body>

</html>
