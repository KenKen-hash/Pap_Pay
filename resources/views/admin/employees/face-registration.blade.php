<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>PapPay | Face Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="/js/face-api.min.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{

background:
linear-gradient(135deg,#061826,#091b33,#132d52);

min-height:100vh;

overflow-x:hidden;

color:white;

}

body::before{

content:"";

position:fixed;

width:500px;

height:500px;

border-radius:50%;

background:#2563eb55;

top:-200px;

left:-150px;

filter:blur(120px);

}

body::after{

content:"";

position:fixed;

width:400px;

height:400px;

border-radius:50%;

background:#00d4ff33;

bottom:-150px;

right:-120px;

filter:blur(120px);

}

.wrapper{

padding:40px;

position:relative;

z-index:10;

}

.header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}

.logo{

font-size:35px;

font-weight:700;

letter-spacing:1px;

}

.logo span{

color:#29b6ff;

}

.back-btn{

background:#2563eb;

border:none;

padding:12px 25px;

border-radius:15px;

color:white;

transition:.3s;

}

.back-btn:hover{

background:#1d4ed8;

transform:translateY(-2px);

}

.main{

display:grid;

grid-template-columns:2fr 1fr;

gap:30px;

}

.glass{

background:rgba(255,255,255,.05);

backdrop-filter:blur(20px);

border:1px solid rgba(255,255,255,.1);

border-radius:25px;

box-shadow:0 10px 40px rgba(0,0,0,.4);

}

.camera-card{

padding:25px;

position:relative;

}

.card-title{

font-size:22px;

margin-bottom:20px;

font-weight:600;

}

.camera-box{

position:relative;

border-radius:20px;

overflow:hidden;

background:black;

}

#webcam{

width:100%;

display:block;

}

#overlay{

position:absolute;

top:0;

left:0;

}

.scan-line{

position:absolute;

left:0;

width:100%;

height:3px;

background:#00e5ff;

box-shadow:0 0 25px cyan;

animation:scan 3s linear infinite;

}

@keyframes scan{

0%{

top:0;

}

50%{

top:95%;

}

100%{

top:0;

}

}

.side{

display:flex;

flex-direction:column;

gap:25px;

}

.employee-card{

padding:25px;

}

.avatar{

width:90px;

height:90px;

border-radius:50%;

background:linear-gradient(135deg,#2563eb,#00c6ff);

display:flex;

align-items:center;

justify-content:center;

font-size:35px;

font-weight:bold;

margin:auto;

margin-bottom:20px;

}

.emp-name{

text-align:center;

font-size:24px;

font-weight:bold;

margin-bottom:5px;

}

.emp-position{

text-align:center;

color:#9ec9ff;

margin-bottom:20px;

}

.info{

display:flex;

justify-content:space-between;

padding:13px 0;

border-bottom:1px solid rgba(255,255,255,.08);

}

.info span:first-child{

color:#9ab5d9;

}

.info span:last-child{

font-weight:600;

}

.status-card{

padding:25px;

}

.status{

display:flex;

align-items:center;

margin-bottom:18px;

}

.dot{

width:14px;

height:14px;

border-radius:50%;

background:#ef4444;

margin-right:15px;

}

.active{

background:#00ff88;

box-shadow:0 0 15px #00ff88;

}

.progress{

height:16px;

margin-top:20px;

background:#10263e;

border-radius:30px;

overflow:hidden;

}

.progress-bar{

width:0%;

background:linear-gradient(90deg,#2563eb,#00e5ff);

}

.instruction{

margin-top:20px;

padding:15px;

border-radius:15px;

background:#0d2139;

font-size:18px;

text-align:center;

}

.controls{

display:flex;

gap:15px;

margin-top:25px;

}

.controls button{

flex:1;

padding:15px;

border:none;

border-radius:15px;

font-size:17px;

font-weight:bold;

transition:.3s;

}

#startBtn{

background:#00b894;

color:white;

}

#startBtn:hover{

transform:translateY(-3px);

}

