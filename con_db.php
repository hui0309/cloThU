<?php
    session_start();
    $user = 'root'; //資料庫使用者名稱
	$password = 'huahua1018'; //資料庫的密碼
	try{
		$db = new PDO ('mysql: host=localhost;dbname=clothu; charset=utf8', $user, $password);
		//之後若要結束與資料庫的連線，則使用「$db = null;」
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	}catch(PDOException $e){ //若上述程式碼出現錯誤，便會執行以下動作
		Print "ERROR!:" . $e->getMessage();
		die();
	}
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
                    echo '<script>';
                    echo 'parent.location.reload();';
                    echo '</script>';
                    exit;
                }
                else{
                    alert("帳號或密碼錯誤",'login.html'); 
                    exit;
                }
            }
            else{     
                alert("此帳號尚未註冊",'login.html'); 
                exit;
            }
        }
        else if($target == "註冊"){
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
                    $_SESSION["user_id"] = $result[0]["user_id"];
                    //$_SESSION["user_img"] = $result[0]["user_img"];
                    echo '<script language="javascript">';
                    echo 'parent.location.reload();';
                    echo '</script>';
                    exit;
                }
                else{
                    alert("該信箱已有註冊過，請登入","register.html"); 
                    exit;
                }
            }
            else{
                alert("該帳號已有人使用，若之前已註冊過請登入","register.html"); 
                exit;
            }        
        }
        else if($target == '登出'){
            session_destroy();
            echo '<script>';
            echo 'parent.location.reload();';
            echo '</script>';
            exit;
        }
    }
    function alert($message, $where) { 
        // Display the alert box  
        echo "<script>";
        echo "alert('$message');";
        echo "window.location.href='$where';";
        echo "</script>";
    }
?>