@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Turfs</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTurfModal">
                        <i class="fas fa-plus"></i> Add New Turf
                    </button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Turf 1">
                                <div class="card-body">
                                    <h5 class="card-title">Turf 1 - Football</h5>
                                    <p class="card-text">Professional football turf with natural grass.</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success">Available</span>
                                        <span class="text-primary fw-bold">$50/hour</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Status: Active</small>
                                        <small class="text-muted">Bookings: 5 today</small>
                                    </div>
                                    <div class="btn-group w-100" role="group">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editTurf(1)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="toggleTurfStatus(1)">
                                            <i class="fas fa-pause"></i> Disable
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteTurf(1)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Turf 2">
                                <div class="card-body">
                                    <h5 class="card-title">Turf 2 - Cricket</h5>
                                    <p class="card-text">Cricket ground with proper pitch and facilities.</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success">Available</span>
                                        <span class="text-primary fw-bold">$60/hour</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Status: Active</small>
                                        <small class="text-muted">Bookings: 3 today</small>
                                    </div>
                                    <div class="btn-group w-100" role="group">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editTurf(2)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="toggleTurfStatus(2)">
                                            <i class="fas fa-pause"></i> Disable
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteTurf(2)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Turf 3">
                                <div class="card-body">
                                    <h5 class="card-title">Turf 3 - Tennis</h5>
                                    <p class="card-text">Tennis court with professional surface.</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-warning">Maintenance</span>
                                        <span class="text-primary fw-bold">$40/hour</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Status: Maintenance</small>
                                        <small class="text-muted">Bookings: 0 today</small>
                                    </div>
                                    <div class="btn-group w-100" role="group">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editTurf(3)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="toggleTurfStatus(3)">
                                            <i class="fas fa-play"></i> Enable
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteTurf(3)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Turf 4">
                                <div class="card-body">
                                    <h5 class="card-title">Turf 4 - Multi-Sport</h5>
                                    <p class="card-text">Versatile turf for multiple sports activities.</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success">Available</span>
                                        <span class="text-primary fw-bold">$45/hour</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Status: Active</small>
                                        <small class="text-muted">Bookings: 7 today</small>
                                    </div>
                                    <div class="btn-group w-100" role="group">
                                        <button class="btn btn-outline-primary btn-sm" onclick="editTurf(4)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="toggleTurfStatus(4)">
                                            <i class="fas fa-pause"></i> Disable
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="deleteTurf(4)">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Turf Modal -->
<div class="modal fade" id="addTurfModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Turf</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="turfName" class="form-label">Turf Name</label>
                        <input type="text" class="form-control" id="turfName" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="turfType" class="form-label">Sport Type</label>
                        <select class="form-control" id="turfType" name="type" required>
                            <option value="">Select Sport Type</option>
                            <option value="football">Football</option>
                            <option value="cricket">Cricket</option>
                            <option value="tennis">Tennis</option>
                            <option value="multi-sport">Multi-Sport</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="turfDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="turfDescription" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="turfPrice" class="form-label">Price per Hour ($)</label>
                        <input type="number" class="form-control" id="turfPrice" name="price" min="0" step="0.01" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="turfStatus" class="form-label">Status</label>
                        <select class="form-control" id="turfStatus" name="status" required>
                            <option value="active">Active</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Turf</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editTurf(turfId) {
    // Implementation for editing turf
    alert('Edit turf with ID: ' + turfId);
}

function toggleTurfStatus(turfId) {
    // Implementation for toggling turf status
    alert('Toggle status for turf ID: ' + turfId);
}

function deleteTurf(turfId) {
    if (confirm('Are you sure you want to delete this turf?')) {
        // Implementation for deleting turf
        alert('Delete turf with ID: ' + turfId);
    }
}
</script>
@endsection
