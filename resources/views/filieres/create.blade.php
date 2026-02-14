@extends('layouts.app')

@section('content')

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        Ajouter une Filière
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('filieres.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Code</label>
                <input type="text" name="code" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Nom Filière</label>
                <input type="text" name="nomFiliere" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">
                Enregistrer
            </button>

            <a href="{{ route('filieres.index') }}" class="btn btn-secondary">
                Retour
            </a>
        </form>

    </div>
</div>

@endsection
