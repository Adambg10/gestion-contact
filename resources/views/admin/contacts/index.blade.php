@extends('ladmin::layouts.app')

@section('title', 'Gestion des Contacts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Gestion des Contacts
                        <span class="badge badge-primary ml-2">{{ $contacts->total() }}</span>
                    </h3>
                    <div class="card-tools">
                        <form method="GET" action="{{ route('admin.contacts.index') }}" class="form-inline">
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Rechercher..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Contacts</span>
                                    <span class="info-box-number">{{ $totalContacts }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-user"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Utilisateurs</span>
                                    <span class="info-box-number">{{ $totalUsers }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($contacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom Complet</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Propriétaire</th>
                                        <th>Créé le</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>
                                            <strong>{{ $contact->prenom }} {{ $contact->nom }}</strong>
                                        </td>
                                        <td>{{ $contact->email ?? 'N/A' }}</td>
                                        <td>{{ $contact->telephone ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $contact->user->name }}</span>
                                        </td>
                                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-sm btn-info" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" 
                                                  class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Supprimer ce contact ?')"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $contacts->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <p class="text-muted">
                                @if(request('search'))
                                    Aucun contact trouvé pour "{{ request('search') }}"
                                @else
                                    Aucun contact disponible
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection