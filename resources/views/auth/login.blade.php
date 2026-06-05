@extends('layouts.guest')

@section('title', 'Login - TCC Fácil')

@section('content')
<div class="container">
    <div class="card auth-card shadow-sm mx-auto">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <img src="{{ asset('images/logo-tcc-facil.png') }}" alt="TCC Fácil" style="height: 82px; width: auto; max-width: 100%;">
                </a>
                <p class="text-secondary mb-0 mt-2">Entre para acessar a area administrativa.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Senha</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" id="remember" type="checkbox" name="remember">
                    <label class="form-check-label" for="remember">Manter conectado</label>
                </div>

                <button class="btn btn-primary w-100" type="submit">Entrar</button>
            </form>

            <div class="text-center mt-3">
                <span class="text-secondary">Ainda não tem conta?</span>
                <a href="{{ route('register') }}">Cadastre-se</a>
            </div>
        </div>
    </div>
</div>
@endsection
