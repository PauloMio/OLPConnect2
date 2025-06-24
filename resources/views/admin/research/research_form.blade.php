@php
    $isEdit = isset($research);
    $clearForm = session('success') && !$isEdit;
@endphp

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ $isEdit ? $research->title : ($clearForm ? '' : old('title')) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Author</label>
    <input type="text" name="author" class="form-control" value="{{ $isEdit ? $research->author : ($clearForm ? '' : old('author')) }}">
</div>

<div class="mb-3">
    <label class="form-label">Year</label>
    <input type="text" name="year" class="form-control" value="{{ $isEdit ? $research->year : ($clearForm ? '' : old('year')) }}">
</div>

<div class="mb-3">
    <label class="form-label">Accession No</label>
    <input type="text" name="accession_no" class="form-control" value="{{ $isEdit ? $research->accession_no : ($clearForm ? '' : old('accession_no')) }}">
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
    <label class="form-label">Program</label>
    <input type="text" name="program" class="form-control" value="{{ $isEdit ? $research->program : ($clearForm ? '' : old('program')) }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Department</label>
    <select name="Department" class="form-select" required>
        <option value="">-- Select Department --</option>
        @foreach($departments as $dept)
            <option value="{{ $dept->department }}"
                {{ ($isEdit && $research->Department == $dept->department) ? 'selected' : (old('Department') == $dept->department ? 'selected' : '') }}>
                {{ $dept->department }}
            </option>
        @endforeach
    </select>
</div>

