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
<!-- <script>
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
</script> -->

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
    <script>
        function validateForm() {
            var user_pass = document.forms["register"]["user_pass"].value.toString();
            var user_id = document.forms["register"]["user_id"].value.toString();
            var user_mail = document.forms["register"]["user_mail"].value.toString();
            var emailrule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            var cha = /[a-zA-Z]+/, chn = /[0-9]+/, chstr = /[a-zA-Z0-9]{6,16}/;
            if (!chstr.test(user_pass)) {
                alert("密碼只能包含數字及英文符號，且長度為6-16位");
                document.getElementById("user_pass").value = "";
                return false;
            }
            if (!cha.test(user_pass) || !chn.test(user_pass)) {
                alert("密碼至少要包含一個英文字母及數字");
                document.getElementById("user_pass").value = "";
                return false;
            }
            if (!chstr.test(user_id)) {
                alert("帳號只能包含數字及英文符號，且長度為6-16位");
                document.getElementById("user_id").value = "";
                return false;
            }
            if (user_mail.search(emailrule) == -1) {
                alert("信箱格式輸入錯誤");
                document.getElementById("user_mail").value = "";
                return false;
            }
        }
    </script>
    <script>
        $(document).ready(() => {
            $("#registerArea").hide();
            $("#註冊").click(function () {
                $("#loginArea").hide();
                $("#registerArea").show();
                $("#註冊").prop("disabled", true);
                $("#登入").prop("disabled", false);
            });
            $("#登入").click(function () {
                $("#loginArea").show();
                $("#registerArea").hide();
                $("#註冊").prop("disabled", false);
                $("#登入").prop("disabled", true);
            });
            let see_ = false;
            $("#see").click(function () {
                if (see_) {
                    $("#user_pass").attr("type", "password");
                    $("#see").attr("value", "顯示密碼");
                }
                else {
                    $("#user_pass").attr("type", "text");
                    $("#see").attr("value", "隱藏密碼");
                }
                see_ = !see_;
            });
            let see1_ = false;
            $("#see1").click(function () {
                if (see1_) {
                    $("#user_pass1").attr("type", "password");
                    $("#see1").attr("value", "顯示密碼");
                }
                else {
                    $("#user_pass1").attr("type", "text");
                    $("#see1").attr("value", "隱藏密碼");
                }
                see1_ = !see1_;
            });
        });
    </script>
</head>

<body>
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
    <div class="container-fluid mt-3 m-1 justify-content-center">
        <div class="col-1 col-sm-3"></div>
        <div class="col-10 col-sm-6 content">
            <input class="btn btn btn-secondary" type="button" value="註冊" id="註冊">
            <input class="btn btn btn-secondary" type="button" value="登入" id="登入" disabled><br><br>
            <div id="loginArea">
                <form method="post" action="session_init.php">
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-sm-2 col-3 ">
                            帳 號：
                        </div>
                        <div class="col-sm-10 col-9">
                            <input class="form-control me-2 align-items-center" type="text" name="user_id" id="user_id"
                                maxlength="16">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-sm-2 col-3 ">
                            密 碼：<!--之後改可選隱藏-->
                        </div>
                        <div class="col-sm-10 col-9">
                            <div class="row">
                                <div class="col-5 col-sm-8">
                                    <input class="form-control me-2 align-items-center" type="password" id="user_pass"
                                        name="user_pass" maxlength="16">
                                </div>
                                <div class="col-5 col-sm-2 d-flex justify-content-center">
                                    <input type="button" id="see"
                                        class="far fa-eye-slash btn btn-outline-secondary text-nowrap" value='顯示密碼'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col">
                            <input type="button" value="忘記密碼" name="forget" class="btn btn-outline-danger text-nowrap">
                        </div>
                        <div class="col">
                            <input type="submit" value="登入" id="target" name="target"
                                class="btn btn-outline-success text-nowrap">
                        </div>
                    </div>
                </form>
            </div>
            <div id="registerArea">
                <form name="register" method="post" action="session_init.php" onsubmit="return validateForm()">
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-sm-2 col-3 ">
                            帳 號：
                        </div>
                        <div class="col-sm-10 col-9">

                            <input class="form-control me-2 align-items-center" type="text" name="user_id" id="user_id"
                                maxlength="16">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-sm-2 col-3 ">
                            密 碼：
                        </div>
                        <div class="col-sm-10 col-9">
                            <div class="row">
                                <div class="col-5 col-sm-8">
                                    <input class="form-control me-2 align-items-center" type="password" name="user_pass"
                                        id="user_pass1" maxlength="16">
                                </div>
                                <div class="col-5 col-sm-2 d-flex justify-content-center">
                                    <input type="button" id="see1"
                                        class="far fa-eye-slash btn btn-outline-secondary text-nowrap" value='顯示密碼'>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-sm-2 col-3 ">
                            信 箱：
                        </div>
                        <div class="col-sm-10 col-9 d-flex align-items-center mb-2">
                            <input class="form-control me-2 align-items-center"  type="text" name="user_mail" id="user_mail"><br /><br />
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col">
                            <input type="reset" value="重設" name="reset"  class="btn btn-outline-danger text-nowrap">
                        </div>
                        <div class="col">
                            <input type="submit" value="註冊" id="target" name="target" class="btn btn-outline-success text-nowrap">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1 col-sm-3"></div>
    </div>
</body>

</html>