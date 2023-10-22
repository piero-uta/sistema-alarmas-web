<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de alarma comunitaria - @yield('title')</title>
    
    
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
  
    {{-- Scripts --}}
    @stack('head-scripts')
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @if(session('comunidad_id'))
            @include('includes.navbar')
        @endif
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('includes.topbar')
                @if(session('comunidad_id'))
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                @else
                    <div class="container-fluid">
                        <h2>Debe seleccionar una comunidad</h2>
                    </div>
                @endif

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('includes.footer') --}}
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    {{-- del esteban --}}
     <!-- Header -->
    {{-- @include('includes.header')
    @include('includes.menu-hamburguesa')     --}}
    
    {{-- @yield('body')
    <div class="container py-5">
        @yield('content')


        </div>
    </div>
    <script src="{{ asset('js/buttons.js') }}"></script>
    
    @include('includes.footer')  --}}
    @yield('scripts')
    @stack('scripts')
    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>


    
</body>
</html>