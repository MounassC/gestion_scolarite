@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-warning">
        Modifier Filière
    </div>
    <div class="card-body">

        <form action="{{ route('filieres.update', $filiere) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Code</label>
                <input type="text" name="code" value="{{ $filiere->code }}" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Nom Filière</label>
                <input type="text" name="nomFiliere" value="{{ $filiere->nomFiliere }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">
                Modifier
            </button>

            <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                Retour
            </a>
        </form>

    </div>
</div>

@endsection
