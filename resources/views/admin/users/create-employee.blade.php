<form method="POST" action="{{ route('users.employee.store') }}">

    @csrf

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">Full Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                required>

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">Email</label>

            <input
                type="text"
                class="form-control"
                value="{{ $email }}"
                readonly>

            <input
                type="hidden"
                name="email"
                value="{{ $email }}">

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">Temporary Password</label>

            <input
                type="text"
                class="form-control"
                value="{{ $password }}"
                readonly>

            <input
                type="hidden"
                name="password"
                value="{{ $password }}">

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">Role</label>

            <input
                type="text"
                class="form-control"
                value="Employee"
                readonly>

            <input
                type="hidden"
                name="role"
                value="employee">

        </div>

    </div>

    <div class="mt-4">

        <button type="submit" class="btn btn-success">

            <i class="bi bi-check-circle"></i>
            Create Employee

        </button>

    </div>

</form>