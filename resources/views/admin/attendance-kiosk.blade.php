<!DOCTYPE html>
<html>
<head>
    <title>PapPay Attendance Kiosk</title>

    <script src="/js/face-api.min.js"></script>
</head>

<body>

    <video
        id="video"
        width="1280"
        height="720"
        autoplay
        muted
        playsinline>
    </video>

    <script>

        async function startSystem(){

            // Load AI models
            await faceapi.nets.tinyFaceDetector.loadFromUri('/models');
            await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
            await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

            // Load registered employees
            const response = await fetch("/admin/attendance/faces");
            const employees = await response.json();

            console.log(employees);

            // Open camera
            const stream = await navigator.mediaDevices.getUserMedia({
                video:{
                    width:1280,
                    height:720
                }
            });

            const video = document.getElementById("video");
            video.srcObject = stream;

            video.onloadedmetadata = () => {

                video.play();

                recognizeFace(video, employees);

            };

        }

        async function recognizeFace(video, employees){

            setInterval(async ()=>{

                const result = await faceapi
                    .detectSingleFace(
                        video,
                        new faceapi.TinyFaceDetectorOptions()
                    )
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if(!result){

                    console.log("No face detected");

                    return;

                }

                let bestEmployee = null;
                let smallestDistance = 999;

                employees.forEach(employee=>{

                    const storedDescriptor =
                        new Float32Array(employee.descriptor);

                    const distance =
                        faceapi.euclideanDistance(
                            result.descriptor,
                            storedDescriptor
                        );

                    if(distance < smallestDistance){

                        smallestDistance = distance;
                        bestEmployee = employee;

                    }

                });

                if(bestEmployee && smallestDistance < 0.45){

                    console.log("Recognized");

                    console.log(bestEmployee.name);

                    console.log(smallestDistance);

                }else{

                    console.log("Unknown");

                }

            },500);

        }

        startSystem();

    </script>

</body>
</html>