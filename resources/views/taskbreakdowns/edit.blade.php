@extends('layouts.master.default')
@section('page-title','Editar parada')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('task-breakdown.update', $taskBreakdown->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <input type="hidden" name="task_id" value="{{ $taskBreakdown->task_id }}"/>

                <div class="col-md-6">
                    <label for="machine_breakdown_id" class="form-label">Parada <span class="text-danger">*</span>
                    </label>
                    <select name="machine_breakdown_id"
                            class="form-select @error('machine_breakdown_id') is-invalid @enderror">
                        <option value="">Selecione uma parada</option>
                        @foreach($machineBreakdowns as $machineBreakdown)
                            <option
                                {{ $machineBreakdown->id == $taskBreakdown->machine_breakdown_id ? "selected" : "" }} value="{{ $machineBreakdown->id }}">{{ $machineBreakdown->name }}
                            </option>
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
                           value="{{ old('duration', $taskBreakdown->duration) }}">
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
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
