@extends('layouts.app')
@section('title', 'Login')

@section('content')

<form method="POST" action="{{route('loginAdmin.handleLoginAdmin')}}">
    @csrf
    <h2>Iniciar Sesión</h2>
    <div class="mb-3">
        <label for="email" class="form-label">Email*</label>
        <input type="email" class="form-control" name="email" required
        value="{{ old('email')}}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password*</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="mb-3">
        <div class="form-check ">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" @checked(old('remember'))>
            <label class="form-check-label" for="remember">Recordarme</label>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    
</form>

@endsection
