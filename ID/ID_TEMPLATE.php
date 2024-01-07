<?php
require_once "../includes/config.php";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?loginError");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styleID.css">
    <title>ID Template</title>
    <link rel="icon" type="images/x-icon" href="../images/favicon.png">
    <style>
        .capitalize {
            text-transform: capitalize;
        }

        .photo img {
            object-fit: cover;
        }

        .selectPhoto {
            position: absolute;
            top: 180px;
            right: 10px;
            translate: 0 0;
            text-align: right;
        }

        .selectPhoto label {
            position: absolute;
            top: 20px;
            right: 0;
            text-align: center;
            max-width: 125px;
            min-width: 125px;
            display: block;
        }

        .selectPhoto input {
            visibility: hidden;
        }

        .selectPhoto label {
            background-color: rgb(202, 247, 183);
            padding: 7px;
            border-radius: 10px;
            border: 2px solid rgb(44, 132, 64);
            cursor: pointer;
        }

        .navi img {
            width: 50px;
            height: 45px;
        }

        .navi {
            position: absolute;
            border: 3px solid rgb(30, 48, 80);
            right: 10px;
            transition-duration: 500ms;
        }

        .home {
            top: 10px;
            left: 10px;
            width: 45px;
            height: 45px;
            border: none;
        }

        .navi:hover {
            background-color: rgb(178, 201, 243);
        }

        .printButton {
            top: 10px;
        }

        .takePictureButton {
            top: 70px;
        }

        .redoButton {
            top: 130px;
        }

        .signaturePhoto {
            position: absolute;
            width: 150px;
            height: 25px;
            bottom: 55px;
            left: 50%;
            translate: -50% 0%;
        }

        .userSig {
            cursor: pointer;
        }

        .signaturePhoto img {
            display: block;
            margin: auto;
            height: 25px;
        }

        #userSignatureButton {
            transition-duration: 300ms;
        }

        #userSignatureButton:hover {
            color: blue;
        }

        #IDnumber:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <?php
    $id = $_GET['id'];

    try {
        require_once "../includes/dbh.inc.php";

        $query = "SELECT * FROM userinfo WHERE idNum = :idNum;";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":idNum", $id);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            $userName = htmlspecialchars($row["lastName"]) . ', ' . htmlspecialchars($row["firstName"]);
            $lastName = htmlspecialchars($row["lastName"]);
            $firstName = htmlspecialchars($row["firstName"]);
            $idStored = htmlspecialchars($row["idNum"]);
            $userAge = htmlspecialchars($row["age"]);
            $userSex = htmlspecialchars($row["sex"]);
            $userAddress = htmlspecialchars($row["address"]);
            $userEmergency = htmlspecialchars($row["emergency"]);
            $userDiagnosis = htmlspecialchars($row["diagnosis"]);
            $userDateNgi = htmlspecialchars($row["date"]);
            $userDate = substr($userDateNgi, 0, 10);
        }
    } catch (PDOException $e) {
        die("Query Failed: " > $e->getMessage());
    }
    ?>
    <div class="container">
        <div class="front">
            <div class="header1">
                <h4>Republic of the Philippines<br>CITY OF MANILA<br><br></h4>
            </div>
            <label for="IDnumber" title="Enter ID number">
                <hr class="IDinput">
                <p class="IDtext">I.D. No. </p>
            </label>
            <input readonly value="<?php echo $idStored ?>" title="Enter ID number" type="text" id="IDnumber" style="border: none; position:absolute; top:160px; font-size: 10px; width: 65px; left:95px; background:transparent; text-align:center;">

            <span class="NAMEtext2 capitalize"><?php echo $userName; ?></span>

            <hr class="NAMEline">
            <P class="NAMEtext">NAME</P>

            <span class="ADDtext2 capitalize"><?php echo $row['address']; ?></span>
            <hr class="ADDline">
            <p class="ADDtext">ADDRESS</p>

            <p class="BRGYIDtext">Healthcare ID</p>
            <div class="photo"><img id="photo" src="sample_id.jpg" alt="" height="96px" width="96px"></div>
            <div class="photo getPicture video" style="overflow: hidden; display: none;"><video id="webCam" autoplay playsinlne width="96px" height="96px" style="object-fit: cover;"></video></div>
            <div class="photo getPicture canvas" style="overflow: hidden; display: none;"><canvas id="canvas" style="object-fit: cover; transform: scaleX(1.33);"></canvas></div>
            <div class="brgylogo"></div>
            <div class="manilalogo"></div>
            <div class="top"></div>
            <div class="bottom"></div>
        </div>

        <div class="back">
            <div class="border">
                <table>
                    <tr>
                        <td>
                            <p>Age:</p>
                            <p class="back-input1 capitalize"><?php echo $userAge; ?></p>
                        </td>
                        <td>
                            <p>Sex:</p>
                            <p class="back-input1"><?php echo $userSex; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Emergency:</p>
                            <p class="back-input1"><?php echo $userEmergency; ?></p>
                        </td>
                        <td>
                            <p>Date Registered:</p>
                            <p class="back-input1"><?php echo $userDate; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Diagnosis:</p>
                            <p class="back-input1"><?php echo $userDiagnosis; ?></p>
                        </td>
                    </tr>

                </table>
                <hr class="back-line"><label for="userSignatureSubmit" style="cursor: pointer;" title="Enter Signature">
                    <p class="backtext-sign" id="userSignatureButton">SIGNATURE</p>
                </label>
                <input type="file" accept="image/*" hidden id="userSignatureSubmit">
            </div>
            <div class="middle-back"></div>
            <h6 class="MIDBacktext">PLEASE RETURN IN NEAREST BARANGAY<br>WHEN FOUND</h6>
            <hr class="backname-line">

        </div>
    </div>
    <div class="selectPhoto">
        <input type="file" name="file" id="file" accept="image/*"><br>
        <label for="file" id="upload">Select an Image</label>
        <label id="snap" onclick="takeAPicture()" style="display: none;">Snap</label>
    </div>
    <a href="../adminPage.php">
        <div class="navi home" title="Home"><img src="../images/favicon.png" alt=""></div>
    </a>
    <div class="navi printButton" title="Print ID" onclick="printPage()"><img src="printLogo.png" alt=""></div>
    <div class="navi takePictureButton" title="Open Camera" onclick="hover.play()"><img src="cameraLogo.png" alt=""></div>
    <div class="navi redoButton" title="Reset to Default" onclick="window.location.reload()"><img src="redo.png" alt=""></div>

    <script>
        var Element = document.querySelector('#file');
        var img = document.querySelector('#photo');
        Element.addEventListener('change', function() {
            var url = URL.createObjectURL(Element.files[0]);
            img.src = url;
        })
        Element.addEventListener('click', function() {
            hover.play();
        });

        var userSignatureSubmit = document.querySelector('#userSignatureSubmit');
        var userSignaturePicture = document.querySelector('#userSignaturePicture');
        userSignatureSubmit.addEventListener('change', function() {
            var urli = URL.createObjectURL(userSignatureSubmit.files[0]);
            userSignaturePicture.src = urli;
        })
        userSignatureSubmit.addEventListener('click', function() {
            hover.play();
        });

        onOffCam = 0;
        const takePictureButton = document.querySelector('.takePictureButton');
        takePictureButton.addEventListener('click', function() {
            const video = document.querySelector('.video');
            const canvas = document.querySelector('.canvas');
            const snap = document.querySelector('#snap');
            const upload = document.querySelector('#upload');
            const cameraButton = document.querySelector('.takePictureButton');

            const webCamElement = document.querySelector('#webCam');
            const canvasElement = document.querySelector('#canvas');
            const webcam = new Webcam(webCamElement, 'user', canvasElement);
            console.log(webcam.webcamCount);



            if (onOffCam == 0) {
                video.style.display = 'block';
                canvas.style.display = 'block';
                snap.style.display = 'block';
                upload.style.display = 'none';
                cameraButton.style.backgroundColor = 'rgb(178, 201, 243)';
                webcam.start();
                onOffCam = 1;
            } else if (onOffCam == 1) {
                webcam.stop();
                video.style.display = 'none';
                canvas.style.display = 'none';
                snap.style.display = 'none';
                upload.style.display = 'block';
                cameraButton.style.background = 'none';
                onOffCam = 0;
            }

        })
    </script>
    <script>
        const hover = new Audio();
        hover.src = "../audio/hover.wav";
        const error = new Audio();
        error.src = "../audio/error.wav";
        const popUp = new Audio();
        popUp.src = "../audio/popUp.wav";
        const camera = new Audio();
        camera.src = "../audio/camera.wav";

        function printPage() {
            const navi = document.querySelectorAll('.navi');
            const buttons = document.querySelector('.selectPhoto');
            hover.play();
            setTimeout(() => {
                for (let i = 0; i < navi.length; i++) {
                    const element = navi[i];
                    element.style.opacity = '0';
                }
                buttons.style.opacity = '0';
            }, 0);
            setTimeout(() => {
                for (let i = 0; i < navi.length; i++) {
                    const element = navi[i];
                    element.style.display = 'none';
                }
                buttons.style.display = 'none';
            }, 500);
            setTimeout(() => {
                window.print();
            }, 550);
            setTimeout(() => {
                for (let i = 0; i < navi.length; i++) {
                    const element = navi[i];
                    element.style.display = 'block';
                }
                buttons.style.display = 'block';
            }, 550);
            setTimeout(() => {
                for (let i = 0; i < navi.length; i++) {
                    const element = navi[i];
                    element.style.opacity = '1';
                }
                buttons.style.opacity = '1';
            }, 600);

        }
    </script>
    <script src="webcam-easy.min.js"></script>
    <script>
        function takeAPicture() {
            const snap = document.querySelector('#snap');
            const canvas = document.querySelector('#canvas');
            if (snap.innerText == "Snap") {
                camera.play();
                const webCamElement = document.querySelector('#webCam');
                const canvasElement = document.querySelector('#canvas');
                const webcam = new Webcam(webCamElement, 'user', canvasElement);
                webcam.start();
                webcam.snap();
                webcam.stop();
                snap.innerText = 'Retake';

            } else if (snap.innerText == "Retake") {
                const webCamElement = document.querySelector('#webCam');
                const canvasElement = document.querySelector('#canvas');
                const canvasDiv = document.querySelector('.canvas');
                const videoDiv = document.querySelector('.video');
                //deleting the used canvas (ang trabaho naman neto)
                canvasDiv.removeChild(canvasElement);
                //new canvas
                const newCanvas = document.createElement('canvas');
                newCanvas.setAttribute('id', 'canvas');
                newCanvas.style.objectFit = 'cover';
                newCanvas.style.transform = 'scaleX(1.33)';
                canvasDiv.appendChild(newCanvas);

                snap.innerText = 'Snap';
            }
        }
    </script>
</body>

</html>