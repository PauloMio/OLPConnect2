<style>
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 10px;
    }

    .form-group, .form-group-full {
        display: flex;
        flex-direction: column;
    }

    .form-group-full {
        grid-column: 1 / -1;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
        font-size: 0.95rem;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="file"],
    .form-group select,
    .form-group textarea,
    .form-group-full textarea {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 0.95rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        outline: none;
    }

    textarea {
        resize: vertical;
        min-height: 70px;
    }

    .modal-content {
        max-height: 90vh;
        overflow-y: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="form-grid">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title">
    </div>

    <div class="form-group">
        <label>Author</label>
        <input type="text" name="author">
    </div>

    <div class="form-group">
        <label>Category</label>
        <select name="category">
            <option value="">Select</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->category }}">{{ $cat->category }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Edition</label>
        <input type="text" name="edition">
    </div>

    <div class="form-group">
        <label>Publisher</label>
        <input type="text" name="publisher">
    </div>

    <div class="form-group">
        <label>Copyright Year</label>
        <input type="number" name="copyrightyear">
    </div>

    <div class="form-group">
        <label>Location</label>
        <select name="location">
            <option value="">Select</option>
            @foreach($locations as $loc)
                <option value="{{ $loc->location }}">{{ $loc->location }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Class</label>
        <input type="text" name="class">
    </div>

    <div class="form-group">
        <label>Subject</label>
        <input type="text" name="subject">
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <div class="form-group">
        <label>PDF File</label>
        <input type="file" name="pdf">
    </div>

    <div class="form-group">
        <label>Cover Image</label>
        <input type="file" name="coverage">
    </div>

    <div class="form-group-full">
        <label>Description</label>
        <textarea name="description" rows="3"></textarea>
    </div>

    <div class="form-group-full">
        <label>DOI</label>
        <textarea name="doi" rows="2"></textarea>
    </div>
</div>
