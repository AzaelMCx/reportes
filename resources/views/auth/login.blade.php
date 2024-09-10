@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-lg p-4">
                <div class="text-center mb-4">
                    <h2 class="fw-bold">Iniciar Sesión</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Contraseña -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <!-- Recordarme -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Recordarme
                        </label>
                    </div>

                    <!-- Botón de Inicio de Sesión -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    </div>
                    
                    <!-- Enlace de Registro -->
                    <div class="text-center mt-3">
                        <p class="small">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-decoration-none">Regístrate aquí</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
