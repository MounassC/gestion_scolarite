@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Catégories de Niveaux</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Ajouter une Catégorie
    </a>
</div>

<div class="card shadow">
    <div class="card-body"> 
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light"> 
                <tr>
                    <th class="ps-4">Nom de la Catégorie</th>
                    <th class="text-center" width="200px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td class="ps-4"><strong>{{ $cat->categorie_niveau }}</strong></td>
                    
                    <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('categories.edit', $cat) }}" class="btn btn-sm btn-warning">
                                    Modifier
                                </a>
                                
                                <form action="{{ route('categories.destroy', $cat) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                     </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection