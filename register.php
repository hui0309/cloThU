<?php 
    include("con_db.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_POST["user_id"];
    $user_mail = $_POST["user_mail"];
    $user_pass = password_hash($_POST["user_pass"], PASSWORD_DEFAULT);
    //檢查帳號是否重複
    $check = ("select * from user where user_id = ?");
    $stmt =  $db -> prepare($check);
    $error= $stmt -> execute(array($user_id));
    $result = $stmt -> fetchAll();
    if(count($result) == 0){
        //使用預處理寫法是為了防止「sql injection」
        //設定要使用的SQL指令
        $ins = ("insert into user values(?,?,?,?,?,?)");
        $stmt= $db->prepare($ins);
        //執行SQL語法
        $result = $stmt->execute(array($user_id,$user_id,null,$user_pass,$user_mail,false));
    }
    else{
        function_alert("該帳號已有人使用"); 
        exit;
    }
}


function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
} 
?>