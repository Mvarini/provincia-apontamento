@extends('layouts.master.default')
@section('page-title', 'Colaboradores')
@section('page-actions')
    @can('employee.create')
        <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
    @endcan
@endsection
@section('content')
    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th class="w-30">Nome</th>
                    <th class="w-25 d-none d-md-table-cell">Setor</th>
                    <th class="w-25 d-none d-md-table-cell">Função</th>
                    <th class="w-10 text-end">
                        @if(auth()->user()->can('employee.edit') || auth()->user()->can('employee.destroy'))
                            Ações
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td class="w-30 align-middle">{{ $employee->name }}</td>
                        <td class="w-25 d-none d-md-table-cell align-middle">{{ $employee->department }}</td>
                        <td class="w-25 d-none d-md-table-cell align-middle">{{ $employee->job_title }}</td>
                        <td class="w-10 text-end align-middle">
                            @if(auth()->user()->can('employee.edit') || auth()->user()->can('employee.destroy'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('employee.edit')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('employee.edit', $employee->id) }}">Editar</a>
                                            </li>
                                        @endcan
                                        @can('employee.destroy')
                                            <li>
                                                <form id="formDelete{{ $employee->id }}"
                                                      action="{{ route('employee.destroy', $employee->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $employee->id }}"
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
                        <td colspan="4">
                            <div class="alert alert-info mb-0" role="alert">
                                Nenhum colaborador cadastrado!
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $employees->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
