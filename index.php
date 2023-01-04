<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
include("session_init.php");
// Processing form data when form is submitted
if (isset($_SESSION["user_id"])) {
    header('Location: ./person.php');
    exit;
}
?>
<html>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
<script>
    var now = "login";
    var src = "./login.html";
    function change(login) {
        now = (login == 1 ? "login" : "register");
        src = (login == 1 ? "./login.html" : "./register.html");
        document.getElementById("title").textContent = now;
        document.getElementById("iframe").src = src;
        document.getElementById("註冊").disabled = (login == 1 ? false : true);
        document.getElementById("登入").disabled = (login == 0 ? false : true);
    }
</script>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title id="title">login</title>
    <style>
        html {
            height: 100%;
        }

        body {
            margin: 0;
        }

        .bg {
            animation: slide 3s ease-in-out infinite alternate;
            background-image: linear-gradient(-60deg, #e6d6b2 50%, #b07e4a 50%);
            bottom: 0;
            left: -50%;
            opacity: .5;
            position: fixed;
            right: -50%;
            top: 0;
            z-index: -1;
        }

        .bg2 {
            animation-direction: alternate-reverse;
            animation-duration: 4s;
        }

        .bg3 {
            animation-duration: 5s;
        }

        .content {
            background-color: rgba(255, 255, 255, .8);
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;
            left: 50%;
            padding: 10vmin;
            position: fixed;
            text-align: center;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        h1 {
            font-family: monospace;
        }

        @keyframes slide {
            0% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(25%);
            }
        }
    </style>
    <link href="jquery-ui.css" rel="stylesheet" />
	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>
</head>

<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="content">
        <input class="btn btn btn-secondary" type="button" value="註冊" id="註冊" onClick="change(0)">
        <input class="btn btn btn-secondary" type="button" value="登入" id="登入" onClick="change(1)" disabled><br><br>
        <iframe id="iframe" src="./login.html" height="200" width="300">
        </iframe>
    </div>
</body>

</html>