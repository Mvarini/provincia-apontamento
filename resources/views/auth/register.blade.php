@extends('layouts.auth.auth-default')

@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="../index2.html"><b><strong>Logster</strong></b></a>
        </div>
        <div class="card">
            <div class="card-body register-card-body rounded-3 shadow-sm">
                <p class="register-box-msg">Cadastrar um novo membro</p>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-person"></span></div>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nome completo" value="{{ old('name') }}" />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ old('email') }}"/>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha" />
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a senha" />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <p class="mb-0 mt-4 text-center">
                    <a href="login.html" class="text-center text-decoration-none"> Voltar ao login </a>
                </p>
            </div>
        </div>
    </div>
@endsection
