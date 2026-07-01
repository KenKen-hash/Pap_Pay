const video = document.getElementById("webcam");
const canvas = document.getElementById("overlay");
const ctx = canvas.getContext("2d");
const status = document.getElementById("status");

async function initializeKiosk() {

    status.innerHTML = "Initializing Camera...";

    const detector = new FaceDetection({

        locateFile: (file) => {

            return `https://cdn.jsdelivr.net/npm/@mediapipe/face_detection/${file}`;

        }

    });

    detector.setOptions({

        model: "short",
        minDetectionConfidence: 0.7

    });

    detector.onResults(results => {

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        ctx.clearRect(0,0,canvas.width,canvas.height);

        if(results.detections.length>0){

            status.innerHTML="😊 Face Detected";

            results.detections.forEach(face=>{

                const box=face.boundingBox;

                ctx.beginPath();

                ctx.lineWidth=4;

                ctx.strokeStyle="#00ff00";

                ctx.rect(

                    box.xCenter-box.width/2,
                    box.yCenter-box.height/2,
                    box.width,
                    box.height

                );

                ctx.stroke();

            });

        }

        else{

            status.innerHTML="👤 Waiting for Face";

        }

    });

    try{

        const stream=await navigator.mediaDevices.getUserMedia({

            video:{

                width:1280,
                height:720,
                facingMode:"user"

            }

        });

        video.srcObject=stream;

        video.onloadedmetadata=()=>{

            const camera=new Camera(video,{

                onFrame:async()=>{

                    await detector.send({

                        image:video

                    });

                },

                width:1280,
                height:720

            });

            camera.start();

        };

    }

    catch(error){

        console.error(error);

        status.innerHTML="❌ Cannot access camera";

    }

}

initializeKiosk();