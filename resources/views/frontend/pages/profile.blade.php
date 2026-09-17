@extends('frontend.app')

@section('content')
<!-- MODERN PAGE HEADER -->
<div class="modern-page-header">
    <div class="container">
        <h1 class="page-title">Edit Profile</h1>
        <ul class="breadcrumb">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('dashboard') }}">My Account</a></li>
            <li class="active">Edit Profile</li>
        </ul>
    </div>
</div>

<div class="body-content modern-dashboard-wrapper">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="modern-sidebar">
                    <div class="sidebar-header">
                        <div class="user-avatar">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid rgba(39,174,96,0.3);">
                            @else
                                <i class="fa fa-user-circle"></i>
                            @endif
                        </div>
                        <h4 class="user-name">{{ Auth::user()->name }}</h4>
                    </div>
                    <ul class="sidebar-nav">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="fa fa-th-large"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('my-wishlist') }}">
                                <i class="fa fa-heart"></i> Wishlist
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('track-orders') }}">
                                <i class="fa fa-truck"></i> Track Orders
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="active">
                                <i class="fa fa-user"></i> Edit Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- MAIN CONTENT -->
            <div class="col-xs-12 col-sm-12 col-md-9">
                
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible" style="border-radius: var(--radius-sm);">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Your profile has been updated successfully.
                    </div>
                @endif
                
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible" style="border-radius: var(--radius-sm);">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Your password has been updated successfully.
                    </div>
                @endif

                <!-- Profile Information -->
                <div class="modern-dashboard-content" style="margin-bottom: 30px;">
                    <div class="dashboard-welcome" style="margin-bottom: 20px; padding-bottom: 15px;">
                        <h2 style="font-size: 22px;">Profile Information</h2>
                        <p>Update your account's profile information and email address.</p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="modern-form" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Avatar Upload -->
                        <div class="form-group">
                            <label class="info-title">Profile Photo</label>
                            <div class="avatar-upload-wrapper">
                                <div class="avatar-preview" id="avatarPreview">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" id="avatarImg">
                                    @else
                                        <div class="avatar-placeholder" id="avatarPlaceholder">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <img src="" alt="Avatar" id="avatarImg" style="display:none;">
                                    @endif
                                </div>
                                <div class="avatar-upload-action">
                                    <label for="avatar" class="btn btn-default avatar-upload-btn">
                                        <i class="fa fa-camera"></i> Choose Photo
                                    </label>
                                    <input type="file" name="avatar" id="avatar" accept="image/*" style="display:none;">
                                    <p class="avatar-hint">JPG, PNG or GIF. Max 2MB.</p>
                                </div>
                            </div>
                            @error('avatar')
                                <span class="text-danger" style="font-size:13px;"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="name">Name <span>*</span></label>
                            <input type="text" id="name" name="name" class="form-control unicase-form-control text-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="email">Email <span>*</span></label>
                            <input type="email" id="email" name="email" class="form-control unicase-form-control text-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                    <script>
                    document.getElementById('avatar').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(ev) {
                                const img = document.getElementById('avatarImg');
                                const placeholder = document.getElementById('avatarPlaceholder');
                                img.src = ev.target.result;
                                img.style.display = 'block';
                                if (placeholder) placeholder.style.display = 'none';
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                    </script>
                </div>

                <!-- Update Password -->
                <div class="modern-dashboard-content" style="margin-bottom: 30px;">
                    <div class="dashboard-welcome" style="margin-bottom: 20px; padding-bottom: 15px;">
                        <h2 style="font-size: 22px;">Update Password</h2>
                        <p>Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="modern-form">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label class="info-title" for="current_password">Current Password <span>*</span></label>
                            <input type="password" id="current_password" name="current_password" class="form-control unicase-form-control text-input @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password">New Password <span>*</span></label>
                            <input type="password" id="password" name="password" class="form-control unicase-form-control text-input @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                            @error('password_confirmation', 'updatePassword')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div class="modern-dashboard-content" style="border: 1px solid rgba(239, 68, 68, 0.2);">
                    <div class="dashboard-welcome" style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid rgba(239, 68, 68, 0.1);">
                        <h2 style="font-size: 22px; color: #ef4444;">Delete Account</h2>
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAccountModal">
                        Delete Account
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: var(--radius-md); border: none;">
      <form method="post" action="{{ route('profile.destroy') }}">
          @csrf
          @method('delete')
          <div class="modal-header" style="background: #f8fafc; border-radius: var(--radius-md) var(--radius-md) 0 0; padding: 20px;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="deleteAccountModalLabel" style="font-weight: 700; color: #1e293b;">Are you sure you want to delete your account?</h4>
          </div>
          <div class="modal-body" style="padding: 20px;">
            <p style="color: #64748b; margin-bottom: 20px;">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
            <div class="form-group">
                <label class="info-title" for="password_delete">Password <span>*</span></label>
                <input type="password" id="password_delete" name="password" class="form-control unicase-form-control text-input" required placeholder="Password">
                @error('password', 'userDeletion')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="modal-footer" style="background: #f8fafc; border-radius: 0 0 var(--radius-md) var(--radius-md); padding: 15px 20px;">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete Account</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection
