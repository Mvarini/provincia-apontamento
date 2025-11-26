@extends('layouts.master.default')
@section('page-title', 'Cadastrar produto')
@section('content')
    <div class="card">
        <dvi class="card-body shadow-sm">
            <form action="{{ route('product.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="col-md-6">
                    <label for="product" class="form-label">Produto <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           placeholder="Nome do produto"
                           value="{{ old('product') }}"
                           class="form-control @error('name') is-invalid @enderror"
                    />
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cadtec" class="form-label">Caderno técnico</label>
                    <input type="file"
                           name="cadtec"
                           class="form-control @error('cadtec') is-invalid @enderror">
                    @error('cadtec')
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
