@extends('layouts.master.default')
@section('page-title', 'Usuários')
@section('page-actions')
    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
@endsection
@section('content')

    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th class="w-50">Nome</th>
                    <th class="d-none d-md-table-cell">E-mail</th>
                    <th class="w-10 text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="align-middle w-50">{{ $user->name }}</td>
                        <td class="d-none d-md-table-cell align-middle">{{ $user->email }}</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-outline-dark border-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Editar</a>
                                    </li>
                                    <li>
                                        <form id="formDelete{{ $user->id }}"
                                              action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btnDelete" data-delete-id="{{ $user->id }}"
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
                        <td colspan="3">
                            <div class="alert alert-info mb-0" role="alert">
                                Nenhum usuário encontrado!
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $users->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
