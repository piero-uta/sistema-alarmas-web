@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-2">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-xl-6 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Descubre Cómo Funciona el Sistema de Alarma Comunitaria</h1>
                    <p class="lead fw-normal text-white-50 mb-4">
                        Explora los Detalles y Características que Hacen que Nuestro Sistema de Alarma sea Efectivo y Seguro para tu Comunidad.
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 d-none d-xl-block text-center">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen1.png') }}"  alt="..." />
            
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen2.png') }}" alt="..." />
            
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen3.png') }}" alt="..." />
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen4.png') }}" alt="..." />
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen5.png') }}" alt="..." />
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen6.png') }}" alt="..." />
                      </div>
                      <div class="carousel-item">
                        <img class="img-fluid rounded-3 my-5" src="{{ asset('images/main-dashboard-carousel/imagen7.png') }}" alt="..." />
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Siguiente</span>
                    </a>
                  </div>
                </div>
        </div>
    </div>
</header>
<!-- Features section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">Una forma simple de proteger tu comunidad.</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100" >
                    <i class="fas fa-user fa-lg mb-0 text-white  " style="padding: 10px; border-radius: 0.25rem; background: #509fd8;"></i>
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3 "><i class="bi bi-building"></i></div>
                        <h2 class="h5">Usuarios</h2>
                        <p class="mb-0">Gestiona las cuentas para los vecinos de tu comunidad. Asigna sus perfiles y direcciones.</p>
                    </div>
                    <div class="col mb-5 h-100">
                        <i class="fas fa-address-book fa-lg mb-0 text-white " style="padding: 10px; border-radius: 0.25rem; background: #509fd8;"></i>
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                        <h2 class="h5">Direcciones</h2>
                        <p class="mb-0">Gestiona las direcciones para tu comunidad, selecciona un punto en el mapa para especificar la ubicación.</p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <i class="fas fa-bell fa-lg mb-0 text-white" style="padding: 10px; border-radius: 0.25rem; background: #509fd8;"></i>
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                        <h2 class="h5">Red de avisos</h2>
                        <p class="mb-4">Indica como cada dirección se comunica con las otras direcciones de sus vecinos.</p>
                    </div>
                        <div class="col mb-5 mb-md-0 h-100">  
                        <i class="fas fa-map-marker-alt fa-lg mb-0 text-white" style="padding: 10px; border-radius: 0.25rem; background: #509fd8;"></i>
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                        <h2 class="h5">Dashboard de monitoreo</h2>
                        <p class="mb-4">Monitorea el mapa de tu comunidad en tiempo real para lograr visualizar la creación de nuevas alarmas y chequea estas para indicar que los vecinos ya se encuentran seguros.</p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <i class="fas fa-users fa-lg mb-0 text-white" style="padding: 10px; border-radius: 0.25rem; margin-bottom: 0.5rem; background: #509fd8;"></i>
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                        <h2 class="h5">Perfiles</h2>
                        <p class="mb-0">Crea perfiles nuevos para los usuarios de tu comunidad.</p>
                    </div>
                    <div class="col h-100">
                    <i class="fas fa-unlock-alt fa-lg mb-0 text-white" style="padding: 10px; border-radius: 0.25rem; margin-bottom: 0.5rem; background: #509fd8;"></i>
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                        <h2 class="h5">Asignación de perfiles</h2>
                        <p class="mb-0">Asigna permisos para los perfiles de tu comunidad y maneja las limitaciones de tus vecinos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection