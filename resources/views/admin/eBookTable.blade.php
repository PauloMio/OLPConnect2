<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eBook Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background: #f1f1f1;
        }

        .container {
            padding: 30px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .controls {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        input, select, button {
            padding: 8px 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .action-buttons button {
            margin: 0 4px;
            padding: 6px 10px;
            font-size: 0.9rem;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #bd2130;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
            position: relative;
        }

        .modal-content h3 {
            margin-top: 0;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 20px;
        }

        form .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('tab.AdminSidebar')

    <div style="margin-left: 80px;" id="main-content">
        @yield('content')

        
    <div class="container">
        <h2>eBook Table</h2>

        <form method="GET" action="{{ route('admin.ebook.list') }}">
            <div class="controls">
                <input type="text" name="search" placeholder="Search by Title or Author" value="{{ request('search') }}">
                <select name="sortOrder">
                    <option value="asc" {{ request('sortOrder') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sortOrder') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
             
                <select name="category">
                    <option value="">Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->category }}">{{ $cat->category }}</option>
                    @endforeach
                </select>
 
                <button type="submit">Apply Filters</button>
            </div>
        </form>

        <div>
            <button onclick="openModal('addModal')">Add New eBook</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ebooks as $ebook)
                    <tr>
                        <td>{{ $ebook->title }}</td>
                        <td>{{ $ebook->author }}</td>
                        <td>{{ $ebook->category }}</td>
                        <td class="action-buttons">
                            <button class="btn-edit" onclick="openEditModal({{ $ebook }})">Edit</button>
                            <form method="POST" action="{{ route('admin.ebook.destroy', $ebook->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ADD Modal --}}
    <div class="modal" id="addModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('addModal')">&times;</span>
            <h3>Add New eBook</h3>
            <form id="ebookForm" action="{{ route('ebook.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.partials.ebook-form-fields', ['categories' => $categories, 'locations' => $locations])
                <button type="button" onclick="uploadInChunks()">Add eBook</button>
            </form>
        </div>
    </div>

    {{-- EDIT Modal --}}
    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('editModal')">&times;</span>
            <h3>Edit eBook</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.partials.ebook-form-fields')
                <button type="submit">Update eBook</button>
            </form>
        </div>
    </div>
    <div>

        <!-- Loading Overlay -->
<div id="loadingOverlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.6); z-index:2000; justify-content:center; align-items:center; flex-direction:column; color:white; font-family:sans-serif;">
    <div class="spinner" style="border:6px solid #f3f3f3; border-top:6px solid #007bff; border-radius:50%; width:50px; height:50px; animation:spin 1s linear infinite;"></div>
    <div style="margin-top:15px; font-size:18px;">The eBook is being uploaded...</div>
    <div style="margin-top:5px; font-size:13px; color:#ccc;">Large eBook files can take time...</div>
</div>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

    

    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('active');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('active');
        }

        function openEditModal(ebook) {
            const form = document.getElementById('editForm');
            form.action = `/admin/ebook/${ebook.id}/update`;

            form.querySelector('[name="title"]').value = ebook.title || '';
            form.querySelector('[name="author"]').value = ebook.author || '';
            form.querySelector('[name="category"]').value = ebook.category || '';
            form.querySelector('[name="description"]').value = ebook.description || '';
            form.querySelector('[name="edition"]').value = ebook.edition || '';
            form.querySelector('[name="publisher"]').value = ebook.publisher || '';
            form.querySelector('[name="copyrightyear"]').value = ebook.copyrightyear || '';
            form.querySelector('[name="location"]').value = ebook.location || '';
            form.querySelector('[name="class"]').value = ebook.class || '';
            form.querySelector('[name="subject"]').value = ebook.subject || '';
            form.querySelector('[name="doi"]').value = ebook.doi || '';

            openModal('editModal');
        }

        // Adjust margin based on sidebar open/closed
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    const resizeObserver = new ResizeObserver(() => {
        const width = sidebar.offsetWidth;
        mainContent.style.marginLeft = width + 'px';

        
    });

    resizeObserver.observe(sidebar);


    // upload in chunks
    async function uploadInChunks() {
        const fileInput = document.getElementById('pdf');
        const hiddenFileNameInput = document.getElementById('pdf_chunked_filename');

        if (!fileInput || !hiddenFileNameInput) {
            alert('File input or hidden input is missing.');
            return;
        }

        const file = fileInput.files[0];
        if (!file) {
            alert('Please select a file.');
            return;
        }

        // SHOW loading overlay
        document.getElementById('loadingOverlay').style.display = 'flex';

        const chunkSize = 2 * 1024 * 1024; // 2MB
        const totalChunks = Math.ceil(file.size / chunkSize);
        const fileName = file.name;

        hiddenFileNameInput.value = fileName;

        for (let i = 0; i < totalChunks; i++) {
            const start = i * chunkSize;
            const end = Math.min(file.size, start + chunkSize);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('chunk', chunk);
            formData.append('file_name', fileName);
            formData.append('chunk_index', i);
            formData.append('total_chunks', totalChunks);

            try {
                await fetch('/admin/ebooks/chunk-upload', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });
            } catch (error) {
                console.error('Chunk upload failed:', error);
                alert('Failed to upload chunk ' + (i + 1));
                document.getElementById('loadingOverlay').style.display = 'none'; // Hide overlay
                return;
            }
        }

        // Hide overlay and submit form
        document.getElementById('loadingOverlay').style.display = 'none';
        document.getElementById('ebookForm').submit();
    }
    </script>
</body>
</html>
