@extends('layouts.auth.auth-default')
@section('body-class', 'login-page')
@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body rounded-3 shadow-sm">

                <div class="login-logo">
                    <a href="#"><b>Logster</b></a>
                </div>
                <p class="login-box-msg">Recuperar senha</p>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
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

                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Enviar link de recuperação</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-3 text-center">
                    <p class="mb-0">
                        <small><a href="{{ route('login') }}" class="text-center text-decoration-none">Voltar ao
                                login</a></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

