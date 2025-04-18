<!-- Edit Employee Modal -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeForm" method="POST" action="" enctype="multipart/form-data" autocomplete="on">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_employee_id" name="employee_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_full_name" class="form-label">Full Name</label>
                            <input type="text" id="edit_full_name" name="full_name" class="form-control" required autocomplete="name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_email" class="form-label">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control" required autocomplete="email">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_mobile" class="form-label">Mobile</label>
                            <input type="text" id="edit_mobile" name="mobile" class="form-control" required autocomplete="tel">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_department" class="form-label">Department</label>
                            <input type="text" id="edit_department" name="department" class="form-control" required autocomplete="organization-title">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_designation" class="form-label">Designation</label>
                            <input type="text" id="edit_designation" name="designation" class="form-control" required autocomplete="organization-title">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_skills" class="form-label">Skills</label>
                            <select class="form-control select2" id="edit_skills" name="skills[]" multiple="multiple" style="width: 100%;" autocomplete="off"></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <img id="edit_avatar_img" src="{{ asset('path/to/default/avatar.png') }}" alt="Avatar" class="img-fluid mb-3" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            <input type="file" class="form-control filepond" id="avatar" name="avatar" accept="image/*">
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
