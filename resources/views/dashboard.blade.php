@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <h5 class="card-header">
            Dinámicas
        </h5>

        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Fecha de cierre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Proyectos</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dynamics as $dynamic)
                <tr>
                    <th scope="row">
                        <a href="{{ url('/dinamicas/' . $dynamic->code) }}">
                            {{ $dynamic->code }}
                        </a>
                    </th>
                    <td>{{ $dynamic->ends_at->format('d/m/Y H:i') }} hrs.</td>
                    <td>
                        {{ $dynamic->description }}
                    </td>
                    <td>
                        {{ $dynamic->id }}
                    </td>
                    <td>
                        {!! $dynamic->statusLabel() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-body">
            {{ $dynamics->links() }}
        </div>
    </div>
</div>
@endsection
