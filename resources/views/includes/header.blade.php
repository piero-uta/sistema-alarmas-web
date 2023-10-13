<header class="header @auth header--auth @endauth">

    <div class="header__section">
        <!-- Menú hamborquesa aquí -->
        <button class="hamburguer__button">
            <i class="fas fa-bars"> </i>                
        </button>
        
    </div>
    <div class="header__section header__section--left" >
        <!-- Logo de la Empresa -->
        <img class="header__logo" src="{{ asset('img/logoEmpresa.png') }}"  alt="Logo">
        <!-- Nombre de la Empresa (Esquina Izquierda) -->
        <h1 class="company-name">Digital Social Change SPA</h1>
    </div>
    <div class="header__section header__section--right">
        <!-- Nombre del Software (Esquina Derecha) -->
        <h1 class="software-name">Alarma Comunitaria</h1>
    </div>

</header>