<?php
include("session_init.php");
if (!isset($_SESSION['user_id'])) {
	header('Location: ./index.php');
	exit;
}
?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<title>person.php</title>
	<style>
		body {
			margin: 0px;
		}

		a {
			text-decoration: none;
			font-family: 微軟正黑體, 新細明體, 標楷體;
			font-weight: bold;
			font-size: 17px;
		}



		.content {
			position: relative;
			word-wrap: break-word;
			width: 100%;
			top: 40px;
			/*background-color: #f1f1f1;*/
		}

		.inner_content {
			padding: 50px 130px 220px 130px;
			background-color: white;
			flex-direction: row;
		}

		.inner_content:left {
			position: relative;
			width: 40%;
			flex-direction: column;
		}

		.inner_content table {
			position: relative;
			width: 60%;
			flex-direction: row;
		}

		form {
			margin-bottom: 0em;
		}
	</style>
	<link href="jquery-ui.css" rel="stylesheet" />
	<script src="external/jquery/jquery.js"></script>
	<script src="jquery-ui.js"></script>
	<script>
		window.onload = function () {
		<?php
		$query = ("select * from user where user_id = ?");
		$stmt = $db->prepare($query);
		$error = $stmt->execute(array($id));
		$result = $stmt->fetchAll();
		$name = $result[0]["user_name"];
		$mail = $result[0]["user_mail"];
		$img = $result[0]["user_img"];
		$query = ("select * from cloth_number where user_id = ?");
		$stmt = $db->prepare($query);
		$error = $stmt->execute(array($id));
		$result = $stmt->fetchAll();
		$cnt = count($result);
		?>
		var user_name = "<?php echo $name; ?>";
			document.getElementById("user_name").textContent  = user_name;
			var user_id = "<?php echo $id; ?>";
			document.getElementById("user_id").textContent = user_id;
			var user_mail = "<?php echo $mail; ?>";
			document.getElementById("user_mail").textContent = user_mail;
			var cloth_cnt = "<?php echo $cnt; ?>";
			document.getElementById("cnt").textContent = cloth_cnt;
			var user_img = "<?php echo $img; ?>";
			if (!user_img) user_img = "./userimg_normal.png";
			document.getElementById("img").src = user_img;
			var btn = document.getElementById("edit");
			btn.onclick = function () {
				//alert("jump");
				parent.location.href = "./person_update.php";
			}
		}
	</script>
</head>

<body>
	<div class="container-fluid m-1">
		<header class="navbar navbar-expand-sm bd-navbar sticky-top " width="100%" style="background-color: white;">
			<nav class="row navbar navbar-expand-sm navbar-light d-flex align-items-start"
				style="background-color: white;">
				<div class="container-fluid d-flex align-items-start">
					<div class="row menu ">
						<div>
							<ul class="nav nav-tabs">
								<!-- <li class="nav-item">
		<a class="nav-link active" aria-current="page" href="#">Active</a>
		</li> -->
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="single.php"
										role="button" aria-expanded="false" style="color: gray">我的衣櫃</a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="single.php">單件</a></li>
										<li><a class="dropdown-item" href="single.php">套裝</a></li>
										<!-- <li><hr class="dropdown-divider"></li>
		  <li><a class="dropdown-item" href="#">Separated link</a></li> -->
									</ul>
								</li>
								<li class="nav-item">
									<a class="nav-link active" href="#" style="color: blueviolet">個人資訊</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<div class="row g-10">
			<div class="col"><br /><br><br /><br /></div>
		</div>
		<div class="row d-flex align-items-around justify-content-center">
			<div class="col-0 col-sm-1 col-md-2"></div>
			<div class="row col-6 col-sm-6 col-md-5 d-flex align-items-center align-self-center justify-content-center">
				<div class="row d-flex align-items-center align-self-center justify-content-center">
					<input class=" d-flex align-items-center align-self-center img-fluid" type="image" id="img"
						name="img" style="max-width:20rem;" readonly />
				</div>
				<div class="row d-flex align-items-center mb-2 justify-content-center m-2">
					<div class="col-6 d-flex align-items-center align-self-center justify-content-center">
						<div class=" d-flex align-items-center ">
							<form method="post" action="session_init.php">
								<button class="btn btn btn-outline-secondary text-nowrap " type="button" id="edit"
									value="編輯">
									編輯
								</button>
							</form>
						</div>
						<div class="col-6 d-flex align-items-center align-self-center justify-content-center">
							<form method="post" action="session_init.php">
								<button class="btn btn btn-danger text-nowrap" type="submit" id="target" name="target"
									value="登出">
									登出
								</button>
							</form>
						</div>
					</div>

				</div>
			</div>
			<div class="row col-6 col-sm-4 col-md-3 d-flex align-items-center justify-content-between">
				<div class="row ">
					<div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap"><strong>名字 </strong></h4>
					</div>
					<div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap" type="text" id="user_name" readonly>
						</h5>
					</div>
				</div>
				<div class="row ">
					<div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap"><strong>帳號 </strong></h4>
					</div>
					<div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap" type="text" id="user_id" readonly >
						</h5>
					</div>
				</div>
				<div class="row ">
					<div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap"><strong>信箱 </strong></h4>
					</div>
					<div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap" type="text" id="user_mail" readonly >
						</h5>
					</div>
				</div>
				<div class="row ">
					<div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap"><strong>衣服總數 </strong></h4>
					</div>
					<div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
						<h5 class="text-nowrap" type="text" id="cnt" readonly >
						</h5>
					</div>
				</div>
			</div>
			<div class="col-0 col-sm-1 col-md-2"></div>

		</div>

	</div>

</body>

</html>