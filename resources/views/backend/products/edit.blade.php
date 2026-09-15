@extends('backend.layouts.app')

@section('title', 'Edit Product')
@section('page_header', 'Edit Product')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></div>
    <div class="breadcrumb-item">Edit Product</div>
  </div>
@endsection

@section('content')
  <h2 class="section-title">Edit Product</h2>
  <p class="section-lead">
    On this page you can update the product information.
  </p>

  <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>General Information</h4>
          </div>
          <div class="card-body">
            
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <div class="form-group">
              <label>Category</label>
              <select name="category_id" class="form-control selectric" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="summernote-simple">{{ $product->description }}</textarea>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Discount Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="number" step="0.01" name="discount_price" class="form-control" value="{{ $product->discount_price }}">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group mb-0">
              <label>Stock</label>
              <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
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
              <label>Thumbnail</label>
              <div id="image-preview" class="image-preview" style="background-image: url('{{ $product->thumbnail ? asset($product->thumbnail) : '' }}'); background-size: cover; background-position: center center;">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="thumbnail" id="image-upload" />
              </div>
            </div>

            <div class="form-group">
              <div class="control-label">Is Featured</div>
              <label class="custom-switch mt-2">
                <input type="checkbox" name="is_featured" value="1" class="custom-switch-input" {{ $product->is_featured ? 'checked' : '' }}>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Yes, this is a featured product</span>
              </label>
            </div>

            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control selectric">
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Publish</option>
                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Draft</option>
              </select>
            </div>

            <div class="form-group text-right mb-0">
              <button type="submit" class="btn btn-primary btn-lg">Update Product</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('js-libraries')
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
@endpush

@push('page-scripts')
  <script src="{{ asset('backend/assets/js/page/features-post-create.js') }}"></script>
@endpush
