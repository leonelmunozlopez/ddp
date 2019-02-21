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
