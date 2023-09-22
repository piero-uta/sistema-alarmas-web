@extends('layouts.app')
@section('title', 'Login')

@section('content')
<main class="auth bg-isometrico">

<form method="POST" class="form auth__form-container pop-anim show" action="{{route('login.handleLogin')}}">
    @csrf
    <h2 class="login-page-new__main-form-title">Iniciar Sesión</h2>
    <div >
        <label for="email" class="label">Email*</label>
        <input type="email" class="input" name="email" required
        value="{{ old('email')}}">
    </div>
    <div >
        <label for="password" class="label">Password*</label>
        <input type="password" class="input" name="password" required>
    </div>
    <div class="form__container-flex mb-5">
        <div class="form-check form-switch d-flex" ">
            <input class="form-check-input" type="checkbox" id="remember" name="remember" @checked(old('remember'))>
            <label class="form-check-label" for="remember">Recordarme</label>
        </div>

    </div>
    <div class="d-grid gap-2 py-2">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <bu
    </div>
</form>
</main>
@endsection