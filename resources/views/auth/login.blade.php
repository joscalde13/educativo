@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="d-inline-block bg-primary rounded-circle p-3 mb-2">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </span>
                    <h3 class="mb-0 font-weight-bold">Iniciar Sesión</h3>
                </div>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="form-group mb-4">
                        <label for="email">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    <div class="form-group mb-4">
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg font-weight-bold mb-3">
                        <i class="fas fa-sign-in-alt mr-2"></i> Ingresar
                                </button>
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="small">¿No tienes una cuenta? <b>Regístrate</b></a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection 