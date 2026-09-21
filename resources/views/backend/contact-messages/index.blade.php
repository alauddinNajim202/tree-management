@extends('backend.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Contact Messages</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $key => $message)
                            <tr>
                                <td>{{ $messages->firstItem() + $key }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->title }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($message->comments, 50) }}</td>
                                <td>{{ $message->created_at->format('d M Y h:i A') }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-action mr-1" data-toggle="modal" data-target="#viewModal{{ $message->id }}" title="View"><i class="fas fa-eye"></i></button>
                                    
                                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Are you sure you want to delete this message?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewModal{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="formModal">Message Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <p><strong>Name:</strong> {{ $message->name }}</p>
                                                    <p><strong>Email:</strong> {{ $message->email }}</p>
                                                    <p><strong>Title:</strong> {{ $message->title }}</p>
                                                    <p><strong>Message:</strong></p>
                                                    <p style="white-space: pre-wrap; background: #f4f6f9; padding: 10px; border-radius: 5px;">{{ $message->comments }}</p>
                                                    <p><small class="text-muted">Sent on {{ $message->created_at->format('d M Y, h:i A') }}</small></p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No messages found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $messages->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
