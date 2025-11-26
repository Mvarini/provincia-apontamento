@extends('layouts.master.default')
@section('page-title','Paradas')
@section('page-actions')
    @can('task-breakdown.create')
        <a href="{{ route('task-breakdown.create', $task->id) }}" class="btn btn-primary btn-sm">Adiconar</a>
    @endcan
@endsection
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th class="text-center">Data Apontamento</th>
                    <th class="text-center">Lote Apontamento</th>
                    <th class="text-center">Parada</th>
                    <th class="text-center">Duração</th>
                    <th class="text-end">
                        @if(auth()->user()->can('task-breakdown.edit') || auth()->user()->can('task-breakdown.destroy'))
                            Ações
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($taskBreakdowns as $taskBreakdown)
                    <tr>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $taskBreakdown->task->date)->format('d/m/Y') }}</td>
                        <td class="text-center align-middle">{{ $taskBreakdown->task->batch_number}}</td>
                        <td class="text-center align-middle">{{ $taskBreakdown->machineBreakdown->name }}</td>
                        <td class="text-center align-middle">{{ $taskBreakdown->duration }} min</td>
                        <td class="text-end align-middle">
                            @if(auth()->user()->can('task-breakdown.edit') || auth()->user()->can('task-breakdown.destroy'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('task-breakdown.edit')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('task-breakdown.edit', $taskBreakdown->id) }}">Editar</a>
                                            </li>
                                        @endcan

                                        @can('task-breakdown.destroy')
                                            <li>
                                                <form id="formDelete{{ $taskBreakdown->id }}"
                                                      action="{{ route('task-breakdown.destroy', $taskBreakdown->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $taskBreakdown->id }}"
                                                            type="submit">Excluir
                                                    </button>
                                                </form>
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
                                Nenhuma ocorrência de parada encontrada.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </table>
            <div class="mt-3">
                {{ $taskBreakdowns->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
