<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modulo bancos</title>

    <link rel="stylesheet" href="{{ url('') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ url('') }}/dist/css/adminlte.min.css">
    @stack('styles')
    <style>
        html { font-size: 14px; }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary">
            <a href="index3.html" class="brand-link">
                <img src="{{ url('') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
                <span class="brand-text">Logo</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/" class="nav-link" id="dashboard-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item" id="bancos-submenu">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>
                                    Bancos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/bancos" class="nav-link" id="bancos-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Bancos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/cuentas-bancarias" class="nav-link" id="cuentas-bancarias-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cuentas bancarias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/chequeras" class="nav-link" id="chequeras-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Chequeras</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/cheques" class="nav-link" id="cheques-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Emision de cheques</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transacciones" class="nav-link" id="transacciones-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transacciones</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/movimientos-bancarios" class="nav-link" id="movimientos-bancarios-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Movimientos bancarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/conciliaciones-bancarias" class="nav-link" id="conciliaciones-bancarias-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Conciliaciones bancarias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            @yield('main-content')

        </div>

    </div>

    <script src="{{ url('') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/dist/js/adminlte.min.js"></script>
    @stack('scripts')
</body>

</html>