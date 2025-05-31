@extends('layouts.app')

@section('content')
{{-- Sidebar --}}
@include('tab.AdminSidebar')

<div style="margin-left: 80px;" id="main-content" class="container mt-4">
    <h2>User Account</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.useraccounts.index') }}" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name or School ID" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>


    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Add Account</button>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Credit</th>
                <th>School ID</th>
                <th>Status</th>
                <th>Birthdate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>{{ $account->firstname }}</td>
                <td>{{ $account->lastname }}</td>
                <td>{{ $account->credit }}</td>
                <td>{{ $account->schoolid }}</td>
                <td>{{ $account->status }}</td>
                <td>{{ $account->birthdate }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $account->id }}">Edit</button>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $account->id }}">Delete</button>
                </td>
            </tr>

            {{-- Edit Modal --}}
            <div class="modal fade" id="editModal{{ $account->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.useraccounts.update', $account->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="firstname" class="form-control mb-2" value="{{ $account->firstname }}" placeholder="Firstname">
                                <input type="text" name="lastname" class="form-control mb-2" value="{{ $account->lastname }}" placeholder="Lastname">
                                <input type="text" name="schoolid" class="form-control mb-2" value="{{ $account->schoolid }}" placeholder="School ID">
                                <input type="date" name="birthdate" class="form-control mb-2" value="{{ $account->birthdate ? $account->birthdate->format('Y-m-d') : '' }}">
                                <select name="status" class="form-control mb-2">
                                    <option value="active" {{ $account->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $account->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade" id="deleteModal{{ $account->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.useraccounts.delete', $account->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete account for <strong>{{ $account->firstname }} {{ $account->lastname }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.useraccounts.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="firstname" class="form-control mb-2" placeholder="Firstname">
                    <input type="text" name="lastname" class="form-control mb-2" placeholder="Lastname">
                    <input type="text" name="schoolid" class="form-control mb-2" placeholder="School ID">
                    <input type="date" name="birthdate" class="form-control mb-2">
                    <select name="status" class="form-control mb-2">
                        <option value="inactive">Inactive</option>
                        <option value="active">Active</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Adjust margin based on sidebar open/closed
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    const resizeObserver = new ResizeObserver(() => {
        const width = sidebar.offsetWidth;
        mainContent.style.marginLeft = width + 'px';
    });

    resizeObserver.observe(sidebar);
</script>
@endsection
