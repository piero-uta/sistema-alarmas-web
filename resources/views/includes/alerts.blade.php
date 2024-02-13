
<!-- TO DO: cambiar esto, creo que deberia esta en el sass -->
<style>
    .bg-alerta-danger {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        padding: 10px;
        margin-bottom: 10px;
    }
    .bg-alerta-success{
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px;
        margin-bottom: 10px;    
    }
</style>

@if (count($errors) > 0)
    <div class="bg-alerta-danger" >
        Se han encontrado algunos errores:
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="bg-alerta-danger">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="bg-alerta-success">
        {{ session('success') }}
    </div>
@endif
