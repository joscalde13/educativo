@extends('layouts.guest')

@section('title', 'Registrarse')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <span class="d-inline-block bg-success rounded-circle p-3 mb-2">
                        <i class="fas fa-user-plus fa-2x text-white"></i>
                    </span>
                    <h3 class="mb-0 font-weight-bold">Crear Cuenta</h3>
                </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="form-group mb-4">
                        <label for="name">Nombre</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    <div class="form-group mb-4">
                        <label for="email">Correo Electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
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
                    <div class="form-group mb-4">
                        <label for="password-confirm">Confirmar Contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    <button type="submit" class="btn btn-success btn-block btn-lg font-weight-bold mb-3">
                        <i class="fas fa-user-plus mr-2"></i> Registrarse
                                </button>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="small">¿Ya tienes una cuenta? <b>Inicia sesión</b></a>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
