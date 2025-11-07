@extends('layouts.master.default')
@section('page-title', 'Produtos')
@section('page-actions')
    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">Adicionar</a>
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
                @forelse($products as $product)
                    <tr>
                        <td class="align-middle">{{ $product->name }}</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-outline-dark border-0" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                           href="{{ route('product.edit', $product->id) }}">Editar</a>
                                    </li>
                                    <li>
                                        <form id="formDelete{{ $product->id }}"
                                              action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item btnDelete" data-delete-id="{{ $product->id }}"
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
