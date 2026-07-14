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

                            <img src="{{ $employee->photo
                                ? asset('storage/'.$employee->photo)
                                : asset('images/default-avatar.png') }}"
                                class="rounded-circle border"
                                width="50"
                                height="50"
                                style="object-fit:cover;">

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

                            @if($employee->status == 'Active')

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

                                <a href="{{ route('admin.face.register',$employee->id) }}"
                                    class="btn btn-sm btn-success">

                                    <i class="bi bi-camera"></i>

                                </a>

                                <a href="#"
                                    class="btn btn-sm btn-outline-primary">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="#"
                                    class="btn btn-sm btn-outline-warning">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <button class="btn btn-sm btn-outline-danger">

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

</section>