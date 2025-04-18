@extends('layouts.master')

@section('title', 'Employees')

@section('css')
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css" rel="stylesheet" />
    <style>
        table img.rounded {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }

        .avatar-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar-container img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="card-title mb-0 flex-grow-1">Employees</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Add Employee</button>
                </div>
                <div class="card-body table-responsive">
                    <table id="employeeTable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Avatar</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Skills</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('employees.create-modal')
    @include('employees.edit-modal')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            let table = $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('employees.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'avatar', name: 'avatar', orderable: false, searchable: false },
                    { data: 'full_name', name: 'full_name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'department', name: 'department' },
                    { data: 'designation', name: 'designation' },
                    { data: 'skills', name: 'skills' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addEmployeeForm').on('submit', function (e) {
                e.preventDefault();
                let form = this;
                let formData = new FormData(form);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('employees.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (res) {
                        $('#addEmployeeModal').modal('hide');
                        form.reset();
                        $('#skills').val(null).trigger('change');
                        table.ajax.reload(null, false);
                        Swal.fire('Success!', res.success, 'success');
                    },
                    error: function (err) {
                        let errors = err.responseJSON.errors;
                        let msg = Object.values(errors).map(e => e.join(', ')).join('<br>');
                        Swal.fire('Validation Error', msg, 'error');
                    }
                });
            });

            $(document).on('click', '.editBtn', function () {
    const id = $(this).data('id');
    $.get(`/employees/${id}/edit`, function (res) {
        console.log(res);  // Log the full response to check data
        
        $('#edit_employee_id').val(res.id);
        $('#edit_full_name').val(res.full_name);
        $('#edit_email').val(res.email);
        $('#edit_mobile').val(res.mobile);
        $('#edit_department').val(res.department);
        $('#edit_designation').val(res.designation);

        // Directly set the avatar image source to the full URL
        if (res.avatar) {
            $('#edit_avatar_img').attr('src', res.avatar);  // Use the full URL directly
        } else {
            $('#edit_avatar_img').attr('src', '/images/default-avatar.png');  // Default avatar
        }

        $('#edit_skills').empty();
        res.all_skills.forEach(skill => {
            $('#edit_skills').append(
                `<option value="${skill.id}" ${res.skills.includes(skill.id) ? 'selected' : ''}>${skill.name}</option>`
            );
        });

        $('#edit_skills').select2({
            dropdownParent: $('#editEmployeeModal')
        });

        $('#editEmployeeModal').modal('show');
    });
});

            $('#editEmployeeForm').on('submit', function (e) {
                e.preventDefault();
                let id = $('#edit_employee_id').val();
                let formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: `/employees/${id}`,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function (res) {
                        $('#editEmployeeModal').modal('hide');
                        table.ajax.reload(null, false);
                        Swal.fire('Success!', res.success, 'success');
                    },
                    error: function (err) {
                        let errors = err.responseJSON.errors;
                        let msg = Object.values(errors).map(e => e.join(', ')).join('<br>');
                        Swal.fire('Validation Error', msg, 'error');
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won’t be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/employees/${id}`,
                            type: 'DELETE',
                            data: {
                                _method: 'DELETE',
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (res) {
                                table.ajax.reload(null, false);
                                Swal.fire('Deleted!', res.success, 'success');
                            },
                            error: function () {
                                Swal.fire('Error!', 'There was an issue deleting this employee.', 'error');
                            }
                        });
                    }
                });
            });

            $('#addEmployeeModal').on('shown.bs.modal', function () {
                $('#skills').select2({
                    dropdownParent: $('#addEmployeeModal')
                });
            });

            $('#editEmployeeModal').on('shown.bs.modal', function () {
                $('#edit_skills').select2({
                    dropdownParent: $('#editEmployeeModal')
                });
            });
        });
    </script>
@endsection
