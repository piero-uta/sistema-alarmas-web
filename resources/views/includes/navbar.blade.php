{{-- <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    @if (auth()->user() != null)
        <span class="fs-4">{{auth()->user()->nombre}}</span>
    @endif

</a>
<hr> --}}
@if (session('comunidad_id'))
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html"> --}}
        {{-- regresar vista main-dashboard.blade.php --}}
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <img  width="50" src="/images/logo_sistema_de_alarma.png" alt="IMG" style="background-color:aliceblue">

            <div class="sidebar-brand-text mx-3">Sistema de Alarmas</div>
        </a>

        @php
            $permisos = session('permisos');
        @endphp

        <!-- Nav Item - Comunidades -->
        @if (in_array('Comunidad-c', $permisos) ||
                in_array('Comunidad-r', $permisos) ||
                in_array('Comunidad-u', $permisos) ||
                in_array('Comunidad-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="/comunidades">
                    <i class="fas fa-building"></i>
                    <span>Comunidades</span></a>
            </li>
        @endif

        <!-- Nav Item - Usuarios -->
        @if (in_array('Usuarios-c', $permisos) ||
                in_array('Usuarios-r', $permisos) ||
                in_array('Usuarios-u', $permisos) ||
                in_array('Usuarios-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="/usuarios">
                    <i class="far fa-user"></i>
                    <span>Usuarios</span></a>
            </li>
        @endif


        <!-- Nav Item - Direcciones -->
        @if (in_array('DireccionesUsuario-c', $permisos) ||
                in_array('DireccionesUsuario-r', $permisos) ||
                in_array('DireccionesUsuario-u', $permisos) ||
                in_array('DireccionesUsuario-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="/direcciones">
                    <i class="fas fa-address-book"></i>
                    <span>Direcciones</span></a>
            </li>
        @endif

        @if (in_array('RedAviso-c', $permisos) ||
                in_array('RedAviso-r', $permisos) ||
                in_array('RedAviso-u', $permisos) ||
                in_array('RedAviso-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Red de Avisos -->
            <li class="nav-item active">
                <a class="nav-link" href="/red-avisos">
                    <i class="fas fa-bell"></i>
                    <span>Red de Avisos</span></a>
            </li>
        @endif

        @if (in_array('DashboardMonitoreo-c', $permisos) ||
                in_array('DashboardMonitoreo-r', $permisos) ||
                in_array('DashboardMonitoreo-u', $permisos) ||
                in_array('DashboardMonitoreo-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Red de Avisos -->
            <li class="nav-item active">
                <a class="nav-link" href="/monitoreo">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Dashboard de Monitoreo</span></a>
            </li>
        @endif

        @if (in_array('AsignacionPerfiles-c', $permisos) ||
                in_array('AsignacionPerfiles-r', $permisos) ||
                in_array('AsignacionPerfiles-u', $permisos) ||
                in_array('AsignacionPerfiles-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Red de Avisos -->
            <li class="nav-item active">
                <a class="nav-link" href="/asignacionPerfiles">
                    <i class="fas fa-unlock-alt"></i>
                    <span>Asignacion de Perfiles</span></a>
            </li>
        @endif

        @if (in_array('Perfiles-c', $permisos) ||
                in_array('Perfiles-r', $permisos) ||
                in_array('Perfiles-u', $permisos) ||
                in_array('Perfiles-d', $permisos))
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Red de Avisos -->
            <li class="nav-item active">
                <a class="nav-link" href="/perfiles">
                    <i class="fas fa-users"></i>
                    <span>Perfiles</span></a>
            </li>
        @endif

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


        {{-- <li>
            <a href="/comunidades/ver" class="nav-link">
                Comunidad seleccionada: {{ session('comunidad_id') }}
            </a>
        </li>
        <li>
            <a href="/direcciones" class="nav-link">
                Direcciones
            </a>
        </li>
        <li>
            <a href="/red-avisos" class="nav-link">
                Red de aviso
            </a>
        </li>

        <li>
            <a href="/logout" class="nav-link">
                Cerrar sesión
            </a>
        </li> --}}
    </ul>
@endif
