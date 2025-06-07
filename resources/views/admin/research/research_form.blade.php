@php
    $isEdit = isset($research);
@endphp

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ $isEdit ? $research->title : old('title') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Author</label>
    <input type="text" name="author" class="form-control" value="{{ $isEdit ? $research->author : old('author') }}">
</div>

<div class="mb-3">
    <label class="form-label">Year</label>
    <input type="text" name="year" class="form-control" value="{{ $isEdit ? $research->year : old('year') }}">
</div>

<div class="mb-3">
    <label class="form-label">Category</label>
    <select name="category" class="form-select" required>
        <option value="">-- Select Category --</option>
        @foreach([
            'Employee Research Output',
            'Undergraduate Students’ Output',
            'Master’s Research Output',
            'Doctoral Dissertation Output',
            'Externally Published Research'
        ] as $cat)
            <option value="{{ $cat }}" {{ ($isEdit && $research->category == $cat) ? 'selected' : '' }}>
                {{ $cat }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Department</label>
    <input type="text" name="Department" class="form-control" value="{{ $isEdit ? $research->Department : old('Department') }}">
</div>
