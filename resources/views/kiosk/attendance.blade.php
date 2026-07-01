<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pap Pay Face Attendance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#0f172a;
    font-family:Segoe UI;
}

.card{
    border-radius:20px;
}

#webcam{
    width:100%;
    height:600px;
    object-fit:cover;
    border-radius:15px;
    background:black;
}

#overlay{
    position:absolute;
    top:0;
    left:0;
}

.camera-container{
    position:relative;
}

.status{
    font-size:24px;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">

Pap Pay Face Recognition Attendance

</h2>

<div class="camera-container">

<video
id="webcam"
autoplay
playsinline
muted>
</video>

<canvas id="overlay"></canvas>

</div>

<div
id="status"
class="text-center text-success mt-4 status">

Initializing Camera...

</div>

</div>

</div>

</div>

</div>

</div>

<!-- TensorFlow -->
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>

<!-- MediaPipe -->
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_detection"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils"></script>

<script src="{{ asset('js/kiosk/kiosk.js') }}"></script>
<script src="{{ asset('js/kiosk/recognition.js') }}"></script>
<script src="{{ asset('js/kiosk/attendance.js') }}"></script>

</body>
</html>