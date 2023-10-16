<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    @if ( auth()->user()!= null )
        <span class="fs-4">{{auth()->user()->nombre}}</span>        
    @endif
    
</a>
<hr>
@if(session('comunidad_id'))
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/comunidades" class="nav-link">
                Comunidades
            </a>        
        </li>
        <li>
            {{-- <a href="/usuarios" class="nav-link active"> --}}
                <a href="/usuarios" class="nav-link">
                Usuarios
            </a>
        </li>
        <li>
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
        </li>
    </ul>
@endif
</div>