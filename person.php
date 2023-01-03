<?php
    include("session_init.php");
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
	<div class="menu">
		<table class="menu_css">
			<tr>
                <td><a href = "./single.php">我的衣櫃</a></td>
                <td><a>個人資訊</a></td>
			</tr>
		</table>
	</div>
	<div class="content">
		<div class="inner_content">
            <div class = "left">
                <input type="image" id="img" name = "img" readonly/>
                <iframe id = "iframe" src = "./person.html" width = "250" height = "50"></iframe>
            </div>
			<table class="table">
			  <tbody>
					<tr>
                        <th scope="row">name</th>
					    <td><input type="text" id="user_name" readonly/></td> 
					</tr> 
                    <tr>
                        <th scope="row">id</th>
					    <td><input type="text" id="user_id" readonly/></td> 
					</tr> 
                    <tr>
                        <th scope="row">mail</th>
					    <td><input type="text" id="user_mail" readonly/></td> 
					</tr> 
                    <tr>
                        <th scope="row">衣服總數:</th>
					    <td><input type="text" id="cnt" readonly/></td> 
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
            $mail = $result[0]["user_mail"];
            $query = ("select * from cloth_number where user_id = ?");
            $stmt =  $db -> prepare($query);
            $error= $stmt -> execute(array($id));
            $result = $stmt -> fetchAll();
            $cnt = count($result);
        ?>
        var user_name = "<?php echo $name; ?>";
        document.getElementById("user_name").value = user_name;
        var user_id = "<?php echo $id; ?>";
        document.getElementById("user_id").value = user_id;
        var user_mail = "<?php echo $mail; ?>";
        document.getElementById("user_mail").value = user_mail;
        var cloth_cnt = "<?php echo $cnt; ?>";
        document.getElementById("cnt").value = cloth_cnt;
        var user_img = "./userimg_normal.png";
        document.getElementById("img").src = user_img;
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
	.menu_css {
		float: left;
		width: 100%;
		height: inherit;
		overflow: hidden;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
		color: white;
		border-spacing: 0px;
	}
	.menu_css tr {
		display: block;
	}
	.menu_css td {
		height: 40px;
		padding: 0px 15px 0px 15px;
		white-space: nowrap;
	}
	.menu_css td:hover {
		background-color: black;
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
        flex-direction: row; 
	}
    .inner_content:left{
		position: relative;
		width: 40%;
        flex-direction: column;
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
