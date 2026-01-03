@extends('layouts.auth.auth-default')
@section('body-class', 'login-page')
@section('content')
    <div class="login-box">

        <div class="card">
            <div class="card-body login-card-body rounded-3 shadow-sm pt-2">

                <div class="login-logo mb-0 mt-1">
                    <a href="{{ route('login') }}"><b>Logster</b></a>
                </div>
                <p class="login-box-msg pt-2">Bem-vindo(a)</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="E-mail" value="{{ old('email') }}"/>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" placeholder="Senha"/>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <small>
                        <p class="mb-1">
                            <a href="{{ route('password.request') }}"
                               class="text-decoration-none">Esqueceu sua senha?
                            </a>
                        </p>
                    </small>
                    <small>
                        <p class="mb-0">
                            Não tem uma conta?
                            <a href="{{ route('register') }}" class="text-center text-decoration-none">Inscreva-se</a>
                        </p>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
