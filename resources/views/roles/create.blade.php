@extends('layouts.master.default')
@section('page-title','Cadastrar papel')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{route('role.store')}}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           placeholder="Nome do papel"
                           value="{{old('name')}}"
                           class="form-control @error('name') is-invalid @enderror"
                    />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="guard_name" class="form-label">Guard name</label>
                    <input type="text"
                           name="guard_name"
                           placeholder="web"
                           class="form-control @error('guard_name') is-invalid @enderror"
                           disabled
                    />
                </div>


                <div class="d-flex justify-content-between">
                    <p class="form-text text-muted">
                        <span class="text-danger">*</span> Campos obrigatórios
                    </p>
                    <div class="d-flex  justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">Adicionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
