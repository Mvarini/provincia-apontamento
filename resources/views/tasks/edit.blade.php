@extends('layouts.master.default')
@section('page-title','Editar apontamento')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('task.update', $task->id) }}" method="POST" class="row g-3">
                @csrf
                @method('PUT')

                <div class="col-md-2">
                    <label for="date" class="form-label">Data <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                        <input type="text"
                               name="date"
                               value="{{ old('date', \Carbon\Carbon::createFromFormat('Y-m-d', $task->date)->format('d/m/Y')) }}"
                               Placeholder="dd/mm/aaaa"
                               class="form-control datepicker @error('date') is-invalid @enderror"
                        />
                    </div>
                    @error('date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="batch_number" class="form-label">Lote <span class="text-danger">*</span></label>
                    <input type="text"
                           name="batch_number"
                           class="form-control @error('batch_number') is-invalid @enderror"
                           placeholder="Nº do lote"
                           value="{{ old('batch_number', $task->batch_number) }}"
                    />
                    @error('batch_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="machine_id" class="form-label">Máquina <span class="text-danger">*</span></label>
                    <select name="machine_id" class="form-select @error('machine_id') is-invalid @enderror">
                        <option value="">Selecione a máquina</option>
                        @foreach($machines as $machine)
                            <option
                                {{ old('machine_id', $task->machine_id) == $machine->id ? "selected" : "" }} value="{{ $machine->id }}">{{ $machine->name }}</option>
                        @endforeach
                    </select>
                    @error('machine_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="product_id" class="form-label">Produto <span class="text-danger">*</span></label>
                    <select name="product_id" class="form-select @error('product_id') is-invalid @enderror">
                        <option value="">Selecione o produto</option>
                        @foreach($products as $product)
                            <option
                                {{ old('product_id', $task->product_id) == $product->id ? "selected" : "" }} value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="employee_id" class="form-label">Colaborador <span class="text-danger">*</span></label>
                    <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
                        <option value="">Selecione o colaborador</option>
                        @foreach($employees as $employee)
                            <option
                                {{ old('employee_id', $task->employee_id) == $employee->id ? "selected" : "" }} value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="production_minute" class="form-label">Produção <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="production_minute"
                           class="form-control @error('production_minute') is-invalid @enderror"
                           placeholder="Tempo em minuto"
                           value="{{ old('production_minute', $task->production_minute) }}"
                    />
                    @error('production_minute')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="piece_second" class="form-label">Peças <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="piece_second"
                           class="form-control @error('piece_second') is-invalid @enderror"
                           value="{{ old('piece_second', $task->piece_second) }}"
                           placeholder="Qtde por segundo"
                    />
                    @error('piece_second')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="amount_carried" class="form-label">Realizada <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="amount_carried"
                           class="form-control @error('amount_carried') is-invalid @enderror"
                           placeholder="Qtde total de peça"
                           value="{{ old('amount_carried', $task->amount_carried) }}"
                    />
                    @error('amount_carried')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="script_time" class="form-label">Tempo de roteiro <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="script_time"
                           class="form-control second @error('script_time') is-invalid @enderror"
                           placeholder="Segundo/peça"
                           value="{{ old('script_time', $task->script_time) }}"
                    />
                    @error('script_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="real_time" class="form-label">Tempo real <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="real_time"
                           class="form-control second @error('real_time') is-invalid @enderror"
                           placeholder="Segundo/peça"
                           value="{{ old('real_time', $task->real_time) }}"
                    />
                    @error('real_time')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="discard_quantity" class="form-label">Descarte <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="discard_quantity"
                           class="form-control @error('discard_quantity') is-invalid @enderror"
                           placeholder="Material danificado"
                           value="{{ old('discard_quantity', $task->discard_quantity) }}"
                    />
                    @error('discard_quantity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="missing_quantity" class="form-label">Finalizar lote <span
                            class="text-danger">*</span></label>
                    <input type="text"
                           name="missing_quantity"
                           class="form-control @error('missing_quantity') is-invalid @enderror"
                           placeholder="Quantidade"
                           value="{{ old('missing_quantity', $task->missing_quantity) }}"
                    />
                    @error('missing_quantity')
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
