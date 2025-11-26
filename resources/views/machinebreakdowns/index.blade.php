@extends('layouts.master.default')
@section('page-title', 'Parada de máquina')
@section('page-actions')
    @can('machinebreakdown.create')
        <a href="{{ route('machinebreakdown.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
    @endcan
@endsection
@section('content')
    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th>Parada</th>
                    <th class="w-10 text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($machineBreakdowns as $machineBreakdown)
                    <tr>
                        <td class="align-middle">{{ $machineBreakdown->name }}</td>
                        <td class="text-end">
                            @if(auth()->user()->can('machinebreakdown.edit') || auth()->user()->can('machinebreakdown.destroy'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('machinebreakdown.edit')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('machinebreakdown.edit', $machineBreakdown->id) }}">Editar</a>
                                            </li>
                                        @endcan
                                        @can('machinebreakdown.destroy')
                                            <li>
                                                <form id="formDelete{{ $machineBreakdown->id }}"
                                                      action="{{ route('machinebreakdown.destroy', $machineBreakdown->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $machineBreakdown->id }}"
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
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-info mb-0" role="alert">
                                Nenhuma parada de máquina cadastrada!
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $machineBreakdowns->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
