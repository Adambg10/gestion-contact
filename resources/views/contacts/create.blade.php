@extends('base')

@section('title', 'Nouveau Contact')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-plus"></i> Créer un Nouveau Contact
                        </h6>
                        <a href="{{ route('contacts.index') }}" class="btn btn-outline-dark btn-sm">
                            <i class="fas fa-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contacts.store') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nom">Nom <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nom') is-invalid @enderror" 
                                               id="nom" 
                                               name="nom" 
                                               value="{{ old('nom') }}" 
                                               required>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prenom">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('prenom') is-invalid @enderror" 
                                               id="prenom" 
                                               name="prenom" 
                                               value="{{ old('prenom') }}" 
                                               required>
                                        @error('prenom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone">Téléphone</label>
                                        <input type="text" 
                                               class="form-control @error('telephone') is-invalid @enderror" 
                                               id="telephone" 
                                               name="telephone" 
                                               value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                          id="adresse" 
                                          name="adresse" 
                                          rows="3">{{ old('adresse') }}</textarea>
                                @error('adresse')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" 
                                          id="note" 
                                          name="note" 
                                          rows="4" 
                                          placeholder="Notes personnelles sur ce contact...">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group text-right">
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Créer le Contact
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
