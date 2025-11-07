@extends('layouts.master.default')
@section('page-title', 'Máquinas')
@section('page-actions')
    <a href="{{ route('machine.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
@endsection
@section('content')
    <x-alert/>

    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th class="w-10 text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($machines as $machine)
                    <tr>
                        <td class="align-middle">{{ $machine->name }}</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-outline-dark border-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                           href="{{ route( 'machine.edit', $machine->id) }}">Editar</a>
                                    </li>
                                    <li>
                                        <form id="formDelete{{ $machine->id }}"
                                              action="{{ route('machine.destroy', $machine->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btnDelete" data-delete-id="{{ $machine->id }}"
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
                                Nenhuma máquina cadastrada!
                            </div>
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
            <div class="mt-3">
                {{ $machines->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
