@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Nueva dinámica
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form
                        id="dynamicForm"
                        method="POST"
                        action="{{ route('storeDynamic') }}"
                    >
                        @csrf

                        <div class="form-group row">
                            <label
                                for="ends_at"
                                class="col-md-4 col-form-label text-md-right"
                                >Fecha de cierre</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="ends_at"
                                    type="datetime-local"
                                    class="form-control{{ $errors->has('ends_at') ? ' is-invalid' : '' }}"
                                    name="ends_at"
                                    value="{{ old('ends_at') }}"
                                    required
                                />

                                @if ($errors->has('ends_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong
                                        >{{ $errors->first('ends_at') }}</strong
                                    >
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="description"
                                class="col-md-4 col-form-label text-md-right"
                                >Descripción</label
                            >

                            <div class="col-md-6">
                                <textarea
                                    id="description"
                                    type="description"
                                    class="form-control autosize {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    name="description"
                                >
                                {{ old('description') }}
                            </textarea
                                >

                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong
                                        >{{ $errors->first('description') }}</strong
                                    >
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                                <a
                                    href="{{ route('dashboard') }}"
                                    class="btn btn-default"
                                    >Volver</a
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
