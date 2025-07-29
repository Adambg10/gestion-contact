@extends('base')

@section('content')
 <div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Détails du Contact</h6>
                    <a href="{{ route('contacts.index') }}" class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                </div>
                <div class="card-body">
                    @if($contact)
                        <h3 class="card-title mb-4 ">
                            <i class="fas fa-user"></i> {{ $contact->prenom }} {{ $contact->nom }}
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-4"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ $contact->email ?? 'N/A' }}</p>
                                <p class="mb-4"><i class="fas fa-phone"></i> <strong>Téléphone:</strong> {{ $contact->telephone ?? 'N/A' }}</p>
                                <p class="mb-4"><i class="fas fa-calendar-alt"></i> <strong>Ajouté le:</strong> {{ $contact->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-4"><i class="fas fa-map-marker-alt"></i> <strong>Adresse:</strong> {{ $contact->adresse ?? 'Aucune adresse disponible.' }}</p>
                                @if($contact->categorie)
                                <p class="mb-4"><i class="fas fa-tag"></i> <strong>Catégorie:</strong> {{ $contact->categorie ?? 'Aucune catégorie.' }}</p>
                                @endif
                                <strong class ="mb-3"><i class="fa-solid fa-pen-to-square"></i> Note</strong>
                                <p class="card-text ">{{ $contact->note ?? 'Aucune note disponible.' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning text-white">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('contacts.destroy', $contact) }}" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                        
                    @else
                        <p>Aucun contact trouvé.</p>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection