<div class="hamburguer__menu">

    <!-- Opciones -->
    <ul class="hamburguer__list">
        

        {{-- Home --}}
        <li class="hamburguer__item">
            <a href="{{route('usuarios.index')}}" class="hamburguer__item-link" title="Usuarios"><i class="hamburguer__item-icon fa-solid fa-user"></i>Usuarios</a>
        </li>

            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('direcciones.index')}}" title="Direcciones"><i class="hamburguer__item-icon fas fa-home"></i>Direcciones</a>
            </li>

            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('perfiles.index')}}" title="Perfiles"><i class="hamburguer__item-icon fas fa-city"></i>Perfiles</a>
            </li>

            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('comunidades.index')}}" title="Comunidades"><i class="hamburguer__item-icon fas fa-user-tag"></i>Comunidades</a>
            </li>

    </ul>
    <!-- footer -->
    <div class="hamburguer__list">
        
        {{-- cerrar sesion --}}
        <div class="hamburguer__item">
            <a href="{{route('logout')}}"    class="hamburguer__item-link"><i class="hamburguer__item-icon fas fa-sign-out-alt"></i>Cerrar sesión</a>
        </div>

    </div>

</div>