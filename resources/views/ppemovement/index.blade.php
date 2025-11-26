@extends('layouts.master.default')
@section('page-actions')
    <a href="" class="btn btn-primary btn-sm">Adiconar</a>
@endsection
@section('page-title','Movimentação de EPI')
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-text-center">
                    <thead>
                    <tr>
                        <th>Data</th>
                        <th class="d-none d-md-table-cell">Colaborador</th>
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
                            <td class="d-none d-md-table-cell align-middle">{{ $ppeMovement->employee->name }}</td>
                            <td class="align-middle">{{ $ppeMovement->ppe->name }}</td>
                            <td class="text-center align-middle">{{ $ppeMovement->size }}</td>
                            <td class="text-center align-middle">{{ $ppeMovement->quantity }}</td>
                            <td class="text-end align-middle">

                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('')
                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                   data-bs-target="#formShow{{ $ppeMovement->id }}"
                                                   href="#">Visualizar</a>
                                            </li>
                                        @endcan
                                        @can('')
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('task.edit', $ppeMovement->id) }}">Editar</a>
                                            </li>
                                        @endcan

                                        @can('')
                                            <li>
                                                <form id="formDelete{{ $ppeMovement->id }}"
                                                      action="{{ route('task.destroy', $ppeMovement->id) }}"
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
                    @empty
                        <tr>
                            <colspan class="7">
                                <div class="alert alert-info mb-0" role="alert">
                                    Nenhuma movimentação de EPI cadastrada!
                                </div>
                            </colspan>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $ppeMovements->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
