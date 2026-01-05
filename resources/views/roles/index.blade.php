@extends('layouts.master.default')
@section('page-title','Papéis')
@section('page-actions')
    @can('role.create')
        <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
    @endcan
@endsection
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th class="text-end">
                        @if(auth()->user()->can('role.edit') || auth()->user()->can('role.destroy') || auth()->user()->can('role-permission.index'))
                            Ações
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td class="align-middle">{{ $role->name }}</td>
                        <td class="text-end align-middle">

                            @if(auth()->user()->can('role.edit') || auth()->user()->can('role.destroy') || auth()->user()->can('role-permission.index'))

                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('role.edit')
                                            <li>
                                                <a class="dropdown-item"
                                                   href="{{ route('role.edit', $role->id) }}">Editar</a>
                                            </li>
                                        @endcan

                                        @can('role.destroy')
                                            <li>
                                                <form id="formDelete{{ $role->id }}"
                                                      action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $role->id }}"
                                                            type="submit">Excluir
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                        @can('role-permission.index')
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li><a class="dropdown-item"
                                                   href="{{ route('role-permission.index', $role->id) }}">Permissões</a>
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
                            <div class="alert alert-info" role="alert">
                                Nenhum papel encontrado.
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $roles->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
