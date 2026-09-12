<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>PapPay Part-Time Attendance Kiosk</title>

    <script src="/js/face-api.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
        rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, sans-serif;
        }


        /* =========================================================
           BODY
        ========================================================== */

        body {

            background: #071425;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            color: white;

            overflow-x: hidden;

            overflow-y: auto;

        }


        /* =========================================================
           MAIN CONTAINER
        ========================================================== */

        .container {

            width: 1500px;

            min-height: 850px;

            max-width: 100%;

            display: grid;

            grid-template-columns:
                minmax(0, 2fr)
                minmax(320px, 1fr);

            gap: 25px;

            padding: 30px;

        }


        /* =========================================================
           CARD
        ========================================================== */

        .card {

            min-width: 0;

            background:
                rgba(255, 255, 255, .05);

            border:
                1px solid rgba(255, 255, 255, .08);

            backdrop-filter:
                blur(20px);

            border-radius: 20px;

            padding: 25px;

            box-shadow:
                0 0 30px rgba(0, 255, 255, .08);

        }


        /* =========================================================
           TITLE
        ========================================================== */

        .title {

            font-size: 28px;

            font-weight: bold;

            margin-bottom: 20px;

            color: #00d9ff;

            line-height: 1.3;

        }


        /* =========================================================
           CAMERA WRAPPER
        ========================================================== */

        .camera-wrapper {

            position: relative;

            width: 100%;

            background: black;

            border-radius: 20px;

            overflow: hidden;

            aspect-ratio: 16 / 9;

            min-height: 250px;

        }


        /* =========================================================
           CAMERA
        ========================================================== */

        #video {

            display: block;

            width: 100%;

            height: 100%;

            object-fit: cover;

            background: black;

            border-radius: 20px;

        }


        /* =========================================================
           CAMERA LOADING
        ========================================================== */

        .camera-loading {

            position: absolute;

            inset: 0;

            display: flex;

            flex-direction: column;

            justify-content: center;

            align-items: center;

            text-align: center;

            background:
                rgba(0, 0, 0, .65);

            z-index: 5;

            transition: .3s;

        }


        .camera-loading.hidden {

            opacity: 0;

            pointer-events: none;

        }


        .camera-spinner {

            width: 45px;

            height: 45px;

            border:
                4px solid rgba(255,255,255,.15);

            border-top:
                4px solid #00d9ff;

            border-radius: 50%;

            animation:
                spin 1s linear infinite;

            margin-bottom: 15px;

        }


        @keyframes spin {

            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }

        }


        /* =========================================================
           CAMERA STATUS
        ========================================================== */

        .camera-status {

            position: absolute;

            top: 15px;

            left: 15px;

            z-index: 10;

            padding: 8px 13px;

            border-radius: 10px;

            background:
                rgba(0,0,0,.55);

            backdrop-filter:
                blur(8px);

            font-size: 13px;

            color: #cbd5e1;

        }


        .camera-status.ready {

            color: #00ff9d;

        }


        .camera-status.error {

            color: #ff5c5c;

        }


        /* =========================================================
           FACE GUIDE
        ========================================================== */

        .face-guide {

            position: absolute;

            top: 50%;

            left: 50%;

            transform:
                translate(-50%, -50%);

            width: 32%;

            max-width: 260px;

            aspect-ratio: .78;

            border:
                2px dashed rgba(0, 229, 255, .45);

            border-radius: 50%;

            pointer-events: none;

            box-shadow:
                0 0 25px rgba(0, 229, 255, .10);

        }


        /* =========================================================
           SCAN LINE

           IMPORTANT:
           Hidden until START SCANNING is clicked.
        ========================================================== */

        .scan-line {

            position: absolute;

            left: 0;

            width: 100%;

            height: 3px;

            background: #00e5ff;

            box-shadow:
                0 0 25px cyan;

            animation:
                scan 3s linear infinite;

            pointer-events: none;

            opacity: 0;

        }


        /*
        Only show scanning line while scanning.
        */

        .scan-line.scanning {

            opacity: .7;

        }


        @keyframes scan {

            0% {
                top: 0;
            }

            50% {
                top: 95%;
            }

            100% {
                top: 0;
            }

        }


        /* =========================================================
           BUTTONS
        ========================================================== */

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


        #startButton:disabled {

            opacity: .5;

            cursor: not-allowed;

            transform: none;

        }


        button:hover:not(:disabled) {

            transform:
                translateY(-2px);

        }


        /* =========================================================
           AVATAR
        ========================================================== */

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

            overflow: hidden;

        }


        .avatar img {

            width: 100%;

            height: 100%;

            border-radius: 50%;

            object-fit: cover;

            display: none;

        }


        /* =========================================================
           EMPLOYEE
        ========================================================== */

        .employee {

            text-align: center;

            margin-top: 25px;

        }


        .employee h2 {

            margin-top: 15px;

            font-size: 28px;

            line-height: 1.3;

            word-break: break-word;

        }


        .employee p {

            margin-top: 8px;

            font-size: 18px;

            color: #cbd5e1;

            word-break: break-word;

        }


        /* =========================================================
           SUBJECT
        ========================================================== */

        .subject-box {

            margin-top: 20px;

            padding: 15px;

            background: #111827;

            border-radius: 15px;

            text-align: center;

        }


        .subject-label {

            color: #94a3b8;

            font-size: 14px;

        }


        .subject-name {

            margin-top: 5px;

            font-size: 21px;

            font-weight: 700;

            color: #00d9ff;

            word-break: break-word;

        }


        .schedule {

            margin-top: 5px;

            color: #cbd5e1;

            font-size: 15px;

            word-break: break-word;

        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status {

            margin-top: 30px;

            padding: 20px;

            background: #111827;

            border-radius: 15px;

            font-size: 20px;

            text-align: center;

            line-height: 1.5;

            word-break: break-word;

        }


        .success {

            color: #00ff9d;

        }


        .error {

            color: #ff5c5c;

        }


        /* =========================================================
           CLOCK
        ========================================================== */

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


        /* =========================================================
           SYSTEM ERROR
        ========================================================== */

        .system-error {

            margin-top: 15px;

            padding: 12px;

            border-radius: 10px;

            background:
                rgba(239,68,68,.10);

            border:
                1px solid rgba(239,68,68,.25);

            color: #ff7b7b;

            text-align: center;

            font-size: 13px;

            display: none;

        }


        .system-error.show {

            display: block;

        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1100px) {

            body {

                align-items: flex-start;

            }


            .container {

                width: 100%;

                min-height: auto;

                grid-template-columns: 1fr;

                padding: 20px;

            }


            .camera-wrapper {

                min-height: 0;

            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            body {

                min-height: 100vh;

                overflow-y: auto;

            }


            .container {

                width: 100%;

                padding: 12px;

                gap: 15px;

            }


            .card {

                padding: 18px;

                border-radius: 18px;

            }


            .title {

                font-size: 21px;

                margin-bottom: 15px;

            }


            .camera-wrapper {

                width: 100%;

                aspect-ratio: 16 / 9;

                min-height: 0;

                border-radius: 16px;

            }


            #video {

                border-radius: 16px;

            }


            .face-guide {

                width: 45%;

                max-width: none;

            }


            .buttons {

                margin-top: 18px;

            }


            button {

                padding: 15px;

                font-size: 15px;

            }


            .clock {

                font-size: 28px;

            }


            .date {

                margin-bottom: 20px;

            }


            .avatar {

                width: 120px;

                height: 120px;

                font-size: 55px;

            }


            .employee {

                margin-top: 18px;

            }


            .employee h2 {

                font-size: 22px;

            }


            .employee p {

                font-size: 15px;

            }


            .subject-name {

                font-size: 18px;

            }


            .status {

                margin-top: 20px;

                padding: 15px;

                font-size: 17px;

            }

        }


        /* =========================================================
           VERY SMALL MOBILE
        ========================================================== */

        @media (max-width: 400px) {

            .container {

                padding: 8px;

            }


            .card {

                padding: 14px;

            }


            .title {

                font-size: 19px;

            }


            button {

                font-size: 14px;

                padding: 13px;

            }


            .face-guide {

                width: 50%;

            }

        }

    </style>

</head>


<body>


<div class="container">


    <!-- =========================================================
         CAMERA CARD
    ========================================================== -->

    <div class="card">


        <div class="title">

            PapPay Part-Time Attendance Terminal

        </div>


        <!-- =====================================================
             CAMERA
        ====================================================== -->

        <div class="camera-wrapper">


            <video
                id="video"
                autoplay
                muted
                playsinline>
            </video>


            <!-- CAMERA LOADING -->

            <div
                class="camera-loading"
                id="cameraLoading">

                <div class="camera-spinner"></div>

                <div id="cameraLoadingText">

                    Starting camera...

                </div>

            </div>


            <!-- CAMERA STATUS -->

            <div
                class="camera-status"
                id="cameraStatus">

                Camera Initializing...

            </div>


            <!-- FACE GUIDE -->

            <div class="face-guide"></div>


            <!-- SCANNING LINE -->

            <div
                class="scan-line"
                id="scanLine">
            </div>


        </div>


        <!-- =====================================================
             START SCANNING BUTTON
        ====================================================== -->

        <div class="buttons">

            <button
                id="startButton"
                disabled>

                ▶ START SCANNING

            </button>

        </div>


        <!-- SYSTEM ERROR -->

        <div
            class="system-error"
            id="systemError">
        </div>


    </div>



    <!-- =========================================================
         INFORMATION CARD
    ========================================================== -->

    <div class="card">


        <!-- CLOCK -->

        <div
            class="clock"
            id="clock">
        </div>


        <!-- DATE -->

        <div
            class="date"
            id="date">
        </div>


        <!-- =====================================================
             AVATAR
        ====================================================== -->

        <div
            class="avatar"
            id="avatar">

            <span id="avatarInitial">
                P
            </span>


            <img
                id="avatarImage"
                alt="Employee">

        </div>


        <!-- =====================================================
             EMPLOYEE
        ====================================================== -->

        <div class="employee">


            <h2 id="employeeName">

                Waiting...

            </h2>


            <p id="employeeDepartment">

                No Part-Time employee recognized

            </p>


            <!-- =================================================
                 SUBJECT
            ================================================== -->

            <div class="subject-box">


                <div class="subject-label">

                    CURRENT SUBJECT

                </div>


                <div
                    class="subject-name"
                    id="subjectName">

                    --

                </div>


                <div
                    class="schedule"
                    id="subjectSchedule">

                    --

                </div>


            </div>


            <br>


            <!-- =================================================
                 LAST ATTENDANCE
            ================================================== -->

            <div style="margin-top:20px;">


                <small style="
                    color:#94a3b8;
                    font-size:15px;
                ">

                    LAST ATTENDANCE

                </small>


                <h3
                    id="attendanceType"
                    style="
                        margin-top:10px;
                        color:#00d9ff;
                    ">

                    Waiting for Scan

                </h3>


                <p
                    id="attendanceTime"
                    style="
                        margin-top:8px;
                        font-size:18px;
                        color:white;
                    ">

                    --

                </p>


            </div>


        </div>


        <!-- =====================================================
             STATUS
        ====================================================== -->

        <div
            class="status"
            id="statusBox">

            System Starting...

        </div>


        <div style="
            margin-top:15px;
            text-align:center;
            color:#94a3b8;
            font-size:13px;
        ">

            Part-Time Attendance Engine v1.0

        </div>


    </div>


</div>



<script>


/* ================================================================
   VARIABLES
================================================================ */

let scanning = false;

let interval = null;

let employees = [];

let processing = false;

let lastEmployeeId = null;

let waitingForFaceToLeave = false;

let cooldown = {};

let cameraReady = false;

let modelsReady = false;

let facesReady = false;


/* ================================================================
   ELEMENTS
================================================================ */

const video =
    document.getElementById("video");

const startButton =
    document.getElementById("startButton");

const statusBox =
    document.getElementById("statusBox");

const nameLabel =
    document.getElementById("employeeName");

const deptLabel =
    document.getElementById("employeeDepartment");

const attendanceType =
    document.getElementById("attendanceType");

const attendanceTime =
    document.getElementById("attendanceTime");

const subjectName =
    document.getElementById("subjectName");

const subjectSchedule =
    document.getElementById("subjectSchedule");

const avatar =
    document.getElementById("avatar");

const avatarImage =
    document.getElementById("avatarImage");

const avatarInitial =
    document.getElementById("avatarInitial");

const cameraLoading =
    document.getElementById("cameraLoading");

const cameraLoadingText =
    document.getElementById("cameraLoadingText");

const cameraStatus =
    document.getElementById("cameraStatus");

const systemError =
    document.getElementById("systemError");

const scanLine =
    document.getElementById("scanLine");


/* ================================================================
   CLOCK
================================================================ */

function updateClock() {

    const now =
        new Date();


    document.getElementById("clock")
        .innerHTML =
        now.toLocaleTimeString();


    document.getElementById("date")
        .innerHTML =
        now.toDateString();

}


updateClock();


setInterval(
    updateClock,
    1000
);


/* ================================================================
   UPDATE SYSTEM READY
================================================================ */

function updateSystemReady() {

    if (
        cameraReady &&
        modelsReady &&
        facesReady
    ) {

        statusBox.innerHTML =
            "System Ready — Click START SCANNING";

        statusBox.className =
            "status";

        startButton.disabled =
            false;

        startButton.style.display =
            "block";

    }

}


/* ================================================================
   START CAMERA
================================================================ */

async function startCamera() {

    try {

        cameraLoadingText.innerHTML =
            "Starting camera...";


        cameraStatus.innerHTML =
            "Camera Initializing...";


        cameraStatus.className =
            "camera-status";


        const stream =
            await navigator.mediaDevices.getUserMedia({

                video: {

                    width: {
                        ideal: 1280
                    },

                    height: {
                        ideal: 720
                    },

                    facingMode: "user"

                },

                audio: false

            });


        video.srcObject =
            stream;


        await new Promise(
            resolve => {

                if (
                    video.readyState >= 2
                ) {

                    resolve();

                    return;

                }


                video.onloadedmetadata =
                    () => {

                        resolve();

                    };

            }
        );


        await video.play();


        cameraReady =
            true;


        cameraLoading.classList.add(
            "hidden"
        );


        cameraStatus.innerHTML =
            "● Camera Ready";


        cameraStatus.className =
            "camera-status ready";


        statusBox.innerHTML =
            "Camera Ready";


        console.log(
            "Part-Time camera started successfully."
        );


    }
    catch (error) {

        console.error(
            "Camera error:",
            error
        );


        cameraReady =
            false;


        cameraLoadingText.innerHTML =
            "Camera access failed";


        cameraStatus.innerHTML =
            "Camera Error";


        cameraStatus.className =
            "camera-status error";


        statusBox.innerHTML =
            "❌ Camera Access Failed";


        statusBox.className =
            "status error";


        systemError.innerHTML =
            "Please allow camera access in Chrome and make sure the camera is connected.";


        systemError.classList.add(
            "show"
        );

    }

}


/* ================================================================
   LOAD FACE MODELS
================================================================ */

async function loadModels() {

    try {

        statusBox.innerHTML =
            "Loading Face Recognition Models...";


        await faceapi.nets
            .tinyFaceDetector
            .loadFromUri("/models");


        await faceapi.nets
            .faceLandmark68Net
            .loadFromUri("/models");


        await faceapi.nets
            .faceRecognitionNet
            .loadFromUri("/models");


        modelsReady =
            true;


        console.log(
            "Face recognition models loaded."
        );


    }
    catch (error) {

        console.error(
            "Model loading error:",
            error
        );


        statusBox.innerHTML =
            "❌ AI Model Loading Failed";


        statusBox.className =
            "status error";


        systemError.innerHTML =
            "Unable to load the face recognition models from /models.";


        systemError.classList.add(
            "show"
        );

    }

}


/* ================================================================
   LOAD PART-TIME EMPLOYEES
================================================================ */

async function loadEmployees() {

    try {

        statusBox.innerHTML =
            "Loading Part-Time Employees...";


        const response =
            await fetch(
                "{{ route('part_time_attendance_kiosk.faces') }}",
                {
                    method: "GET",

                    headers: {

                        "Accept":
                            "application/json"

                    },

                    cache: "no-store"

                }
            );


        if (!response.ok) {

            throw new Error(
                "HTTP " +
                response.status
            );

        }


        employees =
            await response.json();


        if (
            !Array.isArray(employees)
        ) {

            throw new Error(
                "Invalid employee data."
            );

        }


        const registered =
            employees.filter(
                employee =>
                    employee.descriptor
            );


        facesReady =
            true;


        console.log(
            "Part-Time employees loaded:",
            employees
        );


        console.log(
            "Registered faces:",
            registered.length
        );


        if (
            registered.length === 0
        ) {

            statusBox.innerHTML =
                "⚠ No Part-Time Faces Registered";

            statusBox.className =
                "status error";

            startButton.disabled =
                true;


            systemError.innerHTML =
                "No registered Part-Time employee face was found.";

            systemError.classList.add(
                "show"
            );


            return;

        }


        systemError.classList.remove(
            "show"
        );


        updateSystemReady();


    }
    catch (error) {

        console.error(
            "Part-Time employee loading error:",
            error
        );


        facesReady =
            false;


        statusBox.innerHTML =
            "⚠ Employee Data Loading Error";


        statusBox.className =
            "status error";


        startButton.disabled =
            true;


        systemError.innerHTML =
            "Unable to load Part-Time employee face data. Please check the Laravel /faces endpoint.";


        systemError.classList.add(
            "show"
        );

    }

}


/* ================================================================
   START SCANNING
================================================================ */

startButton.onclick =
    function() {

        /*
        IMPORTANT:
        Nothing happens unless all required
        components are ready.
        */

        if (
            scanning ||
            !cameraReady ||
            !modelsReady ||
            !facesReady
        ) {

            return;

        }


        scanning =
            true;


        /*
        Show scanning line ONLY now.
        */

        scanLine.classList.add(
            "scanning"
        );


        /*
        Hide button while scanning.
        */

        startButton.style.display =
            "none";


        statusBox.innerHTML =
            "🔍 Scanning for Part-Time Employee...";


        statusBox.className =
            "status success";


        /*
        Start actual face recognition loop.
        */

        if (interval) {

            clearInterval(
                interval
            );

        }


        interval =
            setInterval(
                scanFace,
                700
            );


        /*
        Immediately perform first scan.
        */

        scanFace();

    };


/* ================================================================
   SCAN FACE
================================================================ */

async function scanFace() {

    if (
        !scanning ||
        processing ||
        !cameraReady ||
        video.paused ||
        video.readyState < 2
    ) {

        return;

    }


    processing =
        true;


    try {


        /* ========================================================
           FACE DETECTION
        ========================================================= */

        const result =
            await faceapi
                .detectSingleFace(
                    video,
                    new faceapi.TinyFaceDetectorOptions({
                        inputSize: 416,
                        scoreThreshold: 0.40
                    })
                )
                .withFaceLandmarks()
                .withFaceDescriptor();


        /* ========================================================
           NO FACE
        ========================================================= */

        if (!result) {

            statusBox.innerHTML =
                "👤 Waiting for Part-Time Employee...";


            if (
                lastEmployeeId
            ) {

                delete cooldown[
                    lastEmployeeId
                ];

            }


            waitingForFaceToLeave =
                false;


            lastEmployeeId =
                null;


            processing =
                false;


            return;

        }


        /* ========================================================
           FIND BEST MATCH
        ========================================================= */

        let best =
            null;


        let smallest =
            Infinity;


        employees.forEach(
            employee => {

                if (
                    !employee.descriptor ||
                    !Array.isArray(
                        employee.descriptor
                    )
                ) {

                    return;

                }


                try {

                    const stored =
                        new Float32Array(
                            employee.descriptor
                        );


                    const distance =
                        faceapi.euclideanDistance(
                            result.descriptor,
                            stored
                        );


                    if (
                        distance <
                        smallest
                    ) {

                        smallest =
                            distance;


                        best =
                            employee;

                    }

                }
                catch (error) {

                    console.warn(
                        "Invalid descriptor:",
                        employee
                    );

                }

            }
        );


        /* ========================================================
           FACE MATCH
        ========================================================= */

        if (
            best &&
            smallest < 0.45
        ) {


            /*
            SAME EMPLOYEE STILL STANDING
            */

            if (
                waitingForFaceToLeave &&
                lastEmployeeId === best.id
            ) {

                processing =
                    false;

                return;

            }


            lastEmployeeId =
                best.id;


            waitingForFaceToLeave =
                true;


            /*
            COOLDOWN
            */

            if (
                cooldown[best.id]
            ) {

                processing =
                    false;

                return;

            }


            cooldown[best.id] =
                true;


            /*
            STOP SCANNING
            */

            if (interval) {

                clearInterval(
                    interval
                );

            }


            interval =
                null;


            scanning =
                false;


            /*
            Hide scan line.
            */

            scanLine.classList.remove(
                "scanning"
            );


            /*
            DISPLAY EMPLOYEE
            */

            nameLabel.innerHTML =
                best.name ||
                "Part-Time Employee";


            if (
                best.department
            ) {

                deptLabel.innerHTML =
                    best.department;

            }
            else if (
                best.position
            ) {

                deptLabel.innerHTML =
                    best.position;

            }
            else {

                deptLabel.innerHTML =
                    "Part-Time Employee";

            }


            /*
            AVATAR
            */

            setAvatar(
                best
            );


            /*
            STATUS
            */

            statusBox.innerHTML =
                "⏳ Recording Attendance...";


            statusBox.className =
                "status";


            /*
            RECORD ATTENDANCE
            */

            await recordAttendance(
                best
            );


        }
        else {


            /*
            FACE NOT REGISTERED
            */

            statusBox.innerHTML =
                "❌ Face Not Registered";


            statusBox.className =
                "status error";

        }


    }
    catch (error) {

        console.error(
            "Face recognition error:",
            error
        );


        statusBox.innerHTML =
            "❌ Face Recognition Error";


        statusBox.className =
            "status error";

    }


    processing =
        false;

}


/* ================================================================
   SET AVATAR
================================================================ */

function setAvatar(employee) {

    const photo =
        employee.photo ||
        employee.profile_photo ||
        null;


    if (photo) {

        avatarImage.src =
            photo;

        avatarImage.style.display =
            "block";


        avatarInitial.style.display =
            "none";


        avatarImage.onerror =
            function() {

                avatarImage.style.display =
                    "none";

                avatarInitial.style.display =
                    "block";

            };

    }
    else {

        avatarImage.style.display =
            "none";


        avatarInitial.style.display =
            "block";


        const name =
            employee.name ||
            "P";


        avatarInitial.innerHTML =
            name
                .charAt(0)
                .toUpperCase();

    }

}


/* ================================================================
   RECORD ATTENDANCE
================================================================ */

async function recordAttendance(
    employee
) {

    try {


        const response =
            await fetch(
                "{{ route('part_time_attendance_kiosk.record') }}",
                {

                    method: "POST",

                    headers: {

                        "Content-Type":
                            "application/json",

                        "X-CSRF-TOKEN":
                            "{{ csrf_token() }}",

                        "Accept":
                            "application/json"

                    },

                    body:
                        JSON.stringify({

                            employee_id:
                                employee.id

                        })

                }
            );


        if (
            !response.ok
        ) {

            const errorText =
                await response.text();


            console.error(
                "Record attendance HTTP error:",
                response.status,
                errorText
            );


            throw new Error(
                "HTTP " +
                response.status
            );

        }


        const data =
            await response.json();


        console.log(
            "Part-Time Attendance Response:",
            data
        );


        /* ========================================================
           SUCCESS
        ========================================================= */

        if (
            data.success
        ) {


            /*
            SUBJECT
            */

            subjectName.innerHTML =
                data.subject ||
                "--";


            subjectSchedule.innerHTML =
                data.schedule ||
                "--";


            /*
            ATTENDANCE
            */

            attendanceType.innerHTML =
                data.type ||
                "Attendance Recorded";


            attendanceTime.innerHTML =
                data.time ||
                "--";


            /*
            STATUS
            */

            statusBox.innerHTML =
                "✅ " +
                (
                    data.type ||
                    "Attendance Recorded"
                ) +
                "<br><br>" +
                "Subject: " +
                (
                    data.subject ||
                    "--"
                );


            statusBox.className =
                "status success";


            /*
            VOICE
            */

            let voiceMessage =
                "Good day " +
                (
                    employee.name ||
                    "employee"
                ) +
                ". " +
                (
                    data.type ||
                    "Attendance"
                ) +
                " has been successfully recorded.";


            if (
                data.hours_worked !== undefined &&
                data.hours_worked !== null &&
                Number(data.hours_worked) > 0
            ) {

                voiceMessage +=
                    " Your total worked hours are " +
                    data.hours_worked +
                    " hours.";

            }


            try {

                const speech =
                    new SpeechSynthesisUtterance(
                        voiceMessage
                    );


                speech.rate =
                    1;


                speech.pitch =
                    1;


                window.speechSynthesis
                    .cancel();


                window.speechSynthesis
                    .speak(
                        speech
                    );

            }
            catch (voiceError) {

                console.warn(
                    "Voice unavailable:",
                    voiceError
                );

            }


        }
        else {


            /*
            SERVER RETURNED FAILURE
            */

            statusBox.innerHTML =
                "⚠ " +
                (
                    data.message ||
                    "Attendance was not recorded."
                );


            statusBox.className =
                "status error";


            attendanceType.innerHTML =
                "No Action";


            attendanceTime.innerHTML =
                "--";


            if (
                data.subject
            ) {

                subjectName.innerHTML =
                    data.subject;

            }


            if (
                data.schedule
            ) {

                subjectSchedule.innerHTML =
                    data.schedule;

            }

        }


    }
    catch (error) {

        console.error(
            "Attendance recording error:",
            error
        );


        statusBox.innerHTML =
            "❌ Server Error";


        statusBox.className =
            "status error";


        attendanceType.innerHTML =
            "No Action";


        attendanceTime.innerHTML =
            "--";


        systemError.innerHTML =
            "Unable to record attendance. Please check the Laravel record endpoint.";


        systemError.classList.add(
            "show"
        );

    }


    /*
    Reset after 10 seconds.
    */

    setTimeout(
        resetKiosk,
        10000
    );

}


/* ================================================================
   RESET KIOSK
================================================================ */

function resetKiosk() {

    /*
    Stop any existing scanning loop.
    */

    if (interval) {

        clearInterval(
            interval
        );

    }


    interval =
        null;


    /*
    Hide scanning line.
    */

    scanLine.classList.remove(
        "scanning"
    );


    /*
    Remove cooldown.
    */

    if (
        lastEmployeeId
    ) {

        delete cooldown[
            lastEmployeeId
        ];

    }


    /*
    RESET AVATAR
    */

    avatarImage.src =
        "";


    avatarImage.style.display =
        "none";


    avatarInitial.style.display =
        "block";


    avatarInitial.innerHTML =
        "P";


    /*
    RESET EMPLOYEE
    */

    nameLabel.innerHTML =
        "Waiting...";


    deptLabel.innerHTML =
        "No Part-Time employee recognized";


    /*
    RESET SUBJECT
    */

    subjectName.innerHTML =
        "--";


    subjectSchedule.innerHTML =
        "--";


    /*
    RESET ATTENDANCE
    */

    attendanceType.innerHTML =
        "Waiting for Scan";


    attendanceTime.innerHTML =
        "--";


    /*
    RESET STATUS
    */

    statusBox.innerHTML =
        "System Ready — Click START SCANNING";


    statusBox.className =
        "status";


    systemError.classList.remove(
        "show"
    );


    /*
    RESET STATE
    */

    lastEmployeeId =
        null;


    waitingForFaceToLeave =
        false;


    scanning =
        false;


    processing =
        false;


    /*
    IMPORTANT:
    The camera remains ON,
    but face recognition remains OFF.
    The user must click START SCANNING again.
    */

    if (
        cameraReady &&
        modelsReady &&
        facesReady
    ) {

        startButton.style.display =
            "block";


        startButton.disabled =
            false;

    }

}


/* ================================================================
   STOP CAMERA
================================================================ */

function stopCamera() {

    if (
        video.srcObject
    ) {

        video.srcObject
            .getTracks()
            .forEach(
                track =>
                    track.stop()
            );

    }

}


/* ================================================================
   PAGE EXIT
================================================================ */

window.addEventListener(
    "beforeunload",
    function() {

        if (interval) {

            clearInterval(
                interval
            );

        }


        stopCamera();

    }
);


/* ================================================================
   INITIALIZE SYSTEM
================================================================ */

async function initializeSystem() {

    /*
    Camera and models start automatically.

    Face scanning DOES NOT start automatically.
    */

    await Promise.allSettled([

        loadModels(),

        startCamera()

    ]);


    /*
    Load Part-Time employees after
    the AI models are ready.
    */

    if (
        modelsReady
    ) {

        await loadEmployees();

    }
    else {

        statusBox.innerHTML =
            "❌ AI Models Failed";


        statusBox.className =
            "status error";

    }


    /*
    Final system status.
    */

    updateSystemReady();

}


/* ================================================================
   START SYSTEM
================================================================ */

initializeSystem();


</script>


</body>

</html>
