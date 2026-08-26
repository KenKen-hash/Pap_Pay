<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PapPay | Face Registration</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <script src="/js/face-api.min.js"></script>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {

            background:
                linear-gradient(
                    135deg,
                    #061826,
                    #091b33,
                    #132d52
                );

            min-height: 100vh;

            overflow-x: hidden;

            color: white;
        }

        body::before {

            content: "";

            position: fixed;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            background: #2563eb55;

            top: -200px;
            left: -150px;

            filter: blur(120px);

            pointer-events: none;
        }

        body::after {

            content: "";

            position: fixed;

            width: 400px;
            height: 400px;

            border-radius: 50%;

            background: #00d4ff33;

            bottom: -150px;
            right: -120px;

            filter: blur(120px);

            pointer-events: none;
        }

        .wrapper {

            padding: 40px;

            position: relative;

            z-index: 10;
        }

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 30px;
        }

        .logo {

            font-size: 35px;

            font-weight: 700;

            letter-spacing: 1px;
        }

        .logo span {

            color: #29b6ff;
        }

        .back-btn {

            background: #2563eb;

            border: none;

            padding: 12px 25px;

            border-radius: 15px;

            color: white;

            transition: .3s;
        }

        .back-btn:hover {

            background: #1d4ed8;

            transform: translateY(-2px);
        }

        .main {

            display: grid;

            grid-template-columns: 2fr 1fr;

            gap: 30px;
        }

        .glass {

            background:
                rgba(255, 255, 255, .05);

            backdrop-filter:
                blur(20px);

            border:
                1px solid rgba(255, 255, 255, .1);

            border-radius:
                25px;

            box-shadow:
                0 10px 40px rgba(0, 0, 0, .4);
        }

        .camera-card {

            padding: 25px;

            position: relative;
        }

        .card-title {

            font-size: 22px;

            margin-bottom: 20px;

            font-weight: 600;
        }

        .camera-box {

            position: relative;

            border-radius: 20px;

            overflow: hidden;

            background: black;

            min-height: 300px;
        }

        #webcam {

            width: 100%;

            display: block;

            transform: scaleX(1);
        }

        #overlay {

            position: absolute;

            top: 0;
            left: 0;

            pointer-events: none;

            width: 100%;
            height: 100%;
        }

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

        .face-guide {

            position: absolute;

            top: 50%;
            left: 50%;

            transform:
                translate(-50%, -50%);

            width: 42%;
            aspect-ratio: 0.78;

            border:
                2px dashed rgba(0, 229, 255, .55);

            border-radius: 50%;

            pointer-events: none;

            box-shadow:
                0 0 25px rgba(0, 229, 255, .12);
        }

        .side {

            display: flex;

            flex-direction: column;

            gap: 25px;
        }

        .employee-card {

            padding: 25px;
        }

        .avatar {

            width: 90px;
            height: 90px;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #00c6ff
                );

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 35px;

            font-weight: bold;

            margin: auto;

            margin-bottom: 20px;
        }

        .emp-name {

            text-align: center;

            font-size: 24px;

            font-weight: bold;

            margin-bottom: 5px;
        }

        .emp-position {

            text-align: center;

            color: #9ec9ff;

            margin-bottom: 20px;
        }

        .info {

            display: flex;

            justify-content: space-between;

            gap: 15px;

            padding: 13px 0;

            border-bottom:
                1px solid rgba(255, 255, 255, .08);
        }

        .info span:first-child {

            color: #9ab5d9;
        }

        .info span:last-child {

            font-weight: 600;

            text-align: right;

            word-break: break-word;
        }

        .status-card {

            padding: 25px;
        }

        .status {

            display: flex;

            align-items: center;

            margin-bottom: 18px;
        }

        .dot {

            width: 14px;
            height: 14px;

            border-radius: 50%;

            background: #ef4444;

            margin-right: 15px;

            flex-shrink: 0;
        }

        .active {

            background: #00ff88;

            box-shadow:
                0 0 15px #00ff88;
        }

        .progress {

            height: 16px;

            margin-top: 20px;

            background: #10263e;

            border-radius: 30px;

            overflow: hidden;
        }

        .progress-bar {

            width: 0%;

            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #00e5ff
                );

            transition:
                width .3s ease;
        }

        .instruction {

            margin-top: 20px;

            padding: 15px;

            border-radius: 15px;

            background: #0d2139;

            font-size: 18px;

            text-align: center;

            min-height: 56px;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .instruction strong {

            color: #00e5ff;
        }

        .controls {

            display: flex;

            gap: 15px;

            margin-top: 25px;
        }

        .controls button {

            flex: 1;

            padding: 15px;

            border: none;

            border-radius: 15px;

            font-size: 17px;

            font-weight: bold;

            transition: .3s;
        }

        #startBtn {

            background: #00b894;

            color: white;
        }

        #startBtn:hover {

            transform:
                translateY(-3px);
        }

        #startBtn:disabled {

            opacity: .6;

            cursor:
                not-allowed;

            transform:
                none;
        }

        #cancelBtn {

            background: #ef4444;

            color: white;
        }

        #cancelBtn:hover {

            background: #dc2626;
        }

        .security-note {

            margin-top: 15px;

            padding: 12px 15px;

            border-radius: 12px;

            background:
                rgba(37, 99, 235, .12);

            border:
                1px solid rgba(37, 99, 235, .25);

            color: #9ec9ff;

            font-size: 14px;

            text-align: center;
        }

        @media(max-width: 992px) {

            .main {

                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 600px) {

            .wrapper {

                padding: 15px;
            }

            .header {

                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .logo {

                font-size: 25px;
            }

            .card-title {

                font-size: 18px;
            }

            .camera-card {

                padding: 15px;
            }

            .controls {

                flex-direction: column;
            }

            .face-guide {

                width: 55%;
            }
        }

    </style>

</head>


<body>

<div class="wrapper">


    <!-- ========================================================= -->
    <!-- HEADER -->
    <!-- ========================================================= -->

    <div class="header">

        <div class="logo">

            Pap<span>Pay</span>

            <div
                style="
                    font-size:15px;
                    color:#90caf9;
                "
            >

                Biometric Face Registration

            </div>

        </div>


        <a
            href="{{ route('employees.index') }}"
            class="back-btn"
            style="
                text-decoration:none;
                display:inline-block;
            "
        >

            ← Employee List

        </a>

    </div>


    <div class="main">


        <!-- ===================================================== -->
        <!-- CAMERA CARD -->
        <!-- ===================================================== -->

        <div class="glass camera-card">

            <div class="card-title">

                Live Camera

            </div>


            <div class="camera-box">

                <video
                    id="webcam"
                    autoplay
                    muted
                    playsinline
                ></video>

                <canvas
                    id="overlay"
                ></canvas>

                <div class="face-guide"></div>

                <div class="scan-line"></div>

            </div>


            <!-- STATUS -->

            <div style="margin-top:25px;">

                <div
                    style="
                        display:flex;
                        justify-content:space-between;
                        margin-bottom:8px;
                    "
                >

                    <span>
                        Detection Status
                    </span>

                    <span
                        id="statusText"
                        style="color:#00ff88;"
                    >

                        Initializing...

                    </span>

                </div>


                <!-- PROGRESS -->

                <div class="progress">

                    <div
                        class="progress-bar"
                        id="progressBar"
                    ></div>

                </div>


                <div
                    style="
                        margin-top:15px;
                        display:flex;
                        justify-content:space-between;
                        color:#8db8e8;
                    "
                >

                    <span>
                        Captured
                    </span>

                    <span id="captureCount">

                        0 / 7

                    </span>

                </div>


                <!-- INSTRUCTION -->

                <div
                    class="instruction"
                    id="instruction"
                >

                    Press START to begin registration

                </div>


                <!-- SECURITY NOTE -->

                <div class="security-note">

                    Follow the movement shown on screen.
                    The system will wait until you complete
                    the action. There is no time limit.

                </div>


                <!-- CONTROLS -->

                <div class="controls">

                    <button
                        id="startBtn"
                    >

                        START REGISTRATION

                    </button>


                    <button
                        id="cancelBtn"
                    >

                        CANCEL

                    </button>

                </div>

            </div>

        </div>


        <!-- ===================================================== -->
        <!-- SIDE -->
        <!-- ===================================================== -->

        <div class="side">


            <!-- EMPLOYEE INFORMATION -->

            <div class="glass employee-card">

                <div class="avatar">

                    {{ strtoupper(substr($user->name, 0, 1)) }}

                </div>


                <div class="emp-name">

                    {{ $user->name }}

                </div>


                <div class="emp-position">

                    Employee

                </div>


                <div class="info">

                    <span>
                        Employee ID
                    </span>

                    <span>
                        {{ $user->employee_id }}
                    </span>

                </div>


                <div class="info">

                    <span>
                        Email
                    </span>

                    <span>
                        {{ $user->email }}
                    </span>

                </div>


                <div class="info">

                    <span>
                        Department
                    </span>

                    <span>
                        {{ $user->department ?? 'N/A' }}
                    </span>

                </div>


                <div class="info">

                    <span>
                        Face Registered
                    </span>

                    <span>

                        @if ($user->face_registered)

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


            <!-- ================================================= -->
            <!-- AI STATUS -->
            <!-- ================================================= -->

            <div class="glass status-card">

                <h5 style="margin-bottom:25px;">

                    AI STATUS

                </h5>


                <div class="status">

                    <div
                        class="dot"
                        id="cameraDot"
                    ></div>

                    Camera Ready

                </div>


                <div class="status">

                    <div
                        class="dot"
                        id="modelDot"
                    ></div>

                    Models Loaded

                </div>


                <div class="status">

                    <div
                        class="dot"
                        id="faceDot"
                    ></div>

                    Face Detected

                </div>


                <div class="status">

                    <div
                        class="dot"
                        id="qualityDot"
                    ></div>

                    Registration Complete

                </div>

            </div>

        </div>

    </div>

</div>


<script>

/*
|--------------------------------------------------------------------------
| ELEMENTS
|--------------------------------------------------------------------------
*/

const video =
    document.getElementById("webcam");

const canvas =
    document.getElementById("overlay");

const statusText =
    document.getElementById("statusText");

const progress =
    document.getElementById("progressBar");

const capture =
    document.getElementById("captureCount");

const instruction =
    document.getElementById("instruction");

const cameraDot =
    document.getElementById("cameraDot");

const modelDot =
    document.getElementById("modelDot");

const faceDot =
    document.getElementById("faceDot");

const qualityDot =
    document.getElementById("qualityDot");

const startBtn =
    document.getElementById("startBtn");

const cancelBtn =
    document.getElementById("cancelBtn");


/*
|--------------------------------------------------------------------------
| REGISTRATION VARIABLES
|--------------------------------------------------------------------------
*/

let descriptors = [];

let running = false;

let cancelled = false;

let detectionLoopStarted = false;


/*
|--------------------------------------------------------------------------
| LIVENESS SETTINGS
|--------------------------------------------------------------------------
*/

const REQUIRED_VALID_FRAMES = 5;


/*
|--------------------------------------------------------------------------
| DELAY BETWEEN CHALLENGES
|--------------------------------------------------------------------------
*/

const BETWEEN_CHALLENGES_DELAY = 600;


/*
|--------------------------------------------------------------------------
| MOVEMENT SETTINGS
|--------------------------------------------------------------------------
*/

const TURN_THRESHOLD = 0.13;

const FRONT_THRESHOLD = 0.075;


/*
|--------------------------------------------------------------------------
| SMILE SETTINGS
|--------------------------------------------------------------------------
|
| The smile is now compared against the user's own neutral
| mouth instead of using one fixed mouth ratio.
|
| A smile is accepted when either:
|
| 1. The mouth becomes slightly wider
|
| OR
|
| 2. The mouth corners move upward.
|
| This makes smile detection much easier for different
| faces, cameras, and natural smiles.
|
|--------------------------------------------------------------------------
*/

const SMILE_WIDTH_INCREASE = 0.025;

const SMILE_CORNER_LIFT = 0.012;


/*
|--------------------------------------------------------------------------
| FACE DETECTOR
|--------------------------------------------------------------------------
*/

const FACE_DETECTOR_OPTIONS =
    new faceapi.TinyFaceDetectorOptions({

        inputSize: 416,

        scoreThreshold: 0.40

    });


/*
|--------------------------------------------------------------------------
| LOAD MODELS
|--------------------------------------------------------------------------
*/

async function loadModels()
{

    statusText.innerHTML =
        "Loading AI Models...";


    await faceapi.nets.tinyFaceDetector
        .loadFromUri("/models");


    await faceapi.nets.faceLandmark68Net
        .loadFromUri("/models");


    await faceapi.nets.faceRecognitionNet
        .loadFromUri("/models");


    modelDot.classList.add(
        "active"
    );


    statusText.innerHTML =
        "Models Loaded";

}


/*
|--------------------------------------------------------------------------
| START CAMERA
|--------------------------------------------------------------------------
*/

async function startCamera()
{

    try {

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


        await video.play();


        cameraDot.classList.add(
            "active"
        );


        statusText.innerHTML =
            "Camera Ready";

    }
    catch (error)
    {

        console.error(
            "Camera error:",
            error
        );


        statusText.innerHTML =
            "Camera Access Failed";


        alert(
            "Unable to access the camera.\n\n" +
            "Please make sure the camera is connected " +
            "and Chrome has permission to use it."
        );

    }

}


/*
|--------------------------------------------------------------------------
| GET FACE
|--------------------------------------------------------------------------
*/

async function getFace()
{

    if (
        !video.videoWidth ||
        video.readyState < 2
    ) {

        return null;

    }


    return await faceapi

        .detectSingleFace(
            video,
            FACE_DETECTOR_OPTIONS
        )

        .withFaceLandmarks()

        .withFaceDescriptor();

}


/*
|--------------------------------------------------------------------------
| AVERAGE POINT
|--------------------------------------------------------------------------
*/

function averagePoint(points)
{

    let x = 0;

    let y = 0;


    points.forEach(
        point =>
        {

            x += point.x;

            y += point.y;

        }
    );


    return {

        x:
            x / points.length,

        y:
            y / points.length

    };

}


/*
|--------------------------------------------------------------------------
| DISTANCE
|--------------------------------------------------------------------------
*/

function distance(a, b)
{

    return Math.sqrt(

        Math.pow(
            a.x - b.x,
            2
        )

        +

        Math.pow(
            a.y - b.y,
            2
        )

    );

}


/*
|--------------------------------------------------------------------------
| FACE METRICS
|--------------------------------------------------------------------------
*/

function getFaceMetrics(landmarks)
{

    const p =
        landmarks.positions;


    /*
    |--------------------------------------------------------------------------
    | EYES
    |--------------------------------------------------------------------------
    */

    const leftEye =
        averagePoint(
            p.slice(36, 42)
        );


    const rightEye =
        averagePoint(
            p.slice(42, 48)
        );


    const eyeCenter = {

        x:
            (
                leftEye.x +
                rightEye.x
            ) / 2,

        y:
            (
                leftEye.y +
                rightEye.y
            ) / 2

    };


    const eyeDistance =
        distance(
            leftEye,
            rightEye
        );


    /*
    |--------------------------------------------------------------------------
    | NOSE
    |--------------------------------------------------------------------------
    */

    const nose =
        averagePoint(
            p.slice(27, 36)
        );


    /*
    |--------------------------------------------------------------------------
    | MOUTH
    |--------------------------------------------------------------------------
    */

    const mouthLeft =
        p[48];

    const mouthRight =
        p[54];

    const mouthTop =
        p[51];

    const mouthBottom =
        p[57];


    const mouthCenter = {

        x:
            (
                mouthLeft.x +
                mouthRight.x
            ) / 2,

        y:
            (
                mouthTop.y +
                mouthBottom.y
            ) / 2

    };


    const mouthWidth =
        distance(
            mouthLeft,
            mouthRight
        );


    const mouthHeight =
        distance(
            mouthTop,
            mouthBottom
        );


    /*
    |--------------------------------------------------------------------------
    | NORMALIZED MOUTH WIDTH
    |--------------------------------------------------------------------------
    |
    | Normalizing against eye distance makes the
    | measurement less affected by distance from camera.
    |
    */

    const normalizedMouthWidth =
        mouthWidth /
        Math.max(
            eyeDistance,
            1
        );


    /*
    |--------------------------------------------------------------------------
    | MOUTH CORNER POSITION
    |--------------------------------------------------------------------------
    |
    | Lower Y = higher on the screen.
    |
    | When smiling, the mouth corners normally move upward.
    |
    */

    const leftCornerY =
        (
            mouthLeft.y -
            eyeCenter.y
        ) /
        Math.max(
            eyeDistance,
            1
        );


    const rightCornerY =
        (
            mouthRight.y -
            eyeCenter.y
        ) /
        Math.max(
            eyeDistance,
            1
        );


    const averageCornerY =
        (
            leftCornerY +
            rightCornerY
        ) / 2;


    /*
    |--------------------------------------------------------------------------
    | HEAD HORIZONTAL POSITION
    |--------------------------------------------------------------------------
    */

    const yaw =
        (
            nose.x -
            eyeCenter.x
        ) /
        Math.max(
            eyeDistance,
            1
        );


    /*
    |--------------------------------------------------------------------------
    | HEAD VERTICAL POSITION
    |--------------------------------------------------------------------------
    */

    const pitch =
        (
            nose.y -
            eyeCenter.y
        ) /
        Math.max(
            eyeDistance,
            1
        );


    return {

        yaw,

        pitch,

        normalizedMouthWidth,

        averageCornerY,

        mouthWidth,

        mouthHeight

    };

}


/*
|--------------------------------------------------------------------------
| CHECK SMILE
|--------------------------------------------------------------------------
*/

function checkSmile(
    metrics,
    baseline
)
{

    if (
        !baseline
    ) {

        return false;

    }


    /*
    |--------------------------------------------------------------------------
    | MOUTH WIDTH CHANGE
    |--------------------------------------------------------------------------
    |
    | A small increase is enough.
    |
    */

    const widthIncrease =
        metrics.normalizedMouthWidth -
        baseline.normalizedMouthWidth;


    const widthSmiling =
        widthIncrease >=
        SMILE_WIDTH_INCREASE;


    /*
    |--------------------------------------------------------------------------
    | MOUTH CORNER LIFT
    |--------------------------------------------------------------------------
    |
    | Smaller Y means the corner moved upward.
    |
    */

    const cornerLift =
        baseline.averageCornerY -
        metrics.averageCornerY;


    const cornersSmiling =
        cornerLift >=
        SMILE_CORNER_LIFT;


    /*
    |--------------------------------------------------------------------------
    | ACCEPT SMILE
    |--------------------------------------------------------------------------
    |
    | Either signal can trigger the smile.
    |
    | This is intentionally forgiving.
    |
    */

    return (
        widthSmiling ||
        cornersSmiling
    );

}


/*
|--------------------------------------------------------------------------
| CHECK ACTION
|--------------------------------------------------------------------------
*/

function checkAction(
    action,
    metrics,
    baseline
)
{

    const yawDifference =
        metrics.yaw -
        baseline.yaw;


    /*
    |--------------------------------------------------------------------------
    | FACE FRONT
    |--------------------------------------------------------------------------
    */

    if (
        action === "Face Front"
    ) {

        return (

            Math.abs(
                yawDifference
            ) <=
            FRONT_THRESHOLD

        );

    }


    /*
    |--------------------------------------------------------------------------
    | MOVE LEFT
    |--------------------------------------------------------------------------
    */

    if (
        action === "Move Left"
    ) {

        return (

            yawDifference <=
            -TURN_THRESHOLD

        );

    }


    /*
    |--------------------------------------------------------------------------
    | MOVE RIGHT
    |--------------------------------------------------------------------------
    */

    if (
        action === "Move Right"
    ) {

        return (

            yawDifference >=
            TURN_THRESHOLD

        );

    }


    /*
    |--------------------------------------------------------------------------
    | SMILE
    |--------------------------------------------------------------------------
    */

    if (
        action === "Smile"
    ) {

        return checkSmile(
            metrics,
            baseline
        );

    }


    return false;

}


/*
|--------------------------------------------------------------------------
| BEEP
|--------------------------------------------------------------------------
*/

function beep()
{

    try {

        const ctx =
            new AudioContext();


        const oscillator =
            ctx.createOscillator();


        const gain =
            ctx.createGain();


        oscillator.connect(
            gain
        );


        gain.connect(
            ctx.destination
        );


        oscillator.frequency.value =
            900;


        gain.gain.setValueAtTime(
            0.12,
            ctx.currentTime
        );


        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            ctx.currentTime + 0.15
        );


        oscillator.start();


        oscillator.stop(
            ctx.currentTime + 0.15
        );

    }
    catch (error)
    {

        console.warn(
            "Audio unavailable."
        );

    }

}


/*
|--------------------------------------------------------------------------
| GET BASELINE
|--------------------------------------------------------------------------
|
| This learns the employee's natural face position,
| including their neutral mouth shape.
|
|--------------------------------------------------------------------------
*/

async function getBaseline()
{

    instruction.innerHTML =
        "Position your face inside the guide";


    statusText.innerHTML =
        "Detecting your face...";


    const samples = [];


    /*
    |--------------------------------------------------------------------------
    | NO TIMEOUT
    |--------------------------------------------------------------------------
    */

    while (
        samples.length < 8
    )
    {

        if (cancelled)
        {

            throw new Error(
                "Registration cancelled"
            );

        }


        const result =
            await getFace();


        if (result)
        {

            faceDot.classList.add(
                "active"
            );


            const metrics =
                getFaceMetrics(
                    result.landmarks
                );


            samples.push(
                metrics
            );


            statusText.innerHTML =
                `Face detected - calibrating ${samples.length}/8`;

        }
        else
        {

            faceDot.classList.remove(
                "active"
            );


            statusText.innerHTML =
                "Place your face inside the guide";

        }


        await new Promise(
            resolve =>
                setTimeout(
                    resolve,
                    120
                )
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CREATE BASELINE
    |--------------------------------------------------------------------------
    */

    const baseline = {

        yaw:
            samples.reduce(
                (sum, item) =>
                    sum + item.yaw,
                0
            ) /
            samples.length,


        pitch:
            samples.reduce(
                (sum, item) =>
                    sum + item.pitch,
                0
            ) /
            samples.length,


        normalizedMouthWidth:
            samples.reduce(
                (sum, item) =>
                    sum + item.normalizedMouthWidth,
                0
            ) /
            samples.length,


        averageCornerY:
            samples.reduce(
                (sum, item) =>
                    sum + item.averageCornerY,
                0
            ) /
            samples.length

    };


    console.log(
        "Natural face baseline:",
        baseline
    );


    return baseline;

}


/*
|--------------------------------------------------------------------------
| WAIT FOR ACTION
|--------------------------------------------------------------------------
|
| THERE IS NO TIMEOUT.
|
|--------------------------------------------------------------------------
*/

async function waitForAction(
    action,
    baseline
)
{

    let validFrames = 0;


    while (true)
    {

        /*
        |--------------------------------------------------------------------------
        | CANCEL CHECK
        |--------------------------------------------------------------------------
        */

        if (cancelled)
        {

            throw new Error(
                "Registration cancelled"
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GET FACE
        |--------------------------------------------------------------------------
        */

        const result =
            await getFace();


        if (!result)
        {

            validFrames = 0;


            faceDot.classList.remove(
                "active"
            );


            statusText.innerHTML =
                "Face not detected - position your face in the guide";


            await new Promise(
                resolve =>
                    setTimeout(
                        resolve,
                        120
                    )
            );


            continue;

        }


        /*
        |--------------------------------------------------------------------------
        | FACE FOUND
        |--------------------------------------------------------------------------
        */

        faceDot.classList.add(
            "active"
        );


        const metrics =
            getFaceMetrics(
                result.landmarks
            );


        /*
        |--------------------------------------------------------------------------
        | CHECK ACTION
        |--------------------------------------------------------------------------
        */

        const valid =
            checkAction(
                action,
                metrics,
                baseline
            );


        /*
        |--------------------------------------------------------------------------
        | CORRECT ACTION
        |--------------------------------------------------------------------------
        */

        if (valid)
        {

            validFrames++;


            statusText.innerHTML =
                `${action} detected... ${validFrames}/${REQUIRED_VALID_FRAMES}`;


            /*
            |--------------------------------------------------------------------------
            | SUCCESS
            |--------------------------------------------------------------------------
            */

            if (
                validFrames >=
                REQUIRED_VALID_FRAMES
            )
            {

                return {

                    success: true,

                    descriptor:
                        Array.from(
                            result.descriptor
                        )

                };

            }

        }
        else
        {

            validFrames = 0;


            statusText.innerHTML =
                `Waiting for: ${action}`;

        }


        await new Promise(
            resolve =>
                setTimeout(
                    resolve,
                    120
                )
        );

    }

}


/*
|--------------------------------------------------------------------------
| FINAL CHALLENGE SEQUENCE
|--------------------------------------------------------------------------
*/

const instructions = [

    "Face Front",

    "Move Left",

    "Move Right",

    "Smile",

    "Move Left",

    "Move Right",

    "Smile"

];


/*
|--------------------------------------------------------------------------
| START REGISTRATION
|--------------------------------------------------------------------------
*/

startBtn.onclick =
    async function()
{

    if (running)
    {

        return;

    }


    running = true;

    cancelled = false;


    startBtn.disabled =
        true;


    descriptors = [];


    progress.style.width =
        "0%";


    capture.innerHTML =
        `0 / ${instructions.length}`;


    qualityDot.classList.remove(
        "active"
    );


    try
    {

        /*
        |--------------------------------------------------------------------------
        | CALIBRATE NATURAL FACE
        |--------------------------------------------------------------------------
        */

        const baseline =
            await getBaseline();


        /*
        |--------------------------------------------------------------------------
        | START LIVENESS
        |--------------------------------------------------------------------------
        */

        statusText.innerHTML =
            "Liveness verification started";


        /*
        |--------------------------------------------------------------------------
        | RUN ALL ACTIONS
        |--------------------------------------------------------------------------
        */

        for (
            let i = 0;
            i < instructions.length;
            i++
        )
        {

            if (cancelled)
            {

                throw new Error(
                    "Registration cancelled"
                );

            }


            const action =
                instructions[i];


            /*
            |--------------------------------------------------------------------------
            | SHOW INSTRUCTION
            |--------------------------------------------------------------------------
            */

            instruction.innerHTML =
                `<strong>${action}</strong>`;


            statusText.innerHTML =
                `Please ${action.toLowerCase()}`;


            /*
            |--------------------------------------------------------------------------
            | WAIT INDEFINITELY
            |--------------------------------------------------------------------------
            */

            const result =
                await waitForAction(
                    action,
                    baseline
                );


            /*
            |--------------------------------------------------------------------------
            | SAVE DESCRIPTOR
            |--------------------------------------------------------------------------
            */

            descriptors.push(
                result.descriptor
            );


            beep();


            /*
            |--------------------------------------------------------------------------
            | UPDATE PROGRESS
            |--------------------------------------------------------------------------
            */

            const percent =
                (
                    (i + 1) /
                    instructions.length
                ) * 100;


            progress.style.width =
                `${percent}%`;


            capture.innerHTML =
                `${i + 1} / ${instructions.length}`;


            instruction.innerHTML =
                `<strong>${action} ✓</strong>`;


            statusText.innerHTML =
                "Action verified ✓";


            /*
            |--------------------------------------------------------------------------
            | SMALL DELAY
            |--------------------------------------------------------------------------
            */

            await new Promise(
                resolve =>
                    setTimeout(
                        resolve,
                        BETWEEN_CHALLENGES_DELAY
                    )
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PROCESS FACE
        |--------------------------------------------------------------------------
        */

        instruction.innerHTML =
            "Processing Face Descriptor...";


        statusText.innerHTML =
            "Creating secure biometric profile";


        /*
        |--------------------------------------------------------------------------
        | AVERAGE 128-D FACE DESCRIPTOR
        |--------------------------------------------------------------------------
        */

        const average = [];


        for (
            let i = 0;
            i < 128;
            i++
        )
        {

            let sum = 0;


            descriptors.forEach(
                descriptor =>
                {

                    sum +=
                        descriptor[i];

                }
            );


            average.push(
                sum /
                descriptors.length
            );

        }


        console.log(
            "Average face descriptor:",
            average
        );


        /*
        |--------------------------------------------------------------------------
        | SAVE TO LARAVEL
        |--------------------------------------------------------------------------
        */

        const response =
            await fetch(
                "{{ route('face.save', $user->id) }}",
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

                            descriptor:
                                average

                        })

                }
            );


        /*
        |--------------------------------------------------------------------------
        | SERVER RESPONSE
        |--------------------------------------------------------------------------
        */

        const data =
            await response.json();


        if (!data.success)
        {

            throw new Error(

                data.message ||
                "Failed to save face."

            );

        }


        /*
        |--------------------------------------------------------------------------
        | REGISTRATION SUCCESS
        |--------------------------------------------------------------------------
        */

        qualityDot.classList.add(
            "active"
        );


        progress.style.width =
            "100%";


        statusText.innerHTML =
            "Registration Complete ✓";


        instruction.innerHTML =
            "Face Registered Successfully ✓";


        capture.innerHTML =
            `${instructions.length} / ${instructions.length}`;


        alert(
            "Face Registered Successfully!"
        );


        window.location.href =
            "{{ route('employees.index') }}";

    }
    catch (error)
    {

        console.error(
            "Face registration error:",
            error
        );


        /*
        |--------------------------------------------------------------------------
        | CANCELLED
        |--------------------------------------------------------------------------
        */

        if (
            error.message ===
            "Registration cancelled"
        )
        {

            statusText.innerHTML =
                "Registration cancelled";


            instruction.innerHTML =
                "Registration cancelled";


            return;

        }


        /*
        |--------------------------------------------------------------------------
        | OTHER ERROR
        |--------------------------------------------------------------------------
        */

        descriptors = [];


        progress.style.width =
            "0%";


        capture.innerHTML =
            `0 / ${instructions.length}`;


        instruction.innerHTML =
            "Registration failed";


        statusText.innerHTML =
            "Registration error";


        alert(
            "Registration failed.\n\n" +
            "Please make sure your face is clearly visible " +
            "and try again."
        );

    }
    finally
    {

        running = false;

        cancelled = false;

        startBtn.disabled =
            false;

    }

};


/*
|--------------------------------------------------------------------------
| LIVE FACE DETECTION
|--------------------------------------------------------------------------
*/

async function detect()
{

    if (
        detectionLoopStarted
    )
    {

        return;

    }


    detectionLoopStarted =
        true;


    const ctx =
        canvas.getContext(
            "2d"
        );


    /*
    |--------------------------------------------------------------------------
    | WAIT FOR VIDEO
    |--------------------------------------------------------------------------
    */

    while (
        !video.videoWidth
    )
    {

        await new Promise(
            resolve =>
                setTimeout(
                    resolve,
                    200
                )
        );

    }


    /*
    |--------------------------------------------------------------------------
    | CANVAS SIZE
    |--------------------------------------------------------------------------
    */

    function updateCanvasSize()
    {

        const displaySize = {

            width:
                video.clientWidth,

            height:
                video.clientHeight

        };


        canvas.width =
            displaySize.width;


        canvas.height =
            displaySize.height;


        faceapi.matchDimensions(
            canvas,
            displaySize
        );

    }


    updateCanvasSize();


    window.addEventListener(
        "resize",
        updateCanvasSize
    );


    /*
    |--------------------------------------------------------------------------
    | LIVE DETECTION LOOP
    |--------------------------------------------------------------------------
    */

    setInterval(
        async () =>
        {

            if (
                !video.videoWidth ||
                video.paused
            )
            {

                return;

            }


            try
            {

                const detection =
                    await faceapi

                        .detectSingleFace(
                            video,
                            FACE_DETECTOR_OPTIONS
                        )

                        .withFaceLandmarks();


                ctx.clearRect(
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );


                if (detection)
                {

                    faceDot.classList.add(
                        "active"
                    );


                    if (!running)
                    {

                        statusText.innerHTML =
                            "Face Detected";

                    }


                    const displaySize = {

                        width:
                            video.clientWidth,

                        height:
                            video.clientHeight

                    };


                    const resized =
                        faceapi.resizeResults(
                            detection,
                            displaySize
                        );


                    faceapi.draw.drawDetections(
                        canvas,
                        [resized]
                    );

                }
                else
                {

                    faceDot.classList.remove(
                        "active"
                    );


                    if (!running)
                    {

                        statusText.innerHTML =
                            "No Face";

                    }

                }

            }
            catch (error)
            {

                console.warn(
                    "Live detection error:",
                    error
                );

            }

        },
        180
    );

}


/*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/

cancelBtn.onclick =
    function()
{

    if (!running)
    {

        window.location.href =
            "{{ route('employees.index') }}";

        return;

    }


    cancelled = true;

    running = false;


    descriptors = [];


    progress.style.width =
        "0%";


    capture.innerHTML =
        `0 / ${instructions.length}`;


    instruction.innerHTML =
        "Registration cancelled";


    statusText.innerHTML =
        "Registration cancelled";


    startBtn.disabled =
        false;

};


/*
|--------------------------------------------------------------------------
| STOP CAMERA WHEN LEAVING
|--------------------------------------------------------------------------
*/

window.addEventListener(
    "beforeunload",
    function()
    {

        if (
            video.srcObject
        )
        {

            video.srcObject
                .getTracks()
                .forEach(
                    track =>
                        track.stop()
                );

        }

    }
);


/*
|--------------------------------------------------------------------------
| INITIALIZE
|--------------------------------------------------------------------------
*/

(async function()
{

    try
    {

        await loadModels();


        await startCamera();


        video.addEventListener(
            "playing",
            detect,
            {
                once: true
            }
        );

    }
    catch (error)
    {

        console.error(
            "Initialization error:",
            error
        );


        statusText.innerHTML =
            "System initialization failed";

    }

})();

</script>

</body>

</html>
