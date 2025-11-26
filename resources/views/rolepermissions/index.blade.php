@extends('layouts.master.default')
@section('page-title','Permissões: ' . $role->name)
@section('content')
    <x-alert/>
    <div class="card">
        <div class="card-body shadow-sm">
            <table class="table table-hover table-sm table-sm-text">
                <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Rota</th>
                    <th>Descrição</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($permissions as $permission)
                    <tr>
                        <td class="d-none d-md-table-cell">{{ $permission->name }}</td>
                        <td>{{ $permission->title }}</td>
                        <td class="text-center">
                            <!-- Expressão ternário para caso algum papel não tenha nenhuma permissão -->
                            @if(in_array($permission->id, $permissionRoles ?? []))
                                @can('role-permission.update')
                                    <a href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}"><span
                                            class="badge text-bg-success">Liberado</span></a>
                                @else
                                    <span class="badge text-bg-success">Liberado</span>
                                @endcan
                            @else
                                @can('role-permission.update')
                                    <a href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}"><span
                                            class="badge text-bg-danger">Bloqueado</span></a>
                                @else
                                    <span class="badge text-bg-danger">Bloqueado</span>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <colspan class="4">
                            <div class="alert alert-info" role="alert">
                                Nenhum permissão encontrada para o papel {{ $role->name }}
                            </div>
                        </colspan>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
