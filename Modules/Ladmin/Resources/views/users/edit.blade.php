<x-ladmin-auth-layout>
    <x-slot name="title">Edit User: {{ $user->name }}</x-slot>
    
    <form action="{{ route('ladmin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <x-ladmin-card>
            <x-slot name="header">User Information</x-slot>
            <x-slot name="body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $user->name) }}" 
                                placeholder="Enter user name"
                                required
                            />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}" 
                                placeholder="Enter email address"
                                required
                            />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <x-ladmin-input 
                                type="password" 
                                name="password" 
                                placeholder="Enter new password"
                            />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <x-ladmin-input 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="Confirm new password"
                            />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Created:</strong> {{ $user->created_at->format('F j, Y \a\t g:i A') }}<br>
                                <strong>Last Updated:</strong> {{ $user->updated_at->format('F j, Y \a\t g:i A') }}
                            </small>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-ladmin-card>

        <div class="text-end mt-3">
            <a href="{{ route('ladmin.user.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <x-ladmin-button>Update User</x-ladmin-button>
        </div>

    </form>

    <!-- User Contacts Section -->
    <x-ladmin-card class="mt-4">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <span>User Contacts ({{ $user->contacts->count() }})
                &nbsp;
                <a href="{{ route('ladmin.contact.create') }}?user_id={{ $user->id }}" class="btn btn-primary">
                    &plus; Add New Contact
                </a>
                </span>
            </div>
        </x-slot>
        <x-slot name="body">
            @if($user->contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->contacts as $contact)
                                <tr class="clickable-row" data-href="{{ route('ladmin.contact.edit', $contact->id) }}" style="cursor: pointer;">
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->nom }} {{ $contact->prenom }}</td>
                                    <td>{{ $contact->telephone }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('ladmin.contact.edit', $contact->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                        <form method="POST" action="{{ route('ladmin.contact.destroy', $contact->id) }}" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i> Delete
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
                    <i class="fa-solid fa-address-book fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No contacts found for this user</h5>
                    <a href="{{ route('ladmin.contact.create') }}?user_id={{ $user->id }}" class="btn btn-primary">
                    &plus; Add First Contact
                </a>
                </div>
            @endif
        </x-slot>
    </x-ladmin-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Make table rows clickable
            document.querySelectorAll('.clickable-row').forEach(function(row) {
                row.addEventListener('click', function(e) {
                    // Don't navigate if clicking on buttons, links, or form elements
                    if (e.target.tagName === 'BUTTON' || 
                        e.target.tagName === 'A' || 
                        e.target.closest('form') || 
                        e.target.closest('button') || 
                        e.target.closest('a')) {
                        return;
                    }
                    
                    // Navigate to the edit page
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>

</x-ladmin-auth-layout>
