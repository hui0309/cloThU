<?php
    // Check if the user is already logged in, if yes then redirect him to welcome page
    include("con_db.php");
    // Processing form data when form is submitted
    if(isset($_SESSION["login"])){
        header('Location: ./person.php');
        exit;
    }
?>
<html>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
<script >
    var now = "login";
    var src = "./login.html";
    function change(login){
        now = (login==1? "login" : "register");
        src = (login==1? "./login.html" : "./register.html");
        document.getElementById("title").textContent = now;
        document.getElementById("iframe").src = src;
        document.getElementById("註冊").disabled = (login == 1? false:true);
        document.getElementById("登入").disabled = (login == 0? false:true);
    }
</script>
<head><title id = "title">login</title></head>
<body>
    <input type="button" value="註冊" id = "註冊" onClick = "change(0)">
    <input type="button" value="登入" id = "登入" onClick = "change(1)" disabled><br><br>
    <iframe id = "iframe"
        src = "./login.html"
        height="200" 
        width="300">
    </iframe>
</body>
</html>
