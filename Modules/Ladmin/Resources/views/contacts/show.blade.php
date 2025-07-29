<x-ladmin-auth-layout>
    <x-slot name="title">Contact Details: {{ $contact->nom }} {{ $contact->prenom }}</x-slot>
    
    <div class="alert alert-info mb-3">
        <i class="fa-solid fa-info-circle"></i> 
        Contact belongs to user: <strong>{{ $contact->user->name }}</strong> ({{ $contact->user->email }})
    </div>

    <x-ladmin-card>
        <x-slot name="header">Contact Information</x-slot>
        <x-slot name="body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <p class="form-control-plaintext">{{ $contact->nom }} {{ $contact->prenom }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">
                            @if($contact->email)
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <p class="form-control-plaintext">
                            @if($contact->telephone)
                                <a href="tel:{{ $contact->telephone }}">{{ $contact->telephone }}</a>
                            @else
                                <span class="text-muted">Not provided</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Owner</label>
                        <p class="form-control-plaintext">
                            <a href="{{ route('ladmin.user.edit', $contact->user_id) }}" class="text-decoration-none">
                                <i class="fa-solid fa-user"></i> {{ $contact->user->name }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            @if($contact->adresse)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <p class="form-control-plaintext">{{ $contact->adresse }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($contact->note)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Notes</label>
                            <p class="form-control-plaintext">{{ $contact->note }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <small class="text-muted">
                            <strong>Created:</strong> {{ $contact->created_at->format('F j, Y \a\t g:i A') }}<br>
                            <strong>Last Updated:</strong> {{ $contact->updated_at->format('F j, Y \a\t g:i A') }}
                        </small>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-ladmin-card>

    <div class="text-end mt-3">
        <a href="{{ route('ladmin.user.edit', $contact->user_id) }}" class="btn btn-secondary me-2">Back to User</a>
        <a href="{{ route('ladmin.contact.edit', $contact->id) }}" class="btn btn-warning me-2">
            <i class="fa-solid fa-edit"></i> Edit Contact
        </a>
        <form method="POST" action="{{ route('ladmin.contact.destroy', $contact->id) }}" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this contact?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i> Delete Contact
            </button>
        </form>
    </div>

</x-ladmin-auth-layout>
