<?php
    include('con_db.php');
    if(!isset($_SESSION['user_id'])){
        header('Location: ./index.php');
        exit;
    }
?>
<html>
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
            </script>
			<table class="table">
			  <tbody>
                    <tr>

                    </te>
					<tr>
                        <th scope="row">name *</th>
					    <td><input type="text" id="user_name" maxlength="16"/></td> 
					</tr> 
                    <tr>
                        <th scope="row">old pass *</th>
					    <td><input type="password" id="user_cur_pass" maxlength="16"/></td>
                        <td><input type="button" id = "see1" class="far fa-eye-slash" onclick=seepass(id)></td>
					</tr> 
                    <tr>
                        <th scope="row">update pass</th>
					    <td><input type="password" id="user_new_pass" maxlength="16"/>
                        <td><input type="button" id = "see2" class="far fa-eye-slash" onclick=seepass(id)></td> 
					</tr> 
			  </tbody> 
			</table>
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
        var user_name = "<?php echo $name; ?>";
        document.getElementById("user_name").value = user_name;
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
	input[type=text] {
		color: black;
	}
	form {
		margin-bottom: 0em;
	}
  </style>
</html>
