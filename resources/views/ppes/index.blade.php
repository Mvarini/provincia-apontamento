@extends('layouts.master.default')
@section('page-actions')
    @can('ppe.create')
        <a href="{{ route('ppe.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
    @endcan
@endsection
@section('page-title','EPIs')
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-sm table-hover table-sm-text">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CA</th>
                    <th class="text-end">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($ppes as $ppe)
                    <tr>
                        <td class="align-middle">{{ $ppe->name }}</td>
                        <td class="align-middle">{{ $ppe->ca }}</td>
                        <td class="text-end">
                            @if(auth()->user()->can('ppe.edit') || auth()->user()->can('ppe.destroy'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('ppe.edit')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('ppe.edit', $ppe->id) }}">Editar</a>
                                            </li>
                                        @endcan
                                        @can('ppe.destroy')
                                            <li>
                                                <form id="formDelete{{ $ppe->id }}"
                                                      action="{{ route('ppe.destroy', $ppe->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $ppe->id }}"
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
                        <colspan class="4">
                            <div class="alert alert-info" role="alert">
                                Nenhum EPI encontrado!
                            </div>
                        </colspan>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $ppes->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
