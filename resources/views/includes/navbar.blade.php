<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    @if ( auth()->user()!= null )
        <span class="fs-4">{{auth()->user()->nombre}}</span>        
    @endif
    
</a>
<hr>
<ul class="nav nav-pills flex-column mb-auto">
    <li>
        <a href="/comunidades" class="nav-link">
            Comunidades
        </a>
        <a href="/usuarios" class="nav-link active">
            Usuarios
        </a>
    </li>

</ul>
</div>