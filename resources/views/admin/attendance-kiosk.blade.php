<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PapPay AI Attendance Kiosk</title>

    <script src="/js/face-api.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }

        body {

            background: #071425;

            height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            color: white;

        }

        .container {

            width: 1500px;

            height: 850px;

            display: grid;

            grid-template-columns: 2fr 1fr;

            gap: 25px;

            padding: 30px;

        }

        .card {

            background: rgba(255, 255, 255, .05);

            border: 1px solid rgba(255, 255, 255, .08);

            backdrop-filter: blur(20px);

            border-radius: 20px;

            padding: 25px;

            box-shadow: 0 0 30px rgba(0, 255, 255, .08);

        }

        .title {

            font-size: 28px;

            font-weight: bold;

            margin-bottom: 20px;

            color: #00d9ff;

        }

        video {

            width: 100%;

            border-radius: 20px;

            background: black;

        }

        .buttons {

            display: flex;

            gap: 20px;

            margin-top: 25px;

        }

        button {

            flex: 1;

            padding: 18px;

            border: none;

            border-radius: 12px;

            font-size: 18px;

            font-weight: bold;

            cursor: pointer;

            transition: .3s;

        }

        #startButton {

            background: #00d084;

            color: white;

        }


        button:hover {

            transform: translateY(-2px);

        }

        .info {

            display: flex;

            justify-content: space-between;

            margin-top: 15px;

            font-size: 18px;

        }

        .avatar {

            width: 150px;

            height: 150px;

            border-radius: 50%;

            background: #1d4ed8;

            display: flex;

            justify-content: center;

            align-items: center;

            font-size: 70px;

            font-weight: bold;

            margin: auto;

        }

        .employee {

            text-align: center;

            margin-top: 25px;

        }

        .employee h2 {

            margin-top: 15px;

            font-size: 28px;

        }

        .employee p {

            margin-top: 8px;

            font-size: 18px;

            color: #cbd5e1;

        }

        .status {

            margin-top: 30px;

            padding: 20px;

            background: #111827;

            border-radius: 15px;

            font-size: 20px;

            text-align: center;

        }

        .success {

            color: #00ff9d;

        }

        .error {

            color: #ff5c5c;

        }

        .clock {

            font-size: 35px;

            font-weight: bold;

            text-align: center;

            margin-bottom: 20px;

        }

        .date {

            text-align: center;

            margin-bottom: 30px;

            color: #94a3b8;

        }
    </style>

</head>

<body>


    <div class="container">

        <div class="card">

            <div class="title">
                PapPay Smart Biometric Attendance Terminal
            </div>

            <video id="video" autoplay muted playsinline></video>

            <div class="buttons">

                <button id="startButton">

                    ▶ START SCANNING

                </button>

            </div>

        </div>

        <div class="card">

            <div class="clock" id="clock"></div>

            <div class="date" id="date"></div>

            <div class="avatar">

                <img id="avatarImage" src="/images/default-avatar.png"
                    style="
