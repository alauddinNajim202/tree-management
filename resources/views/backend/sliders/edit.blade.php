@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Slider</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $slider->title) }}">
                        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $slider->subtitle) }}">
                        @error('subtitle') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Link / URL</label>
                        <input type="text" name="link" class="form-control" value="{{ old('link', $slider->link) }}">
                        @error('link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Current Image</label><br>
                        @if($slider->image)
                            <img src="{{ asset($slider->image) }}" alt="Slider Image" style="max-width: 200px; margin-bottom: 10px;">
                        @endif
                        <input type="file" name="image" class="form-control">
                        <small class="text-muted">Leave empty to keep the current image.</small>
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Slider</button>
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
