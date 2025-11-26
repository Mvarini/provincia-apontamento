@extends('layouts.master.default')
@section('page-title','Cadastrar parada')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('task-breakdown.store', $task->id) }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}"/>

                <div class="col-md-6">
                    <label for="machine_breakdown_id" class="form-label">Parada <span class="text-danger">*</span>
                    </label>
                    <select name="machine_breakdown_id"
                            class="form-select @error('machine_breakdown_id') is-invalid @enderror">
                        <option value="">Selecione uma parada</option>
                        @foreach($machineBreakdowns as $machineBreakdown)
                            <option
                                {{ old('machine_breakdown_id') == $machineBreakdown->id ? "selected" : "" }} value="{{ $machineBreakdown->id }}">{{ $machineBreakdown->name }}</option>
                        @endforeach
                    </select>
                    @error('machine_breakdown_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="duration" class="form-label">Duração <span class="text-danger">*</span></label>
                    <input type="text"
                           name="duration"
                           class="form-control @error('duration') is-invalid @enderror"
                           placeholder="Minutos"
                           value="{{ old('duration') }}">
                    @error('duration')
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
