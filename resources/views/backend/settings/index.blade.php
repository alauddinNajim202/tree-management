@extends('backend.layouts.app')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Site Settings</h4>
                <p class="card-title-desc">Update your website information, logo, and social links.</p>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row mb-3">
                        <label for="site_name" class="col-sm-2 col-form-label">Site Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="site_phone" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="site_phone" id="site_phone" value="{{ $settings['site_phone'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="site_email" class="col-sm-2 col-form-label">Email Address</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="site_email" id="site_email" value="{{ $settings['site_email'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="site_address" class="col-sm-2 col-form-label">Physical Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="site_address" id="site_address" rows="3">{{ $settings['site_address'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="site_logo" class="col-sm-2 col-form-label">Site Logo</label>
                        <div class="col-sm-10">
                            @if(isset($settings['site_logo']))
                                <img src="{{ asset($settings['site_logo']) }}" alt="Site Logo" style="height: 50px; margin-bottom: 10px;">
                            @endif
                            <input class="form-control" type="file" name="site_logo" id="site_logo">
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Social Media Links</h5>

                    <div class="row mb-3">
                        <label for="facebook_url" class="col-sm-2 col-form-label">Facebook URL</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="url" name="facebook_url" id="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="twitter_url" class="col-sm-2 col-form-label">Twitter URL</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="url" name="twitter_url" id="twitter_url" value="{{ $settings['twitter_url'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="instagram_url" class="col-sm-2 col-form-label">Instagram URL</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="url" name="instagram_url" id="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="linkedin_url" class="col-sm-2 col-form-label">LinkedIn URL</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="url" name="linkedin_url" id="linkedin_url" value="{{ $settings['linkedin_url'] ?? '' }}">
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">Footer Settings</h5>

                    <div class="row mb-3">
                        <label for="footer_text" class="col-sm-2 col-form-label">Footer Copyright Text</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="footer_text" id="footer_text" value="{{ $settings['footer_text'] ?? 'Copyright © 2026. All rights reserved.' }}">
                        </div>
                    </div>

                    <h5 class="mt-4 mb-3">CMS Pages</h5>

                    <div class="row mb-3">
                        <label for="about_us" class="col-sm-2 col-form-label">About Us</label>
                        <div class="col-sm-10">
                            <textarea class="form-control summernote" name="about_us" id="about_us">{!! $settings['about_us'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="terms_conditions" class="col-sm-2 col-form-label">Terms & Conditions</label>
                        <div class="col-sm-10">
                            <textarea class="form-control summernote" name="terms_conditions" id="terms_conditions">{!! $settings['terms_conditions'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="privacy_policy" class="col-sm-2 col-form-label">Privacy Policy</label>
                        <div class="col-sm-10">
                            <textarea class="form-control summernote" name="privacy_policy" id="privacy_policy">{!! $settings['privacy_policy'] ?? '' !!}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

@push('js-libraries')
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
@endpush
