<x-ladmin-auth-layout>
    <x-slot name="title">Create New User</x-slot>
    
    <form action="{{ route('ladmin.user.store') }}" method="POST">
        @csrf

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
                                value="{{ old('name') }}" 
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
                                value="{{ old('email') }}" 
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
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="password" 
                                name="password" 
                                placeholder="Enter password"
                                required
                            />
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <x-ladmin-input 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="Confirm password"
                                required
                            />
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-ladmin-card>

        <div class="text-end mt-3">
            <a href="{{ route('ladmin.user.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <x-ladmin-button>Create User</x-ladmin-button>
        </div>

    </form>

</x-ladmin-auth-layout>
