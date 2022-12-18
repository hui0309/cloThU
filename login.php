<?php
//include con_db file
include("con_db.php");
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $user_pass = $_POST["user_pass"];
    $query = ("select * from user where user_id = ?");
    $stmt =  $db -> prepare($query);
    $error= $stmt -> execute(array($user_id));
    $result = $stmt -> fetchAll();
    if(count($result) == 1){
        $user_curpass = $result[0]["user_pass"];
        if(password_verify($user_pass, $user_curpass)){
            // Store data in session variables
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $result[0]["user_id"];
            $_SESSION["user_name"] = $result[0]["user_name"];
            $_SESSION["user_mail"] = $result[0]["user_mail"];
            //$_SESSION["user_img"] = $result[0]["user_img"];
            echo '<script language="javascript">';
            echo 'parent.location.reload();';
            echo '</script>';
            exit;
        }
        else{
            alert("帳號或密碼錯誤"); 
            exit;
        }
    }
    else{     
        alert("此帳號尚未註冊"); 
        exit;
    }
}
else{
    alert("Something wrong");
    exit;
}
function alert($message) { 
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='login.php';
    </script>";
    return false;
}
?>
