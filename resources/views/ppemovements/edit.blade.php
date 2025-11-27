@extends('layouts.master.default')
@section('page-title','Editar movimentação de EPI')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('ppe-movements.update', ['ppeMovement' => $ppeMovement->id])}}" method="POST"
                  class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-2">
                    <label for="date" class="form-label">Data <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                        <input type="text"
                               name="date"
                               class="form-control datepicker @error('date') is-invalid @enderror"
                               value="{{ old('date', \Carbon\Carbon::createFromFormat('Y-m-d', $ppeMovement->date)->format('d/m/Y')) }}"
                               placeholder="dd/mm/aaaa"
                        />
                    </div>
                    @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-5">
                    <label for="employee_id" class="form-label">Colaborador <span class="text-danger">*</span></label>
                    <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
                        <option value="">Selecione o colaborador</option>
                        @foreach($employees as $employee)
                            <option
                                {{ old('employee_id', $ppeMovement->employee_id) == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">{{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-5">
                    <label for="ppe_id" class="form-label">EPI <span class="text-danger">*</span></label>
                    <select name="ppe_id" class="form-select @error('ppe_id') is-invalid @enderror">
                        <option value="">Selecione o EPI</option>
                        @foreach($ppes as $ppe)
                            <option
                                {{ old('ppe_id', $ppeMovement->ppe_id) == $ppe->id ? 'selected' : '' }} value="{{ $ppe->id }}">{{ $ppe->name }}</option>
                        @endforeach
                    </select>
                    @error('ppe_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="size" class="form-label">Tamanho</label>
                    <input type="text"
                           name="size"
                           class="form-control @error('size') is-invalid @enderror"
                           value="{{ old('size', $ppeMovement->size) }}"
                           placeholder="P, M, G, 40, 41"
                    />
                    @error('size')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="quantity" class="form-label">Quantidade
                        <spa class="text-danger">*</spa>
                    </label>
                    <input type="text"
                           name="quantity"
                           class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity', $ppeMovement->quantity) }}"
                           placeholder="Quantidade"
                    />
                    @error('quantity')
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