#cancelBtn{

background:#ef4444;

color:white;

}

@media(max-width:992px){

.main{

grid-template-columns:1fr;

}

}

@media(max-width:600px){

.wrapper{

padding:15px;

}

.logo{

font-size:25px;

}

.card-title{

font-size:18px;

}

}

</style>

</head>

<body>

<div class="wrapper">

<div class="header">

<div class="logo">

Pap<span>Pay</span>

<div style="font-size:15px;color:#90caf9;">

Biometric Face Registration

</div>

</div>

<button class="back-btn">

<a href="{{ route('employees.index') }}" class="back-btn" style="text-decoration:none;">
← Employee List
</a>
</button>

</div>

<div class="main">

<div class="glass camera-card">

<div class="card-title">

Live Camera

</div>

<div class="camera-box">

<video
id="webcam"
autoplay
muted
playsinline></video>

<canvas id="overlay"></canvas>

<div class="scan-line"></div>

</div>
<div style="margin-top:25px;">

<div style="display:flex;justify-content:space-between;margin-bottom:8px;">

<span>Detection Status</span>

<span id="statusText" style="color:#00ff88;">Initializing...</span>

</div>

<div class="progress">

<div
class="progress-bar"
id="progressBar">
</div>

</div>

<div
style="
margin-top:15px;
display:flex;
justify-content:space-between;
color:#8db8e8;">

<span>Captured</span>

<span id="captureCount">0 / 15</span>

</div>

<div
class="instruction"
id="instruction">

Press START to begin registration

</div>

<div class="controls">

<button id="startBtn">

START REGISTRATION

</button>

<button id="cancelBtn">

CANCEL

</button>

</div>

</div>

</div>

<div class="side">

<div class="glass employee-card">

<div class="avatar">

{{ strtoupper(substr($user->name,0,1)) }}

</div>

<div class="emp-name">

{{ $user->name }}

</div>

<div class="emp-position">

Employee

</div>

<div class="info">

<span>Employee ID</span>

<span>{{ $user->employee_id }}</span>

</div>

<div class="info">

<span>Email</span>

<span>{{ $user->email }}</span>

</div>

<div class="info">

<span>Department</span>

<span>{{ $user->department ?? 'N/A' }}</span>

</div>

<div class="info">

<span>Face Registered</span>

<span>

@if($user->face_registered)

<font color="#00ff88">

YES

</font>

@else

<font color="#ff4d4d">

NO

</font>

@endif

</span>

</div>

</div>

<div class="glass status-card">

<h5 style="margin-bottom:25px;">

AI STATUS

</h5>

<div class="status">

<div
class="dot"
id="cameraDot">
</div>

Camera Ready

</div>

<div class="status">

<div
class="dot"
id="modelDot">
</div>

Models Loaded

</div>

<div class="status">

<div
class="dot"
id="faceDot">
</div>

Face Detected

</div>

<div class="status">

<div
class="dot"
id="qualityDot">
</div>

Registration Complete

</div>

</div>

</div>

</div>

<script>

const video=document.getElementById("webcam");

const canvas=document.getElementById("overlay");

const statusText=document.getElementById("statusText");

const progress=document.getElementById("progressBar");

const capture=document.getElementById("captureCount");

const instruction=document.getElementById("instruction");

const cameraDot=document.getElementById("cameraDot");

const modelDot=document.getElementById("modelDot");

const faceDot=document.getElementById("faceDot");

const qualityDot=document.getElementById("qualityDot");

const startBtn=document.getElementById("startBtn");

let descriptors=[];

let running=false;

async function loadModels(){

statusText.innerHTML="Loading AI Models...";

await faceapi.nets.tinyFaceDetector.loadFromUri("/models");

await faceapi.nets.faceLandmark68Net.loadFromUri("/models");

await faceapi.nets.faceRecognitionNet.loadFromUri("/models");

modelDot.classList.add("active");

statusText.innerHTML="Models Loaded";

}

