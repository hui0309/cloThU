<?php
//include con_db file
include("con_db.php");

$user_id = $_POST["user_id"];
//$pass = $_POST["user_pass"];
$user_pass = password_hash($_POST["user_pass"], PASSWORD_DEFAULT);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = ("select * from user where user_id = ?");
    $stmt =  $db -> prepare($query);
    $error= $stmt -> execute(array($user_id));
    $result = $stmt -> fetchAll();
    if(count($result) == 1 && $user_pass == $result[0]["user_pass"]){
        session_start();
        // Store data in session variables
        $_SESSION["login"] = true;
        $_SESSION["user_id"] = $result[0]["user_pass"];
        header("location:welcome.php");
    }
    else{
        function_alert("帳號或密碼錯誤"); 
    }
}
else{
    function_alert("Something wrong"); 
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>";
    return false;
} 
?>