<div id="voteModal" class="modal fade" tabindex="-1" role="dialog">
    <form id="voteForm" action="{{ route('vote') }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mi preferencia</h5>
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

                    <div class="alert alert-info text-center">
                        Ordena los proyectos arrastrando con el mouse (drag &
                        drop)
                    </div>

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

                    <div id="vote-options">
                        <ul class="list-group">
                            @foreach($dynamic->projects()->orderByRaw("RAND()")->get()
                            as $key => $project)

                            <li class="list-group-item">
                                <span class="badge badge-primary badge-pill">
                                    {{ $key + 1 }}
                                </span>

                                {{ $project->title }}

                                <input
                                    type="hidden"
                                    name="options[]"
                                    value="{{ $project->id }}"
                                />
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <input
                        type="hidden"
                        name="dynamic_id"
                        value="{{ $dynamic->id }}"
                    />

                    <button type="submit" class="btn btn-primary">
                        VOTAR
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
