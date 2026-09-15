@extends('backend.layouts.app')

@section('title', 'Create Category')
@section('page_header', 'Create Category')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
@endpush

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></div>
    <div class="breadcrumb-item">Create Category</div>
  </div>
@endsection

@section('content')
  <h2 class="section-title">Create New Category</h2>
  <p class="section-lead">
    On this page you can create a new category and fill in all fields.
  </p>

  <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>General Information</h4>
          </div>
          <div class="card-body">
            
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group mb-0">
              <label>Parent Category (Optional)</label>
              <select name="parent_id" class="form-control selectric">
                <option value="">— Select Parent Category —</option>
                @foreach ($parentCategories as $parent)
                  <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
              </select>
            </div>

          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Media & Options</h4>
          </div>
          <div class="card-body">

            <div class="form-group">
              <label>Image</label>
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>
            </div>

            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control selectric">
                <option value="1">Publish</option>
                <option value="0">Draft</option>
              </select>
            </div>

            <div class="form-group text-right mb-0">
              <button type="submit" class="btn btn-primary btn-lg">Create Category</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('js-libraries')
  <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
@endpush

@push('page-scripts')
  <script>
    $.uploadPreview({
      input_field: "#image-upload",   // Default: .image-upload
      preview_box: "#image-preview",  // Default: .image-preview
      label_field: "#image-label",    // Default: .image-label
      label_default: "Choose File",   // Default: Choose File
      label_selected: "Change File",  // Default: Change File
      no_label: false,                // Default: false
      success_callback: null          // Default: null
    });
  </script>
@endpush
