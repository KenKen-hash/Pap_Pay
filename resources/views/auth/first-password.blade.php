<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Change Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
font-family:Poppins,sans-serif;
}

body{

background:#081224;

display:flex;

justify-content:center;

align-items:center;

height:100vh;

}

.card{

background:rgba(255,255,255,.08);

backdrop-filter:blur(25px);

border-radius:25px;

border:1px solid rgba(255,255,255,.15);

padding:45px;

width:420px;

color:white;

}

.form-control{

background:rgba(255,255,255,.08);

color:white;

border:none;

}

.form-control:focus{

background:rgba(255,255,255,.08);

color:white;

box-shadow:none;

}

</style>

</head>

<body>

<div class="card">

<h3 class="mb-3">

<i class="bi bi-shield-lock-fill"></i>

First Login

</h3>

<p>

For security reasons, you must change your temporary password before continuing.

</p>

<form method="POST" action="{{ route('password.first.update') }}">

@csrf

<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-4">

<label>Confirm Password</label>

<input
type="password"
name="password_confirmation"
class="form-control"
required>

</div>

<button class="btn btn-primary w-100">

Save New Password

</button>

</form>

</div>

</body>

</html>