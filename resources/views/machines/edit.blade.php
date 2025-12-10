@extends('layouts.master.default')
@section('page-title', 'Editar máquina')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('machine.update', $machine->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-12">
                    <label for="name" class="form-label">Máquina <span class="text-danger">*</span></label>
                    <input type="text"
                           name="name"
                           placeholder="Nome da máquina"
                           value="{{ old('name', $machine->name) }}"
                           class="form-control @error('name') is-invalid @enderror"
                    />
                    @error('name')
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
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm">Atualizar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
