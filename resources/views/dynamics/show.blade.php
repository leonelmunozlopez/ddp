@extends('layouts.app') @section('content')

<div id="projectModal" class="modal fade" tabindex="-1" role="dialog">
    <form id="projectForm" action="{{ route('storeProject') }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Proyecto</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="alert text-center" style="display: none"></div>

                    <div class="form-group">
                        <label for="title">Usuario</label>
                        @auth
                        <p>
                            <strong>{{ Auth::user()->email }}</strong>
                        </p>
                        @else
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control"
                            placeholder="usuario@continuum.cl"
                            required
                            autofocus
                        />
                        @endauth
                    </div>

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input
                            id="title"
                            name="title"
                            type="text"
                            class="form-control"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="description">Detalles</label>

                        <textarea
                            id="details"
                            type="details"
                            name="details"
                            class="form-control autosize"
                            required
                        >
                        </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input
                        type="hidden"
                        name="dynamic_id"
                        value="{{ $dynamic->id }}"
                    />

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">
                    Dinámica {{ $dynamic->code }}

                    <span style="float: right;">
                        {!! $dynamic->statusLabel() !!}
                    </span>
                </h5>

                <div
                    class="card-body"
                    style="min-height: 120px; max-height: 220px; overflow: auto"
                >
                    {{ nl2br($dynamic->description) }}
                </div>

                <div class="card-footer">
                    <div class="input-group">
                        <input
                            type="text"
                            id="dlink"
                            value="{{ url('/dinamicas/' . $dynamic->code) }}"
                            class="form-control"
                            readonly
                        />
                        <div class="input-group-append mb-3">
                            <button
                                type="button"
                                data-clipboard-target="#dlink"
                                class="btn btn-outline-info copy-button"
                            >
                                <i class="fa fa-clipboard"></i>
                                <span style="display: inline-block; width: 64px"
                                    >copiar link</span
                                >
                            </button>
                        </div>
                    </div>

                    @auth
                    <div class="mb-3">
                        <a
                            href="{{ route('editDynamic', ['code' => $dynamic->code]) }}"
                            class="btn btn-secondary btn-block"
                        >
                            <i class="fa fa-edit"></i>
                            Editar dinámica</a
                        >

                        @if($dynamic->status == 'pending')
                        <a
                            id="openDynamic"
                            href="{{ route('openDynamic', ['id' => $dynamic->id]) }}"
                            class="btn btn-primary btn-block"
                        >
                            <i class="fa fa-lock-open"></i>
                            Iniciar votaciones</a
                        >
                        @endif @if($dynamic->status == 'open')
                        <a
                            id="closeDynamic"
                            href="{{ route('closeDynamic', ['id' => $dynamic->id]) }}"
                            class="btn btn-success btn-block"
                        >
                            <i class="fa fa-clipboard-check"></i>
                            Finalizar</a
                        >
                        @endif

                        <a
                            id="deleteDynamic"
                            href="{{ route('deleteDynamic', ['id' => $dynamic->id]) }}"
                            class="btn btn-danger btn-block"
                        >
                            <i class="fa fa-delete"></i>
                            Eliminar</a
                        >
                        <hr />
                    </div>
                    @endauth

                    <div>
                        <button
                            type="button"
                            data-toggle="modal"
                            data-target="#projectModal"
                            class="btn btn-dark btn-block"
                        >
                            <i class="fa fa-lightbulb"></i>
                            Postular proyecto
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="time-line">
                <div class="card text-white text-center bg-info mb-3">
                    <div class="time-line-date">
                        {{ $dynamic->created_at->format('d/m/Y H:i') }} hrs.
                    </div>

                    <div class="card-body">
                        <div class="card-text">
                            Se crea y calendariza la dinámica
                        </div>
                    </div>
                </div>

                @foreach($dynamic->projects as $project)
                <div class="card text-white text-center bg-secondary mb-3">
                    <div class="time-line-date">
                        {{ $project->created_at->format('d/m/Y H:i') }} hrs.
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            {{ $project->title }}
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>
                            publicado por :
                            {{ ($project->user->name != '') ? $project->user->name : $project->user->email }}
                        </small>
                    </div>
                </div>
                @endforeach

                <div class="card text-white text-center bg-danger">
                    <div class="time-line-date">
                        {{ $dynamic->ends_at->format('d/m/Y H:i') }} hrs.
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            Fecha de cierre de votaciones
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
