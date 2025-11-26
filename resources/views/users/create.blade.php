@extends('layouts.master.default')
@section('page-title', 'Cadastrar usuário')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('user.store') }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-6">
                    <label for="name" class="form-label mb-1">Nome <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nome completo"
                    />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label mb-1">E-mail <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="E-mail"
                    />
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="role" class="form-label">Papel <span class="text-danger">*</span></label>
                    <select name="role"
                            class="form-select @error('role') is-invalid @enderror">
                        <option value="">Selecione</option>
                        @foreach($roles as $role)
                            @if($role != "Super Admin")
                                <option
                                    {{ old('role') == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
                            @else
                                @if(auth()->user()->hasRole("Super Admin"))
                                    <option
                                        {{ old('role') == $role ? 'selected' : '' }} value="{{ $role }}">{{ $role }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="password" class="form-label">Senha <span class="text-danger">*</span></label>
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" placeholder="Senha">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="password_confirmation" class="form-label">Confirmar senha <span
                            class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation"
                           class="form-control"
                           placeholder="Confirmar senha">
                </div>
                <div class="d-flex justify-content-between">
                    <p class="form-text text-muted">
                        <span class="text-danger">*</span> Campos obrigatórios
                    </p>
                    <div class="d-flex  justify-content-end mt-3">
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
