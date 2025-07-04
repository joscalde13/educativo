<!DOCTYPE html>
<html lang="es">
<head>
    <!-- CONFIGURACIÓN BÁSICA DEL DOCUMENTO -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Niveles Y Materias</title>

    <!-- TOKEN DE SEGURIDAD PARA PETICIONES AJAX Y FORMULARIOS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PUNTO PARA INYECTAR SCRIPTS DESDE OTRAS VISTAS -->
    @stack('scripts')

    <!-- ICONOS DE FONT AWESOME -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">

    <!-- ESTILOS DE ADMINLTE (PLANTILLA DE ADMINISTRACIÓN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <!-- CONTENEDOR GENERAL DE LA APLICACIÓN -->
    <div class="wrapper">

        <!-- BARRA SUPERIOR DE NAVEGACIÓN -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- BOTÓN PARA ABRIR/CERRAR SIDEBAR -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- USUARIO AUTENTICADO O INVITADO -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <!-- ENLACE PARA INICIAR SESIÓN SI NO ESTÁ LOGUEADO -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                @else
                    <!-- MENÚ DE USUARIO CON NOMBRE Y OPCIÓN DE CERRAR SESIÓN -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user mr-1"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <!-- CERRAR SESIÓN -->
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>
                            <!-- FORMULARIO OCULTO PARA LOGOUT -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>

        <!-- BARRA LATERAL IZQUIERDA (SIDEBAR) -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- TEXTO DEL MENÚ -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Administración</span>
            </a>

            <!-- MENÚ DE OPCIONES DEL SIDEBAR -->
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                        <!-- OPCIÓN: DASHBOARD -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- OPCIONES SOLO PARA ADMINISTRADOR -->
                        @if(Auth::check() && Auth::user()->role === 'admin')

                            <!-- OPCIÓN: MATERIAS -->
                            <li class="nav-item">
                                <a href="{{ route('admin.subjects.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Materias</p>
                                </a>
                            </li>

                            <!-- OPCIÓN: NIVELES -->
                            <li class="nav-item">
                                <a href="{{ route('admin.levels.index') }}"
                                   class="nav-link {{ request()->routeIs('admin.levels.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>Niveles</p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <!-- AQUÍ SE RENDERIZA EL CONTENIDO DE CADA VISTA -->
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- PIE DE PÁGINA -->
        <footer class="main-footer text-center">
            <strong>&copy; 2025 Proyecto Educativo.</strong> Todos los derechos reservados.
        </footer>
    </div>

    <!-- SCRIPTS DE FUNCIONAMIENTO (JQUERY, BOOTSTRAP, ADMINLTE) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    
</body>
</html>
