@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <h5 class="card-header">Dinámica {{ $dynamic->code }}</h5>

                <div class="card-body">
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
                        <div class="input-group-append">
                            <button
                                type="button"
                                data-clipboard-target="#dlink"
                                class="btn btn-outline-secondary copy-button"
                            >
                                <i class="fa fa-clipboard"></i>
                                <span style="display: inline-block; width: 64px"
                                    >copiar link</span
                                >
                            </button>
                        </div>
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

                <div class="card text-white text-center bg-danger ">
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
