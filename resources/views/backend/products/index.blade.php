@extends('backend.layouts.app')

@section('title', 'Products')
@section('page_header', 'Products')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Products</div>
  </div>
@endsection

@section('header_button')
  <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New</a>
@endsection

@section('content')
  <h2 class="section-title">Products</h2>
  <p class="section-lead">
    You can manage all products, such as editing, deleting and more.
  </p>

  <div class="row">
    <div class="col-12">
      <div class="card mb-0">
        <div class="card-body">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="#">All <span class="badge badge-white">5</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Published <span class="badge badge-primary">3</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Draft <span class="badge badge-primary">1</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pending <span class="badge badge-primary">1</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Trash <span class="badge badge-primary">0</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>All Products</h4>
        </div>
        <div class="card-body">
          <div class="float-left">
            <select class="form-control selectric">
              <option>Action For Selected</option>
              <option>Move to Draft</option>
              <option>Move to Pending</option>
              <option>Delete Pemanently</option>
            </select>
          </div>
          <div class="float-right">
            <form>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-append">
                  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>

          <div class="clearfix mb-3"></div>

          <div class="table-responsive">
            <table class="table table-striped" id="products-table">
              <thead>
                <tr>
                  <th class="text-center pt-2">
                    <div class="custom-checkbox custom-checkbox-table custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                      <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                  </th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="float-right">
            <!-- Pagination handled by Datatables -->
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
      $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.products.index") }}',
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'category_name', name: 'category.name' },
          { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },
          { data: 'price', name: 'price' },
          { data: 'status', name: 'status' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
      });
    });
  </script>
@endpush
