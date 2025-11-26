@extends('layouts.master.default')
@section('page-title', 'Usuários')
@section('page-actions')
    @can('user.create')
        @can('user.create')
            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
        @endcan
    @endcan
@endsection
@section('content')

    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover table-sm table-sm-text">
                    <thead>
                    <tr>
                        <th class="w-50">Nome</th>
                        <th class="d-none d-md-table-cell">E-mail</th>
                        <th>Papel</th>
                        <th class="w-10 text-end">
                            @if(auth()->user()->can('user.edit') || auth()->user()->can('user.destroy'))
                                Ações
                            @endif
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="align-middle w-50">{{ $user->name }}</td>
                            <td class="d-none d-md-table-cell align-middle">{{ $user->email }}</td>
                            <td class="align-middle">
                                @foreach($user->getRoleNames() as $role)
                                    {{ $role }}
                                @endforeach
                            </td>
                            <td class="text-end">
                                @if(auth()->user()->can('user.edit') || auth()->user()->can('user.destroy'))
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark border-0" type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                        <ul class="dropdown-menu">
                                            @can('user.edit')
                                                <li><a class="dropdown-item"
                                                       href="{{ route('user.edit', $user->id) }}">Editar</a>
                                                </li>
                                            @endcan
                                            @can('user.destroy')
                                                <li>
                                                    <form id="formDelete{{ $user->id }}"
                                                          action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item btnDelete"
                                                                data-delete-id="{{ $user->id }}"
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
                                    Nenhum usuário encontrado!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
