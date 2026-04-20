@extends('user.layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/my-requests.css') }}">

<div class="requests-container">
    <!-- Page Header -->
    <div class="requests-header">
        <div class="header-content">
            <h2><i class="fas fa-recycle"></i> My Requests</h2>
            <p class="header-subtitle">Track and manage your waste collection requests</p>
        </div>
        <a href="" class="new-request-btn">
            <i class="fas fa-plus"></i> New Request
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Requests Table -->
    @if($requests->count())
        <div class="requests-table-container">
            <div class="table-wrapper">
                <table class="requests-table">
                    <thead>
                        <tr>
                            <th><i class="fas fa-map-marker-alt"></i> Address</th>
                            <th><i class="fas fa-landmark"></i> Landmark</th>
                            <th><i class="fas fa-camera"></i> Photo</th>
                            <th><i class="fas fa-comment"></i> Message</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-calendar"></i> Requested At</th>
                            <th><i class="fas fa-cog"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr class="request-row">
                                <td class="address-cell">
                                    <div class="address-content">
                                        <span class="address-text">{{ $request->address }}</span>
                                    </div>
                                </td>
                                <td class="landmark-cell">
                                    <span class="landmark-text">{{ $request->landmark ?? '-' }}</span>
                                </td>
                                <td class="photo-cell">
                                    @if($request->photo)
                                        <div class="photo-container">
                                            <img src="{{ asset('storage/' . $request->photo) }}" 
                                                 alt="Waste Photo" 
                                                 class="waste-photo"
                                                 onclick="openPhotoModal(this.src)">
                                        </div>
                                    @else
                                        <div class="no-photo">
                                            <i class="fas fa-image"></i>
                                            <span>No Photo</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="message-cell">
                                    <div class="message-content">
                                        <span class="message-text">{{ Str::limit($request->message, 50) }}</span>
                                        @if(strlen($request->message) > 50)
                                            <button class="show-more-btn" onclick="showFullMessage('{{ $request->id }}')">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="status-cell">
                                    <span class="status-badge status-{{ strtolower($request->status) }}">
                                        <i class="fas fa-{{ $request->status === 'pending' ? 'clock' : ($request->status === 'completed' ? 'check' : 'cog') }}"></i>
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="date-cell">
                                    <div class="date-content">
                                        @if($request->created_at)
                                            <span class="date-text">{{ $request->created_at->format('d M Y') }}</span>
                                            <span class="time-text">{{ $request->created_at->format('h:i A') }}</span>
                                        @else
                                            <span class="date-text">N/A</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="actions-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('user.my-requests-edit', $request->id) }}" 
                                           class="action-btn edit-btn" 
                                           title="Edit Request">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('user.my-requests-delete', $request->id) }}" 
                                           class="action-btn delete-btn" 
                                           title="Delete Request"
                                           onclick="return confirm('Are you sure you want to delete this request?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination if needed -->
        @if(method_exists($requests, 'links'))
            <div class="pagination-wrapper">
                {{ $requests->links() }}
            </div>
        @endif
    @else
        <div class="no-requests">
            <div class="no-requests-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h3>No Requests Found</h3>
            <p>You haven't submitted any waste collection requests yet.</p>
            <a href="{{ route('user.waste-request') }}" class="create-first-request-btn">
                <i class="fas fa-plus"></i> Create Your First Request
            </a>
        </div>
    @endif
</div>

<!-- Photo Modal -->
<div id="photoModal" class="photo-modal" onclick="closePhotoModal()">
    <div class="photo-modal-content">
        <span class="photo-modal-close">&times;</span>
        <img id="modalPhoto" src="" alt="Waste Photo">
    </div>
</div>

<!-- Full Message Modal -->
<div id="messageModal" class="message-modal">
    <div class="message-modal-content">
        <div class="message-modal-header">
            <h4>Full Message</h4>
            <span class="message-modal-close" onclick="closeMessageModal()">&times;</span>
        </div>
        <div class="message-modal-body">
            <p id="fullMessageText"></p>
        </div>
    </div>
</div>

<script>
function openPhotoModal(src) {
    document.getElementById('photoModal').style.display = 'block';
    document.getElementById('modalPhoto').src = src;
}

function closePhotoModal() {
    document.getElementById('photoModal').style.display = 'none';
}

function showFullMessage(requestId) {
    // You can implement this to show full message in modal
    // For now, it's a placeholder
    const messageModal = document.getElementById('messageModal');
    messageModal.style.display = 'block';
}

function closeMessageModal() {
    document.getElementById('messageModal').style.display = 'none';
}

// Close modals when clicking outside
window.onclick = function(event) {
    const photoModal = document.getElementById('photoModal');
    const messageModal = document.getElementById('messageModal');
    
    if (event.target === photoModal) {
        closePhotoModal();
    }
    if (event.target === messageModal) {
        closeMessageModal();
    }
}
</script>
@endsection