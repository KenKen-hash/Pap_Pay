<section class="panel mt-4">

    <div class="panel-header d-flex justify-content-between align-items-center">

        <div>

            <h2 class="h5 mb-1 section-title">

                <i class="bi bi-building text-primary"></i>

                {{ $title }}

            </h2>

            <p class="text-muted mb-0">

                {{ $employees->count() }} Employee(s)

            </p>

        </div>

        <span class="badge bg-primary fs-6 px-3 py-2">

            {{ $employees->count() }}

        </span>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="80">Photo</th>

                    <th>Employee ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Position</th>

                    <th>Status</th>

                    <th>Hire Date</th>

                    <th width="170">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($employees as $employee)
                    <tr>

                        <td>

                            <img src="{{ $employee->photo ? asset('storage/' . $employee->photo) : asset('images/default-avatar.png') }}"
                                class="rounded-circle border" width="50" height="50" style="object-fit:cover;">

                        </td>

                        <td>

                            <strong>

                                {{ $employee->employee_id }}

                            </strong>

                        </td>

                        <td>

                            {{ $employee->first_name }}

                            {{ $employee->last_name }}

                        </td>

                        <td>

                            {{ $employee->email }}

                        </td>

                        <td>

                            {{ $employee->position }}

                        </td>

                        <td>

                            @if ($employee->status == 'Active')
                                <span class="badge bg-success">

                                    {{ $employee->status }}

                                </span>
                            @else
                                <span class="badge bg-secondary">

                                    {{ $employee->status }}

                                </span>
                            @endif

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}

                        </td>

                        <td>

                            <div class="d-flex gap-1">

                                <a href="{{ route('admin.face.register', $employee->id) }}"
                                    class="btn btn-sm btn-success">

                                    <i class="bi bi-camera"></i>

                                </a>

                                <button type="button" class="btn btn-sm btn-outline-primary viewEmployee"
                                    data-url="{{ route('employees.show', $employee) }}">

                                    <i class="bi bi-eye"></i>

                                </button>

                                <button type="button" class="btn btn-sm btn-outline-warning editEmployee"
                                    data-url="{{ route('employees.edit', $employee) }}">

                                    <i class="bi bi-pencil"></i>

                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger deactivateEmployee"
                                    data-id="{{ $employee->id }}"
                                    data-name="{{ $employee->first_name }} {{ $employee->last_name }}">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center py-5">

                            <i class="bi bi-people display-6 text-secondary"></i>

                            <br>

                            <strong>No employees found.</strong>

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="modal fade" id="employeeModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Employee Information

                    </h5>

                    <button class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div id="employeeDetails">

                        Loading...

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form id="editEmployeeForm">

                    @csrf
                    @method('PUT')

                    <input type="hidden" name="_method" value="PUT">



                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmployeeModalLabel">
                            <i class="bi bi-pencil-square text-warning"></i>
                            Edit Employee
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <input type="hidden" id="employee_id">

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact_number" name="contact_number">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control" id="department" name="department">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Position</label>
                                <input type="text" class="form-control" id="position" name="position">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Employment Type</label>
                                <input type="text" class="form-control" id="employment_type"
                                    name="employment_type">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status</label>

                                <select class="form-select" id="status" name="status">

                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>

                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Salary Grade</label>
                                <input type="text" class="form-control" id="salary_grade" name="salary_grade">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Birth Date</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emergency Contact Person</label>
                                <input type="text" class="form-control" id="emergency_contact_person"
                                    name="emergency_contact_person">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Emergency Contact Number</label>
                                <input type="text" class="form-control" id="emergency_contact_number"
                                    name="emergency_contact_number">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit" class="btn btn-warning">

                            <i class="bi bi-check-circle"></i>

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ===========================
     Deactivate Employee Modal
=========================== -->

    <div class="modal fade" id="deactivateEmployeeModal" tabindex="-1">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header bg-warning">

                    <h5 class="modal-title">

                        <i class="bi bi-person-dash-fill"></i>

                        Deactivate Employee

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body text-center">

                    <i class="bi bi-exclamation-triangle-fill text-warning display-4"></i>

                    <h4 class="mt-3">

                        Are you sure?

                    </h4>

                    <p>

                        You are about to deactivate

                        <strong id="deactivateEmployeeName"></strong>

                    </p>

                    <p class="text-muted">

                        The employee will no longer be able to access the system.

                        Payroll and attendance records will remain.

                    </p>

                    <input type="hidden" id="deactivateEmployeeId">

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button id="confirmDeactivateEmployee" class="btn btn-warning">

                        <i class="bi bi-person-dash-fill"></i>

                        Deactivate

                    </button>

                </div>

            </div>

        </div>

    </div>

</section>
