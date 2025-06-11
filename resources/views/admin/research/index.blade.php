@extends('layouts.app')

@section('content')

{{-- Sidebar --}}
    @include('tab.AdminSidebar')

    <div style="margin-left: 80px;" id="main-content">
        @yield('content')
        <div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Research Management</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add Research</button>
    </div>

    <!-- Filter -->

    <form method="GET" action="{{ route('admin.research.index') }}" class="flex gap-4 items-center mb-4">
        <select name="category" onchange="this.form.submit()" class="border rounded px-3 py-2">
            <option value="">All Categories</option>
            <option value="Employee Research Output" {{ request('category') == 'Employee Research Output' ? 'selected' : '' }}>Employee Research Output</option>
            <option value="Undergraduate Students’ Output" {{ request('category') == 'Undergraduate Students’ Output' ? 'selected' : '' }}>Undergraduate Students’ Output</option>
            <option value="Master’s Research Output" {{ request('category') == 'Master’s Research Output' ? 'selected' : '' }}>Master’s Research Output</option>
            <option value="Doctoral Dissertation Output" {{ request('category') == 'Doctoral Dissertation Output' ? 'selected' : '' }}>Doctoral Dissertation Output</option>
            <option value="Externally Published Research" {{ request('category') == 'Externally Published Research' ? 'selected' : '' }}>Externally Published Research</option>
        </select>

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or author" class="border rounded px-3 py-2" />
        
        <button class="btn btn-primary">
            Search
        </button>
    </form>


    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Category</th>
                <th>Department</th>
                <th>Actions</th>
                <th>Accession No</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($researches as $research)
            <tr>
                <td>{{ $research->title }}</td>
                <td>{{ $research->author }}</td>
                <td>{{ $research->year }}</td>
                <td>{{ $research->category }}</td>
                <td>{{ $research->Department }}</td>
                <td>{{ $research->accession_no }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $research->id }}">Edit</button>
                    <form method="POST" action="{{ route('admin.research.destroy', $research->id) }}" class="d-inline" onsubmit="return confirm('Delete this research?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $research->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $research->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.research.update', $research->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Research</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        @include('admin.research.research_form', ['research' => $research])
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            @endforeach
        </tbody>
    </table>

    {{ $researches->appends(request()->query())->links() }}

</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.research.store') }}" id="addResearchForm">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Research</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
           @include('admin.research.research_form', ['research' => null])
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </div>
    </form>
  </div>
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

    // Clear Add Research form when modal opens
    const addModal = document.getElementById('addModal');
    addModal.addEventListener('show.bs.modal', function () {
        const form = document.getElementById('addResearchForm');
        form.reset();
    });
</script>


@endsection
