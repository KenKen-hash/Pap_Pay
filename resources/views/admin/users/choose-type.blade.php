@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-9">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-5">

                        <div class="avatar-circle mb-4">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>

                        <h2 class="fw-bold mb-2">
                            Create New User
                        </h2>

                        <p class="text-muted">
                            Select the type of account you want to create.
                        </p>

                    </div>

                    <form action="{{ route('users.redirect') }}" method="POST">

                        @csrf

                        <div class="row g-4">

                            <!-- Employee -->

                            <div class="col-md-6">

                                <input
                                    class="btn-check"
                                    type="radio"
                                    name="role"
                                    id="employee"
                                    value="employee"
                                    checked>

                                <label class="selection-card" for="employee">

                                    <div class="icon employee">

                                        <i class="bi bi-person-workspace"></i>

                                    </div>

                                    <h4 class="mt-4 fw-bold">
                                        Employee
                                    </h4>

                                    <p class="text-muted mb-0">

                                        Faculty, Staff, Maintenance,
                                        Laborers and other personnel.

                                    </p>

                                </label>

                            </div>

                            <!-- Admin -->

                            <div class="col-md-6">

                                <input
                                    class="btn-check"
                                    type="radio"
                                    name="role"
                                    id="admin"
                                    value="admin">

                                <label class="selection-card" for="admin">

                                    <div class="icon admin">

                                        <i class="bi bi-shield-lock-fill"></i>

                                    </div>

                                    <h4 class="mt-4 fw-bold">
                                        Administrator
                                    </h4>

                                    <p class="text-muted mb-0">

                                        HR, Payroll Officer,
                                        Finance Administrator.

                                    </p>

                                </label>

                            </div>

                        </div>

                        <div class="d-grid mt-5">

                            <button class="btn btn-primary btn-lg rounded-3">

                                Continue
                                <i class="bi bi-arrow-right ms-2"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<style>

body{
    background:#f4f7fb;
}

.avatar-circle{

    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:linear-gradient(135deg,#0d6efd,#5b8cff);

    display:flex;
    align-items:center;
    justify-content:center;

    color:#fff;
    font-size:38px;

}

.selection-card{

    display:block;

    border:2px solid #e9ecef;

    border-radius:18px;

    padding:40px 30px;

    background:#fff;

    text-align:center;

    transition:.30s;

    cursor:pointer;

    height:100%;

}

.selection-card:hover{

    transform:translateY(-8px);

    border-color:#0d6efd;

    box-shadow:0 20px 35px rgba(0,0,0,.08);

}

.btn-check:checked + .selection-card{

    border-color:#0d6efd;

    background:#f8fbff;

    box-shadow:0 20px 40px rgba(13,110,253,.18);

}

.icon{

    width:85px;

    height:85px;

    border-radius:20px;

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

    margin:auto;

    font-size:34px;

}

.employee{

    background:linear-gradient(135deg,#3b82f6,#2563eb);

}

.admin{

    background:linear-gradient(135deg,#10b981,#059669);

}

.card{

    overflow:hidden;

}

</style>

@endsection