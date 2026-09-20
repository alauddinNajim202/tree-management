@extends('backend.layouts.app')

@section('title', 'Central Inventory')
@section('page_header', 'Central Inventory')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/izitoast/css/iziToast.min.css') }}">
@endpush

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Inventory</div>
  </div>
@endsection

@section('content')
  <h2 class="section-title">Central Inventory Management</h2>
  <p class="section-lead">
    Manage your product stock quantities quickly without opening each product.
  </p>

  <div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Product Inventory</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="inventory-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Current Stock</th>
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
  <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
@endpush

@push('page-scripts')
  <script>
    $(document).ready(function() {
      // Initialize DataTable
      var table = $('#inventory-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.inventory.index") }}',
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          { data: 'thumbnail', name: 'thumbnail', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'category_name', name: 'category.name' },
          { data: 'stock', name: 'stock', orderable: false, searchable: false }
        ]
      });

      // Handle Stock Update via AJAX
      $(document).on('click', '.save-stock-btn', function() {
          var btn = $(this);
          var productId = btn.data('id');
          var stockValue = $('#stock-' + productId).val();
          
          // Show loading state
          var originalIcon = btn.html();
          btn.html('<i class="fas fa-spinner fa-spin"></i>');
          btn.prop('disabled', true);

          $.ajax({
              url: '{{ route("admin.inventory.update") }}',
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}',
                  id: productId,
                  stock: stockValue
              },
              success: function(response) {
                  if (response.success) {
                      iziToast.success({
                          title: 'Success',
                          message: response.message,
                          position: 'topRight'
                      });
                  }
              },
              error: function(xhr) {
                  var errorMessage = 'Something went wrong!';
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                      errorMessage = xhr.responseJSON.message;
                  }
                  iziToast.error({
                      title: 'Error',
                      message: errorMessage,
                      position: 'topRight'
                  });
              },
              complete: function() {
                  // Restore button state
                  btn.html(originalIcon);
                  btn.prop('disabled', false);
              }
          });
      });
    });
  </script>
@endpush
