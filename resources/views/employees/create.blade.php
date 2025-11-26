@extends('layouts.master.default')
@section('page-title', 'Cadastrar colaborador')
@section('content')
    <div class="card">
        <dvi class="card-body shadow-sm">
            <form action="{{ route('employee.store') }}" method="POST" class="row g-3">
                @csrf
                @method('POST')

                <div class="col-md-5">
                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           placeholder="Nome"
                           value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror"
                    />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="job_title" class="form-label">Função <span class="text-danger">*</span></label>
                    <input type="text"
                           name="job_title"
                           placeholder="Função"
                           value="{{ old('job_title') }}"
                           class="form-control @error('job_title') is-invalid @enderror"
                    />
                    @error('job_title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="department" class="form-label">Setor <span class="text-danger">*</span></label>
                    <input type="text"
                           name="department"
                           placeholder="Setor"
                           value="{{ old('department') }}"
                           class="form-control @error('department') is-invalid @enderror"
                    />
                    @error('department')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
        </dvi>
    </div>
@endsection
