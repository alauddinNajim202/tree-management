@extends('backend.layouts.app')

@section('title', 'Subscribers')
@section('page_header', 'Subscribers')

@section('breadcrumb')
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Subscribers</div>
  </div>
@endsection

@section('content')
  <h2 class="section-title">Subscribers</h2>
  <p class="section-lead">
    You can manage all newsletter subscribers here.
  </p>

  <div class="row">
    <div class="col-12">
      <div class="card mb-0">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Email</th>
                  <th>Subscribed At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($subscribers as $key => $subscriber)
                <tr>
                  <td>{{ $subscribers->firstItem() + $key }}</td>
                  <td>{{ $subscriber->email }}</td>
                  <td>{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                  <td>
                    <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">No subscribers found.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="mt-4">
            {{ $subscribers->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
