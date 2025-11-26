@extends('layouts.master.default')
@section('page-title', 'Produtos')
@section('page-actions')
    @can('product.create')
        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
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
                    <th>CadTec</th>
                    <th class="w-10 text-end">
                        @if(auth()->user()->can('product.edit') || auth()->user()->can('product.destroy'))
                            Ações
                        @endif
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="align-middle">
                            @if($product->cadtec)
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-file-pdf-fill"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('product.preview')
                                            <li><a class="dropdown-item"
                                                   target="_blank"
                                                   href="{{ route('product.preview', $product->id) }}">Visualizar</a>
                                            </li>
                                        @endcan
                                        @can('product.download')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('product.download', $product->id) }}">Baixar</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            @endif
                        </td>
                        <td class="text-end">
                            @if(auth()->user()->can('product.edit') || auth()->user()->can('product.destroy'))
                                <div class="dropdown">
                                    <button class="btn btn-outline-dark border-0" type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                    <ul class="dropdown-menu">
                                        @can('product.edit')
                                            <li><a class="dropdown-item"
                                                   href="{{ route('product.edit', $product->id) }}">Editar</a>
                                            </li>
                                        @endcan
                                        @can('product.destroy')
                                            <li>
                                                <form id="formDelete{{ $product->id }}"
                                                      action="{{ route('product.destroy', $product->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item btnDelete"
                                                            data-delete-id="{{ $product->id }}"
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
                                Nenhum produto cadastrado!
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $products->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
