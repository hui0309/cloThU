<?php
include("con_db.php");
// Initialize the session
/*session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}*/
?>
<html>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8">-->
<script language = "JavaScript">
    var now = "login";
    var src = "./login.html"
    function change(login){
        now = (login==1? "login":"register");
        src = (login==1? "./login.html":"./register.html");
        document.getElementById("title").textContent = now;
        document.getElementById("iframe").src = src;
    }
</script>
<head><title id = "title">login</title></head>
<body>
    <input type="button" value="註冊" onclick = "change(0)">
    <input type="button" value="登入" onclick = "change(1)"><br><br>
    <iframe id = "iframe"
        src = "./login.html"
        height="200" 
        width="300">
    </iframe>
</body>
</html>