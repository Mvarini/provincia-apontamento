@extends('layouts.master.default')
@section('page-title', 'Meu perfil')
@section('content')
    <div class="card">
        <div class="card-body shadow-sm">
            <form action="{{ route('profile.update', $user->id) }}" method="POST" class="row g-3"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                    <label for="nickname" class="form-label mb-1">Apelido</label>
                    <input
                        type="text"
                        name="nickname"
                        value="{{ old('nickname', $user->profile?->nickname) }}"
                        class="form-control @error('nickname') is-invalid @enderror"
                        placeholder="Apelido"
                    />
                    @error('nickname')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="birthday" class="form-label mb-1">Nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                        <input
                            type="text"
                            name="birthday"
                            id="birthday"
                            value="{{ old('birthday', $user->profile?->birthday ? \Illuminate\Support\Carbon::parse($user->profile?->birthday)->format('d/m/Y') : "" )}}"
                            class="form-control datepicker @error('birthday') is-invalid @enderror"
                            placeholder="Nascimento"
                        />
                    </div>
                    @error('birthday')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">Telefone</label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $user->profile?->phone) }}"
                           class="form-control phone @error('phone') is-invalid @enderror" placeholder="Telefone">
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="gender" class="form-label">Gênero</label>
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                        <option value="">Selecione</option>
                        @foreach ($genders as $gender)
                            <option
                                {{ old('gender', $gender) === $user->profile?->gender ? "selected" : "" }} value="{{ $gender }}">{{ $gender }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label for="image" class="form-label">Imagem</label>
                    <input type="file" name="image"
                           class="form-control @error('image') is-invalid @enderror" placeholder="Imagem">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <p class="form-text text-muted">
                        <span class="text-danger">*</span> Campos obrigatórios
                    </p>
                    <div class="d-flex  justify-content-end mt-3">
                        <button type="submit" id="btnSubmit" class="btn btn-primary btn-sm">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
