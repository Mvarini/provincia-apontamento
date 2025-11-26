@extends('layouts.master.default')
@section('page-title','Cadastrar EPI')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{route('ppe.store')}}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{old('name')}}"
                        placeholder="Nome do EPI"
                    />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="ca" class="form-label">CA</label>
                    <input
                        type="text"
                        name="ca"
                        class="form-control @error('ca') is-invalid @enderror"
                        value="{{old('ca')}}"
                        placeholder="Certificado de avaliação"
                    />
                    @error('ca')
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
        </div>
    </div>
@endsection
