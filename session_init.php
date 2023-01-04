<?php
    session_start();
    include("con_db.php");
    if(isset($_SESSION["user_id"])){
        $id = $_SESSION["user_id"];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["target"])){
        $target = $_POST["target"];
        if($target == '登入'){
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
                    $_SESSION["user_id"] = $result[0]["user_id"];
                    //$_SESSION["user_img"] = $result[0]["user_img"];
                    // echo '<script>';
                    // echo 'parent.location.reload();';
                    // echo '</script>';
                    header('Location: ./person.php');
                    exit;
                }
                else{
                    alert("帳號或密碼錯誤",'index.php'); 
                    exit;
                }
            }
            else{     
                alert("此帳號尚未註冊",'index.php'); 
                exit;
            }
        }
        else if($target == "註冊"){
            $user_id = $_POST["user_id"];
            $user_mail = $_POST["user_mail"];
            $user_pass = password_hash($_POST["user_pass"], PASSWORD_DEFAULT);
            //檢查帳號是否重複
            $check = ("select * from user where user_mail = ?");
            $stmt =  $db -> prepare($check);
            $error= $stmt -> execute(array($user_mail));
            $result = $stmt -> fetchAll();
            //catch
            if(count($result) == 0){
                try{
                    $ins = ("insert into user values(?,?,?,?,?,?)");
                    $stmt= $db->prepare($ins);
                    $result = $stmt->execute(array($user_id, $user_id, null, $user_pass, $user_mail, false));
                    $_SESSION["user_id"] = $user_id;    
                    // echo '<script>';
                    // echo 'parent.location.reload();';
                    // echo '</script>';
                    header('Location: ./index.php');
                    
                    exit;       
                }
                catch(Exception $e){
                    //print "hh".$e->getMessage()."ha";
                    $error = $e->getMessage();
                    $error = str_replace("'"," ",$error);
                    //print $error;
                    alert($error,"./index.php");
                    die();
                }
            }
            else{
                alert("該信箱已有註冊過，請登入","index.php"); 
                exit;
            }   
        }
        else if($target == '登出'){
            session_destroy();
            setcookie ( "name", "", time () - 100 );
            // echo '<script>';
            // echo 'parent.location.reload();';
            // echo '</script>';
            header('Location: ./index.php');
            exit;
        }
    }
?>