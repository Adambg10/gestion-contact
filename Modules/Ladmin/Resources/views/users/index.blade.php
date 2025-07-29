<x-ladmin-auth-layout>
    <x-slot name="title">List of Users</x-slot>
        <x-slot name="button">
            <a href="{{ route('ladmin.user.create', ladmin()->back()) }}" class="btn btn-primary">&plus; Add New User</a>
        </x-slot>
    <x-ladmin-card>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="clickable-row" data-href="{{ route('ladmin.user.edit', $user->id) }}?{{ http_build_query(ladmin()->back()) }}" style="cursor: pointer;">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('ladmin.user.edit', $user->id) }}?{{ http_build_query(ladmin()->back()) }}" class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('ladmin.user.destroy', $user->id) }}" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No users found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