width:100%;
height:100%;
border-radius:50%;
object-fit:cover;
">

            </div>

            <div class="employee">

                <h2 id="employeeName">

                    Waiting...

                </h2>

                <p id="employeeDepartment">

                    No employee recognized

                </p>

                <br>

                <div style="margin-top:20px;">

                    <small style="
        color:#94a3b8;
        font-size:15px;
        ">
                        LAST ATTENDANCE
                    </small>

                    <h3 id="attendanceType" style="
        margin-top:10px;
        color:#00d9ff;
        ">

                        Waiting for Scan

                    </h3>

                    <p id="attendanceTime"
                        style="
        margin-top:8px;
        font-size:18px;
        color:white;
        ">

                        --

                    </p>

                </div>

            </div>

            <div class="status" id="statusBox">

                System Ready

            </div>
            <div style="margin-top:15px;text-align:center;color:#94a3b8">
                AI Face Recognition Engine v1.0
            </div>

        </div>

    </div>
    <script>
        let scanning = false;

        let interval = null;

        let employees = [];

        let processing = false;

        // Employee currently recognized
        let lastEmployeeId = null;

        // Has the face left the camera?
        let waitingForFaceToLeave = false;

        let cooldown = {};
        const avatarImage =
            document.getElementById("avatarImage");

        const video = document.getElementById("video");

        const startButton = document.getElementById("startButton");

        const nameLabel = document.getElementById("employeeName");

        const deptLabel = document.getElementById("employeeDepartment");

        const statusBox = document.getElementById("statusBox");

        const attendanceType =
            document.getElementById("attendanceType");

        const attendanceTime =
            document.getElementById("attendanceTime");

        setInterval(() => {

            const now = new Date();

            document.getElementById("clock").innerHTML =
                now.toLocaleTimeString();

            document.getElementById("date").innerHTML =
                now.toDateString();

        }, 1000);

        async function loadSystem() {

            await faceapi.nets.tinyFaceDetector.loadFromUri("/models");

            await faceapi.nets.faceLandmark68Net.loadFromUri("/models");

            await faceapi.nets.faceRecognitionNet.loadFromUri("/models");

            const response =
                await fetch("/admin/attendance/faces");

            employees =
                await response.json();

            const stream =
                await navigator.mediaDevices.getUserMedia({

                    video: {
                        width: 1280,
                        height: 720
                    }

                });

            video.srcObject = stream;

            await new Promise(resolve => {
                video.onloadedmetadata = () => {
                    video.play();
                    resolve();
                };
            });

        }

        startButton.onclick = () => {

            if (scanning) return;

            scanning = true;

            startButton.style.display = "none";

            statusBox.innerHTML = "Scanning...";

            statusBox.className = "status success";

            interval = setInterval(scanFace, 700);

        };

        async function scanFace() {

            if (processing) return;
            processing = true;

            const result =
                await faceapi
                .detectSingleFace(
                    video,
                    new faceapi.TinyFaceDetectorOptions()
                )
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!result) {

                statusBox.innerHTML =
                    "👤 Waiting for Employee...";

                // Employee has completely left the camera.
                if (lastEmployeeId) {

                    delete cooldown[lastEmployeeId];

                }

                waitingForFaceToLeave = false;

                lastEmployeeId = null;

                processing = false;

                return;

            }
            let best = null;

            let smallest = 999;

            employees.forEach(employee => {

                const stored =
                    new Float32Array(employee.descriptor);

                const distance = faceapi.euclideanDistance(
                    result.descriptor,
                    stored
                );

                if (distance < smallest) {

                    smallest = distance;

                    best = employee;

                }

            });

            if (best && smallest < 0.45) {

                // Same employee is still standing there
                if (
                    waitingForFaceToLeave &&
                    lastEmployeeId === best.id
                ) {

                    processing = false;

                    return;

                }

                lastEmployeeId = best.id;
                waitingForFaceToLeave = true;

                if (cooldown[best.id]) {

                    processing = false;
                    return;

                }

                cooldown[best.id] = true;

                // Stop scanning immediately after one successful recognition
                clearInterval(interval);

                scanning = false;

                nameLabel.innerHTML = best.name;

                if (best.department) {

                    deptLabel.innerHTML = best.department;

                } else if (best.position) {

                    deptLabel.innerHTML = best.position;

                } else {

                    deptLabel.innerHTML = "Employee";

                }
                avatarImage.src =
                    best.photo;

                statusBox.innerHTML =
                    "⏳ Recording Attendance...";

                try {

                    const response = await fetch("/admin/attendance/record", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },

                        body: JSON.stringify({

                            employee_id: best.id

                        })

                    });

                    const data = await response.json();
                    console.log(data);
                    if (data.success) {

                        let message = data.message;

                        if (!message) {

                            message = data.type + " recorded";

                        }

                        let voiceMessage =
                            "Good day " +
                            best.name +
                            ". " +
                            data.type +
                            " has been successfully recorded.";

                        if (data.hours_worked > 0) {

                            voiceMessage +=
                                " Your total worked hours are " +
                                data.hours_worked +
                                " hours.";

                        }

                        const speech =
                            new SpeechSynthesisUtterance(voiceMessage);

                        speech.rate = 1;
                        speech.pitch = 1;

                        window.speechSynthesis.cancel();
                        window.speechSynthesis.speak(speech);

                    }

                    console.log(data);
                    if (data.success) {

                        statusBox.innerHTML =
                            "✅ Attendance Recorded";

                        // Stop scanning after one successful scan
                        clearInterval(interval);

                        scanning = false;

                        startButton.style.display = "none";

                        attendanceType.innerHTML =
                            data.type;

                        attendanceTime.innerHTML =
                            data.time;
                        statusBox.innerHTML =
                            "✅ " +
                            data.type +
                            "<br><br>Total Hours : " +
                            data.hours_worked;

                    } else {

                        statusBox.innerHTML =
                            "⚠ " + data.message;

                        attendanceType.innerHTML =
                            "No Action";

                        attendanceTime.innerHTML =
                            "--";

                    }

                } catch (e) {

                    statusBox.innerHTML = "Server Error";

                }

                setTimeout(() => {

                    delete cooldown[best.id];

                    avatarImage.src = "/images/default-avatar.png";

                    nameLabel.innerHTML = "Waiting...";

                    deptLabel.innerHTML = "No employee recognized";

                    attendanceType.innerHTML = "Waiting for Scan";

                    attendanceTime.innerHTML = "--";

                    statusBox.innerHTML = "System Ready";

                    // Ready for another employee
                    startButton.style.display = "block";

                }, 10000);

            } else {

                statusBox.innerHTML =
                    "❌ Face Not Registered";

                processing = false;

            }

            processing = false;

        }


        loadSystem();
    </script>
