<?php
    include("session_init.php");
    if(!isset($_SESSION['user_id'])){
        header('Location: ./index.php');
        exit;
    }
?>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>person.php</title>
</head>
<body>
	<div class="menu"></div>
	<div class="content">
		<div class="inner_content">
            <script>
                function seepass(see, pass){
                    var but = document.getElementById(see).className;
                    var pass = (see == "see1" ? "user_cur_pass":"user_new_pass");
                    var value = document.getElementById(pass).value;
                    if(but == "far fa-eye"){
                        document.getElementById(see).classList.remove("fa-eye");
                        document.getElementById(see).classList.add("fa-eye-slash");
                        document.getElementById(pass).type = "password";
                        document.getElementById(pass).value = value;
                    }
                    else{
                        document.getElementById(see).classList.remove("fa-eye-slash");
                        document.getElementById(see).classList.add("fa-eye");
                        document.getElementById(pass).type = "text";
                        document.getElementById(pass).value = value;
                    }
                }
                function validateForm(){
                   var user_pass = document.getElementById("user_new_pass").value.toString();
                   var cha = /[a-zA-Z]+/, chn = /[0-9]+/, chstr = /[a-zA-Z0-9]{6,16}/;
                    if(user_pass!=''){
                        if(!chstr.test(user_pass)){
                            alert("密碼只能包含數字及英文符號，且長度為6-16位");
                            document.getElementById("user_new_pass").value = "";
                            return false;
                        }
                        if(!cha.test(user_pass) || !chn.test(user_pass)){
                            alert("密碼至少要包含一個英文字母及數字");
                            document.getElementById("user_pass").value = "";
                            return false;
                        }
                    }
                }
                function change(){
                    var url = document.getElementById("img_file").file;
                    user_img = getObjectURL(file);
                    document.getElementById("user_img").src = user_img;
                }
                function toback(){
                    var check = window.confirm('放棄修改並離開?');
                    if (check == true) {
                        window.location.href='./person.php';   
                    }
                }    
            </script>
            <form name="update" method="post" action="./people_update.php" onsubmit="return validateForm()">
			<table class="table">
			  <tbody>
                    <tr class = 'img'>
					    <td><input type="image" id="user_img" name = "user_img"/></td>
					    <td><input type="file" id="img_file" accept="image/gif, image/jpeg, image/png" onchange = "change()" value = '上傳檔案'/></td> 
                    </tr>
                    <tr>
                        <th scope="row">id(readonly)</th>
					    <td><input type="text" id="user_id" name = 'user_id' maxlength="16" readonly/></td> 
					</tr> 
					<tr>
                        <th scope="row">name *</th>
					    <td><input type="text" id="user_name" name = 'user_name' maxlength="16" placeholder="介於6-16可英數混合"/></td> 
					</tr> 
                    <tr>
                        <th scope="row">old pass *</th>
					    <td><input type="password" id="user_cur_pass" name = 'user_cur_pass' maxlength="16" placeholder="用於確認是否用戶本人"/></td>
                        <td><input type="button" id = "see1" class="far fa-eye-slash" onclick=seepass(id)></td>
					</tr> 
                    <tr>
                        <th scope="row">update pass</th>
					    <td><input type="password" id="user_new_pass" name = 'user_new_pass' maxlength="16" placeholder="介於6-16需英數混合"/>
                        <td><input type="button" id = "see2" class="far fa-eye-slash" onclick=seepass(id)></td> 
					</tr> 
                    <tr>
                        <td><input type="submit" id = "target" name = 'target' value = '更新'/></td>
                        <td><input type="button" id = "back" value = '返回' onclick="toback()"/></td>
                    <tr>
			  </tbody> 
			</table>
            </form>
		</div>
	</div>
</body>
<script>
    window.onload = function(){
        <?php
            $query = ("select * from user where user_id = ?");
            $stmt =  $db -> prepare($query);
            $error= $stmt -> execute(array($id));
            $result = $stmt -> fetchAll();
            $name = $result[0]["user_name"];
            $img = $result[0]["user_img"];
        ?>
        var user_id = "<?php echo $id; ?>";
        document.getElementById("user_id").value = user_id;
        var user_name = "<?php echo $name; ?>";
        document.getElementById("user_name").value = user_name;
        var user_img = "<?php echo $img; ?>";
        if(!user_img) user_img = "./userimg_normal.png";
        document.getElementById("user_img").src = user_img;
    }
</script>
<style>
	body {
		margin: 0px;
	}
	a {
		text-decoration: none;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
	}
	.menu {
		position:fixed;
		width: 100%;
		height: 40px;
		background-color: dimgrey;
		z-index: 9999999;
	}
	.menu a {
		text-decoration: none;
		color: white;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
	}
	.content {
		position: relative;
		word-wrap: break-word;
		width: 100%;
		top: 40px;
		background-color: #f1f1f1;
	}
	.inner_content {
		padding: 50px 130px 220px 130px;
        background-color: white;
        flex-direction: column; 
	}
    .inner_content left{
		position: relative;
		width: 40%;
        flex-direction: row; 
    }
    .inner_content table{
        position: relative;
		width: 60%;
        flex-direction: row; 
	}
	form {
		margin-bottom: 0em;
	}
  </style>
</html>
