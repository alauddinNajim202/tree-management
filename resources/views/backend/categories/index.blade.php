@extends('backend.layouts.app')

@section('title', 'Categories')
@section('page_header', 'Categories')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Categories</div>
  </div>
@endsection

@section('header_button')
  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add New</a>
@endsection

@section('content')
  <h2 class="section-title">Categories</h2>
  <p class="section-lead">
    You can manage all categories, such as editing, deleting and more.
  </p>

  <div class="row">
    <div class="col-12">
      <div class="card mb-0">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="categories-table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Parent Category</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js-libraries')
  <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
@endpush

@push('page-scripts')
  <script>
    $(document).ready(function() {
      $('#categories-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.categories.index") }}',
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'image', name: 'image', orderable: false, searchable: false },
          { data: 'parent_name', name: 'parent_name', orderable: false, searchable: false },
          { data: 'status', name: 'status' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush
