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
        @foreach ($categories as $category)
            <option value="{{ $category->category }}"
                {{ ($isEdit && $research->category == $category->category) ? 'selected' : (old('category') == $category->category ? 'selected' : '') }}>
                {{ $category->category }}
            </option>
        @endforeach
    </select>
</div>


<div class="mb-3">
    <label class="form-label">Program</label>
    <select name="program" class="form-select" required>
        <option value="">-- Select Program --</option>
        @foreach($programs as $prog)
            <option value="{{ $prog->program }}"
                {{ ($isEdit && $research->program == $prog->program) ? 'selected' : (old('program') == $prog->program ? 'selected' : '') }}>
                {{ $prog->program }}
            </option>
        @endforeach
    </select>
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

