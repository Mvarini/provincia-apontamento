@extends('layouts.master.default')
@section('page-title','Apontamentos')
@section('page-actions')
    @can('task.create')
        <a href="{{ route('task.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
    @endcan
@endsection
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">

            <div class="mb-4">
                <form action="{{ route('task.index') }}" method="get" class="row g-3">
                    @csrf
                    <div class="col-md-2">
                        <input type="text"
                               name="batch_number"
                               id="batch_number"
                               placeholder="Nº do lote"
                               value="{{ $batch_number }}"
                               class="form-control"
                        />
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="text"
                                   class="form-control datepicker"
                                   name="date"
                                   id="date"
                                   placeholder="Data do apontamento"
                                   value="{{ $date }}"
                            />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                Ações
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <button class="dropdown-item" type="submit">Pesquisar</button>
                                </li>
                                <li>
                                    <a href="{{ route('task.index') }}" class="dropdown-item" type="button">Limpar</a>
                                </li>
                                @can('task.report-task')
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a href="{{ url('tasks/report?' . request()->getQueryString()) }}"
                                           class="dropdown-item">Download relatório</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th>Data</th>
                    <th class="text-center">Lote</th>
                    <th class="text-center">Máquina</th>
                    <th class="text-center d-none d-md-table-cell">Produto</th>
                    <th class="text-center d-none d-md-table-cell">Peças/seg</th>
                    <th class="text-center d-none d-md-table-cell">Qtde realizada</th>
                    <th class="text-center d-none d-md-table-cell">Qtde prevista</th>
                    <th class="text-center d-none d-md-table-cell">% Produtividade</th>
                    <th class="text-center">
                        @if(auth()->user()->can('task.show') || auth()->user()->can('task.edit') || auth()->user()->can('task.destroy') || auth()->user()->can('task-breakdown.index'))
                            Ações
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td class="align-middle">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $task->date)->format('d/m/Y') }}</td>
                        <td class="text-center align-middle">{{ $task->batch_number }}</td>
                        <td class="text-center align-middle">{{ $task->machine->name }} </td>
                        <td class="text-center align-middle d-none d-md-table-cell">{{ $task->product?->name }}</td>
                        <td class="text-center d-none d-md-table-cell align-middle">{{ $task->piece_second }}</td>
                        <td class="text-center d-none d-md-table-cell align-middle number">{{ $task->amount_carried }}</td>
                        <td class="text-center d-none d-md-table-cell align-middle number">{{ $task->expected_quantity }}</td>
                        <td class="text-center d-none d-md-table-cell align-middle">
                            @if($task->productivity)
                                {{ $task->productivity }}%
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if(auth()->user()->can('task.show') || auth()->user()->can('task.edit') || auth()->user()->can('task.destroy') || auth()->user()->can('task-breakdown.index'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('task.show')
                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                   data-bs-target="#formShow{{ $task->id }}" href="#">Visualizar</a>
                                            </li>
                                        @endcan
                                        @can('task.edit')
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('task.edit', $task->id) }}">Editar</a>
                                            </li>
                                        @endcan

                                        @can('task.destroy')
                                            <li>
                                                <form id="formDelete{{ $task->id }}"
                                                      action="{{ route('task.destroy', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $task->id }}"
                                                            type="submit">Excluir
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        @can('task-breakdown.index')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('task-breakdown.index', $task->id) }}">Parada</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
                @empty
                    <tr>
                        <td colspan="14">
                            <div class="alert alert-info mb-0" role="alert">
                                Nenhum Apontamento encontrado.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </table>
            <div class="mt-3">
                {{ $tasks->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    @include('tasks.modal.modal-show')
@endsection
