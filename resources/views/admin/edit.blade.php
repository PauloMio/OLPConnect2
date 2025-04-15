<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eBook Setup</title>
    <style>
        /* Add some simple styling for the table and modal */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .button {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Update eBook</h2>

    <div class="TopControl">
        <a href="{{ route('admin.create') }}"><button type="button" class="button">Upload eBook</button></a>
    </div>

    <div class="eBook Table">
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            @foreach($ebooks as $ebook)
            <tr>
                <td>{{ $ebook->title }}</td>
                <td>{{ $ebook->author }}</td>
                <td>{{ $ebook->category }}</td>
                <td>
                    <button class="button" onclick="openModal({{ $ebook->id }})">Edit</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Modal for editing eBook -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit eBook</h2>
            <form id="editForm" action="{{ route('ebook.update', 'ID_PLACEHOLDER') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" id="ebookId" name="id">

                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required><br><br>

                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required><br><br>

                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Filipiniana">Filipiniana</option>
                    <option value="Fiction">Fiction</option>
                    <option value="General Reference">General Reference</option>
                    <option value="Encyclopedia">Encyclopedia</option>
                    <option value="Senior High School">Senior High School</option>
                    <option value="Undergraduate">Undergraduate</option>
                    <option value="Graduate School">Graduate School</option>
                </select><br><br>

                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea><br><br>

                <label for="pdf">Upload PDF:</label>
                <input type="file" id="pdf" name="pdf"><br><br>

                <label for="coverage">Upload Cover:</label>
                <input type="file" id="coverage" name="coverage"><br><br>

                <button type="submit" class="button">Update eBook</button>
            </form>
        </div>
    </div>

    <div class="LogOut">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="button">Log out</button>
        </form>
    </div>

    <script>
        // Function to open the modal
        function openModal(ebookId) {
            var modal = document.getElementById("editModal");
            var form = document.getElementById("editForm");

            // Populate the modal with the current ebook's data
            fetch(`/ebooks/${ebookId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("ebookId").value = data.id;
                    document.getElementById("title").value = data.title;
                    document.getElementById("author").value = data.author;
                    document.getElementById("category").value = data.category;
                    document.getElementById("description").value = data.description;
                    form.action = form.action.replace('ID_PLACEHOLDER', data.id);
                });

            modal.style.display = "block";
        }

        // Function to close the modal
        function closeModal() {
            var modal = document.getElementById("editModal");
            modal.style.display = "none";
        }

        // Close modal if clicked outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("editModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
