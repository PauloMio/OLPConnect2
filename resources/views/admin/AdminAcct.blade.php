<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Accounts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .search-form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 8px 16px;
            margin-left: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-info {
            background-color: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .table-container {
            margin-top: 30px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 500px;
        }

        .modal-content h3 {
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-content label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        .modal-content input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('tab.AdminSidebar')

    <div style="margin-left: 80px;" id="main-content">
        @yield('content')
        
        <h2>Admin Accounts</h2>

            {{-- Search Bar --}}
            <div class="search-form">
                <form method="GET" action="{{ route('admin.accounts') }}">
                    <input type="text" name="search" placeholder="Search by name or email"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn-primary">Search</button>
                </form>
            </div>

            {{-- Add Admin Button --}}
            <div style="text-align: center;">
                <button class="btn-success" onclick="openModal('addAdminModal')">Add New Admin</button>
            </div>

            {{-- User Table --}}
            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn-info"
                                    onclick="openEditModal({{ $user->id }}, '{{ $user->username }}', '{{ $user->email }}')">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if ($users->isEmpty())
                    <div style="text-align: center; margin-top: 20px;">
                        <strong>No matching users found.</strong>
                    </div>
                @endif
            </div>

            {{-- Add Admin Modal --}}
            <div id="addAdminModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('addAdminModal')">&times;</span>
                    <h3>Add New Admin</h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>Username</label>
                        <input type="text" name="username" required>

                        <label>Email</label>
                        <input type="email" name="email" required>

                        <label>Password</label>
                        <input type="password" name="password" required>

                        <button type="submit" class="btn-success">Register Admin</button>
                    </form>
                </div>
            </div>

            {{-- Edit Admin Modal --}}
            <div id="editAdminModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('editAdminModal')">&times;</span>
                    <h3>Edit Admin</h3>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <label>Username</label>
                        <input type="text" name="username" id="editUsername" required>

                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" required>

                        <label>New Password (leave blank to keep current)</label>
                        <input type="password" name="password">

                        <button type="submit" class="btn-primary">Update Admin</button>
                    </form>

                    <form id="deleteForm" method="POST" style="margin-top: 10px; text-align: center;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger"
                            onclick="return confirm('Are you sure you want to delete this account?')">Delete Admin</button>
                    </form>
                </div>
            </div>
    </div>

    

    {{-- JS --}}
    <script>
        function openModal(id) {
            document.getElementById(id).style.display = "block";
        }

        function closeModal(id) {
            document.getElementById(id).style.display = "none";
        }

        function openEditModal(id, username, email) {
            const modal = document.getElementById('editAdminModal');
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;

            // Set form actions dynamically
            document.getElementById('editForm').action = `/admin/accounts/${id}`;
            document.getElementById('deleteForm').action = `/admin/accounts/${id}`;

            modal.style.display = "block";
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = ['addAdminModal', 'editAdminModal'];
            modals.forEach(id => {
                const modal = document.getElementById(id);
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }

        // Adjust margin based on sidebar open/closed
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        const resizeObserver = new ResizeObserver(() => {
            const width = sidebar.offsetWidth;
            mainContent.style.marginLeft = width + 'px';
        });

        resizeObserver.observe(sidebar);
    </script>
</body>
</html>
