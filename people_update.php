<?php
    include("con_db.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["target"])){
        $target = $_POST["target"];
        if($target == '更新'){
            $user_id = $_POST["user_id"];
            $user_cur_pass = $_POST["user_cur_pass"];
            $query = ("select * from user where user_id = ?");
            $stmt =  $db -> prepare($query);
            $error= $stmt -> execute(array($user_id));
            $result = $stmt -> fetchAll();
            $user_curpass = $result[0]["user_pass"];
            $check = password_verify($user_cur_pass, $user_curpass);
            if($check){
                if($_POST["user_new_pass"]!="") $user_pass = password_hash($_POST["user_new_pass"], PASSWORD_DEFAULT);
                else $user_pass = password_hash($_POST["user_cur_pass"], PASSWORD_DEFAULT);
                //$user_img = $_POST["user_img"];
                $user_name = $_POST["user_name"];
                $query = ("update user set user_pass=?,user_name=? where user_id=?");
                $stmt = $db->prepare($query);
                $result=$stmt->execute(array($user_pass,$user_name,$user_id));
                echo '<script language="javascript">';
                echo 'window.location.reload();';
                echo '</script>';
                exit;
            }
            else{     
                alert("密碼輸入錯誤",'./person_update.php'); 
                exit;
            }
        }
    }
?>