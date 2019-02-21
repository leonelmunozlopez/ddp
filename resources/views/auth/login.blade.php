@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acceso usuarios</div>

                <div class="card-body">
                    <form
                        id="loginForm"
                        method="POST"
                        action="{{ route('login') }}"
                    >
                        @csrf

                        <div class="form-group row">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-right"
                                >Usuario</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                />

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong
                                        >{{ $errors->first('email') }}</strong
                                    >
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-right"
                                >Contraseña</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    required
                                />

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong
                                        >{{ $errors->first('password') }}</strong
                                    >
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input type="checkbox" id="remember"
                                    name="remember" class="form-check-input"
                                    {{ old('remember', 'checked') }} />

                                    <label
                                        class="form-check-label"
                                        for="remember"
                                    >
                                        Recordar sesión
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ingresar
                                </button>

                                @if (Route::has('password.request'))
                                <a
                                    class="btn btn-link"
                                    href="{{ route('password.request') }}"
                                >
                                    Olvidé mi contraseña
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
