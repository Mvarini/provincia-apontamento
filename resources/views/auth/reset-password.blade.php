@extends('layouts.auth.auth-default')

@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b><strong>Logster</strong></b></a>
        </div>
        <div class="card">
            <div class="card-body register-card-body rounded-3 shadow-sm">
                <p class="register-box-msg">Resetar senha</p>
                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" value="{{ request()->email }}"/>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nova senha" />
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme a nova senha" />
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Resetar senha</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
