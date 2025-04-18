<div class="btn-group">
    <!-- Edit Button -->
    <button type="button" class="btn btn-sm btn-primary editBtn" data-id="{{ $row->id }}" title="Edit">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Delete Button -->
    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $row->id }}" title="Delete">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>
