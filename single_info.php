<?php
include("session_init.php");
if (!isset($_SESSION["user_id"])) {
    header('Location: ./index.php');
    exit;
}
$cloth_id = $_POST["cloth_id"];
$query = ("select * from cloth_detail t left join store ts on (t.store_id=ts.store_id) where cloth_id=?");
$stmt = $db->prepare($query);
$error = $stmt->execute(array($cloth_id));
$cloth_detail = $stmt->fetchAll();
// echo count($cloth_detail);
$style_arr = array("可愛", "簡約", "優雅");
$style = $cloth_detail[0]['cloth_style'];
$style_id = 0; #在arr中第幾個 2^style_id
while ($style > 1) {
    $style = floor($style / 2);
    $style_id += 1;
}
$style_val = $style_arr[$style_id];


$category_arr = array("上衣", "下著", "連身衣");
$cate = $cloth_detail[0]['cloth_category'];
//print("ddd $cate");
$cate_id = 0; #在arr中第幾個 2^style_id
while ($cate > 1) {
    $cate = floor($cate / 2);
    $cate_id += 1;
}
$cate_val = $category_arr[$cate_id];

?>


<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>single_update</title>
    <style>
        body {
            background-color: white;
        }

        /* a {
            text-decoration: none;
            color: white;
            font-family: 微軟正黑體, 新細明體, 標楷體;
            font-weight: bold;
            font-size: 17px;
        } */
    </style>
    <link href="jquery-ui.css" rel="stylesheet" />
    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.js"></script>

</head>

<body>
    <div class="container-fluid m-1">
        <header class="navbar navbar-expand-sm bd-navbar sticky-top " width="100%" style="background-color: white;">
            <nav class="row navbar navbar-expand-sm navbar-light" style="background-color: white;">
                <div class="container-fluid mt-3">
                    <div class="row menu">
                        <div>
                            <ul class="nav nav-tabs">
                                <!-- <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li> -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"
                                        href="index.php" role="button" aria-expanded="false"
                                        style="color: blueviolet">我的衣櫃</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php">單件</a></li>
                                        <li><a class="dropdown-item" href="index.php">套裝</a></li>
                                        <!-- <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="person.php">個人資訊</a>
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
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-0 col-sm-1 col-md-2"></div>
            <div class="col-6 col-sm-6 col-md-5">
                <img src="<?php echo $cloth_detail[0]['cloth_img']; ?>" class="img-fluid">
            </div>
            <div class="row col-6 col-sm-4 col-md-3 d-flex align-items-center justify-content-between">
                <div class=" d-flex align-self-start justify-content-center">
                    <h1><strong>
                            <?php echo $cloth_detail[0]['cloth_name']; ?>
                        </strong></h1>
                </div>
                <div class=" d-flex align-self-start justify-content-center">
                    <br>
                </div>
                <div class="row  d-flex align-items-center m-1 justify-content-between">
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>分類 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap">
                                <?php echo ($cate == null) ? null : $cate_val; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>風格 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><?php echo ($style == null) ? null : $style_val; ?></h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>商店 </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap">
                                <?php echo $cloth_detail[0]['store_name']; ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-4 col-sm-5 d-flex align-items-center justify-content-between">
                            <h5 class="text-nowrap"><strong>Info </strong></h4>
                        </div>
                        <div class="col-8 col-sm-7 d-flex align-items-center">
                            <h5 class="overflow-auto">
                            <?php echo $cloth_detail[0]['cloth_info']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row  d-flex align-items-center m-1 ">
                    <div class="row ">
                        <div class="col-6 col-sm-6 d-flex align-items-center">
                            <a href="single.php"><button type="button" class="btn btn-secondary">離開</button></a>
                        </div>
                        <div class="col6 col-sm-6 d-flex align-items-center align-self-center">
                            <form id="mfrom" method="post" action="single_update.php" class="d-flex align-items-center align-self-center">
                            <input type="hidden" id="cloth_id" name="cloth_id" value="<?php echo $cloth_id ?>">    
                            <button type="submit" class="btn btn-outline-dark d-flex align-self-center" value="修改">修改</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-sm-1 col-md-2"></div>
        </div>
    </div>
</body>

</html>