async function startCamera(){

const stream=await navigator.mediaDevices.getUserMedia({

video:{
width:1280,
height:720,
facingMode:"user"
}

});

video.srcObject=stream;

cameraDot.classList.add("active");

}

async function detect(){

const displaySize={

width:video.clientWidth,

height:video.clientHeight

};

canvas.width=displaySize.width;

canvas.height=displaySize.height;

faceapi.matchDimensions(canvas,displaySize);

setInterval(async()=>{

if(!running)return;

const detection=await faceapi

.detectSingleFace(

video,

new faceapi.TinyFaceDetectorOptions()

)

.withFaceLandmarks()

.withFaceDescriptor();

const ctx=canvas.getContext("2d");

ctx.clearRect(0,0,canvas.width,canvas.height);

if(detection){

faceDot.classList.add("active");

statusText.innerHTML="Face Detected";

const resized=faceapi.resizeResults(detection,displaySize);

faceapi.draw.drawDetections(canvas,[resized]);

}else{

faceDot.classList.remove("active");

statusText.innerHTML="No Face";

}

},120);

}
function beep(){

    const ctx = new AudioContext();

    const osc = ctx.createOscillator();

    const gain = ctx.createGain();

    osc.connect(gain);

    gain.connect(ctx.destination);

    osc.frequency.value = 900;

    osc.start();

    gain.gain.exponentialRampToValueAtTime(

        0.0001,

        ctx.currentTime+0.15

    );

    osc.stop(ctx.currentTime+0.15);

}

startBtn.onclick = async () => {

    running = true;

    descriptors = [];

    progress.style.width = "0%";

    capture.innerHTML = "0 / 15";

    const instructions = [

        "Look Straight",

        "Turn Head Left",

        "Turn Head Right",

        "Look Up",

        "Look Down",

        "Smile",

        "Look Straight",

        "Turn Left",

        "Turn Right",

        "Look Up",

        "Look Down",

        "Blink",

        "Look Straight",

        "Smile",

        "Look Straight"

    ];

    for(let i = 0; i < 15; i++){

        instruction.innerHTML = instructions[i];

        let detected = false;

        while(!detected){

            const result = await faceapi

            .detectSingleFace(

                video,

                new faceapi.TinyFaceDetectorOptions()

            )

            .withFaceLandmarks()

            .withFaceDescriptor();

            if(result){

                descriptors.push(Array.from(result.descriptor));
                beep();

                detected = true;

            }

            await new Promise(r=>setTimeout(r,500));

        }

        progress.style.width=((i+1)/15*100)+"%";

        capture.innerHTML=(i+1)+" / 15";

        await new Promise(r=>setTimeout(r,800));

    }

    instruction.innerHTML="Processing Face Descriptor...";

    // Compute the average of the 15 face descriptors
const average = [];

for (let i = 0; i < 128; i++) {

    let sum = 0;

    descriptors.forEach(d => {
        sum += d[i];
    });

    average.push(sum / descriptors.length);

}

console.log(average);

fetch("{{ route('face.save', $user->id) }}", {

    method: "POST",

    headers: {

        "Content-Type": "application/json",

        "X-CSRF-TOKEN": "{{ csrf_token() }}"

    },

    body: JSON.stringify({

        descriptor: average

    })

})

.then(response => response.json())

.then(data => {

    if (data.success) {

        alert("Face Registered Successfully!");

        window.location.href = "/admin/employees";

    }

})

.catch(error => {

    console.error(error);

    alert("Failed to save face.");

});

    qualityDot.classList.add("active");

    statusText.innerHTML="15 Samples Captured";

};

(async()=>{

await loadModels();

await startCamera();

video.addEventListener("playing",detect);

})();

</script>

</body>

</html>