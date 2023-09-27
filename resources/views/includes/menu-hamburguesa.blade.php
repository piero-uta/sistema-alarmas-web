<div class="hamburguer__menu">

    <!-- Opciones -->
    <ul class="hamburguer__list">
        

        {{-- Home --}}
        <li class="hamburguer__item">
            <a href="{{route('usuarios.index')}}" class="hamburguer__item-link" title="Usuarios"><i class="hamburguer__item-icon fas fa-home"></i>usuarios</a>
        </li>

  
            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('direcciones.index')}}" title="Direcciones"><i class="hamburguer__item-icon fa fa-city"></i>direcciones</a>
            </li>
 

            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('perfiles.index')}}" title="Perfiles"><i class="hamburguer__item-icon fas fa-building"></i>perfiles</a>
            </li>

            <li class="hamburguer__item">
                <a class="hamburguer__item-link" href="{{route('comunidades.index')}}" title="Comunidades"><i class="hamburguer__item-icon fas fa-user-tag"></i>comunidades</a>
            </li>

</div>