@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Iniciar Sesión') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="d-flex flex-column align-items-center">
                        @csrf

                        <div class="row mb-4 w-100" style="max-width: 500px;">
                            <label for="email" class="col-md-4 col-form-label">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 w-100" style="max-width: 500px;">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Contraseña') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 w-100" style="max-width: 500px;">
                            <div class="col-md-8 offset-md-4">
                               
                            </div>
                        </div>

                        <div class="row mb-4 w-100" style="max-width: 500px;">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary px-4">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </div>
                        </div>

                        <div class="row w-100" style="max-width: 500px;">
                            <div class="col-12 text-center">
                                <a href="{{ route('register') }}" class="btn btn-link">
                                    {{ __('¿No tienes una cuenta? Regístrate') }}
                                </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 