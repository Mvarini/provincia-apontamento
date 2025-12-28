@extends('layouts.master.default')
@section('page-actions')
    <a href="{{ route('ppe-movements.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
@endsection
@section('page-title','Movimentação de EPI')
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <div class="mb-4">
                <form action="{{ route('ppe-movements.index') }}" method="GET" class="row g-3">
                    @csrf

                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="text"
                                   class="form-control datepicker"
                                   name="date"
                                   value="{{ $date }}"
                                   placeholder="Data da movimentação"
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
                                    <a href="{{ route('ppe-movements.index') }}" class="dropdown-item" type="button">Limpar</a>
                                </li>
                                @can('task.report-task')
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a href="{{ url('ppes/movements/report?' . request()->getQueryString()) }}"
                                           class="dropdown-item">Visualizar relatório</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive-sm">
                <table class="table table-sm table-hover table-sm-text">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th>Colaborador</th>
                        <th>EPI</th>
                        <th class="text-center">Tamanho</th>
                        <th class="text-center">Qtde</th>
                        <th class="text-end">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($ppeMovements as $ppeMovement)
                        <tr>
                            <td class="align-middle">{{  \Carbon\Carbon::createFromFormat('Y-m-d', $ppeMovement->date)->format('d/m/Y') }}</td>
                            <td class="align-middle">{{ $ppeMovement->employee->name}}</td>
                            <td class="align-middle">{{ $ppeMovement->ppe->name }}</td>
                            <td class="text-center align-middle">{{ $ppeMovement->size ?? "-" }}</td>
                            <td class="text-center align-middle">{{ $ppeMovement->quantity }}</td>
                            <td class="text-end align-middle">

                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('ppe-movements.edit')
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('ppe-movements.edit', ['ppeMovement' => $ppeMovement->id]) }}">Editar</a>
                                            </li>
                                        @endcan

                                        @can('ppe-movements.destroy')
                                            <li>
                                                <form id="formDelete{{ $ppeMovement->id }}"
                                                      action="{{ route('ppe-movements.destroy', ['ppeMovement' => $ppeMovement->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $ppeMovement->id }}"
                                                            type="submit">Excluir
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-info mb-0" role="alert">
                                    Nenhuma movimentação de EPI cadastrada!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </table>
                <div class="mt-3">
                    {{ $ppeMovements->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
@endsection
