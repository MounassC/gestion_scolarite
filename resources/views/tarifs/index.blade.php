@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Catalogue des Tarifs</h2>
    <a href="{{ route('tarifs.create') }}" class="btn btn-primary">Nouveau Tarif</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Inscription</th>
                    <th>Mensualité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tarifs as $tarif)
                <tr>
                    <td>{{ number_format($tarif->inscription, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($tarif->mensualite, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <a href="{{ route('tarifs.edit', $tarif) }}" class="btn btn-sm btn-warning">Modifier</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection