@php
    $employee = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="adminHMD professional admin dashboard template">
  <title>Profile | adminHMD</title>

  <link rel="stylesheet" href="../../../../khen/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../../khen/assets/vendors/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../../../../khen/assets/css/style.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    <aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
      <div class="sidebar-header">
        <a class="brand-mark" href="index.html" aria-label="adminHMD dashboard">
          <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
          <span class="brand-copy">
            <span class="brand-title">adminHMD</span>
            <span class="brand-subtitle">Admin Template</span>
          </span>
        </a>
      </div>

     <nav class="sidebar-nav">
        <a class="nav-link " href="{{ route ('dashboard') }}">
          <span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
          <span class="nav-text">Dashboard</span>
        </a>
        <a class="nav-link" href="{{ route ('attendance') }}">
          <span class="nav-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
          <span class="nav-text">Attendace</span>
        </a>
        <a class="nav-link" href="{{ route ('file_leave') }}">
          <span class="nav-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
          <span class="nav-text">File Leave</span>
        </a>
         <a class="nav-link" href="{{ route ('file_ob') }}">
          <span class="nav-icon"><i class="bi bi-bar-chart-line" aria-hidden="true"></i></span>
          <span class="nav-text">File OB</span>
        </a>
         <a class="nav-link" href="{{ route ('payslip') }}">
          <span class="nav-icon"><i class="bi bi-table" aria-hidden="true"></i></span>
          <span class="nav-text">Payslip</span>
        </a>
        <a class="nav-link active" href="{{ route ('my_profile') }}" aria-current="page">
          <span class="nav-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
          <span class="nav-text">Profile</span>
        </a>
      </nav>

      <div class="sidebar-user">
        <img class="avatar-img avatar-md sidebar-user-avatar" src="{{ $employee->photo
    ? asset('storage/'.$employee->photo)
    : asset('images/default-avatar.png')
}}" alt="{{ $employee->name }}">
        <strong>{{ $employee->name }}</strong>
        <small>Active Workspace</small>
      </div>

      <div class="sidebar-footer">
        <span class="status-dot"></span>
        <span class="sidebar-footer-text">System running smoothly</span>
      </div>
    </aside>

    <div class="admin-main">
      <nav class="navbar admin-navbar navbar-expand bg-white">
        <div class="container-fluid px-3 px-lg-4">
          <button class="sidebar-toggle" type="button" data-sidebar-toggle aria-controls="adminSidebar" aria-expanded="true" aria-label="Toggle sidebar">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <form class="d-none d-md-flex ms-3 flex-grow-1"
      action="{{ route('search') }}"
      method="GET">

    <input class="form-control search-input"
           type="search"
           name="search"
           placeholder="Search attendance, leave, payroll..."
           required>

</form>

          <div class="navbar-actions ms-auto">
            <button class="icon-button theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
              <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
            </button>
            <div class="dropdown">
              <button class="icon-button" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications">
                <span class="notification-dot"></span>
                <i class="bi bi-bell" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end notification-menu">
                <div class="dropdown-header fw-bold text-body">Notifications</div>
                <a class="dropdown-item" href="users.html">
                  <span class="notification-title">New user registered</span>
                  <span class="notification-time">4 minutes ago</span>
                </a>
                <a class="dropdown-item" href="charts.html">
                  <span class="notification-title">Revenue target reached</span>
                  <span class="notification-time">32 minutes ago</span>
                </a>
                <a class="dropdown-item" href="settings.html">
                  <span class="notification-title">Security review completed</span>
                  <span class="notification-time">1 hour ago</span>
                </a>
              </div>
            </div>

            <div class="dropdown">
              <button class="profile-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="avatar-img avatar-sm" src="{{ $employee->photo
    ? asset('storage/'.$employee->photo)
    : asset('images/default-avatar.png')
}}" alt="{{ $employee->name }}">
                <span class="profile-name d-none d-sm-inline">{{ $employee->name }}</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route ('my_profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="settings.html">Account settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="login.html">Sign out</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <main class="dashboard-content">
        <div class="container-fluid px-3 px-lg-4 py-4">
          <div class="page-heading">
            <div class="page-heading-copy">
              <span class="page-icon"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
              <div>
                <p class="eyebrow mb-1">Account</p>
                <h1 class="h3 mb-1">Profile</h1>
                <p class="text-muted mb-0">Manage your personal details, bio, and contact preferences.</p>
              </div>
            </div>
            
          </div>

         <section class="row g-3">

    <!-- LEFT SIDE -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100 text-center profile-card">

            <div class="profile-cover">
                <img src="{{ asset('khen/assets/images/image.png') }}"
                     alt="Pap Pay Cover">
            </div>

            <img class="avatar-img avatar-xl profile-photo"
                 src="{{ $employee->photo
                    ? asset('storage/'.$employee->photo)
                    : asset('images/default-avatar.png') }}"
                 alt="{{ $employee->name }}">

            <h2 class="h5 mt-3 mb-1">
                {{ $employee->name }}
            </h2>

            <p class="text-muted mb-3">
                {{ $employee->position }}
            </p>

            <div class="d-flex justify-content-center gap-2">
                <span class="badge text-bg-primary">
                    {{ $employee->department }}
                </span>

                <span class="badge text-bg-success">
                    {{ $employee->status }}
                </span>
            </div>

            <hr>

            <div class="info-list mt-3 text-start">

                <div class="mb-3">
                    <span class="text-muted">Employee ID</span>
                    <strong class="d-block">
                        {{ $employee->employee_id }}
                    </strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted">Email</span>
                    <strong class="d-block">
                        {{ $employee->email }}
                    </strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted">Contact Number</span>
                    <strong class="d-block">
                        {{ $employee->contact_number ?? 'Not Set' }}
                    </strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted">Employment Type</span>
                    <strong class="d-block">
                        {{ $employee->employment_type ?? 'Regular' }}
                    </strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted">Hire Date</span>
                    <strong class="d-block">
                        {{ $employee->hire_date ?? 'Not Available' }}
                    </strong>
                </div>

                <div class="mb-3">
                    <span class="text-muted">Status</span>
                    <strong class="d-block">
                        {{ $employee->status }}
                    </strong>
                </div>

            </div>

        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-12 col-xl-8">

        <form
            action="{{ route('my_profile.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="panel">

            @csrf
            @method('PATCH')

            <div class="panel-header">
                <h4>Edit Profile</h4>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row g-3">

                <!-- PHOTO -->
                <div class="col-12">
                    <label class="form-label">
                        Profile Photo
                    </label>

                    <input
                        type="file"
                        name="photo"
                        class="form-control">
                </div>

                <!-- NAME -->
                <div class="col-md-4">
                    <label class="form-label">
                        First Name
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        value="{{ old('first_name', $employee->first_name) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">
                        Middle Name
                    </label>

                    <input
                        type="text"
                        name="middle_name"
                        class="form-control"
                        value="{{ old('middle_name', $employee->middle_name) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">
                        Last Name
                    </label>

                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        value="{{ old('last_name', $employee->last_name) }}">
                </div>

                <!-- CONTACT -->
                <div class="col-md-6">
                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $employee->email) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Contact Number
                    </label>

                    <input
                        type="text"
                        name="contact_number"
                        class="form-control"
                        value="{{ old('contact_number', $employee->contact_number) }}">
                </div>

                <!-- PERSONAL -->
                <div class="col-md-6">
                    <label class="form-label">
                        Gender
                    </label>

                    <select
                        name="gender"
                        class="form-control">

                        <option value="">Select</option>

                        <option value="Male"
                            {{ $employee->gender == 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ $employee->gender == 'Female' ? 'selected' : '' }}>
                            Female
                        </option>

                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Birth Date
                    </label>

                    <input
                        type="date"
                        name="birth_date"
                        class="form-control"
                        value="{{ $employee->birth_date }}">
                </div>

                <!-- ADDRESS -->
                <div class="col-12">
                    <label class="form-label">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control">{{ old('address', $employee->address) }}</textarea>
                </div>

                <!-- EMERGENCY CONTACT -->
                <div class="col-md-6">
                    <label class="form-label">
                        Emergency Contact Person
                    </label>

                    <input
                        type="text"
                        name="emergency_contact_person"
                        class="form-control"
                        value="{{ old('emergency_contact_person', $employee->emergency_contact_person) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Emergency Contact Number
                    </label>

                    <input
                        type="text"
                        name="emergency_contact_number"
                        class="form-control"
                        value="{{ old('emergency_contact_number', $employee->emergency_contact_number) }}">
                </div>

                <!-- BIO -->
                <div class="col-12">
                    <label class="form-label">
                        Bio
                    </label>

                    <textarea
                        name="bio"
                        rows="4"
                        class="form-control">{{ old('bio', $employee->bio) }}</textarea>
                </div>

                <!-- PASSWORD -->
                <div class="col-12">
                    <label class="form-label">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                    <small class="text-muted">
                        Leave blank if you don't want to change it.
                    </small>
                </div>

                <div class="col-12 text-end">
                    <button
                        type="submit"
                        class="btn btn-primary">

                        Save Changes
                    </button>
                </div>

            </div>

        </form>

    </div>

</section>
        </div>
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 adminHMD. <br> Developed by <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Md. Hasan Mahmud</a> • Distributed by <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a> </span>
          <span>Professional dashboard template.</span>
          <span>Profile management page.</span>
        </div>
      </footer>
    </div>
  </div>

  <script src="..../../../../khen//assets/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../../khen/assets/js/main.js"></script>
</body>
</html>
