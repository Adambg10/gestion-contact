@extends('base')

@section('title', 'Mes Contacts')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-users"></i> Mes Contacts
                            @if(request('search'))
                                - Résultats pour "{{ request('search') }}"
                            @endif
                            <span class="badge badge-primary bg-primary ml-2">{{ $contacts->count() }}</span>
                        </h6>
                        <form class="d-flex me-3" method="GET" action="{{ route('contacts.index') }}">
                        <input class="form-control me-2" type="search" name="search" placeholder="Rechercher un contact..." aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        </form>
                        <a href="{{ route('contacts.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-user-plus"></i> Nouveau Contact
                        </a>
                    </div>
                    <div class="card-body">

                        @if(request('search') && $contacts->count() == 0)
                            <div class="text-center py-4">
                                <i class="fas fa-search fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted">Aucun contact trouvé pour "{{ request('search') }}"</p>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Voir tous les contacts
                                </a>
                            </div>
                        @elseif($contacts->count() > 0)
                            @if(request('search'))
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> {{ $contacts->count() }} contact(s) trouvé(s)
                                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-secondary ml-2">
                                        <i class="fas fa-times"></i> Effacer la recherche
                                    </a>
                                </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Ajouté le</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->prenom }} {{ $contact->nom }}</td>
                                            <td>{{ $contact->email ?? 'N/A' }}</td>
                                            <td>{{ $contact->telephone ?? 'N/A' }}</td>
                                            <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('contacts.destroy', $contact) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger" 
                                                            title="Supprimer"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-user-plus fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted">Aucun contact pour le moment</p>
                                <a href="{{ route('contacts.create') }}" class="btn btn-primary">
                                    <i class="fas fa-user-plus"></i> Créer votre premier contact
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
