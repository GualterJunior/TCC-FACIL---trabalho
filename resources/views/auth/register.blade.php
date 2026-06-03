@extends('layouts.guest')

@section('title', 'Cadastro - TCC Facil')

@section('content')
<div class="container">
    <div class="card auth-card shadow-sm mx-auto">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <img src="{{ asset('images/logo-tcc-facil.png') }}" alt="TCC Facil" style="height: 82px; width: auto; max-width: 100%;">
                </a>
                <p class="text-secondary mb-0 mt-2">Crie sua conta para acessar o sistema.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Nome</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="alert alert-info">
                    O cadastro público é exclusivo para alunos. Professores e coordenadores devem ser criados pela coordenação.
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Senha</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password_confirmation">Confirmar senha</label>
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button class="btn btn-primary w-100" type="submit">Cadastrar</button>
            </form>

            <div class="text-center mt-3">
                <span class="text-secondary">Ja tem conta?</span>
                <a href="{{ route('login') }}">Entrar</a>
            </div>
        </div>
    </div>
</div>
@endsection
