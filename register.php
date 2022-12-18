<?php 
    include("con_db.php");
    include("index.php");
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
            $check = ("select * from user where user_mail = ?");
            $stmt =  $db -> prepare($check);
            $error= $stmt -> execute(array($user_mail));
            $result = $stmt -> fetchAll();
            if(count($result) == 0){
                //使用預處理寫法是為了防止「sql injection」
                //設定要使用的SQL指令
                $ins = ("insert into user values(?,?,?,?,?,?)");
                $stmt= $db->prepare($ins);
                //執行SQL語法
                $result = $stmt->execute(array($user_id, $user_id, null, $user_pass, $user_mail, false));
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
                alert("該信箱已有註冊過，請登入"); 
                exit;
            }
        }
        else{
            alert("該帳號已有人使用，若之前已註冊過請登入"); 
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
         window.location.href='register.html';
        </script>";
        return false;
    }
?>