<x-ladmin-auth-layout>
    <x-slot name="title">Create New Contact{{ $user ? ' for ' . $user->name : '' }}</x-slot>
    
    <form action="{{ route('ladmin.contact.store') }}" method="POST">
        @csrf

        @if($user)
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="alert alert-info mb-3">
                <i class="fa-solid fa-info-circle"></i> 
                Creating contact for user: <strong>{{ $user->name }}</strong> ({{ $user->email }})
            </div>
        @endif

        <x-ladmin-card>
            <x-slot name="header">Contact Information</x-slot>
            <x-slot name="body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="text" 
                                name="nom" 
                                value="{{ old('nom') }}" 
                                placeholder="Enter last name"
                                required
                            />
                            @error('nom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">First Name <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="text" 
                                name="prenom" 
                                value="{{ old('prenom') }}" 
                                placeholder="Enter first name"
                                required
                            />
                            @error('prenom')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <x-ladmin-input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="Enter email address"
                            />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Phone</label>
                            <x-ladmin-input 
                                type="text" 
                                name="telephone" 
                                value="{{ old('telephone') }}" 
                                placeholder="Enter phone number"
                            />
                            @error('telephone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Address</label>
                            <textarea class="form-control @error('adresse') is-invalid @enderror" 
                                      id="adresse" 
                                      name="adresse" 
                                      rows="3" 
                                      placeholder="Enter address">{{ old('adresse') }}</textarea>
                            @error('adresse')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="categorie" class="form-label">Category (Optional)</label>
                            <select class="form-control @error('categorie') is-invalid @enderror" 
                                    id="categorie" 
                                    name="categorie">
                                <option value="">-- Select a category --</option>
                                @foreach(\App\Models\Contact::CATEGORIES as $key => $value)
                                    <option value="{{ $key }}" {{ old('categorie') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Empty column for spacing -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="note" class="form-label">Notes</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" 
                                      id="note" 
                                      name="note" 
                                      rows="4" 
                                      placeholder="Personal notes about this contact...">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-ladmin-card>

        <div class="text-end mt-3">
            <a href="{{ $user ? route('ladmin.user.edit', $user->id) : route('ladmin.user.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <x-ladmin-button>Create Contact</x-ladmin-button>
        </div>

    </form>

</x-ladmin-auth-layout>
