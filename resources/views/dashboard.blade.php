@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <h5 class="card-header">
            Dinámicas
        </h5>

        @if(count($dynamics) == 0)
        <div class="card-body">
            <div class="alert alert-warning text-center">
                No se han programado dinámicas para votar...<br />
                <a href="{{ route('createDynamic') }}" class="alert-link"
                    >registrar nueva</a
                >
            </div>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-borderless table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col" nowrap>Fecha de cierre</th>
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
                        <td>
                            {{ $dynamic->ends_at->format('d/m/Y H:i') }} hrs.
                        </td>
                        <td>
                            {{ (strlen($dynamic->description) > 100) ? substr($dynamic->description, 0, 100) . '...' : $dynamic->description }}
                        </td>
                        <td>
                            {{ $dynamic->projects->count() }}
                        </td>
                        <td>
                            {!! $dynamic->statusLabel() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $dynamics->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
