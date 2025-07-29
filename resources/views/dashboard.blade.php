@extends('base')
@section ('content')
        <div class="container-fluid">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Contacts Récents</h6>
                    <form class="d-flex me-3" method="GET" action="{{ route('contacts.index') }}">
                        <input class="form-control me-2" type="search" name="search" placeholder="Rechercher un contact..." aria-label="Search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
                </div>
                <div class="card-body">
                    @php
                        $recentContacts = Auth::user()->contacts()->latest()->limit(5)->get();
                    @endphp
                    @if($recentContacts->count() > 0)
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
                                    @foreach($recentContacts as $contact)
                                    <tr>
                                        <td>{{ $contact->prenom }} {{ $contact->nom }}</td>
                                        <td>{{ $contact->email ?? 'N/A' }}</td>
                                        <td>{{ $contact->telephone ?? 'N/A' }}</td>
                                        <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('contacts.destroy', $contact) }}" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">
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
                                Créer votre premier contact
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </div>
@endsection

