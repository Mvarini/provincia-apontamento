@extends('layouts.master.default')
@section('page-title', 'Colaboradores')
@section('page-actions')
    <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
@endsection
@section('content')
    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th class="w-30">Nome</th>
                    <th class="w-25 d-none d-md-table-cell">Cargo</th>
                    <th class="w-25 d-none d-md-table-cell">Função</th>
                    <th class="w-10 text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td class="w-30 align-middle">{{ $employee->name }}</td>
                        <td class="w-25 d-none d-md-table-cell align-middle">{{ $employee->department }}</td>
                        <td class="w-25 d-none d-mdtable-cell align-middle">{{ $employee->job_title }}</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-outline-dark border-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                           href="{{ route('employee.edit', $employee->id) }}">Editar</a>
                                    </li>
                                    <li>
                                        <form id="formDelete{{ $employee->id }}"
                                              action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btnDelete" data-delete-id="{{ $employee->id }}"
                                                    type="submit">Excluir
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
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
